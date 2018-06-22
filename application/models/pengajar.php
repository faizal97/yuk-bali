<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajar extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        
    }

   public function become_instructor()
   {
	   $query = $this->db->query("SELECT * FROM tb_pengajar");
	   $id_pengajar = $this->functions->makeID($query,'PGJ',3);
       $data = array(
           'id_pengajar' => $id_pengajar,
           'id_pelajar' => $this->session->id_pelajar
	   );
	   $this->session->id_pengajar = $id_pengajar;
	   $this->session->instructor = TRUE;
       $this->db->insert('tb_pengajar',$data);
       redirect(base_url('kursusku.html'),'refresh');
   }

}

/* End of file Pengajar.php */
