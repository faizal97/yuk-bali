<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function index()
    {
        echo "<h1>API WEBSITE YUK BALI</h1>";
    }

    public function pelajar()
    {
        $api = $this->db->query("SELECT * FROM tb_pelajar");
        $json = "{";
        foreach ($api->result() as $row) {
            $json .= "[
                'username' : $row->username,
                'nama' : $row->nama_depan
            ],";
        }
        $json .= "}";
        $json= json_encode($json);
        echo $json;
    }
}

/* End of file Api.php */
