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
					<span id="judul_materi"><?php echo $judul_materi ?></span>&nbsp;<button id="edit_nama_materi" class="btn btn-secondary" style="font-size:8pt;letter-spacing:1px"><span class="oi oi-pencil">&nbsp;Edit</span></button>
					<br><br>
					<label for="judul_kursus" style="line-height:0px;font-weight:bold;">Nama Kursus</label><br>
					<span id="judul_kursus"><?php echo $judul_kursus ?></span>
					<br><br>
					<label for="urut" style="line-height:0px;font-weight:bold;">No. Materi</label><br>
					<span id="urut"><?php echo $data_materi->urut ?></span>&nbsp;<button id="edit_urut_materi" class="btn btn-secondary" style="font-size:8pt;letter-spacing:1px" href="#"><span class="oi oi-pencil">&nbsp;Edit</span></button>
					<br><br>
					<label for="pengajar" style="line-height:0px;font-weight:bold;">Pengajar</label><br>
					<span id="pengajar"><?php echo $pengajar ?></span>
					<br><br>
					<label for="url" style="line-height:0px;font-weight:bold;">URL Video</label><br>
					<span id="url"><?php echo $this->functions->jika_kosong($data_materi->url_video) ?></span>
					<br><br>
				</div>
			</div>
		</div>
		<div class="col-sm-8" style="padding:0px;margin:0px">
			<div class="card" style="height:680px;padding:0px;margin:0px;border-radius:0px">
				<div class="card-header">
					<h2 class="text-center">Materi Kursus</h2>
				</div>
				<div class="card-body">
				<!-- nav tabs -->
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#video">Video</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#artikel">Artikel</a>
						</li>
					</ul>
				<!-- nav tabs -->
				<!-- tab panes -->
				<div class="tab-content">
				<div class="tab-pane container active" id="video">
					<br>
					<div id="player"></div>
					<br>
					<form action="<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'/materi/'.$this->functions->ubahURL($judul_materi).'/update_url_video.html') ?>" class="form-horizontal" method="post">
					<label for="url_video">URL Video</label>
						<div class="row">
							<div class="col-sm-10" style="padding:0px;margin:0px;padding-left:15px">
								<input type="text" required onclick="this.select();" style="font-size:18pt;border-top-right-radius:0px;border-bottom-right-radius:0px;" name="url_video" id="url_video" class="form-control" value="<?php echo $data_materi->url_video ?>" placeholder="https://www.youtube.com/watch?v=b38ef8n1p4U">
							</div>
							<div class="col-sm-2" class="form-control" style="padding:0px;margin:0px">
								<button type="submit" style="font-size:18pt;border-top-left-radius:0px;border-bottom-left-radius:0px;" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</form>
					</div>
					<div class="tab-pane container fade" id="artikel">
						<form action="<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($judul_kursus).'/materi/'.$this->functions->ubahURL($judul_materi).'/update_artikel.html') ?>" class="form-horizontal" method="post">
								<textarea name="artikel" id="summernote"><br><?php echo $data_materi->isi_materi ?></textarea>
								<br>
								<button class="btn btn-success" type="submit">Simpan</button>
						</form>
					</div>
					</div>
				<!-- tab panes -->
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $this->functions->youtubeAPI($data_materi->url_video,'player',700,400) ?>
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
