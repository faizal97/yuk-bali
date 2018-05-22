<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class functions extends CI_Model {

    public function buatnol($num,$banyak_nol)
	{
        $sisa = $banyak_nol - strlen($num);
        if ($sisa<0) {
            $result = "Nomor Lebih Besar Dari Jumlah Nol!";
        }
        else {
            $nol=null;
            for ($i=1; $i <= $sisa ; $i++) { 
                $nol .= "0";
            }
            $result = $nol.$num;
        }
        return $result;
    }
    
    public function cekSamaData($tabel,$data_field,$data)
    {
        $query = $this->db->query("SELECT * FROM $tabel WHERE $data_field='$data'");
        if ($query->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

}

/* End of file functions.php */
