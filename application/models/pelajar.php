<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelajar extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('functions');
		$this->load->library('session');
		
		
	}

	public function getSession($tipe)
	{
		if($tipe=='visitor'){	
			if(!isset($this->session->id_pelajar) && empty($this->session->id_pelajar)){
				exit();
				redirect(base_url('welcome.html'),'refresh');
			}
		}
		else {
			if(isset($this->session->id_pelajar) && !empty($this->session->id_pelajar)){
				redirect(base_url('home.html'),'refresh');
			}
		}
	}
	// Begin : Method Login Pelajar
    public function login($berhasil='home.html',$gagal='masuk.html')
    {
		$tabel='tb_pelajar';
		$hash='sha512';


		if(empty($euser) && empty($password)){
			$euser = $this->db->escape_str(($this->input->post('euser')));
			$password = $this->db->escape_str(($this->input->post('password')));
		}

		if (strpos($euser,"@") && strpos($euser,".")) {
			$tipe = 'email';
		}
		else {
			$tipe = 'username';
		}
		$this->setSession($euser,$password,$tipe);

		echo "<script>alert('GAGAL LOGIN');</script>";
		redirect(base_url($gagal),"refresh");
	}
	// End : Method Login Pelajar

	// Begin : Method Register Pelajar
	public function register($berhasil='masuk.html',$gagal='daftar.html')
	{
		$hash = 'sha512';
		$tabel = 'tb_pelajar';

		// Set Data
		$nama_lengkap = $this->db->escape_str($this->input->post('nama_lengkap'));
		$nama_lengkap = explode(" ",$nama_lengkap);
		$username = $this->db->escape_str(strtolower($this->input->post('username')));
		$nama_depan = $nama_lengkap[0];
		$nama_belakang="";
		for ($i=1; $i < count($nama_lengkap); $i++) { 
			$nama_belakang .= $nama_lengkap[$i]." ";
		}
		$nama_belakang = trim($nama_belakang);
		$email = $this->db->escape_str($this->input->post('email'));
		$salt = bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
		$password = $this->db->escape_str($this->input->post('password'));
		$salted = $salt.$password;
		$password2 = $this->db->escape_str($this->input->post('password_ulang'));
		$hashed_password = hash($hash,$salted);
		

		// Password Matching
		if($password2 != $this->input->post('password')){
			echo "<script>alert('Password tidak cocok');</script>";
			redirect(base_url()."daftar.html",'refresh');			
		}

		// Cek Jika Ada Email Yang Sama
		if ($this->functions->cekSamaData($tabel,'email',$email)) {
			echo "<script>alert('Username telah ada');</script>";
			redirect(base_url()."daftar.html",'refresh');
		}

		// Cek Jika Ada Username Yang Sama
		if ($this->functions->cekSamaData($tabel,'username',$username)) {
			echo "<script>alert('Username telah ada');</script>";
			redirect(base_url()."daftar.html",'refresh');
		}


		$query = $this->db->query("SELECT * FROM $tabel WHERE id_pelajar LIKE '".Date("y").Date("m")."%' ");

		$id=$this->makeID($query);

		$data = array(
			'id_pelajar' => $id,
			'email' => $email,
			'username' => $username,
			'nama_depan' => $nama_depan,
			'nama_belakang' => $nama_belakang,
			'password' => $hashed_password,
			'password_salt' => $salt,
		);

		$result = $this->db->insert($tabel,$data);

		if($result){
			$this->setSession($username,$password);
		}
		else {
			echo "<script>alert('Data Gagal Tersimpan');</script>";
			redirect(base_url($gagal),'refresh');
		}
	}
	// END :  Method Register Pelajar

	// Begin : Method Set Session Pelajar
	public function setSession($euser='',$password='',$tipe='username',$berhasil='home.html',$gagal='masuk.html',$tabel='tb_pelajar')
	{
		$hash = 'sha512';
		if ($tipe=='email') {
			$query = $this->db->query("SELECT * FROM $tabel WHERE email='".$euser."'");
		}
		else {
			$query = $this->db->query("SELECT * FROM $tabel WHERE username='".$euser."'");
		}

		$row = $query->row();
		$query2 = $this->db->query("SELECT * FROM tb_pengajar WHERE id_pelajar='$row->id_pelajar'");
		if ($query2->num_rows() > 0) {
			$instruct = true;
		}
		else {
			$instruct = false;
		}
		if(isset($row)){
			$password = hash($hash,$row->password_salt.$password);
			$data = array(
				'id_pelajar' => $row->id_pelajar,
				'username' => $row->username,
				'email' => $row->email,
				'nama_depan' => $row->nama_depan,
				'nama_belakang' => $row->nama_belakang,
				'password' => $password,
				'learner' => true,
				'instructor' => $instruct,
				'gambar_profil' => $row->foto_profil,
				'logged_in' => TRUE
			);

		if ($tipe=='email') {
			if($euser == $row->email){
				if($password == $row->password){
					$this->session->set_userdata($data);
					redirect(base_url($berhasil));
				}
			}
			}
			else {
				if($euser == $row->username){
					if($password == $row->password){
						$this->session->set_userdata($data);
						redirect(base_url($berhasil));
					}
				}
			}

			// Mencocokan dengan database
			if($username == $row->username){
				if($password == $row->password){
					$this->session->set_userdata($data);
					redirect(base_url($berhasil));
				}
			}
			echo "<script>alert('GAGAL LOGIN');</script>";
				redirect(base_url($gagal),"refresh");			
		}
	}
	// End : Method Set Session Pelajar

	// Begin : Method Make ID Pelajar
	public function makeID($query,$banyak_nol=5)
	{
		$no = 1;
		foreach ($query->result() as $value) {
			$id_temp = Date("y").Date("m").$this->functions->buatnol($no,$banyak_nol);
			if ($value->id_pelajar == $id_temp) {
				if ($no == $this->functions->buatnol($query->num_rows(),$banyak_nol)) {
					$no++;
					$num = $no;
					continue;
				}
				$no++;
				continue;
			}
			else {
				$num = $no;
				break;
			}
		}
		if (!isset($num) || empty($num)) {
			$num=1;
		}
		return Date("y").Date("m").$this->functions->buatnol($num,$banyak_nol);
	}
	// End : Method Make ID Pelajar


	public function logout($redir)
	{
		$this->session->sess_destroy();
		redirect(base_url($redir),"refresh");
	}
}

/* End of file Pelajar.php */
