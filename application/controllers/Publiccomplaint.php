<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publiccomplaint extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function form($customer_id = 0)
    {
        $customer_id = (int) $customer_id;
        $customer = $this->db->get_where('customers', ['id' => $customer_id])->row();

        if (!$customer) {
            show_404();
        }

        $vendor = $this->db->get_where('users', ['id' => (int) $customer->store_id])->row();

        if (!$vendor) {
            show_404();
        }

        $orders = $this->db
            ->from('orders')
            ->where('customer_id', $customer_id)
            ->where('store_id', (int) $customer->store_id)
            ->order_by('date_of_purchase', 'DESC')
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        if (empty($orders)) {
            $this->session->set_flashdata('error', 'No purchased product found for this customer.');
            redirect(site_url('admin/complaint'));
        }

        $data['vendor'] = $vendor;
        $data['customer'] = $customer;
        $data['customer_id'] = $customer_id;
        $data['orders'] = $orders;
        $data['issue_options'] = [
            'Water leakage',
            'No cooling',
            'Bad taste / smell',
            'Low pressure',
            'Power issue',
            'Filter replacement',
            'Installation issue',
            'Other'
        ];

        $this->load->view('complaint_public', $data);
    }

    public function save($customer_id = 0)
    {
        $customer_id = (int) $customer_id;
        $customer = $this->db->get_where('customers', ['id' => $customer_id])->row();

        if (!$customer) {
            show_404();
        }

        $order_id = (int) $this->input->post('order_id', true);
        $issue = trim((string) $this->input->post('issue', true));
        $details = trim((string) $this->input->post('complain_details', true));

        $order = $this->db
            ->from('orders')
            ->where('id', $order_id)
            ->where('customer_id', $customer_id)
            ->where('store_id', (int) $customer->store_id)
            ->get()
            ->row();

        if (!$order || $issue === '' || $details === '') {
            $this->session->set_flashdata('error', 'Please select your product and fill all required fields.');
            redirect(site_url('complaint/' . $customer_id));
        }

        if (str_word_count($details) > 250) {
            $this->session->set_flashdata('error', 'Complaint details must be 250 words or less.');
            redirect(site_url('complaint/' . $customer_id));
        }

        $area = '';
        if (!empty($customer->customer_area)) {
            $area = (string) $customer->customer_area;
        } elseif (!empty($customer->area)) {
            $area = (string) $customer->area;
        } else {
            $area = (string) $customer->address;
        }

        $this->db->insert('complaint', [
            'store_id' => (int) $customer->store_id,
            'name' => (string) $customer->name,
            'mobile' => (string) $customer->mobile,
            'address' => (string) $customer->address,
            'area' => $area,
            'product_name' => (string) $order->product_name,
            'status' => 1,
            'status_customer' => 1,
            'assign_to' => 0,
            'issue' => $issue,
            'serial_number' => (string) $order->product_modal,
            'created_at' => date('Y-m-d H:i:s'),
            'complain_details' => $details
        ]);

      // ✅ Get inserted complaint ID
$complaint_id = $this->db->insert_id();

// ✅ Prepare notification data
$type    = 'complaint';
$title   = 'New Complaint Received';
$message = $customer->name . ' raised a complaint for ' . $order->product_name;

// ✅ Insert Notification
$this->db->insert('notifications', [
    'store_id'     => (int) $customer->store_id,
    'type'         => $type,
    'title'        => $title,
    'message'      => $message,
    'reference_id' => $complaint_id,
    'is_read'      => 0,
    'created_at'   => date('Y-m-d H:i:s')
]);

// ✅ Get notification ID
$notification_id = $this->db->insert_id();

// ✅ Send Push Notification (to STORE OWNER)
$this->send_expo_push(
    $customer->store_id, // assuming store_id = user_id
    $title,
    $message,
    [
        'type' => $type,
        'complaint_id' => $complaint_id,
        'notification_id' => $notification_id
    ]
);

        $this->session->set_flashdata('success', 'Complaint submitted successfully.');
        redirect(site_url('complaint/' . $customer_id));
    }

    private function send_expo_push($user_id,$title,$message,$data=[])
{

    $tokenRow = $this->db
        ->where('store_id',$user_id)
        ->get('user_devices')
        ->row();

    if(!$tokenRow){
        return false;
    }

    $expo_token = $tokenRow->fcm_token;

    $payload = [
        'to'=>$expo_token,
        'title'=>$title,
        'body'=>$message,
        'sound'=>'default',
        'priority'=>'high',
        'data'=>$data
    ];

    $ch = curl_init('https://exp.host/--/api/v2/push/send');

    curl_setopt_array($ch,[
        CURLOPT_POST=>true,
        CURLOPT_RETURNTRANSFER=>true,
        CURLOPT_HTTPHEADER=>[
            'Accept: application/json',
            'Content-Type: application/json'
        ],
        CURLOPT_POSTFIELDS=>json_encode($payload)
    ]);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;
}
}
