<?php
defined('BASEPATH') OR exit('No Direct script access');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('pelajar');
		$this->load->model('template');
		

		$this->pelajar->getSession('login');
	}
	
	public function index() {
		$data = array(
			'title' => "Yuk Bali - Login",
			'gambar' => 'img/background/blur.png'
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('login');		
	}

	public function action()
	{
		$this->pelajar->login();
	}
}
