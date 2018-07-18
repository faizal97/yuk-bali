<div class="container">
	<h1>Pengaturan</h1>
	<form action="<?php echo base_url('kursusku/kelola/'.$id_kursus.'/pengaturan.html') ?>" method="post">
		<label for="judul">Judul Kursus</label>
		<input class="form-control" type="text" name="nama_kursus" id="judul" value="<?php echo $title ?>">

		<label for="kategori">Kategori Kursus</label>
		<select class="form-control" name="id_kategori" id="kategori">
		<?php foreach ($kategori->result() as $row) {?>
			<option <?php if($data->id_kategori==$row->id_kategori){echo "selected";} ?> value="<?php echo $row->id_kategori ?>"><?php echo $row->nama_kategori ?></option>
		<?php } ?>
		</select>
		<br>
		<textarea id="summernote" name="deskripsi_kursus"><?php echo $data->deskripsi_kursus ?></textarea>

		  <label class="col-sm-2 col-form-label">Gambar Kursus</label>
			<div class="col-sm-12">
			<div class="input-group">
			<div class="custom-file">
		
			<input type="file" class="custom-file-input form-control" name="gambar_kursus" id="">
			<label class="custom-file-label form-control" for="inputGroupFile04" name="gambar_kursus" >Pilih File</label>
  			</div>
  			</div>
  </div>
  <br>
  <button style="font-size:16pt;margin-left:45%;" type="submit" class="btn btn-success">Simpan</button>
	</form>
</div>
<script>
$(document).ready(function() {
  $('#summernote').summernote();
});
</script>
