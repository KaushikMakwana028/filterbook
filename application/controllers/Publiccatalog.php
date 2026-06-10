<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publiccatalog extends CI_Controller
{
    public function view($admin_id, $page = 0)
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('index.php/publiccatalog/view/' . $admin_id);
        $config['total_rows'] = $this->db->where('admin_id', $admin_id)->count_all_results('catalog');
        $config['per_page'] = 9;
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);

        $this->db->where('admin_id', $admin_id);
        $this->db->limit($config['per_page'], $page);
        $data['products'] = $this->db->get('catalog')->result();

        $data['vendor'] = $this->db->get_where('users', [
            'id' => $admin_id
        ])->row();

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('catalog_public', $data);
    }

    public function product_detail($id)
    {
        $product = $this->db->get_where('catalog', ['id' => $id])->row();

        if (!$product) {
            show_404();
        }

        $vendor = $this->db->get_where('users', [
            'id' => $product->admin_id
        ])->row();

        $data['product'] = $product;
        $data['vendor'] = $vendor;

        $this->load->view('product_detail', $data);
    }
}
