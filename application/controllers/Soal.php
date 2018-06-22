<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Soal extends CI_Controller {

	public function proses_tambah_soal($nama_kursus)
	{
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$user = $this->session->id_pengajar;
		$query = $this->db->query("SELECT * FROM tb_soal");
		$id_soal = $this->functions->makeID($query,'SOL',3);
		$id_materi = $this->input->post('id_materi');
		$data = [
			'id_soal' => $id_soal,
			'id_materi' => $id_materi,
		];
		$result = $this->db->insert('tb_soal',$data);
		if($result)
		{
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'.html?tab=soal',"Soal Berhasil Ditambahkan !");
		}
		else
		{
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'.html?tab=soal',"Soal Gagal Ditambahkan !");
		}
	}
}

/* End of file Soal.php */
