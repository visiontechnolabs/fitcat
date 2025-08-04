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

        if (!$this->provider) {
            redirect('provider/login');
        }
// print_r($this->provider);
// die;
$provider_id = $this->provider['id'] ?? $this->provider['user_id'];
        $provider_data = $this->general_model->getOne('provider', ['provider_id' => $provider_id]);

        // Store image and make it accessible everywhere
        $this->provider_image = !empty($provider_data->profile_image) 
            ? base_url($provider_data->profile_image) 
            : base_url('assets/images/3d-cartoon-fitness-man.jpg'); 
    }
}

