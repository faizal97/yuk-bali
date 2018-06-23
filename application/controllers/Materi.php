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

	public function view_kelola_materi($nama_kursus,$nama_materi)
	{
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$nama_materi2 = str_replace("-"," ",$nama_materi);
		$user = $this->session->id_pengajar;
		$query = $this->db->query("SELECT * FROM tb_materi INNER JOIN tb_kursus ON tb_kursus.id_kursus = tb_materi.id_kursus WHERE tb_materi.nama_materi = '$nama_materi2' AND tb_kursus.nama_kursus='$nama_kursus2' AND tb_kursus.id_pengajar = '$user'");
		$query = $query->row();
		$data = [
			'data_materi' => $query,
			'judul_materi' => $nama_materi2,
			'judul_kursus' => $nama_kursus2,
			'pengajar' => $this->session->nama_depan." ".$this->session->nama_belakang 
		];

		$this->template->header($nama_kursus2." - ".$nama_materi2,2);
		$this->load->view('kelola_kursus/tampil_materi',$data);
		$this->template->footer();		
	}

	public function proses_edit_url_video($nama_kursus,$nama_materi)
	{
		$url_video = $this->input->post('url_video');
		if(empty($url_video) || $url_video == null){
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/materi/'.$nama_materi.'.html','URL Tidak Boleh Kosong !');
		}
		if(strpos($url_video,"youtube.com/watch?v=")!=false)
		{
			$url_valid = true;
		}
		else 
		{
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/materi/'.$nama_materi.'.html','Format URL Tidak Valid !');
		}
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$nama_materi2 = str_replace("-"," ",$nama_materi);
		$user = $this->session->id_pengajar;
		$query = $this->db->query("SELECT * FROM tb_materi INNER JOIN tb_kursus ON tb_kursus.id_kursus = tb_materi.id_kursus WHERE tb_materi.nama_materi = '$nama_materi2' AND tb_kursus.nama_kursus='$nama_kursus2' AND tb_kursus.id_pengajar = '$user'");
		$query = $query->row();
		$id_materi = $query->id_materi;
		$data = [
			'url_video' => $url_video
		];

		$this->db->where('id_materi',$id_materi);
		$result = $this->db->update('tb_materi',$data);

		if ($result) {
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/materi/'.$nama_materi.'.html','URL Video Berhasil Disimpan');
		}
		else {
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/materi/'.$nama_materi.'.html','URL Video Gagal Disimpan');
		}
	}

	public function proses_edit_artikel($nama_kursus,$nama_materi)
	{
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$nama_materi2 = str_replace("-"," ",$nama_materi);
		$user = $this->session->id_pengajar;
		$isi_materi = $this->input->post('artikel');
		$query = $this->db->query("SELECT * FROM tb_materi INNER JOIN tb_kursus ON tb_kursus.id_kursus = tb_materi.id_kursus WHERE tb_materi.nama_materi = '$nama_materi2' AND tb_kursus.nama_kursus='$nama_kursus2' AND tb_kursus.id_pengajar = '$user'");
		$query = $query->row();
		$id_materi = $query->id_materi;
		$data = [
			'isi_materi' => $isi_materi
		];

		$this->db->where('id_materi',$id_materi);
		$result = $this->db->update('tb_materi',$data);

		if ($result) {
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/materi/'.$nama_materi.'.html','Artikel Berhasil Disimpan');
		}
		else {
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/materi/'.$nama_materi.'.html','Artikel Gagal Disimpan');
		}
	}

}

/* End of file Materi.php */
