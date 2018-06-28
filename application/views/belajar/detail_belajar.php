<div class="container-fluid">
	<nav class="breadcrumb bg-white">
		<a class="breadcrumb-item" href="<?php echo base_url('home.html') ?>">Beranda</a>
		<a class="breadcrumb-item" href="<?php echo base_url('kursus.html') ?>">Kursus Saya</a>
		<a class="breadcrumb-item" href="<?php echo base_url('kursus/'.$this->functions->ubahURL($nama_kursus).'.html') ?>"><?php echo $nama_kursus ?></a>
		<span class="breadcrumb-item active"><?php echo $nama_materi ?></span>
	</nav>
	<a class="btn btn-primary" href="<?php echo base_url('kursus/'.$this->functions->ubahURL($nama_kursus).'.html') ?>">Kembali</a>

	<div class="container">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#video">Video</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#artikel">Artikel</a>
			</li>
		</ul>

		<div class="tab-content text-center">
			<div class="tab-pane container active" id="video">
				<div class="row">
					<div class="col-sm-11">
						<div class="mt-5 mb-5" id="player">
						<span class="alert alert-danger form-control"><span class="oi oi-warning"></span>&nbsp;Anda tidak terhubung pada jaringan internet. Video tidak dapat ditampilkan. <a href="">Refresh</a> halaman.</span>
						</div>
					</div>
					<div class="col-sm-1">
						<span onclick="buka_tab('artikel')" style="top:50%;font-size:36pt" class="oi oi-chevron-right"></span>
					</div>
				</div>
			</div>
			<div class="tab-pane container fade" id="artikel">
				<div class="row">
				<div class="col-sm-1">
						<span onclick="buka_tab('video')" style="top:50%;font-size:36pt" class="oi oi-chevron-left"></span>
					</div>
					<div class="col-sm-11">
						<?php echo $data_materi->isi_materi ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-5 mb-5">
				<div class="col-sm-5">
					<hr>
				</div>
				<div class="col-sm-2">
					<a style="letter-spacing:1px" href="<?php echo base_url('kursus/'.$this->functions->ubahURL($nama_kursus).'/'.$this->functions->ubahURL($nama_materi).'/soal.html') ?>" class="btn btn-outline-success btn-lg btn-block">SELESAI</a>
				</div>
				<div class="col-sm-5">
					<hr>
				</div>
			</div>
	</div>
</div>
<?php echo $this->functions->youtubeAPI($data_materi->url_video,'player',700,400) ?>
<script>
function buka_tab(id) {
	$('a[href="#' + id + '"]').tab('show');
}

if (!navigator.onLine) {
  $('#player').html('<span class="alert alert-danger form-control"><span class="oi oi-warning"></span>&nbsp;Anda tidak terhubung pada jaringan internet. Video tidak dapat ditampilkan. <a href="">Refresh</a> halaman.</span>');
}
</script>
