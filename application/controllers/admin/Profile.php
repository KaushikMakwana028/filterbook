<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('subscription_guard');
    }

    private function getAdminUserId()
    {
        $adminSession = $this->session->userdata('admin');

        if (is_array($adminSession) && isset($adminSession['id'])) {
            return (int) $adminSession['id'];
        }

        if (is_object($adminSession) && isset($adminSession->id)) {
            return (int) $adminSession->id;
        }

        if (is_numeric($adminSession)) {
            return (int) $adminSession;
        }

        return 0;
    }

    private function normalizeMobile($mobile)
    {
        $normalized = preg_replace('/\D+/', '', (string) $mobile);

        if ($normalized === '') {
            return '';
        }

        if (strlen($normalized) !== 10) {
            return null;
        }

        return $normalized;
    }

    public function index()
    {
        $user_id = $this->getAdminUserId();

        if (!$user_id) {
            redirect('admin/login');
        }

        $this->subscription_guard->enforce($user_id);

        $data['user'] = $this->db->get_where('users', [
            'id' => $user_id
        ])->row();

        if (!$data['user']) {
            show_404();
        }

        $data['vendor'] = $data['user'];
        $data['products'] = $this->db
            ->where('admin_id', $user_id)
            ->order_by('id', 'DESC')
            ->get('catalog')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/profile', $data);
        $this->load->view('admin/footer');
    }

    public function update()
    {
        $user_id = $this->getAdminUserId();

        if (!$user_id) {
            redirect('admin/login');
        }

        $this->subscription_guard->enforce($user_id);

        $mobile = $this->normalizeMobile($this->input->post('mobile'));

        if ($mobile === null) {
            $this->session->set_flashdata('error', 'Mobile number must be exactly 10 digits.');
            redirect('admin/profile');
        }

        $data = [
            'name' => trim((string) $this->input->post('name')),
            'store_name' => trim((string) $this->input->post('store_name')),
            'email' => trim((string) $this->input->post('email')),
            'mobile' => $mobile,
            // 🔥 NEW FIELDS
            'address' => trim((string) $this->input->post('address')),
            'instagram' => trim((string) $this->input->post('instagram')),
            'facebook' => trim((string) $this->input->post('facebook')),
        ];

        // IMAGE UPLOAD
        if (!empty($_FILES['profile_image']['name'])) {
            $uploadPath = FCPATH . 'uploads/profile_img/';

            if (!is_dir($uploadPath)) {
                @mkdir($uploadPath, 0777, true);
            }

            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = true;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('profile_image')) {
                $uploadData = $this->upload->data();
                $data['profile_image'] = 'uploads/profile_img/' . $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('error', strip_tags($this->upload->display_errors('', '')));
                redirect('admin/profile');
            }
        }

        $this->db->where('id', $user_id);
        $updated = $this->db->update('users', $data);

        $adminSession = $this->session->userdata('admin');

        if (is_array($adminSession)) {
            $adminSession['name'] = $data['name'];
            $adminSession['store_name'] = $data['store_name'];
            $adminSession['email'] = $data['email'];
            $adminSession['phone'] = $data['mobile'];
            if (!empty($data['profile_image'])) {
                $adminSession['profile_image'] = $data['profile_image'];
            }
            $this->session->set_userdata('admin', $adminSession);
        }

        $this->session->set_flashdata($updated ? 'success' : 'error', $updated ? 'Profile updated successfully.' : 'Profile update failed.');

        redirect('admin/profile');
    }
}
