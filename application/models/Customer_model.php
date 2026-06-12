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

    public function search_customers($query, $store_id)
    {
        return $this->db->select('id, name, mobile, address')
            ->where('store_id', (int) $store_id)
            ->group_start()
                ->like('name', $query)
                ->or_like('mobile', $query)
            ->group_end()
            ->limit(10)
            ->get('customers')
            ->result();
    }
}
