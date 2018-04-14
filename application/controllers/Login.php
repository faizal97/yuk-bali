<?php
defined('BASEPATH') OR exit('No Direct script access');

class Login extends CI_Controller {

	public function index() {
		$this->load->view('settings/bootstrap');
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('login');
		$this->load->view('footer');		
	}

	public function action()
	{
		$this->load->library('session');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->db->query("SELECT * FROM tb_user WHERE username='".$username."'");
		$row = $query->row();

		if(isset($row)){
			$password = hash('sha512',$row->password_salt.$password);
			$data = array(
				'id_user' => $row->id_user,
				'username' => $username,
				'nama_depan' => $row->nama_depan,
				'nama_belakang' => $row->nama_belakang,
				'password' => $password,
				'logged_in' => TRUE
			);
			if($username == $row->username){
				if($password == $row->password){
					echo "<script>alert('BERHASIL LOGIN');</script>";
					$this->session->set_userdata($data);
					redirect(base_url()."home.html","refresh");
				}
			}
				echo "<script>alert('GAGAL LOGIN');</script>";
				redirect(base_url()."masuk.html","refresh");			
		}
		echo "<script>alert('GAGAL LOGIN');</script>";
		redirect(base_url()."masuk.html","refresh");
	}
}
