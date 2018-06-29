<div class="container">
	<div class="card-header">
		<h1>HASIL NILAI</h1>
	</div>
	<div class="card-body text-center">
		<label class="display-1"><?php echo $data_nilai->nilai ?></label>
	</div>
	<?php if($data_nilai->nilai >= 68){ ?>
		<a class="btn btn-outline-success" href="">Selanjutnya&nbsp;&nbsp;<span class="oi oi-chevron-right"></span></a>
		<h1 style="display:none" id="msg" class="text-center display-4" style="letter-spacing:50px">SELAMAT</h1>
	<?php }else { ?>
		<a class="btn btn-outline-info" href="">Ulangi&nbsp;&nbsp;<span class="oi oi-action-undo"></span></a><br>
			<h1 style="display:none" id="msg" class="text-center display-4">Ayo Belajar Lebih Giat !</h1>
	<?php } ?>
</div>
<script>
$(document).ready(()=>{
	$('#msg').fadeIn(1000);
});
</script>
