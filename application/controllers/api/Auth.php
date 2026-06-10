<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';

class Auth extends CI_Controller
{
    private $tokenTtl = 86400;
    private $requestPayloadCache = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('jwt_service');
        $this->load->model('Plan_model');
        $this->load->config('whatsapp');
        $this->load->config('razorpay');


        $this->output->set_content_type('application/json');
    }

    private function respond($payload, $statusCode = 200)
    {
        return $this->output
            ->set_status_header($statusCode)
            ->set_output(json_encode($payload));
    }

    private function ensureMethod($expectedMethod)
    {
        $method = strtoupper((string) $this->input->method(true));
        $expectedMethod = strtoupper((string) $expectedMethod);
        $overrideMethod = strtoupper((string) $this->input->get_request_header('X-HTTP-Method-Override', true));

        if ($overrideMethod === '' && isset($_POST['_method'])) {
            $overrideMethod = strtoupper(trim((string) $_POST['_method']));
        }

        if ($method === 'POST' && in_array($overrideMethod, ['PUT', 'DELETE', 'PATCH'], true)) {
            $method = $overrideMethod;
        }

        if ($method !== $expectedMethod) {
            return $this->respond([
                'code'=>400,
                'status' => false,
                'message' => 'Invalid request method. Use ' . $expectedMethod . '.',
            ], 400);
        }

        return null;
    }

    

    private function getJsonInput()
    {
        $raw = trim((string) $this->input->raw_input_stream);

        if ($raw === '') {
            return [];
        }

        $data = json_decode($raw, true);

        return is_array($data) ? $data : [];
    }

    private function getRequestPayload()
    {
        if ($this->requestPayloadCache !== null) {
            return $this->requestPayloadCache;
        }

        $payload = [];
        $raw = trim((string) $this->input->raw_input_stream);
        $jsonData = $this->getJsonInput();

        if ($raw !== '' && empty($jsonData)) {
            $rawFormData = [];
            parse_str($raw, $rawFormData);

            if (is_array($rawFormData)) {
                $payload = $rawFormData;
            }
        }

        $payload = array_merge($_GET ?? [], $_POST ?? [], $payload, $jsonData);
        $this->requestPayloadCache = $payload;

        return $this->requestPayloadCache;
    }

    private function getPaginationParams($defaultPerPage = 10, $maxPerPage = 100)
    {
        $requestData = $this->getRequestPayload();
        $page = (int) ($requestData['page'] ?? 1);
        $perPage = (int) ($requestData['per_page'] ?? $requestData['limit'] ?? $defaultPerPage);

        if ($page < 1) {
            $page = 1;
        }

        if ($perPage < 1) {
            $perPage = $defaultPerPage;
        }

        if ($perPage > $maxPerPage) {
            $perPage = $maxPerPage;
        }

        return [
            'page' => $page,
            'per_page' => $perPage,
        ];
    }

    private function buildPaginationMeta($totalItems, $pagination, $extra = [])
    {
        $perPage = max(1, (int) ($pagination['per_page'] ?? 10));
        $totalItems = max(0, (int) $totalItems);
        $totalPages = max(1, (int) ceil($totalItems / $perPage));
        $page = min(max(1, (int) ($pagination['page'] ?? 1)), $totalPages);
        $offset = ($page - 1) * $perPage;
        $count = $totalItems > 0 ? min($perPage, $totalItems - $offset) : 0;

        return array_merge([
            'page' => $page,
            'per_page' => $perPage,
            'total' => $totalItems,
            'total_pages' => $totalPages,
            'count' => $count,
            'has_previous' => $page > 1,
            'has_next' => $page < $totalPages,
        ], $extra);
    }

    private function normalizeMobile($mobile)
    {
        return preg_replace('/\D+/', '', (string) $mobile);
    }

    private function getMobileCandidates($mobile)
    {
        $normalized = $this->normalizeMobile($mobile);

        if ($normalized === '') {
            return [];
        }

        $lastTen = strlen($normalized) > 10 ? substr($normalized, -10) : $normalized;

        return array_values(array_unique([
            $normalized,
            $lastTen,
            '+' . $normalized,
            '+91' . $lastTen,
        ]));
    }

    private function findUserByMobile($mobile)
    {
        $mobiles = $this->getMobileCandidates($mobile);

        if (empty($mobiles)) {
            return null;
        }

        return $this->db
            ->where_in('mobile', $mobiles)
            ->where('role', 2)
            ->get('users')
            ->row();
    }

    private function findUserByEmail($email)
    {
        $email = trim((string) $email);

        if ($email === '') {
            return null;
        }

        return $this->db
            ->where('email', $email)
            ->where('role', 2)
            ->get('users')
            ->row();
    }

    private function isPasswordValid($plainPassword, $storedPassword)
    {
        if ($plainPassword === '' || $storedPassword === '') {
            return false;
        }

        if ($storedPassword === $plainPassword) {
            return true;
        }

        if ($storedPassword === md5($plainPassword)) {
            return true;
        }

        if (function_exists('password_verify') && password_verify($plainPassword, $storedPassword)) {
            return true;
        }

        return false;
    }

   private function buildUserPayload($user)
{
    $defaultImage = 'https://filterbook.visiontechnolabs.com/assets/images/filter.jpeg';

    // Check profile image
    if (!empty($user->profile_image)) {

        // If already full URL
        if (filter_var($user->profile_image, FILTER_VALIDATE_URL)) {
            $profileImage = $user->profile_image;
        } else {
            // Build full URL from local path
            $profileImage = base_url( $user->profile_image);
        }

    } else {
        $profileImage = $defaultImage;
    }

    return [
        'id'            => (int) $user->id,
        'name'          => (string) $user->name,
        'store_name'    => isset($user->store_name) ? (string) $user->store_name : '',
        'email'         => isset($user->email) ? (string) $user->email : '',
        'mobile'        => (string) $user->mobile,
        'address'        => (string) $user->address,
        'created_on'        => (string) $user->created_on,
        'profile_image' => $profileImage,
        'role'          => isset($user->role) ? (int) $user->role : 0,
    ];


}
    private function issueToken($user)
{
    return $this->jwt_service->encode([
        'sub'           => (int) $user->id,
        'mobile'        => (string) $user->mobile,
        'role'          => isset($user->role) ? (int) $user->role : 0,
        'name'          => (string) $user->name,

        // IMPORTANT
        'token_version' => (int) $user->token_version,

    ], $this->tokenTtl);
}

    private function getBearerToken()
    {
        $authorization = (string) $this->input->get_request_header('Authorization', true);

        if (preg_match('/Bearer\s+(\S+)/i', $authorization, $matches)) {
            return $matches[1];
        }

        return '';
    }

    private function getAuthenticatedUserFromToken()
    {
        $token = $this->getBearerToken();

        if ($token === '') {
            return [
                null,
                null,
                $this->respond([
                    'code' => 400,

                    'status' => false,
                    'message' => 'Authorization token is required.',
                ], 400)
            ];
        }

        try {
            $payload = $this->jwt_service->decode($token);
        } catch (Exception $e) {
            return [
                null,
                null,
                $this->respond([
                    'code' => 400,
                    'status' => false,
                    'message' => $e->getMessage(),
                ], 400)
            ];
        }

        $userId = isset($payload['sub']) ? (int) $payload['sub'] : 0;
        $user = $this->db->get_where('users', ['id' => $userId])->row();
        if ((int)$payload['token_version'] !== (int)$user->token_version) {

    return [
        null,
        null,
        $this->output
            ->set_status_header(401)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Token expired. Please login again.',
                'data'    => null
            ]))
    ];
}

        if (!$user) {
            return [
                null,
                null,
                $this->respond([
                    'code' => 400,
                    'status' => false,
                    'message' => 'User not found.',
                ], 400)
            ];
        }

        return [$user, $payload, null];
    }

    private function findUserForLogin($identifier)
    {
        $identifier = trim((string) $identifier);

        if ($identifier === '') {
            return null;
        }

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return $this->findUserByEmail($identifier);
        }

        return $this->findUserByMobile($identifier);
    }

    private function getCategoryById($categoryId, $userId)
    {
        return $this->db
            ->where('id', (int) $categoryId)
            ->where('user_id', (int) $userId)
            ->get('categories')
            ->row();
    }

    private function categoryNameExists($name, $userId, $excludeId = 0)
    {
        $this->db->from('categories');
        $this->db->where('user_id', (int) $userId);
        $this->db->where('LOWER(name)', strtolower(trim((string) $name)));

        if ((int) $excludeId > 0) {
            $this->db->where('id !=', (int) $excludeId);
        }

        return $this->db->count_all_results() > 0;
    }

    private function buildCategoryPayload($category, $userId)
    {
        $productCount = (int) $this->db
            ->where('category_id', (int) $category->id)
            ->where('user_id', (int) $userId)
            ->count_all_results('products');

        return [
            'id' => (int) $category->id,
            'name' => (string) $category->name,
            'user_id' => (int) $category->user_id,
            'product_count' => $productCount,
        ];
    }

    private function getCategoryRequestData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'id' => (int) ($requestData['id'] ?? $requestData['category_id'] ?? 0),
            'name' => trim((string) ($requestData['name'] ?? '')),
        ];
    }

    private function getOwnedCategory($categoryId, $userId)
    {
        return $this->db
            ->where('id', (int) $categoryId)
            ->where('user_id', (int) $userId)
            ->get('categories')
            ->row();
    }

    private function getProductById($productId, $userId)
    {
        return $this->db
            ->select('products.*, categories.name AS category_name, users.name AS user_name')
            ->from('products')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->join('users', 'users.id = products.user_id', 'left')
            ->where('products.id', (int) $productId)
            ->where('products.user_id', (int) $userId)
            ->get()
            ->row();
    }

    private function getCatalogById($catalogId, $userId)
    {
        return $this->db
            ->where('id', (int) $catalogId)
            ->where('admin_id', (int) $userId)
            ->get('catalog')
            ->row();
    }

    private function buildCatalogPayload($catalog)
    {
        $image = isset($catalog->image) ? (string) $catalog->image : '';

        return [
            'id' => (int) $catalog->id,
            'admin_id' => (int) $catalog->admin_id,
            'name' => isset($catalog->name) ? (string) $catalog->name : '',
            'description' => isset($catalog->description) ? (string) $catalog->description : '',
            'price' => isset($catalog->price) ? (float) $catalog->price : 0,
            'image' => $image,
            'image_url' => $image !== '' ? base_url('uploads/catalog/' . $image) : null,
            'status' => 'Active',
            'created_at' => isset($catalog->created_at) ? (string) $catalog->created_at : null,
        ];
    }

    private function getCatalogRequestData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'id' => (int) ($requestData['id'] ?? $requestData['catalog_id'] ?? 0),
            'name' => trim((string) ($requestData['name'] ?? '')),
            'description' => trim((string) ($requestData['description'] ?? '')),
            'price' => trim((string) ($requestData['price'] ?? '')),
        ];
    }

    private function buildProductPayload($product)
    {
        return [
            'id' => (int) $product->id,
            'user_id' => (int) $product->user_id,
            'name' => (string) $product->name,
            'category_id' => (int) $product->category_id,
            'category_name' => (string) ($product->category_name ?? ''),
            'brand' => isset($product->brand) ? (string) $product->brand : '',
            'unit' => isset($product->unit) ? (string) $product->unit : '',
            'quantity' => isset($product->quantity) ? (float) $product->quantity : 0,
            'purchase_price' => isset($product->purchase_price) ? (float) $product->purchase_price : 0,
            'sell_price' => isset($product->sell_price) && $product->sell_price !== null ? (float) $product->sell_price : null,
            'user_name' => isset($product->user_name) ? (string) $product->user_name : '',
            'created_at' => isset($product->created_at) ? (string) $product->created_at : null,
        ];
    }

    private function getProductRequestData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'id' => (int) ($requestData['id'] ?? $requestData['product_id'] ?? 0),
            'name' => trim((string) ($requestData['name'] ?? '')),
            'category_id' => (int) ($requestData['category_id'] ?? 0),
            'brand' => trim((string) ($requestData['brand'] ?? '')),
            'unit' => trim((string) ($requestData['unit'] ?? '')),
            'quantity' => (string) ($requestData['quantity'] ?? ''),
            'purchase_price' => (string) ($requestData['purchase_price'] ?? ''),
            'sell_price' => (string) ($requestData['sell_price'] ?? ''),
        ];
    }

    private function buildProfilePayload($user)
    {
        $profileImage = isset($user->profile_image) ? (string) $user->profile_image : '';

        return [
            'id' => (int) $user->id,
            'name' => (string) $user->name,
            'store_name' => isset($user->store_name) ? (string) $user->store_name : '',
            'email' => isset($user->email) ? (string) $user->email : '',
            'mobile' => isset($user->mobile) ? (string) $user->mobile : '',
            'address' => isset($user->address) ? (string) $user->address : '',
            'instagram' => isset($user->instagram) ? (string) $user->instagram : '',
            'facebook' => isset($user->facebook) ? (string) $user->facebook : '',
            'website' => isset($user->website) ? (string) $user->website : '',
            'profile_image' => $profileImage,
            'profile_image_url' => $profileImage !== '' ? base_url($profileImage) : base_url('assets/images/icons/user.png'),
            'role' => isset($user->role) ? (int) $user->role : 0,
            'is_active' => isset($user->isActive) ? (int) $user->isActive : 0,
        ];
    }

    private function getComplaintById($complaintId, $storeId)
    {
        return $this->db
            ->where('id', (int) $complaintId)
            ->where('store_id', (int) $storeId)
            ->get('complaint')
            ->row();
    }

    private function buildComplaintPayload($complaint)
    {
        $status = isset($complaint->status) ? (int) $complaint->status : 0;
        $statusLabel = 'Unknown';

        if ($status === 1) {
            $statusLabel = 'Pending';
        } elseif ($status === 2) {
            $statusLabel = 'Approved';
        } elseif ($status === 3) {
            $statusLabel = 'Reject';
        }

        return [
            'id' => (int) $complaint->id,
            'store_id' => (int) $complaint->store_id,
            'name' => isset($complaint->name) ? (string) $complaint->name : '',
            'mobile' => isset($complaint->mobile) ? (string) $complaint->mobile : '',
            'address' => isset($complaint->address) ? (string) $complaint->address : '',
            'area' => isset($complaint->area) ? (string) $complaint->area : '',
            'product_name' => isset($complaint->product_name) ? (string) $complaint->product_name : '',
            'serial_number' => isset($complaint->serial_number) ? (string) $complaint->serial_number : '',
            'issue' => isset($complaint->issue) ? (string) $complaint->issue : '',
            'complain_details' => isset($complaint->complain_details) ? (string) $complaint->complain_details : '',
            'status' => $status,
            'status_label' => $statusLabel,
            'created_at' => isset($complaint->created_at) ? (string) $complaint->created_at : null,
        ];
    }

    private function getComplaintRequestData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'id' => (int) ($requestData['id'] ?? $requestData['complaint_id'] ?? 0),
            'name' => trim((string) ($requestData['name'] ?? '')),
            'mobile' => trim((string) ($requestData['mobile'] ?? '')),
            'address' => trim((string) ($requestData['address'] ?? '')),
            'area' => trim((string) ($requestData['area'] ?? '')),
            'product_name' => trim((string) ($requestData['product_name'] ?? '')),
            'serial_number' => trim((string) ($requestData['serial_number'] ?? '')),
            'issue' => trim((string) ($requestData['issue'] ?? '')),
            'complain_details' => trim((string) ($requestData['complain_details'] ?? $requestData['details'] ?? '')),
            'status' => (int) ($requestData['status'] ?? 1),
        ];
    }

    private function normalizeComplaintStatus($status)
    {
        if (is_string($status)) {
            $normalized = strtolower(trim($status));

            if ($normalized === 'pending') {
                return 1;
            }

            if ($normalized === 'approved' || $normalized === 'approve') {
                return 2;
            }

            if ($normalized === 'reject' || $normalized === 'rejected') {
                return 3;
            }
        }

        $status = (int) $status;

        return in_array($status, [1, 2, 3], true) ? $status : 0;
    }

    private function getAmcById($amcId, $storeId)
    {
        return $this->db
            ->select('
                amc_customer.*,
                customers.name AS customer_name,
                customers.mobile AS customer_mobile,
                customers.address AS customer_address,
                orders.product_modal,
                orders.date_of_purchase,
                orders.price
            ')
            ->from('amc_customer')
            ->join('customers', 'customers.id = amc_customer.customer_id', 'left')
            ->join('orders', 'orders.id = amc_customer.product_id', 'left')
            ->where('amc_customer.id', (int) $amcId)
            ->where('amc_customer.store_id', (int) $storeId)
            ->get()
            ->row();
    }

    private function getOwnedCustomer($customerId, $storeId)
    {
        return $this->db
            ->where('id', (int) $customerId)
            ->where('store_id', (int) $storeId)
            ->get('customers')
            ->row();
    }

    private function getOwnedCustomerByMobile($mobile, $storeId)
    {
        $mobile = $this->normalizeMobile($mobile);

        if ($mobile === '') {
            return null;
        }

        return $this->db
            ->where('mobile', $mobile)
            ->where('store_id', (int) $storeId)
            ->get('customers')
            ->row();
    }

    private function getOwnedOrderForCustomer($orderId, $customerId, $storeId)
    {
        return $this->db
            ->where('id', (int) $orderId)
            ->where('customer_id', (int) $customerId)
            ->where('store_id', (int) $storeId)
            ->get('orders')
            ->row();
    }

    private function getOwnedOrderForCustomerByProductName($productName, $customerId, $storeId)
    {
        $productName = trim((string) $productName);

        if ($productName === '') {
            return null;
        }

        return $this->db
            ->where('customer_id', (int) $customerId)
            ->where('store_id', (int) $storeId)
            ->where('LOWER(product_name)', strtolower($productName))
            ->order_by('id', 'DESC')
            ->get('orders')
            ->row();
    }

    private function getOwnedOrder($orderId, $storeId)
    {
        return $this->db
            ->where('id', (int) $orderId)
            ->where('store_id', (int) $storeId)
            ->get('orders')
            ->row();
    }

    private function buildCustomerPayload($customer)
    {
        $totalOrders = (int) $this->db
            ->where('customer_id', (int) $customer->id)
            ->where('store_id', (int) $customer->store_id)
            ->count_all_results('orders');

        return [
            'id' => (int) $customer->id,
            'store_id' => (int) $customer->store_id,
            'name' => isset($customer->name) ? (string) $customer->name : '',
            'mobile' => isset($customer->mobile) ? (string) $customer->mobile : '',
            'address' => isset($customer->address) ? (string) $customer->address : '',
            'total_orders' => $totalOrders,
        ];
    }

    private function getCustomerById($customerId, $storeId)
    {
        return $this->db
            ->where('id', (int) $customerId)
            ->where('store_id', (int) $storeId)
            ->get('customers')
            ->row();
    }

    private function getCustomerRequestData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'id' => (int) ($requestData['id'] ?? $requestData['customer_id'] ?? 0),
            'name' => trim((string) ($requestData['name'] ?? $requestData['customer_name'] ?? '')),
            'mobile' => $this->normalizeMobile($requestData['mobile'] ?? $requestData['customer_mobile'] ?? ''),
            'address' => trim((string) ($requestData['address'] ?? '')),
        ];
    }

    private function getServiceById($serviceId, $storeId)
    {
        return $this->db
            ->select('
                service_log.*,
                customers.name AS customer_name,
                customers.mobile AS customer_mobile,
                customers.address AS customer_address,
                orders.product_name,
                orders.product_modal,
                orders.price,
                orders.date_of_purchase,
                orders.service_interval,
                orders.total_services
            ')
            ->from('service_log')
            ->join('orders', 'orders.id = service_log.order_id', 'left')
            ->join('customers', 'customers.id = service_log.customer_id', 'left')
            ->where('service_log.id', (int) $serviceId)
            ->where('orders.store_id', (int) $storeId)
            ->get()
            ->row();
    }

    private function buildServicePayload($service)
    {
        return [
            'id' => (int) $service->id,
            'order_id' => isset($service->order_id) ? (int) $service->order_id : 0,
            'customer_id' => isset($service->customer_id) ? (int) $service->customer_id : 0,
            'service_number' => isset($service->service_number) ? (int) $service->service_number : 0,
            'assign_to' => isset($service->assign_to) ? (int) $service->assign_to : 0,
            'status' => isset($service->status) ? (int) $service->status : 0,
            'status_label' => (int) ($service->status ?? 0) === 1 ? 'Done' : 'Pending',
            'customer_status' => isset($service->customer_status) ? (int) $service->customer_status : 0,
            'service_date' => isset($service->service_date) ? (string) $service->service_date : null,
            'update_at' => isset($service->update_at) ? (string) $service->update_at : null,
            'created_at' => isset($service->created_at) ? (string) $service->created_at : null,
            'customer_name' => isset($service->customer_name) ? (string) $service->customer_name : '',
            'customer_mobile' => isset($service->customer_mobile) ? (string) $service->customer_mobile : '',
            'customer_address' => isset($service->customer_address) ? (string) $service->customer_address : '',
            'product_name' => isset($service->product_name) ? (string) $service->product_name : '',
            'product_modal' => isset($service->product_modal) ? (string) $service->product_modal : '',
            'price' => isset($service->price) ? (float) $service->price : 0,
            'date_of_purchase' => isset($service->date_of_purchase) ? (string) $service->date_of_purchase : null,
            'service_interval' => isset($service->service_interval) ? (int) $service->service_interval : 0,
            'total_services' => isset($service->total_services) ? (int) $service->total_services : 0,
        ];
    }

    private function getServiceRequestData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'id' => (int) ($requestData['id'] ?? $requestData['service_id'] ?? 0),
            'status' => array_key_exists('status', $requestData) ? (int) $requestData['status'] : null,
        ];
    }

    private function getCustomServiceRequestData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'id' => (int) ($requestData['id'] ?? $requestData['order_id'] ?? 0),
            'order_id' => (int) ($requestData['order_id'] ?? $requestData['id'] ?? 0),
            'service_id' => (int) ($requestData['service_id'] ?? 0),
            'customer_name' => trim((string) ($requestData['customer_name'] ?? $requestData['name'] ?? '')),
            'mobile' => $this->normalizeMobile($requestData['mobile'] ?? $requestData['customer_mobile'] ?? ''),
            'address' => trim((string) ($requestData['address'] ?? '')),
            'product_name' => trim((string) ($requestData['product_name'] ?? '')),
            'total_services' => (int) ($requestData['total_services'] ?? 0),
            'service_interval' => (int) ($requestData['service_interval'] ?? 0),
            'start_service_date' => trim((string) ($requestData['start_service_date'] ?? $requestData['date_of_purchase'] ?? '')),
        ];
    }

    private function getOrderIdFromServiceId($serviceId, $storeId)
    {
        $service = $this->db
            ->select('service_log.order_id')
            ->from('service_log')
            ->join('orders', 'orders.id = service_log.order_id', 'inner')
            ->where('service_log.id', (int) $serviceId)
            ->where('orders.store_id', (int) $storeId)
            ->get()
            ->row();

        return $service ? (int) $service->order_id : 0;
    }

    private function replaceServiceSchedule($orderId, $customerId, $startServiceDate, $serviceInterval, $totalServices)
    {
        $this->db->where('order_id', (int) $orderId)->delete('service_log');

        for ($i = 1; $i <= $totalServices; $i++) {
            $serviceDate = date('Y-m-d', strtotime('+' . ($serviceInterval * ($i - 1)) . ' month', strtotime($startServiceDate)));

            $this->db->insert('service_log', [
                'order_id' => (int) $orderId,
                'customer_id' => (int) $customerId,
                'service_number' => $i,
                'assign_to' => 0,
                'status' => 0,
                'customer_status' => 0,
                'service_date' => $serviceDate,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    private function getEmiById($emiId, $storeId = null)
    {
        $this->db
            ->select('
                emi_logs.*,
                customers.name AS customer_name,
                customers.mobile AS customer_mobile,
                customers.address AS customer_address,
                orders.product_name,
                orders.product_modal,
                orders.price,
                orders.down_payment,
                orders.emi_amount,
                orders.date_of_purchase,
                orders.emi_duration
            ')
            ->from('emi_logs')
            ->join('orders', 'orders.id = emi_logs.order_id', 'left')
            ->join('customers', 'customers.id = emi_logs.customer_id', 'left')
            ->where('emi_logs.id', (int) $emiId);

        if ($storeId !== null) {
            $this->db->where('orders.store_id', (int) $storeId);
        }

        return $this->db->get()->row();
    }

   private function buildEmiPayload($emi)
{
    // ✅ EMI start date logic
    $emiStartDate = null;

    if (isset($emi->emi_number) && (int)$emi->emi_number === 1) {
        $emiStartDate = $emi->emi_date;
    }

    return [
        'id' => (int) $emi->id,

        'order_id' => isset($emi->order_id)
            ? (int) $emi->order_id
            : 0,

        'customer_id' => isset($emi->customer_id)
            ? (int) $emi->customer_id
            : 0,

        'emi_number' => isset($emi->emi_number)
            ? (int) $emi->emi_number
            : 0,

        'status' => isset($emi->status)
            ? (int) $emi->status
            : 0,

        'status_label' => (int)($emi->status ?? 0) === 1
            ? 'Paid'
            : 'Pending',

        'customer_status' => isset($emi->status_customer)
            ? (int) $emi->status_customer
            : 0,

        'emi_date' => isset($emi->emi_date)
            ? (string) $emi->emi_date
            : null,

        // ✅ ONLY EMI NUMBER 1 GETS VALUE
        'emi_start_date' => $emiStartDate,

        'update_at' => isset($emi->update_at)
            ? (string) $emi->update_at
            : null,

        'created_at' => isset($emi->created_at)
            ? (string) $emi->created_at
            : null,

        'customer_name' => isset($emi->customer_name)
            ? (string) $emi->customer_name
            : '',

        'customer_mobile' => isset($emi->customer_mobile)
            ? (string) $emi->customer_mobile
            : '',

        'customer_address' => isset($emi->customer_address)
            ? (string) $emi->customer_address
            : '',

        'product_name' => isset($emi->product_name)
            ? (string) $emi->product_name
            : '',

        'product_modal' => isset($emi->product_modal)
            ? (string) $emi->product_modal
            : '',

        'price' => isset($emi->price)
            ? (float) $emi->price
            : 0,

        'down_payment' => isset($emi->down_payment)
            ? (float) $emi->down_payment
            : 0,

        'emi_amount' => isset($emi->emi_amount)
            ? (float) $emi->emi_amount
            : 0,

        'date_of_purchase' => isset($emi->date_of_purchase)
            ? (string) $emi->date_of_purchase
            : null,

        'emi_duration' => isset($emi->emi_duration)
            ? (int) $emi->emi_duration
            : 0,
    ];
}
    private function getEmiRequestData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'id' => (int) ($requestData['id'] ?? $requestData['emi_id'] ?? 0),
            'status' => array_key_exists('status', $requestData) ? (int) $requestData['status'] : null,
        ];
    }

    private function buildAmcPayload($amc)
    {
        $today = strtotime(date('Y-m-d'));
        $endTs = !empty($amc->end_date) ? strtotime($amc->end_date) : null;
        $isActive = (int) ($amc->status ?? 0) === 1 && $endTs && $endTs >= $today;
        $daysLeft = $endTs ? (int) floor(($endTs - $today) / 86400) : 0;

        return [
            'id' => (int) $amc->id,
            'store_id' => (int) $amc->store_id,
            'customer_id' => (int) $amc->customer_id,
            'product_id' => (int) $amc->product_id,
            'customer_name' => isset($amc->customer_name) ? (string) $amc->customer_name : '',
            'customer_mobile' => isset($amc->customer_mobile) ? (string) $amc->customer_mobile : '',
            'customer_address' => isset($amc->customer_address) ? (string) $amc->customer_address : '',
            'product_name' => isset($amc->product_name) ? (string) $amc->product_name : '',
            'product_modal' => isset($amc->product_modal) ? (string) $amc->product_modal : '',
            'purchase_date' => isset($amc->date_of_purchase) ? (string) $amc->date_of_purchase : null,
            'purchase_price' => isset($amc->price) ? (float) $amc->price : 0,
            'start_date' => isset($amc->start_date) ? (string) $amc->start_date : '',
            'end_date' => isset($amc->end_date) ? (string) $amc->end_date : '',
            'amc_amount' => isset($amc->amc_amount) ? (float) $amc->amc_amount : 0,
            'status' => isset($amc->status) ? (int) $amc->status : 0,
            'status_label' => $isActive ? 'Active' : 'Expired',
            'days_left' => max($daysLeft, 0),
            'created_at' => isset($amc->created_at) ? (string) $amc->created_at : null,
        ];
    }

    private function getAmcRequestData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'id' => (int) ($requestData['id'] ?? $requestData['amc_id'] ?? 0),
            'customer_id' => (int) ($requestData['customer_id'] ?? 0),
            'customer_mobile' => $this->normalizeMobile($requestData['customer_mobile'] ?? $requestData['mobile'] ?? ''),
            'product_id' => (int) ($requestData['product_id'] ?? 0),
            'product_name' => trim((string) ($requestData['product_name'] ?? '')),
            'start_date' => trim((string) ($requestData['start_date'] ?? '')),
            'end_date' => trim((string) ($requestData['end_date'] ?? '')),
            'amc_amount' => trim((string) ($requestData['amc_amount'] ?? '')),
        ];
    }

    private function getOrderRequestData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'id' => (int) ($requestData['id'] ?? $requestData['order_id'] ?? 0),
            'customer_id' => (int) ($requestData['customer_id'] ?? 0),
            'customer_name' => trim((string) ($requestData['customer_name'] ?? $requestData['customerName'] ?? '')),
            'customer_mobile' => $this->normalizeMobile($requestData['customer_mobile'] ?? $requestData['customerMobile'] ?? ''),
            'address' => trim((string) ($requestData['address'] ?? '')),
            'product_name' => trim((string) ($requestData['product_name'] ?? '')),
            'product_modal' => trim((string) ($requestData['product_modal'] ?? $requestData['modal_numb'] ?? '')),
            'date_of_purchase' => trim((string) ($requestData['date_of_purchase'] ?? $requestData['purchasedate'] ?? '')),
            'price' => trim((string) ($requestData['price'] ?? '')),
            'down_payment' => trim((string) ($requestData['down_payment'] ?? '')),
            'emi_month' => (int) ($requestData['emi_month'] ?? $requestData['emi_duration'] ?? 0),
            'emi_date' => trim((string) ($requestData['emi_date'] ?? '')),
            'payment_type' => $requestData['payment_type'] ?? $requestData['customRadio'] ?? '',
            'service_interval' => (int) ($requestData['service_interval'] ?? 0),
            'total_services' => (int) ($requestData['total_services'] ?? 0),
        ];
    }

    private function isValidDate($date)
    {
        if (!is_string($date) || trim($date) === '') {
            return false;
        }

        $dt = DateTime::createFromFormat('Y-m-d', trim($date));

        return $dt && $dt->format('Y-m-d') === trim($date);
    }

    private function normalizePaymentType($paymentType)
    {
        $paymentType = strtolower(trim((string) $paymentType));

        if (in_array($paymentType, ['1', 'emi', 'installment'], true)) {
            return 1;
        }

        return 0;
    }

    private function getOrderById($orderId, $storeId)
    {
        return $this->db
            ->select('orders.*, customers.name AS customer_name, customers.mobile AS customer_mobile, customers.address AS customer_address')
            ->from('orders')
            ->join('customers', 'customers.id = orders.customer_id', 'left')
            ->where('orders.id', (int) $orderId)
            ->where('orders.store_id', (int) $storeId)
            ->get()
            ->row();
    }

    private function buildOrderPayload($order)
    {
        $emiLogs = $this->db
            ->where('order_id', (int) $order->id)
            ->where('status', 1)
            ->order_by('emi_number', 'ASC')
            ->get('emi_logs')
            ->result();

        $serviceLogs = $this->db
            ->where('order_id', (int) $order->id)
            ->where('status', 1)
            ->order_by('service_number', 'ASC')
            ->get('service_log')
            ->result();

        return [
            'id' => (int) $order->id,
            'store_id' => (int) $order->store_id,
            'customer_id' => (int) $order->customer_id,
            'customer_name' => (string) ($order->customer_name ?? ''),
            'customer_mobile' => (string) ($order->customer_mobile ?? ''),
            'customer_address' => (string) ($order->customer_address ?? ''),
            'product_name' => isset($order->product_name) ? (string) $order->product_name : '',
            'product_modal' => isset($order->product_modal) ? (string) $order->product_modal : '',
            'date_of_purchase' => isset($order->date_of_purchase) ? (string) $order->date_of_purchase : null,
            'price' => isset($order->price) ? (float) $order->price : 0,
            'down_payment' => isset($order->down_payment) ? (float) $order->down_payment : 0,
            'emi_amount' => isset($order->emi_amount) ? (float) $order->emi_amount : 0,
            'emi_duration' => isset($order->emi_duration) ? (int) $order->emi_duration : 0,
    'emi_start_date'    => !empty($order->emi_date)
                                ? date('Y-m-d', strtotime($order->emi_date))
                                : null,

            'payment_type' => isset($order->payment_type) ? (int) $order->payment_type : 0,
            'payment_type_label' => (int) ($order->payment_type ?? 0) === 1 ? 'EMI' : 'Cash',
            'service_interval' => isset($order->service_interval) ? (int) $order->service_interval : 0,
            'total_services' => isset($order->total_services) ? (int) $order->total_services : 0,
            'created_at' => isset($order->created_at) ? (string) $order->created_at : null,
            'emi_logs' => array_map(function ($emi) {
                return [
                    'id' => (int) $emi->id,
                    'emi_number' => isset($emi->emi_number) ? (int) $emi->emi_number : 0,
                    'status' => isset($emi->status) ? (int) $emi->status : 0,
                    'status_customer' => isset($emi->status_customer) ? (int) $emi->status_customer : 0,
                    'emi_date' => isset($emi->emi_date) ? (string) $emi->emi_date : null,
                    'created_at' => isset($emi->created_at) ? (string) $emi->created_at : null,
                ];
            }, $emiLogs),
            'service_logs' => array_map(function ($service) {
                return [
                    'id' => (int) $service->id,
                    'service_number' => isset($service->service_number) ? (int) $service->service_number : 0,
                    'assign_to' => isset($service->assign_to) ? (int) $service->assign_to : 0,
                    'status' => isset($service->status) ? (int) $service->status : 0,
                    'customer_status' => isset($service->customer_status) ? (int) $service->customer_status : 0,
                    'service_date' => isset($service->service_date) ? (string) $service->service_date : null,
                    'created_at' => isset($service->created_at) ? (string) $service->created_at : null,
                ];
            }, $serviceLogs),
        ];
    }

    private function buildPlanCatalogPayload($plans)
    {
        $items = [];

        foreach ($plans as $plan) {
            $items[] = [
                'code' => (string) ($plan['code'] ?? ''),
                'name' => (string) ($plan['name'] ?? ''),
                'duration_days' => (int) ($plan['duration_days'] ?? 0),
                'duration_label' => (string) ($plan['duration_label'] ?? ''),
                'price' => (float) ($plan['price'] ?? 0),
                'price_label' => (string) ($plan['price_label'] ?? ''),
                'tag' => (string) ($plan['tag'] ?? ''),
                'accent' => (string) ($plan['accent'] ?? ''),
                'is_trial' => !empty($plan['is_trial']),
                'features' => array_values($plan['features'] ?? []),
            ];
        }

        return $items;
    }

    private function buildPlanSummaryPayload($summary)
    {
        if (!$summary) {
            return null;
        }

        $subscription = $summary['subscription'] ?? null;

        return [
            'is_trial' => !empty($summary['is_trial']),
            'is_expired' => !empty($summary['is_expired']),
            'is_last_day' => !empty($summary['is_last_day']),
            'days_left' => (int) ($summary['days_left'] ?? 0),
            'status_label' => (string) ($summary['status_label'] ?? ''),
            'plan_name' => (string) ($summary['plan_name'] ?? ''),
            'start_date' => (string) ($summary['start_date'] ?? ''),
            'end_date' => (string) ($summary['end_date'] ?? ''),
            'amount' => (float) ($summary['amount'] ?? 0),
            'message' => (string) ($summary['message'] ?? ''),
            'trial_used' => !empty($summary['trial_used']),
            'can_purchase_plan' => !empty($summary['can_purchase_plan']),
            'purchase_locked_message' => (string) ($summary['purchase_locked_message'] ?? ''),
            'subscription' => $subscription ? [
                'id' => (int) ($subscription->id ?? 0),
                'user_id' => (int) ($subscription->user_id ?? 0),
                'plan_code' => (string) ($subscription->plan_code ?? ''),
                'plan_name' => (string) ($subscription->plan_name ?? ''),
                'duration_days' => (int) ($subscription->duration_days ?? 0),
                'amount' => (float) ($subscription->amount ?? 0),
                'is_trial' => (int) ($subscription->is_trial ?? 0),
                'status' => (string) ($subscription->status ?? ''),
                'start_date' => (string) ($subscription->start_date ?? ''),
                'end_date' => (string) ($subscription->end_date ?? ''),
                'created_at' => (string) ($subscription->created_at ?? ''),
                'updated_at' => (string) ($subscription->updated_at ?? ''),
            ] : null,
        ];
    }

    private function getPlanStatusPayload($userId)
    {
        $summary = $this->Plan_model->get_plan_summary((int) $userId);

        return $this->buildPlanSummaryPayload($summary);
    }

    private function resolvePlanTargetUser($authenticatedUser)
    {
        $targetUserId = (int) ($authenticatedUser->id ?? 0);

        if ($targetUserId <= 0) {
            return [
                null,
                $this->respond([
                    'status' => false,
                    'message' => 'Authenticated user not found.',
                ], 422)
            ];
        }

        $targetUser = $this->db
            ->where('id', $targetUserId)
            ->where('role', 2)
            ->get('users')
            ->row();

        if (!$targetUser) {
            return [
                null,
                $this->respond([
                    'status' => false,
                    'message' => 'Authenticated user not found.',
                ], 404)
            ];
        }

        return [$targetUser, null];
    }

    private function getProfileUpdateData()
    {
        $requestData = $this->getRequestPayload();
        $fields = ['name', 'store_name', 'email', 'mobile', 'address', 'instagram', 'facebook', 'website'];
        $data = [];

        foreach ($fields as $field) {
            if (array_key_exists($field, $requestData)) {
                $data[$field] = trim((string) $requestData[$field]);
            }
        }

        return $data;
    }

    private function getChangePasswordData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'mobile' => $this->normalizeMobile($requestData['mobile'] ?? ''),
            'password' => (string) ($requestData['password'] ?? ''),
            'confirm_password' => (string) ($requestData['confirm_password'] ?? ''),
        ];
    }

    private function getForgotPasswordData()
    {
        $requestData = $this->getRequestPayload();

        return [
            'identifier' => trim((string) ($requestData['identifier'] ?? $requestData['mobile'] ?? $requestData['email'] ?? '')),
            'password' => (string) ($requestData['password'] ?? ''),
            'confirm_password' => (string) ($requestData['confirm_password'] ?? ''),
        ];
    }

   public function register()
{
    $methodError = $this->ensureMethod('POST');

    if ($methodError !== null) {

        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Invalid request method.',
            ]));
    }

    /* -------------------------
       GET JSON INPUT
    ------------------------- */

    $data = json_decode(file_get_contents('php://input'), true);

    $name             = trim((string)($data['name'] ?? ''));
    $store_name       = trim((string)($data['store_name'] ?? ''));
    $email            = trim((string)($data['email'] ?? ''));
    $mobile           = trim((string)($data['mobile'] ?? ''));
    $password         = trim((string)($data['password'] ?? ''));
    $confirm_password = trim((string)($data['confirm_password'] ?? ''));

    /* -------------------------
       VALIDATION
    ------------------------- */

    if (
        empty($name) ||
        empty($store_name) ||
        empty($email) ||
        empty($mobile) ||
        empty($password)
    ) {

        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Name, store name, email, mobile and password are required.',
            ]));
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Please enter valid email address.',
            ]));
    }

    if (strlen($mobile) < 10) {

        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Please enter valid mobile number.',
            ]));
    }

    if (!empty($confirm_password) && $password !== $confirm_password) {

        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Password and confirm password do not match.',
            ]));
    }

    /* -------------------------
       CHECK MOBILE EXIST
    ------------------------- */

    $mobile_exist = $this->db
        ->where('mobile', $mobile)
        ->get('users')
        ->row();

    if ($mobile_exist) {

        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Mobile number already registered.',
            ]));
    }

    /* -------------------------
       CHECK EMAIL EXIST
    ------------------------- */

    $email_exist = $this->db
        ->where('email', $email)
        ->get('users')
        ->row();

    if ($email_exist) {

        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Email address already registered.',
            ]));
    }

    /* -------------------------
       INSERT USER
    ------------------------- */

    $insert_data = [
        'name'        => $name,
        'store_name'  => $store_name,
        'email'       => $email,
        'mobile'      => $mobile,
        'password'    => md5($password),
        'role'        => 2,
        'isActive'    => 1,
        'created_on'  => date('Y-m-d H:i:s'),
    ];

    $this->db->insert('users', $insert_data);

    $user_id = (int)$this->db->insert_id();

    /* -------------------------
       CREATE FREE TRIAL PLAN
    ------------------------- */

    $start_date = date('Y-m-d');
    $end_date   = date('Y-m-d', strtotime('+1 day'));

    $plan_data = [
        'user_id'        => $user_id,
        'plan_code'      => 'trial',
        'plan_name'      => 'Free Trial',
        'duration_days'  => 1,
        'amount'         => 0,
        'is_trial'       => 1,
        'status'         => 'trial',
        'start_date'     => $start_date,
        'start_at'       => date('Y-m-d H:i:s'),
        'end_date'       => $end_date,
        'end_at'         => date('Y-m-d H:i:s', strtotime('+1 day')),
        'created_at'     => date('Y-m-d H:i:s'),
        'updated_at'     => date('Y-m-d H:i:s'),
    ];

    $this->db->insert('user_subscriptions', $plan_data);

    /* -------------------------
       GET USER
    ------------------------- */

    $user = $this->db
        ->where('id', $user_id)
        ->get('users')
        ->row();

    /* -------------------------
       PROFILE IMAGE
    ------------------------- */

    $defaultImage = 'https://filterbook.visiontechnolabs.com/assets/images/filter.jpeg';

    $profileImage = $defaultImage;

    if (!empty($user->profile_image)) {

        if (filter_var($user->profile_image, FILTER_VALIDATE_URL)) {

            $profileImage = $user->profile_image;

        } else {

            $profileImage = base_url($user->profile_image);
        }
    }

    /* -------------------------
       USER RESPONSE
    ------------------------- */

    $userPayload = [
        'id'            => (int)$user->id,
        'name'          => (string)$user->name,
        'store_name'    => (string)$user->store_name,
        'email'         => (string)$user->email,
        'mobile'        => (string)$user->mobile,
        'created_on'    => (string)$user->created_on,
        'profile_image' => $profileImage,
        'role'          => (int)$user->role,

        'has_plan'      => true,

        'plan_details'  => [
            'plan_name' => 'Free Trial',
            'start_date'=> $start_date,
            'end_date'  => $end_date,
        ]
    ];

    /* -------------------------
       SUCCESS RESPONSE
    ------------------------- */

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'code'       => 200,
            'status'     => true,
            'message'    => 'Registered successfully.',
            'token'      => $this->issueToken($user),
            'token_type' => 'Bearer',
            'data'       => $userPayload,
        ]));
}
   
public function login()
{
    $methodError = $this->ensureMethod('POST');

    if ($methodError !== null) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Invalid request method.',
            ]));
    }

    $data = $this->getJsonInput();

    $identifier = trim((string) (
        $data['mobile']
        ?? $data['email']
        ?? $data['login']
        ?? $this->input->post('mobile', true)
        ?? $this->input->post('email', true)
        ?? $this->input->post('login', true)
    ));

    $password = (string) (
        $data['password']
        ?? $this->input->post('password', true)
    );

    // ✅ Validation
    if ($identifier === '' || $password === '') {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Mobile/email and password are required.',
            ]));
    }

    // ✅ Find user
    $user = $this->findUserForLogin($identifier);

    if (!$user) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'User not found with the provided mobile/email.',
            ]));
    }

    // ✅ Account active check
    if (isset($user->isActive) && (string) $user->isActive === '0') {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Your account is inactive. Please contact administrator.',
            ]));
    }

    // ✅ Password check
    if (!$this->isPasswordValid($password, (string) $user->password)) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Invalid password.',
            ]));
    }

    // ✅ User Payload
    $userPayload = $this->buildUserPayload($user);

    // ✅ Remove old subscription object if exists
    if (isset($userPayload['subscription'])) {
        unset($userPayload['subscription']);
    }

    // ✅ Default plan status
    $userPayload['has_plan'] = false;
    $userPayload['plan_details'] = null;

    // ✅ Get active/trial plan
    $plan = $this->db
    ->from('user_subscriptions')
    ->where('user_id', (int)$user->id)
    ->group_start()
        ->where('status', 'active')
        ->or_where('status', 'trial')
    ->group_end()
    ->where('end_date >=', date('Y-m-d'))
    ->order_by('id', 'DESC')
    ->get()
    ->row();

    // ✅ If plan exists
    if ($plan) {

        $userPayload['has_plan'] = true;

        $userPayload['plan_details'] = [
            'plan_name' => (string) $plan->plan_name,
            'start_date'  => (string) $plan->start_date,
            'end_date'  => (string) $plan->end_date,
        ];
    }

    // ✅ Final response
    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'code'    => 200,
            'status'  => true,
            'message' => 'Login successful.',
            'token'   => $this->issueToken($user),
            'data'    => $userPayload,
        ]));
}
    public function me()
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        // ✅ Get fresh plan summary
        $planSummary = $this->getPlanStatusPayload((int) $user->id);
        $planExpired = !empty($planSummary['is_expired']);

        return $this->respond([
            'code'         => 200,
            'status'       => true,
            'message'      => 'User profile fetched successfully.',
            'plan_expired' => $planExpired,
            // ✅ If expired, send warning message for app to show alert
            'plan_alert'   => $planExpired ? [
                'show'    => true,
                'title'   => 'Plan Expired!',
                'message' => $planSummary['message'] ?? 'Your plan has expired. Please purchase a new plan.',
                'action'  => 'buy_plan',
            ] : null,
            'data'         => $this->buildUserPayload($user),
            'plan_status'  => $planSummary,
            'token_data'   => $payload,
        ]);
    }

    public function logout()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        return $this->respond([
            'code' => 200,
            'status' => true,
            'message' => 'Logout successful. Please remove the token on the client side.',
            'data' => [
                'user' => $this->buildUserPayload($user),
                'logged_out_at' => date('Y-m-d H:i:s'),
                'token_expires_at' => isset($payload['exp']) ? date('Y-m-d H:i:s', (int) $payload['exp']) : null,
            ],
        ]);
    }

    public function category_list()
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $search = trim((string) ($this->getRequestPayload()['search'] ?? ''));
        $pagination = $this->getPaginationParams();
        $buildCategoryQuery = function () use ($user, $search) {
            $this->db
                ->from('categories')
                ->where('user_id', (int) $user->id);

            if ($search !== '') {
                $this->db->group_start()
                    ->like('name', $search)
                    ->group_end();
            }

            return $this->db;
        };
        $totalCategories = (int) $buildCategoryQuery()->count_all_results();
        $meta = $this->buildPaginationMeta($totalCategories, $pagination, [
            'user_id' => (int) $user->id,
            'search' => $search,
        ]);

        $categories = $buildCategoryQuery()
            ->order_by('id', 'DESC')
            ->limit($meta['per_page'], ($meta['page'] - 1) * $meta['per_page'])
            ->get()
            ->result();

        $categoryData = array_map(function ($category) use ($user) {
            return $this->buildCategoryPayload($category, $user->id);
        }, $categories);

        return $this->respond([
            'code' => 200,
            'status' => true,
            'message' => 'Category list fetched successfully.',
            'data' => $categoryData,
            'meta' => $meta,
        ]);
    }

    public function add_category()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'code' => 400,
                    'status' => false,
                    'message' => 'Invalid request method.',
                ]));
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'code' => 400,
                    'status' => false,
                    'message' => 'Unauthorized access.',
                ]));
        }

        $request = $this->getCategoryRequestData();
        $name = $request['name'];

        if ($name === '') {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'code' => 400,
                    'status' => false,
                    'message' => 'Category name is required.',
                ]));
        }

        if ($this->categoryNameExists($name, $user->id)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'code' => 400,
                    'status' => false,
                    'message' => 'Category name already exists.',
                ]));
        }

        // Insert category
        $this->db->insert('categories', [
            'user_id' => (int) $user->id,
            'name' => $name,
        ]);

        $categoryId = (int) $this->db->insert_id();
        $category = $this->getCategoryById($categoryId, $user->id);

        // Success
        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'code' => 200,
                'status' => true,
                'message' => 'Category added successfully.',
                'data' => $this->buildCategoryPayload($category, $user->id),
            ]));
    }

    public function edit_category()
    {
        $methodError = $this->ensureMethod('PUT');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getCategoryRequestData();
        $categoryId = (int) $request['id'];
        $name = $request['name'];

        if ($categoryId <= 0 || $name === '') {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Category id and name are required.',
            ]);
            return;
        }

        $category = $this->getCategoryById($categoryId, $user->id);

        if (!$category) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Category not found.',
            ]);
            return;
        }

        if ($this->categoryNameExists($name, $user->id, $categoryId)) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Category name already exists.',
            ]);
            return;
        }

        $this->db
            ->where('id', $categoryId)
            ->where('user_id', (int) $user->id)
            ->update('categories', [
                'name' => $name,
            ]);

        $updatedCategory = $this->getCategoryById($categoryId, $user->id);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Category updated successfully.',
            'data' => $this->buildCategoryPayload($updatedCategory, $user->id),
        ]);
    }

    public function delete_category($id = 0)
    {
        $methodError = $this->ensureMethod('DELETE');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getCategoryRequestData();
        $categoryId = (int) ($id > 0 ? $id : $request['id']);

        if ($categoryId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Category id is required.',
            ]);
            return;
        }

        $category = $this->getCategoryById($categoryId, $user->id);

        if (!$category) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Category not found.',
            ]);
            return;
        }

        $deletedProducts = (int) $this->db
            ->where('category_id', $categoryId)
            ->where('user_id', (int) $user->id)
            ->count_all_results('products');

        $this->db->delete('products', [
            'category_id' => $categoryId,
            'user_id' => (int) $user->id,
        ]);

        $this->db->delete('categories', [
            'id' => $categoryId,
            'user_id' => (int) $user->id,
        ]);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Category deleted successfully.',
            'data' => [
                'id' => $categoryId,
                'name' => (string) $category->name,
                'deleted_products' => $deletedProducts,
            ],
        ]);
    }

    public function product_list()
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $search = trim((string) ($this->getRequestPayload()['search'] ?? ''));
        $pagination = $this->getPaginationParams();
        $buildProductQuery = function () use ($user, $search) {
            $this->db
                ->select('products.*, categories.name AS category_name, users.name AS user_name')
                ->from('products')
                ->join('categories', 'categories.id = products.category_id', 'left')
                ->join('users', 'users.id = products.user_id', 'left')
                ->where('products.user_id', (int) $user->id);

            if ($search !== '') {
                $this->db->group_start()
                    ->like('products.name', $search)
                    ->or_like('products.brand', $search)
                    ->or_like('products.unit', $search)
                    ->or_like('categories.name', $search)
                    ->group_end();
            }

            return $this->db;
        };
        $totalProducts = (int) $buildProductQuery()->count_all_results();
        $meta = $this->buildPaginationMeta($totalProducts, $pagination, [
            'user_id' => (int) $user->id,
            'search' => $search,
        ]);

        $products = $buildProductQuery()
            ->order_by('products.id', 'DESC')
            ->limit($meta['per_page'], ($meta['page'] - 1) * $meta['per_page'])
            ->get()
            ->result();

        $productData = array_map(function ($product) {
            return $this->buildProductPayload($product);
        }, $products);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Product list fetched successfully.',
            'data' => $productData,
            'meta' => $meta,
        ]);
    }

    public function catalog_list()
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $pagination = $this->getPaginationParams();
        $buildCatalogQuery = function () use ($user) {
            return $this->db
                ->from('catalog')
                ->where('admin_id', (int) $user->id);
        };
        $totalCatalogs = (int) $buildCatalogQuery()->count_all_results();
        $meta = $this->buildPaginationMeta($totalCatalogs, $pagination, [
            'admin_id' => (int) $user->id,
        ]);

        $catalogs = $buildCatalogQuery()
            ->order_by('id', 'DESC')
            ->limit($meta['per_page'], ($meta['page'] - 1) * $meta['per_page'])
            ->get()
            ->result();

        $catalogData = array_map(function ($catalog) {
            return $this->buildCatalogPayload($catalog);
        }, $catalogs);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Catalog list fetched successfully.',
            'data' => $catalogData,
            'meta' => $meta,
        ]);
    }

    public function add_catalog()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getCatalogRequestData();

        if ($request['name'] === '' || $request['price'] === '') {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Catalog name and price are required.',
            ]);
            return;
        }

        if (!is_numeric($request['price']) || (float) $request['price'] < 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Please enter a valid price.',
            ]);
            return;
        }

        $uploadPath = FCPATH . 'uploads/catalog/';

        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0777, true);
        }

        if (!is_dir($uploadPath) || !is_writable($uploadPath)) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Catalog image upload folder is not writable.',
            ]);
            return;
        }

        $imageName = null;

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 5120;
            $config['encrypt_name'] = true;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $imageName = $uploadData['file_name'];
            } else {
                http_response_code(400);
                echo json_encode([
                    'code' => 400,

                    'status' => false,
                    'message' => strip_tags($this->upload->display_errors('', '')),
                ]);
                return;
            }
        }

        $this->db->insert('catalog', [
            'admin_id' => (int) $user->id,
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => (float) $request['price'],
            'image' => $imageName,
        ]);

        $catalogId = (int) $this->db->insert_id();
        $catalog = $this->getCatalogById($catalogId, (int) $user->id);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Catalog item added successfully.',
            'data' => $this->buildCatalogPayload($catalog),
        ]);
    }

    public function edit_catalog($id = 0)
    {
        $methodError = $this->ensureMethod('PUT');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getCatalogRequestData();
        $catalogId = (int) ($id > 0 ? $id : $request['id']);

        if ($catalogId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Catalog id is required.',
            ]);
            return;
        }

        $catalog = $this->getCatalogById($catalogId, (int) $user->id);

        if (!$catalog) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Catalog item not found.',
            ]);
            return;
        }

        $uploadPath = FCPATH . 'uploads/catalog/';

        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0777, true);
        }

        $hasImage = !empty($_FILES['image']['name']);
        $hasTextField = ($request['name'] !== '' || $request['description'] !== '' || $request['price'] !== '');

        if (!$hasImage && !$hasTextField) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Please send at least one field or image to update.',
            ]);
            return;
        }

        $name = $request['name'] !== '' ? $request['name'] : (string) $catalog->name;
        $description = $request['description'] !== '' ? $request['description'] : (string) $catalog->description;
        $price = $request['price'] !== '' ? $request['price'] : $catalog->price;

        if ($name === '') {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Catalog name cannot be empty.',
            ]);
            return;
        }

        if ($price === '' || !is_numeric($price) || (float) $price < 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Please enter a valid price.',
            ]);
            return;
        }

        $imageName = $catalog->image;

        if ($hasImage) {
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 5120;
            $config['encrypt_name'] = true;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $imageName = $uploadData['file_name'];

                if (!empty($catalog->image) && file_exists($uploadPath . $catalog->image)) {
                    @unlink($uploadPath . $catalog->image);
                }
            } else {
                http_response_code(400);
                echo json_encode([
                    'code' => 400,

                    'status' => false,
                    'message' => strip_tags($this->upload->display_errors('', '')),
                ]);
                return;
            }
        }

        $this->db
            ->where('id', $catalogId)
            ->where('admin_id', (int) $user->id)
            ->update('catalog', [
                'name' => $name,
                'description' => $description,
                'price' => (float) $price,
                'image' => $imageName,
            ]);

        $updatedCatalog = $this->getCatalogById($catalogId, (int) $user->id);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Catalog item updated successfully.',
            'data' => $this->buildCatalogPayload($updatedCatalog),
        ]);
    }

    public function delete_catalog($id = 0)
    {
        $methodError = $this->ensureMethod('DELETE');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getCatalogRequestData();
        $catalogId = (int) ($id > 0 ? $id : $request['id']);

        if ($catalogId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Catalog id is required.',
            ]);
            return;
        }

        $catalog = $this->getCatalogById($catalogId, (int) $user->id);

        if (!$catalog) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Catalog item not found.',
            ]);
            return;
        }

        if (!empty($catalog->image) && file_exists(FCPATH . 'uploads/catalog/' . $catalog->image)) {
            @unlink(FCPATH . 'uploads/catalog/' . $catalog->image);
        }

        $this->db->delete('catalog', [
            'id' => $catalogId,
            'admin_id' => (int) $user->id,
        ]);

        http_response_code(200);
        echo json_encode([
            'status' => true,
            'message' => 'Catalog item deleted successfully.',
            'data' => [
                'id' => $catalogId,
                'name' => (string) $catalog->name,
            ],
        ]);
    }
    public function product_details($id = 0)
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $id = (int) $id;
        $product = $this->getProductById($id, $user->id);

        if (!$product) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Product not found.',
            ]);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Product details fetched successfully.',
            'data' => $this->buildProductPayload($product),
        ]);
    }

    public function add_product()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getProductRequestData();

        if ($request['name'] === '' || $request['category_id'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Product name and category are required.',
            ]);
            return;
        }

        $category = $this->getOwnedCategory($request['category_id'], $user->id);

        if (!$category) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Invalid category selected.',
            ]);
            return;
        }

        $insertData = [
            'user_id' => (int) $user->id,
            'name' => $request['name'],
            'category_id' => (int) $request['category_id'],
            'brand' => $request['brand'],
            'unit' => $request['unit'],
            'quantity' => $request['quantity'] === '' ? 0 : $request['quantity'],
            'purchase_price' => $request['purchase_price'] === '' ? 0 : $request['purchase_price'],
            'sell_price' => $request['sell_price'] === '' ? null : $request['sell_price'],
        ];

        $this->db->insert('products', $insertData);
        $productId = (int) $this->db->insert_id();
        $product = $this->getProductById($productId, $user->id);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Product added successfully.',
            'data' => $this->buildProductPayload($product),
        ]);
    }

    public function edit_product()
    {
        $methodError = $this->ensureMethod('PUT');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getProductRequestData();

        if ($request['id'] <= 0 || $request['name'] === '' || $request['category_id'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Product id, name and category are required.',
            ]);
            return;
        }

        $product = $this->getProductById($request['id'], $user->id);

        if (!$product) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Product not found.',
            ]);
            return;
        }

        $category = $this->getOwnedCategory($request['category_id'], $user->id);

        if (!$category) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Invalid category selected.',
            ]);
            return;
        }

        $this->db
            ->where('id', (int) $request['id'])
            ->where('user_id', (int) $user->id)
            ->update('products', [
                'name' => $request['name'],
                'category_id' => (int) $request['category_id'],
                'brand' => $request['brand'],
                'unit' => $request['unit'],
                'quantity' => $request['quantity'] === '' ? 0 : $request['quantity'],
                'purchase_price' => $request['purchase_price'] === '' ? 0 : $request['purchase_price'],
                'sell_price' => $request['sell_price'] === '' ? null : $request['sell_price'],
            ]);

        $updatedProduct = $this->getProductById($request['id'], $user->id);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Product updated successfully.',
            'data' => $this->buildProductPayload($updatedProduct),
        ]);
    }

    public function delete_product($id = 0)
    {
        $methodError = $this->ensureMethod('DELETE');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getProductRequestData();
        $productId = (int) ($id > 0 ? $id : $request['id']);

        if ($productId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Product id is required.',
            ]);
            return;
        }

        $product = $this->getProductById($productId, $user->id);

        if (!$product) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Product not found.',
            ]);
            return;
        }

        $this->db->delete('products', [
            'id' => $productId,
            'user_id' => (int) $user->id,
        ]);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Product deleted successfully.',
            'data' => [
                'id' => $productId,
                'name' => (string) $product->name,
            ],
        ]);
    }

    public function profile_details()
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Profile details fetched successfully.',
            'data' => $this->buildProfilePayload($user),
        ]);
    }

    public function edit_profile()
    {
        $methodError = $this->ensureMethod('PUT');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $data = $this->getProfileUpdateData();

        if (isset($data['email'])) {
            if ($data['email'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                http_response_code(400);
                echo json_encode([
                    'code' => 400,

                    'status' => false,
                    'message' => 'Please enter a valid email address.',
                ]);
                return;
            }

            $emailExists = $this->db
                ->where('email', $data['email'])
                ->where('id !=', (int) $user->id)
                ->count_all_results('users');

            if ($emailExists > 0) {
                http_response_code(400);
                echo json_encode([
                    'code' => 400,

                    'status' => false,
                    'message' => 'Email address already registered.',
                ]);
                return;
            }
        }

        if (isset($data['name']) && $data['name'] === '') {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Name cannot be empty.',
            ]);
            return;
        }

        if (isset($data['store_name']) && $data['store_name'] === '') {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Store name cannot be empty.',
            ]);
            return;
        }

        if (!empty($_FILES['profile_image']['name'])) {
            $uploadPath = FCPATH . 'uploads/profile_img/';

            if (!is_dir($uploadPath)) {
                @mkdir($uploadPath, 0777, true);
            }

            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = true;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('profile_image')) {
                $uploadData = $this->upload->data();
                $data['profile_image'] = 'uploads/profile_img/' . $uploadData['file_name'];
            } else {
                http_response_code(400);
                echo json_encode([
                    'code' => 400,

                    'status' => false,
                    'message' => strip_tags($this->upload->display_errors('', '')),
                ]);
                return;
            }
        }

        if (empty($data)) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Please send at least one field or profile image to update.',
            ]);
            return;
        }

        $this->db->where('id', (int) $user->id);
        $updated = $this->db->update('users', $data);

        if (!$updated) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Profile update failed.',
            ]);
            return;
        }

        $updatedUser = $this->db->get_where('users', ['id' => (int) $user->id])->row();

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Profile updated successfully.',
            'data' => $this->buildProfilePayload($updatedUser),
        ]);
    }

    public function change_password()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $data = $this->getChangePasswordData();
        $mobile = $data['mobile'];
        $password = $data['password'];
        $confirmPassword = $data['confirm_password'];

        if ($mobile === '' || $password === '' || $confirmPassword === '') {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Mobile number, password and confirm password are required.',
            ]);
            return;
        }

        if (strlen($mobile) < 10) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Please enter a valid mobile number.',
            ]);
            return;
        }

        if ($password !== $confirmPassword) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Password and confirm password do not match.',
            ]);
            return;
        }

        if (strlen($password) < 6) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Password must be at least 6 characters long.',
            ]);
            return;
        }

        $validMobiles = $this->getMobileCandidates($user->mobile);

        if (!in_array($mobile, $validMobiles, true)) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Entered mobile number does not match the logged in account.',
            ]);
            return;
        }

        $this->db->where('id', (int) $user->id);
        $updated = $this->db->update('users', [
            'password' => md5($password),
        ]);

        if (!$updated) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Failed to update password. Please try again.',
            ]);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Password changed successfully.',
            'data' => [
                'id' => (int) $user->id,
                'mobile' => (string) $user->mobile,
            ],
        ]);
    }

 public function complaint_list()
{
    header('Content-Type: application/json');

    // ✅ Only allow GET
    $methodError = $this->ensureMethod('GET');

    if ($methodError !== null) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode($methodError));
    }

    // ✅ Auth check
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

    if ($errorResponse !== null) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode($errorResponse));
    }

    // ✅ User ID
    $store_id = (int) $user->id;

    // ✅ Filters
    $search    = trim($this->input->get('search') ?? '');
    $status    = $this->input->get('status');
    $page      = max(1, (int) ($this->input->get('page') ?? 1));
    $per_page  = max(1, min(50, (int) ($this->input->get('per_page') ?? 10)));
    $offset    = ($page - 1) * $per_page;

    // ✅ Counts
    $counts = $this->db
        ->select('
            COUNT(*) AS total_complaints,
            SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS pending_complaints,
            SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS solved_complaints
        ')
        ->from('complaint')
        ->where('store_id', $store_id)
        ->get()
        ->row();

    // ✅ Filtered Count
    $this->db->where('complaint.store_id', $store_id);

    if ($status === 'pending') {
        $this->db->where('complaint.status', 1);
    } elseif ($status === 'solved') {
        $this->db->where('complaint.status', 0);
    }

    if ($search !== '') {
        $this->db->group_start()
            ->like('complaint.name', $search)
            ->or_like('complaint.mobile', $search)
            ->or_like('complaint.product_name', $search)
            ->group_end();
    }

    $total = (int) $this->db
        ->from('complaint')
        ->count_all_results();

    // ✅ Rebuild query for data fetch
    $this->db->where('complaint.store_id', $store_id);

    if ($status === 'pending') {
        $this->db->where('complaint.status', 1);
    } elseif ($status === 'solved') {
        $this->db->where('complaint.status', 0);
    }

    if ($search !== '') {
        $this->db->group_start()
            ->like('complaint.name', $search)
            ->or_like('complaint.mobile', $search)
            ->or_like('complaint.product_name', $search)
            ->group_end();
    }

    // ✅ Fetch complaints
    $complaints = $this->db
        ->from('complaint')
        ->order_by('id', 'DESC')
        ->limit($per_page, $offset)
        ->get()
        ->result();

    // ✅ Response data (ONLY required fields)
    $complaintData = array_map(function ($complaint) {

        return [
            'id'            => (int) $complaint->id,
            'name'          => (string) $complaint->name,
            'mobile'        => (string) $complaint->mobile,
            'address'       => (string) $complaint->address,
            'status_label'  => ((int)$complaint->status === 1) ? 'Pending' : 'Solved',
            'created_at'    => $complaint->created_at,
        ];

    }, $complaints);

    // ✅ Final Response
    return $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode([
            'code'                => 200,
            'status'              => true,
            'message'             => 'Complaint list fetched successfully.',
            'total_complaints'    => (int) ($counts->total_complaints ?? 0),
            'pending_complaints'  => (int) ($counts->pending_complaints ?? 0),
            'solved_complaints'   => (int) ($counts->solved_complaints ?? 0),
            'data'                => $complaintData,
            'meta'                => [
                'total'     => $total,
                'page'      => $page,
                'per_page'  => $per_page,
                'last_page' => max(1, (int) ceil($total / $per_page)),
            ]
        ]));
}
private function getComplaintStatusLabel($status)
{
    switch ($status) {
        case 0: return 'Pending';
        case 1: return 'Solved';
        case 2: return 'Approved';
        default: return 'Unknown';
    }
}
public function complaint_details($id)
{
    header('Content-Type: application/json');

    // ✅ Only allow GET
    $methodError = $this->ensureMethod('GET');

    if ($methodError !== null) {
        return $methodError;
    }

    // ✅ Auth check
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

    if ($errorResponse !== null) {
        return $errorResponse;
    }

    $store_id = (int) $user->id;
    $id       = (int) $id;

    // ✅ Validate ID
    if ($id <= 0) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Invalid complaint ID.',
            ]));
    }

    // ✅ Fetch complaint
    $complaint = $this->db
        ->from('complaint')
        ->where('id', $id)
        ->where('store_id', $store_id)
        ->get()
        ->row();

    // ✅ Not found
    if (!$complaint) {
        return $this->output
            ->set_status_header(404)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'code'    => 404,
                'status'  => false,
                'message' => 'Complaint not found.',
            ]));
    }

    // ✅ Response Data
    $data = [
        'id'                => (int) $complaint->id,
        'store_id'          => (int) $complaint->store_id,
        'name'              => (string) $complaint->name,
        'mobile'            => (string) $complaint->mobile,
        'address'           => (string) $complaint->address,
        'area'              => (string) $complaint->area,
        'product_name'      => (string) $complaint->product_name,
        'serial_number'     => (string) $complaint->serial_number,
        'issue'             => (string) $complaint->issue,
        'complain_details'  => (string) $complaint->complain_details,
        'status'            => (int) $complaint->status,
        'status_label'      => ((int)$complaint->status === 1) ? 'Pending' : 'Solved',
        'created_at'        => (string) $complaint->created_at,
    ];

    // ✅ Final Response
    return $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode([
            'code'    => 200,
            'status'  => true,
            'message' => 'Complaint details fetched successfully.',
            'data'    => $data,
        ]));
}
   public function update_complaint_status($id = 0)
{
    header('Content-Type: application/json');

    // ✅ Only allow PUT
    $methodError = $this->ensureMethod('PUT');

    if ($methodError !== null) {
        return $methodError;
    }

    // ✅ Auth check
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

    if ($errorResponse !== null) {
        return $errorResponse;
    }

    // ✅ Request Data
    $requestData = $this->getRequestPayload();

    $complaintId = (int) (
        $id > 0
            ? $id
            : ($requestData['id'] ?? $requestData['complaint_id'] ?? 0)
    );

    $rawStatus = $requestData['status'] ?? null;

    // ✅ Status Mapping
    $status = null;

    if (
        $rawStatus === 'pending' ||
        $rawStatus === 1 ||
        $rawStatus === '1'
    ) {
        $status = 1;
    }
    elseif (
        $rawStatus === 'solved' ||
        $rawStatus === 0 ||
        $rawStatus === '0'
    ) {
        $status = 0;
    }

    // ✅ Validate Complaint ID
    if ($complaintId <= 0) {

        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Complaint id is required.',
            ]));
    }

    // ✅ Validate Status
    if ($rawStatus === null || !in_array($status, [0, 1], true)) {

        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Status must be pending/1 or solved/0.',
            ]));
    }

    // ✅ Check complaint exists
    $complaint = $this->db
        ->from('complaint')
        ->where('id', $complaintId)
        ->where('store_id', (int) $user->id)
        ->get()
        ->row();

    if (!$complaint) {

        return $this->output
            ->set_status_header(404)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'code'    => 404,
                'status'  => false,
                'message' => 'Complaint not found.',
            ]));
    }

    // ✅ Update Status
    $updated = $this->db
        ->where('id', $complaintId)
        ->where('store_id', (int) $user->id)
        ->update('complaint', [
            'status' => $status
        ]);

    // ✅ Update Failed
    if (!$updated) {

        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Complaint status update failed.',
            ]));
    }

    // ✅ Fetch Updated Data
    $updatedComplaint = $this->db
        ->from('complaint')
        ->where('id', $complaintId)
        ->where('store_id', (int) $user->id)
        ->get()
        ->row();

    // ✅ Final Response
    return $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode([
            'code'    => 200,
            'status'  => true,
            'message' => 'Complaint status updated successfully.',
            'data'    => [
                'id'            => (int) $updatedComplaint->id,
                'name'          => (string) $updatedComplaint->name,
                'mobile'        => (string) $updatedComplaint->mobile,
                'address'       => (string) $updatedComplaint->address,
                'status'        => (int) $updatedComplaint->status,
                'status_label'  => ((int)$updatedComplaint->status === 1)
                    ? 'Pending'
                    : 'Solved',
                'created_at'    => (string) $updatedComplaint->created_at,
            ]
        ]));
}

    public function delete_complaint($id = 0)
    {
        $methodError = $this->ensureMethod('DELETE');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getComplaintRequestData();
        $complaintId = (int) ($id > 0 ? $id : $request['id']);

        if ($complaintId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Complaint id is required.',
            ]);
            return;
        }

        $complaint = $this->getComplaintById($complaintId, $user->id);

        if (!$complaint) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Complaint not found.',
            ]);
            return;
        }

        $this->db->delete('complaint', [
            'id' => $complaintId,
            'store_id' => (int) $user->id,
        ]);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Complaint deleted successfully.',
            'data' => [
                'id' => $complaintId,
                'name' => (string) $complaint->name,
                'product_name' => (string) $complaint->product_name,
            ],
        ]);
    }

  public function amc_list()
{
    header('Content-Type: application/json');

    $methodError = $this->ensureMethod('GET');
    if ($methodError !== null) return $methodError;

    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) return $errorResponse;

    $store_id  = (int) $user->id;
    $search    = trim($this->input->get('search') ?? '');
    $status    = $this->input->get('status');
    $page      = max(1, (int) ($this->input->get('page') ?? 1));
    $per_page  = max(1, min(50, (int) ($this->input->get('per_page') ?? 10)));
    $offset    = ($page - 1) * $per_page;

    // ✅ Get counts (single query - no extra load)
    $counts = $this->db
        ->select('
            COUNT(*) AS total_amc,
            SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS active_amc,
            SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS expired_amc
        ')
        ->from('amc_customer')
        ->where('store_id', $store_id)
        ->get()
        ->row();

    // ✅ Build filtered count query
    $this->db->where('amc_customer.store_id', $store_id);

    if ($status === 'active') {
        $this->db->where('amc_customer.status', 1);
    } elseif ($status === 'expired') {
        $this->db->where('amc_customer.status', 0);
    }

    if ($search !== '') {
        $this->db->group_start()
            ->like('customers.name', $search)
            ->or_like('customers.mobile', $search)
            ->group_end();
    }

    $total = (int) $this->db
        ->select('amc_customer.id')
        ->from('amc_customer')
        ->join('customers', 'customers.id = amc_customer.customer_id', 'left')
        ->count_all_results();

    // ✅ Rebuild WHERE for data fetch
    $this->db->where('amc_customer.store_id', $store_id);

    if ($status === 'active') {
        $this->db->where('amc_customer.status', 1);
    } elseif ($status === 'expired') {
        $this->db->where('amc_customer.status', 0);
    }

    if ($search !== '') {
        $this->db->group_start()
            ->like('customers.name', $search)
            ->or_like('customers.mobile', $search)
            ->group_end();
    }

    // ✅ Fetch data with pagination
    $amcs = $this->db
        ->select('
            amc_customer.id AS amc_id,
            customers.name AS customer_name,
            customers.mobile AS customer_mobile,
            amc_customer.product_name,
            amc_customer.status
        ')
        ->from('amc_customer')
        ->join('customers', 'customers.id = amc_customer.customer_id', 'left')
        ->order_by('amc_customer.id', 'DESC')
        ->limit($per_page, $offset)
        ->get()
        ->result();

    // ✅ Format response
    $data = [];
    foreach ($amcs as $amc) {
        $data[] = [
            'amc_id'          => (int) $amc->amc_id,
            'customer_name'   => $amc->customer_name ?? '',
            'customer_mobile' => $amc->customer_mobile ?? '',
            'product_name'    => $amc->product_name ?? '',
            'status'          => (int) $amc->status,
            'status_label'    => ((int) $amc->status === 1) ? 'active' : 'expired',
        ];
    }

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'code'        => 200,
            'status'      => true,
            'message'     => 'AMC list fetched successfully.',
            'total_amc'   => (int) ($counts->total_amc ?? 0),
            'active_amc'  => (int) ($counts->active_amc ?? 0),
            'expired_amc' => (int) ($counts->expired_amc ?? 0),
            'data'        => $data,
            'meta'        => [
                'total'     => $total,
                'page'      => $page,
                'per_page'  => $per_page,
                'last_page' => max(1, (int) ceil($total / $per_page)),
            ]
        ]));
}

   public function amc_details($amc_id = 0)
{
    header('Content-Type: application/json');

    $methodError = $this->ensureMethod('GET');
    if ($methodError !== null) return $methodError;

    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) return $errorResponse;

    $store_id = (int) $user->id;
    $amc_id   = (int) $amc_id;

    if ($amc_id <= 0) {
        return $this->errorResponse('Valid amc_id is required');
    }

    // ✅ Get AMC with customer info
    $amc = $this->db
        ->select('
            amc_customer.*,
            customers.name AS customer_name,
            customers.mobile AS customer_mobile,
            customers.address AS customer_address
        ')
        ->from('amc_customer')
        ->join('customers', 'customers.id = amc_customer.customer_id', 'left')
        ->where('amc_customer.id', $amc_id)
        ->where('amc_customer.store_id', $store_id)
        ->get()
        ->row();

    if (!$amc) {
        return $this->errorResponse('AMC record not found');
    }

    // ✅ Get logs for this AMC
    $logs = $this->db
        ->select('*')
        ->from('amc_logs')
        ->where('amc_id', $amc_id)
        ->order_by('id', 'DESC')
        ->get()
        ->result();

    $log_data = [];
    foreach ($logs as $log) {
        $log_data[] = [
            'log_id'     => (int) $log->id,
            'action'     => $log->action,
            'old_data'   => $log->old_data ? json_decode($log->old_data) : null,
            'new_data'   => $log->new_data ? json_decode($log->new_data) : null,
            'created_at' => $log->created_at ?? null,
        ];
    }

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'code'    => 200,
            'status'  => true,
            'message' => 'AMC details fetched successfully.',
            'data'    => [
                'amc_id'           => (int) $amc->id,
                'customer_id'      => (int) $amc->customer_id,
                'customer_name'    => $amc->customer_name ?? '',
                'customer_mobile'  => $amc->customer_mobile ?? '',
                'customer_address' => $amc->customer_address ?? '',
                'product_name'     => $amc->product_name ?? '',
                'start_date'       => $amc->start_date,
                'end_date'         => $amc->end_date,
                'amc_amount'       => (float) $amc->amc_amount,
                'special_notes'    => $amc->special_notes ?? null,
                'status'           => (int) $amc->status,
                'status_label'     => ((int) $amc->status === 1) ? 'active' : 'expired',
                'created_at'       => $amc->created_at ?? null,
                'logs'             => $log_data,
            ]
        ]));
}
public function get_customer()
{
    header('Content-Type: application/json');

    $methodError = $this->ensureMethod('GET');
    if ($methodError !== null) {
        return $methodError;
    }

    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) {
        return $errorResponse;
    }

    $store_id = (int) $user->id;
    $search = trim($this->input->get('search') ?? '');

    // Step 1: Get customers
    $this->db->select('id, name, mobile,address')
             ->from('customers')
             ->where('store_id', $store_id);

    if (!empty($search)) {
        $this->db->group_start()
                 ->like('name', $search)
                 ->or_like('mobile', $search)
                 ->group_end();
    }

    $customers = $this->db->get()->result();

    if (empty($customers)) {
        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'code'=>200,
                'status' => true,
                'data' => []
            ]));
    }

    // Step 2: Get all customer IDs
    $customer_ids = array_column($customers, 'id');

    // Step 3: Fetch products from orders table
    $orders = $this->db->select('customer_id, product_name')
                       ->from('orders')
                       ->where_in('customer_id', $customer_ids)
                       ->get()
                       ->result();

    // Step 4: Map products to customers
    $product_map = [];
    foreach ($orders as $o) {
        $product_map[$o->customer_id][] = $o->product_name;
    }

    // Step 5: Final response
    $data = [];
    foreach ($customers as $c) {
        $data[] = [
            'id' => (int) $c->id,
            'name' => $c->name,
            'address' => $c->address,

            'mobile' => $c->mobile,
            'products' => $product_map[$c->id] ?? [] // empty array if no product
        ];
    }

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Customers fetched successfully',
            'data' => $data
        ]));
}
// echo "<pre>";
// print_r($);
// die;
    public function add_amc()
{
    header('Content-Type: application/json');

    // ✅ Method check
    $methodError = $this->ensureMethod('POST');
    if ($methodError !== null) return $methodError;

    // ✅ Auth
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) return $errorResponse;

    $store_id = (int) $user->id;

    $input = json_decode(file_get_contents("php://input"), true);

    // -------------------------------
    // ✅ COMMON REQUIRED
    // -------------------------------
    $required_common = ['product_name', 'start_date', 'end_date', 'amc_amount'];

    foreach ($required_common as $field) {
        if (empty($input[$field])) {
            return $this->errorResponse("$field is required");
        }
    }

    $product_name = trim($input['product_name']);
    $start_date   = date('Y-m-d', strtotime($input['start_date']));
    $end_date     = date('Y-m-d', strtotime($input['end_date']));
    $amc_amount   = (float) $input['amc_amount'];
    $notes        = $input['special_notes'] ?? null;

    // ✅ Date validation
    if ($end_date <= $start_date) {
        return $this->errorResponse('End date must be greater than start date');
    }

    // -------------------------------
    // ✅ CUSTOMER HANDLING
    // -------------------------------
    $customer_id = null;

    // CASE 1: Existing customer
    if (!empty($input['customer_id'])) {

        $customer_id = (int) $input['customer_id'];

        $customer = $this->db->get_where('customers', [
            'id' => $customer_id,
            'store_id' => $store_id
        ])->row();

        if (!$customer) {
            return $this->errorResponse('Customer not found');
        }

    } else {
        // CASE 2: New customer

        $required_new = ['name', 'mobile'];

        foreach ($required_new as $field) {
            if (empty($input[$field])) {
                return $this->errorResponse("$field is required for new customer");
            }
        }

        // 🔥 Prevent duplicate customer (mobile-based)
        $existingCustomer = $this->db->get_where('customers', [
            'mobile' => $input['mobile'],
            'store_id' => $store_id
        ])->row();

        if ($existingCustomer) {
            $customer_id = $existingCustomer->id;
        } else {
            // Insert new customer
            $customerData = [
                'store_id' => $store_id,
                'name' => trim($input['name']),
                'mobile' => trim($input['mobile']),
                'address' => $input['address'] ?? null,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('customers', $customerData);
            $customer_id = $this->db->insert_id();
        }
    }

    // -------------------------------
    // ✅ PREVENT DUPLICATE AMC
    // same customer + product + active AMC
    // -------------------------------
    $duplicate = $this->db->get_where('amc_customer', [
        'customer_id' => $customer_id,
        'product_name' => $product_name,
        'status' => 1 // active
    ])->row();

    if ($duplicate) {
        return $this->errorResponse('Active AMC already exists for this product');
    }

    // -------------------------------
    // ✅ STATUS LOGIC
    // -------------------------------
    $start = new DateTime($start_date);
    $end   = new DateTime($end_date);
    $interval = $start->diff($end);

    $status = ($interval->y >= 1) ? 0 : 1; // 0=expired, 1=active

    // -------------------------------
    // ✅ INSERT AMC
    // -------------------------------
    $amcData = [
        'customer_id' => $customer_id,
        'store_id' => $store_id,
        'product_name' => $product_name,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'amc_amount' => $amc_amount,
        'special_notes' => $notes,
        'status' => $status,
        'created_at' => date('Y-m-d H:i:s')
    ];

    $this->db->insert('amc_customer', $amcData);

    if (!$this->db->affected_rows()) {
        return $this->errorResponse('Failed to add AMC');
    }

   // After insert success

$amc_id = $this->db->insert_id();
$this->db->insert('amc_logs', [
    'amc_id' => $amc_id,
    'customer_id' => $customer_id,
    'store_id' => $store_id,
    'action' => 'created',
    'new_data' => json_encode($amcData)
]);
// ✅ Fetch inserted AMC
$amc = $this->db->get_where('amc_customer', [
    'id' => $amc_id
])->row();

// ✅ Fetch customer
$customer = $this->db->get_where('customers', [
    'id' => $customer_id
])->row();

return $this->output
    ->set_status_header(200)
    ->set_output(json_encode([
        'status' => true,
        'code' => 200,
        'message' => 'AMC added successfully',
        'data' => [
            'amc_id' => (int) $amc->id,
            'customer_id' => (int) $customer->id,
            'customer_name' => $customer->name,
            'mobile' => $customer->mobile,
            'product_name' => $amc->product_name,
            'start_date' => $amc->start_date,
            'end_date' => $amc->end_date,
            'amc_amount' => (float) $amc->amc_amount,
            'status' => (int) $amc->status,
            'status_label' => $amc->status == 1 ? 'active' : 'expired',
            'created_at' => $amc->created_at
        ]
    ]));
}

// -------------------------------
// ✅ COMMON ERROR RESPONSE
// -------------------------------
private function errorResponse($message)
{
    return $this->output
        ->set_status_header(400)
        ->set_output(json_encode([
            'status' => false,
            'code' => 400,
            'message' => $message
        ]));
}


    public function update_amc()
{
    header('Content-Type: application/json');

    $methodError = $this->ensureMethod('PUT');
    if ($methodError !== null) return $methodError;

    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) return $errorResponse;

    $store_id = (int) $user->id;

    $input = json_decode(file_get_contents("php://input"), true);

    if (empty($input['amc_id'])) {
        return $this->errorResponse('amc_id is required');
    }

    $amc_id = (int) $input['amc_id'];

    // ✅ Get existing AMC
    $existing = $this->db->get_where('amc_customer', [
        'id' => $amc_id,
        'store_id' => $store_id
    ])->row();

    if (!$existing) {
        return $this->errorResponse('AMC not found');
    }

    $old_data = json_encode($existing);

    // ✅ Update fields
    $product_name = $input['product_name'] ?? $existing->product_name;
    $start_date   = isset($input['start_date']) ? date('Y-m-d', strtotime($input['start_date'])) : $existing->start_date;
    $end_date     = isset($input['end_date']) ? date('Y-m-d', strtotime($input['end_date'])) : $existing->end_date;
    $amc_amount   = $input['amc_amount'] ?? $existing->amc_amount;

    if ($end_date <= $start_date) {
        return $this->errorResponse('End date must be greater than start date');
    }

    // ✅ Status logic
    $start = new DateTime($start_date);
    $end   = new DateTime($end_date);
    $interval = $start->diff($end);
    $status = ($interval->y >= 1) ? 0 : 1;

    // ✅ Prevent duplicate
    $duplicate = $this->db->where('customer_id', $existing->customer_id)
        ->where('product_name', $product_name)
        ->where('status', 1)
        ->where('id !=', $amc_id)
        ->get('amc_customer')
        ->row();

    if ($duplicate) {
        return $this->errorResponse('Active AMC already exists for this product');
    }

    $update = [
        'product_name' => $product_name,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'amc_amount' => $amc_amount,
        'status' => $status
    ];

    $this->db->where('id', $amc_id)->update('amc_customer', $update);

    // ✅ Log
    $this->db->insert('amc_logs', [
        'amc_id' => $amc_id,
        'customer_id' => $existing->customer_id,
        'store_id' => $store_id,
        'action' => 'updated',
        'old_data' => $old_data,
        'new_data' => json_encode($update)
    ]);

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'AMC updated successfully'
        ]));
}

   public function delete_amc($amc_id = null)
{
    header('Content-Type: application/json');

    // ✅ Ensure DELETE method
    $methodError = $this->ensureMethod('DELETE');
    if ($methodError !== null) return $methodError;

    // ✅ Authenticate user
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) return $errorResponse;

    $store_id = (int) $user->id;

    // ✅ Validate amc_id from URL
    if (empty($amc_id) || !is_numeric($amc_id)) {
        return $this->errorResponse('Valid amc_id is required in URL');
    }

    $amc_id = (int) $amc_id;

    // ✅ Check if AMC exists for this store
    $existing = $this->db->get_where('amc_customer', [
        'id'       => $amc_id,
        'store_id' => $store_id
    ])->row();

    if (!$existing) {
        return $this->errorResponse('AMC not found');
    }

    // ✅ Log before delete
    $this->db->insert('amc_logs', [
        'amc_id'      => $amc_id,
        'customer_id'  => $existing->customer_id,
        'store_id'     => $store_id,
        'action'       => 'deleted',
        'old_data'     => json_encode($existing),
        'new_data'     => null
    ]);

    // ✅ Delete AMC record
    $this->db->where('id', $amc_id)->delete('amc_customer');

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'status'  => true,
            'code'    => 200,
            'message' => 'AMC deleted successfully',
            'data'    => [
                'amc_id' => $amc_id
            ]
        ]));
}
    public function customer_list()
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $search = trim((string) ($this->getRequestPayload()['search'] ?? ''));
        $pagination = $this->getPaginationParams();
        $buildCustomerQuery = function () use ($user, $search) {
            $this->db->from('customers');
            $this->db->where('store_id', (int) $user->id);

            if ($search !== '') {
                $this->db->group_start()
                    ->like('name', $search)
                    ->or_like('mobile', $search)
                    ->or_like('address', $search)
                    ->group_end();
            }

            return $this->db;
        };
        $totalCustomers = (int) $buildCustomerQuery()->count_all_results();
        $meta = $this->buildPaginationMeta($totalCustomers, $pagination, [
            'store_id' => (int) $user->id,
            'search' => $search,
        ]);

        $customers = $buildCustomerQuery()
            ->order_by('id', 'DESC')
            ->limit($meta['per_page'], ($meta['page'] - 1) * $meta['per_page'])
            ->get()
            ->result();

        $data = array_map(function ($customer) {
            return $this->buildCustomerPayload($customer);
        }, $customers);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Customers fetched successfully.',
            'data' => $data,
            'total' => $meta['total'],
            'meta' => $meta,
        ]);
    }

    public function customer_details($id = 0)
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getCustomerRequestData();
        $customerId = (int) ($id > 0 ? $id : $request['id']);

        if ($customerId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Customer id is required.',
            ]);
            return;
        }

        $customer = $this->getCustomerById($customerId, (int) $user->id);

        if (!$customer) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Customer not found.',
            ]);
            return;
        }

        $pagination = $this->getPaginationParams();
        $buildOrderQuery = function () use ($customerId, $user) {
            return $this->db
                ->select('id, product_name, product_modal, date_of_purchase, price, payment_type, created_at')
                ->from('orders')
                ->where('customer_id', $customerId)
                ->where('store_id', (int) $user->id);
        };
        $totalOrders = (int) $buildOrderQuery()->count_all_results();
        $ordersMeta = $this->buildPaginationMeta($totalOrders, $pagination, [
            'customer_id' => $customerId,
        ]);

        $orders = $buildOrderQuery()
            ->order_by('id', 'DESC')
            ->limit($ordersMeta['per_page'], ($ordersMeta['page'] - 1) * $ordersMeta['per_page'])
            ->get()
            ->result();

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Customer details fetched successfully.',
            'data' => $this->buildCustomerPayload($customer),
            'orders' => array_map(function ($order) {
                return [
                    'id' => (int) $order->id,
                    'product_name' => isset($order->product_name) ? (string) $order->product_name : '',
                    'product_modal' => isset($order->product_modal) ? (string) $order->product_modal : '',
                    'date_of_purchase' => isset($order->date_of_purchase) ? (string) $order->date_of_purchase : null,
                    'price' => isset($order->price) ? (float) $order->price : 0,
                    'payment_type' => isset($order->payment_type) ? (int) $order->payment_type : 0,
                    'created_at' => isset($order->created_at) ? (string) $order->created_at : null,
                ];
            }, $orders),
            'orders_meta' => $ordersMeta,
        ]);
    }

   public function service_list()
{
    header('Content-Type: application/json');

    $methodError = $this->ensureMethod('GET');
    if ($methodError !== null) return $methodError;

    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) return $errorResponse;

    $store_id = (int) $user->id;
    $status   = $this->input->get('status');        // 'pending' or 'completed'
    $month    = trim($this->input->get('month') ?? '');
    $year     = $this->input->get('year');
    $page     = max(1, (int) ($this->input->get('page') ?? 1));
    $per_page = 10;
    $offset   = ($page - 1) * $per_page;

    // ✅ Default to current year/month
    $year        = !empty($year) ? (int) $year : (int) date('Y');
    $monthNumber = !empty($month) ? (int) date('m', strtotime("1 $month")) : (int) date('m');

    // Handle numeric month input (1-12)
    if (!empty($month) && is_numeric($month)) {
        $monthNumber = max(1, min(12, (int) $month));
    }

    // ✅ Convert status string to DB value
    $statusValue = null;
    if ($status === 'completed') {
        $statusValue = 1;
    } elseif ($status === 'pending') {
        $statusValue = 0;
    }

    // ✅ Get counts for this month (single query)
    $counts = $this->db
        ->select('
            COUNT(*) AS total_services,
            SUM(CASE WHEN service_log.status = 0 THEN 1 ELSE 0 END) AS pending_services,
            SUM(CASE WHEN service_log.status = 1 THEN 1 ELSE 0 END) AS completed_services
        ')
        ->from('service_log')
        ->join('orders', 'orders.id = service_log.order_id', 'left')
        ->where('orders.store_id', $store_id)
        ->where('YEAR(service_log.service_date)', $year)
        ->where('MONTH(service_log.service_date)', $monthNumber)
        ->get()
        ->row();

    // ✅ Filtered count
    $this->db
        ->from('service_log')
        ->join('orders', 'orders.id = service_log.order_id', 'left')
        ->join('customers', 'customers.id = service_log.customer_id', 'left')
        ->where('orders.store_id', $store_id)
        ->where('YEAR(service_log.service_date)', $year)
        ->where('MONTH(service_log.service_date)', $monthNumber);

    if ($statusValue !== null) {
        $this->db->where('service_log.status', $statusValue);
    }

    $total = (int) $this->db->count_all_results();

    // ✅ Fetch data
    $this->db
        ->select('
            service_log.*,
            customers.name AS customer_name,
            customers.mobile AS customer_mobile,
            customers.address AS customer_address,
            orders.product_name,
            orders.product_modal,
            orders.price,
            orders.date_of_purchase,
            orders.service_interval,
            orders.total_services
        ')
        ->from('service_log')
        ->join('orders', 'orders.id = service_log.order_id', 'left')
        ->join('customers', 'customers.id = service_log.customer_id', 'left')
        ->where('orders.store_id', $store_id)
        ->where('YEAR(service_log.service_date)', $year)
        ->where('MONTH(service_log.service_date)', $monthNumber);

    if ($statusValue !== null) {
        $this->db->where('service_log.status', $statusValue);
    }

    $services = $this->db
        ->order_by('service_log.service_date', 'DESC')
        ->order_by('service_log.service_number', 'DESC')
        ->limit($per_page, $offset)
        ->get()
        ->result();

    // ✅ Format response
    $data = array_map(function ($service) {
        return $this->buildServicePayload($service);
    }, $services);

    $totalPages = max(1, (int) ceil($total / $per_page));

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'code'                => 200,
            'status'              => true,
            'message'             => 'Services fetched successfully.',
            'total_services'      => (int) ($counts->total_services ?? 0),
            'pending_services'    => (int) ($counts->pending_services ?? 0),
            'completed_services'  => (int) ($counts->completed_services ?? 0),
            'month'               => date('F', strtotime("$year-$monthNumber-01")),
            'year'                => $year,
            'data'                => $data,
            'meta'                => [
                'total'        => $total,
                'per_page'     => $per_page,
                'current_page' => $page,
                'total_pages'  => $totalPages,
                'has_next'     => $page < $totalPages,
                'has_prev'     => $page > 1,
            ],
        ]));
}
    public function service_notification_cron()
{
    $today = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day'));

    // =========================
    // ✅ TODAY SERVICE
    // =========================
    $todayServices = $this->db
        ->select('service_log.*, customers.name as customer_name, orders.product_name, orders.store_id')
        ->from('service_log')
        ->join('orders', 'orders.id = service_log.order_id')
        ->join('customers', 'customers.id = service_log.customer_id')
        ->where('service_log.service_date', $today)
        ->where('service_log.notify_today', 0)
        ->get()
        ->result();

    foreach ($todayServices as $service) {

        $title = 'Service Due Today';
        $message = "Today is {$service->service_number} service of {$service->customer_name} ({$service->product_name})";

        // ✅ insert notification
        $this->db->insert('notifications', [
            'store_id' => $service->store_id,
            'type' => 'service',
            'title' => $title,
            'message' => $message,
            'reference_id' => $service->id,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $notification_id = $this->db->insert_id();

        // ✅ push
        // $this->send_expo_push(
        //     $service->store_id,
        //     $title,
        //     $message,
        //     [
        //         'type' => 'service',
        //         'service_id' => $service->id,
        //         'notification_id' => $notification_id
        //     ]
        // );

        // ✅ mark sent
        $this->db->where('id', $service->id)
                 ->update('service_log', ['notify_today' => 1]);
    }

    // =========================
    // ✅ TOMORROW SERVICE
    // =========================
    $tomorrowServices = $this->db
        ->select('service_log.*, customers.name as customer_name, orders.product_name, orders.store_id')
        ->from('service_log')
        ->join('orders', 'orders.id = service_log.order_id')
        ->join('customers', 'customers.id = service_log.customer_id')
        ->where('service_log.service_date', $tomorrow)
        ->where('service_log.notify_tomorrow', 0)
        ->get()
        ->result();

    foreach ($tomorrowServices as $service) {

        $title = 'Upcoming Service Tomorrow';
        $message = "Tomorrow is {$service->service_number} service of {$service->customer_name} ({$service->product_name})";

        $this->db->insert('notifications', [
            'store_id' => $service->store_id,
            'type' => 'service',
            'title' => $title,
            'message' => $message,
            'reference_id' => $service->id,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $notification_id = $this->db->insert_id();

        $this->send_expo_push(
            $service->store_id,
            $title,
            $message,
            [
                'type' => 'service',
                'service_id' => $service->id,
                'notification_id' => $notification_id
            ]
        );

        $this->db->where('id', $service->id)
                 ->update('service_log', ['notify_tomorrow' => 1]);
    }

    echo "Cron executed successfully";
}

    public function service_details($id = 0)
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getServiceRequestData();
        $serviceId = (int) ($id > 0 ? $id : $request['id']);

        if ($serviceId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Service id is required.',
            ]);
            return;
        }

        $service = $this->getServiceById($serviceId, (int) $user->id);

        if (!$service) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Service not found.',
            ]);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'status' => true,
            'message' => 'Service details fetched successfully.',
            'data' => $this->buildServicePayload($service),
        ]);
    }

    public function update_service($id = 0)
    {
        $methodError = $this->ensureMethod('PUT');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getServiceRequestData();
        $serviceId = (int) ($id > 0 ? $id : $request['id']);

        if ($serviceId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Service id is required.',
            ]);
            return;
        }

        $service = $this->getServiceById($serviceId, (int) $user->id);

        if (!$service) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Service not found.',
            ]);
            return;
        }

        if ($request['status'] === null) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Status is required.',
            ]);
            return;
        }

        if (!in_array((int) $request['status'], [0, 1], true)) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Service status must be 0 or 1.',
            ]);
            return;
        }

        $this->db->where('id', $serviceId)->update('service_log', [
            'status' => (int) $request['status'],
            'update_at' => date('Y-m-d'),
        ]);
        $updatedService = $this->getServiceById($serviceId, (int) $user->id);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Service status updated successfully.',
            'data' => $this->buildServicePayload($updatedService),
        ]);
    }

    public function add_custom_service()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getCustomServiceRequestData();

        if (
            $request['customer_name'] === '' ||
            $request['mobile'] === '' ||
            $request['address'] === '' ||
            $request['product_name'] === ''
        ) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Customer name, mobile, address and product name are required.',
            ]);
            return;
        }

        if (strlen($request['mobile']) < 10) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Please enter a valid mobile number.',
            ]);
            return;
        }

        if ($request['total_services'] <= 0 || $request['service_interval'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Total services and service interval must be greater than 0.',
            ]);
            return;
        }

        if (!$this->isValidDate($request['start_service_date'])) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Start service date must be in Y-m-d format.',
            ]);
            return;
        }

        $customer = $this->getOwnedCustomerByMobile($request['mobile'], (int) $user->id);

        $this->db->trans_start();

        if ($customer) {
            $customerId = (int) $customer->id;
            $this->db
                ->where('id', $customerId)
                ->where('store_id', (int) $user->id)
                ->update('customers', [
                    'name' => $request['customer_name'],
                    'address' => $request['address'],
                ]);
        } else {
            $this->db->insert('customers', [
                'store_id' => (int) $user->id,
                'name' => $request['customer_name'],
                'mobile' => $request['mobile'],
                'address' => $request['address'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $customerId = (int) $this->db->insert_id();
        }

        $this->db->insert('orders', [
            'store_id' => (int) $user->id,
            'customer_id' => $customerId,
            'product_name' => $request['product_name'],
            'product_modal' => '',
            'date_of_purchase' => $request['start_service_date'],
            'price' => 0,
            'down_payment' => 0,
            'emi_amount' => 0,
            'emi_duration' => 0,
            'payment_type' => 0,
            'service_interval' => $request['service_interval'],
            'total_services' => $request['total_services'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $orderId = (int) $this->db->insert_id();

        $this->replaceServiceSchedule(
            $orderId,
            $customerId,
            $request['start_service_date'],
            $request['service_interval'],
            $request['total_services']
        );

        $this->db->trans_complete();

        $order = $this->getOrderById($orderId, (int) $user->id);
        $serviceLogs = $this->db
            ->where('order_id', $orderId)
            ->order_by('service_number', 'ASC')
            ->get('service_log')
            ->result();

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Custom service added successfully.',
            'data' => [
                'order' => $this->buildOrderPayload($order),
                'service_logs' => array_map(function ($service) {
                    return [
                        'id' => (int) $service->id,
                        'service_number' => (int) ($service->service_number ?? 0),
                        'service_date' => isset($service->service_date) ? (string) $service->service_date : null,
                        'status' => (int) ($service->status ?? 0),
                    ];
                }, $serviceLogs),
            ],
        ]);
    }

    public function edit_custom_service()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getCustomServiceRequestData();
        $orderId = (int) $request['order_id'];

        if ($orderId <= 0 && $request['service_id'] > 0) {
            $orderId = $this->getOrderIdFromServiceId($request['service_id'], (int) $user->id);
        }

        if ($orderId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Order id or service id is required.',
            ]);
            return;
        }

        $order = $this->getOwnedOrder($orderId, (int) $user->id);

        if (!$order) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Custom service order not found.',
            ]);
            return;
        }

        if (
            $request['customer_name'] === '' ||
            $request['mobile'] === '' ||
            $request['address'] === '' ||
            $request['product_name'] === ''
        ) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Customer name, mobile, address and product name are required.',
            ]);
            return;
        }

        if (strlen($request['mobile']) < 10) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Please enter a valid mobile number.',
            ]);
            return;
        }

        if ($request['total_services'] <= 0 || $request['service_interval'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Total services and service interval must be greater than 0.',
            ]);
            return;
        }

        if (!$this->isValidDate($request['start_service_date'])) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Start service date must be in Y-m-d format.',
            ]);
            return;
        }

        $customer = $this->getOwnedCustomerByMobile($request['mobile'], (int) $user->id);
        $customerId = (int) $order->customer_id;

        $this->db->trans_start();

        if ($customer && (int) $customer->id !== $customerId) {
            $customerId = (int) $customer->id;
            $this->db
                ->where('id', $customerId)
                ->where('store_id', (int) $user->id)
                ->update('customers', [
                    'name' => $request['customer_name'],
                    'address' => $request['address'],
                ]);
        } else {
            $this->db
                ->where('id', (int) $order->customer_id)
                ->where('store_id', (int) $user->id)
                ->update('customers', [
                    'name' => $request['customer_name'],
                    'mobile' => $request['mobile'],
                    'address' => $request['address'],
                ]);
        }

        $this->db
            ->where('id', $orderId)
            ->where('store_id', (int) $user->id)
            ->update('orders', [
                'customer_id' => $customerId,
                'product_name' => $request['product_name'],
                'date_of_purchase' => $request['start_service_date'],
                'service_interval' => $request['service_interval'],
                'total_services' => $request['total_services'],
            ]);

        $this->replaceServiceSchedule(
            $orderId,
            $customerId,
            $request['start_service_date'],
            $request['service_interval'],
            $request['total_services']
        );

        $this->db->trans_complete();

        $updatedOrder = $this->getOrderById($orderId, (int) $user->id);
        $serviceLogs = $this->db
            ->where('order_id', $orderId)
            ->order_by('service_number', 'ASC')
            ->get('service_log')
            ->result();

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Custom service updated successfully.',
            'data' => [
                'order' => $this->buildOrderPayload($updatedOrder),
                'service_logs' => array_map(function ($service) {
                    return [
                        'id' => (int) $service->id,
                        'service_number' => (int) ($service->service_number ?? 0),
                        'service_date' => isset($service->service_date) ? (string) $service->service_date : null,
                        'status' => (int) ($service->status ?? 0),
                    ];
                }, $serviceLogs),
            ],
        ]);
    }

 public function emi_list()
{
    header('Content-Type: application/json');

    $methodError = $this->ensureMethod('GET');
    if ($methodError !== null) return $methodError;

    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) return $errorResponse;

    $store_id = (int) $user->id;
    $status   = $this->input->get('status');        // 'paid' or 'pending'
    $month    = trim($this->input->get('month') ?? '');
    $year     = $this->input->get('year');
    $page     = max(1, (int) ($this->input->get('page') ?? 1));
    $per_page = 10;
    $offset   = ($page - 1) * $per_page;

    // ✅ Default to current year/month if not passed
    $year        = !empty($year) ? (int) $year : (int) date('Y');
    $monthNumber = !empty($month) ? (int) date('m', strtotime("1 $month")) : (int) date('m');

    // Handle numeric month input (1-12)
    if (!empty($month) && is_numeric($month)) {
        $monthNumber = max(1, min(12, (int) $month));
    }

    // ✅ Date range
    $startDate = date('Y-m-01', strtotime("$year-$monthNumber-01"));
    $endDate   = date('Y-m-t', strtotime($startDate));

    // ✅ Convert status string to DB value
    $statusValue = null;
    if ($status === 'paid') {
        $statusValue = 1;
    } elseif ($status === 'pending') {
        $statusValue = 0;
    }

    // ✅ Get counts for this month (single query)
    $counts = $this->db
        ->select('
            COUNT(*) AS total_emi,
            SUM(CASE WHEN emi_logs.status = 0 THEN 1 ELSE 0 END) AS pending_emi,
            SUM(CASE WHEN emi_logs.status = 1 THEN 1 ELSE 0 END) AS paid_emi
        ')
        ->from('emi_logs')
        ->join('orders', 'orders.id = emi_logs.order_id', 'left')
        ->where('orders.store_id', $store_id)
        ->where('emi_logs.emi_date >=', $startDate)
        ->where('emi_logs.emi_date <=', $endDate)
        ->get()
        ->row();

    // ✅ Filtered count
    $this->db
        ->from('emi_logs')
        ->join('orders', 'orders.id = emi_logs.order_id', 'left')
        ->join('customers', 'customers.id = emi_logs.customer_id', 'left')
        ->where('orders.store_id', $store_id)
        ->where('emi_logs.emi_date >=', $startDate)
        ->where('emi_logs.emi_date <=', $endDate);

    if ($statusValue !== null) {
        $this->db->where('emi_logs.status', $statusValue);
    }

    $total = (int) $this->db->count_all_results();

    // ✅ Fetch data
    $this->db
        ->select('
            emi_logs.id,
            customers.name AS customer_name,
            orders.product_name,
            orders.emi_amount,
            orders.emi_duration,
            emi_logs.emi_number,
            emi_logs.emi_date,
            emi_logs.status
        ')
        ->from('emi_logs')
        ->join('orders', 'orders.id = emi_logs.order_id', 'left')
        ->join('customers', 'customers.id = emi_logs.customer_id', 'left')
        ->where('orders.store_id', $store_id)
        ->where('emi_logs.emi_date >=', $startDate)
        ->where('emi_logs.emi_date <=', $endDate);

    if ($statusValue !== null) {
        $this->db->where('emi_logs.status', $statusValue);
    }

    $emis = $this->db
        ->order_by('emi_logs.emi_date', 'ASC')
        ->order_by('emi_logs.emi_number', 'ASC')
        ->limit($per_page, $offset)
        ->get()
        ->result();

    // ✅ Format response
    $data = array_map(function ($emi) {
        return [
            'id'            => (int) $emi->id,
            'customer_name' => $emi->customer_name ?? '',
            'product_name'  => $emi->product_name ?? '',
            'emi_amount'    => (float) $emi->emi_amount,
            'emi_duration'  => (int) $emi->emi_duration,
            'emi_number'    => (int) $emi->emi_number,
            'emi_date'      => $emi->emi_date,
            'status'        => (int) $emi->status,
            'status_label'  => ((int) $emi->status === 1) ? 'Paid' : 'Pending',
        ];
    }, $emis);

    $totalPages = max(1, (int) ceil($total / $per_page));

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'code'         => 200,
            'status'       => true,
            'message'      => 'EMI records fetched successfully.',
            'total_emi'    => (int) ($counts->total_emi ?? 0),
            'pending_emi'  => (int) ($counts->pending_emi ?? 0),
            'paid_emi'     => (int) ($counts->paid_emi ?? 0),
            'month'        => date('F', strtotime($startDate)),
            'year'         => $year,
            'data'         => $data,
            'meta'         => [
                'total'        => $total,
                'per_page'     => $per_page,
                'current_page' => $page,
                'total_pages'  => $totalPages,
                'has_next'     => $page < $totalPages,
                'has_prev'     => $page > 1,
            ],
        ]));
}
public function emi_notification_cron()
{
    $today = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day'));

    log_message('error', "===== EMI CRON START =====");
    log_message('error', "Today: $today | Tomorrow: $tomorrow");

    // =========================
    // ✅ TODAY EMI
    // =========================
    log_message('error', "Checking TODAY EMI...");

    $todayEmi = $this->db
        ->select('emi_logs.*, customers.name as customer_name, orders.product_name, orders.store_id')
        ->from('emi_logs')
        ->join('orders', 'orders.id = emi_logs.order_id')
        ->join('customers', 'customers.id = emi_logs.customer_id')
        ->where('emi_logs.emi_date', $today)
        ->where('emi_logs.status', 0)
        ->where('emi_logs.notify_today', 0)
        ->get()
        ->result();

    log_message('error', "Total TODAY EMI found: " . count($todayEmi));

    foreach ($todayEmi as $emi) {

        log_message('error', "Processing TODAY EMI ID: {$emi->id} | Customer: {$emi->customer_name}");

        $title = 'EMI Due Today';
        $message = "Today EMI #{$emi->emi_number} of {$emi->customer_name} ({$emi->product_name}) is due";

        // Insert notification
        $this->db->insert('notifications', [
            'store_id' => $emi->store_id,
            'type' => 'emi',
            'title' => $title,
            'message' => $message,
            'reference_id' => $emi->id,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $notification_id = $this->db->insert_id();

        log_message('error', "Notification inserted ID: $notification_id");

        // Send push
        // $pushResult = $this->send_expo_push(
        //     $emi->store_id,
        //     $title,
        //     $message,
        //     [
        //         'type' => 'emi',
        //         'emi_id' => $emi->id,
        //         'notification_id' => $notification_id
        //     ]
        // );

        log_message('error', "Push sent for EMI ID {$emi->id} | Response: " . json_encode($pushResult));

        // Update flag
        $this->db->where('id', $emi->id)
                 ->update('emi_logs', ['notify_today' => 1]);

        log_message('error', "Marked notify_today = 1 for EMI ID: {$emi->id}");
    }

    // =========================
    // ✅ TOMORROW EMI
    // =========================
    log_message('error', "Checking TOMORROW EMI...");

    $tomorrowEmi = $this->db
        ->select('emi_logs.*, customers.name as customer_name, orders.product_name, orders.store_id')
        ->from('emi_logs')
        ->join('orders', 'orders.id = emi_logs.order_id')
        ->join('customers', 'customers.id = emi_logs.customer_id')
        ->where('emi_logs.emi_date', $tomorrow)
        ->where('emi_logs.status', 0)
        ->where('emi_logs.notify_tomorrow', 0)
        ->get()
        ->result();

    log_message('error', "Total TOMORROW EMI found: " . count($tomorrowEmi));

    foreach ($tomorrowEmi as $emi) {

        log_message('error', "Processing TOMORROW EMI ID: {$emi->id} | Customer: {$emi->customer_name}");

        $title = 'Upcoming EMI Tomorrow';
        $message = "Tomorrow EMI #{$emi->emi_number} of {$emi->customer_name} ({$emi->product_name})";

        $this->db->insert('notifications', [
            'store_id' => $emi->store_id,
            'type' => 'emi',
            'title' => $title,
            'message' => $message,
            'reference_id' => $emi->id,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $notification_id = $this->db->insert_id();

        log_message('error', "Notification inserted ID: $notification_id");

        $pushResult = $this->send_expo_push(
            $emi->store_id,
            $title,
            $message,
            [
                'type' => 'emi',
                'emi_id' => $emi->id,
                'notification_id' => $notification_id
            ]
        );

        log_message('error', "Push sent for EMI ID {$emi->id} | Response: " . json_encode($pushResult));

        $this->db->where('id', $emi->id)
                 ->update('emi_logs', ['notify_tomorrow' => 1]);

        log_message('error', "Marked notify_tomorrow = 1 for EMI ID: {$emi->id}");
    }

    log_message('error', "===== EMI CRON END =====");

    echo "EMI Cron Done";
}

    public function emi_details($id = 0)
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getEmiRequestData();
        $emiId = (int) ($id > 0 ? $id : $request['id']);

        if ($emiId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'EMI id is required.',
            ]);
            return;
        }

        $emi = $this->getEmiById($emiId, (int) $user->id);
        

        if (!$emi) {
            $emiRecord = $this->getEmiById($emiId);

            if ($emiRecord) {
                http_response_code(400);
                echo json_encode([
                    'code' => 400,

                    'status' => false,
                    'message' => 'This EMI record belongs to another account.',
                    'requested_emi_id' => $emiId,
                    'order_id' => isset($emiRecord->order_id) ? (int) $emiRecord->order_id : 0,
                ]);
                return;
            }

            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'EMI record not found.',
            ]);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'EMI details fetched successfully.',
            'data' => $this->buildEmiPayload($emi),
        ]);
    }

    public function update_emi($id = 0)
    {
        $methodError = $this->ensureMethod('PUT');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getEmiRequestData();
        $emiId = (int) ($id > 0 ? $id : $request['id']);

        if ($emiId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'EMI id is required.',
            ]);
            return;
        }

        $emi = $this->getEmiById($emiId, (int) $user->id);

        if (!$emi) {
            $emiRecord = $this->getEmiById($emiId);

            if ($emiRecord) {
                http_response_code(400);
                echo json_encode([
                    'code' => 400,

                    'status' => false,
                    'message' => 'You are not allowed to update this EMI record.',
                    'requested_emi_id' => $emiId,
                    'order_id' => isset($emiRecord->order_id) ? (int) $emiRecord->order_id : 0,
                ]);
                return;
            }

            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'EMI record not found.',
            ]);
            return;
        }

        if ($request['status'] === null) {
            http_response_code(400);
            echo json_encode([
                'status' => false,
                'code' => 400,

                'message' => 'Status is required.',
            ]);
            return;
        }

        if (!in_array((int) $request['status'], [0, 1], true)) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'EMI status must be 0 or 1.',
            ]);
            return;
        }

        $this->db->where('id', $emiId)->update('emi_logs', [
            'status' => (int) $request['status'],
            'update_at' => date('Y-m-d'),
        ]);
        $updatedEmi = $this->getEmiById($emiId, (int) $user->id);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'EMI status updated successfully.',
            'data' => $this->buildEmiPayload($updatedEmi),
        ]);
    }

    public function edit_customer($id = 0)
    {
        $methodError = $this->ensureMethod('PUT');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getCustomerRequestData();
        $customerId = (int) ($id > 0 ? $id : $request['id']);

        if ($customerId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Customer id is required.',
            ]);
            return;
        }

        if ($request['name'] === '' || $request['mobile'] === '') {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Customer name and mobile are required.',
            ]);
            return;
        }

        if (strlen($request['mobile']) < 10) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Please enter a valid mobile number.',
            ]);
            return;
        }

        $customer = $this->getOwnedCustomer($customerId, (int) $user->id);

        if (!$customer) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Customer not found.',
            ]);
            return;
        }

        $mobileExists = $this->db
            ->where('mobile', $request['mobile'])
            ->where('store_id', (int) $user->id)
            ->where('id !=', $customerId)
            ->count_all_results('customers');

        if ($mobileExists > 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'This mobile number is already used by another customer.',
            ]);
            return;
        }

        $this->db
            ->where('id', $customerId)
            ->where('store_id', (int) $user->id)
            ->update('customers', [
                'name' => $request['name'],
                'mobile' => $request['mobile'],
                'address' => $request['address'],
            ]);

        $updatedCustomer = $this->getOwnedCustomer($customerId, (int) $user->id);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Customer updated successfully.',
            'data' => $this->buildCustomerPayload($updatedCustomer),
        ]);
    }

    public function delete_customer($id = 0)
    {
        $methodError = $this->ensureMethod('DELETE');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getCustomerRequestData();
        $customerId = (int) ($id > 0 ? $id : $request['id']);

        if ($customerId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Customer id is required.',
            ]);
            return;
        }

        $customer = $this->getOwnedCustomer($customerId, (int) $user->id);

        if (!$customer) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Customer not found.',
            ]);
            return;
        }

        $orderIds = $this->db
            ->select('id')
            ->where('customer_id', $customerId)
            ->where('store_id', (int) $user->id)
            ->get('orders')
            ->result();

        $this->db->trans_start();

        if (!empty($orderIds)) {
            $orderIds = array_map(function ($order) {
                return (int) $order->id;
            }, $orderIds);

            $this->db->where_in('order_id', $orderIds)->delete('emi_logs');
            $this->db->where_in('order_id', $orderIds)->delete('service_log');
        }

        $this->db
            ->where('customer_id', $customerId)
            ->where('store_id', (int) $user->id)
            ->delete('orders');

        $this->db
            ->where('id', $customerId)
            ->where('store_id', (int) $user->id)
            ->delete('customers');

        $this->db->trans_complete();

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Customer deleted successfully.',
            'data' => [
                'id' => $customerId,
                'name' => (string) ($customer->name ?? ''),
                'mobile' => (string) ($customer->mobile ?? ''),
            ],
        ]);
    }

    public function edit_order($id = 0)
    {
        $methodError = $this->ensureMethod('PUT');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getOrderRequestData();
        $orderId = (int) ($id > 0 ? $id : $request['id']);

        if ($orderId <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Order id is required.',
            ]);
            return;
        }

        $order = $this->getOwnedOrder($orderId, (int) $user->id);

        if (!$order) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Order not found.',
            ]);
            return;
        }

        $productName = $request['product_name'];
        $productModal = $request['product_modal'];
        $purchaseDate = $request['date_of_purchase'];
        $price = (float) $request['price'];
        $downPayment = (float) ($request['down_payment'] === '' ? 0 : $request['down_payment']);
        $paymentType = $this->normalizePaymentType($request['payment_type'] === '' ? $order->payment_type : $request['payment_type']);
        $serviceInterval = max(0, (int) $request['service_interval']);
        $totalServices = max(0, (int) $request['total_services']);
        $emiMonths = max(0, (int) $request['emi_month']);

        if ($productName === '' || $purchaseDate === '' || $request['price'] === '') {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Product name, purchase date and price are required.',
            ]);
            return;
        }

        if (!$this->isValidDate($purchaseDate)) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Purchase date must be in Y-m-d format.',
            ]);
            return;
        }

        if ($price <= 0) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Price must be greater than 0.',
            ]);
            return;
        }

        if ($downPayment < 0 || $downPayment > $price) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Down payment must be between 0 and order price.',
            ]);
            return;
        }

        if ($paymentType === 1) {
            if ($emiMonths <= 0) {
                http_response_code(400);
                echo json_encode([
                    'code' => 400,

                    'status' => false,
                    'message' => 'EMI duration is required for EMI orders.',
                ]);
                return;
            }
        }

        $emiAmount = $paymentType === 1 && $emiMonths > 0 ? (($price - $downPayment) / $emiMonths) : 0;

        $this->db
            ->where('id', $orderId)
            ->where('store_id', (int) $user->id)
            ->update('orders', [
                'product_name' => $productName,
                'product_modal' => $productModal,
                'date_of_purchase' => $purchaseDate,
                'price' => $price,
                'down_payment' => $downPayment,
                'emi_amount' => $emiAmount,
                'emi_duration' => $paymentType === 1 ? $emiMonths : 0,
                'payment_type' => $paymentType,
                'service_interval' => $serviceInterval,
                'total_services' => $totalServices,
            ]);

        $updatedOrder = $this->getOrderById($orderId, (int) $user->id);

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Order updated successfully.',
            'data' => $this->buildOrderPayload($updatedOrder),
        ]);
    }

    public function add_order()
{
    $methodError = $this->ensureMethod('POST');
    if ($methodError !== null) return $methodError;

    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) return $errorResponse;

    $request = $this->getOrderRequestData();
    $paymentType = $this->normalizePaymentType($request['payment_type']);
    $price = (float) $request['price'];
    $downPayment = (float) ($request['down_payment'] === '' ? 0 : $request['down_payment']);
    $emiMonths = max(0, (int) $request['emi_month']);
    $serviceInterval = max(0, (int) $request['service_interval']);
    $totalServices = max(0, (int) $request['total_services']);
    $emi_date = max(0, (int) $request['emi_date']);

    // ── Required fields ──────────────────────────────────────────
    if ($request['product_name'] === '' || $request['customer_mobile'] === '' ||
        $request['date_of_purchase'] === '' || $request['price'] === '') {
        http_response_code(400);
        echo json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Customer mobile, product name, purchase date and price are required.',
        ]);
        return;
    }

    if (!$this->isValidDate($request['date_of_purchase'])) {
        http_response_code(400);
        echo json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Purchase date must be in Y-m-d format.',
        ]);
        return;
    }

    if (!empty($request['start_service_date']) && !$this->isValidDate($request['start_service_date'])) {
        http_response_code(400);
        echo json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Start service date must be in Y-m-d format.',
        ]);
        return;
    }

    if (strlen($request['customer_mobile']) < 10) {
        http_response_code(400);
        echo json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Please enter a valid customer mobile number.',
        ]);
        return;
    }

    if ($price <= 0) {
        http_response_code(400);
        echo json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Price must be greater than 0.',
        ]);
        return;
    }

    if ($downPayment < 0 || $downPayment > $price) {
        http_response_code(400);
        echo json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Down payment must be between 0 and order price.',
        ]);
        return;
    }

    // ── EMI validation ────────────────────────────────────────────
    if ($paymentType === 1) {
        if ($emiMonths <= 0 || $request['emi_date'] === '') {
            http_response_code(400);
            echo json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'EMI month and EMI date are required for EMI orders.',
            ]);
            return;
        }

        if (!$this->isValidDate($request['emi_date'])) {
            http_response_code(400);
            echo json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'EMI date must be in Y-m-d format.',
            ]);
            return;
        }
    }

    // ── Customer handling ─────────────────────────────────────────
    $customerId = (int) $request['customer_id'];
    $customer   = null;

    if ($customerId > 0) {
        $customer = $this->getOwnedCustomer($customerId, (int) $user->id);

        if (!$customer) {
            http_response_code(400);
            echo json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Customer not found.',
            ]);
            return;
        }
    } else {
        $customer = $this->db
            ->where('mobile', $request['customer_mobile'])
            ->where('store_id', (int) $user->id)
            ->get('customers')
            ->row();

        if (!$customer) {
            if ($request['customer_name'] === '') {
                http_response_code(400);
                echo json_encode([
                    'code'    => 400,
                    'status'  => false,
                    'message' => 'Customer name is required when customer_id is not provided.',
                ]);
                return;
            }

            $this->db->insert('customers', [
                'store_id' => (int) $user->id,
                'name'     => $request['customer_name'],
                'mobile'   => $request['customer_mobile'],
                'address'  => $request['address'],
            ]);

            $customerId = (int) $this->db->insert_id();
            $customer   = $this->getOwnedCustomer($customerId, (int) $user->id);
        } else {
            $customerId = (int) $customer->id;
        }
    }

    // ── EMI amount ────────────────────────────────────────────────
    $emiAmount = ($paymentType === 1 && $emiMonths > 0)
        ? round(($price - $downPayment) / $emiMonths, 2)
        : 0;

    // ── Service start date ────────────────────────────────────────
    // If provided → use it as service 1
    // If empty    → purchase_date + service_interval months
    $startServiceDate = (!empty($request['start_service_date']))
        ? $request['start_service_date']
        : date('Y-m-d', strtotime('+' . $serviceInterval . ' month', strtotime($request['date_of_purchase'])));

    $this->db->trans_start();

    // ── Insert order ──────────────────────────────────────────────
    $this->db->insert('orders', [
        'store_id'           => (int) $user->id,
        'customer_id'        => $customerId,
        'product_name'       => $request['product_name'],
        'product_modal'      => $request['product_modal'],
        'date_of_purchase'   => $request['date_of_purchase'],
        'price'              => $price,
        'down_payment'       => $downPayment,
        'emi_amount'         => $emiAmount,
        'emi_duration'       => $emiMonths,
        'payment_type'       => $paymentType,
        'service_interval'   => $serviceInterval,
        'total_services'     => $totalServices,
'emi_date'           => !empty($request['emi_date']) 
                                ? $request['emi_date'] 
                                : null,
        
    ]);

    $orderId = (int) $this->db->insert_id();

    // ── Service log ───────────────────────────────────────────────
    // Service 1 = start_service_date
    // Service N = start_service_date + (service_interval * (N-1)) months
    for ($i = 1; $i <= $totalServices; $i++) {
        $serviceDate = date(
            'Y-m-d',
            strtotime('+' . ($serviceInterval * ($i - 1)) . ' month', strtotime($startServiceDate))
        );

        $this->db->insert('service_log', [
            'order_id'        => $orderId,
            'customer_id'     => $customerId,
            'service_number'  => $i,
            'assign_to'       => 0,
            'status'          => 0,
            'customer_status' => 0,
            'service_date'    => $serviceDate,
            'created_at'      => date('Y-m-d H:i:s'),
        ]);
    }

    // ── EMI log ───────────────────────────────────────────────────
    if ($paymentType === 1) {
        for ($i = 1; $i <= $emiMonths; $i++) {
            $this->db->insert('emi_logs', [
                'order_id'        => $orderId,
                'customer_id'     => $customerId,
                'emi_number'      => $i,
                'status'          => 0,
                'status_customer' => 0,
                'emi_date'        => date(
                    'Y-m-d',
                    strtotime('+' . ($i - 1) . ' month', strtotime($request['emi_date']))
                ),
                'created_at'      => date('Y-m-d H:i:s'),
            ]);
        }
    }

    $this->db->trans_complete();


   $order    = $this->getOrderById($orderId, (int) $user->id);
$store    = $user;
$customer = $this->getOwnedCustomer($customerId, (int) $user->id);

// ── Send WhatsApp bill ────────────────────────────────────────
$whatsappSent  = false;
$whatsappError = null;

try {
    log_message('info', '[WA] Starting WhatsApp bill for order #' . $orderId);

    // Step 1 — Generate PDF
    log_message('info', '[WA] Generating PDF...');
    $pdfPath = $this->generateBillPDF($order, $store, $customer);
    log_message('info', '[WA] PDF generated at: ' . $pdfPath);

    // Step 2 — Check file exists and has size
    if (!file_exists($pdfPath)) {
        throw new Exception('PDF file not found at path: ' . $pdfPath);
    }
    log_message('info', '[WA] PDF size: ' . filesize($pdfPath) . ' bytes');

    // Step 3 — Upload to Meta
    log_message('info', '[WA] Uploading PDF to Meta...');
    $uploadResult = $this->uploadPDFToWhatsApp($pdfPath);
    log_message('info', '[WA] Upload result: ' . json_encode($uploadResult));

    $mediaId = $uploadResult['media_id'] ?? null;
    $uploadError = $uploadResult['error'] ?? null;

    if ($uploadError) {
        throw new Exception('Meta upload error: ' . json_encode($uploadError));
    }

    if (!$mediaId) {
        throw new Exception('No media_id returned from Meta. Full response: ' . json_encode($uploadResult));
    }

    log_message('info', '[WA] Media ID: ' . $mediaId);

    // Step 4 — Send WhatsApp message
    log_message('info', '[WA] Sending WhatsApp message to: ' . $customer->mobile);
    $sendResult = $this->sendWhatsAppBill($customer->mobile, $mediaId, $order, $customer, $store);
    log_message('info', '[WA] Send result: ' . json_encode($sendResult));

    if (isset($sendResult['error'])) {
        throw new Exception('Meta send error: ' . json_encode($sendResult['error']));
    }

    $whatsappSent = true;
    log_message('info', '[WA] WhatsApp bill sent successfully for order #' . $orderId);

    // Step 5 — Cleanup
    if (file_exists($pdfPath)) {
        unlink($pdfPath);
        log_message('info', '[WA] Temp PDF deleted.');
    }

} catch (Exception $e) {
    $whatsappError = $e->getMessage();
    log_message('error', '[WA] FAILED for order #' . $orderId . ': ' . $whatsappError);
}

http_response_code(200);
echo json_encode([
    'code'            => 200,
    'status'          => true,
    'message'         => 'Order added successfully.',
    'whatsapp_bill'   => $whatsappSent,
    'whatsapp_error'  => $whatsappError,  
    'data'            => $this->buildOrderPayload($order),
]);
}
private function generateBillPDF($order, $store, $customer)
{
    require_once APPPATH . '../vendor/tecnickcom/tcpdf/tcpdf.php';

    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // ── Page setup ────────────────────────────────────────────────
    $pdf->SetCreator('FilterBook');
    $pdf->SetAuthor($store->name);
    $pdf->SetTitle('Invoice #' . str_pad($order->id, 6, '0', STR_PAD_LEFT));
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(true, 15);
    $pdf->AddPage();

    // ── Store header ──────────────────────────────────────────────
    $pdf->SetFont('helvetica', 'B', 18);
    $pdf->Cell(0, 10, $store->name, 0, 1, 'C');

    $pdf->SetFont('helvetica', '', 10);
    if (!empty($store->address)) {
        $pdf->Cell(0, 6, $store->address, 0, 1, 'C');
    }
    $pdf->Cell(0, 6, 'Mobile: ' . $store->mobile, 0, 1, 'C');
    if (!empty($store->email)) {
        $pdf->Cell(0, 6, 'Email: ' . $store->email, 0, 1, 'C');
    }

    $pdf->Ln(3);
    $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
    $pdf->Ln(4);

    // ── Invoice title + meta ──────────────────────────────────────
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 8, 'INVOICE', 0, 1, 'C');

    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(95, 6, 'Invoice No: #' . str_pad($order->id, 6, '0', STR_PAD_LEFT), 0, 0, 'L');
    $pdf->Cell(95, 6, 'Date: ' . date('d-m-Y', strtotime($order->date_of_purchase)), 0, 1, 'R');

    $pdf->Ln(3);
    $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
    $pdf->Ln(4);

    // ── Customer details ──────────────────────────────────────────
    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->Cell(0, 7, 'Bill To:', 0, 1);

    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(0, 6, 'Name    : ' . $customer->name, 0, 1);
    $pdf->Cell(0, 6, 'Mobile  : ' . $customer->mobile, 0, 1);
    if (!empty($customer->address)) {
        $pdf->Cell(0, 6, 'Address : ' . $customer->address, 0, 1);
    }

    $pdf->Ln(3);
    $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
    $pdf->Ln(4);

    // ── Product table header ──────────────────────────────────────
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(90, 8, 'Product', 1, 0, 'L', true);
    $pdf->Cell(40, 8, 'Model', 1, 0, 'C', true);
    $pdf->Cell(45, 8, 'Price', 1, 1, 'R', true);

    // ── Product table row ─────────────────────────────────────────
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(90, 8, $order->product_name, 1, 0, 'L');
    $pdf->Cell(40, 8, !empty($order->product_modal) ? $order->product_modal : '-', 1, 0, 'C');
    $pdf->Cell(45, 8, 'Rs. ' . number_format($order->price, 2), 1, 1, 'R');

    $pdf->Ln(3);

    // ── Payment summary ───────────────────────────────────────────
    if ($order->payment_type == 1) {
        // EMI
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(130, 7, 'Down Payment:', 0, 0, 'R');
        $pdf->Cell(55, 7, 'Rs. ' . number_format($order->down_payment, 2), 0, 1, 'R');

        $pdf->Cell(130, 7, 'EMI Amount (x' . $order->emi_duration . ' months):', 0, 0, 'R');
        $pdf->Cell(55, 7, 'Rs. ' . number_format($order->emi_amount, 2) . '/mo', 0, 1, 'R');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(130, 7, 'Total Payable:', 0, 0, 'R');
        $pdf->Cell(55, 7, 'Rs. ' . number_format($order->price, 2), 0, 1, 'R');

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(130, 7, 'Payment Type:', 0, 0, 'R');
        $pdf->Cell(55, 7, 'EMI', 0, 1, 'R');
    } else {
        // Cash
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(130, 7, 'Total Amount:', 0, 0, 'R');
        $pdf->Cell(55, 7, 'Rs. ' . number_format($order->price, 2), 0, 1, 'R');

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(130, 7, 'Payment Type:', 0, 0, 'R');
        $pdf->Cell(55, 7, 'Cash', 0, 1, 'R');
    }

    // ── Service schedule ──────────────────────────────────────────
    if ($order->total_services > 0) {
        $pdf->Ln(4);
        $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
        $pdf->Ln(4);

        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(0, 7, 'Service Schedule:', 0, 1);

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(40, 7, 'Service #', 1, 0, 'C', true);
        $pdf->Cell(85, 7, 'Scheduled Date', 1, 0, 'C', true);
        $pdf->Cell(60, 7, 'Status', 1, 1, 'C', true);

        $serviceLogs = $this->db
            ->where('order_id', $order->id)
            ->order_by('service_number', 'ASC')
            ->get('service_log')
            ->result();

        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(255, 255, 255);
        foreach ($serviceLogs as $log) {
            $pdf->Cell(40, 7, 'Service ' . $log->service_number, 1, 0, 'C');
            $pdf->Cell(85, 7, date('d-m-Y', strtotime($log->service_date)), 1, 0, 'C');
            $pdf->Cell(60, 7, 'Scheduled', 1, 1, 'C');
        }
    }

    // ── Footer ────────────────────────────────────────────────────
    $pdf->Ln(8);
    $pdf->SetFont('helvetica', 'I', 9);
    $pdf->Cell(0, 6, 'Thank you for your purchase!', 0, 1, 'C');
    $pdf->Cell(0, 6, $store->name . ' | ' . $store->mobile, 0, 1, 'C');

    // ── Save to tmp ───────────────────────────────────────────────
    $fileName = 'bill_order_' . $order->id . '_' . time() . '.pdf';
    $filePath = sys_get_temp_dir() . '/' . $fileName;
    $pdf->Output($filePath, 'F');

    return $filePath;
}
private function uploadPDFToWhatsApp($filePath)
{
    $phoneNumberId = $this->config->item('whatsapp_phone_number_id');
    $accessToken   = $this->config->item('whatsapp_access_token');

    $url = 'https://graph.facebook.com/v19.0/' . $phoneNumberId . '/media';

    log_message('info', '[WA] Upload URL: ' . $url);
    log_message('info', '[WA] Phone Number ID: ' . $phoneNumberId);
    log_message('info', '[WA] Access Token (first 20 chars): ' . substr($accessToken, 0, 20) . '...');

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $accessToken,
        ],
        CURLOPT_POSTFIELDS => [
            'messaging_product' => 'whatsapp',
            'type'              => 'application/pdf',
            'file'              => new CURLFile($filePath, 'application/pdf', basename($filePath)),
        ],
    ]);

    $response = curl_exec($curl);
    $curlError = curl_error($curl);
    $httpCode  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    log_message('info', '[WA] Upload HTTP code: ' . $httpCode);
    log_message('info', '[WA] Upload raw response: ' . $response);

    if ($curlError) {
        log_message('error', '[WA] cURL error on upload: ' . $curlError);
        return ['media_id' => null, 'error' => $curlError];
    }

    $result = json_decode($response, true);

    return [
        'media_id' => $result['id'] ?? null,
        'error'    => $result['error'] ?? null,
    ];
}
private function sendWhatsAppBill($customerMobile, $mediaId, $order, $customer, $store)
{
    $phoneNumberId = $this->config->item('whatsapp_phone_number_id');
    $accessToken   = $this->config->item('whatsapp_access_token');

    $url = 'https://graph.facebook.com/v19.0/' . $phoneNumberId . '/messages';

    $mobile = '91' . ltrim($customerMobile, '0');

    log_message('info', '[WA] Sending to mobile: ' . $mobile);
    log_message('info', '[WA] Send URL: ' . $url);

    $body = [
        'messaging_product' => 'whatsapp',
        'to'                => $mobile,
        'type'              => 'document',
        'document'          => [
            'id'       => $mediaId,
            'filename' => 'Invoice_' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf',
            'caption'  =>
                'Hello ' . $customer->name . "!\n\n" .
                'Thank you for your purchase at *' . $store->name . '*.' . "\n" .
                'Please find your invoice attached.' . "\n\n" .
                '*Order Summary*' . "\n" .
                'Product  : ' . $order->product_name . "\n" .
                'Amount   : Rs. ' . number_format($order->price, 2) . "\n" .
                'Payment  : ' . ($order->payment_type == 1 ? 'EMI - Rs.' . number_format($order->emi_amount, 2) . '/mo' : 'Cash') . "\n\n" .
                $store->name . ' | ' . $store->mobile,
        ],
    ];

    log_message('info', '[WA] Send body: ' . json_encode($body));

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ],
        CURLOPT_POSTFIELDS => json_encode($body),
    ]);

    $response  = curl_exec($curl);
    $httpCode  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    log_message('info', '[WA] Send HTTP code: ' . $httpCode);
    log_message('info', '[WA] Send raw response: ' . $response);

    return json_decode($response, true);
}

    public function order_details($id = 0)
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $order = $this->getOrderById((int) $id, (int) $user->id);

        if (!$order) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Order not found.',
            ]);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'status' => true,
            'message' => 'Order details fetched successfully.',
            'data' => $this->buildOrderPayload($order),
        ]);
    }

    public function delete_order($id = 0)
    {
        $methodError = $this->ensureMethod('DELETE');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getOrderRequestData();
        $orderId = (int) ($id > 0 ? $id : $request['id']);

        if ($orderId <= 0) {
            http_response_code(400);
            echo json_encode([
                'status' => false,
                'message' => 'Order id is required.',
            ]);
            return;
        }

        $order = $this->getOrderById($orderId, (int) $user->id);

        if (!$order) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,

                'status' => false,
                'message' => 'Order not found.',
            ]);
            return;
        }

        $this->db->trans_start();

        $this->db->where('order_id', $orderId)->delete('emi_logs');
        $this->db->where('order_id', $orderId)->delete('service_log');
        $this->db->where('id', $orderId)->where('store_id', (int) $user->id)->delete('orders');

        $this->db->trans_complete();

        http_response_code(200);
        echo json_encode([
            'code' => 200,

            'status' => true,
            'message' => 'Order deleted successfully.',
            'data' => [
                'id' => $orderId,
                'customer_id' => (int) $order->customer_id,
                'customer_name' => (string) ($order->customer_name ?? ''),
                'product_name' => (string) ($order->product_name ?? ''),
            ],
        ]);
    }
    public function save_plan()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $data = $this->getRequestPayload();
        list($targetUser, $targetError) = $this->resolvePlanTargetUser($user);

        if ($targetError !== null) {
            return $targetError;
        }

        $planCode = trim((string) ($data['plan'] ?? $data['plan_code'] ?? ''));

        if ($planCode === '') {
            return $this->respond([
                'code' => 400,

                'status' => false,
                'message' => 'Plan is required.',
            ], 400);
        }

        $data['plan'] = $planCode;
        $data['plan_code'] = $planCode;

        $saved = $this->Plan_model->save_plan((int) $targetUser->id, $data);

        if (!$saved) {
            $blockMessage = $this->Plan_model->get_plan_change_block_message((int) $targetUser->id);

            return $this->respond([
                'status' => false,
                'message' => $blockMessage !== '' ? $blockMessage : 'Unable to save plan. Please provide a valid plan.',
            ], 422);
        }

        $summary = $this->Plan_model->get_plan_summary((int) $targetUser->id);

        return $this->respond([
            'status' => true,
            'message' => 'Plan saved successfully.',
            'data' => $this->buildPlanSummaryPayload($summary),
        ]);
    }

 public function get_plans()
{
    // ✅ Only allow GET
    $methodError = $this->ensureMethod('GET');

    if ($methodError !== null) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode($methodError));
    }

    // ✅ Auth check
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

    if ($errorResponse !== null) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode($errorResponse));
    }

    // ✅ User ID
    $userId = (int) $user->id;

    // ✅ Fetch plans
   // ✅ Fetch plans
$plans = $this->db
    ->select('
        id,
        code,
        name,
        duration_days,
        price
    ')
    ->from('plan_catalog')
    ->where('is_active', 1)

    // ✅ Hide free trial
    ->where('code !=', 'trial')

    ->order_by('price', 'ASC')
    ->get()
    ->result_array();

// ✅ Add plan features
if (!empty($plans)) {

    foreach ($plans as $key => $plan) {

        $code  = (string) $plan['code'];
        $price = (float) $plan['price'];
        $days  = (int) $plan['duration_days'];

        // ✅ Price label
        $plans[$key]['price_label'] = 'Rs ' . number_format($price, 0);

        // ✅ Duration label
        if ($days == 30) {
            $plans[$key]['duration_label'] = '1 Month';
        } elseif ($days == 180) {
            $plans[$key]['duration_label'] = '6 Months';
        } elseif ($days == 365) {
            $plans[$key]['duration_label'] = '12 Months';
        } else {
            $plans[$key]['duration_label'] = $days . ' Days';
        }

        // ✅ Features according to plan
        if ($code == 'monthly') {

            $plans[$key]['features'] = [
                '100 Customers Limit',
                '100 Orders Limit',
                '50 AMC Limit',
                'Complaint Management',
                'Product Management',
                'Basic Reports',
                'Mobile App Access',
            ];

        } elseif ($code == 'half_yearly') {

            $plans[$key]['features'] = [
                '1000 Customers Limit',
                '1000 Orders Limit',
                '500 AMC Limit',
                'Advanced Complaint Management',
                'AMC Management',
                'Sales & Order Tracking',
                'Reports & Analytics',
                'Priority Support',
                'Mobile + Admin Access',
            ];

        } elseif ($code == 'yearly') {

            $plans[$key]['features'] = [
                'Unlimited Customers',
                'Unlimited Orders',
                'Unlimited AMC',
                'Full Complaint Management',
                'Advanced Reports',
                'Sales Analytics',
                'Employee Management',
                'Admin Panel Access',
                'Mobile App Access',
                'Priority Premium Support',
                'All Features Unlocked',
            ];

        } else {

            $plans[$key]['features'] = [];
        }
    }
}
    // ✅ Current plan
    $currentPlan = $this->db
        ->from('user_subscriptions')
        ->where('user_id', $userId)
        ->group_start()
            ->where('status', 'active')
            ->or_where('status', 'trial')
            ->or_where('status', 'expired')
        ->group_end()
        ->order_by('id', 'DESC')
        ->get()
        ->row();

    $planSummary = null;

    if ($currentPlan) {

        $todayDate = date('Y-m-d');

        $planStatus = 'expired';

        if (
            !empty($currentPlan->end_date) &&
            $currentPlan->end_date >= $todayDate
        ) {

            if ((int)$currentPlan->is_trial === 1) {
                $planStatus = 'trial';
            } else {
                $planStatus = 'active';
            }
        }

        $planSummary = [
            'plan_name' => (string) $currentPlan->plan_name,
            'end_date'  => (string) $currentPlan->end_date,
            'status'    => $planStatus
        ];
    }

    // ✅ Response
    return $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode([
            'code' => 200,
            'status' => true,
            'message' => 'Plans fetched successfully',
            'data' => [
                'current_plan' => $planSummary,
                'plans' => $plans
            ]
        ]));
}
  public function buy_plan()
{
    $this->config->load('razorpay', true);

    // ✅ Only POST allowed
    $methodError = $this->ensureMethod('POST');

    if ($methodError !== null) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode($methodError));
    }

    // ✅ Auth
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

    if ($errorResponse !== null) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode($errorResponse));
    }

    $userId = (int) $user->id;

    // ✅ Razorpay Config
    $keyId = trim((string) config_item('razorpay_key_id'));
    $keySecret = trim((string) config_item('razorpay_key_secret'));
    $currency = trim((string) config_item('razorpay_currency'));

    if ($keyId === '' || $keySecret === '') {
        return $this->jsonApiResponse(false, 'Razorpay keys missing');
    }

    // ✅ Prevent multiple active plans
    if (!$this->Plan_model->can_activate_plan($userId)) {
        return $this->jsonApiResponse(
            false,
            $this->Plan_model->get_plan_change_block_message($userId)
        );
    }

    // ✅ Read JSON + form-data both
    $json = json_decode(file_get_contents('php://input'), true);

    $planCode = trim((string) (
        $this->input->post('plan_code', true)
        ?: ($json['plan_code'] ?? '')
    ));

    // ✅ Get plan
    $plan = $this->Plan_model->get_checkout_plan($planCode);

    if (!$plan) {
        return $this->jsonApiResponse(false, 'Invalid plan selected');
    }

    // ✅ Amount
    $displayAmount = isset($plan['price'])
        ? (float) $plan['price']
        : 0;

    // ✅ Receipt
    $receipt = 'plan_' . $userId . '_' . time();

    // ✅ Razorpay payload
    $orderPayload = [
        'amount' => (int) round($displayAmount * 100),
        'currency' => !empty($currency) ? $currency : 'INR',
        'receipt' => $receipt,
        'notes' => [
            'user_id' => (string) $userId,
            'plan_code' => (string) $plan['code'],
        ],
    ];

    // ✅ Create Razorpay Order
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($orderPayload),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],
        CURLOPT_USERPWD => $keyId . ':' . $keySecret,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);

    curl_close($ch);

    if ($curlError) {
        return $this->jsonApiResponse(false, $curlError);
    }

    $responseData = json_decode($response, true);

    if ($httpCode !== 200 && $httpCode !== 201) {
        return $this->jsonApiResponse(
            false,
            $responseData['error']['description'] ?? 'Order creation failed'
        );
    }

    // ✅ Final gateway response
    $gatewayResponse = [
        'status' => true,
        'data' => $responseData
    ];

    // ✅ Save payment order
    $paymentOrder = $this->Plan_model->create_payment_order(
        $userId,
        $plan,
        $gatewayResponse['data']
    );

    if (!$paymentOrder) {
        return $this->jsonApiResponse(false, 'Failed to save order');
    }

    // ✅ Success response
    return $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode([
            'code' => 200,
            'status' => true,
            'message' => 'Order created successfully',
            'data' => [
                'order' => $gatewayResponse['data'],
                'plan' => [
                    'code' => $plan['code'],
                    'name' => $plan['name'],
                    'price' => $displayAmount,
                    'price_label' => 'Rs ' . number_format($displayAmount, 0),
                ]
            ]
        ]));
}
   public function verify_payment()
{
    // ✅ Only POST
    $methodError = $this->ensureMethod('POST');

    if ($methodError !== null) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode($methodError));
    }

    // ✅ Auth
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

    if ($errorResponse !== null) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode($errorResponse));
    }

    $userId = (int) $user->id;

    // ✅ Razorpay Config
    $this->config->load('razorpay', true);

    $keySecret = trim((string) config_item('razorpay_key_secret'));

    // ✅ Read RAW JSON + form-data
    $json = json_decode(file_get_contents('php://input'), true);

    $razorpayPaymentId = trim((string) (
        $this->input->post('razorpay_payment_id', true)
        ?: ($json['razorpay_payment_id'] ?? '')
    ));

    $razorpayOrderId = trim((string) (
        $this->input->post('razorpay_order_id', true)
        ?: ($json['razorpay_order_id'] ?? '')
    ));

    $razorpaySignature = trim((string) (
        $this->input->post('razorpay_signature', true)
        ?: ($json['razorpay_signature'] ?? '')
    ));

    // ✅ Validate
    if (
        $keySecret === '' ||
        $razorpayPaymentId === '' ||
        $razorpayOrderId === '' ||
        $razorpaySignature === ''
    ) {
        return $this->jsonApiResponse(false, 'Missing payment details');
    }

    // ✅ Get payment order
    $paymentOrder = $this->Plan_model->get_payment_order(
        $userId,
        $razorpayOrderId
    );

    if (!$paymentOrder) {
        return $this->jsonApiResponse(false, 'Order not found');
    }

    // ✅ Verify Razorpay signature
    $generatedSignature = hash_hmac(
        'sha256',
        $razorpayOrderId . '|' . $razorpayPaymentId,
        $keySecret
    );

    if (!hash_equals($generatedSignature, $razorpaySignature)) {

        $this->Plan_model->mark_payment_failed(
            (int) $paymentOrder->id,
            [
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_signature' => $razorpaySignature,
            ]
        );

        return $this->jsonApiResponse(false, 'Payment verification failed');
    }

    // ✅ Activate Plan
    $saved = $this->Plan_model->complete_payment_and_activate_plan(
        $userId,
        (int) $paymentOrder->id,
        [
            'razorpay_payment_id' => $razorpayPaymentId,
            'razorpay_order_id' => $razorpayOrderId,
            'razorpay_signature' => $razorpaySignature,
        ]
    );

    if (!$saved) {
        return $this->jsonApiResponse(
            false,
            'Payment received but activation failed'
        );
    }

    // ✅ Fresh plan summary
    $summary = $this->Plan_model->get_plan_summary($userId);

    // ✅ Manual payload (helper removed)
    $subscription = $summary['subscription'];

    $planSummary = [
        'plan_name' => $summary['plan_name'],
        'status_label' => $summary['status_label'],
        'purchase_status' => $summary['purchase_status'],
        'is_trial' => $summary['is_trial'],
        'is_expired' => $summary['is_expired'],
        'days_left' => $summary['days_left'],
        'start_date' => $summary['start_date'],
        'end_date' => $summary['end_date'],
        'message' => $summary['message'],
        'amount' => $summary['amount'],
        'plan_code' => !empty($subscription->plan_code)
            ? $subscription->plan_code
            : '',
    ];

    // ✅ Success Response
    return $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode([
            'code' => 200,
            'status' => true,
            'message' => 'Payment successful & plan activated.',
            'plan_expired' => false,
            'plan_alert' => [
                'show' => false
            ],
            'data' => [
                'plan_summary' => $planSummary
            ]
        ]));
}
    public function check_plan()
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $planSummary = $this->getPlanStatusPayload((int) $user->id);
        $planExpired = !empty($planSummary['is_expired']);
        $showWarning = !empty($planSummary['show_expiry_warning']);

        return $this->respond([
            'code'         => 200,
            'status'       => true,
            'message'      => 'Plan status fetched successfully.',
            'plan_expired' => $planExpired,
            // ✅ Show alert data for app to handle
            'plan_alert'   => ($planExpired || $showWarning) ? [
                'show'     => true,
                'type'     => $planExpired ? 'expired' : 'warning',
                'title'    => $planExpired ? 'Plan Expired!' : 'Plan Expiring Soon!',
                'message'  => $planExpired
                    ? ($planSummary['message'] ?? 'Your plan has expired.')
                    : ($planSummary['warning_message'] ?? ''),
                'days_left' => (int) ($planSummary['days_left'] ?? 0),
                'action'   => 'buy_plan',
            ] : [
                'show' => false,
            ],
            'plan_status'  => $planSummary,
        ]);
    }
   public function save_device_token()
{
    header('Content-Type: application/json');

    // =========================
    // ✅ AUTH
    // =========================
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }
    $store_id = (int) $user->id;

    // =========================
    // ✅ INPUT
    // =========================
    $input_data = json_decode($this->input->raw_input_stream, true);
    $input_data = json_decode($this->input->raw_input_stream, true);

if (empty($input_data)) {
    return $this->output
        ->set_status_header(400)
        ->set_output(json_encode([
            'status' => false,
            'code' => 400,
            'message' => 'Invalid or empty JSON body',
            'data' => null
        ]));
}

    $device_id   = $input_data['device_id'] ?? null;
    $fcm_token   = $input_data['fcm_token'] ?? null;
    $device_type = $input_data['device_type'] ?? 'android';
    $device_name = $input_data['device_name'] ?? null;
    $app_version = $input_data['app_version'] ?? null;

    if ( !$fcm_token) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'FCM token required',
                'data' => null
            ]));
    }

    // =========================
    // ✅ CHECK EXISTING DEVICE
    // =========================
    $device = $this->db
        ->where('device_id', $device_id)
        ->where('store_id', $store_id)
        ->get('user_devices')
        ->row();

    if ($device) {

        // =========================
        // 🔄 UPDATE DEVICE
        // =========================
        $this->db->where('id', $device->id)
            ->update('user_devices', [
                'fcm_token'   => $fcm_token,
                'device_type' => $device_type,
                'device_name' => $device_name,
                'app_version' => $app_version,
                'updated_at'  => date('Y-m-d H:i:s')
            ]);

    } else {

        // =========================
        // ➕ INSERT NEW DEVICE
        // =========================
        $this->db->insert('user_devices', [
            'store_id'    => $store_id,
            'device_id'   => $device_id,
            'fcm_token'   => $fcm_token,
            'device_type' => $device_type,
            'device_name' => $device_name,
            'app_version' => $app_version,
            'created_at'  => date('Y-m-d H:i:s')
        ]);
    }

    // =========================
    // ✅ RESPONSE
    // =========================
    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Device token saved successfully',
            'data' => null
        ]));
}

public function test_notification()
{
    header('Content-Type: application/json');

    // =========================
    // ✅ AUTH USER FROM TOKEN
    // =========================
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

    if ($errorResponse !== null) {
        return $errorResponse;
    }

    // =========================
    // ✅ USER ID FROM TOKEN
    // =========================
    $user_id = (int) $user->id;

    // =========================
    // ✅ DUMMY NOTIFICATION
    // =========================
    $title   = 'Test Notification';
    $message = 'This is dummy push notification from Postman test';

    $data = [
        'type' => 'test',
        'time' => date('Y-m-d H:i:s')
    ];

    // =========================
    // ✅ SEND PUSH
    // =========================
    $result = $this->send_expo_push(
        $user_id,
        $title,
        $message,
        $data
    );

    // =========================
    // ✅ RESPONSE
    // =========================
    echo json_encode([
        'status' => true,
        'message' => 'Notification sent successfully',
        'response' => json_decode($result, true)
    ]);
}
    private function jsonApiResponse($status, $message, $data = [])
    {
        return $this->output
            ->set_status_header($status ? 200 : 400)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'code' => $status ? 200 : 400,
                'status' => $status,
                'message' => $message,
                'data' => $data
            ]));
    }
public function get_notification()
{
    header('Content-Type: application/json');
 $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) {
        return $errorResponse;
    }

    $store_id = (int) $user->id;

    $page = max(1, (int) ($this->input->get('page') ?? 1));
    $perPage = 10;
    $offset = ($page - 1) * $perPage;

    // total count
    $total = $this->db
        ->where('store_id', $store_id)
        ->count_all_results('notifications');

    // fetch data
    $notifications = $this->db
        ->where('store_id', $store_id)
        ->order_by('id', 'DESC')
        ->limit($perPage, $offset)
        ->get('notifications')
        ->result();

    $data = array_map(function ($n) {
        return [
            'id' => (int) $n->id,
            'type' => $n->type,
            'title' => $n->title,
            'message' => $n->message,
            'reference_id' => (int) $n->reference_id,
            'is_read' => (int) $n->is_read,
            'created_at' => $n->created_at
        ];
    }, $notifications);

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Notifications fetched successfully',
            'data' => $data,
            'meta' => [
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'total_pages' => ceil($total / $perPage)
            ]
        ]));
}
public function read_notification($notification_id = 0)
{
    header('Content-Type: application/json');
 $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }
    // ✅ AUTH
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) {
        return $errorResponse;
    }

    $store_id = (int) $user->id;
    $notification_id = (int) $notification_id;

    if ($notification_id <= 0) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid notification ID',
                'data' => null
            ]));
    }

    // ✅ Check exists
    $exists = $this->db
        ->where('id', $notification_id)
        ->where('store_id', $store_id)
        ->get('notifications')
        ->row();

    if (!$exists) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Notification not found',
                'data' => null
            ]));
    }

    // ✅ Update
    $this->db->where('id', $notification_id)
             ->update('notifications', ['is_read' => 1]);

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Notification marked as read',
            'data' => null
        ]));
}
public function delete_notification($notification_id = 0)
{
    header('Content-Type: application/json');
 $methodError = $this->ensureMethod('DELETE');

        if ($methodError !== null) {
            return $methodError;
        }
    // ✅ AUTH
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) {
        return $errorResponse;
    }

    $store_id = (int) $user->id;
    $notification_id = (int) $notification_id;

    if ($notification_id <= 0) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid notification ID',
                'data' => null
            ]));
    }

    // ✅ Check exists
    $exists = $this->db
        ->where('id', $notification_id)
        ->where('store_id', $store_id)
        ->get('notifications')
        ->row();

    if (!$exists) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Notification not found',
                'data' => null
            ]));
    }

    // ✅ Delete
    $this->db->where('id', $notification_id)
             ->delete('notifications');

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Notification deleted successfully',
            'data' => null
        ]));
}
      private function send_expo_push($user_id,$title,$message,$data=[])
{

    $tokenRow = $this->db
        ->where('store_id',$user_id)
        ->get('user_devices')
        ->row();

    if(!$tokenRow){
        return false;
    }

    $expo_token = $tokenRow->fcm_token;

    $payload = [
        'to'=>$expo_token,
        'title'=>$title,
        'body'=>$message,
        'sound'=>'default',
        'priority'=>'high',
        'data'=>$data
    ];

    $ch = curl_init('https://exp.host/--/api/v2/push/send');

    curl_setopt_array($ch,[
        CURLOPT_POST=>true,
        CURLOPT_RETURNTRANSFER=>true,
        CURLOPT_HTTPHEADER=>[
            'Accept: application/json',
            'Content-Type: application/json'
        ],
        CURLOPT_POSTFIELDS=>json_encode($payload)
    ]);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;
}

public function get_profile()
{
    header('Content-Type: application/json');

    /* -------------------------
       ONLY ALLOW GET
    ------------------------- */
    $methodError = $this->ensureMethod('GET');

    if ($methodError !== null) {
        return $methodError;
    }

    /* -------------------------
       JWT AUTHENTICATION
    ------------------------- */
    list($authUser, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

    if ($errorResponse !== null) {
        return $errorResponse;
    }

    $user_id = (int) $authUser->id;

    /* -------------------------
       GET USER
    ------------------------- */
    $user = $this->db
        ->where('id', $user_id)
        ->get('users')
        ->row();

    if (!$user) {

        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'User not found',
                'data'    => null
            ]));
    }

    /* -------------------------
       BUILD USER PAYLOAD
    ------------------------- */

    $userPayload = $this->buildUserPayload($user);

    /* -------------------------
       REMOVE OLD SUBSCRIPTION
    ------------------------- */

    if (isset($userPayload['subscription'])) {
        unset($userPayload['subscription']);
    }

    /* -------------------------
       DEFAULT PLAN STATUS
    ------------------------- */

    $userPayload['has_plan'] = false;
    $userPayload['plan_details'] = null;

    /* -------------------------
       GET ACTIVE/TRIAL PLAN
    ------------------------- */

    $plan = $this->db
        ->from('user_subscriptions')
        ->where('user_id', (int)$user->id)
        ->group_start()
            ->where('status', 'active')
            ->or_where('status', 'trial')
        ->group_end()
        ->where('end_date >=', date('Y-m-d'))
        ->order_by('id', 'DESC')
        ->get()
        ->row();

    /* -------------------------
       PLAN DETAILS
    ------------------------- */

    if ($plan) {

        $userPayload['has_plan'] = true;

        $userPayload['plan_details'] = [
            'plan_name' => (string)$plan->plan_name,
            'start_date'=> (string)$plan->start_date,
            'end_date'  => (string)$plan->end_date,
        ];
    }

    /* -------------------------
       SUCCESS RESPONSE
    ------------------------- */

    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'code'    => 200,
            'status'  => true,
            'message' => 'Profile fetched successfully',
            'data'    => $userPayload
        ]));
}
public function update_profile()
{
    header('Content-Type: application/json');

    /* -------------------------
       ONLY ALLOW POST
    ------------------------- */
    $methodError = $this->ensureMethod('POST');

    if ($methodError !== null) {
        return $methodError;
    }

    /* -------------------------
       JWT AUTHENTICATION
    ------------------------- */
    list($authUser, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

    if ($errorResponse !== null) {
        return $errorResponse;
    }

    $user_id = (int)$authUser->id;

    /* -------------------------
       GET USER
    ------------------------- */
    $user = $this->db
        ->get_where('users', ['id' => $user_id])
        ->row_array();

    if (!$user) {

        return $this->output
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'User not found',
                'data'    => null
            ]));
    }

    /* -------------------------
       GET FORM DATA
    ------------------------- */

    $name       = trim((string)($this->input->post('name') ?? ''));
    $store_name = trim((string)($this->input->post('store_name') ?? ''));
    $email      = trim((string)($this->input->post('email') ?? ''));
    $mobile     = trim((string)($this->input->post('mobile') ?? ''));
    $address     = trim((string)($this->input->post('address') ?? ''));


    /* -------------------------
       KEEP OLD VALUES
       IF FIELD NOT PASSED
    ------------------------- */

    if ($name === '') {
        $name = $user['name'];
    }

    if ($store_name === '') {
        $store_name = $user['store_name'];
    }

    if ($email === '') {
        $email = $user['email'];
    }

    if ($mobile === '') {
        $mobile = $user['mobile'];
    }

    /* -------------------------
       VALIDATION
    ------------------------- */

    if (empty($name)) {

        return $this->output
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Name is required',
                'data'    => null
            ]));
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {

        return $this->output
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Invalid email address',
                'data'    => null
            ]));
    }

    /* -------------------------
       CHECK MOBILE DUPLICATE
    ------------------------- */

    if (!empty($mobile)) {

        $existing_mobile = $this->db
            ->where('mobile', $mobile)
            ->where('id !=', $user_id)
            ->get('users')
            ->row_array();

        if ($existing_mobile) {

            return $this->output
                ->set_output(json_encode([
                    'code'    => 400,
                    'status'  => false,
                    'message' => 'Mobile number already registered with another user',
                    'data'    => null
                ]));
        }
    }

    /* -------------------------
       CHECK EMAIL DUPLICATE
    ------------------------- */

    if (!empty($email)) {

        $existing_email = $this->db
            ->where('email', $email)
            ->where('id !=', $user_id)
            ->get('users')
            ->row_array();

        if ($existing_email) {

            return $this->output
                ->set_output(json_encode([
                    'code'    => 400,
                    'status'  => false,
                    'message' => 'Email already registered with another user',
                    'data'    => null
                ]));
        }
    }

    /* -------------------------
       PROFILE IMAGE UPLOAD
    ------------------------- */

    $profile_image = $user['profile_image'];

    if (!empty($_FILES['profile_image']['name'])) {

        $allowed_extensions = ['jpg', 'jpeg', 'png'];

        $file_name_original = $_FILES['profile_image']['name'];
        $file_size          = $_FILES['profile_image']['size'];
        $file_tmp           = $_FILES['profile_image']['tmp_name'];

        $extension = strtolower(pathinfo($file_name_original, PATHINFO_EXTENSION));

        /* -------------------------
           CHECK EXTENSION
        ------------------------- */

        if (!in_array($extension, $allowed_extensions)) {

            return $this->output
                ->set_output(json_encode([
                    'code'    => 400,
                    'status'  => false,
                    'message' => 'Only JPG and PNG images are allowed',
                    'data'    => null
                ]));
        }

        /* -------------------------
           CHECK FILE SIZE
        ------------------------- */

        if ($file_size > 1048576) {

            return $this->output
                ->set_output(json_encode([
                    'code'    => 400,
                    'status'  => false,
                    'message' => 'Image size must be less than 1 MB',
                    'data'    => null
                ]));
        }

        /* -------------------------
           CREATE DIRECTORY
        ------------------------- */

        $upload_path = FCPATH . 'uploads/profile_img/';

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        /* -------------------------
           GENERATE FILE NAME
        ------------------------- */

        $new_file_name = 'profile_' . time() . '_' . rand(1000,9999) . '.' . $extension;

        $full_path = $upload_path . $new_file_name;

        /* -------------------------
           UPLOAD IMAGE
        ------------------------- */

        if (!move_uploaded_file($file_tmp, $full_path)) {

            return $this->output
                ->set_output(json_encode([
                    'code'    => 400,
                    'status'  => false,
                    'message' => 'Failed to upload image',
                    'data'    => null
                ]));
        }

        /* -------------------------
           DELETE OLD IMAGE
        ------------------------- */

        if (
            !empty($user['profile_image']) &&
            file_exists(FCPATH . $user['profile_image'])
        ) {
            @unlink(FCPATH . $user['profile_image']);
        }

        $profile_image = 'uploads/profile_img/' . $new_file_name;
    }

    /* -------------------------
       UPDATE DATA
    ------------------------- */

    $update_data = [
        'name'          => $name,
        'store_name'    => $store_name,
        'email'         => $email,
        'mobile'        => $mobile,
        'profile_image' => $profile_image,
        'address' => $address

    ];

    $this->db->where('id', $user_id);
    $this->db->update('users', $update_data);

    /* -------------------------
       GET UPDATED USER
    ------------------------- */

    $updated_user = $this->db
        ->get_where('users', ['id' => $user_id])
        ->row_array();

    /* -------------------------
       RESPONSE DATA
    ------------------------- */

    $response = [
        'id'            => (int)$updated_user['id'],
        'name'          => $updated_user['name'],
        'store_name'    => $updated_user['store_name'],
        'mobile'        => $updated_user['mobile'],
        'email'         => $updated_user['email'],
        'role'          => (int)$updated_user['role'],
        'isActive'      => (int)$updated_user['isActive'],
        'profile_image' => !empty($updated_user['profile_image'])
            ? base_url($updated_user['profile_image'])
            : ''
    ];

    /* -------------------------
       SUCCESS RESPONSE
    ------------------------- */

    return $this->output
        ->set_output(json_encode([
            'code'    => 200,
            'status'  => true,
            'message' => 'Profile updated successfully',
            'data'    => $response
        ]));
}

public function expire_plan_tokens()
{
    header('Content-Type: application/json');

    /* -------------------------
       SECURITY KEY
    ------------------------- */

    $cron_key = $this->input->get('key');

    if ($cron_key !== 'filterbook_cron_2026_secure_key_987654') {

        return $this->output
            ->set_output(json_encode([
                'code'   => 400,
                'status' => false,
                'message'=> 'Unauthorized'
            ]));
    }

    /* -------------------------
       LOG FILE PATH
    ------------------------- */

    $log_path = APPPATH . 'logs/plan_expire_log.txt';

    /* -------------------------
       START LOG
    ------------------------- */

    $log_message = "\n\n==============================";
    $log_message .= "\nCRON RUN: " . date('Y-m-d H:i:s');

    /* -------------------------
       GET EXPIRED USERS
    ------------------------- */

    $expiredUsers = $this->db
        ->select('user_id')
        ->from('user_subscriptions')
        ->where('end_date <', date('Y-m-d'))
        ->group_start()
            ->where('status', 'active')
            ->or_where('status', 'trial')
        ->group_end()
        ->get()
        ->result();

    $updated = 0;

    $log_message .= "\nExpired Users Found: " . count($expiredUsers);

    foreach ($expiredUsers as $item) {

        $user_id = (int)$item->user_id;

        /* -------------------------
           UPDATE TOKEN VERSION
        ------------------------- */

        $this->db
            ->set('token_version', 'token_version + 1', false)
            ->where('id', $user_id)
            ->update('users');

        /* -------------------------
           UPDATE PLAN STATUS
        ------------------------- */

        $this->db
            ->where('user_id', $user_id)
            ->where('end_date <', date('Y-m-d'))
            ->update('user_subscriptions', [
                'status' => 'expired'
            ]);

        $updated++;

        $log_message .= "\nUser Logged Out ID: " . $user_id;
    }

    $log_message .= "\nTotal Logged Out: " . $updated;
    $log_message .= "\nCRON END";
    $log_message .= "\n==============================";

    /* -------------------------
       SAVE LOG
    ------------------------- */

    file_put_contents($log_path, $log_message, FILE_APPEND);

    /* -------------------------
       RESPONSE
    ------------------------- */

    return $this->output
        ->set_output(json_encode([
            'code'    => 200,
            'status'  => true,
            'message' => 'Expired plan tokens processed successfully',
            'data'    => [
                'total_users_logged_out' => $updated,
                'time' => date('Y-m-d H:i:s')
            ]
        ]));
}
public function forgot_password()
{
    header('Content-Type: application/json');

    /* -------------------------
       ONLY ALLOW POST
    ------------------------- */
    $methodError = $this->ensureMethod('POST');

    if ($methodError !== null) {
        return $methodError;
    }

    /* -------------------------
       GET EMAIL
    ------------------------- */
    $input = json_decode(file_get_contents('php://input'), true);
    $email = trim((string)($input['email'] ?? ''));

    /* -------------------------
       VALIDATION
    ------------------------- */
    if (empty($email)) {
        return $this->output
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Email is required',
                'data'    => null
            ]));
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $this->output
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Invalid email address',
                'data'    => null
            ]));
    }

    /* -------------------------
       CHECK USER
    ------------------------- */
    $user = $this->db
        ->get_where('users', ['email' => $email])
        ->row_array();

    if (!$user) {
        return $this->output
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'User not found',
                'data'    => null
            ]));
    }

    /* -------------------------
       GENERATE TOKEN
    ------------------------- */
    $expire_time = time() + (2 * 60 * 60); // 2 hours

    $token_data = [
        'user_id' => $user['id'],
        'expire'  => $expire_time
    ];

    $token = base64_encode(json_encode($token_data));

    /* -------------------------
       RESET LINK
    ------------------------- */
// In forgot_password() change this line:
$reset_link = base_url('reset_password_page?token=' . urlencode($token));
    /* -------------------------
       EMAIL CONTENT
    ------------------------- */
    $subject = 'Reset Your Password - FilterBook';

    $message = '
    <div style="font-family:Arial,sans-serif;font-size:14px;color:#333;">

        <h2>Password Reset Request</h2>

        <p>Hello ' . $user['name'] . ',</p>

        <p>We received a request to reset your password.</p>

        <p>Click the button below to update your password:</p>

        <p style="margin:25px 0;">
            <a href="' . $reset_link . '"
               style="
                    background:#2563eb;
                    color:#fff;
                    padding:12px 20px;
                    text-decoration:none;
                    border-radius:6px;
                    display:inline-block;
               ">
                Update Password
            </a>
        </p>

        <p>This link will expire in <strong>2 hours</strong>.</p>

        <p>If you did not request this, please ignore this email.</p>

        <br>

        <p>
            Regards,<br>
            FilterBook Team
        </p>

    </div>';

    /* -------------------------
       SMTP CONFIG (ZOHO)
    ------------------------- */
    $this->load->library('email');

    $config = [
        'protocol'    => 'smtp',
        'smtp_host'   => 'smtp.zoho.in',
        'smtp_port'   => 587,
        'smtp_crypto' => 'tls',
        'smtp_user'   => 'contact@visiontechnolabs.com', // your zoho email
        'smtp_pass'   => 'VV7DRFxqJL9T',       // app password from zoho
        'mailtype'    => 'html',
        'charset'     => 'utf-8',
        'newline'     => "\r\n",
    ];

    $this->email->initialize($config);

    /* -------------------------
       SEND EMAIL
    ------------------------- */
    $this->email->from('contact@visiontechnolabs.com', 'FilterBook');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);

    if (!$this->email->send()) {
        return $this->output
            ->set_output(json_encode([
                'code'    => 500,
                'status'  => false,
                'message' => 'Failed to send reset email',
                'data'    => null
            ]));
    }

    /* -------------------------
       SUCCESS RESPONSE
    ------------------------- */
    return $this->output
        ->set_output(json_encode([
            'code'    => 200,
            'status'  => true,
            'message' => 'Forget password link sent to your email please check and update password',
            'data'    => [
                'email' => $email
            ]
        ]));
}
public function delete_account()
{
    header('Content-Type: application/json');

    /* -------------------------
       JWT AUTHENTICATION
    ------------------------- */
   header('Content-Type: application/json');
 $methodError = $this->ensureMethod('DELETE');

        if ($methodError !== null) {
            return $methodError;
        }
    // ✅ AUTH
    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) {
        return $errorResponse;
    }

    $user_id = (int) $user->id;

    /* -------------------------
       CHECK USER EXISTS
    ------------------------- */
    $user = $this->db->get_where('users', ['id' => $user_id])->row();

    if (!$user ) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'User not found',
                'data'    => null
            ]));
    }
 

    /* -------------------------
       DELETE USER (HARD DELETE)
    ------------------------- */
    $this->db->trans_begin();

    $this->db->where('id', $user_id)->delete('users');

    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();

        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'code'    => 400,
                'status'  => false,
                'message' => 'Failed to delete account',
                'data'    => null
            ]));
    }

    $this->db->trans_commit();

    /* -------------------------
       RESPONSE
    ------------------------- */
    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'code'    => 200,
            'status'  => true,
            'message' => 'Account deleted successfully',
            'data'    => null
        ]));
}
 public function terms_condition()
{
    // CORS + JSON headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    $data = [
        "app_name" => "FilterBook",
        "last_updated" => "07 March 2026",

        "content" => '
        <div class="legal-card">
            <div class="legal-meta">
                <i class="bi bi-calendar3"></i> Last updated: 07 March 2026
            </div>

            <section class="legal-section">
                <h2>1. Acceptance of Terms</h2>
                <p>By accessing or using FilterBook, you agree to these terms and conditions. If you do not agree, please do not use the website or software.</p>
            </section>

            <section class="legal-section">
                <h2>2. Service Usage</h2>
                <p>FilterBook is intended for lawful business use. You agree not to misuse the platform, interfere with operations, attempt unauthorized access, or upload harmful content.</p>
            </section>

            <section class="legal-section">
                <h2>3. Account Responsibility</h2>
                <p>You are responsible for maintaining the confidentiality of your login credentials and for all activity performed through your account.</p>
            </section>

            <section class="legal-section">
                <h2>4. Subscription and Billing</h2>
                <p>Paid features may require an active subscription. Pricing, duration, and plan availability may be updated by the company. Access to premium features may end when a subscription expires or is cancelled.</p>
            </section>

            <section class="legal-section">
                <h2>5. Intellectual Property</h2>
                <p>All software, branding, design, and content related to FilterBook remain the property of the company unless otherwise stated. Users may not copy, resell, or redistribute the platform without permission.</p>
            </section>

            <section class="legal-section">
                <h2>6. Limitation of Liability</h2>
                <p>FilterBook is provided on an as-available basis. To the maximum extent allowed by law, we are not liable for indirect, incidental, or consequential losses arising from the use of the platform.</p>
            </section>

            <section class="legal-section">
                <h2>7. Changes to Terms</h2>
                <p>We may revise these terms from time to time. Continued use of the platform after updates means you accept the revised terms.</p>
            </section>
        </div>
        ',

        "contact" => [
            "email" => "visiontechnolabs@gmail.com",
            "phone" => "+91 8160348894",
            "website" => "https://visiontechnolabs.com"
        ]
    ];

    echo json_encode([
        "code" => 200,
        "status" => true,
        "data" => $data
    ]);
}


public function privacy_policy()
{
    // CORS + JSON headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    $data = [
        "app_name" => "FilterBook",
        "last_updated" => "07 March 2026",

        "content" => '
        <div class="legal-card">
            <div class="legal-meta">
                <i class="bi bi-calendar3"></i> Last updated: 07 March 2026
            </div>

            <section class="legal-section">
                <h2>1. Information We Collect</h2>
                <p>We may collect contact details such as your name, mobile number, email address, business name, billing information, and the data you enter into the FilterBook platform, including customers, products, services, complaints, AMC contracts, and payment records.</p>
            </section>

            <section class="legal-section">
                <h2>2. How We Use Your Information</h2>
                <p>We use the information to provide our CRM services, improve product experience, support user accounts, process subscriptions, send service updates, and maintain platform security.</p>
            </section>

            <section class="legal-section">
                <h2>3. Data Sharing</h2>
                <p>We do not sell your personal information. Data may be shared only with trusted service providers who support hosting, messaging, payment processing, or technical operations, and only where required to operate the service.</p>
            </section>

            <section class="legal-section">
                <h2>4. Data Security</h2>
                <p>We take reasonable administrative and technical measures to protect your information from unauthorized access, misuse, or disclosure. However, no online system can guarantee absolute security.</p>
            </section>

            <section class="legal-section">
                <h2>5. Your Rights</h2>
                <p>You may request access, correction, or deletion of your account information, subject to operational and legal requirements. For account-related requests, contact us through the details provided on the website.</p>
            </section>

            <section class="legal-section">
                <h2>6. Policy Updates</h2>
                <p>We may update this Privacy Policy from time to time. Updated versions will be posted on this page with the revised effective date.</p>
            </section>
        </div>
        ',

        "contact" => [
            "email" => "visiontechnolabs@gmail.com",
            "phone" => "+91 9876543210",
            "website" => "https://visiontechnolabs.com"
        ]
    ];

    echo json_encode([
        "code" => 200,
        "status" => true,
        "data" => $data
    ]);
}

public function refund_policy()
{
    // CORS + JSON headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    $data = [
        "app_name" => "FilterBook",
        "last_updated" => "07 March 2026",

        "content" => '
        <div class="legal-card">
            <div class="legal-meta">
                <i class="bi bi-calendar3"></i> Last updated: 07 March 2026
            </div>

            <section class="legal-section">
                <h2>1. Subscription Payments</h2>
                <p>Subscription payments made for FilterBook plans are generally non-refundable once the plan has been activated, unless a refund is required by applicable law or approved by the company in a special case.</p>
            </section>

            <section class="legal-section">
                <h2>2. Trial Access</h2>
                <p>Where a free trial is offered, users are encouraged to evaluate the service during the trial period before purchasing a paid plan.</p>
            </section>

            <section class="legal-section">
                <h2>3. Duplicate or Incorrect Charges</h2>
                <p>If you believe you were charged incorrectly or more than once for the same plan, you should contact support with payment details so the issue can be reviewed promptly.</p>
            </section>

            <section class="legal-section">
                <h2>4. Cancellation</h2>
                <p>Cancelling a plan will normally stop future renewals or future purchases, but it does not automatically create a refund for the current billing period.</p>
            </section>

            <section class="legal-section">
                <h2>5. Refund Processing</h2>
                <p>If a refund is approved, it will be processed through the original payment method within a reasonable business period, subject to banking or payment gateway timelines.</p>
            </section>

            <section class="legal-section">
                <h2>6. Contact for Refund Requests</h2>
                <p>To request a billing review, please contact the FilterBook support or sales team with your business name, registered mobile number, payment reference, and the reason for the request.</p>
            </section>
        </div>
        ',

        "contact" => [
            "email" => "visiontechnolabs@gmail.com",
            "phone" => "+91 9876543210",
            "website" => "https://visiontechnolabs.com"
        ]
    ];

    echo json_encode([
        "code" => 200,
        "status" => true,
        "data" => $data
    ]);
}
}
