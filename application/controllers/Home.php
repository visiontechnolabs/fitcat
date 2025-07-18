<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Home extends MY_Controller
{



    public function __construct()
    {



        parent::__construct();



        $this->load->library('form_validation');

        $this->load->library('session');

        $this->load->model('general_model');
        $this->load->helper(['url', 'form']);

        // if (!$this->session->userdata('user')) {

        //     redirect('admin');
        // }


    }

    public function index(){
       
        $this->load->view('header');
        $this->load->view('home_view');
        $this->load->view('footer');

    }
}