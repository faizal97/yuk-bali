<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class errorbelajar extends CI_Controller {

    public function index()
    {
        
        {
            $data = array(
                'title' => "Halaman Tidak Ditemukan");
        
            $this->load->view('settings/bootstrap',$data);
            $this->load->view('error');
        }
     
    }

}

/* End of file Controllername.php */



