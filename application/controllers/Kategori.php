<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function kategori_visitor($id_kategori)
	{
		$query = $this->db->query("SELECT nama_kategori FROM tb_kategori WHERE id_kategori='$id_kategori'");
		$row = $query->row();
		$data['nama_kategori'] = $row->nama_kategori;
		$data['data_kursus'] = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar WHERE tb_kursus.id_kategori='$id_kategori'");
		
		$this->load->view('settings/bootstrap', $data);
		$this->load->view('tampil_kategori_visitor', $data);
		$this->template->footer();
		
	}

	public function kategori_user($id_kategori)
	{
		$query = $this->db->query("SELECT nama_kategori FROM tb_kategori WHERE id_kategori='$id_kategori'");
		$row = $query->row();
		$data['nama_kategori'] = $row->nama_kategori;
		$data['data_kursus'] = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar WHERE tb_kursus.id_kategori='$id_kategori'");

		$this->template->header($row->nama_kategori,2);
		$this->load->view('tampil_kategori_user', $data);
		$this->template->footer();
		
	}

}

/* End of file Kategori.php */
