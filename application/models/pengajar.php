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
       $data = array(
           'id_pengajar' => $this->session->id_pelajar,
           'id_pelajar' => $this->session->id_pelajar
       );  
       $this->db->insert('tb_pengajar',$data);
       redirect(base_url('kursusku.html'),'refresh');
   }

}

/* End of file Pengajar.php */
