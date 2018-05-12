<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelajar extends CI_Model {

	
	// Begin : Method Login Pelajar
    public function login($berhasil='home.html',$gagal='masuk.html')
    {
		$tabel='tb_pelajar';
		$hash='sha512';

		if(empty($username) && empty($password)){
			$username = $this->db->escape_str(($this->input->post('username')));
			$password = $this->db->escape_str(($this->input->post('password')));
		}

		$this->setSession($username,$password);

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
		$username = $this->db->escape_str(strtolower($this->input->post('username')));
		$nama_depan = $this->db->escape_str($this->input->post('nama_depan'));
		$nama_belakang = $this->db->escape_str($this->input->post('nama_belakang'));
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

		// Check Availability Username
		$query = $this->db->query("SELECT * FROM $tabel WHERE username='$username'");
		$num = $query->num_rows();
		if($num>0){
			echo "<script>alert('Username telah ada');</script>";
			redirect(base_url()."daftar.html",'refresh');
		}


		$query = $this->db->query("SELECT * FROM $tabel WHERE id_pelajar LIKE '".Date("y").Date("m")."%' ");

		$this->makeID($query);

		$data = array(
			'id_pelajar' => $id,
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
	public function setSession($username='',$password='',$berhasil='home.html',$gagal='masuk.html',$tabel='tb_pelajar')
	{
		$hash = 'sha512';
		$query = $this->db->query("SELECT * FROM $tabel WHERE username='".$username."'");
		$row = $query->row();

		if(isset($row)){
			$password = hash($hash,$row->password_salt.$password);
			$data = array(
				'id_pelajar' => $row->id_pelajar,
				'username' => $username,
				'nama_depan' => $row->nama_depan,
				'nama_belakang' => $row->nama_belakang,
				'password' => $password,
				'status' => 'Learner',
				'gambar_profil' => $row->foto_profil,
				'logged_in' => TRUE
			);

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
	public function makeID($query,$banyak_nol=6)
	{
		$no = 1;
		foreach ($query->result() as $value) {
			if ($value->id_pelajar == (integer)Date("y").Date("m").$no) {
				if ($no == $query->num_rows()) {
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
		$countnum = strlen((string)$num);
		$sisa = $banyak_nol - $countnum;

		$nol = null;
		for ($i=1; $i <= $sisa ; $i++) { 
			$nol .= "0";
		}

		return Date("y").Date("m").$nol.$num;
	}
	// End : Method Make ID Pelajar

	public function logout($redir)
	{
		$this->session->sess_destroy();
		redirect(base_url($redir),"refresh");
	}
}

/* End of file Pelajar.php */
