<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
    private $admin;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model');
        $this->load->library('session');
        $this->load->library('subscription_guard');

        $this->admin = $this->session->userdata('admin');
        if (!$this->admin) {
            $this->session->set_flashdata('error', 'Session expired. Please login again.');
            redirect(site_url('admin/login'));
        }

        $this->subscription_guard->enforce((int) $this->admin['id']);
    }

    public function index()
    {
        $this->db->select('categories.*, users.name as user_name');
        $this->db->from('categories');
        $this->db->join('users', 'users.id = categories.user_id', 'left');
        $this->db->where('categories.user_id', $this->admin['id']);

        $categories = $this->db->get()->result();

        foreach ($categories as $cat) {
            $cat->product_count = $this->db
                ->where('category_id', $cat->id)
                ->where('user_id', $this->admin['id'])
                ->count_all_results('products');
        }

        $data['categories'] = $categories;

        $this->load->view('admin/header');
        $this->load->view('admin/category_list', $data);
        $this->load->view('admin/footer');
    }

    public function add()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/add_category');
        $this->load->view('admin/footer');
    }

    public function save()
    {
        $name = trim((string) $this->input->post('name', true));
        $description = trim((string) $this->input->post('description', true));

        if ($name === '') {
            $this->session->set_flashdata('category_name_error', 'Category name is required.');
            $this->session->set_flashdata('old_category_name', $name);
            $this->session->set_flashdata('old_category_description', $description);
            redirect(site_url('admin/category/add'));
            return;
        }

        $data = [
            'user_id' => $this->admin['id'],
            'name' => $name
        ];

        $this->General_model->insert('categories', $data);
        $this->session->set_flashdata('success', 'Your category has been added successfully.');
        redirect(site_url('admin/category'));
    }

    public function delete($id)
    {
        $category = $this->db
            ->where('id', $id)
            ->where('user_id', $this->admin['id'])
            ->get('categories')
            ->row();

        if (!$category) {
            show_404();
        }

        $this->General_model->delete('products', ['category_id' => $id, 'user_id' => $this->admin['id']]);
        $this->General_model->delete('categories', ['id' => $id, 'user_id' => $this->admin['id']]);

        $this->session->set_flashdata('success', 'Category and its products deleted successfully');
        redirect(site_url('admin/category'));
    }

    public function edit($id)
    {
        $data['category'] = $this->db
            ->where('id', $id)
            ->where('user_id', $this->admin['id'])
            ->get('categories')
            ->row();

        if (!$data['category']) {
            show_404();
        }

        $this->load->view('admin/header');
        $this->load->view('admin/edit_category', $data);
        $this->load->view('admin/footer');
    }

    public function update($id)
    {
        $name = trim((string) $this->input->post('name', true));
        $description = trim((string) $this->input->post('description', true));

        if ($name === '') {
            $this->session->set_flashdata('category_name_error', 'Category name is required.');
            $this->session->set_flashdata('old_category_name', $name);
            $this->session->set_flashdata('old_category_description', $description);
            redirect(site_url('admin/category/edit/' . (int) $id));
            return;
        }

        $this->db->where('id', $id);
        $this->db->where('user_id', $this->admin['id']);
        $updated = $this->db->update('categories', [
            'name' => $name
        ]);

        if (!$updated || $this->db->affected_rows() < 0) {
            show_404();
        }

        $this->session->set_flashdata('success', 'Your category has been updated successfully.');
        redirect(site_url('admin/category'));
    }
}
