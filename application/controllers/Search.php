<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function search_visitor()
	{
		$search = $this->input->get('q');

		$data['nama_kategori'] = $search;
		$data['data_kursus'] = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori WHERE tb_kursus.nama_kursus LIKE '%$search%' OR tb_kategori.nama_kategori LIKE '%$search%' OR tb_kursus.deskripsi_kursus LIKE '%$search%'");
	
		$this->load->view('settings/bootstrap', $data);
		$this->load->view('tampil_search_visitor', $data);
		$this->template->footer();
	}

	public function search_user()
	{
		$search = $this->input->get('q');

		$data['nama_kategori'] = $search;
		$data['data_kursus'] = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_pengajar ON tb_kursus.id_pengajar = tb_pengajar.id_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori WHERE tb_kursus.nama_kursus LIKE '%$search%' OR tb_kategori.nama_kategori LIKE '%$search%' OR tb_kursus.deskripsi_kursus LIKE '%$search%'");
	
		$this->template->header($search,2);
		$this->load->view('tampil_search_user', $data);
		$this->template->footer();
	}

}

/* End of file Search.php */
