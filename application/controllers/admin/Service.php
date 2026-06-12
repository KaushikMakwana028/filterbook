<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller
{
    private $admin;
    private $store_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_model');
        $this->load->model('Customer_model');
        $this->load->library('session');
        $this->load->library('subscription_guard');

        $this->admin = $this->session->userdata('admin');
        if (!$this->admin) {
            redirect(site_url('admin/login'));
        }

        $this->subscription_guard->enforce((int) $this->admin['id']);

        $this->store_id = (int) $this->admin['id'];
    }

    public function index()
    {
        $data['services'] = $this->Service_model->get_all($this->store_id);

        $this->load->view('admin/header');
        $this->load->view('admin/service_list', $data);
        $this->load->view('admin/footer');
    }

    public function view($id = null)
    {
        $data['service'] = $this->Service_model->get((int) $id, $this->store_id);

        if (!$data['service']) {
            show_404();
        }

        $this->load->view('admin/header');
        $this->load->view('admin/service_detail', $data);
        $this->load->view('admin/footer');
    }

    public function add()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/add_custom_service');
        $this->load->view('admin/footer');
    }

    public function save()
    {
        $customer_id = (int) $this->input->post('customer_id', true);
        $customer_name = trim((string) $this->input->post('customer_name', true));
        $mobile = preg_replace('/\D+/', '', (string) $this->input->post('mobile', true));
        $address = trim((string) $this->input->post('address', true));
        $product_name = trim((string) $this->input->post('product_name', true));
        $total_services = max(1, (int) $this->input->post('total_services', true));
        $service_interval = max(1, (int) $this->input->post('service_interval', true));
        $start_service_date = trim((string) $this->input->post('start_service_date', true));

        if (
            $customer_name === '' ||
            $mobile === '' ||
            $address === '' ||
            $product_name === '' ||
            $start_service_date === '' ||
            !preg_match('/^\d{4}-\d{2}-\d{2}$/', $start_service_date)
        ) {
            show_404();
        }

        $customer = null;
        if ($customer_id > 0) {
            $customer = $this->db
                ->where('id', $customer_id)
                ->where('store_id', $this->store_id)
                ->get('customers')
                ->row();
        }

        if (!$customer) {
            $customer = $this->db
                ->where('mobile', $mobile)
                ->where('store_id', $this->store_id)
                ->get('customers')
                ->row();
        }

        if ($customer) {
            $customer_id = (int) $customer->id;
            $this->db->where('id', $customer_id)->update('customers', [
                'name' => $customer_name,
                'mobile' => $mobile,
                'address' => $address
            ]);
        } else {
            $this->db->insert('customers', [
                'store_id' => $this->store_id,
                'name' => $customer_name,
                'mobile' => $mobile,
                'address' => $address,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $customer_id = (int) $this->db->insert_id();
        }

        $purchase_date = $start_service_date;

        $this->db->insert('orders', [
            'store_id' => $this->store_id,
            'customer_id' => $customer_id,
            'product_name' => $product_name,
            'product_modal' => '',
            'date_of_purchase' => $purchase_date,
            'price' => 0,
            'down_payment' => 0,
            'emi_amount' => 0,
            'emi_duration' => 0,
            'payment_type' => 0,
            'service_interval' => $service_interval,
            'total_services' => $total_services,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $order_id = (int) $this->db->insert_id();

        for ($i = 1; $i <= $total_services; $i++) {
            $service_date = date('Y-m-d', strtotime('+' . ($service_interval * ($i - 1)) . ' month', strtotime($start_service_date)));
            $this->Service_model->add_custom_service($order_id, $customer_id, $service_date, $i);
        }

        redirect(site_url('admin/service'));
    }

    public function mark_done($id = null)
    {
        if ($id) {
            $this->Service_model->mark_done((int) $id, $this->store_id);
        }

        redirect(site_url('admin/service'));
    }

    public function search_customers()
    {
        $query = trim((string) $this->input->get('q', true));
        header('Content-Type: application/json');

        if ($query === '') {
            echo json_encode([]);
            return;
        }

        $customers = $this->Customer_model->search_customers($query, $this->store_id);
        echo json_encode($customers);
    }
}
