<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/Admin_Controller.php');



class Customers extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

    }


   public function index()
{
    $this->load->view('admin/header');
    $this->load->view('admin/customer_view');
    $this->load->view('admin/footer');
}

public function fetch_customers()
{
    $this->load->database();
    $limit = 10; // records per page
    $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
    $offset = ($page - 1) * $limit;

    $search = $this->input->get('search');

    $this->db->where('role', 0);
    if (!empty($search)) {
        $this->db->group_start()
                 ->like('name', $search)
                 ->or_like('email', $search)
                 ->or_like('mobile', $search)
                 ->group_end();
    }
    $total = $this->db->count_all_results('users', FALSE); // count with filters

    $this->db->limit($limit, $offset);
    $query = $this->db->get();

    $data['customers'] = $query->result_array();
    $data['total'] = $total;
    $data['limit'] = $limit;
    $data['page'] = $page;

    echo json_encode($data);
}



}