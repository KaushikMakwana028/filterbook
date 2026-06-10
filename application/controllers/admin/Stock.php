<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller
{
    private $admin;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Stock_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('subscription_guard');

        $this->admin = $this->session->userdata('admin');
        if (!$this->admin) {
            redirect(site_url('admin/login'));
        }

        $this->subscription_guard->enforce((int) $this->admin['id']);
    }

    public function add()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/add_stock');
        $this->load->view('admin/footer');
    }

    public function save()
    {
        $data = array(
            'brand_name' => $this->input->post('brand_name'),
            'model_number' => $this->input->post('model_number'),
            'product_name' => $this->input->post('product_name'),
            'quantity' => $this->input->post('quantity'),
            'price' => $this->input->post('price')
        );

        $this->Stock_model->insert_stock($data, $this->admin['id']);
        redirect(site_url('admin/stock/listing'));
    }

    public function listing()
    {
        $data['stock'] = $this->Stock_model->get_all_stock($this->admin['id']);

        $this->load->view('admin/header');
        $this->load->view('admin/stock_list', $data);
        $this->load->view('admin/footer');
    }

    public function delete($id)
    {
        $this->Stock_model->delete_stock($id, $this->admin['id']);
        redirect(site_url('admin/stock/listing'));
    }
}
