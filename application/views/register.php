<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/register.css') ?>">
<div class="container-fluid" style="margin-top:10px">
<a href="<?php echo base_url() ?>"><button class="btn btn-primary"><span class="oi oi-caret-left"></span>&nbsp;Kembali</button></a>
<div class="container">
	<div class="card" id="content">

		<div class="card-header">
			<h3>Daftar Akun</h3>
		</div>

		<div class="card-body">
		<form action="<?php echo base_url('daftar_akun.html') ?>" method="POST" accept-charset="utf-8">
			<div class="form-group">
				<input type="text" autofocus style="" class="textbox form-control" name="nama_lengkap" id="nama-lengkap" value="" placeholder="Nama Lengkap" required="required" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" />

				<br><input type="email" class="textbox form-control" name="email" value="" id="email" placeholder="E-Mail" required="required">

				<br><input type="password" id="pass" class="textbox form-control" name="password" id="password" value="" placeholder="Kata Sandi" required="required" title =" 8 karakter kata sandi. Gunakan Huruf kecil, huruf besar dan angka" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

				<br><input type="password" id="pass-again" class="textbox form-control" id="password-lagi" name="password_ulang" value="" placeholder="Konfirmasi Kata Sandi" required="required"><span id="pass-valid"></span>
				<div class="form-check" style="margin-left:10px;margin-top:10px;">
					<div class="form-check-label">
						<input type="checkbox" class="form-check-input" name="tos" id="tos" name="tos" required> Saya bersedia mengikuti segala peraturan yang ditetapkan pihak <strong>Yuk-Bali</strong> dan bersedia menerima sanksi jika melanggar peraturan yang telah ditetapkan.
					</div>
				</div>

				<br>
				<br><button class="btn btn-success tombol" data-toggle="modal" data-target="#konfirmasi">Daftar</button>
				
			</div>
		</div>

		<div class="card-footer text-center">
			Sudah Memiliki Akun ? Login <a href="<?php echo base_url('masuk.html') ?>">disini</a>
		</div>

	</div>
</div>
</div>
<script>
	$(document).ready(()=>{
		$('#content').animate({
			opacity:1
		},2000)
	});
</script>
