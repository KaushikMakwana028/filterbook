<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Emi_model extends CI_Model
{
    private $table = 'emi_logs';

    public function get_all($store_id = null)
    {
        $this->db->select('
            emi_logs.*,
            customers.name AS customer_name,
            customers.mobile AS customer_mobile,
            orders.product_name,
            orders.product_modal,
            orders.price,
            orders.down_payment,
            orders.emi_amount,
            orders.date_of_purchase
        ');
        $this->db->from($this->table);
        $this->db->join('orders', 'orders.id = emi_logs.order_id', 'left');
        $this->db->join('customers', 'customers.id = emi_logs.customer_id', 'left');

        if ($store_id !== null) {
            $this->db->where('orders.store_id', $store_id);
        }

        $this->db->order_by('emi_logs.emi_date', 'ASC');
        $this->db->order_by('emi_logs.emi_number', 'ASC');

        return $this->db->get()->result();
    }

    public function get($id, $store_id = null)
    {
        $this->db->select('
            emi_logs.*,
            customers.name AS customer_name,
            customers.mobile AS customer_mobile,
            customers.address AS customer_address,
            orders.product_name,
            orders.product_modal,
            orders.price,
            orders.down_payment,
            orders.emi_amount,
            orders.date_of_purchase,
            orders.emi_duration
        ');
        $this->db->from($this->table);
        $this->db->join('orders', 'orders.id = emi_logs.order_id', 'left');
        $this->db->join('customers', 'customers.id = emi_logs.customer_id', 'left');
        $this->db->where('emi_logs.id', $id);

        if ($store_id !== null) {
            $this->db->where('orders.store_id', $store_id);
        }

        return $this->db->get()->row();
    }

    public function mark_paid($id, $store_id = null)
    {
        if ($store_id !== null) {
            $record = $this->db
                ->select('emi_logs.id')
                ->from('emi_logs')
                ->join('orders', 'orders.id = emi_logs.order_id', 'inner')
                ->where('emi_logs.id', $id)
                ->where('orders.store_id', $store_id)
                ->get()
                ->row();

            if (!$record) {
                return false;
            }
        }

        $this->db->where('id', $id);
        return $this->db->update($this->table, [
            'status' => 1,
            'update_at' => date('Y-m-d')
        ]);
    }
}
