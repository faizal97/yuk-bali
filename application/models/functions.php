<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class functions extends CI_Model {

	public function __construct()
	{
		$query = $this->db->query("SELECT * FROM tb_kursus");
		foreach ($query->result() as $row) {
			$this->aturUlang($row->id_kursus);
		}
	}
	public function aturUlang($id_kursus)
	{
		$query = $this->db->query("SELECT * FROM tb_materi WHERE id_kursus='$id_kursus' ORDER BY urut ASC");
		$i = 0;
		$query2 = $this->db->query("SELECT COUNT(tb_materi.id_materi) AS jumlah_materi FROM tb_materi WHERE id_kursus='$id_kursus'");
		$query2 = $query2->row();
		$jumlah_materi = $query2->jumlah_materi;
		foreach ($query->result() as $row) {
			$i++;
			if($i==1){
				if ($row->urut!=1) {
					$data['urut'] = 1;
					$this->db->where('id_materi',$row->id_materi);
					$this->db->update('tb_materi',$data);
				}
			}
			if($row->urut!=$i){
				$data['urut'] = $i;
				$this->db->where('id_materi',$row->id_materi);
				$this->db->update('tb_materi',$data);
			}

			if($i>=$jumlah_materi){
				$data['urut'] = $jumlah_materi;
				$this->db->where('id_materi',$row->id_materi);
				$this->db->update('tb_materi',$data);
			}
		}
	}

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

	public function youtubeAPI($link,$id='player',$width=680,$height=480,$autoplay=false)
	{
		if(!empty($link) && $link != null){
			$link_array = explode("v=",$link);
			$video_key = $link_array[1];
		}
		else{
			$video_key = "";
		}
		if ($autoplay) {
			$auto = ",
			events: {
			  'onReady': onPlayerReady
			}";
		}
		else {
			$auto="";
		}
		return "<script>
		var player;
		function onYouTubeIframeAPIReady() {
		  player = new YT.Player('".$id."', {
			height: '".$height."',
			width: '".$width."',
			videoId: '".$video_key."'".$auto."
		  });
		}
	  </script>";
	}

	public function buatPagination($tabel='',$link='',$aktif,$per=5)
	{
		if (strpos($link,"?")!=false) {
			$simbol = "&";
		}
		else {
			$simbol ="?";
		}
		$per_halaman = $per;
		$query = $this->db->query("SELECT * FROM $tabel");
		$jumlah = $query->num_rows();
		if($jumlah<=$per_halaman)
		{
			$banyak_halaman = 1;
		}else
		{
			$banyak_halaman = floor($jumlah / $per_halaman);
			if ($jumlah % $per_halaman != 0)
			{
				$banyak_halaman++;
			} 
		}
		echo "<ul id='pagin' class='pagination'>";
		for ($i=1;$i<=$banyak_halaman;$i++) {
			$prev = $aktif - 1;  
			if ($i==1) {
				if ($aktif == 1) {
					$a = "disabled";
					$href = "#pagin";
				}
				else {
					$a = "";
					$href = base_url($link.$simbol.'p='.$prev);
				}
				echo "<li class='page-item ".$a."'><a class='page-link' href='".$href."'><<</a></li>";
			}
			if ($aktif==$i) {
				$b = "active";
			}
			else {
				$b = "";
			}
			echo "<li class='page-item ".$b."'><a class='page-link' href='".base_url($link.$simbol.'p='.$i)."'>$i</a></li>";
			$next = $aktif + 1;
			if ($i==$banyak_halaman) {
				if ($aktif == $banyak_halaman) {
					$a = "disabled";
					$href ="#pagin";
				}
				else {
					$a = "";
					$href=base_url($link.$simbol.'p='.$next);
				} 
				echo "<li class='page-item ".$a."'><a class='page-link' href='".$href."'>>></a></li>";
			}	
		}
		echo "</ul>";	
	}

	public function getPage($p,$per=5)
	{
		$per_halaman = $per;
		if(empty($p)){
			$p = 1;
			$page=0;
		}else{
			$page = ($p - 1) * $per_halaman;
		}
		return $page;
	}

	public function upload_gambar($name_dom,$target_dir,$id)
	{
		// Upload Cover Buku Ke files/covers/
		$config_cover = array(
			'upload_path' => $target_dir,
			'allowed_types' => "png|jpeg|jpg",
			'overwrite' => TRUE,
			'max_size' => 2048*1000,
			'max_height' => '768',
			'max_width' => '1024',
			'file_name' => $id
		);
		$this->load->library('upload',$config_cover);
		$this->upload->initialize($config_cover);
		if($this->upload->do_upload($name_dom,$config_cover)){
			// echo "Cover Telah terupload";
		}
		else{
			echo $this->upload->display_errors();
			exit();
		}
		unset($config_cover);
	}

}

/* End of file functions.php */
