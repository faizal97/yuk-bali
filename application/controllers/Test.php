<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index()
    {
		$data = [
			'title' => 'Eksperimen'
		];
		$this->load->view('settings/bootstrap',$data);
		
        $this->load->view('test/dl');
        
	}

}

/* End of file Test.php */
