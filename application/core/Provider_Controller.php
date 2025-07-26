<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provider_Controller extends CI_Controller
{
    public $provider;

    public function __construct()
    {
        parent::__construct();

        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
        $this->load->model('general_model');

        $this->provider = $this->session->userdata('provider');

        if (!$this->provider || !$this->provider['is_logged_in']) {
            redirect('provider/login');
        }
    }
}

