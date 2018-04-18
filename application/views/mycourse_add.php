<body>
	<br>
<form action="<?php echo base_url() ?>tambah_kursus_aksi.html" method="POST" align="center">
	<h1>TAMBAH KURSUS</h1>
	<input type="text" name="nama_kursus" class="form-control-sm" style="width:200px" placeholder="Masukan Nama Kursus"><br><br>
	<select name="kategori" id="kategori" class="form-control-sm" style="width:200px">
	<?php
	foreach ($kategori->result() as $row) {
		echo "<option value='$row->id_kategori'>$row->nama_kategori</option>";
	}
	?>
	</select><br><br>
	<button type="submit">Tambah</button><br><br>
	<a href="<?php echo base_url() ?>kursusku.html" title="">Kembali</a>
</form>
<br>
</body>
