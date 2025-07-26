<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/Provider_Controller.php');



class Wallet extends Provider_Controller
{



    public function __construct()
    {



        parent::__construct();

 }

    public function index(){
       
        $this->load->view('provider/header');
        $this->load->view('provider/wallet_view');
        $this->load->view('provider/footer');

    }

    public function scheduled(){
        $this->load->view('provider/header');
        $this->load->view('provider/schedule_view');
        $this->load->view('provider/footer');
    }
}