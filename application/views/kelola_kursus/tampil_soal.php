<?php
	$query_soal = $this->db->query("SELECT * FROM tb_detail_soal WHERE id_soal='".$data_soal->id_soal."'");
	$jumlah_soal = $query_soal->num_rows();
?>
<div class="container-fluid">
	 <nav class="breadcrumb bg-white">
     	<a class="breadcrumb-item" href="<?php echo base_url('home.html') ?>">Home</a>
     	<a class="breadcrumb-item" href="<?php echo base_url('kursusku.html') ?>">Kursusku</a>
		<a class="breadcrumb-item" href="<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'.html') ?>"><?php echo $judul_kursus ?></a>
		<span class="breadcrumb-item active"><?php echo $judul_materi ?></span>
 	</nav>
	 <a class="btn btn-primary" href="<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'.html?tab=materi') ?>">Kembali</a>
</div>
<div class="container" style="margin-top:20px;margin-bottom:20px;">
	<div class="row">
		<div class="col-sm-4" style="padding:0px;margin:0px;">
			<div class="card" style="height:680px;padding:0px;margin:0px;border-radius:0px;">
				<div class="card-header">
					<h2 class="text-center">Deskripsi Materi</h2>
				</div>
				<div class="card-body" style="font-size:14pt;">
					<label for="judul_materi" style="line-height:0px;font-weight:bold;">Nama Materi</label><br>
					<span id="judul_materi"><?php echo $judul_materi ?></span>
					<br><br>
					<label for="judul_kursus" style="line-height:0px;font-weight:bold;">Nama Kursus</label><br>
					<span id="judul_kursus"><?php echo $judul_kursus ?></span>
					<br><br>
					<label for="urut" style="line-height:0px;font-weight:bold;">No. Materi</label><br>
					<span id="urut"><?php echo $data_soal->urut ?></span>
					<br><br>
					<label for="pengajar" style="line-height:0px;font-weight:bold;">Pengajar</label><br>
					<span id="pengajar"><?php echo $pengajar ?></span>
					<br><br>
					<label for="jumlah" style="line-height:0px;font-weight:bold;">Jumlah Soal</label><br>
					<span id="jumlah"><?php echo $jumlah_soal ?>&nbsp;Soal</span>
					<br><br>
				</div>
			</div>
		</div>
		<div class="col-sm-8" style="padding:0px;margin:0px">
			<div class="card" style="height:680px;padding:0px;margin:0px;border-radius:0px">
				<div class="card-header">
					<h2 class="text-center">Materi Soal</h2>
				</div>
				<div class="card-body" style="overflow:auto;">
				<!-- nav tabs -->
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#video">Lihat Soal</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#artikel">Tambah Soal</a>
						</li>
					</ul>
				<!-- nav tabs -->
				<!-- tab panes -->
				<div class="tab-content">
				<div class="tab-pane container active" id="video">
						<?php $no=0;foreach ($query_soal->result() as $row) {$no++;?>
							<p><?php echo $no ?>.&nbsp;<?php echo $row->nama_soal ?></p>
							<div class="row">
								<div class="col-sm-12">
									<p><input type="radio" disabled <?php if($row->jawaban==1){echo "checked";} ?> name="soal<?php echo $no ?>" id="soalA<?php echo $no ?>" value="1">&nbsp;A. <?php echo $row->pilihan1 ?></p>
								</div>
								<div class="col-sm-12">
									<p><input type="radio" disabled <?php if($row->jawaban==2){echo "checked";} ?> name="soal<?php echo $no ?>" id="soalB<?php echo $no ?>" value="1">&nbsp;B. <?php echo $row->pilihan2 ?></p>
								</div>
								<div class="col-sm-12">
									<p><input type="radio" disabled <?php if($row->jawaban==3){echo "checked";} ?> name="soal<?php echo $no ?>" id="soalC<?php echo $no ?>" value="1">&nbsp;C. <?php echo $row->pilihan3 ?></p>
								</div>
								<div class="col-sm-12">
									<p><input type="radio" disabled <?php if($row->jawaban==4){echo "checked";} ?> name="soal<?php echo $no ?>" id="soalD<?php echo $no ?>" value="1">&nbsp;D. <?php echo $row->pilihan4 ?></p>
								</div>
								<div class="col-sm-12">
									<a href="<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'/soal/'.$this->functions->ubahURL($judul_materi).'/'.$row->id_detail_soal.'.html') ?>" class="btn btn-primary">Kelola</a>
									<a href="<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'/soal/'.$this->functions->ubahURL($judul_materi).'/hapus/'.$row->id_detail_soal.'.html') ?>" class="btn btn-danger">Hapus</a>
								</div>
							</div>
							<br>
						<?php } ?>
						<p>Catatan: Nomer soal saat dikerjakan oleh pelajar akan selalu diacak beserta urutan pilihan.</p>
					</div>
					<div class="tab-pane container fade" id="artikel">
						<form class="form-horizontal" action="<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'/soal/'.$this->functions->ubahURL($judul_materi).'/tambah_soal.html') ?>" method="post">
							<label for="nama_soal">Pertanyaan</label>
							<textarea required class="form-control" style="resize:none" name="nama_soal" id="nama_soal" cols="30" rows="5"></textarea>
							<br>
							<label for="pilihan_1">Pilihan 1</label>
							<textarea required style="resize:none" name="pilihan1" class="form-control" id="pilihan_1" cols="30" rows="1"></textarea>
							<label for="pilihan_2">Pilihan 2</label>
							<textarea required style="resize:none" name="pilihan2" class="form-control" id="pilihan_2" cols="30" rows="1"></textarea>
							<label for="pilihan_3">Pilihan 3</label>
							<textarea required style="resize:none" name="pilihan3" class="form-control" id="pilihan_3" cols="30" rows="1"></textarea>
							<label for="pilihan_4">Pilihan 4</label>
							<textarea required style="resize:none" name="pilihan4" class="form-control" id="pilihan_4" cols="30" rows="1"></textarea>
							<label for="jawaban">Jawaban</label>
							<select required name="jawaban" class="form-control" id="jawaban">
								<option value="1">Pilihan 1</option>
								<option value="2">Pilihan 2</option>
								<option value="3">Pilihan 3</option>
								<option value="4">Pilihan 4</option>
							</select>
							<br>
							<button class="btn btn-success" type="submit">Simpan</button>
							<button class="btn btn-danger" type="reset">Batal</button>
						</form>
					</div>
					</div>
				<!-- tab panes -->
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $this->functions->youtubeAPI($data_soal->url_video,'player',700,400) ?>
<script>
$(document).ready(()=>{
	$('#summernote').summernote({
		placeholder: 'Isi konten artikel dari materi ini. . .',
		tabsize:2,
		height:400,
		minHeight:100,
		maxHeight:400,
		focus:true
	});
});
if (!navigator.onLine) {
  $('#player').html('<span class="alert alert-danger form-control"><span class="oi oi-warning"></span>&nbsp;Anda tidak terhubung pada jaringan internet. Video tidak dapat ditampilkan. <a href="">Refresh</a> halaman.</span>');
}

$('#edit_nama_materi').click(()=>{
	let isi = $('#judul_materi').text();
	$('#judul_materi').html("<form action='<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'/materi/'.$this->functions->ubahURL($judul_materi).'/update_nama_materi.html') ?>' method='post'><input name='nama_materi' class='form-control' type='text' value='"+isi+"'><button class='btn btn-success' type='submit'>Simpan</button></form>");
	$('#edit_nama_materi').hide(1);
});

$('#edit_urut_materi').click(()=>{
	let isi = $('#urut').text();
	$('#urut').html("<form action='<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'/materi/'.$this->functions->ubahURL($judul_materi).'/update_urut_materi.html') ?>' method='post'><input class='form-control' name='urut' type='number' value='"+isi+"'><button class='btn btn-success' type='submit'>Simpan</button></form>");
	$('#edit_urut_materi').hide(1);
});
</script>
