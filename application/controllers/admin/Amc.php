<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amc extends CI_Controller
{
    private $admin;
    private $store_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Amc_model');
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
        $data['amcs'] = $this->Amc_model->get_all($this->store_id);

        $this->load->view('admin/header');
        $this->load->view('admin/amc_list', $data);
        $this->load->view('admin/footer');
    }

    public function add()
    {
        $data['customers'] = $this->Amc_model->get_customer_choices($this->store_id);
        $data['is_edit'] = false;

        $this->load->view('admin/header');
        $this->load->view('admin/add_amc', $data);
        $this->load->view('admin/footer');
    }

    public function edit($id = 0)
    {
        $id = (int) $id;
        $amc = $this->Amc_model->get($id, $this->store_id);

        if (!$amc) {
            $this->session->set_flashdata('error', 'AMC record not found.');
            redirect(site_url('admin/amc'));
        }

        $data['customers'] = $this->Amc_model->get_customer_choices($this->store_id);
        $data['amc'] = $amc;
        $data['is_edit'] = true;

        $this->load->view('admin/header');
        $this->load->view('admin/add_amc', $data);
        $this->load->view('admin/footer');
    }

    public function view($id = 0)
    {
        $id = (int) $id;
        $amc = $this->Amc_model->get($id, $this->store_id);

        if (!$amc) {
            $this->session->set_flashdata('error', 'AMC record not found.');
            redirect(site_url('admin/amc'));
        }

        $data['amc'] = $amc;

        $this->load->view('admin/header');
        $this->load->view('admin/amc_detail', $data);
        $this->load->view('admin/footer');
    }

    public function customer_products($customer_id = 0)
    {
        $customer_id = (int) $customer_id;
        $products = [];

        if ($customer_id > 0) {
            $products = $this->Amc_model->get_customer_products($customer_id, $this->store_id);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'products' => $products
            ]));
    }

    public function save()
    {
        $customer_id = (int) $this->input->post('customer_id', true);
        $order_id = (int) $this->input->post('product_id', true);
        $start_date = trim((string) $this->input->post('start_date', true));
        $end_date = trim((string) $this->input->post('end_date', true));
        $amc_amount = trim((string) $this->input->post('amc_amount', true));

        $customer = $this->Amc_model->get_customer($customer_id, $this->store_id);
        $order = $this->Amc_model->get_customer_product($order_id, $customer_id, $this->store_id);

        if (!$customer || !$order || $start_date === '' || $end_date === '' || $amc_amount === '') {
            $this->session->set_flashdata('error', 'Please select a valid customer, product, and AMC details.');
            redirect(site_url('admin/amc/add'));
        }

        if (strtotime($start_date) === false || strtotime($end_date) === false || strtotime($start_date) > strtotime($end_date)) {
            $this->session->set_flashdata('error', 'Please select a valid customer, product, and AMC details.');
            redirect(site_url('admin/amc/add'));
        }

        $status = (strtotime($end_date) >= strtotime(date('Y-m-d'))) ? 1 : 0;

        $this->Amc_model->insert([
            'customer_id' => $customer_id,
            'product_id' => $order_id,
            'store_id' => $this->store_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => $status,
            'product_name' => $order->product_name,
            'amc_amount' => $amc_amount,
            'created_at' => date('Y-m-d')
        ]);

        $this->session->set_flashdata('success', 'AMC customer added successfully.');
        redirect(site_url('admin/amc'));
    }

    public function update($id = 0)
    {
        $id = (int) $id;
        $existing = $this->Amc_model->get($id, $this->store_id);

        if (!$existing) {
            $this->session->set_flashdata('error', 'AMC record not found.');
            redirect(site_url('admin/amc'));
        }

        $customer_id = (int) $this->input->post('customer_id', true);
        $order_id = (int) $this->input->post('product_id', true);
        $start_date = trim((string) $this->input->post('start_date', true));
        $end_date = trim((string) $this->input->post('end_date', true));
        $amc_amount = trim((string) $this->input->post('amc_amount', true));

        $customer = $this->Amc_model->get_customer($customer_id, $this->store_id);
        $order = $this->Amc_model->get_customer_product($order_id, $customer_id, $this->store_id);

        if (!$customer || !$order || $start_date === '' || $end_date === '' || $amc_amount === '') {
            $this->session->set_flashdata('error', 'Please select a valid customer, product, and AMC details.');
            redirect(site_url('admin/amc/edit/' . $id));
        }

        if (strtotime($start_date) === false || strtotime($end_date) === false || strtotime($start_date) > strtotime($end_date)) {
            $this->session->set_flashdata('error', 'Please select a valid customer, product, and AMC details.');
            redirect(site_url('admin/amc/edit/' . $id));
        }

        $status = (strtotime($end_date) >= strtotime(date('Y-m-d'))) ? 1 : 0;

        $this->Amc_model->update($id, $this->store_id, [
            'customer_id' => $customer_id,
            'product_id' => $order_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => $status,
            'product_name' => $order->product_name,
            'amc_amount' => $amc_amount,
        ]);

        $this->session->set_flashdata('success', 'AMC record updated successfully.');
        redirect(site_url('admin/amc'));
    }

    public function delete($id = 0)
    {
        $id = (int) $id;

        if ($id <= 0) {
            show_404();
        }

        $deleted = $this->Amc_model->delete($id, $this->store_id);

        if (!$deleted) {
            $this->session->set_flashdata('error', 'AMC record not found or already deleted.');
            redirect(site_url('admin/amc'));
        }

        $this->session->set_flashdata('success', 'AMC record deleted successfully.');
        redirect(site_url('admin/amc'));
    }
}
