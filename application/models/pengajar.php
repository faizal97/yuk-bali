<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajar extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        
    }

   public function become_instructor()
   {
	   $query = $this->db->query("SELECT * FROM tb_pengajar");
	   $id_pengajar = $this->functions->makeID($query,'PGJ',3);
       $data = array(
           'id_pengajar' => $id_pengajar,
           'id_pelajar' => $this->session->id_pelajar
	   );
	   $this->session->id_pengajar = $id_pengajar;
	   $this->session->instructor = TRUE;
       $this->db->insert('tb_pengajar',$data);
       redirect(base_url('kursusku.html'),'refresh');
   }
   
   public function langsung_ngajar($email,$nama,$password)
   {
	$hash = 'sha512';
	$tabel = 'tb_pelajar';
	
	$this->load->model('pelajar');
	$nama_lengkap = $this->db->escape_str($nama);
	$nama_lengkap = explode(" ",$nama_lengkap);
	$nama_depan = $nama_lengkap[0];
	$nama_belakang="";
	for ($i=1; $i < count($nama_lengkap); $i++) { 
		$nama_belakang .= $nama_lengkap[$i]." ";
	}
	$nama_belakang = trim($nama_belakang);

	$salt = bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
	$salted = $salt.$password;
	$hashed_password = hash($hash,$salted);

	$query = $this->db->query("SELECT * FROM tb_pelajar");

	$id = $this->functions->makeID($query,'PLJ',3);

	$data = array(
		'id_pelajar' => $id,
		'email' => $email,
		'nama_depan' => $nama_depan,
		'nama_belakang' => $nama_belakang,
		'password' => $hashed_password,
		'password_salt' => $salt,
	);

	$result = $this->db->insert($tabel,$data);

	$this->pelajar->setSession($email,$password,'aktivasi_pengajar.html');
   }

}

/* End of file Pengajar.php */
