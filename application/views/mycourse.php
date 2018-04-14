<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $username ?>'s Course</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<table cellspacing="10" cellpadding="10" align="center">
		<caption>KURSUS SAYA</caption>
		<thead>
				<th>No</th>
				<th>Nama Kursus</th>
				<th>Tgl Dibuat</th>
				<th>Tindakan</th>
			</tr>
		</thead>
		<tbody>
			<tr>
	<?php
	$num = 0;
	 foreach ($query->result() as $row){
	 $num++;
	?>
			<tr>
				<td><?php echo $num ?></td>
				<td><?php echo $row->nama_kursus ?></td>
				<td><?php echo $row->tgl_buat ?></td>
				<td><a href="" title="">Kelola</a></td>
			</tr>
	<?php
	}
	?>
	<tr>
		<td><a href="<?php echo base_url() ?>dashbord/mycourse/add" title="">Tambah</a></td>
	</tr>
		</tbody>
	</table>
	<a href="<?php echo base_url() ?>dashbord" title="">Kembali</a>
</body>
</html>