<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class beranda extends CI_Controller {

    public function index()
    {
			$data_pelajar = $this->db->query("SELECT * FROM tb_pelajar");
			$jumlah_pelajar = $data_pelajar->num_rows();

			$data_pengajar = $this->db->query("SELECT * FROM tb_pengajar");
			$jumlah_pengajar = $data_pengajar->num_rows();

			$data_kursus = $this->db->query("SELECT * FROM tb_kursus");
			$jumlah_kursus = $data_kursus->num_rows();
    	$data = array(
			'jumlah_pelajar' => $jumlah_pelajar,
			'jumlah_pengajar' => $jumlah_pengajar,
			'jumlah_kursus' => $jumlah_kursus,
		);
    	$this->load->view('settings/bootstrap',$data);
    	$this->load->view('admin/menu.php');
        $this->load->view('admin/beranda.php');
    }
}

/* End of file Admin.php */
