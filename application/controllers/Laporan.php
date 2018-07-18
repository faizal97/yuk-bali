<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class laporan extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->load->library('Pdf');
	}

	public function kursus()
	{
		$query = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori ORDER BY nama_kursus ASC");
		$data = [
			'data_kursus' => $query
		];
		$this->load->view('admin/laporan_kursus', $data);
	}

	
	public function pelajar($id_kursus)
	{
		$query = $this->db->query("SELECT * FROM tb_detail_kursus INNER JOIN tb_pelajar ON tb_detail_kursus.id_pelajar = tb_pelajar.id_pelajar WHERE tb_detail_kursus.id_kursus='$id_kursus' ORDER BY tb_pelajar.nama_depan");
		$data = [
			'data_kursus' => $query
		];
		$this->load->view('kelola_kursus/laporan_pelajar', $data);
	}

	public function nilai($id_kursus)
	{
		$query = $this->db->query("SELECT * FROM tb_nilai INNER JOIN tb_soal ON tb_soal.id_soal = tb_nilai.id_soal INNER JOIN tb_pelajar ON tb_nilai.id_pelajar = tb_pelajar.id_pelajar INNER JOIN tb_materi ON tb_materi.id_materi = tb_soal.id_materi WHERE tb_materi.id_kursus='$id_kursus' ORDER BY tb_pelajar.nama_depan");
		$data = [
			'data_kursus' => $query
		];
		$this->load->view('kelola_kursus/laporan_nilai', $data);
	}

}

/* End of file laporan.php */
