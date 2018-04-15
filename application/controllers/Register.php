<?php 
	defined('BASEPATH') OR exit('No direct script access');

	class Register extends CI_Controller {

		public function index()
		{
			$data = array(
				'title' => "Yuk Bali - Register"
			);
			$this->load->view('settings/bootstrap',$data);
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('register');
			$this->load->view('footer');
		}

		function action() {
		$username = strtolower($this->input->post('username'));
		$nama_depan = $this->input->post('nama_depan');
		$nama_belakang = $this->input->post('nama_belakang');
		$salt = bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
		$password = $salt.$this->input->post('password');
		$password2 = $this->input->post('password_ulang');
		$password = hash('sha512',$password);
		$tipe = $this->input->post('tipe');

		if($password2 != $this->input->post('password')){
			echo "<script>alert('Password tidak cocok');</script>";
			redirect(base_url()."daftar.html",'refresh');			
		}

		switch ($tipe) {
			case 'learner':
				$kode = "1";
				break;
			
			case 'instructor':
				$kode = "2";
				break;
			default:
				$kode = "1";
				break;
		}
		$query = $this->db->query("SELECT * FROM tb_user WHERE username='$username'");
		$num = $query->num_rows();
		if($num>0){
			echo "<script>alert('Username telah ada');</script>";
			redirect(base_url()."daftar.html",'refresh');
		}
		$query = $this->db->query("SELECT * FROM tb_user WHERE status='$tipe'");
		$num = $query->num_rows() + 1;
		$id = "10".$kode.Date("y").$num;


		$data = array(
			'id_user' => $id,
			'username' => $username,
			'nama_depan' => $nama_depan,
			'nama_belakang' => $nama_belakang,
			'password' => $password,
			'password_salt' => $salt,
			'status' => $tipe
		);

		$result = $this->db->insert('tb_user',$data);

		if($result){
			// echo "<script>alert('Data Berhasil Tersimpan');</script>";
			redirect(base_url()."masuk.html");
		}
		else {
			echo "<script>alert('Data Gagal Tersimpan');</script>";
			redirect(base_url()."daftar.html",'refresh');
		}
		}
	}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */