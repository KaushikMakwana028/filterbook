<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amc_model extends CI_Model
{
    private $table = 'amc_customer';

    public function get_all($store_id)
    {
        return $this->db
            ->select('
                amc_customer.*,
                customers.name AS customer_name,
                customers.mobile AS customer_mobile,
                customers.address AS customer_address,
                orders.product_modal,
                orders.date_of_purchase
            ')
            ->from($this->table)
            ->join('customers', 'customers.id = amc_customer.customer_id', 'left')
            ->join('orders', 'orders.id = amc_customer.product_id', 'left')
            ->where('amc_customer.store_id', $store_id)
            ->order_by('amc_customer.id', 'DESC')
            ->get()
            ->result();
    }

    public function get_customer_choices($store_id)
    {
        return $this->db
            ->select('id, name, mobile, address')
            ->from('customers')
            ->where('store_id', $store_id)
            ->order_by('name', 'ASC')
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

    public function get_customer_products($customer_id, $store_id)
    {
        return $this->db
            ->select('id, product_name, product_modal, date_of_purchase, price')
            ->from('orders')
            ->where('customer_id', $customer_id)
            ->where('store_id', $store_id)
            ->order_by('date_of_purchase', 'DESC')
            ->order_by('id', 'DESC')
            ->get()
            ->result();
    }

    public function get_customer_product($order_id, $customer_id, $store_id)
    {
        return $this->db
            ->from('orders')
            ->where('id', $order_id)
            ->where('customer_id', $customer_id)
            ->where('store_id', $store_id)
            ->get()
            ->row();
    }

    public function get($id, $store_id)
    {
        return $this->db
            ->select('
                amc_customer.*,
                customers.name AS customer_name,
                customers.mobile AS customer_mobile,
                customers.address AS customer_address,
                orders.product_modal,
                orders.date_of_purchase,
                orders.price
            ')
            ->from($this->table)
            ->join('customers', 'customers.id = amc_customer.customer_id', 'left')
            ->join('orders', 'orders.id = amc_customer.product_id', 'left')
            ->where('amc_customer.id', $id)
            ->where('amc_customer.store_id', $store_id)
            ->get()
            ->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $store_id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('store_id', $store_id);
        $this->db->update($this->table, $data);

        return $this->db->affected_rows() >= 0;
    }

    public function delete($id, $store_id)
    {
        $this->db->where('id', $id);
        $this->db->where('store_id', $store_id);
        $this->db->delete($this->table);

        return $this->db->affected_rows() > 0;
    }
}
