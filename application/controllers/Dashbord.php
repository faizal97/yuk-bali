<?php
defined('BASEPATH') OR exit('Do Direct script access');

class Dashbord extends CI_Controller {

	public function index()
	{
		$this->load->library('session');

		if(isset($this->session->userdata['username'])){
		$data = array(
			'username' => $this->session->userdata['username'],
			'nama_depan' => ucwords($this->session->userdata['nama_depan']),
			'nama_belakang' => $this->session->userdata['nama_belakang']
		);
			$this->load->view('dashbord',$data);
		}
		else {
		echo "<script>alert('Harap Login Terlebih Dahulu');</script>";
		redirect(base_url()."login","refresh");
		}
	}

	public function profile($username='')
	{
		$this->load->library('session');
		if(empty($username)){
			$query = $this->db->query("SELECT * FROM tb_user WHERE username='".$this->session->userdata['username']."'");
		}
		else{
			$query = $this->db->query("SELECT * FROM tb_user WHERE username='".$username."'");
		}
		$row = $query->row();
		if($query->num_rows()<=0){
			show_error("User Tidak Ditemukan.<br>Hubungi Admin Untuk Meminta Bantuan.<br><a href=".base_url()."dashbord>Kembali</a>",404,"[ERROR] User $username Tidak Ditemukan");
		}
		$this->load->view('profile',$row);
	}

	public function mycourse($tipe='',$aksi='')
	{
		$this->load->library('session');
		if(empty($tipe)){	
		$id_user = $this->session->id_user;
		$query = $this->db->query("SELECT * FROM tb_kursus WHERE id_user='$id_user'");
		$data = array(
			'username' => $this->session->userdata['username'],
			'query' => $query
		);
		$this->load->view('mycourse',$data);
	}
	else if($tipe=='add'){
		if(empty($aksi)){
			$this->load->view('mycourse_add');
		}
		else if($aksi=='action'){
			$nama_kursus = $this->input->post('nama_kursus');

			$data = array(
				'id_kursus' => '',
				'nama_kursus' => $nama_kursus,
				'id_user' => $this->session->id_user
			);

			$result = $this->db->insert('tb_kursus',$data);

			if($result){
				echo "<script>alert('Kursus Berhasil Ditambahkan');</script>";
				redirect(base_url().'dashbord/mycourse','refresh');
			}
			else {
				echo "<script>alert('Kursus Gagal Ditambahkan');</script>";
				redirect(base_url().'dashbord/mycourse/add','refresh');
				
			}
		}
	}
} 
}