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
		$this->setSession($euser,$password);

		echo "<script>alert('Email atau Kata sandi salah');</script>";
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
			echo "<script>alert('Kata Sandi tidak cocok');</script>";
			redirect(base_url()."daftar.html",'refresh');			
		}

		// Cek Jika Ada Email Yang Sama
		if ($this->functions->cekSamaData($tabel,'email',$email)) {
			echo "<script>alert('Email telah terdaftar');</script>";
			redirect(base_url()."daftar.html",'refresh');
		}


		$query = $this->db->query("SELECT * FROM $tabel");

		$id=$this->makeID($query,'PLJ',3);

		$data = array(
			'id_pelajar' => $id,
			'email' => $email,
			'nama_depan' => $nama_depan,
			'nama_belakang' => $nama_belakang,
			'password' => $hashed_password,
			'password_salt' => $salt,
		);

		$result = $this->db->insert($tabel,$data);

		if($result){
			$this->setSession($email,$password);
		}
		else {
			echo "<script>alert('Data Gagal Tersimpan');</script>";
			redirect(base_url($gagal),'refresh');
		}
	}
	// END :  Method Register Pelajar

	// Begin : Method Set Session Pelajar
	public function setSession($euser='',$password='',$berhasil='home.html',$gagal='masuk.html',$tabel='tb_pelajar')
	{
		$hash = 'sha512';
		$query = $this->db->query("SELECT * FROM $tabel WHERE email='".$euser."'");
		$ketemu = $query->num_rows();
		if($ketemu<1){
			echo "<script>alert('GAGAL LOGIN');</script>";
			redirect(base_url($gagal),"refresh");
		}
		$row = $query->row();
		$id_pelajar = $row->id_pelajar;
		$query2 = $this->db->query("SELECT * FROM tb_pengajar WHERE id_pelajar='".$id_pelajar."'");
		$query_guru = $query2->row();
		if ($query2->num_rows() > 0) {
			$instruct = true;
			$id_pengajar = $query_guru->id_pengajar;
		}
		else {
			$instruct = false;
			$id_pengajar = null;
		}
		if(isset($row)){
			$password = hash($hash,$row->password_salt.$password);
			$data = array(
				'id_pelajar' => $row->id_pelajar,
				'id_pengajar' => $id_pengajar,
				'email' => $row->email,
				'nama_depan' => $row->nama_depan,
				'nama_belakang' => $row->nama_belakang,
				'password' => $password,
				'learner' => true,
				'instructor' => $instruct,
				'gambar_profil' => $row->foto_profil,
				'logged_in' => TRUE
			);

			if($euser == $row->email){
				if($password == $row->password){
					$this->session->set_userdata($data);
					redirect(base_url($berhasil));
				}
			}
			}
			echo "<script>alert('GAGAL LOGIN');</script>";
				redirect(base_url($gagal),"refresh");			
		}	
	// End : Method Set Session Pelajar

	// Begin : Method Make ID Pelajar
	public function makeID($query,$depan,$banyak_nol=5)
	{
		$no = 1;
		foreach ($query->result() as $value) {
			$id_temp = $depan.$this->functions->buatnol($no,$banyak_nol);
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
		return $depan.$this->functions->buatnol($num,$banyak_nol);
	}
	// End : Method Make ID Pelajar


	public function logout($redir)
	{
		$this->session->sess_destroy();
		redirect(base_url($redir),"refresh");
	}
}

/* End of file Pelajar.php */
