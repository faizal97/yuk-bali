<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Model {

    public function header($title='',$menu=1)
    {
        $this->load->view('settings/bootstrap',array('title' => $title));
        if ($menu==1) {
            $this->load->view('menu');
        } elseif ($menu==2) {
            $this->load->view('menu_dashbord');
        }
    }

    public function footer()
    {
        $this->load->view('footer');
    }
}

/* End of file Template.php */
