<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class laporan extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->load->library('Pdf');
	}

	public function kursus()
	{
		$query = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_kategori ON tb_kursus.id_kategori = tb_kategori.id_kategori ORDER BY nama_kursus ASC");
		$data = [
			'data_kursus' => $query
		];
		$this->load->view('admin/laporan_kursus', $data);
	}

}

/* End of file laporan.php */
