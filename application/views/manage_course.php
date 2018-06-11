<div class="container-fluid">
	<!-- START BREADCRUMB -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white">
			<li class="breadcrumb-item">
				<a href="<?php echo base_url('home.html') ?>">
					Beranda
				</a>
			</li>
			<li class="breadcrumb-item">
				<a href="<?php echo base_url('kursusku.html') ?>">
					Kursus Ku
				</a>
			</li>
			<li class="breadcrumb-item active">
					<?php echo $title ?>
			</li>
		</ol>
	</nav>
	<a href="<?php echo base_url('kursusku.html') ?>"><button class="btn btn-primary">Kembali</button></a>
	<!-- END BREADCRUMB -->
	<!-- START CONTENT -->
	<div class="container">
		<div class="card">
			<div class="card-body" style="background-color:rgb(255,255,255,1);">
				<!-- START BAGIAN JUDUL -->
				<div class="row" style="border-bottom:1px solid rgb(0,0,0,0.1);">
					<div class="col-sm-1" style="padding:0px">
						<img class="rounded" onclick="perbesar_gambar()" id="thumbnail_kursus" src="<?php echo base_url($data->gambar_kursus) ?>" width="75" height="75" alt="<?php echo $title ?>">
					</div>
					<div class="col-sm-6" style="">
					<label>Judul</label>
						<h2 style="line-height:20px"><?php echo $title ?></h2>
					</div>
					<div class="col-sm-4" style="">
					<label>Kategori</label>
						<h3 style="line-height:20px"><?php echo $data->nama_kategori ?></h3>
					</div>
					<div class="col-sm-1">
						<a class="btn btn-secondary" href="#"><span class="oi oi-pencil">&nbsp;Edit</span></a>
					</div>
				</div>
				<!-- END BAGIAN JUDUL -->
				<!-- START BAGIAN ISI -->
				<div class="row">
					<!-- START MENU BAGIAN KIRI -->
					<div class="col-sm-2" style="background-color:rgb(255,255,255,1);border-right:1px solid rgb(0,0,0,0.1);padding-top:20px">
						<ul class="nav flex-column" width="100%">
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#utama">
									Menu Utama
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#materi">
									Materi
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#pelajar">
									Pelajar
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#laporan">
									Laporan
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#pengaturan">
									Pengaturan
								</a>
							</li>
						</ul>
					</div>
					<!-- END MENU BAGIAN KIRI -->
					<!-- START MENU BAGIAN KANAN -->
					<div class="col-sm-10">
						<div class="tab-content">
							<div class="tab-pane container active" id="utama">
								<?php $this->load->view('kelola_kursus/utama');?>
							</div>
							<div class="tab-pane container fade" id="materi">
								<?php $this->load->view('kelola_kursus/materi');?>
							</div>
							<div class="tab-pane container fade" id="pelajar">
								<?php $this->load->view('kelola_kursus/pelajar');?>
							</div>
						</div>
					</div>
					<!-- END MENU BAGIAN KANAN -->
				</div>
				<!-- END BAGIAN ISI -->
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>

<!-- START MODAL IMAGES -->
<div id="modal_images" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<span class="close" data-dismiss="modal">&times;</span>
			</div>
			<img class="modal-body" src="<?php echo base_url($data->gambar_kursus) ?>" alt="<?php echo $title ?>">
		</div>
	</div>
</div>
<!-- END MODAL IMAGES -->
<script>
function perbesar_gambar() {
	$('#modal_images').modal('show');
}
</script>
