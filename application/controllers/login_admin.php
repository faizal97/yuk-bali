<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class login_admin extends CI_Controller {

    public function index()
    {
    	$data = array();
    	$this->load->view('settings/bootstrap',$data);
        $this->load->view('admin/login.php');
    }
}
