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
}