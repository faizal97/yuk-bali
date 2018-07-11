<div class="container">
	<div class="card-header">
		<h1>HASIL NILAI</h1>
	</div>
	<div class="card-body text-center">
		<label class="display-1"><?php echo $data_nilai->nilai ?></label>
	</div>
	<?php if(isset($_GET['s']) && $_GET['s']=='belajar'){ ?>
	<?php if($data_nilai->nilai >= 68){ ?>
		<a class="btn btn-outline-success" href="<?php echo base_url('kursus/'.$this->functions->ubahURL($data_nilai->nama_kursus).'.html') ?>">Selanjutnya&nbsp;&nbsp;<span class="oi oi-chevron-right"></span></a>
		<h1 style="display:none" id="msg" class="text-center display-4" style="letter-spacing:50px">SELAMAT</h1>
	<?php }else { ?>
		<a class="btn btn-outline-info" href="<?php echo base_url('kursus/'.$data_nilai->id_materi.'/'.$data_nilai->id_soal.'/ulang_materi.html') ?>">Ulangi&nbsp;&nbsp;<span class="oi oi-action-undo"></span></a><br>
			<h1 style="display:none" id="msg" class="text-center display-4">Ayo Belajar Lebih Giat !</h1>
	<?php } ?>
	<?php } ?>
</div>
<script>
$(document).ready(()=>{
	$('#msg').fadeIn(1000);
});
</script>
