<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_pelajar extends CI_Controller {


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
		$query_pelajar = "tb_pelajar";
		$query = $this->db->query("SELECT * FROM ".$query_pelajar." LIMIT ".$page.",".$per_halaman);
		$data = array();
		$tampil = array(
			'tampil' => $query,
			'aktif' => $p,
			'nomor' => $page,
			'query_pelajar' => $query_pelajar,
			'link' => 'admin/data_pelajar.html'
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/data_pelajar', $tampil);
	}
	public function edit_pelajar($id)
	{
		//Mengambil id pelajar
		$id_pelajar = $id;
		//Query Data pelajar yang ingin di edit
		$query = $this->db->query("SELECT * FROM tb_pelajar WHERE id_pelajar='$id'");
		// Mendapatkan Data nya
		$query = $query->row();

		$data = array();
		//Mengirim data nya ke view edit_pelajar
		$data_pelajar = array(
			'data_pelajar' => $query
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/edit_pelajar',$data_pelajar);
	}
	public function proses_edit_pelajar($id)
	{
		// Mengambil ID pelajar Yang Ingin Diubah
		$id_pelajar = $id;

		// Mengambil Data2 dari halaman edit pelajar 
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');
		$email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$upload = $this->input->post('foto_profil');

		// Mengambil Data pelajar
		$query = $this->db->query("SELECT * FROM tb_pelajar WHERE id_pelajar='$id_pelajar'");
		$row = $query->row();
		if (!empty($_FILES['foto_profil']['name'])) {
			$this->functions->upload_gambar('foto_profil','img/user',$id_pelajar);
			$foto_profil = 'img/user/'.$this->upload->data('file_name');
		}
		else {
			$foto_profil = $row->foto_profil;
		}
		

	
		// Mempersiapkan Data Update
		$data = array(
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
			'email' => $email,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
			'tgl_lahir' => $tgl_lahir,
			'foto_profil' => $foto_profil

		);

		$this->db->where('id_pelajar',$id_pelajar);
		$result = $this->db->update('tb_pelajar',$data);

		if($result){
			echo "<script>alert('Data Berhasil Diubah')</script>";
			redirect(base_url('admin/data_pelajar.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Diubah')</script>";
			redirect(base_url('admin/data_pelajar/edit_pelajar/'.$id_pelajar.".html"),'refresh');
		}

	}

	public function hapus_pelajar($id)
	{
		$id_pelajar = $id;
		$query = $this->db->query("DELETE FROM tb_pelajar WHERE id_pelajar='$id_pelajar'");
		if($query){
			echo "<script>alert('Data Berhasil Dihapus')</script>";
			redirect(base_url('admin/data_pelajar.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Berhasil Dihapus')</script>";
			redirect(base_url('admin/data_pelajar.html'),'refresh');
		}
	}


	public function hapus_semua()
	{
		$query = $this->db->query("DELETE FROM tb_pelajar");
		if ($query) {
			echo "<script>alert('Data Berhasil Dihapus')</script>";
			redirect(base_url('admin/data_pelajar.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Dihapus')</script>";
			redirect(base_url('admin/data_pelajar.html'),'refresh');
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
        $query_pelajar = "tb_pelajar WHERE nama_depan LIKE '%$search%' OR nama_belakang LIKE '%$search%'  OR jenis_kelamin LIKE '%$search%'  OR tgl_lahir LIKE '%$search%' OR email LIKE '%$search%' OR alamat LIKE '%$search%'";
		$query = $this->db->query("SELECT * FROM ".$query_pelajar." LIMIT ".$page.",".$per_halaman);
		$data = array();
		$tampil = array(
			'tampil' => $query,
			'aktif' => $p,
			'nomor' => $page,
			'query_pelajar' => $query_pelajar,
			'link' => 'admin/data_pelajar/search.html?q='.$search
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/data_pelajar', $tampil);
    }

}
