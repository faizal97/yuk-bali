<?php 
	defined('BASEPATH') OR exit('No direct script access');

	class Register extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->model('pelajar');
			
			if(isset($this->session->id_user)){
				redirect('home','refresh');	
			}
		}
		
		public function index()
		{
			$data = array(
				'title' => "Yuk Bali - Register",
				'gambar' => 'img/background/daftar.jpg'
			);
			$this->load->view('settings/bootstrap',$data);
			$this->load->view('register');
		}

		function action() {
			$this->pelajar->register();
		}
	}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */