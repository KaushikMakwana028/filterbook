<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public $data = [];
	private $jwt_secret = 'a4f9e6d5b5c4a1b92f3d93d9f53aa8e13efadceeb89e6ba841dd23456789abcd';

	private function normalizeMobile($mobile)
	{
		return preg_replace('/\D+/', '', (string) $mobile);
	}

	private function getMobileCandidates($mobile)
	{
		$normalized = $this->normalizeMobile($mobile);

		if ($normalized === '') {
			return [];
		}

		$candidates = [$normalized];
		$lastTen = strlen($normalized) > 10 ? substr($normalized, -10) : $normalized;

		$candidates[] = $lastTen;
		$candidates[] = '+' . $normalized;
		$candidates[] = '+91' . $lastTen;

		return array_values(array_unique($candidates));
	}

	private function findUserByMobileAndPassword($table, $mobile, $plainPassword, $extraWhere = [])
	{
		$mobiles = $this->getMobileCandidates($mobile);
		$passwords = array_values(array_unique([$plainPassword, md5($plainPassword)]));

		if (empty($mobiles) || empty($passwords)) {
			return null;
		}

		$this->db->from($table);
		$this->db->where_in('password', $passwords);

		foreach ($extraWhere as $key => $value) {
			$this->db->where($key, $value);
		}

		$this->db->where_in('mobile', $mobiles);

		return $this->db->get()->row();
	}

	private function findAdminByIdentifier($identifier)
	{
		$identifier = trim((string) $identifier);

		if ($identifier === '') {
			return null;
		}

		if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
			return $this->db
				->where('email', $identifier)
				->where_in('role', [1, 2])
				->get('users')
				->row();
		}

		$mobiles = $this->getMobileCandidates($identifier);

		if (empty($mobiles)) {
			return null;
		}

		return $this->db
			->where_in('mobile', $mobiles)
			->where_in('role', [1, 2])
			->get('users')
			->row();
	}

	private function buildUserSession($user)
	{
		return [
			'id' => (int) $user->id,
			'email' => (string) ($user->email ?? ''),
			'name' => (string) ($user->name ?? ''),
			'store_name' => (string) ($user->store_name ?? ''),
			'role' => (int) ($user->role ?? 0),
			'phone' => (string) ($user->mobile ?? ''),
		];
	}

	private function redirectUserByRole($user)
	{
		$role = (int) ($user->role ?? 0);

		if ($role === 1) {
			$this->session->set_userdata('super_admin', $this->buildUserSession($user));
			$this->session->unset_userdata('admin');
			redirect(site_url('super-admin/dashboard'));
		}

		if ($role === 2) {
			$this->load->model('Plan_model');
			$planSummary = $this->Plan_model->get_plan_summary((int) $user->id);
			$sessionData  = $this->buildUserSession($user);

			if (!empty($planSummary['is_expired'])) {
				// ✅ Expired - session set but NO persistence (expires on browser close)
				$sessionData['plan_expired']    = true;
				$sessionData['has_active_plan'] = false;
				$this->session->set_userdata('admin', $sessionData);
				$this->session->unset_userdata('super_admin');
				$this->session->set_flashdata('plan_expired', true);
				$this->session->set_flashdata(
					'plan_expired_message',
					$planSummary['message'] ?? 'Your plan has expired.'
				);
				redirect(site_url('admin/plan'));
				return;
			}

			// ✅ Active plan - check if paid plan exists
			$hasPaidPlan = !empty($planSummary['has_active_paid_plan']);
			$sessionData['plan_expired']    = false;
			$sessionData['has_active_plan'] = $hasPaidPlan;
			$this->session->set_userdata('admin', $sessionData);
			$this->session->unset_userdata('super_admin');

			if ($hasPaidPlan) {
				// ✅ Paid plan - make session persistent (survive browser close)
				$this->_make_session_persistent();
			}
			// Trial - session dies on browser close (login every time)

			redirect(site_url('admin/dashboard'));
			return;
		}

		$this->session->set_flashdata('error', 'This account is not allowed.');
		redirect(site_url('admin/login'));
	}

	// ✅ Makes session survive browser close via cookie
	private function _make_session_persistent()
	{
		$session_id = $this->session->session_id;
		// Set cookie to last 30 days
		setcookie(
			$this->config->item('sess_cookie_name'),
			$session_id,
			time() + (30 * 24 * 60 * 60),
			'/',
			'',
			false,
			true
		);
	}

	private function upgradeLegacyPassword($table, $userId, $storedPassword, $plainPassword)
	{
		if ($storedPassword === $plainPassword) {
			$this->db->where('id', $userId);
			$this->db->update($table, ['password' => md5($plainPassword)]);
		}
	}

	private function requireAdminSession()
	{
		$admin = $this->session->userdata('admin');

		if (!$admin) {
			$this->session->set_flashdata('error', 'Please sign in first.');
			redirect(site_url('admin/login'));
		}

		$this->load->library('subscription_guard');
		$this->subscription_guard->enforce((int) $admin['id']);

		return $admin;
	}

	private function getExistingPanelSessionUrl()
	{
		if ($this->session->userdata('super_admin')) {
			return site_url('super-admin/dashboard');
		}

		if ($this->session->userdata('admin')) {
			$admin = $this->session->userdata('admin');
			$adminId = is_array($admin) ? (int) ($admin['id'] ?? 0) : (is_object($admin) ? (int) ($admin->id ?? 0) : 0);

			if ($adminId > 0) {
				$this->load->model('Plan_model');
				$planSummary = $this->Plan_model->get_plan_summary($adminId);

				if (!empty($planSummary['is_expired'])) {
					return site_url('admin/plan');
				}
			}

			return site_url('admin/dashboard');
		}

		return '';
	}

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('general_model');
		$this->form_validation->set_error_delimiters("<div class='error'>", "</div>");

		$method = $this->router->fetch_method();

		if ($method == 'index') {
			$existingPanelUrl = $this->getExistingPanelSessionUrl();

			if ($existingPanelUrl !== '') {
				redirect($existingPanelUrl);
			}
		}
	}

	public function index()
	{
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() === true) {
			$plainPassword = $this->input->post('password');
			$mobile = $this->input->post('mobile');

			$user = $this->findUserByMobileAndPassword('users', $mobile, $plainPassword);

			if ($user) {
				if ($user->isActive == '0') {
					$this->session->set_flashdata('error', 'Your account is not active yet. Please contact administrator!');
					redirect(site_url('admin'), 'refresh');
				}

				$this->upgradeLegacyPassword('users', $user->id, $user->password, $plainPassword);
				$loginMessage = (int) $user->role === 1 ? 'Super admin login successful!' : 'Admin login successful!';

				if ((int) $user->role === 2) {
					$this->load->model('Plan_model');
					$planSummary = $this->Plan_model->get_plan_summary((int) $user->id);

					if (!empty($planSummary['is_expired'])) {
						$loginMessage = 'Login successful. ' . $planSummary['message'] . ' You can continue only from the plan page.';
					} elseif (!empty($planSummary['is_last_day'])) {
						$loginMessage .= ' Today is the last day of your free trial.';
					} elseif (!empty($planSummary['is_trial'])) {
						$loginMessage .= ' Free trial active with ' . (int) $planSummary['days_left'] . ' day' . ((int) ($planSummary['days_left'] ?? 0) === 1 ? '' : 's') . ' left.';
					} elseif (!empty($planSummary['show_expiry_warning'])) {
						$loginMessage .= ' ' . (string) ($planSummary['warning_message'] ?? '');
					}
				}

				$this->session->set_flashdata('success', $loginMessage);
				$this->redirectUserByRole($user);
			}

			$technician = $this->findUserByMobileAndPassword('technicians', $mobile, $plainPassword);

			if ($technician) {
				if ($technician->isActive == '0') {
					$this->session->set_flashdata('error', 'Your technician account is not active yet. Contact admin.');
					redirect(site_url('admin'), 'refresh');
				}

				$this->upgradeLegacyPassword('technicians', $technician->id, $technician->password, $plainPassword);

				$session = array(
					'id' => $technician->id,
					'name' => $technician->name,
					'phone' => $technician->mobile,
					'store_id' => $technician->store_id,
					'store_name' => $technician->store_name,
				);

				$this->session->set_userdata('technician', $session);
				$this->session->set_flashdata('success', 'Technician login successful!');
				redirect(site_url('technician_dashboard'), 'refresh');
			}

			$this->session->set_flashdata('error', 'Invalid mobile or password. Please try again.');
			redirect(site_url('admin'), 'refresh');
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->session->set_flashdata('error', strip_tags(validation_errors(' ', ' ')) ?: 'Mobile and password are required.');
			redirect(site_url('admin/login'));
		}

		$this->load->view('admin/login_view.php');
	}

	public function sign_up()
	{
		$data = [
			'custom_errors' => [],
		];

		if ($_POST) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('store_name', 'Store Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

			if ($this->form_validation->run() !== true) {
				$this->load->view('admin/sign_up.php', $data);
				return;
			}

			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');
			$mobile = $this->normalizeMobile($this->input->post('mobile'));
			$email = trim((string) $this->input->post('email'));
			$username = trim((string) $this->input->post('username'));
			$storeName = trim((string) $this->input->post('store_name'));

			if ($username === '' || $storeName === '' || $email === '' || $mobile === '' || $password === '' || $confirm_password === '') {
				$data['custom_errors']['username'] = $username === '' ? 'Username is required.' : '';
				$data['custom_errors']['store_name'] = $storeName === '' ? 'Store name is required.' : '';
				$data['custom_errors']['email'] = $email === '' ? 'Email address is required.' : '';
				$data['custom_errors']['mobile'] = $mobile === '' ? 'Mobile number is required.' : '';
				$data['custom_errors']['password'] = $password === '' ? 'Password is required.' : '';
				$data['custom_errors']['confirm_password'] = $confirm_password === '' ? 'Confirm password is required.' : '';
				$this->load->view('admin/sign_up.php', $data);
				return;
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$data['custom_errors']['email'] = 'Please enter a valid email address.';
				$this->load->view('admin/sign_up.php', $data);
				return;
			}

			if (strlen($mobile) < 10) {
				$data['custom_errors']['mobile'] = 'Please enter a valid mobile number.';
				$this->load->view('admin/sign_up.php', $data);
				return;
			}

			if ($password !== $confirm_password) {
				$data['custom_errors']['confirm_password'] = 'Password and confirm password do not match.';
				$this->load->view('admin/sign_up.php', $data);
				return;
			}

			$this->db->where('mobile', $mobile);
			$existing_user = $this->db->get('users')->row();

			if ($existing_user) {
				$data['custom_errors']['mobile'] = 'Mobile number already registered.';
				$this->load->view('admin/sign_up.php', $data);
				return;
			}

			$existing_email = $this->db->where('email', $email)->get('users')->row();
			if ($existing_email) {
				$data['custom_errors']['email'] = 'Email address already registered.';
				$this->load->view('admin/sign_up.php', $data);
				return;
			}

			$data = array(
				'name' => $username,
				'store_name' => $storeName,
				'email' => $email,
				'mobile' => $mobile,
				'role' => 2,
				'isActive' => 1,
				'password' => md5($password),
				'created_on' => date('Y-m-d H:i:s'),
			);

			$insert_id = $this->general_model->insert('users', $data);

			if ($insert_id) {
				$this->session->set_flashdata('success', 'Register successfully!');
				$user = $this->general_model->getOne('users', array('id' => $insert_id));

				$this->load->model('Plan_model');
				$this->Plan_model->get_or_create_subscription((int) $insert_id);

				$this->session->set_userdata('admin', $this->buildUserSession($user));
				$this->session->unset_userdata('super_admin');
				redirect(site_url('admin/dashboard'));
			}

			$data['custom_errors']['general'] = 'Something went wrong. Try again after sometime.';
			$this->load->view('admin/sign_up.php', $data);
			return;
		}

		$this->load->view('admin/sign_up.php', $data);
	}

	public function logout()
	{
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('super_admin');
		$this->session->set_flashdata('success', 'You have logged out successfully!');

		redirect(site_url('admin/login'), 'refresh');
	}

	public function t_logout()
	{
		$this->session->unset_userdata('technician');
		$this->session->set_flashdata('success', 'You have logged out successfully!');

		redirect(site_url('admin/login'), 'refresh');
	}

	public function reset_password_page()
{
    $token = $this->input->get('token');

    // No token → redirect
    if (empty($token)) {
        $this->session->set_flashdata('error', 'Invalid or missing reset link.');
        redirect(site_url('admin/login'));
        return;
    }

    // Decode & validate token
    $decoded = json_decode(base64_decode(urldecode($token)), true);

    if (!$decoded || !isset($decoded['user_id'], $decoded['expire'])) {
        $this->session->set_flashdata('error', 'Invalid reset link.');
        redirect(site_url('admin/login'));
        return;
    }

    // Check expiry
    if (time() > $decoded['expire']) {
        $data['step']    = 'expired';
        $data['token']   = $token;
        $this->load->view('admin/forgot_password', $data);
        return;
    }

    // Check user exists
    $user = $this->db->get_where('users', ['id' => $decoded['user_id']])->row_array();

    if (!$user) {
        $this->session->set_flashdata('error', 'User not found.');
        redirect(site_url('admin/login'));
        return;
    }

    // All good → show reset form
    $data['step']    = 'reset';
    $data['token']   = $token;
    $data['user_id'] = $decoded['user_id'];
    $this->load->view('admin/forgot_password', $data);
}
	public function reset_password()
{
    header('Content-Type: application/json');

    /* -------------------------
       ONLY ALLOW POST
    ------------------------- */
    // $methodError = $this->ensureMethod('POST');
    // if ($methodError !== null) {
    //     return $methodError;
    // }

    /* -------------------------
       GET INPUT
    ------------------------- */
    $input = json_decode(file_get_contents('php://input'), true);
    $token    = trim((string)($input['token'] ?? ''));
    $password = trim((string)($input['password'] ?? ''));
    $confirm  = trim((string)($input['confirm_password'] ?? ''));

    /* -------------------------
       VALIDATION
    ------------------------- */
    if (empty($token)) {
        return $this->output->set_output(json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Reset token is required',
            'data'    => null
        ]));
    }

    if (empty($password)) {
        return $this->output->set_output(json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Password is required',
            'data'    => null
        ]));
    }

    if (strlen($password) < 6) {
        return $this->output->set_output(json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Password must be at least 6 characters',
            'data'    => null
        ]));
    }

    if ($password !== $confirm) {
        return $this->output->set_output(json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Passwords do not match',
            'data'    => null
        ]));
    }

    /* -------------------------
       DECODE & VALIDATE TOKEN
    ------------------------- */
    $decoded = json_decode(base64_decode($token), true);

    if (!$decoded || !isset($decoded['user_id'], $decoded['expire'])) {
        return $this->output->set_output(json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Invalid reset token',
            'data'    => null
        ]));
    }

    if (time() > $decoded['expire']) {
        return $this->output->set_output(json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'Reset link has expired. Please request a new one',
            'data'    => null
        ]));
    }

    /* -------------------------
       CHECK USER EXISTS
    ------------------------- */
    $user = $this->db
        ->get_where('users', ['id' => $decoded['user_id']])
        ->row_array();

    if (!$user) {
        return $this->output->set_output(json_encode([
            'code'    => 400,
            'status'  => false,
            'message' => 'User not found',
            'data'    => null
        ]));
    }

    /* -------------------------
       UPDATE PASSWORD (MD5)
    ------------------------- */
    $this->db->where('id', $decoded['user_id']);
    $this->db->update('users', [
        'password' => md5($password)
    ]);

    if ($this->db->affected_rows() < 1) {
        return $this->output->set_output(json_encode([
            'code'    => 500,
            'status'  => false,
            'message' => 'Failed to update password. Please try again',
            'data'    => null
        ]));
    }

    /* -------------------------
       SUCCESS
    ------------------------- */
    return $this->output->set_output(json_encode([
        'code'    => 200,
        'status'  => true,
        'message' => 'Password updated successfully. You can now login.',
        'data'    => null
    ]));
}

	public function change_password()
	{
		$admin = $this->requireAdminSession();
		$data['admin'] = $admin;
		$this->load->view('admin/header');
		$this->load->view('admin/change_password', $data);
		$this->load->view('admin/footer');
	}

	public function change_password_update()
	{
		$admin = $this->requireAdminSession();
		$password = (string) $this->input->post('password');
		$confirmPassword = (string) $this->input->post('confirm_password');

		if ($password === '' || $confirmPassword === '') {
			$this->session->set_flashdata('error', 'Password and confirm password are required.');
			redirect(site_url('change_password'));
		}

		if ($password !== $confirmPassword) {
			$this->session->set_flashdata('error', 'Password and confirm password do not match.');
			redirect(site_url('change_password'));
		}

		$user = $this->db
			->where('id', (int) $admin['id'])
			->where('role', 2)
			->get('users')
			->row();

		if (!$user) {
			$this->session->set_flashdata('error', 'Admin account not found.');
			redirect(site_url('admin/login'));
		}

		$this->db->where('id', (int) $user->id);
		$updated = $this->db->update('users', ['password' => md5($password)]);

		if ($updated) {
			$this->session->set_flashdata('success', 'Password changed successfully.');
			redirect(site_url('change_password'));
		}

		$this->session->set_flashdata('error', 'Failed to update password. Please try again.');
		redirect(site_url('change_password'));
	}

	

	public function update_password()
	{
		$password = $this->input->post('password');
		$confirm_password = $this->input->post('confirm_password');
		$store_id = $this->input->post('store_id');
		$hashed_password = md5($password);
		$this->db->where('id', $store_id);
		$updated = $this->db->update('users', ['password' => $hashed_password]);

		if ($updated) {
			echo json_encode(['status' => 'success', 'message' => 'Password updated successfully']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update password']);
		}
	}
}
