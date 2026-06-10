<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    private $superAdmin = [];

    private function buildAdminListUrl($page = 1, $search = '', $status = 'all')
    {
        $params = ['page' => max(1, (int) $page)];

        if ($search !== '') {
            $params['search'] = $search;
        }

        if (in_array($status, ['active', 'inactive'], true)) {
            $params['status'] = $status;
        }

        return site_url('super-admin/admin-list?' . http_build_query($params));
    }

    private function countFilteredAdmins($search = '', $status = 'all')
    {
        $this->db->reset_query();
        $this->db->from('users')->where('role', 2);

        if ($search !== '') {
            $this->db
                ->group_start()
                ->like('name', $search)
                ->or_like('email', $search)
                ->or_like('store_name', $search)
                ->or_like('mobile', $search)
                ->group_end();
        }

        if ($status === 'active') {
            $this->db->where('isActive', 1);
        } elseif ($status === 'inactive') {
            $this->db->where('isActive', 0);
        }

        return (int) $this->db->count_all_results();
    }

    private function baseViewData()
    {
        return [
            'super_admin' => $this->db->get_where('users', ['id' => (int) $this->superAdmin['id']])->row(),
        ];
    }

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->database();
        $this->load->model('Plan_model');

        $this->superAdmin = (array) $this->session->userdata('super_admin');

        if (empty($this->superAdmin['id']) || (int) ($this->superAdmin['role'] ?? 0) !== 1) {
            $this->session->set_flashdata('error', 'Please login as super admin.');
            redirect(site_url('admin/login'));
        }
    }

    public function index()
    {
        $data = $this->baseViewData();
        $data['active_super_page'] = 'dashboard';
        $data['stats'] = [
            'total_admins' => (int) $this->db->where('role', 2)->count_all_results('users'),
            'active_admins' => (int) $this->db->where('role', 2)->where('isActive', 1)->count_all_results('users'),
            'total_orders' => (int) $this->db->count_all_results('orders'),
            'total_complaints' => (int) $this->db->count_all_results('complaint'),
            'active_plans' => (int) $this->db->where('status', 'active')->count_all_results('user_subscriptions'),
            'trial_plans' => (int) $this->db->where('status', 'trial')->count_all_results('user_subscriptions'),
        ];

        $this->load->view('super_admin/header', $data);
        $this->load->view('super_admin/dashboard_view', $data);
        $this->load->view('super_admin/footer', $data);
    }

    public function admin_list()
    {
        $data = $this->baseViewData();
        $data['active_super_page'] = 'admin_list';
        $perPage = 10;
        $search = trim((string) $this->input->get('search', true));
        $status = strtolower(trim((string) $this->input->get('status', true)));
        $status = in_array($status, ['active', 'inactive'], true) ? $status : 'all';
        $page = max(1, (int) $this->input->get('page'));

        $buildAdminQuery = function () use ($search, $status) {
            $query = $this->db->from('users')->where('role', 2);

            if ($search !== '') {
                $query
                    ->group_start()
                    ->like('name', $search)
                    ->or_like('email', $search)
                    ->or_like('store_name', $search)
                    ->or_like('mobile', $search)
                    ->group_end();
            }

            if ($status === 'active') {
                $query->where('isActive', 1);
            } elseif ($status === 'inactive') {
                $query->where('isActive', 0);
            }

            return $query;
        };

        $totalAdmins = (int) $buildAdminQuery()->count_all_results();
        $totalPages = max(1, (int) ceil($totalAdmins / $perPage));

        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $perPage;

        $data['admins'] = $buildAdminQuery()
            ->select('id, name, store_name, mobile, email, isActive, created_on')
            ->order_by('id', 'DESC')
            ->limit($perPage, $offset)
            ->get()
            ->result();
        $data['plan_summaries'] = [];

        foreach ($data['admins'] as $admin) {
            $data['plan_summaries'][(int) $admin->id] = $this->Plan_model->get_plan_summary((int) $admin->id);
        }

        $allAdminIds = $this->db
            ->select('id')
            ->where('role', 2)
            ->get('users')
            ->result();
        $planTotals = [
            'paid' => 0,
            'unpaid' => 0,
            'trial' => 0,
            'expired' => 0,
        ];

        foreach ($allAdminIds as $adminRow) {
            $summary = $this->Plan_model->get_plan_summary((int) $adminRow->id);

            if (!$summary) {
                $planTotals['unpaid']++;
                continue;
            }

            if (($summary['purchase_status'] ?? 'Unpaid') === 'Paid') {
                $planTotals['paid']++;
            } else {
                $planTotals['unpaid']++;
            }

            if (!empty($summary['is_trial']) && empty($summary['is_expired'])) {
                $planTotals['trial']++;
            }

            if (!empty($summary['is_expired'])) {
                $planTotals['expired']++;
            }
        }

        $data['pagination'] = [
            'current_page' => $page,
            'per_page' => $perPage,
            'total_items' => $totalAdmins,
            'total_pages' => $totalPages,
        ];
        $data['filters'] = [
            'search' => $search,
            'status' => $status,
        ];
        if ($status === 'active') {
            $activeCount = $this->countFilteredAdmins($search, 'active');
            $inactiveCount = 0;
        } elseif ($status === 'inactive') {
            $activeCount = 0;
            $inactiveCount = $this->countFilteredAdmins($search, 'inactive');
        } else {
            $activeCount = $this->countFilteredAdmins($search, 'active');
            $inactiveCount = $this->countFilteredAdmins($search, 'inactive');
        }

        $data['admin_totals'] = [
            'total' => $totalAdmins,
            'active' => $activeCount,
            'inactive' => $inactiveCount,
        ];
        $data['plan_totals'] = $planTotals;
        $data['pagination_base_url'] = site_url('super-admin/admin-list');

        $this->load->view('super_admin/header', $data);
        $this->load->view('super_admin/admin_list_view', $data);
        $this->load->view('super_admin/footer', $data);
    }

    public function admin_details($id = 0)
    {
        $adminId = (int) $id;

        if ($adminId <= 0) {
            show_404();
        }

        $admin = $this->db
            ->where('id', $adminId)
            ->where('role', 2)
            ->get('users')
            ->row();

        if (!$admin) {
            $this->session->set_flashdata('error', 'Admin account not found.');
            redirect(site_url('super-admin/admin-list'));
        }

        $data = $this->baseViewData();
        $data['active_super_page'] = 'admin_list';
        $data['admin_account'] = $admin;

        $search = trim((string) $this->input->get('search', true));
        $page = max(1, (int) $this->input->get('page'));
        $perPage = 10;

        $buildCustomerQuery = function () use ($adminId, $search) {
            $query = $this->db
                ->from('customers')
                ->where('store_id', $adminId);

            if ($search !== '') {
                $query
                    ->group_start()
                    ->like('name', $search)
                    ->or_like('mobile', $search)
                    ->or_like('address', $search)
                    ->or_like('customer_area', $search)
                    ->group_end();
            }

            return $query;
        };

        $totalCustomers = (int) $buildCustomerQuery()->count_all_results();
        $totalPages = max(1, (int) ceil($totalCustomers / $perPage));

        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $perPage;

        $customers = $buildCustomerQuery()
            ->select('customers.*')
            ->select('(SELECT COUNT(*) FROM orders WHERE orders.customer_id = customers.id) AS total_orders', false)
            ->order_by('customers.id', 'DESC')
            ->limit($perPage, $offset)
            ->get()
            ->result();

        $data['customers'] = $customers;
        $data['customer_filters'] = [
            'search' => $search,
        ];
        $data['customer_pagination'] = [
            'current_page' => $page,
            'per_page' => $perPage,
            'total_items' => $totalCustomers,
            'total_pages' => $totalPages,
        ];
        $data['customer_totals'] = [
            'total' => $totalCustomers,
        ];

        $this->load->view('super_admin/header', $data);
        $this->load->view('super_admin/admin_customer_list_view', $data);
        $this->load->view('super_admin/footer', $data);
    }

    public function plan()
    {
        $data = $this->baseViewData();
        $data['active_super_page'] = 'plan_manage';
        $data['plans'] = $this->Plan_model->get_plan_catalog_for_manage();

        $this->load->view('super_admin/header', $data);
        $this->load->view('super_admin/plan_manage_view', $data);
        $this->load->view('super_admin/footer', $data);
    }

    public function update_plan_catalog()
    {
        if ($this->input->method(true) !== 'POST') {
            show_404();
        }

        $plans = $this->input->post('plans');

        if (!is_array($plans) || empty($plans)) {
            $this->session->set_flashdata('error', 'Please submit valid plan details.');
            redirect(site_url('super-admin/plan'));
        }

        $updated = $this->Plan_model->update_plan_catalog($plans);

        if ($updated) {
            $this->session->set_flashdata('success', 'Plan catalog updated successfully. Admin plan screens now use the new values.');
        } else {
            $this->session->set_flashdata('error', 'Unable to update the plan catalog right now.');
        }

        redirect(site_url('super-admin/plan'));
    }

    public function toggle_admin_status($id = 0)
    {
        $adminId = (int) $id;
        $page = max(1, (int) $this->input->post('page'));
        $search = trim((string) $this->input->post('search', true));
        $status = strtolower(trim((string) $this->input->post('status', true)));
        $status = in_array($status, ['active', 'inactive'], true) ? $status : 'all';

        if ($this->input->method(true) !== 'POST' || $adminId <= 0) {
            show_404();
        }

        $admin = $this->db
            ->where('id', $adminId)
            ->where('role', 2)
            ->get('users')
            ->row();

        if (!$admin) {
            $this->session->set_flashdata('error', 'Admin account not found.');
            redirect($this->buildAdminListUrl($page, $search, $status));
        }

        $newStatus = (int) (!empty($admin->isActive) ? 0 : 1);

        $updated = $this->db
            ->where('id', $adminId)
            ->where('role', 2)
            ->update('users', ['isActive' => $newStatus]);

        if ($updated) {
            $this->session->set_flashdata('success', ($admin->name ?? 'Admin') . ' is now ' . ($newStatus === 1 ? 'active' : 'inactive') . '.');
        } else {
            $this->session->set_flashdata('error', 'Unable to update admin status.');
        }

        redirect($this->buildAdminListUrl($page, $search, $status));
    }
}
