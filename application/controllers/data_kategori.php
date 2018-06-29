<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_kategori extends CI_Controller {


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
		$query_kategori = "tb_kategori";
		$query = $this->db->query("SELECT * FROM ".$query_kategori." LIMIT ".$page.",".$per_halaman);
		$data = array();
		$tampil = array(
			'tampil' => $query,
			'aktif' => $p,
			'nomor' => $page,
			'query_kategori' => $query_kategori,
			'link' => 'admin/data_Kategori.html'
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/data_kategori', $tampil);
	}

		public function tambah_kategori()
	{
		$query = $this->db->query('SELECT * FROM tb_kategori ORDER BY nama_kategori');

		$data = array();
		$data_kategori = array(
			'data_kategori' => $query
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/tambah_kategori',$data_kategori);
	}

		public function proses_tambah_kategori()
	{
		$this->load->library('session');
		
		//Mengambil Data kategori

		$nama_kategori = $this->input->post('nama_kategori');
	
		$query = $this->db->query('SELECT * FROM tb_kategori');
		$total_data = $query->num_rows();
// Membuat ID Kategori Otomatis
		$no = $this->buatnol(1,3);
		foreach ($query->result() as $row) { //$query->result sama seperti mysqli_fetch_Array
			if (substr($row->id_kategori,-3) == $no) { // $row->id_pelajar sama seperti $row['id_pelajar']
				if ($no == $query->num_rows()) {
					$no++;
					$num = $no;
					continue;
				}
				$no++;
				continue;
			}
			else {
				$num = $no;
				break;
			}
		}
		if (!isset($num) || empty($num)) {
			$num=1;
		}
		
		$id_kategori = "KTG".$this->buatnol($num,3);		

		$data = array(
			'id_kategori' => $id_kategori,
			'nama_kategori' => $nama_kategori
		);
		$result = $this->db->insert('tb_kategori',$data);
		if($result){
			// echo "Berhasil";
			redirect(base_url('admin/data_kategori.html'),'refresh');
		}
		else {
			// echo "Gagal";
			redirect(base_url('admin/data_kategori/tambah_kategori.html'),'refresh');
		}

	}
		public function buatnol($angka,$totalnol=3){
		$selisih = $totalnol - strlen($angka);
		$nol ="";
		for ($i=1; $i<=$selisih ; $i++) { 
			$nol .= "0"; 
		}
		return $nol.$angka;
	}

	public function edit_kategori($id)
	{
		$id_kategori = $id;
		//Query Data kategori yang ingin di edit
		$query = $this->db->query("SELECT * FROM tb_kategori WHERE id_kategori='$id'");
		// Mendapatkan Data nya
		$query = $query->row();

		$data = array();
		//Mengirim data nya ke view edit_kategori
		$data_kategori = array(
			'data_kategori' => $query
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/edit_kategori',$data_kategori);
	}
	public function proses_edit_kategori($id)
	{
		// Mengambil ID Kategori Yang Ingin Diubah
		$id_kategori = $id;

		// Mengambil Data2 dari halaman edit Katagori
		$nama_kategori = $this->input->post('nama_kategori');
		
		
		// Mengambil Data Katagori
		$query = $this->db->query("SELECT * FROM tb_kategori WHERE id_kategori='$id_kategori'");
		$row = $query->row();

		// Mempersiapkan Data Update
		$data = array(
			
			'nama_kategori' => $nama_kategori
		);

		$this->db->where('id_kategori',$id_kategori);
		$result = $this->db->update('tb_kategori',$data);

		if($result){
			echo "<script>alert('Data Berhasil Dirubah')</script>";
			redirect(base_url('admin/data_kategori.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Dirubah')</script>";
			redirect(base_url('admin/data_kategori/ubah_kategori/'.$id_kategori.".html"),'refresh');
		}

	}

	public function hapus_kategori($id)
	{
		$id_kategori = $id;
		$query = $this->db->query("DELETE FROM tb_kategori WHERE id_kategori='$id_kategori'");
		if($query){
			echo "<script>alert('Data Berhasil Dihapus')</script>";
			redirect(base_url('admin/data_kategori.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Dihapus')</script>";
			redirect(base_url('admin/data_kategori.html'),'refresh');
		}
	}

	public function hapus_semua()
	{
		$query = $this->db->query("DELETE FROM tb_kategori");
		if ($query) {
			echo "<script>alert('Data Berhasil Dihapus')</script>";
			redirect(base_url('admin/data_kategori.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Dihapus')</script>";
			redirect(base_url('admin/data_kategori.html'),'refresh');
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
        $query_kategori = "tb_kategori WHERE nama_kategori LIKE '%$search%'";
     	$query = $this->db->query("SELECT * FROM ".$query_kategori." LIMIT ".$page.",".$per_halaman);
		$data = array();
		$data = array();
		$tampil = array(
			'tampil' => $query,
			'aktif' => $p,
			'nomor' => $page,
			'query_kategori' => $query_kategori,
			'link' => 'admin/data_kategori/cari_data.html?q='.$search
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/data_kategori', $tampil);
    }

		
}