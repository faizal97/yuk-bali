<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class functions extends CI_Model {

	public function makeID($query,$depan,$banyak_nol=5)
	{
		$no = 1;
		$query_field = $query->field_data();
		$primary = $query_field[0]->name;
		foreach ($query->result() as $value) {
			$id_temp = $depan.$this->functions->buatnol($no,$banyak_nol);
			if ($value->$primary == $id_temp) {
				if ($no == $this->functions->buatnol($query->num_rows(),$banyak_nol)) {
					$no++;
					$num = $no;
					continue;
				}
				$no++;
				continue;
			}
			else {
				$num = $no;
				break;
			}
		}
		if (!isset($num) || empty($num)) {
			$num=1;
		}
		return $depan.$this->functions->buatnol($num,$banyak_nol);
	}
	
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

	public function jika_kosong($tes)
	{
		if (!empty($tes) && $tes != null) {
			return $tes;
		}
		else {
			return "-";
		}
	}

	public function ubahURL($a)
	{
		return str_replace(" ","-",$a);
	}

	public function ubahKata($a)
	{
		return str_replace("-"," ",$a);
	}

	public function youtubeAPI($link,$id='player',$width=680,$height=480)
	{
		if(!empty($link) && $link != null){
			$link_array = explode("v=",$link);
			$video_key = $link_array[1];
		}
		else{
			$video_key = "";
		}

		return "<script>
		var player;
		function onYouTubeIframeAPIReady() {
		  player = new YT.Player('".$id."', {
			height: '".$height."',
			width: '".$width."',
			videoId: '".$video_key."',
			events: {
			  'onReady': onPlayerReady
			}
		  });
		}
	  </script>";
	}
}

/* End of file functions.php */
