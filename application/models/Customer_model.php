<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    public function get_customers($store_id = null)
    {
        if ($store_id !== null) {
            $this->db->where('store_id', $store_id);
        }

        return $this->db->get('customers')->result();
    }

    public function insert_customer($data)
    {
        $this->db->insert('customers', $data);
        return $this->db->insert_id();
    }
}
