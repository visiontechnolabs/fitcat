<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/Admin_Controller.php');



class Dashboard extends Admin_Controller
{



    public function __construct()
    {



        parent::__construct();



        $this->load->library('form_validation');

        $this->load->library('session');

        $this->load->model('general_model');
        $this->load->helper(['url', 'form']);

        if (!$this->session->userdata('admin')) {

            redirect('admin');
        }


    }

    public function index(){
       
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard_view');
        $this->load->view('admin/footer');

    }
}