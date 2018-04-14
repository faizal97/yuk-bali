<!DOCTYPE html>
<html>
<head>
	<title>Tambah Kursus</title>
</head>
<body>
<form action="<?php echo base_url() ?>dashbord/mycourse/add/action" method="POST">
	<h1>TAMBAH KURSUS</h1>
	<input type="text" name="nama_kursus" placeholder="Masukan Nama Kursus">
	<button type="submit">Tambah</button><br><br>
	<a href="<?php echo base_url() ?>dashbord/mycourse" title="">Kembali</a>
</form>
</body>
</html>