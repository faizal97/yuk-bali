<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css') ?>">
<div class="container-fluid" style="margin-top:10px">
<a href="<?php echo base_url() ?>"><button class="btn btn-primary"><span class="oi oi-caret-left"></span>&nbsp;Kembali</button></a>
<div class="container">
	<div class="card" id="content">

		<div class="card-header">
			<h3>Masuk Akun</h3>
		</div>

		<div class="card-body">
		<form action="<?php echo base_url('masuk_akun.html') ?>" method="POST" accept-charset="utf-8">
			<div class="form-group">
				<br><input type="text" class="textbox form-control" name="euser" value="" id="email" placeholder="E-Mail / Username" required="required" autofocus>
				<br><input type="password" id="pass" class="textbox form-control" name="password" id="password" value="" placeholder="Password" required="required">
				<br><button class="btn btn-danger tombol" data-toggle="modal" data-target="#konfirmasi">Masuk</button>
			</div>
		</div>

		<div class="card-footer text-center">
			Belum Memiliki Akun ? Daftar <a href="<?php echo base_url('daftar.html') ?>">disini</a>
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