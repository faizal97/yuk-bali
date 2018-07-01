<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_pengajar extends CI_Controller {


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

		$query = $this->db->query('SELECT * ,COUNT(tb_kursus.id_kursus) AS jumlah_kursus FROM tb_pengajar INNER JOIN tb_kursus ON tb_kursus.id_pengajar=tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pelajar.id_pelajar=tb_pengajar.id_pengajar LIMIT '.$page.','.$per_halaman.'');
		$data = array();
		$tampil = array(
			'tampil' => $query,
			'aktif' => $p,
			'nomor' => $page
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/data_pengajar', $tampil);
	}

		public function edit_pengajar($id)
	{
		//Mengambil id pengajar
		$id_pengajar = $id;
		//Query Data pengajar yang ingin di edit
		$query = $this->db->query("SELECT * FROM tb_pengajar WHERE id_pengajar='$id'");
		// Mendapatkan Data nya
		$query = $query->row();

		$data = array();
		//Mengirim data nya ke view edit_pengajar
		$data_pengajar = array(
			'data_pengajar' => $query
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/edit_pengajar',$data_pengajar);
	}
	public function proses_edit_pengajar($id)
	{
		// Mengambil ID pengajar Yang Ingin Diubah
		$id_pengajar = $id;

		// Mengambil Data2 dari halaman edit pengajar 
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');
		$jumlah_kursus = $this->input->post('jumlah_kursus');
        $upvote = $this->input->post('upvote');
        $downvote = $this ->post('downvote');
		$foto_profil = $this->input->post('foto_profil');

		// Mengambil Data pengajar
		$query = $this->db->query("SELECT * FROM tb_pengajar WHERE id_pengajar='$id_pengajar'");
		$row = $query->row();

	
		// Mempersiapkan Data Update
		$data = array(
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
			'jumlah_kursus' => $jumlah_kursus,
            'upvote' => $upvote,
            'downvote' => $downvote,
			'foto_profil' => $foto_profil

		);

		$this->db->where('id_pengajar',$id_pengajar);
		$result = $this->db->update('tb_pengajar',$data);

		if($result){
			echo "<script>alert('Data Berhasil Diubah')</script>";
			redirect(base_url('admin/data_pengajar.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Diubah')</script>";
			redirect(base_url('admin/data_pengajar/edit_pengajar/'.$id_pengajar.".html"),'refresh');
		}

	}

	public function hapus_pengajar($id)
	{
		$id_pengajar = $id;
		$query = $this->db->query("DELETE FROM tb_pengajar WHERE id_pengajar='$id_pengajar'");
		if($query){
			echo "<script>alert('Data Berhasil Dihapus')</script>";
			redirect(base_url('admin/data_pengajar.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Berhasil Dihapus')</script>";
			redirect(base_url('admin/data_pengajar.html'),'refresh');
		}
	}


	public function hapus_semua()
	{
		$query = $this->db->query("DELETE FROM tb_pengajar");
		if ($query) {
			echo "<script>alert('Data Berhasil Dihapus')</script>";
			redirect(base_url('admin/data_pengajar.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Dihapus')</script>";
			redirect(base_url('admin/data_pengajar.html'),'refresh');
		}
	}

		 public function cari_data()
    {
        $per_halaman = 5;
		$p = $this->input->get('p');
		if(empty($p)){
			$p = 1;
			$page=0;
		}else{
			$page = ($p - 1) * $per_halaman;
		}

        $search = $this->input->get('q');
        $query_pengajar = "tb_pengajar WHERE nama_depan LIKE '%$search%' OR nama_belakang LIKE '%$search%'  OR jenis_kelamin LIKE '%$search%'  OR tgl_lahir LIKE '%$search%' OR email LIKE '%$search%' OR alamat LIKE '%$search%'";
		$query = $this->db->query("SELECT * FROM ".$query_pengajar." LIMIT ".$page.",".$per_halaman);
		$data = array();
		$tampil = array(
			'tampil' => $query,
			'aktif' => $p,
			'nomor' => $page,
			'query_pengajar' => $query_pengajar,
			'link' => 'admin/data_pengajar/search.html?q='.$search
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/data_pelajar', $tampil);
    }

}
