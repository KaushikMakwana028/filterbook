<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('jwt_service');
        $this->load->model('Dashboard_model', 'dashboard_model');
        $this->load->model('general_model');
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

        if ($method !== $expectedMethod) {
            return $this->respond([
                'status' => false,
                'message' => 'Invalid request method. Use ' . $expectedMethod . '.',
            ], 405);
        }

        return null;
    }

    private function getBearerToken()
    {
        $authorization = (string) $this->input->get_request_header('Authorization', true);

        if (preg_match('/Bearer\s+(\S+)/i', $authorization, $matches)) {
            return $matches[1];
        }

        return '';
    }

    private function getAuthenticatedUser()
    {
        $token = $this->getBearerToken();

        if ($token === '') {
            return [null, $this->respond([
                'code' => 400,

                'status' => false,
                'message' => 'Authorization token is required.',
            ], 400)];
        }

        try {
            $payload = $this->jwt_service->decode($token);
        } catch (Exception $e) {
            return [null, $this->respond([
                'status' => false,
                'message' => $e->getMessage(),
            ], 401)];
        }

        $userId = isset($payload['sub']) ? (int) $payload['sub'] : 0;
        $user = $this->db
            ->where('id', $userId)
            ->where('role', 2)
            ->get('users')
            ->row();

        if (!$user) {
            return [null, $this->respond([
                'status' => false,
                'message' => 'User not found.',
            ], 404)];
        }

        return [$user, null];
    }

    private function mapUpcomingEmi($items)
    {
        return array_map(function ($item) {
            return [
                'id' => (int) $item->id,
                'customer_id' => isset($item->customer_id) ? (int) $item->customer_id : 0,
                'order_id' => isset($item->order_id) ? (int) $item->order_id : 0,
                'customer_name' => (string) ($item->customer_name ?? ''),
                'customer_mobile' => (string) ($item->customer_mobile ?? ''),
                'product_name' => (string) ($item->product_name ?? ''),
                'price' => isset($item->price) ? (float) $item->price : 0,
                'emi_date' => (string) ($item->emi_date ?? ''),
                'status' => isset($item->status) ? (int) $item->status : 0,
            ];
        }, $items);
    }

    private function mapUpcomingServices($items)
    {
        return array_map(function ($item) {
            return [
                'id' => (int) $item->id,
                'customer_id' => isset($item->customer_id) ? (int) $item->customer_id : 0,
                'order_id' => isset($item->order_id) ? (int) $item->order_id : 0,
                'customer_name' => (string) ($item->customer_name ?? ''),
                'customer_mobile' => (string) ($item->customer_mobile ?? ''),
                'product_name' => (string) ($item->product_name ?? ''),
                'price' => isset($item->price) ? (float) $item->price : 0,
                'service_date' => (string) ($item->service_date ?? ''),
                'status' => isset($item->status) ? (int) $item->status : 0,
            ];
        }, $items);
    }

    private function mapUpcomingAmc($items)
    {
        return array_map(function ($item) {
            return [
                'id' => (int) $item->id,
                'customer_id' => isset($item->customer_id) ? (int) $item->customer_id : 0,
                'product_id' => isset($item->product_id) ? (int) $item->product_id : 0,
                'customer_name' => (string) ($item->customer_name ?? ''),
                'customer_mobile' => (string) ($item->customer_mobile ?? ''),
                'product_name' => (string) ($item->product_name ?? ''),
                'start_date' => (string) ($item->start_date ?? ''),
                'end_date' => (string) ($item->end_date ?? ''),
                'amount' => isset($item->amount) ? (float) $item->amount : 0,
            ];
        }, $items);
    }

    private function mapComplaints($items)
    {
        return array_map(function ($item) {
            return [
                'id' => (int) $item->id,
                'name' => (string) ($item->name ?? ''),
                'mobile' => (string) ($item->mobile ?? ''),
                'product_name' => (string) ($item->product_name ?? ''),
                'serial_number' => (string) ($item->serial_number ?? ''),
                'issue' => (string) ($item->issue ?? ''),
                'complain_details' => (string) ($item->complain_details ?? ''),
                'status' => isset($item->status) ? (int) $item->status : 0,
                'created_at' => (string) ($item->created_at ?? ''),
            ];
        }, $items);
    }

 public function index()
{
    $methodError = $this->ensureMethod('GET');

    if ($methodError !== null) {
        return $methodError;
    }

    list($user, $errorResponse) = $this->getAuthenticatedUser();

    if ($errorResponse !== null) {
        return $errorResponse;
    }

    $storeId = (int) $user->id;

    // ✅ Get latest active/trial plan
    $plan = $this->db
        ->from('user_subscriptions')
        ->where('user_id', $storeId)
        ->group_start()
            ->where('status', 'active')
            ->or_where('status', 'trial')
        ->group_end()
        ->where('end_date >=', date('Y-m-d'))
        ->order_by('id', 'DESC')
        ->get()
        ->row();

    // ✅ Default expiry data
    $hasExpireWarning = false;
    $expireMessage = '';
    $daysLeft = 0;

    // ✅ Check expiry within 5 days
    if ($plan && !empty($plan->end_date)) {

        $today = new DateTime(date('Y-m-d'));
        $endDate = new DateTime($plan->end_date);

        $daysLeft = (int) $today->diff($endDate)->format('%a');

        if ($daysLeft <= 5) {

            $hasExpireWarning = true;

            if ($daysLeft == 0) {
                $expireMessage = 'Your plan expires today.';
            } elseif ($daysLeft == 1) {
                $expireMessage = 'Your plan expires after 1 day.';
            } else {
                $expireMessage = 'Your plan expires after ' . $daysLeft . ' days.';
            }
        }
    }

    $startDate = date('Y-m-01');
    $endDate   = date('Y-m-t');

    $upcomingEmi       = $this->dashboard_model->get_upcoming_emi($storeId);
    $upcomingServices  = $this->dashboard_model->get_upcoming_services($storeId);
    $upcomingAmcExpiry = $this->dashboard_model->get_upcoming_amc_expiry($storeId);
    $latestComplaints  = $this->dashboard_model->get_latest_complaints($storeId, 3);

    $customers         = (int) $this->general_model->getCount('customers', ['store_id' => $storeId]);

    $thisMonthCustomers = (int) $this->general_model->getCount(
        'customers',
        ['store_id' => $storeId],
        null,
        'created_at',
        ['start' => $startDate, 'end' => $endDate]
    );

    $totalAmc = (int) $this->general_model->getCount(
        'amc_customer',
        ['store_id' => $storeId]
    );

    $thisMonthAmc = (int) $this->general_model->getCount(
        'amc_customer',
        ['store_id' => $storeId],
        null,
        'created_at',
        ['start' => $startDate, 'end' => $endDate]
    );

    $orders = (int) $this->general_model->getCount(
        'orders',
        ['store_id' => $storeId]
    );

    $thisMonthOrders = (int) $this->general_model->getCount(
        'orders',
        ['store_id' => $storeId],
        null,
        'created_at',
        ['start' => $startDate, 'end' => $endDate]
    );

    $complaints = (int) $this->general_model->getCount(
        'complaint',
        ['store_id' => $storeId, 'status' => 1]
    );

    $thisMonthComplaints = (int) $this->general_model->getCount(
        'complaint',
        ['store_id' => $storeId, 'status' => 1],
        null,
        'created_at',
        ['start' => $startDate, 'end' => $endDate]
    );

    $serviceCounts = $this->general_model->getServiceStatusCountsThisMonth($storeId);
    $emiCounts     = $this->general_model->getEmiStatusCountsThisMonth($storeId);

    return $this->respond([
        'code'   => 200,
        'status' => true,
        'message' => 'Dashboard data fetched successfully.',

        // ✅ Plan expiry warning
       'plan_expire_warning' => [
    'message' => $expireMessage,
],

        'data' => [

            'user' => [
                'id'         => (int) $user->id,
                'name'       => (string) $user->name,
                'store_name' => (string) ($user->store_name ?? ''),
                'email'      => (string) ($user->email ?? ''),
                'mobile'     => (string) ($user->mobile ?? ''),
            ],

            'period' => [
                'month_name' => date('F Y'),
                'start_date' => $startDate,
                'end_date'   => $endDate,
            ],

            'summary' => [
                'orders'                        => $orders,
                'customers'                     => $customers,
                'complaints'                    => $complaints,
                'amc'                           => $totalAmc,
                'this_month_orders'             => $thisMonthOrders,
                'this_month_customers'          => $thisMonthCustomers,
                'this_month_complaints'         => $thisMonthComplaints,
                'this_month_amc'                => $thisMonthAmc,
                'this_month_services'           => (int) $this->general_model->getServiceCountThisMonth($storeId),
                'this_month_pending_services'   => (int) $serviceCounts['pending_services'],
                'this_month_fulfilled_services' => (int) $serviceCounts['fulfilled_services'],
                'this_month_emi_customers'      => (int) $emiCounts['emi_customers'],
                'this_month_pending_emis'       => (int) $emiCounts['pending_emis'],
                'this_month_paid_emis'          => (int) $emiCounts['paid_emis'],
            ],

            'upcoming' => [
                'emi'        => $this->mapUpcomingEmi($upcomingEmi),
                'services'   => $this->mapUpcomingServices($upcomingServices),
                'amc_expiry' => $this->mapUpcomingAmc($upcomingAmcExpiry),
            ],

            'latest_complaints' => $this->mapComplaints($latestComplaints),
        ],
    ]);
}
}
