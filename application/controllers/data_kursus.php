<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class data_kursus extends CI_Controller {

	public function index()
	{
		$per_halaman = 5;
		$p = $this->input->get('p');
		if(empty($p)){
			$p = 1;
			$page=0;
		}else{
			$page = ($p - 1) * $per_halaman;
		}
		$query_kursus = "tb_kursus INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar";
		$sql = "SELECT * FROM ".$query_kursus." LIMIT ".$page.",".$per_halaman;
		$query = $this->db->query($sql);
		$data = array();
		$tampil = array(
			'tampil' => $query,
			'aktif' => $p,
			'nomor' => $page,
			'query_kursus' => $query_kursus,
			'link' => 'admin/data_kursus.html',
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/data_kursus', $tampil);
	}

	public function lihat_kursus($id_kursus)
	{
		$sql = "SELECT * FROM tb_kursus INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar WHERE tb_kursus.id_kursus='$id_kursus'";
		$query_kursus = $this->db->query($sql);
		$query_kursus = $query_kursus->row();
		$sql = "SELECT * FROM tb_materi WHERE id_kursus='$id_kursus'";
		$query_materi = $this->db->query($sql);

		$data = [
			'data_kursus' => $query_kursus,
			'data_materi' => $query_materi,
		];
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/lihat_kursus', $data);
	}

	public function lihat_materi($id_kursus,$id_materi)
	{
		$sql = "SELECT * FROM tb_materi WHERE id_kursus='$id_kursus' AND id_materi='$id_materi'";
		$query_materi = $this->db->query($sql);
		$query_materi = $query_materi->row();
		$sql = "SELECT * FROM tb_soal INNER JOIN tb_detail_soal ON tb_soal.id_soal = tb_detail_soal.id_soal WHERE tb_soal.id_materi='$id_materi'";
		$query_soal = $this->db->query($sql);

		$data = [
			'data_materi' => $query_materi,
			'data_soal' => $query_soal,
			'id_kursus' => $id_kursus
		];
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/lihat_materi', $data);
	}

}

/* End of file data_kursus.php */
