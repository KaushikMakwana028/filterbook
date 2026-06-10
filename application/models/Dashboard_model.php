<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('general_model');
    }

    public function get_upcoming_emi($store_id)
    {
        $today = date('Y-m-d');
        $next7 = date('Y-m-d', strtotime('+7 days'));

        $this->db->select('
    emi_logs.*,
    customers.name as customer_name,
    customers.mobile as customer_mobile,
    orders.product_name as product_name,
    orders.price as price
');
        $this->db->from('emi_logs');
        $this->db->join('orders', 'orders.id = emi_logs.order_id');
        $this->db->join('customers', 'customers.id = emi_logs.customer_id');
        $this->db->where('orders.store_id', $store_id);
        $this->db->where('emi_logs.status', 0);
        $this->db->where('emi_logs.emi_date >=', $today);
        $this->db->where('emi_logs.emi_date <=', $next7);
        $this->db->order_by('emi_logs.emi_date', 'ASC');

        return $this->db->get()->result();
    }

    public function get_upcoming_services($store_id)
    {
        $today = date('Y-m-d');
        $next7 = date('Y-m-d', strtotime('+7 days'));

        $this->db->select('
    service_log.*,
    customers.name as customer_name,
    customers.mobile as customer_mobile,
    orders.product_name as product_name,
    orders.price as price
');
        $this->db->from('service_log');
        $this->db->join('orders', 'orders.id = service_log.order_id');
        $this->db->join('customers', 'customers.id = service_log.customer_id');
        $this->db->where('orders.store_id', $store_id);
        $this->db->where('service_log.status', 0);
        $this->db->where('service_log.service_date >=', $today);
        $this->db->where('service_log.service_date <=', $next7);
        $this->db->order_by('service_log.service_date', 'ASC');

        return $this->db->get()->result();
    }

    public function get_upcoming_amc_expiry($store_id)
    {
        $today = date('Y-m-d');
        $next30 = date('Y-m-d', strtotime('+30 days'));

        $this->db->select('
            amc_customer.*,
            customers.name as customer_name,
            customers.mobile as customer_mobile,
            orders.product_name as product_name
        ');
        $this->db->from('amc_customer');
        $this->db->join('customers', 'customers.id = amc_customer.customer_id', 'left');
        $this->db->join('orders', 'orders.id = amc_customer.product_id', 'left');
        $this->db->where('amc_customer.store_id', $store_id);
        $this->db->where('amc_customer.end_date >=', $today);
        $this->db->where('amc_customer.end_date <=', $next30);
        $this->db->order_by('amc_customer.end_date', 'ASC');

        return $this->db->get()->result();
    }

    public function get_latest_complaints($store_id, $limit = 3)
    {
        return $this->db
            ->select('id, name, mobile, product_name, serial_number, issue, status, complain_details, created_at')
            ->from('complaint')
            ->where('store_id', $store_id)
            // Keep unresolved complaints visible on the dashboard instead of behaving like a 24-hour feed.
            ->order_by('CASE WHEN status = 1 THEN 0 ELSE 1 END', '', false)
            ->order_by('created_at', 'DESC')
            ->order_by('id', 'DESC')
            ->limit((int) $limit)
            ->get()
            ->result();
    }

    public function get_sales_summary($store_id, $startDate = null, $endDate = null)
    {
        $this->db
            ->select('
                COUNT(orders.id) AS total_orders,
                COALESCE(SUM(orders.price), 0) AS total_sales,
                COALESCE(SUM(orders.price - COALESCE(products.purchase_price, 0)), 0) AS total_profit
            ', false)
            ->from('orders')
            ->join(
                'products',
                "products.user_id = orders.store_id AND CONVERT(TRIM(products.name) USING utf8mb4) COLLATE utf8mb4_unicode_ci = CONVERT(TRIM(orders.product_name) USING utf8mb4) COLLATE utf8mb4_unicode_ci",
                'left',
                false
            )
            ->where('orders.store_id', (int) $store_id);

        if ($startDate !== null) {
            $this->db->where('orders.date_of_purchase >=', $startDate);
        }

        if ($endDate !== null) {
            $this->db->where('orders.date_of_purchase <=', $endDate);
        }

        return $this->db->get()->row_array();
    }

    public function get_monthly_sales_metrics($store_id, $year = null)
    {
        $year = $year ?: date('Y');

        $rows = $this->db
            ->select("
                orders.date_of_purchase AS purchase_date,
                orders.price AS order_price,
                COALESCE(products.purchase_price, 0) AS purchase_price
            ", false)
            ->from('orders')
            ->join(
                'products',
                "products.user_id = orders.store_id AND CONVERT(TRIM(products.name) USING utf8mb4) COLLATE utf8mb4_unicode_ci = CONVERT(TRIM(orders.product_name) USING utf8mb4) COLLATE utf8mb4_unicode_ci",
                'left',
                false
            )
            ->where('orders.store_id', (int) $store_id)
            ->where('orders.date_of_purchase >=', $year . '-01-01')
            ->where('orders.date_of_purchase <=', $year . '-12-31')
            ->order_by('orders.date_of_purchase', 'ASC')
            ->get()
            ->result();

        $metrics = [];

        foreach ($rows as $row) {
            $purchaseDate = (string) ($row->purchase_date ?? '');
            $yearMonth = $purchaseDate !== '' ? date('Y-m', strtotime($purchaseDate)) : '';

            if ($yearMonth === '') {
                continue;
            }

            if (!isset($metrics[$yearMonth])) {
                $metrics[$yearMonth] = [
                    'orders' => 0,
                    'sales' => 0.0,
                    'profit' => 0.0,
                ];
            }

            $saleAmount = (float) ($row->order_price ?? 0);
            $purchaseAmount = (float) ($row->purchase_price ?? 0);

            $metrics[$yearMonth]['orders']++;
            $metrics[$yearMonth]['sales'] += $saleAmount;
            $metrics[$yearMonth]['profit'] += ($saleAmount - $purchaseAmount);
        }

        return $metrics;
    }

    public function get_inventory_summary($store_id, $startDate = null, $endDate = null)
    {
        $this->db
            ->select('
                COUNT(products.id) AS total_products,
                COALESCE(SUM(CASE WHEN COALESCE(products.quantity, 0) > 0 AND COALESCE(products.quantity, 0) <= 10 THEN 1 ELSE 0 END), 0) AS low_stock_items,
                COALESCE(SUM(COALESCE(products.quantity, 0) * COALESCE(products.purchase_price, 0)), 0) AS total_purchase
            ', false)
            ->from('products')
            ->where('products.user_id', (int) $store_id);

        if ($startDate !== null) {
            $this->db->where('DATE(products.created_at) >=', $startDate);
        }

        if ($endDate !== null) {
            $this->db->where('DATE(products.created_at) <=', $endDate);
        }

        return $this->db->get()->row_array();
    }
}
