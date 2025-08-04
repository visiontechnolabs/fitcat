<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/User_Controller.php');



class Home extends User_Controller
{



    public function __construct()
    {



        parent::__construct();



    }

    public function index()
    {
        $this->data['category'] = $this->general_model->getAll('categories', ['isActive' => 1]);
       $trainer_sub = $this->db->get_where('subcategories', [
    'title' => 'TRAINER',
    'isActive' => 1
])->row();

// Fetch Gym Subcategory ID
$gym_sub = $this->db->get_where('subcategories', [
    'title' => 'GYM',
    'isActive' => 1
])->row();

$trainer_id = $trainer_sub ? $trainer_sub->id : 0;
$gym_id = $gym_sub ? $gym_sub->id : 0;
 // Fetch Trainer Providers with User Details + Service Count
    $this->data['trainer_providers'] = $this->db
        ->select('provider.*, users.name, users.gym_name, COUNT(service.id) as total_services')
        ->from('provider')
        ->join('users', 'users.id = provider.provider_id', 'left')
        ->join('service', 'service.provider_id = provider.provider_id', 'left')
        ->where('provider.sub_category', $trainer_id)
        ->where('provider.isActive', 1)
        ->group_by('provider.id')
        ->get()
        ->result();

    // Fetch Gym Providers with User Details + Service Count
    $this->data['gym_providers'] = $this->db
        ->select('provider.*, users.name, users.gym_name, COUNT(service.id) as total_services')
        ->from('provider')
        ->join('users', 'users.id = provider.provider_id', 'left')
        ->join('service', 'service.provider_id = provider.provider_id', 'left')
        ->where('provider.sub_category', $gym_id)
        ->where('provider.isActive', 1)
        ->group_by('provider.id')
        ->get()
        ->result();

         $this->data['user_location'] = $this->session->userdata('user_location') 
        ? $this->session->userdata('user_location') 
        : '';
        


        // echo "<pre>";
        // print_r($this->data['trainer_providers']);
        // print_r($this->data['gym_providers']);

        // die;
        $this->load->view('header');
        $this->load->view('home_view',$this->data);
        $this->load->view('footer');

    }
    public function save_location()
{
    $location = $this->input->post('location');
    $this->session->set_userdata('user_location', $location);
    echo 'success';
}
}