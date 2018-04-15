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
			'nama_belakang' => $this->session->userdata['nama_belakang'],
			'title' => "Yuk Bali - Home"
		);
			$this->load->view('header');
			$this->load->view('settings/bootstrap',$data);
			$this->load->view('menu_dashbord');
			$this->load->view('dashbord',$data);
			$this->load->view('footer');	
		}
		else {
		echo "<script>alert('Harap Login Terlebih Dahulu');</script>";
		redirect("masuk","refresh");
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
		$data = array(
			'title' => $row->nama_depan." ".$row->nama_belakang
		);
		$this->load->view('header');
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('menu_dashbord');
		$this->load->view('profile',$row);
		$this->load->view('footer');
	}

	public function mycourse($tipe='',$aksi='')
	{
		$this->load->library('session');
		if(empty($tipe)){	
		$id_user = $this->session->id_user;
		$query = $this->db->query("SELECT * FROM tb_kursus WHERE id_user='$id_user'");
		$data = array(
			'username' => $this->session->userdata['username'],
			'query' => $query,
			'title' => ucwords($this->session->userdata['username'])."'s Course"
		);
		$this->load->view('settings/bootstrap', $data);
		$this->load->view('header');
		$this->load->view('menu_dashbord');
		$this->load->view('mycourse',$data);
		$this->load->view('footer');
		
	}
	else if($tipe=='add'){
		if(empty($aksi)){
			$data = array(
				'title' => 'Tambah Kursus'
			);
			$this->load->view('settings/bootstrap', $data);
			$this->load->view('header');
			$this->load->view('menu_dashbord');
			$this->load->view('mycourse_add');
			$this->load->view('footer');
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