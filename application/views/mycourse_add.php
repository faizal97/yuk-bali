
	<input type="text" name="nama_kursus" id="nama_kursus" class="form-control" placeholder="Nama Kursus" required>
	<label for="nama_kursus" style="color:red;font-weight:bold;display:none;">Anda Telah Membuat Kursus Dengan Nama Tersebut !</label><br>
	<select name="kategori" id="kategori" class="form-control">
	<option>--Kategori--</option>
	<?php
	foreach ($kategori->result() as $row) {
		echo "<option value='$row->id_kategori'>$row->nama_kategori</option>";
	}
	?>
	</select><br>
	<label for="gambar">Gambar Kursus</label>
	<input type="file" name="gambar" id="gambar" class="form-control" accept=".jpg, .jpeg, .png" required><br><br>
	<script>
	function cek_nama_kursus(nama) {
		if(str.length == 0){

		}
	}
	</script>
