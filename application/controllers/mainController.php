<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	//This function will load the home page..
	public function index() {
		$this->load->view('mainView');
	}
	

}
