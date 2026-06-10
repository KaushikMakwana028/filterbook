<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function get_orders($store_id = null)
    {
        $this->db->select('orders.*, customers.name, customers.mobile, customers.address');
        $this->db->from('orders');
        $this->db->join('customers', 'customers.id = orders.customer_id');

        if ($store_id !== null) {
            $this->db->where('orders.store_id', $store_id);
        }

        return $this->db->get()->result();
    }

    public function insert_order($data)
    {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    public function get_products($user_id = null)
    {
        $this->db
            ->select('id,name,purchase_price,sell_price')
            ->from('products');

        if ($user_id !== null) {
            $this->db->where('user_id', $user_id);
        }

        return $this->db->get()->result();
    }

    public function get_customers_with_orders($store_id)
    {
        return $this->db
            ->select('customers.id, customers.name, customers.mobile, customers.address, COUNT(orders.id) AS total_orders, MAX(orders.created_at) AS last_order_at')
            ->from('customers')
            ->join('orders', 'orders.customer_id = customers.id', 'inner')
            ->where('customers.store_id', $store_id)
            ->group_by('customers.id')
            ->order_by('customers.id', 'DESC')
            ->get()
            ->result();
    }

    public function get_customer($customer_id, $store_id)
    {
        return $this->db
            ->from('customers')
            ->where('id', $customer_id)
            ->where('store_id', $store_id)
            ->get()
            ->row();
    }

    public function get_customer_orders($customer_id, $store_id)
    {
        return $this->db
            ->from('orders')
            ->where('customer_id', $customer_id)
            ->where('store_id', $store_id)
            ->order_by('date_of_purchase', 'DESC')
            ->order_by('id', 'DESC')
            ->get()
            ->result();
    }
}
