<?php
defined('BASEPATH') OR exit('No Direct Script Acess');

class Course extends CI_Controller {

	public function index()
	{
		$id_pelajar = $this->session->id_pelajar;
		$query = $this->db->query("SELECT * FROM tb_pelajar INNER JOIN tb_detail_kursus ON tb_pelajar.id_pelajar = tb_detail_kursus.id_pelajar INNER JOIN tb_kursus ON tb_detail_kursus.id_kursus = tb_kursus.id_kursus WHERE tb_detail_kursus.id_pelajar='$id_pelajar'");
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
		$data_materi = $this->db->query("SELECT * FROM tb_materi WHERE id_kursus='$id_kursus' ORDER BY urut ASC");
		$tombol_daftar = true;
		$user = $this->session->id_pelajar;
			$sql = $this->db->query("SELECT * FROM tb_detail_kursus WHERE id_pelajar='$user' AND id_kursus='$id_kursus'");
			$jml = $sql->num_rows();
		if ($id_pengajar == $this->session->id_pelajar) {
			$tombol_daftar = false;
		}
		elseif ($jml>0) {
			$tombol_daftar = false;
		}
		$data = [
			'data_materi' => $data_materi,
			'data_kursus' => $query,
			'nama_pengajar' => $nama_pengajar2,
			'nama_kursus' => $nama_kursus2,
			'jumlah_materi' => $jumlah_materi,
			'jumlah_kursus_pengajar' => $jumlah_kursus_pengajar,
			'id_pengajar' => $id_pengajar,
			'tombol' => $tombol_daftar
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
		$query_materi = $this->db->query("SELECT * FROM tb_materi WHERE id_kursus='$id_kursus' ORDER BY urut ASC");
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
		$materi_terakhir = $query->materi_terakhir;
		$query_materi = $this->db->query("SELECT * FROM tb_materi WHERE id_kursus='$id_kursus' AND nama_materi='$nama_materi2'");
		$data_materi = $query_materi->row();
		$id_materi = $data_materi->id_materi;
		$urut = $data_materi->urut;
		$cek_nilai = $this->db->query("SELECT * FROM tb_nilai INNER JOIN tb_soal ON tb_nilai.id_soal = tb_soal.id_soal INNER JOIN tb_materi ON tb_soal.id_materi = tb_materi.id_materi WHERE tb_materi.id_materi='$id_materi' AND tb_nilai.id_pelajar='$user'");
		if ($cek_nilai->num_rows() > 0 || $materi_terakhir > $urut ) {
			$sudah_belajar = true;
		}
		else {
			$sudah_belajar = false;
		}
		$data = [
			'data_kursus' => $query,
			'data_materi' => $data_materi,
			'nama_kursus' => $nama_kursus2,
			'nama_materi' => $nama_materi2,
			'sudah_belajar' => $sudah_belajar
		];
		$this->template->header($nama_kursus2.' - '.$nama_materi2,2);
		$this->load->view('belajar/detail_belajar', $data);
		$this->template->footer();
	}

	public function soal($nama_kursus,$nama_materi)
	{
		$nama_kursus2 = $this->functions->ubahKata($nama_kursus);
		$nama_materi2 = $this->functions->ubahKata($nama_materi);
		$user = $this->session->id_pelajar;
		$query1 = $this->db->query("SELECT *,COUNT(tb_materi.id_materi) AS jumlah_materi FROM tb_kursus INNER JOIN tb_detail_kursus ON tb_detail_kursus.id_kursus = tb_kursus.id_kursus INNER JOIN tb_materi ON tb_materi.id_kursus = tb_kursus.id_kursus WHERE tb_kursus.nama_kursus='$nama_kursus2' AND tb_materi.nama_materi='$nama_materi2' AND tb_detail_kursus.id_pelajar='$user'");
		$query = $query1->row();
		$id_kursus = $query->id_kursus;
		$id_materi = $query->id_materi;
		$query_soal = $this->db->query("SELECT * FROM tb_detail_soal INNER JOIN tb_soal ON tb_detail_soal.id_soal = tb_soal.id_soal INNER JOIN tb_materi ON tb_soal.id_materi = tb_materi.id_materi WHERE tb_soal.id_materi='$id_materi' ORDER BY RAND()");
		$jumlah_soal = $query_soal->num_rows();
		if($jumlah_soal <= 0){
			$query =$this->db->query("SELECT * FROM tb_detail_kursus WHERE id_pelajar='$user' AND id_kursus='$id_kursus'");
			$query = $query->row();
			$materi_terakhir = $query->materi_terakhir;
			$materi_terakhir++;
			$sql = "UPDATE tb_detail_kursus SET materi_terakhir='$materi_terakhir' WHERE id_kursus='$id_kursus' AND id_pelajar='$user'";
			$this->db->query($sql);
			redirect(base_url('kursus/'.$nama_kursus.'.html'),'refresh');
		}
		$data = [
			'data_kursus' => $query,
			'data_soal' => $query_soal,
			'nama_kursus' => $nama_kursus2,
			'nama_materi' => $nama_materi2,
			'jumlah_soal' => $jumlah_soal
		];
		$this->template->header($nama_materi2." - Soal",2);
		$this->load->view('belajar/soal', $data);
		$this->template->footer();
	}

	public function cek_soal($nama_kursus,$nama_materi)
	{
		$nama_kursus2 = $this->functions->ubahKata($nama_kursus);
		$nama_materi2 = $this->functions->ubahKata($nama_materi);
		$user = $this->session->id_pelajar;
		$query = $this->db->query("SELECT *,COUNT(tb_materi.id_materi) AS jumlah_materi FROM tb_kursus INNER JOIN tb_detail_kursus ON tb_detail_kursus.id_kursus = tb_kursus.id_kursus INNER JOIN tb_materi ON tb_materi.id_kursus = tb_kursus.id_kursus WHERE tb_kursus.nama_kursus='$nama_kursus2' AND tb_detail_kursus.id_pelajar='$user'");
		$query = $query->row();
		$id_kursus = $query->id_kursus;
		$id_materi = $query->id_materi;
		$query_soal = $this->db->query("SELECT * FROM tb_detail_soal INNER JOIN tb_soal ON tb_detail_soal.id_soal = tb_soal.id_soal INNER JOIN tb_materi ON tb_soal.id_materi = tb_materi.id_materi WHERE tb_soal.id_materi='$id_materi'");
		$jumlah_soal = $query_soal->num_rows();
		$query_datso = $query_soal->row();
		$id_soal = $query_datso->id_soal;
		$isian_pelajar = [];
		for ($i=1; $i <= $jumlah_soal; $i++) { 
			array_push($isian_pelajar,$this->input->post('soal'.$i));
		}
		$kunci_jawaban = [];
		foreach ($query_soal->result() as $row) {
			array_push($kunci_jawaban,$row->jawaban.'|'.$row->id_detail_soal);
		}
		$benar = sizeof(array_intersect($isian_pelajar,$kunci_jawaban));
		$salah = $jumlah_soal - $benar;
		$nilai = round(($benar / $jumlah_soal) * 100);
		$query = $this->db->query("SELECT * FROM tb_nilai");
		$id_nilai = $this->functions->makeID($query,'NIL',3);
		$data = [
			'id_nilai' => $id_nilai,
			'id_pelajar' => $user,
			'id_soal' => $id_soal,
			'benar' => $benar,
			'salah' => $salah,
			'nilai' => $nilai
		];
		$result = $this->db->insert('tb_nilai',$data);

		$query = $this->db->query("SELECT * FROM tb_detail_kursus WHERE id_pelajar='$user' AND id_kursus='$id_kursus'");
		$query = $query->row();
		$materi_terakhir = $query->materi_terakhir;
		$materi_terakhir++;
		$id_detail_kursus = $query->id_detail_kursus;
		$data_kursus = [
			'materi_terakhir' => $materi_terakhir
		];
		$this->db->where('id_detail_kursus',$id_detail_kursus);
		$result = $this->db->update('tb_detail_kursus',$data_kursus);
		if ($result) {
			$this->functions->pindah_halaman('kursus/nilai/'.$id_nilai.'.html?s=belajar');
		}
		else {
			$this->functions->pindah_halaman('kursus.html');
		}
	}

	public function tampil_nilai($id_nilai)
	{
		$user = $this->session->id_pelajar;
		$query = $this->db->query("SELECT * FROM tb_nilai INNER JOIN tb_soal ON tb_nilai.id_soal = tb_soal.id_soal INNER JOIN tb_materi ON tb_soal.id_materi = tb_materi.id_materi INNER JOIN tb_kursus ON tb_materi.id_kursus = tb_kursus.id_kursus WHERE id_nilai='$id_nilai'");
		$query = $query->row();
		$data = [
			'data_nilai' => $query,
		];
		$this->template->header('Hasil Nilai',2);
		$this->load->view('belajar/nilai', $data);
		$this->template->footer();
	}
	
	public function ulang_materi($id_materi,$id_soal)
	{
		$user = $this->session->id_pelajar;
		$sql = "SELECT * FROM tb_detail_kursus INNER JOIN tb_kursus ON tb_detail_kursus.id_kursus = tb_kursus.id_kursus INNER JOIN tb_materi ON tb_kursus.id_kursus = tb_materi.id_kursus INNER JOIN tb_soal ON tb_soal.id_materi = tb_materi.id_materi WHERE tb_detail_kursus.id_pelajar='$user' AND tb_soal.id_soal='$id_soal'";
		$query = $this->db->query($sql);
		$query = $query->row();
		$id_detail_kursus = $query->id_detail_kursus;
		$materi_terakhir = $query->materi_terakhir;
		$materi_terakhir--;

		$data = [
			'materi_terakhir' => $materi_terakhir
		];

		$this->db->where('id_detail_kursus',$id_detail_kursus);
		$this->db->update('tb_detail_kursus',$data);

		$data_kursus = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_materi ON tb_kursus.id_kursus = tb_materi.id_kursus WHERE tb_materi.id_materi='$id_materi'");
		$data_kursus = $data_kursus->row();
		$nama_materi = $data_kursus->nama_materi;
		$nama_kursus = $data_kursus->nama_kursus;
		$query = $this->db->query("DELETE FROM tb_nilai WHERE id_pelajar='$user' AND id_soal='$id_soal'");

		if($query)
		{
			redirect(base_url('kursus/'.$this->functions->ubahURL($nama_kursus).'/'.$this->functions->ubahURL($nama_materi)),'refresh');
		}
		else 
		{
			echo "Gagal Mengulang";
			exit();
		}
	}

	public function sertifikat($id_kursus)
	{
		$id_pelajar = $this->session->id_pelajar;
		if(empty($id_pelajar)){
			echo "Login terlebih dahulu";
			exit();
		}
		$sql = "SELECT tb_pelajar.nama_depan,tb_pelajar.nama_belakang,tb_kursus.nama_kursus FROM tb_detail_kursus INNER JOIN tb_kursus ON tb_detail_kursus.id_kursus = tb_kursus.id_kursus INNER JOIN tb_pelajar ON tb_detail_kursus.id_pelajar = tb_pelajar.id_pelajar WHERE tb_kursus.id_kursus='$id_kursus' AND tb_detail_kursus.id_pelajar='$id_pelajar'";
		$query = $this->db->query($sql);
		if($query->num_rows() <= 0){
			show_404();
			exit();
		}
		$query = $query->row();
		$nama_pelajar = $query->nama_depan." ".$query->nama_belakang;
		$nama_kursus = $query->nama_kursus;

		// Nilai
		$sql = "SELECT tb_nilai.nilai FROM tb_nilai INNER JOIN tb_soal ON tb_nilai.id_soal = tb_soal.id_soal INNER JOIN tb_materi ON tb_soal.id_materi = tb_materi.id_materi INNER JOIN tb_kursus ON tb_materi.id_kursus = tb_kursus.id_kursus WHERE tb_kursus.id_kursus='$id_kursus' AND tb_nilai.id_pelajar = '$id_pelajar'";
		$query = $this->db->query($sql);
		$jumlah_nilai = 0;
		$nilai = 0;
		foreach ($query->result() as $row) {
			$jumlah_nilai++;
			$nilai += $row->nilai;
		}
		if($jumlah_nilai==0){
			$jumlah_nilai = 1;
			$nilai = 100;
		}
		$nilai /= $jumlah_nilai;
		if ($nilai >= 80 && $nilai <= 100) {
			$grade = "A";
		}
		elseif($nilai >= 70){
			$grade = "B";
		}
		elseif ($nilai >= 60) {
			$grade = "C";
		}
		elseif ($nilai >= 40) {
			$grade = "D";
		}
		elseif ($nilai >= 10) {
			$grade = "E";
		}
		elseif ($nilai >= 0) {
			$grade = "F";
		}
		else {
			echo "Nilai Tidak Valid";
			exit();
		}
		$data = [
			'nama_pelajar' => $nama_pelajar,
			'nama_kursus' => $nama_kursus,
			'nilai' => $nilai,
			'grade' => $grade
		];
		$this->load->view('settings/bootstrap', $data);
		$this->load->view('belajar/sertifikat', $data);
	}
}
