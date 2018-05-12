<?php
defined('BASEPATH') OR exit('No Direct script access');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('pelajar');
		$this->load->model('template');
		

		if(isset($this->session->id_user)){
			
			redirect('home','refresh');
			
		}
	}
	
	public function index() {
		$data = array(
			'title' => "Yuk Bali - Login",
			'gambar' => 'img/background/login.jpg'
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('login');		
	}

	public function action()
	{
		$this->pelajar->login();
	}
}
