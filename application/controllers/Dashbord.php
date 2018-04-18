<?php
defined('BASEPATH') OR exit('Do Direct script access');

class Dashbord extends CI_Controller {

	public function index()
	{
		$this->load->library('session');
		if(isset($this->session->userdata['username'])){
			$akses = $this->session->userdata['status'];
			$menu = $this->db->query("SELECT * FROM tb_menu WHERE hak_akses LIKE '%$akses%'");
			$data = array(
				'username' => $this->session->userdata['username'],
				'nama_depan' => ucwords($this->session->userdata['nama_depan']),
				'nama_belakang' => $this->session->userdata['nama_belakang'],
				'title' => "Yuk Bali - Home",
				'menu' => $menu
			);
			$this->load->view('header');
			$this->load->view('settings/bootstrap',$data);
			$this->load->view('menu_dashbord',$data);
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
		$akses = $this->session->userdata['status'];
		$menu = $this->db->query("SELECT * FROM tb_menu WHERE hak_akses LIKE '%$akses%'");
		$data = array(
			'title' => $row->nama_depan." ".$row->nama_belakang,
			'menu' => $menu
		);
		$this->load->view('header');
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('menu_dashbord',$data);
		$this->load->view('profile',$row);
		$this->load->view('footer');
	}

	public function mycourse($tipe='',$aksi='')
	{
		$this->load->library('session');
		if(empty($tipe)){	
		$id_user = $this->session->id_user;
		$query = $this->db->query("SELECT tb_kursus.*,tb_kategori.* FROM tb_kursus INNER JOIN tb_kategori ON tb_kategori.id_kategori=tb_kursus.id_kategori WHERE id_user='$id_user'");
		$akses = $this->session->userdata['status'];
		$menu = $this->db->query("SELECT * FROM tb_menu WHERE hak_akses LIKE '%$akses%'");
		$data = array(
			'username' => $this->session->userdata['username'],
			'query' => $query,
			'title' => ucwords($this->session->userdata['username'])."'s Course",
			'menu' => $menu
		);
		$this->load->view('settings/bootstrap', $data);
		$this->load->view('header');
		$this->load->view('menu_dashbord',$menu);
		$this->load->view('mycourse',$data);
		$this->load->view('footer');
		
	}
	else if($tipe=='add'){
		if(empty($aksi)){
			$kategori = $this->db->query("SELECT * FROM tb_kategori");
			$akses = $this->session->userdata['status'];
			$menu = $this->db->query("SELECT * FROM tb_menu WHERE hak_akses LIKE '%$akses%'");
			$data = array(
				'title' => 'Tambah Kursus',
				'kategori' => $kategori,
				'menu' => $menu
			);
			$this->load->view('settings/bootstrap', $data);
			$this->load->view('header');
			$this->load->view('menu_dashbord',$menu);
			$this->load->view('mycourse_add',$data);
			$this->load->view('footer');
		}
		else if($aksi=='action'){
			$nama_kursus = $this->input->post('nama_kursus');
			$kategori = $this->input->post('kategori');

			$query = $this->db->query("SELECT * FROM tb_kursus");
			$num = $query->num_rows() + 1;
			$query = $this->db->query("SELECT * FROM tb_kategori WHERE id_kategori='$kategori'");
			$row = $query->row();

			$id = "11".$row->id_kategori.$num;
			$data = array(
				'id_kursus' => $id,
				'nama_kursus' => $nama_kursus,
				'id_kategori' => $kategori,
				'id_user' => $this->session->id_user
			);

			$result = $this->db->insert('tb_kursus',$data);

			if($result){
				echo "<script>alert('Kursus Berhasil Ditambahkan');</script>";
				redirect(base_url().'kursusku.html','refresh');
			}
			else {
				echo "<script>alert('Kursus Gagal Ditambahkan');</script>";
				redirect(base_url().'tambah_kursus.html','refresh');
				
			}
		}
	}
} 
}