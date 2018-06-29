<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class data_admin extends CI_Controller {


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
		$query_admin = "tb_admin";
		$query = $this->db->query("SELECT * FROM ".$query_admin." LIMIT ".$page.",".$per_halaman);
		$data = array();
		$tampil = array(
			'tampil' => $query,
			'aktif' => $p,
			'nomor' => $page,
			'query_admin' => $query_admin,
			'link' => 'admin/data_admin.html'
		);
    	$this->load->view('settings/bootstrap',$data);
    	$this->load->view('admin/menu.php');
        $this->load->view('admin/data_admin.php', $tampil);
    }


    public function tambah_admin()
	{
		$query = $this->db->query('SELECT * FROM tb_admin ORDER BY nm_depan');

		$data = array();
		$data_admin = array(
			'data_admin' => $query
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/tambah_admin',$data_admin);
	}

	public function proses_tambah_admin()
	{
		$this->load->library('session');

		$nm_depan = $this->input->post('nm_depan');
		$nm_belakang = $this->input->post('nm_belakang');
		$username_admin = $this->input->post('username_admin');
		$password_admin = $this->input->post('password_admin');

		$salt = bin2hex(openssl_random_pseudo_bytes(16,$cstrong));
		
		// Menggambungkan salt dengan password yang user input
		// Contoh : 9116f78c2ad59bba1f32a517e6102dee + anisa123
		// Menjadi : 9116f78c2ad59bba1f32a517e6102deeanisa123
		$salt_admin = $salt.$password_admin;

		// Merubah Password yang sudah digabung dengan salt menjadi hash md5
		// Contoh dari 9116f78c2ad59bba1f32a517e6102deeanisa123 -> 0963d6d3ff2b87b2a5a35f4239d32a85
		$password_hashed = hash('sha512',$salt_admin);

		$query = $this->db->query('SELECT * FROM tb_admin');
		$total_data = $query->num_rows();
		// Membuat ID User Otomatis
		$no = $this->buatnol(1,2);
		foreach ($query->result() as $row) { //$query->result sama seperti mysqli_fetch_Array
			if (substr($row->id_admin,-2) == $no) { // $row->id_pelajar sama seperti $row['id_pelajar']
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
		
		$id_admin = "ADM".$this->buatnol($num,2);		

		$data = array(
			'id_admin' => $id_admin,
			'nm_depan' => $nm_depan,
			'nm_belakang' => $nm_belakang,
			'username_admin' => $username_admin,
			'password_admin' => $password_hashed,
			'salt_admin' => $salt
		);
		$result = $this->db->insert('tb_admin',$data);
		if($result){
			// echo "Berhasil";
			redirect(base_url('admin/data_admin.html'),'refresh');
		}
		else {
			// echo "Gagal";
			redirect(base_url('admin/data_admin/tambah_admin.html'),'refresh');
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

		public function edit_admin($id)
	{
		//Mengambil id admin
		$id_admin = $id;
		//Query Data Admin yang ingin di edit
		$query = $this->db->query("SELECT * FROM tb_admin WHERE id_admin='$id'");
		// Mendapatkan Data nya
		$query = $query->row();

		$data = array();
		//Mengirim data nya ke view edit_admin
		$data_admin = array(
			'data_admin' => $query
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/edit_admin',$data_admin);
	}
	public function proses_edit_admin($id)
	{
		// Mengambil ID Admin Yang Ingin Diubah
		$id_admin = $id;

		// Mengambil Data2 dari halaman edit admin
		$nm_depan = $this->input->post('nm_depan');
		$nm_belakang = $this->input->post('nm_belakang');
		$username_admin = $this->input->post('username_admin');
		$pass_lama = $this->input->post('pass_lama'); // Password Lama Admin Sebelum Di Ubah
		$pass_baru = $this->input->post('pass_baru'); // Password Baru Admin
		
		// Mengambil Data Admin
		$query = $this->db->query("SELECT * FROM tb_admin WHERE id_admin='$id_admin'");
		$row = $query->row();

		if(!empty($pass_lama) && !empty($pass_baru)){
		// Mencocokan Passowrd yang di input di halaman edit 
		$pass_lama = $row->salt_admin.$pass_lama;
		$pass_lama = hash('sha512',$pass_lama);

			// Jika Pass Lama Sama Dengan Pass Database
			if ($pass_lama == $row->password_admin) {
				$pass = hash('sha512',$row->salt_admin.$pass_baru);
				}
			else {
				// Jika Beda Kembali Ke Halaman Edit
				redirect(base_url('admin/data_admin/ubah_admin/'.$id_admin.".html"),'refresh');
				}
		}else {
			$pass=$row->password_admin;
		}

		// Mempersiapkan Data Update
		$data = array(
			'id_admin' => $id_admin,
			'nm_depan' => $nm_depan,
			'nm_belakang' => $nm_belakang,
			'username_admin' => $username_admin,
			'password_admin' => $pass
		);

		$this->db->where('id_admin',$id_admin);
		$result = $this->db->update('tb_admin',$data);

		if($result){
			echo "<script>alert('Data Berhasil Dirubah')</script>";
			redirect(base_url('admin/data_admin.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Dirubah')</script>";
			redirect(base_url('admin/data_admin/ubah_admin/'.$id_admin.".html"),'refresh');
		}

	}

	public function hapus_admin($id)
	{
		$id_admin = $id;
		$query = $this->db->query("DELETE FROM tb_admin WHERE id_admin='$id_admin'");
		if($query){
			echo "<script>alert('Data Sudah Dihapus')</script>";
			redirect(base_url('admin/data_admin.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Dihapus)</script>";
			redirect(base_url('admin/data_admin.html'),'refresh');
		}
	}

	public function hapus_semua()
	{
		$query = $this->db->query("DELETE FROM tb_admin");
		if($query){
			echo "<script>alert('Data Sudah Dihapus')</script>";
			redirect(base_url('admin/data_admin.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Dihapus)</script>";
			redirect(base_url('admin/data_admin.html'),'refresh');
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
       	$query_admin = "tb_admin WHERE nm_depan LIKE '%$search%' OR nm_belakang OR LIKE '%$search%' username_admin LIKE '%$search%'";
        $query = $this->db->query("SELECT * FROM ".$query_admin." LIMIT ".$page.",".$per_halaman);
		$data = array();
		$data = array();
		$tampil = array(
			'tampil' => $query,
			'aktif' => $p,
			'nomor' => $page,
			'query_admin' => $query_admin,
			'link' => 'admin/data_admin/cari_data.html?q='.$search
		);
		$this->load->view('settings/bootstrap',$data);
		$this->load->view('admin/menu');
		$this->load->view('admin/data_admin', $tampil);
    }
}
