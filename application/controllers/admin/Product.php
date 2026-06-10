<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{
    private $admin;
    private $allowedUnits = ['pcs', 'box', 'liter', 'kg'];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model');
        $this->load->library('session');
        $this->load->library('subscription_guard');

        $this->admin = $this->session->userdata('admin');
        if (!$this->admin) {
            redirect(site_url('admin/login'));
        }

        $this->subscription_guard->enforce((int) $this->admin['id']);
    }

    public function index()
    {
        $this->db->select('products.*, categories.name as category_name, users.name as user_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id');
        $this->db->join('users', 'users.id = products.user_id', 'left');
        $this->db->where('products.user_id', $this->admin['id']);

        $data['products'] = $this->db->get()->result();

        $this->load->view('admin/header');
        $this->load->view('admin/product_list', $data);
        $this->load->view('admin/footer');
    }

    public function add()
    {
        $data['categories'] = $this->General_model->getAll('categories', ['user_id' => $this->admin['id']]);

        $this->load->view('admin/header');
        $this->load->view('admin/add_product', $data);
        $this->load->view('admin/footer');
    }

    public function save()
    {
        $name = trim((string) $this->input->post('name', true));
        $categoryId = (int) $this->input->post('category_id');
        $brand = trim((string) $this->input->post('brand', true));
        $unit = strtolower(trim((string) $this->input->post('unit', true)));
        $quantity = $this->input->post('quantity', true);
        $purchasePrice = $this->input->post('purchase_price', true);
        $sellPrice = $this->input->post('sell_price', true);

        $category = $this->db
            ->where('id', $categoryId)
            ->where('user_id', $this->admin['id'])
            ->get('categories')
            ->row();

        if (!$category) {
            $this->session->set_flashdata('error', 'Invalid category selected.');
            redirect(site_url('admin/product/add'));
            return;
        }

        if ($name === '') {
            $this->session->set_flashdata('error', 'Please enter product name.');
            redirect(site_url('admin/product/add'));
            return;
        }

        if (!in_array($unit, $this->allowedUnits, true)) {
            $this->session->set_flashdata('error', 'Please select a valid unit type.');
            redirect(site_url('admin/product/add'));
            return;
        }

        if ($quantity === '' || !is_numeric($quantity) || (int) $quantity < 0) {
            $this->session->set_flashdata('error', 'Please enter a valid quantity.');
            redirect(site_url('admin/product/add'));
            return;
        }

        if ($purchasePrice === '' || !is_numeric($purchasePrice) || (float) $purchasePrice < 0) {
            $this->session->set_flashdata('error', 'Please enter a valid purchase price.');
            redirect(site_url('admin/product/add'));
            return;
        }

        if ($sellPrice !== '' && (!is_numeric($sellPrice) || (float) $sellPrice < 0)) {
            $this->session->set_flashdata('error', 'Please enter a valid sell price.');
            redirect(site_url('admin/product/add'));
            return;
        }

        $data = [
            'user_id' => $this->admin['id'],
            'name' => $name,
            'category_id' => $categoryId,
            'brand' => $brand,
            'unit' => $unit,
            'quantity' => (int) $quantity,
            'purchase_price' => (float) $purchasePrice,
            'sell_price' => $sellPrice === '' ? null : (float) $sellPrice
        ];

        $this->General_model->insert('products', $data);
        redirect(site_url('admin/product'));
    }

    public function delete($id)
    {
        $this->General_model->delete('products', ['id' => $id, 'user_id' => $this->admin['id']]);
        $this->session->set_flashdata('success', 'Product deleted successfully');
        redirect(site_url('admin/product'));
    }

    public function edit($id)
    {
        $data['product'] = $this->db
            ->where('id', $id)
            ->where('user_id', $this->admin['id'])
            ->get('products')
            ->row();

        if (!$data['product']) {
            show_404();
        }

        $data['categories'] = $this->General_model->getAll('categories', ['user_id' => $this->admin['id']]);

        $this->load->view('admin/header');
        $this->load->view('admin/edit_product', $data);
        $this->load->view('admin/footer');
    }

    public function update($id)
    {
        $name = trim((string) $this->input->post('name', true));
        $categoryId = (int) $this->input->post('category_id');
        $brand = trim((string) $this->input->post('brand', true));
        $unit = strtolower(trim((string) $this->input->post('unit', true)));
        $quantity = $this->input->post('quantity', true);
        $purchasePrice = $this->input->post('purchase_price', true);
        $sellPrice = $this->input->post('sell_price', true);

        if ($name === '') {
            $this->session->set_flashdata('error', 'Please enter product name.');
            redirect(site_url('admin/product/edit/' . (int) $id));
            return;
        }

        if ($categoryId <= 0) {
            $this->session->set_flashdata('error', 'Please select a category.');
            redirect(site_url('admin/product/edit/' . (int) $id));
            return;
        }

        if (!in_array($unit, $this->allowedUnits, true)) {
            $this->session->set_flashdata('error', 'Please select a valid unit type.');
            redirect(site_url('admin/product/edit/' . (int) $id));
            return;
        }

        if ($quantity === '' || !is_numeric($quantity) || (int) $quantity < 0) {
            $this->session->set_flashdata('error', 'Please enter a valid quantity.');
            redirect(site_url('admin/product/edit/' . (int) $id));
            return;
        }

        if ($purchasePrice === '' || !is_numeric($purchasePrice) || (float) $purchasePrice < 0) {
            $this->session->set_flashdata('error', 'Please enter a valid purchase price.');
            redirect(site_url('admin/product/edit/' . (int) $id));
            return;
        }

        if ($sellPrice !== '' && (!is_numeric($sellPrice) || (float) $sellPrice < 0)) {
            $this->session->set_flashdata('error', 'Please enter a valid sell price.');
            redirect(site_url('admin/product/edit/' . (int) $id));
            return;
        }

        $category = $this->db
            ->where('id', $categoryId)
            ->where('user_id', $this->admin['id'])
            ->get('categories')
            ->row();

        if (!$category) {
            $this->session->set_flashdata('error', 'Invalid category selected.');
            redirect(site_url('admin/product/edit/' . (int) $id));
            return;
        }

        $this->db->where('id', $id);
        $this->db->where('user_id', $this->admin['id']);
        $this->db->update('products', [
            'name' => $name,
            'category_id' => $categoryId,
            'brand' => $brand,
            'unit' => $unit,
            'quantity' => (int) $quantity,
            'purchase_price' => (float) $purchasePrice,
            'sell_price' => $sellPrice === '' ? null : (float) $sellPrice
        ]);

        $this->session->set_flashdata('success', 'Product updated successfully');
        redirect(site_url('admin/product'));
    }
}
