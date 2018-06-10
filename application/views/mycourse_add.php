
	<input type="text" name="nama_kursus" class="form-control" placeholder="Nama Kursus" required><br><br>
	<select name="kategori" id="kategori" class="form-control">
	<?php
	foreach ($kategori->result() as $row) {
		echo "<option value='$row->id_kategori'>$row->nama_kategori</option>";
	}
	?>
	</select><br><br>
	<input type="text" class="form-control" name="tags" id="tags" placeholder="Bahasa Pemograman: cth. php,mysql,java"><br>
	<input type="file" name="gambar" id="gambar" class="form-control" accept=".jpg, .jpeg, .png" required><br><br>
