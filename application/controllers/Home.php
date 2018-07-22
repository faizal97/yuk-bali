<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('template');
		$this->load->model('pelajar');
		
		

		$this->pelajar->getSession('login');
	}

	public function index()
	{
		$course = $this->db->query("SELECT * FROM tb_kursus INNER JOIN tb_pengajar ON tb_pengajar.id_pengajar=tb_kursus.id_pengajar INNER JOIN tb_pelajar ON tb_pelajar.id_pelajar = tb_pengajar.id_pelajar ORDER BY RAND() LIMIT 0,5");
		$data = array(
			'course' => $course
		);
		$this->template->header('Yuk Bali - Home',1);
		$this->load->view('home',$data);
		
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
