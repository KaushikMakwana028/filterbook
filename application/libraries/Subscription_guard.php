<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subscription_guard
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function enforce($userId = 0)
    {
        $userId = (int) $userId;

        if ($userId <= 0) {
            $admin = $this->CI->session->userdata('admin');
            if (is_array($admin) && !empty($admin['id'])) {
                $userId = (int) $admin['id'];
            }
        }

        if ($userId <= 0) {
            return true;
        }

        $this->CI->load->model('Plan_model');
        $planSummary = $this->CI->Plan_model->get_plan_summary($userId);

        if (!empty($planSummary['is_expired'])) {
            // ✅ DON'T logout - just redirect to plan page with alert
            $this->CI->session->set_flashdata('plan_expired', true);
            $this->CI->session->set_flashdata(
                'plan_expired_message',
                $planSummary['message'] ?? 'Your plan has expired.'
            );
            redirect(site_url('admin/plan'));
            return false;
        }

        return true;
    }
}
