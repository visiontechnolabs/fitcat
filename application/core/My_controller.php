<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $user_data = [];
    public $user_data_admin;
    public $user_data_provider;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->user_data_admin = $this->session->userdata('admin');
        $this->user_data_provider = $this->session->userdata('provider');
        $this->user_data = $this->session->userdata('user');

        $this->load->vars(['user_data_admin' => $this->user_data_admin]);
        $this->load->vars(['user_data_provider' => $this->user_data_provider]);
        $this->load->vars(['user_data' => $this->user_data]);
    }
}
