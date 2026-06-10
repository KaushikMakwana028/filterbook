<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
                'status' => false,
                'message' => 'Invalid request method. Use ' . $expectedMethod . '.',
            ], 405);
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
        return [
            'id' => (int) $user->id,
            'name' => (string) $user->name,
            'store_name' => isset($user->store_name) ? (string) $user->store_name : '',
            'email' => isset($user->email) ? (string) $user->email : '',
            'mobile' => (string) $user->mobile,
            'role' => isset($user->role) ? (int) $user->role : 0,
        ];
    }

    private function issueToken($user)
    {
        return $this->jwt_service->encode([
            'sub' => (int) $user->id,
            'mobile' => (string) $user->mobile,
            'role' => isset($user->role) ? (int) $user->role : 0,
            'name' => (string) $user->name,
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
            // echo "<pre>";
            // print_r();
            // die;
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
        return [
            'id' => (int) $emi->id,
            'order_id' => isset($emi->order_id) ? (int) $emi->order_id : 0,
            'customer_id' => isset($emi->customer_id) ? (int) $emi->customer_id : 0,
            'emi_number' => isset($emi->emi_number) ? (int) $emi->emi_number : 0,
            'status' => isset($emi->status) ? (int) $emi->status : 0,
            'status_label' => (int) ($emi->status ?? 0) === 1 ? 'Paid' : 'Pending',
            'customer_status' => isset($emi->status_customer) ? (int) $emi->status_customer : 0,
            'emi_date' => isset($emi->emi_date) ? (string) $emi->emi_date : null,
            'update_at' => isset($emi->update_at) ? (string) $emi->update_at : null,
            'created_at' => isset($emi->created_at) ? (string) $emi->created_at : null,
            'customer_name' => isset($emi->customer_name) ? (string) $emi->customer_name : '',
            'customer_mobile' => isset($emi->customer_mobile) ? (string) $emi->customer_mobile : '',
            'customer_address' => isset($emi->customer_address) ? (string) $emi->customer_address : '',
            'product_name' => isset($emi->product_name) ? (string) $emi->product_name : '',
            'product_modal' => isset($emi->product_modal) ? (string) $emi->product_modal : '',
            'price' => isset($emi->price) ? (float) $emi->price : 0,
            'down_payment' => isset($emi->down_payment) ? (float) $emi->down_payment : 0,
            'emi_amount' => isset($emi->emi_amount) ? (float) $emi->emi_amount : 0,
            'date_of_purchase' => isset($emi->date_of_purchase) ? (string) $emi->date_of_purchase : null,
            'emi_duration' => isset($emi->emi_duration) ? (int) $emi->emi_duration : 0,
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
            return $methodError;
        }

        $data = $this->getJsonInput();

        $name = trim((string) ($data['name'] ?? $data['username'] ?? $this->input->post('name', true) ?? $this->input->post('username', true)));
        $storeName = trim((string) ($data['store_name'] ?? $this->input->post('store_name', true)));
        $email = trim((string) ($data['email'] ?? $this->input->post('email', true)));
        $mobile = $this->normalizeMobile($data['mobile'] ?? $this->input->post('mobile', true));
        $password = (string) ($data['password'] ?? $this->input->post('password', true));
        $confirmPassword = (string) ($data['confirm_password'] ?? $this->input->post('confirm_password', true));

        if ($name === '' || $storeName === '' || $email === '' || $mobile === '' || $password === '') {
            return $this->respond([
                'status' => false,
                'message' => 'Username, store name, email, mobile and password are required.',
            ], 422);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->respond([
                'status' => false,
                'message' => 'Please enter a valid email address.',
            ], 422);
        }

        if (strlen($mobile) < 10) {
            return $this->respond([
                'status' => false,
                'message' => 'Please enter a valid mobile number.',
            ], 422);
        }

        if ($confirmPassword !== '' && $password !== $confirmPassword) {
            return $this->respond([
                'status' => false,
                'message' => 'Password and confirm password do not match.',
            ], 422);
        }

        if ($this->findUserByMobile($mobile)) {
            return $this->respond([
                'status' => false,
                'message' => 'Mobile number already registered.',
            ], 409);
        }

        if ($this->findUserByEmail($email)) {
            return $this->respond([
                'status' => false,
                'message' => 'Email address already registered.',
            ], 409);
        }

        $insertData = [
            'name' => $name,
            'store_name' => $storeName,
            'email' => $email,
            'mobile' => $mobile,
            'password' => md5($password),
            'role' => 2,
            'isActive' => 1,
            'created_on' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('users', $insertData);
        $userId = (int) $this->db->insert_id();
        $this->Plan_model->get_or_create_subscription($userId);
        $user = $this->db->get_where('users', ['id' => $userId])->row();

        return $this->respond([
            'status' => true,
            'message' => 'Registered successfully.',
            'token' => $this->issueToken($user),
            'token_type' => 'Bearer',
            'data' => $this->buildUserPayload($user),
        ], 201);
    }

    public function forgot_password()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        $request = $this->getForgotPasswordData();
        $identifier = $request['identifier'];
        $password = $request['password'];
        $confirmPassword = $request['confirm_password'];

        if ($identifier === '') {
            return $this->respond([
                'status' => false,
                'message' => 'Email or mobile number is required.',
            ], 422);
        }

        $user = $this->findUserForLogin($identifier);

        if (!$user) {
            return $this->respond([
                'status' => false,
                'message' => 'User not found.',
            ], 404);
        }

        if ($password === '' && $confirmPassword === '') {
            return $this->respond([
                'status' => true,
                'message' => 'Account found. Please enter your new password.',
                'data' => [
                    'user_id' => (int) $user->id,
                    'name' => (string) $user->name,
                    'mobile' => isset($user->mobile) ? (string) $user->mobile : '',
                    'email' => isset($user->email) ? (string) $user->email : '',
                ],
            ]);
        }

        if ($password === '' || $confirmPassword === '') {
            return $this->respond([
                'status' => false,
                'message' => 'Password and confirm password are required.',
            ], 422);
        }

        if ($password !== $confirmPassword) {
            return $this->respond([
                'status' => false,
                'message' => 'Password and confirm password do not match.',
            ], 422);
        }

        $updated = $this->db
            ->where('id', (int) $user->id)
            ->update('users', ['password' => md5($password)]);

        if (!$updated) {
            return $this->respond([
                'status' => false,
                'message' => 'Failed to update password.',
            ], 500);
        }

        return $this->respond([
            'status' => true,
            'message' => 'Password updated successfully.',
            'data' => [
                'user_id' => (int) $user->id,
                'name' => (string) $user->name,
                'mobile' => isset($user->mobile) ? (string) $user->mobile : '',
                'email' => isset($user->email) ? (string) $user->email : '',
            ],
        ]);
    }

    public function login()
    {
        // echo "h";
        // die;
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        $data = $this->getJsonInput();

        $identifier = trim((string) ($data['mobile'] ?? $data['email'] ?? $data['login'] ?? $this->input->post('mobile', true) ?? $this->input->post('email', true) ?? $this->input->post('login', true)));
        $password = (string) ($data['password'] ?? $this->input->post('password', true));

        // Validation
        if ($identifier === '' || $password === '') {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'code' => 400,
                    'status' => false,
                    'message' => 'Mobile/email and password are required.',
                ]));
        }

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

        if (isset($user->isActive) && (string) $user->isActive === '0') {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'code' => 400,
                    'status' => false,
                    'message' => 'Your account is inactive. Please contact administrator.',
                ]));
        }

        if (!$this->isPasswordValid($password, (string) $user->password)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'code' => 400,
                    'status' => false,
                    'message' => 'Invalid password.',
                ]));
        }

        // Success response
        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'code' => 200,
                'status' => true,
                'message' => 'Login successful.',
                'token' => $this->issueToken($user),
                'token_type' => 'Bearer',
                'data' => $this->buildUserPayload($user),
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

        return $this->respond([
            'status' => true,
            'message' => 'User profile fetched successfully.',
            'data' => $this->buildUserPayload($user),
            'token_data' => $payload,
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

        $categories = $this->db
            ->where('user_id', (int) $user->id)
            ->order_by('id', 'DESC')
            ->get('categories')
            ->result();

        $categoryData = array_map(function ($category) use ($user) {
            return $this->buildCategoryPayload($category, $user->id);
        }, $categories);

        return $this->respond([
            'status' => true,
            'message' => 'Category list fetched successfully.',
            'data' => $categoryData,
            'meta' => [
                'total' => count($categoryData),
                'user_id' => (int) $user->id,
            ],
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
            return $this->respond([
                'status' => false,
                'message' => 'Category id and name are required.',
            ], 422);
        }

        $category = $this->getCategoryById($categoryId, $user->id);

        if (!$category) {
            return $this->respond([
                'status' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        if ($this->categoryNameExists($name, $user->id, $categoryId)) {
            return $this->respond([
                'status' => false,
                'message' => 'Category name already exists.',
            ], 409);
        }

        $this->db
            ->where('id', $categoryId)
            ->where('user_id', (int) $user->id)
            ->update('categories', [
                'name' => $name,
            ]);

        $updatedCategory = $this->getCategoryById($categoryId, $user->id);

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Category id is required.',
            ], 422);
        }

        $category = $this->getCategoryById($categoryId, $user->id);

        if (!$category) {
            return $this->respond([
                'status' => false,
                'message' => 'Category not found.',
            ], 404);
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

        return $this->respond([
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

        $products = $this->db
            ->select('products.*, categories.name AS category_name, users.name AS user_name')
            ->from('products')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->join('users', 'users.id = products.user_id', 'left')
            ->where('products.user_id', (int) $user->id)
            ->order_by('products.id', 'DESC')
            ->get()
            ->result();

        $productData = array_map(function ($product) {
            return $this->buildProductPayload($product);
        }, $products);

        return $this->respond([
            'status' => true,
            'message' => 'Product list fetched successfully.',
            'data' => $productData,
            'meta' => [
                'total' => count($productData),
                'user_id' => (int) $user->id,
            ],
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

        $catalogs = $this->db
            ->where('admin_id', (int) $user->id)
            ->order_by('id', 'DESC')
            ->get('catalog')
            ->result();

        $catalogData = array_map(function ($catalog) {
            return $this->buildCatalogPayload($catalog);
        }, $catalogs);

        return $this->respond([
            'status' => true,
            'message' => 'Catalog list fetched successfully.',
            'data' => $catalogData,
            'meta' => [
                'total' => count($catalogData),
                'admin_id' => (int) $user->id,
            ],
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
            return $this->respond([
                'status' => false,
                'message' => 'Catalog name and price are required.',
            ], 422);
        }

        if (!is_numeric($request['price']) || (float) $request['price'] < 0) {
            return $this->respond([
                'status' => false,
                'message' => 'Please enter a valid price.',
            ], 422);
        }

        $uploadPath = FCPATH . 'uploads/catalog/';

        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0777, true);
        }

        if (!is_dir($uploadPath) || !is_writable($uploadPath)) {
            return $this->respond([
                'status' => false,
                'message' => 'Catalog image upload folder is not writable.',
            ], 500);
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
                return $this->respond([
                    'status' => false,
                    'message' => strip_tags($this->upload->display_errors('', '')),
                ], 422);
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

        return $this->respond([
            'status' => true,
            'message' => 'Catalog item added successfully.',
            'data' => $this->buildCatalogPayload($catalog),
        ], 201);
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
            return $this->respond([
                'status' => false,
                'message' => 'Catalog id is required.',
            ], 422);
        }

        $catalog = $this->getCatalogById($catalogId, (int) $user->id);

        if (!$catalog) {
            return $this->respond([
                'status' => false,
                'message' => 'Catalog item not found.',
            ], 404);
        }

        $uploadPath = FCPATH . 'uploads/catalog/';

        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0777, true);
        }

        $hasImage = !empty($_FILES['image']['name']);
        $hasTextField = ($request['name'] !== '' || $request['description'] !== '' || $request['price'] !== '');

        if (!$hasImage && !$hasTextField) {
            return $this->respond([
                'status' => false,
                'message' => 'Please send at least one field or image to update.',
            ], 422);
        }

        $name = $request['name'] !== '' ? $request['name'] : (string) $catalog->name;
        $description = $request['description'] !== '' ? $request['description'] : (string) $catalog->description;
        $price = $request['price'] !== '' ? $request['price'] : $catalog->price;

        if ($name === '') {
            return $this->respond([
                'status' => false,
                'message' => 'Catalog name cannot be empty.',
            ], 422);
        }

        if ($price === '' || !is_numeric($price) || (float) $price < 0) {
            return $this->respond([
                'status' => false,
                'message' => 'Please enter a valid price.',
            ], 422);
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
                return $this->respond([
                    'status' => false,
                    'message' => strip_tags($this->upload->display_errors('', '')),
                ], 422);
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

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Catalog id is required.',
            ], 422);
        }

        $catalog = $this->getCatalogById($catalogId, (int) $user->id);

        if (!$catalog) {
            return $this->respond([
                'status' => false,
                'message' => 'Catalog item not found.',
            ], 404);
        }

        if (!empty($catalog->image) && file_exists(FCPATH . 'uploads/catalog/' . $catalog->image)) {
            @unlink(FCPATH . 'uploads/catalog/' . $catalog->image);
        }

        $this->db->delete('catalog', [
            'id' => $catalogId,
            'admin_id' => (int) $user->id,
        ]);

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Product not found.',
            ], 404);
        }

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Product name and category are required.',
            ], 422);
        }

        $category = $this->getOwnedCategory($request['category_id'], $user->id);

        if (!$category) {
            return $this->respond([
                'status' => false,
                'message' => 'Invalid category selected.',
            ], 422);
        }

        $insertData = [
            'user_id' => (int) $user->id,
            'name' => $request['name'],
            'category_id' => (int) $request['category_id'],
            'brand' => $request['brand'],
            'unit' => $request['unit'],
            'quantity' => $request['quantity'] === '' ? 0 : $request['quantity'],
            'purchase_price' => $request['purchase_price'] === '' ? 0 : $request['purchase_price'],
        ];

        $this->db->insert('products', $insertData);
        $productId = (int) $this->db->insert_id();
        $product = $this->getProductById($productId, $user->id);

        return $this->respond([
            'status' => true,
            'message' => 'Product added successfully.',
            'data' => $this->buildProductPayload($product),
        ], 201);
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
            return $this->respond([
                'status' => false,
                'message' => 'Product id, name and category are required.',
            ], 422);
        }

        $product = $this->getProductById($request['id'], $user->id);

        if (!$product) {
            return $this->respond([
                'status' => false,
                'message' => 'Product not found.',
            ], 404);
        }

        $category = $this->getOwnedCategory($request['category_id'], $user->id);

        if (!$category) {
            return $this->respond([
                'status' => false,
                'message' => 'Invalid category selected.',
            ], 422);
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
            ]);

        $updatedProduct = $this->getProductById($request['id'], $user->id);

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Product id is required.',
            ], 422);
        }

        $product = $this->getProductById($productId, $user->id);

        if (!$product) {
            return $this->respond([
                'status' => false,
                'message' => 'Product not found.',
            ], 404);
        }

        $this->db->delete('products', [
            'id' => $productId,
            'user_id' => (int) $user->id,
        ]);

        return $this->respond([
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

        return $this->respond([
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
                return $this->respond([
                    'status' => false,
                    'message' => 'Please enter a valid email address.',
                ], 422);
            }

            $emailExists = $this->db
                ->where('email', $data['email'])
                ->where('id !=', (int) $user->id)
                ->count_all_results('users');

            if ($emailExists > 0) {
                return $this->respond([
                    'status' => false,
                    'message' => 'Email address already registered.',
                ], 409);
            }
        }

        if (isset($data['name']) && $data['name'] === '') {
            return $this->respond([
                'status' => false,
                'message' => 'Name cannot be empty.',
            ], 422);
        }

        if (isset($data['store_name']) && $data['store_name'] === '') {
            return $this->respond([
                'status' => false,
                'message' => 'Store name cannot be empty.',
            ], 422);
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
                return $this->respond([
                    'status' => false,
                    'message' => strip_tags($this->upload->display_errors('', '')),
                ], 422);
            }
        }

        if (empty($data)) {
            return $this->respond([
                'status' => false,
                'message' => 'Please send at least one field or profile image to update.',
            ], 422);
        }

        $this->db->where('id', (int) $user->id);
        $updated = $this->db->update('users', $data);

        if (!$updated) {
            return $this->respond([
                'status' => false,
                'message' => 'Profile update failed.',
            ], 500);
        }

        $updatedUser = $this->db->get_where('users', ['id' => (int) $user->id])->row();

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Mobile number, password and confirm password are required.',
            ], 422);
        }

        if (strlen($mobile) < 10) {
            return $this->respond([
                'status' => false,
                'message' => 'Please enter a valid mobile number.',
            ], 422);
        }

        if ($password !== $confirmPassword) {
            return $this->respond([
                'status' => false,
                'message' => 'Password and confirm password do not match.',
            ], 422);
        }

        if (strlen($password) < 6) {
            return $this->respond([
                'status' => false,
                'message' => 'Password must be at least 6 characters long.',
            ], 422);
        }

        $validMobiles = $this->getMobileCandidates($user->mobile);

        if (!in_array($mobile, $validMobiles, true)) {
            return $this->respond([
                'status' => false,
                'message' => 'Entered mobile number does not match the logged in account.',
            ], 422);
        }

        $this->db->where('id', (int) $user->id);
        $updated = $this->db->update('users', [
            'password' => md5($password),
        ]);

        if (!$updated) {
            return $this->respond([
                'status' => false,
                'message' => 'Failed to update password. Please try again.',
            ], 500);
        }

        return $this->respond([
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

    $methodError = $this->ensureMethod('GET');
    if ($methodError !== null) return $methodError;

    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) return $errorResponse;

    $store_id  = (int) $user->id;
    $search    = trim($this->input->get('search') ?? '');
    $status    = $this->input->get('status');       // 'pending' or 'solved'
    $page      = max(1, (int) ($this->input->get('page') ?? 1));
    $per_page  = max(1, min(50, (int) ($this->input->get('per_page') ?? 10)));
    $offset    = ($page - 1) * $per_page;

    // ✅ Get counts (single query)
    $counts = $this->db
        ->select('
            COUNT(*) AS total_complaints,
            SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS pending_complaints,
            SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS solved_complaints
        ')
        ->from('complaint')
        ->where('store_id', $store_id)
        ->get()
        ->row();

    // ✅ Build filtered count
    $this->db->where('complaint.store_id', $store_id);

    if ($status === 'pending') {
        $this->db->where('complaint.status', 0);
    } elseif ($status === 'solved') {
        $this->db->where('complaint.status', 1);
    }

    if ($search !== '') {
        $this->db->group_start()
            ->like('complaint.customer_name', $search)
            ->or_like('complaint.mobile', $search)
            ->or_like('complaint.product_name', $search)
            ->group_end();
    }

    $total = (int) $this->db
        ->from('complaint')
        ->count_all_results();

    // ✅ Rebuild WHERE for data fetch
    $this->db->where('complaint.store_id', $store_id);

    if ($status === 'pending') {
        $this->db->where('complaint.status', 0);
    } elseif ($status === 'solved') {
        $this->db->where('complaint.status', 1);
    }

    if ($search !== '') {
        $this->db->group_start()
            ->like('complaint.customer_name', $search)
            ->or_like('complaint.mobile', $search)
            ->or_like('complaint.product_name', $search)
            ->group_end();
    }

    // ✅ Fetch data with pagination
    $complaints = $this->db
        ->from('complaint')
        ->order_by('id', 'DESC')
        ->limit($per_page, $offset)
        ->get()
        ->result();

    // ✅ Format response
    $complaintData = array_map(function ($complaint) {
        return $this->buildComplaintPayload($complaint);
    }, $complaints);

    return $this->output
        ->set_status_header(200)
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

    public function update_complaint_status($id = 0)
    {
        $methodError = $this->ensureMethod('PUT');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $requestData = $this->getRequestPayload();
        $complaintId = (int) ($id > 0 ? $id : ($requestData['id'] ?? $requestData['complaint_id'] ?? 0));
        $rawStatus = $requestData['status'] ?? null;
        $status = $this->normalizeComplaintStatus($rawStatus);

        if ($complaintId <= 0) {
            return $this->respond([
                'status' => false,
                'message' => 'Complaint id is required.',
            ], 422);
        }

        if ($rawStatus === null || $status === 0) {
            return $this->respond([
                'status' => false,
                'message' => 'Status must be pending, approved, reject or 1, 2, 3.',
            ], 422);
        }

        $complaint = $this->getComplaintById($complaintId, (int) $user->id);

        if (!$complaint) {
            return $this->respond([
                'status' => false,
                'message' => 'Complaint not found.',
            ], 404);
        }

        $updated = $this->db
            ->where('id', $complaintId)
            ->where('store_id', (int) $user->id)
            ->update('complaint', ['status' => $status]);

        if (!$updated) {
            return $this->respond([
                'status' => false,
                'message' => 'Complaint status update failed.',
            ], 500);
        }

        $updatedComplaint = $this->getComplaintById($complaintId, (int) $user->id);

        return $this->respond([
            'status' => true,
            'message' => 'Complaint status updated successfully.',
            'data' => $this->buildComplaintPayload($updatedComplaint),
        ]);
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
            return $this->respond([
                'status' => false,
                'message' => 'Complaint id is required.',
            ], 422);
        }

        $complaint = $this->getComplaintById($complaintId, $user->id);

        if (!$complaint) {
            return $this->respond([
                'status' => false,
                'message' => 'Complaint not found.',
            ], 404);
        }

        $this->db->delete('complaint', [
            'id' => $complaintId,
            'store_id' => (int) $user->id,
        ]);

        return $this->respond([
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
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $amcs = $this->db
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
            ->where('amc_customer.store_id', (int) $user->id)
            ->order_by('amc_customer.id', 'DESC')
            ->get()
            ->result();

        $data = array_map(function ($amc) {
            return $this->buildAmcPayload($amc);
        }, $amcs);

        return $this->respond([
            'status' => true,
            'message' => 'AMC list fetched successfully.',
            'data' => $data,
            'meta' => [
                'total' => count($data),
                'store_id' => (int) $user->id,
            ],
        ]);
    }

    public function amc_details($id = 0)
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $amc = $this->getAmcById((int) $id, (int) $user->id);

        if (!$amc) {
            return $this->respond([
                'status' => false,
                'message' => 'AMC record not found.',
            ], 404);
        }

        return $this->respond([
            'status' => true,
            'message' => 'AMC details fetched successfully.',
            'data' => $this->buildAmcPayload($amc),
        ]);
    }

    public function add_amc()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getAmcRequestData();
        $customer = null;
        $order = null;

        if ((int) $request['customer_id'] > 0) {
            $customer = $this->getOwnedCustomer($request['customer_id'], (int) $user->id);
        } elseif ($request['customer_mobile'] !== '') {
            $customer = $this->getOwnedCustomerByMobile($request['customer_mobile'], (int) $user->id);
        }

        if ($customer) {
            if ((int) $request['product_id'] > 0) {
                $order = $this->getOwnedOrderForCustomer($request['product_id'], (int) $customer->id, (int) $user->id);
            } elseif ($request['product_name'] !== '') {
                $order = $this->getOwnedOrderForCustomerByProductName($request['product_name'], (int) $customer->id, (int) $user->id);
            }
        }

        if (!$customer || !$order || $request['start_date'] === '' || $request['end_date'] === '' || $request['amc_amount'] === '') {
            return $this->respond([
                'status' => false,
                'message' => 'Please send a valid customer mobile/customer_id, product name/product_id, and AMC details.',
            ], 422);
        }

        if (strtotime($request['start_date']) === false || strtotime($request['end_date']) === false || strtotime($request['start_date']) > strtotime($request['end_date'])) {
            return $this->respond([
                'status' => false,
                'message' => 'Please select valid AMC dates.',
            ], 422);
        }

        $status = (strtotime($request['end_date']) >= strtotime(date('Y-m-d'))) ? 1 : 0;

        $this->db->insert('amc_customer', [
            'customer_id' => (int) $customer->id,
            'product_id' => (int) $order->id,
            'store_id' => (int) $user->id,
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'status' => $status,
            'product_name' => $order->product_name,
            'amc_amount' => $request['amc_amount'],
            'created_at' => date('Y-m-d'),
        ]);

        $amcId = (int) $this->db->insert_id();
        $amc = $this->getAmcById($amcId, (int) $user->id);

        return $this->respond([
            'status' => true,
            'message' => 'AMC added successfully.',
            'data' => $this->buildAmcPayload($amc),
        ], 201);
    }

    public function edit_amc()
    {
        $methodError = $this->ensureMethod('PUT');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getAmcRequestData();
        $amc = $this->getAmcById((int) $request['id'], (int) $user->id);

        if (!$amc) {
            return $this->respond([
                'status' => false,
                'message' => 'AMC record not found.',
            ], 404);
        }

        $customer = null;
        $order = null;

        if ((int) $request['customer_id'] > 0) {
            $customer = $this->getOwnedCustomer($request['customer_id'], (int) $user->id);
        } elseif ($request['customer_mobile'] !== '') {
            $customer = $this->getOwnedCustomerByMobile($request['customer_mobile'], (int) $user->id);
        }

        if ($customer) {
            if ((int) $request['product_id'] > 0) {
                $order = $this->getOwnedOrderForCustomer($request['product_id'], (int) $customer->id, (int) $user->id);
            } elseif ($request['product_name'] !== '') {
                $order = $this->getOwnedOrderForCustomerByProductName($request['product_name'], (int) $customer->id, (int) $user->id);
            }
        }

        if (!$customer || !$order || $request['start_date'] === '' || $request['end_date'] === '' || $request['amc_amount'] === '') {
            return $this->respond([
                'status' => false,
                'message' => 'Please send a valid customer mobile/customer_id, product name/product_id, and AMC details.',
            ], 422);
        }

        if (strtotime($request['start_date']) === false || strtotime($request['end_date']) === false || strtotime($request['start_date']) > strtotime($request['end_date'])) {
            return $this->respond([
                'status' => false,
                'message' => 'Please select valid AMC dates.',
            ], 422);
        }

        $status = (strtotime($request['end_date']) >= strtotime(date('Y-m-d'))) ? 1 : 0;

        $this->db
            ->where('id', (int) $request['id'])
            ->where('store_id', (int) $user->id)
            ->update('amc_customer', [
                'customer_id' => (int) $customer->id,
                'product_id' => (int) $order->id,
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'status' => $status,
                'product_name' => $order->product_name,
                'amc_amount' => $request['amc_amount'],
            ]);

        $updatedAmc = $this->getAmcById((int) $request['id'], (int) $user->id);

        return $this->respond([
            'status' => true,
            'message' => 'AMC updated successfully.',
            'data' => $this->buildAmcPayload($updatedAmc),
        ]);
    }

    public function delete_amc($id = 0)
    {
        $methodError = $this->ensureMethod('DELETE');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getAmcRequestData();
        $amcId = (int) ($id > 0 ? $id : $request['id']);
        $amc = $this->getAmcById($amcId, (int) $user->id);

        if (!$amc) {
            return $this->respond([
                'status' => false,
                'message' => 'AMC record not found.',
            ], 404);
        }

        $this->db->delete('amc_customer', [
            'id' => $amcId,
            'store_id' => (int) $user->id,
        ]);

        return $this->respond([
            'status' => true,
            'message' => 'AMC deleted successfully.',
            'data' => [
                'id' => $amcId,
                'customer_name' => (string) ($amc->customer_name ?? ''),
                'product_name' => (string) ($amc->product_name ?? ''),
            ],
        ]);
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

        $this->db->from('customers');
        $this->db->where('store_id', (int) $user->id);

        if ($search !== '') {
            $this->db->group_start()
                ->like('name', $search)
                ->or_like('mobile', $search)
                ->or_like('address', $search)
                ->group_end();
        }

        $customers = $this->db
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        $data = array_map(function ($customer) {
            return $this->buildCustomerPayload($customer);
        }, $customers);

        return $this->respond([
            'status' => true,
            'message' => 'Customers fetched successfully.',
            'data' => $data,
            'total' => count($data),
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
            return $this->respond([
                'status' => false,
                'message' => 'Customer id is required.',
            ], 422);
        }

        $customer = $this->getCustomerById($customerId, (int) $user->id);

        if (!$customer) {
            return $this->respond([
                'status' => false,
                'message' => 'Customer not found.',
            ], 404);
        }

        $orders = $this->db
            ->select('id, product_name, product_modal, date_of_purchase, price, payment_type, created_at')
            ->where('customer_id', $customerId)
            ->where('store_id', (int) $user->id)
            ->order_by('id', 'DESC')
            ->get('orders')
            ->result();

        return $this->respond([
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
        ]);
    }

    public function service_list()
    {
        // ✅ Check request method
        $methodError = $this->ensureMethod('GET');
        if ($methodError !== null) {
            return $methodError;
        }

        // ✅ Authenticate user
        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
        if ($errorResponse !== null) {
            return $errorResponse;
        }

        // ✅ Get filters
        $filters = $this->getServiceRequestData();
        $month   = $this->input->get('month'); // january, february, etc.
        $year    = $this->input->get('year') ? (int)$this->input->get('year') : date('Y');

        // ✅ Start query
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
            ->where('orders.store_id', (int) $user->id);

        // ✅ Status filter
        if ($filters['status'] !== null) {
            $this->db->where('service_log.status', (int) $filters['status']);
        }

        // ✅ Month filter
        if (!empty($month)) {
            $monthNumber = date('m', strtotime($month)); // convert january → 01
            $this->db->where('MONTH(service_log.service_date)', $monthNumber);
            $this->db->where('YEAR(service_log.service_date)', $year);
        }

        // ✅ Fetch data (latest first)
        $services = $this->db
            ->order_by('service_log.service_date', 'DESC')
            ->order_by('service_log.service_number', 'DESC')
            ->get()
            ->result();

        // ✅ Format response
        $data = array_map(function ($service) {
            return $this->buildServicePayload($service);
        }, $services);

        return $this->respond([
            'code' => 200,
            'status'  => true,
            'message' => 'Services fetched successfully.',
            'data'    => $data,
            'total'   => count($data),
        ]);
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
            return $this->respond([
                'status' => false,
                'message' => 'Service id is required.',
            ], 422);
        }

        $service = $this->getServiceById($serviceId, (int) $user->id);

        if (!$service) {
            return $this->respond([
                'status' => false,
                'message' => 'Service not found.',
            ], 404);
        }

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Service id is required.',
            ], 422);
        }

        $service = $this->getServiceById($serviceId, (int) $user->id);

        if (!$service) {
            return $this->respond([
                'status' => false,
                'message' => 'Service not found.',
            ], 404);
        }

        if ($request['status'] === null) {
            return $this->respond([
                'status' => false,
                'message' => 'Status is required.',
            ], 422);
        }

        if (!in_array((int) $request['status'], [0, 1], true)) {
            return $this->respond([
                'status' => false,
                'message' => 'Service status must be 0 or 1.',
            ], 422);
        }

        $this->db->where('id', $serviceId)->update('service_log', [
            'status' => (int) $request['status'],
            'update_at' => date('Y-m-d'),
        ]);
        $updatedService = $this->getServiceById($serviceId, (int) $user->id);

        return $this->respond([
            'status' => true,
            'message' => 'Service status updated successfully.',
            'data' => $this->buildServicePayload($updatedService),
        ]);
    }

    public function emi_list()
    {
        $methodError = $this->ensureMethod('GET');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $filters = $this->getEmiRequestData();

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
            ->where('orders.store_id', (int) $user->id);

        if ($filters['status'] !== null) {
            $this->db->where('emi_logs.status', (int) $filters['status']);
        }

        $emis = $this->db
            ->order_by('emi_logs.emi_date', 'ASC')
            ->order_by('emi_logs.emi_number', 'ASC')
            ->get()
            ->result();

        $data = array_map(function ($emi) {
            return $this->buildEmiPayload($emi);
        }, $emis);

        return $this->respond([
            'status' => true,
            'message' => 'EMI records fetched successfully.',
            'data' => $data,
            'total' => count($data),
        ]);
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
            return $this->respond([
                'status' => false,
                'message' => 'EMI id is required.',
            ], 422);
        }

        $emi = $this->getEmiById($emiId, (int) $user->id);

        if (!$emi) {
            $emiRecord = $this->getEmiById($emiId);

            if ($emiRecord) {
                return $this->respond([
                    'status' => false,
                    'message' => 'This EMI record belongs to another account.',
                    'requested_emi_id' => $emiId,
                    'order_id' => isset($emiRecord->order_id) ? (int) $emiRecord->order_id : 0,
                ], 403);
            }

            return $this->respond([
                'status' => false,
                'message' => 'EMI record not found.',
            ], 404);
        }

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'EMI id is required.',
            ], 422);
        }

        $emi = $this->getEmiById($emiId, (int) $user->id);

        if (!$emi) {
            $emiRecord = $this->getEmiById($emiId);

            if ($emiRecord) {
                return $this->respond([
                    'status' => false,
                    'message' => 'You are not allowed to update this EMI record.',
                    'requested_emi_id' => $emiId,
                    'order_id' => isset($emiRecord->order_id) ? (int) $emiRecord->order_id : 0,
                ], 403);
            }

            return $this->respond([
                'status' => false,
                'message' => 'EMI record not found.',
            ], 404);
        }

        if ($request['status'] === null) {
            return $this->respond([
                'status' => false,
                'message' => 'Status is required.',
            ], 422);
        }

        if (!in_array((int) $request['status'], [0, 1], true)) {
            return $this->respond([
                'status' => false,
                'message' => 'EMI status must be 0 or 1.',
            ], 422);
        }

        $this->db->where('id', $emiId)->update('emi_logs', [
            'status' => (int) $request['status'],
            'update_at' => date('Y-m-d'),
        ]);
        $updatedEmi = $this->getEmiById($emiId, (int) $user->id);

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Customer id is required.',
            ], 422);
        }

        if ($request['name'] === '' || $request['mobile'] === '') {
            return $this->respond([
                'status' => false,
                'message' => 'Customer name and mobile are required.',
            ], 422);
        }

        if (strlen($request['mobile']) < 10) {
            return $this->respond([
                'status' => false,
                'message' => 'Please enter a valid mobile number.',
            ], 422);
        }

        $customer = $this->getOwnedCustomer($customerId, (int) $user->id);

        if (!$customer) {
            return $this->respond([
                'status' => false,
                'message' => 'Customer not found.',
            ], 404);
        }

        $mobileExists = $this->db
            ->where('mobile', $request['mobile'])
            ->where('store_id', (int) $user->id)
            ->where('id !=', $customerId)
            ->count_all_results('customers');

        if ($mobileExists > 0) {
            return $this->respond([
                'status' => false,
                'message' => 'This mobile number is already used by another customer.',
            ], 409);
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

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Customer id is required.',
            ], 422);
        }

        $customer = $this->getOwnedCustomer($customerId, (int) $user->id);

        if (!$customer) {
            return $this->respond([
                'status' => false,
                'message' => 'Customer not found.',
            ], 404);
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

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Order id is required.',
            ], 422);
        }

        $order = $this->getOwnedOrder($orderId, (int) $user->id);

        if (!$order) {
            return $this->respond([
                'status' => false,
                'message' => 'Order not found.',
            ], 404);
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
            return $this->respond([
                'status' => false,
                'message' => 'Product name, purchase date and price are required.',
            ], 422);
        }

        if (!$this->isValidDate($purchaseDate)) {
            return $this->respond([
                'status' => false,
                'message' => 'Purchase date must be in Y-m-d format.',
            ], 422);
        }

        if ($price <= 0) {
            return $this->respond([
                'status' => false,
                'message' => 'Price must be greater than 0.',
            ], 422);
        }

        if ($downPayment < 0 || $downPayment > $price) {
            return $this->respond([
                'status' => false,
                'message' => 'Down payment must be between 0 and order price.',
            ], 422);
        }

        if ($paymentType === 1) {
            if ($emiMonths <= 0) {
                return $this->respond([
                    'status' => false,
                    'message' => 'EMI duration is required for EMI orders.',
                ], 422);
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

        return $this->respond([
            'status' => true,
            'message' => 'Order updated successfully.',
            'data' => $this->buildOrderPayload($updatedOrder),
        ]);
    }

    public function add_order()
    {
        $methodError = $this->ensureMethod('POST');

        if ($methodError !== null) {
            return $methodError;
        }

        list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();

        if ($errorResponse !== null) {
            return $errorResponse;
        }

        $request = $this->getOrderRequestData();
        $paymentType = $this->normalizePaymentType($request['payment_type']);
        $price = (float) $request['price'];
        $downPayment = (float) ($request['down_payment'] === '' ? 0 : $request['down_payment']);
        $emiMonths = max(0, (int) $request['emi_month']);
        $serviceInterval = max(0, (int) $request['service_interval']);
        $totalServices = max(0, (int) $request['total_services']);

        if ($request['product_name'] === '' || $request['customer_mobile'] === '' || $request['date_of_purchase'] === '' || $request['price'] === '') {
            return $this->respond([
                'status' => false,
                'message' => 'Customer mobile, product name, purchase date and price are required.',
            ], 422);
        }

        if (!$this->isValidDate($request['date_of_purchase'])) {
            return $this->respond([
                'status' => false,
                'message' => 'Purchase date must be in Y-m-d format.',
            ], 422);
        }

        if (strlen($request['customer_mobile']) < 10) {
            return $this->respond([
                'status' => false,
                'message' => 'Please enter a valid customer mobile number.',
            ], 422);
        }

        if ($price <= 0) {
            return $this->respond([
                'status' => false,
                'message' => 'Price must be greater than 0.',
            ], 422);
        }

        if ($downPayment < 0 || $downPayment > $price) {
            return $this->respond([
                'status' => false,
                'message' => 'Down payment must be between 0 and order price.',
            ], 422);
        }

        if ($paymentType === 1) {
            if ($emiMonths <= 0 || $request['emi_date'] === '') {
                return $this->respond([
                    'status' => false,
                    'message' => 'EMI month and EMI date are required for EMI orders.',
                ], 422);
            }

            if (!$this->isValidDate($request['emi_date'])) {
                return $this->respond([
                    'status' => false,
                    'message' => 'EMI date must be in Y-m-d format.',
                ], 422);
            }
        }

        $customerId = (int) $request['customer_id'];
        $customer = null;

        if ($customerId > 0) {
            $customer = $this->getOwnedCustomer($customerId, (int) $user->id);

            if (!$customer) {
                return $this->respond([
                    'status' => false,
                    'message' => 'Customer not found.',
                ], 404);
            }
        } else {
            $customer = $this->db
                ->where('mobile', $request['customer_mobile'])
                ->where('store_id', (int) $user->id)
                ->get('customers')
                ->row();

            if (!$customer) {
                if ($request['customer_name'] === '') {
                    return $this->respond([
                        'status' => false,
                        'message' => 'Customer name is required when customer_id is not provided.',
                    ], 422);
                }

                $this->db->insert('customers', [
                    'store_id' => (int) $user->id,
                    'name' => $request['customer_name'],
                    'mobile' => $request['customer_mobile'],
                    'address' => $request['address'],
                ]);

                $customerId = (int) $this->db->insert_id();
                $customer = $this->getOwnedCustomer($customerId, (int) $user->id);
            } else {
                $customerId = (int) $customer->id;
            }
        }

        $emiAmount = $paymentType === 1 && $emiMonths > 0 ? (($price - $downPayment) / $emiMonths) : 0;

        $this->db->trans_start();

        $this->db->insert('orders', [
            'store_id' => (int) $user->id,
            'customer_id' => $customerId,
            'product_name' => $request['product_name'],
            'product_modal' => $request['product_modal'],
            'date_of_purchase' => $request['date_of_purchase'],
            'price' => $price,
            'down_payment' => $downPayment,
            'emi_amount' => $emiAmount,
            'emi_duration' => $emiMonths,
            'payment_type' => $paymentType,
            'service_interval' => $serviceInterval,
            'total_services' => $totalServices,
        ]);

        $orderId = (int) $this->db->insert_id();

        for ($i = 1; $i <= $totalServices; $i++) {
            $serviceDate = date('Y-m-d', strtotime('+' . ($serviceInterval * ($i - 1)) . ' month', strtotime($request['date_of_purchase'])));

            $this->db->insert('service_log', [
                'order_id' => $orderId,
                'customer_id' => $customerId,
                'service_number' => $i,
                'assign_to' => 0,
                'status' => 0,
                'customer_status' => 0,
                'service_date' => $serviceDate,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        if ($paymentType === 1) {
            for ($i = 1; $i <= $emiMonths; $i++) {
                $this->db->insert('emi_logs', [
                    'order_id' => $orderId,
                    'customer_id' => $customerId,
                    'emi_number' => $i,
                    'status' => 0,
                    'status_customer' => 0,
                    'emi_date' => date('Y-m-d', strtotime('+' . ($i - 1) . ' month', strtotime($request['emi_date']))),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        $this->db->trans_complete();

        $order = $this->getOrderById($orderId, (int) $user->id);

        return $this->respond([
            'status' => true,
            'message' => 'Order added successfully.',
            'data' => $this->buildOrderPayload($order),
        ], 201);
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
            return $this->respond([
                'status' => false,
                'message' => 'Order not found.',
            ], 404);
        }

        return $this->respond([
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
            return $this->respond([
                'status' => false,
                'message' => 'Order id is required.',
            ], 422);
        }

        $order = $this->getOrderById($orderId, (int) $user->id);

        if (!$order) {
            return $this->respond([
                'status' => false,
                'message' => 'Order not found.',
            ], 404);
        }

        $this->db->trans_start();

        $this->db->where('order_id', $orderId)->delete('emi_logs');
        $this->db->where('order_id', $orderId)->delete('service_log');
        $this->db->where('id', $orderId)->where('store_id', (int) $user->id)->delete('orders');

        $this->db->trans_complete();

        return $this->respond([
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
}
