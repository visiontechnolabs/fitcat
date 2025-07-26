<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/User_Controller.php');



class Home extends User_Controller
{



    public function __construct()
    {



        parent::__construct();



    }

    public function index(){
       
        $this->load->view('header');
        $this->load->view('home_view');
        $this->load->view('footer');

    }
}