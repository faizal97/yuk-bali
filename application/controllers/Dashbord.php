<?php
defined('BASEPATH') OR exit('Do Direct script access');

class Dashbord extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->library('session');
			$this->load->model('pengajar');
			$this->load->model('pelajar');
			$this->load->model('functions');

			$this->pelajar->getSession('visitor');
	}
	public function index()
	{
		$this->load->library('session');
		$user = $this->session->id_pelajar;
		if(isset($this->session->id_pelajar)){
			$query = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori ORDER BY RAND() LIMIT 4 ");
			$query2 = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori ORDER BY tb_kursus.tgl_buat DESC LIMIT 4 ");
			$data = array(
				'data_kursus' => $query,
				'data_kursus_baru' => $query2,
				'nama_depan' => ucwords($this->session->userdata['nama_depan']),
				'nama_belakang' => $this->session->userdata['nama_belakang'],
				'title' => "Yuk Bali - Home"
			);
			$this->load->view('header');
			$this->load->view('settings/bootstrap',$data);
			$this->load->view('menu_dashbord');
			$this->load->view('dashbord',$data);
			$this->load->view('footer');	
		}
		else {
		echo "<script>alert('Harap Login Terlebih Dahulu');</script>";
		redirect("masuk","refresh");
		}
	}

	public function profile($id='')
	{
		$id_pelajar = $this->session->id_pelajar;
		if(empty($id)){			
			$query = $this->db->query("SELECT * FROM tb_pelajar WHERE id_pelajar='$id_pelajar'");
		}
		else{
			$query = $this->db->query("SELECT * FROM tb_pelajar WHERE id_pelajar='$id'");
		}
		$row = $query->row();
		if($query->num_rows()<=0){
			show_error("User Tidak Ditemukan.<br>Hubungi Admin Untuk Meminta Bantuan.<br><a href=".base_url()."dashbord>Kembali</a>",404,"[ERROR] User Tidak Ditemukan");
		}
		$data = array(
			'title' => $row->nama_depan." ".$row->nama_belakang,
			'data_profil' => $row
		);
		$this->template->header('Profil',2);
		$this->load->view('profile',$data);
		$this->load->view('footer');
	}

	public function ubah_profil()
	{
		$id_pelajar = $this->session->id_pelajar;
		$query = $this->db->query("SELECT * FROM tb_pelajar WHERE id_pelajar='$id_pelajar'");
		$query = $query->row();
		$data = [
			'data_pelajar' => $query
		];
		$this->template->header('Ubah Profil',2);
		$this->load->view('ubah_profil',$data);
		$this->load->view('footer');
	}

	public function proses_ubah_profil()
	{
		$id_pelajar = $this->session->id_pelajar;
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
		$this->session->gambar_profil = $foto_profil;

		$this->db->where('id_pelajar',$id_pelajar);
		$result = $this->db->update('tb_pelajar',$data);

		if($result){
			echo "<script>alert('Data Berhasil Diubah')</script>";
			redirect(base_url('profil.html'),'refresh');
		}
		else {
			echo "<script>alert('Data Gagal Diubah')</script>";
			redirect(base_url('ubah_profil.html'),'refresh');
		}

	}

	public function menjadi_pengajar()
	{
		$this->pengajar->become_instructor();
	}

	public function eksplor()
	{
		$id_pelajar = $this->session->id_pelajar;
		$list_kursus = $this->db->query("SELECT * FROM tb_detail_kursus INNER JOIN tb_kursus ON tb_detail_kursus.id_kursus = tb_kursus.id_kursus WHERE tb_detail_kursus.id_pelajar='$id_pelajar' ORDER BY RAND()");
		foreach ($list_kursus->result() as $row) {
			$list_kategori[$row->id_kategori] = $row->id_kategori;
		}
		if (empty($list_kategori)) {
			$sql = "SELECT * FROM tb_kursus INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar ORDER BY RAND() LIMIT 0,4";
		}
		else {
			$id_rek1 = key($list_kategori);
			$sql = "SELECT * FROM tb_kursus INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar WHERE tb_kursus.id_kategori='$id_rek1' ORDER BY RAND() LIMIT 0,4";
		}
		$rekomendasi1 = $this->db->query($sql);

		$query = $this->db->query("SELECT id_kursus,COUNT(id_pelajar) AS jumlah_pelajar FROM tb_detail_kursus GROUP BY id_kursus ORDER BY jumlah_pelajar DESC LIMIT 0,4");
		foreach ($query->result() as $row) {
			$list_populer[$row->id_kursus] = $row->id_kursus;
		}
		$sql2 = "SELECT * FROM tb_kursus INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar WHERE tb_kursus.id_kursus IN (";
		$sentence = "";
		foreach ($list_populer as $data) {
			$sentence .= "'".$data."',";
		}
		$sql_in = substr($sentence,0,strlen($sentence)-1);
		$sql2.=$sql_in.")";
		$rekomendasi2 = $this->db->query($sql2);

		$data = [
			'data_kursus' => $rekomendasi1,
			'judul_rek1' => 'Rekomendasi Untuk Anda',
			'data_kursus_baru' =>$rekomendasi2,
			'judul_rek2' => 'Kursus Terpopuler'
		];

		$this->template->header("Eksplor",2);
		$this->load->view('eksplor', $data);
		$this->template->footer();
	}

}
