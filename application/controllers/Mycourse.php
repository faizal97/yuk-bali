<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mycourse extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('pelajar');
        $this->load->model('functions');
        
        $this->pelajar->getSession('visitor');
        
        
    }
    public function index()
    {
        $this->load->library('session');	
        $id_pengajar = $this->session->id_pengajar;
        $kategori = $this->db->query("SELECT * FROM tb_kategori ORDER BY nama_kategori");
		$query = $this->db->query("SELECT tb_kursus.*,tb_kategori.* FROM tb_kursus INNER JOIN tb_kategori ON tb_kategori.id_kategori=tb_kursus.id_kategori WHERE id_pengajar='$id_pengajar'");
        
        $data = array(
			'query' => $query,
            'title' => ucwords($this->session->nama_depan)."'s Course",
            'badge' => $this->functions->random_badge(),
            'kategori' => $kategori
		);
		$this->load->view('settings/bootstrap', $data);
		$this->load->view('header');
		$this->load->view('menu_dashbord');
		$this->load->view('mycourse',$data);
		$this->load->view('footer');
    }

    public function tampilan_tambah_kursus()
    {
        $kategori = $this->db->query("SELECT * FROM tb_kategori");
        $data = array(
            'title' => 'Tambah Kursus',
            'kategori' => $kategori
        );
        $this->load->view('settings/bootstrap', $data);
        $this->load->view('header');
        $this->load->view('menu_dashbord');
        $this->load->view('mycourse_add',$data);
        $this->load->view('footer');
    }

    public function proses_tambah_kursus()
    {
        	$nama_kursus = $this->input->post('nama_kursus');
			$kategori = $this->input->post('kategori');

			$query = $this->db->query("SELECT * FROM tb_kursus");
			$id = $this->functions->MakeID($query,"KRS",3);

			$config['upload_path'] = "img/course/";
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name'] = $id;
			$config['overwrite'] = true;
			$config['max_size'] = '2000';
			$config['max_width'] ='1024';
			$config['max_height'] = '768';

			$this->load->library('upload',$config);

			if(!$this->upload->do_upload('gambar')){
				echo "<script>alert('Hanya menerima format gambar seperti png,jpeg,jpg pada data gambar kursus');</script>";
				redirect(base_url().'kursusku.html?modal=tambah-kursus','refresh');
			}
			else{
				$gambar = "img/course/".$this->upload->data('file_name');
			}
			
			$data = array(
				'id_kursus' => $id,
				'nama_kursus' => $nama_kursus,
				'id_kategori' => $kategori,
				'id_pengajar' => $this->session->id_pengajar,
				'gambar_kursus' => $gambar
			);

			$result = $this->db->insert('tb_kursus',$data);

			if($result){
				echo "<script>alert('Kursus Berhasil Ditambahkan');</script>";
				redirect(base_url('kursusku.html'),'refresh');
			}
			else {
				echo "<script>alert('Kursus Gagal Ditambahkan');</script>";
				redirect(base_url('kursusku.html#tambah-kursus'),'refresh');
				
			}
        }
        
        public function tampil_data_kursus($judul)
        {
            $judul = str_replace("-"," ",$judul);
            $user = $this->session->id_pengajar;
            $query = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori WHERE tb_kursus.nama_kursus='$judul' AND tb_kursus.id_pengajar='$user'");
			$row = $query->row();
			$id_kursus = $row->id_kursus;
			$query = $this->db->query("SELECT COUNT(tb_detail_kursus.id_detail_kursus) AS jumlah_siswa FROM tb_detail_kursus WHERE id_kursus='$id_kursus'");
			$query = $query->row();
			$jumlah_siswa = $query->jumlah_siswa;
			$kategori = $this->db->query('SELECT * FROM tb_kategori ORDER BY nama_kategori');
			$laporan_pelajar = $this->db->query("SELECT * FROM tb_detail_kursus INNER JOIN tb_pelajar ON tb_detail_kursus.id_pelajar = tb_pelajar.id_pelajar WHERE tb_detail_kursus.id_kursus='$id_kursus' ORDER BY tb_pelajar.nama_depan LIMIT 0,5");
			$laporan_nilai = $this->db->query("SELECT * FROM tb_nilai INNER JOIN tb_soal ON tb_soal.id_soal = tb_nilai.id_soal INNER JOIN tb_pelajar ON tb_nilai.id_pelajar = tb_pelajar.id_pelajar INNER JOIN tb_materi ON tb_materi.id_materi = tb_soal.id_materi WHERE tb_materi.id_kursus='$id_kursus' ORDER BY tb_pelajar.nama_depan LIMIT 0,5");
			$data = array(
                'title' => $judul,
                'data' => $row,
				'kategori' => $kategori,
				'id_kursus' => $id_kursus,
				'jumlah_siswa' => $jumlah_siswa,
				'laporan_pelajar' => $laporan_pelajar,
				'laporan_nilai' => $laporan_nilai
            );
            $this->load->view('settings/bootstrap', $data);
            $this->load->view('header');
            $this->load->view('menu_dashbord');
            if(count($row)<=0){
                $this->load->view('errors/hak_akses');
            }
            else{
            $this->load->view('manage_course',$data);
            }
            $this->load->view('footer');
        }

        public function hapus_kursus($judul)
        {
            $user = $this->session->id_pengajar;
            $judul = str_replace("-"," ",$judul);
            $query = $this->db->query("SELECT * FROM tb_kursus WHERE nama_kursus='$judul' AND id_pengajar='$user'");
            $row = $query->row();
            $hapus = $this->db->query("DELETE FROM tb_kursus WHERE nama_kursus='$judul' AND id_pengajar='$user'");
			unlink($row->gambar_kursus);
			if ($hapus) {
				$this->functions->pindah_halaman('kursusku.html','Kursus Berhasil Dihapus.');
			}
			else 
			{
				$this->functions->pindah_halaman('kursusku.html','Kursus Gagal Dihapus.');
			}
		}
		
		public function hapus_semua()
		{
			$user = $this->session->id_pengajar;
			$query = $this->db->query("SELECT * FROM tb_kursus WHERE id_pengajar='$user'");
			$pics = [];
			foreach ($query->result() as $row) {
				array_push($pics,$row->gambar_kursus);
			}
			$hapus = $this->db->query("DELETE FROM tb_kursus WHERE id_pengajar='$user'");
			foreach ($pics as $value) {
				unlink($value);
			}
			if ($hapus) {
				$this->functions->pindah_halaman('kursusku.html','Semua Kursus Berhasil Dihapus.');
			}
			else 
			{
				$this->functions->pindah_halaman('kursusku.html','Semua Kursus Gagal Dihapus.');
			}
		}

		public function ubah_pengaturan($id_kursus)
		{
			$nama_kursus = $this->input->post('nama_kursus');
			$id_kategori = $this->input->post('id_kategori');
			$deskripsi_kursus = $this->input->post('deskripsi_kursus');
	
			$query = $this->db->query("SELECT * FROM tb_kursus WHERE id_kursus='$id_kursus'");
			$row = $query->row();
			if (!empty($_FILES['gambar_kursus']['name'])) {
				$this->functions->upload_gambar('gambar_kursus','img/course',$id_kursus);
				$gambar_kursus = 'img/course/'.$this->upload->data('file_name');
			}
			else {
				$gambar_kursus = $row->gambar_kursus;
			}
	
			$data = [
				'nama_kursus' => $nama_kursus,
				'deskripsi_kursus' => $deskripsi_kursus,
				'id_kategori' => $id_kategori,
				'gambar_kursus' => $gambar_kursus	
			];
	
			$this->db->where('id_kursus',$id_kursus);
			$result = $this->db->update('tb_kursus',$data);
	
			if($result){
				echo "<script>alert('Data Berhasil Diubah')</script>";
				redirect(base_url('kursusku/kelola/'.$this->functions->ubahURL($nama_kursus).'.html?tab=pengaturan'),'refresh');
			}
			else {
				echo "<script>alert('Data Gagal Diubah')</script>";
				redirect(base_url('kursusku/kelola/'.$this->functions->ubahURL($nama_kursus).'.html?tab=pengaturan'),'refresh');
			}
		}
    }

/* End of file Mycourse.php */
