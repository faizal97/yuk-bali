<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index()
    {
    	$data = array();
    	$this->load->view('settings/bootstrap',$data);
    	$this->load->view('admin/menu.php');
        $this->load->view('admin/home.php');
    }
}

/* End of file Admin.php */
