<?php 
	defined('BASEPATH') OR exit('No direct script access');

	class Register extends CI_Controller {

		public function index()
		{
			$this->load->view('settings/bootstrap');
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('register');
			$this->load->view('footer');
		}

		function action() {
		$username = strtolower($this->input->post('username'));
		$nama_depan = strtolower($this->input->post('nama_depan'));
		$nama_belakang = strtolower($this->input->post('nama_belakang'));
		$salt = bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
		$password = $salt.$this->input->post('password');
		$password = hash('sha512',$password);



		$data = array(
			'id_user' => '',
			'username' => $username,
			'nama_depan' => $nama_depan,
			'nama_belakang' => $nama_belakang,
			'password' => $password,
			'password_salt' => $salt
		);

		$result = $this->db->insert('tb_user',$data);

		if($result){
			echo "<script>alert('Data Berhasil Tersimpan');</script>";
			redirect(base_url()."login",'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Tersimpan');</script>";
			redirect(base_url()."register",'refresh');
		}
		}
	}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */