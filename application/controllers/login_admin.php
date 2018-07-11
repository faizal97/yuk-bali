<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_admin extends CI_Controller {

	// Menampilkan Halaman login
	public function index()
	{
		$this->load->library('session'); //session_start()
		if (empty($this->session->username_admin)|| !isset($this->session->username_admin)) {
			$data = array();
			$this->load->view('settings/bootstrap',$data);
			$this->load->view('admin/login_admin');
		}else{
			redirect('admin/beranda','refresh');
	}
}
	public function proses()
	{
		// Maksudnya sama seperti session_start()
		$this->load->library('session');

		// Mengambil data login
		$username_admin = $this->input->post('username_admin');
		$password_admin = $this->input->post('password_admin');

		// Mengambil data di database dengan email yang di inputkan saat login oleh user
		$query = $this->db->query("SELECT * FROM tb_admin WHERE username_admin='$username_admin'");
		
		// sama seperti mysqli_fetch_array tapi bedanya data yang diambil hanya 1 buah data.
		$row = $query->row();
		if (count($row)<=0) {
			redirect(base_url('admin/masuk.html'),'refresh');
		}
		// Data Password yang di inputkan user saat login digabungkan dengan salt yang ada di database
		// lalu di rubah menjadi md5
		$salt_login = $row->salt_admin.$password_admin;
		$salt_login = hash('sha512',$salt_login);

		// Mencocokan data login yang dimasukan user dengan yang ada di database
		// $row->email sama seperti $row['email']
		// Mencocokan password yang di input user bersama salt di database dan telah diubah menjadi md5
		// dengan password yang ada di database

		if ($salt_login == $row->password_admin) {
			// Menyiapkan data untuk dimasukan ke Session
			// sama halnya seperti $_SESSION['email'] = $email, dll
			// tetapi data baru hanya disiapkan belum di masukan ke dalam session
			$data_session = array(
				'id_admin' => $row->id_admin,
				'username_admin' => $row->username_admin,
				'nm_depan' => $row->nm_depan,
				'nm_belakang' => $row->nm_belakang,
				'password_admin' => $row->password_admin
			);
			// Memasukan data yang disiapkan ke Session nya
			$this->session->set_userdata($data_session);
			// Pindah halaman ke dashbord.html
			redirect(base_url('admin/beranda.html'),'refresh');
		}
		else {
			// Jika password salah
			redirect(base_url('admin/masuk.html'),'refresh');
		}
	}

	public function logout()
	{
		// Mengaktifkan session
		$this->load->library('session');
		
		// Menhapus seluruh session yang tersimpan
		$this->session->sess_destroy();
		
		//pindah ke halaman awal website
		redirect(base_url('admin/masuk.html'),'refresh');
		
	}
}
