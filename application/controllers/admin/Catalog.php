<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Catalog_model');
        $this->load->library('session');
        $this->load->library('subscription_guard');
    }

    private function requireAdmin()
    {
        $admin = $this->session->userdata('admin');
        if (!$admin) {
            redirect(site_url('admin/login'));
        }

        $this->subscription_guard->enforce((int) $admin['id']);

        return $admin;
    }

   public function index()
{
    $admin = $this->requireAdmin();
    
    // Check if it's an AJAX request
    if ($this->input->is_ajax_request()) {
        $search = $this->input->get('search');
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $per_page = 10;
        $offset = ($page - 1) * $per_page;
        
        $result = $this->Catalog_model->getPaginated($admin['id'], $search, $per_page, $offset);
        
        echo json_encode($result);
        return;
    }
    
    // Initial page load
    $data['products'] = [];
    
    $this->load->view('admin/header');
    $this->load->view('admin/catalog_list', $data);
    $this->load->view('admin/footer');
}

    public function add()
    {
        $this->requireAdmin();
        $this->load->view('admin/header');
        $this->load->view('admin/add_catalog');
        $this->load->view('admin/footer');
    }

public function save()
{
    $admin = $this->requireAdmin();

    $uploadPath = FCPATH . 'uploads/catalog/';

    // ✅ Create folder if not exists
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    // ✅ Check writable permission
    if (!is_dir($uploadPath) || !is_writable($uploadPath)) {

        log_message('error', 'Catalog upload folder not writable: ' . $uploadPath);

        $this->session->set_flashdata(
            'error',
            'Catalog image upload folder is not writable.'
        );

        redirect(site_url('admin/catalog/add'));
        return;
    }

    // ✅ Upload config
    $config['upload_path']   = $uploadPath;
    $config['allowed_types'] = 'jpg|jpeg|png|webp';
    $config['max_size']      = 2048;
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);

    $imageName = null;

    // ✅ Upload image
    if (!empty($_FILES['image']['name'])) {

        log_message('error', 'Catalog image upload started');

        if ($this->upload->do_upload('image')) {

            $uploadData = $this->upload->data();

            $imageName = $uploadData['file_name'];

            log_message('error', 'Catalog image uploaded successfully: ' . $imageName);

        } else {

            $uploadError = strip_tags($this->upload->display_errors());

            log_message('error', 'Catalog image upload failed: ' . $uploadError);

            $this->session->set_flashdata(
                'error',
                $uploadError
            );

            redirect(site_url('admin/catalog/add'));
            return;
        }
    }

    // ✅ Save data
    $data = [
        'admin_id'   => $admin['id'],
        'name'        => trim($this->input->post('name')),
        'description' => trim($this->input->post('description')),
        'price'       => $this->input->post('price'),
        'image'       => $imageName,
    ];

    $insert = $this->Catalog_model->insert($data);

    if ($insert) {

        log_message('error', 'Catalog inserted successfully');

        $this->session->set_flashdata(
            'success',
            'Catalog item added successfully.'
        );

    } else {

        log_message('error', 'Catalog insert failed');

        $this->session->set_flashdata(
            'error',
            'Failed to save catalog item.'
        );
    }

    redirect(site_url('admin/catalog'));
}

    public function edit($id)
    {
        $admin = $this->requireAdmin();
        $data['product'] = $this->db
            ->where('id', $id)
            ->where('admin_id', $admin['id'])
            ->get('catalog')
            ->row();

        if (!$data['product']) {
            show_404();
        }

        $this->load->view('admin/header');
        $this->load->view('admin/edit_catalog', $data);
        $this->load->view('admin/footer');
    }

    public function update($id)
    {
        $admin = $this->requireAdmin();
        $product = $this->db
            ->where('id', $id)
            ->where('admin_id', $admin['id'])
            ->get('catalog')
            ->row();

        if (!$product) {
            show_404();
        }

        $uploadPath = FCPATH . 'uploads/catalog/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $imageName = $product->image;
        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $imageName = $uploadData['file_name'];

                if ($product->image && file_exists($uploadPath . $product->image)) {
                    unlink($uploadPath . $product->image);
                }
            } else {
                $this->session->set_flashdata('error', strip_tags($this->upload->display_errors()));
                redirect(site_url('admin/catalog/edit/' . $id));
            }
        }

        $data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price'),
            'image' => $imageName
        ];

        $this->Catalog_model->update($id, $data);
        $this->session->set_flashdata('success', 'Updated successfully');
        redirect(site_url('admin/catalog'));
    }

    public function delete($id)
    {
        $admin = $this->requireAdmin();
        $product = $this->db
            ->where('id', $id)
            ->where('admin_id', $admin['id'])
            ->get('catalog')
            ->row();

        if (!$product) {
            show_404();
        }

        if ($product->image && file_exists(FCPATH . 'uploads/catalog/' . $product->image)) {
            unlink(FCPATH . 'uploads/catalog/' . $product->image);
        }

        $this->db->where('id', $id);
        $this->db->where('admin_id', $admin['id']);
        $this->db->delete('catalog');

        $this->session->set_flashdata('success', 'Deleted successfully');
        redirect(site_url('admin/catalog'));
    }

    public function view($admin_id, $page = 0)
    {
        $this->load->library('pagination');

        $config['base_url'] = site_url('catalog/view/' . $admin_id);
        $config['total_rows'] = $this->db->where('admin_id', $admin_id)->count_all_results('catalog');
        $config['per_page'] = 9;
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);

        $this->db->where('admin_id', $admin_id);
        $this->db->limit($config['per_page'], $page);

        $data['products'] = $this->db->get('catalog')->result();
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('catalog_public', $data);
    }

    public function generate_qr()
    {
        $this->requireAdmin();
        $this->session->set_flashdata('success', 'Catalog QR is ready to view below.');
        redirect(site_url('admin/dashboard'));
    }
}
