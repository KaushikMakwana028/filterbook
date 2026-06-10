<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan extends CI_Controller
{
    private $admin;
    private $userId;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Plan_model');
        $this->config->load('razorpay');

        $this->admin = $this->session->userdata('admin');

        if (!$this->admin) {
            redirect(site_url('admin/login'));
        }

        $this->userId = (int) (is_array($this->admin) ? ($this->admin['id'] ?? 0) : 0);

        if ($this->userId <= 0) {
            redirect(site_url('admin/login'));
        }
    }

    public function index()
    {
        $data['plans'] = $this->Plan_model->get_plan_catalog();
        $data['plan_summary'] = $this->Plan_model->get_plan_summary($this->userId);
        $data['user'] = $this->db->get_where('users', ['id' => $this->userId])->row();
        $data['razorpay_key_id'] = (string) config_item('razorpay_key_id');
        $data['razorpay_company_name'] = (string) config_item('razorpay_company_name');
        $data['razorpay_logo_url'] = (string) config_item('razorpay_logo_url');
        $data['razorpay_theme_color'] = (string) config_item('razorpay_theme_color');
        $data['razorpay_test_mode'] = (bool) config_item('razorpay_test_mode');
        $data['razorpay_test_amount'] = (float) config_item('razorpay_test_amount');

        $this->load->view('admin/header');
        $this->load->view('admin/plan', $data);
        $this->load->view('admin/footer');
    }

    public function activate($planCode = '')
    {
        $planCode = trim((string) $planCode);

        if ($planCode === '') {
            show_404();
        }

        $activated = $this->Plan_model->activate_plan($this->userId, $planCode);

        if ($activated) {
            // ✅ Update session - mark plan as active
            $admin = $this->session->userdata('admin');
            if ($admin) {
                $admin['plan_expired']    = false;
                $admin['has_active_plan'] = true;
                $this->session->set_userdata('admin', $admin);

                // ✅ Make session persistent (survive browser close) - 30 days
                setcookie(
                    $this->config->item('sess_cookie_name'),
                    $this->session->session_id,
                    time() + (30 * 24 * 60 * 60),
                    '/',
                    '',
                    false,
                    true
                );
            }

            $summary = $this->Plan_model->get_plan_summary($this->userId);
            $this->session->set_flashdata('success', ($summary['plan_name'] ?? 'Plan') . ' activated successfully.');
        } else {
            $blockMessage = $this->Plan_model->get_plan_change_block_message($this->userId);
            $this->session->set_flashdata('error', $blockMessage !== '' ? $blockMessage : 'Unable to activate the selected plan.');
        }

        redirect(site_url('admin/plan'));
    }

    public function create_order()
    {
        if (strtoupper((string) $this->input->server('REQUEST_METHOD')) !== 'POST') {
            return $this->jsonResponse(['status' => false, 'message' => 'Invalid request method.'], 405);
        }

        $keyId = trim((string) config_item('razorpay_key_id'));
        $keySecret = trim((string) config_item('razorpay_key_secret'));
        $currency = trim((string) config_item('razorpay_currency'));

        if ($keyId === '' || $keySecret === '') {
            return $this->jsonResponse([
                'status' => false,
                'message' => 'Razorpay keys are missing. Update application/config/razorpay.php first.',
            ], 500);
        }

        if (!$this->Plan_model->can_activate_plan($this->userId)) {
            return $this->jsonResponse([
                'status' => false,
                'message' => $this->Plan_model->get_plan_change_block_message($this->userId),
            ], 422);
        }

        $planCode = trim((string) $this->input->post('plan_code', true));
        $plan = $this->Plan_model->get_checkout_plan($planCode);
        $displayAmount = $this->getPayableAmount($plan);

        if (!$plan) {
            return $this->jsonResponse(['status' => false, 'message' => 'Selected plan is not available.'], 422);
        }

        $receipt = 'plan_' . $this->userId . '_' . time();
        $orderPayload = [
            'amount' => (int) round($displayAmount * 100),
            'currency' => $currency !== '' ? $currency : 'INR',
            'receipt' => $receipt,
            'notes' => [
                'user_id' => (string) $this->userId,
                'plan_code' => (string) $plan['code'],
                'plan_name' => (string) $plan['name'],
            ],
        ];

        $gatewayResponse = $this->createRazorpayOrder($orderPayload, $keyId, $keySecret);

        if (empty($gatewayResponse['status'])) {
            return $this->jsonResponse([
                'status' => false,
                'message' => (string) ($gatewayResponse['message'] ?? 'Unable to create Razorpay order.'),
            ], 502);
        }

        $paymentOrder = $this->Plan_model->create_payment_order($this->userId, $plan, $gatewayResponse['data']);

        if (!$paymentOrder) {
            return $this->jsonResponse(['status' => false, 'message' => 'Unable to save payment order.'], 500);
        }

        return $this->jsonResponse([
            'status' => true,
            'message' => 'Order created successfully.',
            'order' => $gatewayResponse['data'],
            'plan' => [
                'code' => $plan['code'],
                'name' => $plan['name'],
                'price' => $displayAmount,
                'price_label' => 'Rs ' . number_format($displayAmount, 0),
            ],
            'prefill' => [
                'name' => (string) ($this->admin['name'] ?? ''),
                'email' => (string) ($this->admin['email'] ?? ''),
                'contact' => (string) ($this->admin['phone'] ?? ''),
            ],
        ]);
    }


    public function verify_payment()
    {
        if (strtoupper((string) $this->input->server('REQUEST_METHOD')) !== 'POST') {
            show_404();
        }

        $keySecret         = trim((string) config_item('razorpay_key_secret'));
        $razorpayPaymentId = trim((string) $this->input->post('razorpay_payment_id', true));
        $razorpayOrderId   = trim((string) $this->input->post('razorpay_order_id', true));
        $razorpaySignature = trim((string) $this->input->post('razorpay_signature', true));

        if ($keySecret === '' || $razorpayPaymentId === '' || $razorpayOrderId === '' || $razorpaySignature === '') {
            $this->session->set_flashdata('error', 'Payment verification failed because required payment details were missing.');
            redirect(site_url('admin/plan'));
        }

        $paymentOrder = $this->Plan_model->get_payment_order($this->userId, $razorpayOrderId);

        if (!$paymentOrder) {
            $this->session->set_flashdata('error', 'Payment order not found for verification.');
            redirect(site_url('admin/plan'));
        }

        $generatedSignature = hash_hmac('sha256', $razorpayOrderId . '|' . $razorpayPaymentId, $keySecret);

        if (!hash_equals($generatedSignature, $razorpaySignature)) {
            $this->Plan_model->mark_payment_failed((int) $paymentOrder->id, $this->input->post(NULL, true) ?: []);
            $this->session->set_flashdata('error', 'Payment signature mismatch. Please try again.');
            redirect(site_url('admin/plan'));
        }

        $saved = $this->Plan_model->complete_payment_and_activate_plan($this->userId, (int) $paymentOrder->id, [
            'razorpay_payment_id' => $razorpayPaymentId,
            'razorpay_order_id'   => $razorpayOrderId,
            'razorpay_signature'  => $razorpaySignature,
        ]);

        if (!$saved) {
            $this->session->set_flashdata('error', 'Payment was received, but the plan could not be activated.');
            redirect(site_url('admin/plan'));
        }

        // ✅ Update session - mark plan as active and make persistent
        $admin = $this->session->userdata('admin');
        if ($admin) {
            $admin['plan_expired']    = false;
            $admin['has_active_plan'] = true;
            $this->session->set_userdata('admin', $admin);

            // ✅ Make session persistent (survive browser close) - 30 days
            setcookie(
                $this->config->item('sess_cookie_name'),
                $this->session->session_id,
                time() + (30 * 24 * 60 * 60),
                '/',
                '',
                false,
                true
            );
        }

        $summary = $this->Plan_model->get_plan_summary($this->userId);
        $this->session->set_flashdata('success', ($summary['plan_name'] ?? 'Plan') . ' activated successfully after payment.');
        redirect(site_url('admin/plan'));
    }

    public function payment_failed()
    {
        if (strtoupper((string) $this->input->server('REQUEST_METHOD')) !== 'POST') {
            return $this->jsonResponse(['status' => false, 'message' => 'Invalid request method.'], 405);
        }

        $razorpayOrderId = trim((string) $this->input->post('razorpay_order_id', true));
        $paymentOrder = $this->Plan_model->get_payment_order($this->userId, $razorpayOrderId);

        if ($paymentOrder) {
            $this->Plan_model->mark_payment_failed((int) $paymentOrder->id, $this->input->post(NULL, true) ?: []);
        }

        return $this->jsonResponse(['status' => true]);
    }

    private function createRazorpayOrder(array $payload, $keyId, $keySecret)
    {
        return $this->razorpayApiRequest('POST', 'https://api.razorpay.com/v1/orders', $payload, $keyId, $keySecret, 'Unable to create Razorpay order.');
    }

    private function razorpayApiRequest($method, $url, array $payload, $keyId, $keySecret, $defaultErrorMessage = 'Unable to connect to Razorpay.')
    {
        $method = strtoupper((string) $method);
        $ch = curl_init($url);

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $keyId . ':' . $keySecret,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_TIMEOUT => 30,
        ];

        if ($method === 'POST') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = json_encode($payload);
        } else {
            $options[CURLOPT_CUSTOMREQUEST] = $method;
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false) {
            return ['status' => false, 'message' => $curlError !== '' ? $curlError : $defaultErrorMessage];
        }

        $decoded = json_decode($response, true);

        if ($statusCode < 200 || $statusCode >= 300 || !is_array($decoded)) {
            $message = $defaultErrorMessage;

            if (is_array($decoded) && !empty($decoded['error']['description'])) {
                $message = (string) $decoded['error']['description'];
            }

            return ['status' => false, 'message' => $message, 'data' => $decoded];
        }

        return ['status' => true, 'data' => $decoded];
    }

    private function getPayableAmount($plan)
    {
        $amount = (float) ($plan['price'] ?? 0);

        // REMOVE TEST MODE LOGIC
        return $amount;
    }

    private function jsonResponse(array $payload, $statusCode = 200)
    {
        return $this->output
            ->set_status_header((int) $statusCode)
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }
}
