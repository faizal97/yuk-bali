<div class="container-fluid">
<a class="btn btn-primary" href="<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'/soal/'.$this->functions->ubahURL($judul_materi).'.html') ?>">Kembali</a>
	<form class="form-horizontal" action="<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'/soal/'.$this->functions->ubahURL($judul_materi).'/'.$data_soal->id_detail_soal.'/update_soal.html') ?>" method="post">
		<label for="nama_soal">Pertanyaan</label>
		<textarea required class="form-control" style="resize:none" name="nama_soal" id="nama_soal" cols="30" rows="5"><?php echo $data_soal->nama_soal ?></textarea>
		<br>
		<label for="pilihan_1">Pilihan 1</label>
		<textarea required style="resize:none" name="pilihan1" class="form-control" id="pilihan_1" cols="30" rows="1"><?php echo $data_soal->pilihan1 ?></textarea>
		<label for="pilihan_2">Pilihan 2</label>
		<textarea required style="resize:none" name="pilihan2" class="form-control" id="pilihan_2" cols="30" rows="1"><?php echo $data_soal->pilihan2 ?></textarea>
		<label for="pilihan_3">Pilihan 3</label>
		<textarea required style="resize:none" name="pilihan3" class="form-control" id="pilihan_3" cols="30" rows="1"><?php echo $data_soal->pilihan3 ?></textarea>
		<label for="pilihan_4">Pilihan 4</label>
		<textarea required style="resize:none" name="pilihan4" class="form-control" id="pilihan_4" cols="30" rows="1"><?php echo $data_soal->pilihan4 ?></textarea>
		<label for="jawaban">Jawaban</label>
		<select required name="jawaban" class="form-control" id="jawaban">
			<option <?php if($data_soal->jawaban==1){echo "selected";} ?> value="1">Pilihan 1</option>
			<option <?php if($data_soal->jawaban==2){echo "selected";} ?> value="2">Pilihan 2</option>
			<option <?php if($data_soal->jawaban==3){echo "selected";} ?> value="3">Pilihan 3</option>
			<option <?php if($data_soal->jawaban==4){echo "selected";} ?> value="4">Pilihan 4</option>
		</select>
		<br>
		<button class="btn btn-success" type="submit">Simpan</button>
		<button class="btn btn-danger" type="reset">Batal</button>
	</form>
</div>
