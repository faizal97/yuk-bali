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
				echo "<script>alert('".$this->upload->display_errors()."');</script>";
				redirect(base_url().'tambah_kursus.html','refresh');
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
            $kategori = $this->db->query('SELECT * FROM tb_kategori');
            $data = array(
                'title' => $judul,
                'data' => $row,
				'kategori' => $kategori,
				'id_kursus' => $row->id_kursus
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
            $user = $this->session->id_pelajar;
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
			$user = $this->session->id_pelajar;
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
    }

/* End of file Mycourse.php */
