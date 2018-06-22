<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

	public function proses_tambah_materi($nama_kursus)
	{
		$nama_materi = $this->input->post('nama_materi');
		$user = $this->session->id_pengajar;
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);

		$query = "SELECT * FROM tb_kursus WHERE nama_kursus='$nama_kursus2' AND id_pengajar='$user'";
		$query_exec = $this->db->query($query);
		if($query_exec->num_rows() < 1){
			$this->functions->pindah_halaman('kursusku.html','Anda Tidak Memiliki Hak Untuk Melakukan Proses Tersebut !');
		}
		$query_exec = $query_exec->row();
		$id_kursus = $query_exec->id_kursus;
		$query = $this->db->query("SELECT * FROM tb_materi");
		$id_materi = $this->functions->makeID($query,"MTR",3);
		$query = $this->db->query("SELECT * FROM tb_materi WHERE id_kursus='$id_kursus'");
		$urut = $query->num_rows() + 1;
		$data = [
			'id_materi' => $id_materi,
			'nama_materi' => $nama_materi,
			'id_kursus' => $id_kursus,
			'urut' => $urut
		];
		$result = $this->db->insert('tb_materi',$data);

		if($result){
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'.html?tab=materi',"Materi Berhasil Ditambahkan !");
		}
		else {
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'.html?tab=materi',"Materi Gagal Ditambahkan !");
		}

	}

}

/* End of file Materi.php */
