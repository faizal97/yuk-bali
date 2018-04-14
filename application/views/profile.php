<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo strtoupper($nama_depan." ".$nama_belakang) ?></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<a href="<?php echo base_url() ?>dashbord" title="">KEMBALI</a>
	<h1>PROFIL</h1>
	Nama : <?php echo strtoupper($nama_depan." ".$nama_belakang) ?><br>
	Username : <?php echo $username ?>
</body>
</html>