<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaint extends CI_Controller
{
    private $admin;
    private $store_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Complaint_model');
        $this->load->model('Order_model');
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
        $data['complaints'] = $this->Complaint_model->get_all($this->store_id);
        $data['customers'] = $this->Order_model->get_customers_with_orders($this->store_id);

        $this->load->view('admin/header');
        $this->load->view('admin/complaint_list', $data);
        $this->load->view('admin/footer');
    }

    public function view($id = 0)
    {
        $id = (int) $id;
        if ($id <= 0) {
            show_404();
        }

        $complaint = $this->Complaint_model->get_by_id($id, $this->store_id);
        if (!$complaint) {
            show_404();
        }

        $data['complaint'] = $complaint;

        $this->load->view('admin/header');
        $this->load->view('admin/complaint_detail', $data);
        $this->load->view('admin/footer');
    }

    public function mark_done($id = 0)
    {
        $id = (int) $id;
        if ($id <= 0) {
            show_404();
        }

        $this->Complaint_model->mark_done($id, $this->store_id);
        $this->session->set_flashdata('success', 'Complaint marked as fulfilled.');
        redirect(site_url('admin/complaint'));
    }

    public function delete($id = 0)
    {
        $id = (int) $id;
        if ($id <= 0) {
            show_404();
        }

        $deleted = $this->Complaint_model->delete($id, $this->store_id);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Complaint deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Complaint not found or already deleted.');
        }

        redirect(site_url('admin/complaint'));
    }

    public function update_status($id = 0, $status = null)
    {
        $id = (int) $id;
        $postedStatus = $this->input->post('status', true);
        if ($postedStatus !== null && $postedStatus !== '') {
            $status = (int) $postedStatus;
        } else {
            $status = (int) $status;
        }

        if ($status === 0) {
            $status = 2;
        }

        if ($id <= 0 || !in_array($status, [1, 2, 3], true)) {
            show_404();
        }

        $complaint = $this->Complaint_model->get_by_id($id, $this->store_id);
        if (!$complaint) {
            show_404();
        }

        $updated = $this->Complaint_model->update_status($id, $this->store_id, $status);

        if ($updated) {
            $message = 'Complaint status updated.';
            if ($status === 1) {
                $message = 'Complaint marked as pending.';
            } elseif ($status === 2) {
                $message = 'Complaint marked as approved.';
            } elseif ($status === 3) {
                $message = 'Complaint marked as reject.';
            }
            $this->session->set_flashdata('success', $message);
        } else {
            $this->session->set_flashdata('error', 'Complaint status was not changed.');
        }

        $redirect = trim((string) $this->input->post('redirect', true));
        if ($redirect === 'list') {
            redirect(site_url('admin/complaint'));
        }

        redirect(site_url('admin/complaint/view/' . $id));
    }
}
