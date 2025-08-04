<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/User_Controller.php');



class Services extends User_Controller
{



    public function __construct()
    {



        parent::__construct();



    }

    public function index(){
       $this->db->select('service.*, users.gym_name, provider.city');
$this->db->from('service');
$this->db->join('provider', 'provider.provider_id = service.provider_id', 'left');
$this->db->join('users', 'users.id = provider.provider_id', 'left');
$this->db->where('service.isActive', 1);
$this->data['services'] = $this->db->get()->result();

        // echo "<pre>";
        // print_r($this->data['service']);
        // die;

        $this->load->view('header');
        $this->load->view('service_view',$this->data);
        $this->load->view('footer');

    }
}