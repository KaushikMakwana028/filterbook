<?php defined('BASEPATH') or exit('No direct script access allowed');



class General_model extends CI_Model
{



    public function __construct()
    {

        parent::__construct();

        $this->load->database();

        $this->load->Model('general_model');

    }



    public function getOne($table, $where)
    {

        $query = $this->db->get_where($table, $where);

        return $query->row();

    }




    public function getById($table, $id)
    {
        return $this->db->get_where($table, ['id' => $id])->row();
    }
    public function getAll($table, $where = '', $limit = NULL, $offset = NULL)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }

        if ($limit !== NULL) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get($table);

        return $query->result();
    }


    public function insert($table, $data)
    {

        $this->db->insert($table, $data);

        return $this->db->insert_id();

    }

    public function update($table, $where, $data)
    {

        return $this->db->update($table, $data, $where);

    }

    public function getCount($table, $where = [], $isActive = null, $dateField = null, $dateRange = [])
    {
        if (!is_null($isActive)) {
            $where['isActive'] = $isActive;
        }

        $this->db->select()->from($table);

        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!empty($dateField) && !empty($dateRange)) {
            $this->db->where($dateField . ' >=', $dateRange['start']);
            $this->db->where($dateField . ' <=', $dateRange['end']);
        }

        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->num_rows();
    }


    public function countAll($table, $where = [])
    {
        $this->db->where($where);
        return $this->db->count_all_results($table);
    }
    public function getData($table, $selectFields = '*', $where = [])
    {

        $this->db->select($selectFields);

        $this->db->from($table);

        if (!empty($where)) {

            $this->db->where($where);

        }

        $query = $this->db->get();

        return $query->result_array();

    }



    public function getCurrentMonthCustomers()
    {

        $query = $this->db->query("

            SELECT * FROM customers 

            WHERE MONTH(purchase_date) = MONTH(CURRENT_DATE()) 

            AND YEAR(purchase_date) = YEAR(CURRENT_DATE())

        ");



        return $query->result_array(); // Returns all matching records as an array

    }

    public function getCustomersAfter90Days($table, $store_id)
    {
        // Step 1: Get all orders for the store
        $this->db->select('*');
        $this->db->where('store_id', $store_id);
        $this->db->from($table);
        $query = $this->db->get();
        $orders = $query->result();

        $due_orders = [];
        $customer_ids = [];
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Step 2: Find customers whose service is due this month
        foreach ($orders as $order) {
            $purchaseDate = new DateTime($order->date_of_purchase);
            for ($i = 1; $i <= $order->total_services; $i++) {
                $nextServiceDate = clone $purchaseDate;
                $nextServiceDate->modify('+' . ($i * $order->service_interval) . ' months');

                if (
                    $nextServiceDate->format('m') == $currentMonth &&
                    $nextServiceDate->format('Y') == $currentYear
                ) {
                    $order->due_service_number = $i; // Save which service is due
                    $due_orders[] = $order;
                    $customer_ids[] = $order->customer_id;
                    break;
                }
            }
        }

        $customers = [];

        if (!empty($customer_ids)) {
            // Step 3: Fetch customer info
            $this->db->select('id, name, mobile, customer_area');
            $this->db->from('customers');

            $this->db->where_in('id', $customer_ids);
            $query = $this->db->get();
            $customers = $query->result();

            // Step 4: Attach service status using due_service_number
            foreach ($customers as &$customer) {
                // Find matching order for this customer
                $matched_order = null;
                foreach ($due_orders as $order) {
                    if ($order->customer_id == $customer->id) {
                        $matched_order = $order;
                        break;
                    }
                }

                if ($matched_order) {
                    $this->db->select('id, status, service_number,customer_status');
                    $this->db->from('service_log');
                    $this->db->where('customer_id', $customer->id);
                    $this->db->where('service_number', $matched_order->due_service_number);
                    $service_log = $this->db->get()->row();

                    if ($service_log) {
                        $customer->status = $service_log->status;
                        $customer->service_number = $service_log->service_number;
                        $customer->service_id = $service_log->id;
                        $customer->customer_status = $service_log->customer_status;

                    } else {
                        // No log yet for this service number, assume pending
                        $customer->status = 'Pending';
                        $customer->service_number = $matched_order->due_service_number;
                        $customer->service_id = 'N/A';
                    }
                }
            }
        }

        return $customers;
    }

    public function getDueEmiThisMonth($table, $store_id)
    {
        // Fetch orders with EMI payment type
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('store_id', $store_id);
        $this->db->where('payment_type', 0);
        // $this->db->order_by('id', 'DESC');
        // Only EMI records
        $query = $this->db->get();
        $orders = $query->result();

        $customer_ids = []; // Collect customer IDs for due EMIs
        $currentMonth = date('m'); // '05' for May 2025
        $currentYear = date('Y');  // '2025'

        // Identify customers with due EMIs based on orders table
        foreach ($orders as $order) {
            if (empty($order->emi_date) || empty($order->emi_duration)) {
                continue; // Skip if EMI info is incomplete
            }

            $emiStartDate = new DateTime($order->emi_date);

            for ($i = 0; $i < $order->emi_duration; $i++) { // Start from 0 since first EMI is on emi_date
                $emiDueDate = clone $emiStartDate;
                $emiDueDate->modify("+$i months");

                if (
                    $emiDueDate->format('m') == $currentMonth &&
                    $emiDueDate->format('Y') == $currentYear
                ) {
                    $customer_ids[] = $order->customer_id;
                    break;
                }
            }
        }

        // Fetch EMI details for customers with due EMIs
        $emiDetails = [];
        if (!empty($customer_ids)) {
            $this->db->select('id, customer_id, emi_number, status,status_customer');
            $this->db->from('emi_logs');
            $this->db->where_in('customer_id', array_unique($customer_ids));
            $this->db->where('emi_date LIKE', $currentYear . '-' . $currentMonth . '%'); // Match EMI due in May 2025
            // $this->db->where('status', 0); // Only unpaid EMIs
            $query = $this->db->get();
            $emiDetails = $query->result();
        }

        // Fetch customer details for due EMI customers
        if (!empty($customer_ids) && !empty($emiDetails)) {
            $this->db->select('id, name, mobile, customer_area');
            $this->db->from('customers');
            $this->db->where_in('id', array_unique($customer_ids));
            $query = $this->db->get();
            $customers = $query->result();

            // Attach EMI details to customers
            foreach ($customers as &$customer) {
                foreach ($emiDetails as $emiDetail) {
                    if ($emiDetail->customer_id == $customer->id) {
                        $customer->emi_number = $emiDetail->emi_number;
                        $customer->status = $emiDetail->status;
                        $customer->status_customer = $emiDetail->status_customer;
                        $customer->emi_id = $emiDetail->id;
                        break;
                    }
                }
            }
            usort($customers, function ($a, $b) {
                return $b->id - $a->id;
            });
            return $customers;
        }

        return []; // Return empty array if no due EMIs
    }






    public function get_complaint($table, $limit, $start, $search = null, $store_id = null)
    {
        $this->db->limit($limit, $start);
        if ($store_id !== null) {
            $this->db->where('store_id', $store_id);
        }

        if (!empty($search)) {
            $this->db->group_start()
                ->like('name', $search)
                ->or_like('area', $search)
                ->group_end();
        }

        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_customers_with_orders($store_id, $limit = 10, $offset = 0, $search = '')
    {
        $this->db->select('customers.id,customers.name, customers.mobile, customers.customer_area, orders.product_name,orders.id AS order_id');
        $this->db->from('customers');
        $this->db->join('orders', 'orders.customer_id = customers.id', 'inner');
        $this->db->where('customers.store_id', $store_id);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('customers.name', $search);
            $this->db->or_like('customers.mobile', $search);
            $this->db->or_like('customers.customer_area', $search);
            $this->db->or_like('orders.product_name', $search);
            $this->db->group_end();
        }
        $this->db->order_by('customers.id', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_customers_with_orders_count($store_id, $search = '')
    {
        $this->db->from('customers');
        $this->db->join('orders', 'orders.customer_id = customers.id', 'inner');
        $this->db->where('customers.store_id', $store_id);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('customers.name', $search);
            $this->db->or_like('customers.mobile', $search);
            $this->db->or_like('customers.customer_area', $search);
            $this->db->or_like('orders.product_name', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }
    public function get_customers_select($store_id, $limit = 10, $offset = 0, $search = '')
    {
        $this->db->select('customers.id, customers.name, customers.mobile, customers.customer_area, customers.address');
        $this->db->from('customers');
        $this->db->where('customers.store_id', $store_id);

        $search = trim($search); // Whitespace hatao
        if ($search === '' || $search === null) {
            return [];
        }

        // Search logic jab kuch typed ho
        $this->db->group_start();
        $this->db->like('customers.name', $search);
        $this->db->or_like('customers.mobile', $search);
        $this->db->or_like('customers.customer_area', $search);
        $this->db->group_end();

        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getServiceCountThisMonth($store_id)
    {
        $start_date = date('Y-m-01 00:00:00'); // 2025-05-01 00:00:00
        $end_date = date('Y-m-t 23:59:59');   // 2025-05-31 23:59:59

        $query = $this->db->query("
                    SELECT COUNT(DISTINCT o.id) AS service_count
                    FROM orders o
                    JOIN service_log sl ON o.id = sl.order_id
                    WHERE o.store_id = ?
                    AND sl.service_date >= ?
                    AND sl.service_date <= ?
                ", array($store_id, $start_date, $end_date));

        return $query->row()->service_count;
    }
    public function getServiceStatusCountsThisMonth($store_id)
    {
        $start_date = date('Y-m-01 00:00:00'); // 2025-05-01 00:00:00
        $end_date = date('Y-m-t 23:59:59');   // 2025-05-31 23:59:59

        $query = $this->db->query("
        SELECT 
            SUM(CASE WHEN sl.status = 0 THEN 1 ELSE 0 END) AS pending_services,
            SUM(CASE WHEN sl.status = 1 THEN 1 ELSE 0 END) AS fulfilled_services
        FROM orders o
        JOIN service_log sl ON o.id = sl.order_id
        WHERE o.store_id = ?
        AND sl.service_date >= ?
        AND sl.service_date <= ?
    ", array($store_id, $start_date, $end_date));

        $result = $query->row();
        return array(
            'pending_services' => (int) $result->pending_services,
            'fulfilled_services' => (int) $result->fulfilled_services
        );
    }
    public function getEmiStatusCountsThisMonth($store_id)
    {
        $start_date = date('Y-m-01 00:00:00'); // 2025-05-01 00:00:00
        $end_date = date('Y-m-t 23:59:59');   // 2025-05-31 23:59:59

        $query = $this->db->query("
        SELECT 
            COUNT(DISTINCT o.customer_id) AS emi_customers,
            SUM(CASE WHEN el.status = 0 THEN 1 ELSE 0 END) AS pending_emis,
            SUM(CASE WHEN el.status = 1 THEN 1 ELSE 0 END) AS paid_emis
        FROM orders o
        JOIN emi_logs el ON o.id = el.order_id
        WHERE o.store_id = ?
        AND el.emi_date >= ?
        AND el.emi_date <= ?
    ", array($store_id, $start_date, $end_date));

        $result = $query->row();
        return array(
            'emi_customers' => (int) $result->emi_customers,
            'pending_emis' => (int) $result->pending_emis,
            'paid_emis' => (int) $result->paid_emis
        );
    }

    // public function getAll($table, $where = '', $limit = NULL, $offset = NULL)
    // {
    //     if (!empty($where)) {
    //         $this->db->where($where);
    //     }

    //     if ($limit !== NULL) {
    //         $this->db->limit($limit, $offset);
    //     }

    //     $query = $this->db->get($table);

    //     return $query->result();
    // }

    public function countProductsByCategory($category_id)
    {
        return $this->db
            ->where('category_id', $category_id)
            ->count_all_results('products');
    }
    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }


}
