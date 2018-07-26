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

	public function view_kelola_soal($nama_kursus,$nama_materi)
	{
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$nama_materi2 = str_replace("-"," ",$nama_materi);
		$user = $this->session->id_pengajar;
		$query = $this->db->query("SELECT * FROM tb_materi INNER JOIN tb_kursus ON tb_materi.id_kursus = tb_kursus.id_kursus INNER JOIN tb_soal ON tb_materi.id_materi = tb_soal.id_materi WHERE tb_materi.nama_materi='$nama_materi2' AND tb_kursus.nama_kursus='$nama_kursus2' AND tb_kursus.id_pengajar='$user'");
		$query = $query->row();
		$data = [
			'data_soal' => $query,
			'judul_materi' => $nama_materi2,
			'judul_kursus' => $nama_kursus2,
			'pengajar' => $this->session->nama_depan." ".$this->session->nama_belakang 
		];

		$this->template->header($nama_kursus2." - ".$nama_materi2,2);
		$this->load->view('kelola_kursus/tampil_soal',$data);
		$this->template->footer();		
	}

	public function proses_tambah_detail_soal($nama_kursus,$nama_materi)
	{
		$nama_soal = $this->input->post('nama_soal');
		$pilihan1 = $this->input->post('pilihan1');
		$pilihan2 = $this->input->post('pilihan2');
		$pilihan3 = $this->input->post('pilihan3');
		$pilihan4 = $this->input->post('pilihan4');
		$jawaban = $this->input->post('jawaban');
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$nama_materi2 = str_replace("-"," ",$nama_materi);
		$user = $this->session->id_pengajar;
		$query = $this->db->query("SELECT * FROM tb_materi INNER JOIN tb_kursus ON tb_materi.id_kursus = tb_kursus.id_kursus INNER JOIN tb_soal ON tb_materi.id_materi = tb_soal.id_materi WHERE tb_materi.nama_materi='$nama_materi2' AND tb_kursus.nama_kursus='$nama_kursus2' AND tb_kursus.id_pengajar='$user'");
		$query = $query->row();
		$id_soal = $query->id_soal;
		$query_id = $this->db->query("SELECT * FROM tb_detail_soal");
		$id_detail_soal = $this->functions->makeID($query_id,'DSO',3);
		$data = [
			'id_detail_soal' => $id_detail_soal,
			'id_soal' => $id_soal,
			'nama_soal' => $nama_soal,
			'pilihan1' => $pilihan1,
			'pilihan2' => $pilihan2,
			'pilihan3' => $pilihan3,
			'pilihan4' => $pilihan4,
			'jawaban' => $jawaban
		];
		$result = $this->db->insert('tb_detail_soal',$data);
		if($result){
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/soal/'.$nama_materi.'.html',"Soal Berhasil Ditambahkan !");
		}
		else {
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/soal/'.$nama_materi.'.html',"Soal Gagal Ditambahkan !");
		}
	}

	public function proses_hapus_detail_soal($nama_kursus,$nama_materi,$id_detail_soal)
	{
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$nama_materi2 = str_replace("-"," ",$nama_materi);
		$user = $this->session->id_pengajar;
		$query = $this->db->query("DELETE FROM tb_detail_soal WHERE id_detail_soal='$id_detail_soal'");
		if ($query) {
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/soal/'.$nama_materi.'.html',"Soal Berhasil Dihapus !");
		}
		else 
		{
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/soal/'.$nama_materi.'.html',"Soal Gagal Dihapus !");
		}
	}

	public function view_detail_soal($nama_kursus,$nama_materi,$id_detail_soal)
	{
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$nama_materi2 = str_replace("-"," ",$nama_materi);
		$user = $this->session->id_pengajar;
		$query = $this->db->query("SELECT * FROM tb_detail_soal WHERE id_detail_soal='$id_detail_soal'");
		$query = $query->row();
		$data = [
			'data_soal' => $query,
			'judul_materi' => $nama_materi2,
			'judul_kursus' => $nama_kursus2,
		];
		$this->template->header($nama_kursus2." - ".$nama_materi2,2);
		$this->load->view('kelola_kursus/tampil_detail_soal',$data);
		$this->template->footer();	
	}

	public function proses_edit_detail_soal($nama_kursus,$nama_materi,$id_detail_soal)
	{
		$nama_soal = $this->input->post('nama_soal');
		$pilihan1 = $this->input->post('pilihan1');
		$pilihan2 = $this->input->post('pilihan2');
		$pilihan3 = $this->input->post('pilihan3');
		$pilihan4 = $this->input->post('pilihan4');
		$jawaban = $this->input->post('jawaban');
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$nama_materi2 = str_replace("-"," ",$nama_materi);
		$user = $this->session->id_pengajar;
		$data = [
			'nama_soal' => $nama_soal,
			'pilihan1' => $pilihan1,
			'pilihan2' => $pilihan2,
			'pilihan3' => $pilihan3,
			'pilihan4' => $pilihan4,
			'jawaban' => $jawaban
		];

		$this->db->where('id_detail_soal',$id_detail_soal);
		$result = $this->db->update('tb_detail_soal',$data);
		if ($result) {
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/soal/'.$nama_materi.'/'.$id_detail_soal.'.html',"Soal Berhasil Diubah !");
		}
		else{
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'/soal/'.$nama_materi.'/'.$id_detail_soal.'.html',"Soal Gagal Diubah !");
		}
	}

	public function proses_hapus_soal($nama_kursus,$id_soal)
	{
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$user = $this->session->id_pengajar;
		$query = $this->db->query("DELETE FROM tb_soal WHERE id_soal='$id_soal'");
		if($query){
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'.html?tab=soal','Soal Berhasil Dihapus');
		}
		else
		{
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'html?tab=soal','Soal Gagal Dihapus');
		}
		
	}

	public function proses_hapus_semua_soal($nama_kursus)
	{
		$nama_kursus2 = str_replace("-"," ",$nama_kursus);
		$user = $this->session->id_pengajar;
		$query = $this->db->query("DELETE tb_soal FROM tb_soal INNER JOIN tb_materi ON tb_soal.id_materi = tb_materi.id_materi INNER JOIN tb_kursus ON tb_materi.id_kursus = tb_kursus.id_kursus WHERE tb_kursus.nama_kursus='$nama_kursus2'");
	
		if($query){
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'.html?tab=soal','Data Soal Berhasil Dihapus');
		}
		else
		{
			$this->functions->pindah_halaman('kursusku/kelola/'.$nama_kursus.'html?tab=soal','Data Soal Gagal Dihapus');
		}
	}
}

/* End of file Soal.php */
