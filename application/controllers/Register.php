<?php 
	defined('BASEPATH') OR exit('No direct script access');

	class Register extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->model('pelajar');
			
			$this->pelajar->getSession('login');
		}
		
		public function index()
		{
			$data = array(
				'title' => "Yuk Bali - Register",
				'gambar' => 'img/background/blur.png'
			);
			$this->load->view('settings/bootstrap',$data);
			$this->load->view('register');
		}

		function action() {
			$this->pelajar->register();
		}

		public function daftar_pengajar()
		{
			$this->load->model('pengajar');
			$this->pengajar->langsung_ngajar($this->input->post('email'),$this->input->post('nama_lengkap'),$this->input->post('password'));
		}
	}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
