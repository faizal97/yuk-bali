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
		$user = $this->session->id_pelajar;
		if(isset($this->session->id_pelajar)){
			$query = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori ORDER BY RAND() LIMIT 4 ");
			$query2 = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori ORDER BY tb_kursus.tgl_buat DESC LIMIT 4 ");
			$data = array(
				'data_kursus' => $query,
				'data_kursus_baru' => $query2,
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

	public function profile($id='')
	{
		$id_pelajar = $this->session->id_pelajar;
		if(empty($id)){			
			$query = $this->db->query("SELECT * FROM tb_pelajar WHERE id_pelajar='$id_pelajar'");
		}
		else{
			$query = $this->db->query("SELECT * FROM tb_pelajar WHERE id_pelajar='$id'");
		}
		$row = $query->row();
		if($query->num_rows()<=0){
			show_error("User Tidak Ditemukan.<br>Hubungi Admin Untuk Meminta Bantuan.<br><a href=".base_url()."dashbord>Kembali</a>",404,"[ERROR] User Tidak Ditemukan");
		}
		$data = array(
			'title' => $row->nama_depan." ".$row->nama_belakang,
			'data_profil' => $row
		);
		$this->template->header('Profil',2);
		$this->load->view('profile',$data);
		$this->load->view('footer');
	}

	public function menjadi_pengajar()
	{
		$this->pengajar->become_instructor();
	}
}
