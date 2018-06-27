<?php
defined('BASEPATH') OR exit('No Direct Script Acess');

class Course extends CI_Controller {

	public function index()
	{
		
	}
	
	public function view_detail_kursus($nama_pengajar,$nama_kursus)
	{
		$nama_pengajar2 = $this->functions->ubahKata($nama_pengajar);
		$nama_pengajar_pecah = explode(" ",$nama_pengajar2);
		$nama_depan = $nama_pengajar_pecah[0];
		$nama_belakang = "";
		for ($i=1; $i<=sizeof($nama_pengajar_pecah)-1 ; $i++) { 
			$nama_belakang .= " ".$nama_pengajar_pecah[$i];
		}
		$nama_belakang = trim($nama_belakang);
		$nama_kursus2 = $this->functions->ubahKata($nama_kursus);
		$query = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pelajar.id_pelajar = tb_pengajar.id_pelajar WHERE tb_kursus.nama_kursus='$nama_kursus2' AND tb_pelajar.nama_depan='$nama_depan' AND tb_pelajar.nama_belakang='$nama_belakang'");
		$query = $query->row();
		$id_kursus = $query->id_kursus;
		$id_pengajar = $query->id_pengajar;
		$data_materi = $this->db->query("SELECT * FROM tb_materi WHERE id_kursus='$id_kursus'");
		$jumlah_materi = $data_materi->num_rows();
		$data_kursus_pengajar = $this->db->query("SELECT * FROM tb_kursus WHERE id_pengajar='$id_pengajar'");
		$jumlah_kursus_pengajar = $data_kursus_pengajar->num_rows();
		$data_materi = $this->db->query("SELECT * FROM tb_materi WHERE id_kursus='$id_kursus'");
		$data = [
			'data_materi' => $data_materi,
			'data_kursus' => $query,
			'nama_pengajar' => $nama_pengajar2,
			'nama_kursus' => $nama_kursus2,
			'jumlah_materi' => $jumlah_materi,
			'jumlah_kursus_pengajar' => $jumlah_kursus_pengajar
		];
		$this->template->header($nama_kursus2,2);
		$this->load->view('detail_kursus', $data);
		$this->template->footer();
		
	}

	public function daftar_kursus($id_kursus)
	{
		$user = $this->session->id_pelajar;
		$data = [
			'id_pelajar' => $user,
			'id_kursus' => $id_kursus,
		];
		$result = $this->db->insert('tb_detail_kursus',$data);
	}
}
