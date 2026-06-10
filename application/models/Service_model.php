<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model
{
    private $table = 'service_log';

    public function get_order_choices($store_id)
    {
        return $this->db
            ->select('orders.id, orders.customer_id, orders.product_name, orders.product_modal, customers.name AS customer_name')
            ->from('orders')
            ->join('customers', 'customers.id = orders.customer_id', 'inner')
            ->where('orders.store_id', $store_id)
            ->order_by('customers.name', 'ASC')
            ->order_by('orders.product_name', 'ASC')
            ->get()
            ->result();
    }

    public function get_all($store_id = null)
    {
        $this->db->select('
            service_log.*,
            customers.name AS customer_name,
            customers.mobile AS customer_mobile,
            orders.product_name,
            orders.product_modal,
            orders.price,
            orders.date_of_purchase
        ');
        $this->db->from($this->table);
        $this->db->join('orders', 'orders.id = service_log.order_id', 'left');
        $this->db->join('customers', 'customers.id = service_log.customer_id', 'left');

        if ($store_id !== null) {
            $this->db->where('orders.store_id', $store_id);
        }

        $this->db->order_by('service_log.service_date', 'ASC');
        $this->db->order_by('service_log.service_number', 'ASC');

        return $this->db->get()->result();
    }

    public function get($id, $store_id = null)
    {
        $this->db->select('
            service_log.*,
            customers.name AS customer_name,
            customers.mobile AS customer_mobile,
            customers.address AS customer_address,
            orders.product_name,
            orders.product_modal,
            orders.price,
            orders.date_of_purchase,
            orders.service_interval,
            orders.total_services
        ');
        $this->db->from($this->table);
        $this->db->join('orders', 'orders.id = service_log.order_id', 'left');
        $this->db->join('customers', 'customers.id = service_log.customer_id', 'left');
        $this->db->where('service_log.id', $id);

        if ($store_id !== null) {
            $this->db->where('orders.store_id', $store_id);
        }

        return $this->db->get()->row();
    }

    public function mark_done($id, $store_id = null)
    {
        if ($store_id !== null) {
            $record = $this->db
                ->select('service_log.id')
                ->from('service_log')
                ->join('orders', 'orders.id = service_log.order_id', 'inner')
                ->where('service_log.id', $id)
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

    public function add_custom_service($order_id, $customer_id, $service_date, $service_number = null)
    {
        if ($service_number === null || $service_number === '') {
            $last = $this->db
                ->select_max('service_number')
                ->from($this->table)
                ->where('order_id', $order_id)
                ->get()
                ->row();

            $next_number = !empty($last->service_number) ? ((int) $last->service_number + 1) : 1;
        } else {
            $next_number = max(1, (int) $service_number);
        }

        return $this->db->insert($this->table, [
            'order_id' => $order_id,
            'customer_id' => $customer_id,
            'service_number' => $next_number,
            'assign_to' => 0,
            'status' => 0,
            'customer_status' => 0,
            'service_date' => $service_date,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
