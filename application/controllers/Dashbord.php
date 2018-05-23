<?php
defined('BASEPATH') OR exit('Do Direct script access');

class Dashbord extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->library('session');
			$this->load->model('pengajar');
			$this->load->model('pelajar');
			$this->load->model('functions');

			$this->pelajar->getSession('visitor');
	}
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
		$akses = $this->session->userdata['status'];
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
		$id_pelajar = $this->session->id_pelajar;
		$query = $this->db->query("SELECT tb_kursus.*,tb_kategori.* FROM tb_kursus INNER JOIN tb_kategori ON tb_kategori.id_kategori=tb_kursus.id_kategori WHERE id_pengajar='$id_pelajar'");
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
			$kategori = $this->db->query("SELECT * FROM tb_kategori");
			$data = array(
				'title' => 'Tambah Kursus',
				'kategori' => $kategori
			);
			$this->load->view('settings/bootstrap', $data);
			$this->load->view('header');
			$this->load->view('menu_dashbord');
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

			$config['upload_path'] = "img/course/";
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name'] = $id;
			$config['overwrite'] = true;
			$config['max_size'] = '2000';
			$config['max_width'] ='1024';
			$config['max_height'] = '768';

			$this->load->library('upload',$config);

			if(!$this->upload->do_upload('gambar')){
				echo "<script>alert('".$this->upload->display_errors()."');</script>";
				redirect(base_url().'tambah_kursus.html','refresh');
			}
			else{
				$gambar = "img/course/".$this->upload->data('file_name');
			}
			
			$data = array(
				'id_kursus' => $id,
				'nama_kursus' => $nama_kursus,
				'id_kategori' => $kategori,
				'id_pengajar' => $this->session->id_pelajar,
				'gambar_kursus' => $gambar
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
	public function manage_course($judul)
	{
		$akses = $this->session->userdata['status'];
		$judul = str_replace("_"," ",$judul);
		$user = $this->session->userdata['id_user'];
		$query = $this->db->query("SELECT * FROM tb_kursus WHERE nama_kursus='$judul' AND id_user='$user'");
		$row = $query->row();
		$kategori = $this->db->query('SELECT * FROM tb_kategori');
		$data = array(
			'title' => $judul,
			'data' => $row,
			'kategori' => $kategori
		);
		$this->load->view('settings/bootstrap', $data);
		$this->load->view('header');
		$this->load->view('menu_dashbord');
		if(count($row)<=0){
			$this->load->view('errors/hak_akses');
		}
		else{
		$this->load->view('manage_course',$data);
		}
		$this->load->view('footer');	
	}
	public function delete_course($judul)
	{
		$akses = $this->session->userdata['status'];
		$user = $this->session->userdata['id_user'];
		$judul = str_replace("_"," ",$judul);
		$query = $this->db->query("SELECT * FROM tb_kursus WHERE nama_kursus='$judul' AND id_user='$user'");
		$row = $query->row();
		$query = $this->db->query("DELETE FROM tb_kursus WHERE nama_kursus='$judul' AND id_user='$user'");
		unlink($row->gambar_kursus);
		redirect(base_url().'kursusku.html','refresh');
	}

	public function menjadi_pengajar()
	{
		$this->pengajar->become_instructor();
	}
}