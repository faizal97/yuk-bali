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

    public function random_badge()
    {
        return ["badge-primary","badge-secondary","badge-success"," badge-danger"," badge-warning","badge-info","badge-dark"];
    }

    public function getRandom_Badge($badge)
    {
        return $badge[rand(0,sizeof($badge)-1)];
	}
	
	public function pindah_halaman($link,$pesan='')
	{
		if (!empty($pesan)) {
			echo "<script>alert('".$pesan."');</script>";
		}
		redirect(base_url($link),'refresh');
	}

}

/* End of file functions.php */
