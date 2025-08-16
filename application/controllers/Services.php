<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/User_Controller.php');



class Services extends User_Controller
{



    public function __construct()
    {



        parent::__construct();



    }

   public function index()
{
    // Just load the view — do NOT fetch all services here
    $this->load->view('header');
    $this->load->view('service_view'); // service_view has empty container for AJAX
    $this->load->view('footer');
}
    public function fetch_services()
{
    $page = $this->input->get('page') ?? 1;
    $limit = 8; // how many cards per page
    $offset = ($page - 1) * $limit;

    $this->db->select('service.*, users.gym_name, provider.city');
    $this->db->from('service');
    $this->db->join('provider', 'provider.provider_id = service.provider_id', 'left');
    $this->db->join('users', 'users.id = provider.provider_id', 'left');
    $this->db->where('service.isActive', 1);
    $total = $this->db->count_all_results('', false);

    $this->db->limit($limit, $offset);
    $services = $this->db->get()->result();

    echo json_encode([
        'services' => $services,
        'total'    => $total,
        'limit'    => $limit,
        'page'     => $page
    ]);
}

}