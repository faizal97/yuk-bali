<?php
defined('BASEPATH') OR exit('No Direct Script Acess');

class Course extends CI_Controller {

	public function index()
	{
		$id_pelajar = $this->session->id_pelajar;
		$query = $this->db->query("SELECT *,COUNT(tb_materi.id_materi) AS jumlah_materi FROM tb_pelajar INNER JOIN tb_detail_kursus ON tb_pelajar.id_pelajar = tb_detail_kursus.id_pelajar INNER JOIN tb_kursus ON tb_detail_kursus.id_kursus = tb_kursus.id_kursus INNER JOIN tb_materi ON tb_kursus.id_kursus = tb_materi.id_kursus WHERE tb_detail_kursus.id_pelajar='$id_pelajar'");
		$data = [
			'data_kursus' => $query
		];
		$this->template->header('Kursus Saya',2);
		$this->load->view('belajar/kursus_saya', $data);
		$this->template->footer();
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

	public function daftar_kursus($nama_pengajar,$nama_kursus)
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
		$user = $this->session->id_pelajar;
		$query = $this->db->query("SELECT * FROM tb_detail_kursus");
		$id_detail_kursus = $this->functions->makeID($query,'DKU',3);
		$data = [
			'id_detail_kursus' => $id_detail_kursus,
			'id_pelajar' => $user,
			'id_kursus' => $id_kursus,
		];
		$result = $this->db->insert('tb_detail_kursus',$data);
		if ($result) {
			$this->functions->pindah_halaman('kursus.html','Anda Berhasil Mendaftar Kursus!');
		}
		else {
			$this->functions->pindah_halaman($nama_pengajar.'/'.$nama_kursus.'.html','Anda Gagal Mendaftar Kursus!');
		}
	}

	public function belajar($nama_kursus)
	{
		$nama_kursus2 = $this->functions->ubahKata($nama_kursus);
		$user = $this->session->id_pelajar;
		$query = $this->db->query("SELECT *,COUNT(tb_materi.id_materi) AS jumlah_materi FROM tb_kursus INNER JOIN tb_detail_kursus ON tb_detail_kursus.id_kursus = tb_kursus.id_kursus INNER JOIN tb_materi ON tb_materi.id_kursus = tb_kursus.id_kursus WHERE tb_kursus.nama_kursus='$nama_kursus2' AND tb_detail_kursus.id_pelajar='$user'");
		$query = $query->row();
		$id_kursus = $query->id_kursus;
		$query_materi = $this->db->query("SELECT * FROM tb_materi WHERE id_kursus='$id_kursus'");
		$jumlah_materi = $query->jumlah_materi;
		$data = [
			'data_kursus' => $query,
			'data_materi' => $query_materi,
			'jumlah_materi' => $jumlah_materi,
			'nama_kursus' => $nama_kursus2
		];
		$this->template->header($nama_kursus2,2);
		$this->load->view('belajar/detail_kursus', $data);
		$this->template->footer();
	}

	public function belajar_detail($nama_kursus,$nama_materi)
	{
		$nama_kursus2 = $this->functions->ubahKata($nama_kursus);
		$nama_materi2 = $this->functions->ubahKata($nama_materi);
		$user = $this->session->id_pelajar;
		$query = $this->db->query("SELECT *,COUNT(tb_materi.id_materi) AS jumlah_materi FROM tb_kursus INNER JOIN tb_detail_kursus ON tb_detail_kursus.id_kursus = tb_kursus.id_kursus INNER JOIN tb_materi ON tb_materi.id_kursus = tb_kursus.id_kursus WHERE tb_kursus.nama_kursus='$nama_kursus2' AND tb_detail_kursus.id_pelajar='$user'");
		$query = $query->row();
		$id_kursus = $query->id_kursus;
		$query_materi = $this->db->query("SELECT * FROM tb_materi WHERE id_kursus='$id_kursus' AND nama_materi='$nama_materi2'");
		$data_materi = $query_materi->row();
		$data = [
			'data_kursus' => $query,
			'data_materi' => $data_materi,
			'nama_kursus' => $nama_kursus2,
			'nama_materi' => $nama_materi2
		];
		$this->template->header($nama_kursus2.' - '.$nama_materi2,2);
		$this->load->view('belajar/detail_belajar', $data);
		$this->template->footer();
	}
}
