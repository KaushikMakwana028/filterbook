<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emi extends CI_Controller
{
    private $admin;
    private $store_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Emi_model');
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
        $data['emis'] = $this->Emi_model->get_all($this->store_id);

        $this->load->view('admin/header');
        $this->load->view('admin/emi_list', $data);
        $this->load->view('admin/footer');
    }

    public function view($id = null)
    {
        $data['emi'] = $this->Emi_model->get((int) $id, $this->store_id);

        if (!$data['emi']) {
            show_404();
        }

        $this->load->view('admin/header');
        $this->load->view('admin/emi_detail', $data);
        $this->load->view('admin/footer');
    }

    public function mark_paid($id = null)
    {
        if ($id) {
            $this->Emi_model->mark_paid((int) $id, $this->store_id);
        }

        redirect(site_url('admin/emi'));
    }
}
