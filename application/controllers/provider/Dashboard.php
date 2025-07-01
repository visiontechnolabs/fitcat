<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_controller {

	
	public function index()
	{
		$this->load->view('welcome_message');
	}
}
