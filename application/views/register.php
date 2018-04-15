<link rel="stylesheet" type="text/css" href="css/register.css">
<div id="content">
<form action="<?php echo base_url() ?>daftar_akun.html" class="" method="POST" accept-charset="utf-8">
		<h1>DAFTAR AKUN</h1>
		<br>
		<div class="form-group">
			<input type="text" style="width:188px" class="textbox form-control-sm" name="nama_depan" id="nama-depan" value="" placeholder="Masukan Nama Depan. . ." required="required">
			<input type="text" style="width:308px" class="textbox form-control-sm" name="nama_belakang" id="nama-blkg" value="" placeholder="Masukan Nama Belakang . ."><br>
			<input type="text" class="textbox form-control-sm" name="username" value="" id="username" placeholder="Masukan username" required="required"><br>
			<input type="password" id="pass" class="textbox form-control-sm" name="password" id="password" value="" placeholder="Masukan Password" required="required"><br>
			<input type="password" id="pass-again" class="textbox form-control-sm" id="password-lagi" name="password_ulang" value="" placeholder="Masukan Kembali Password" required="required"><span id="pass-valid"></span><br>
			<label for="tipe" class="form-control-sm">Tipe Akun </label>&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-control-sm" name="tipe" value="learner" required>Pelajar &nbsp;
			<input type="radio" class="form-control-sm" name="tipe" value="instructor">Instruktur <br>
			<button class="btn btn-success tombol" data-toggle="modal" data-target="#konfirmasi">Daftar</button>
			<button type="reset" class="btn btn-danger tombol">Batal</button>
		</div>
<script>
	$(document).ready(()=>{
		$('#nama-depan').focus();
	});
</script>