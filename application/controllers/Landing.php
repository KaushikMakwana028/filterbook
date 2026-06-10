<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller
{
    public function index()
    {
        $this->load->view('landing');
    }

    public function privacy_policy()
    {
        $this->load->view('public/privacy_policy');
    }

    public function terms_and_conditions()
    {
        $this->load->view('public/terms_and_conditions');
    }

    public function refund_policy()
    {
        $this->load->view('public/refund_policy');
    }
     public function delete_account()
    {
        $this->load->view('public/delete_account');
    }
}
