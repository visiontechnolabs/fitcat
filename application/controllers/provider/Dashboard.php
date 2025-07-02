<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_controller {

	  public function __construct()
    {



        parent::__construct();



        $this->load->library('form_validation');

        $this->load->library('session');

        $this->load->model('general_model');
        $this->load->helper(['url', 'form']);

        if (!$this->session->userdata('provider')) {

            redirect('provider/dashboard');
        }


    }

	public function index()
	{
		$this->load->view('provider/header');
		$this->load->view('provider/dashboard_view');
		$this->load->view('provider/footer');

	}
}
