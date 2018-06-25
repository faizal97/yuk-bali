<link rel="stylesheet" type="text/css" href="<?php echo base_url('') ?>">
  <div class="container">
	<nav class="breadcrumb bg-white">
     <a class="breadcrumb-item" href="<?php echo base_url('home.html') ?>">Beranda</a>
     <span class="breadcrumb-item active"><?php echo $nama_kursus ?></span>
 </nav>
<div class="container" style="width: 100%">
    
	<div class="card border-info mb-3">
		<div class="card-header">
			<h2>Detail Kursus</h2>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-4">
					<img src="<?php echo base_url($data_kursus->gambar_kursus)  ?>" width="300" height="300" alt="">
				</div>
				<div class="col-sm-8">
					<label>Nama Kursus : <?php echo $nama_kursus ?></label><br>
					<label>Kategori : <?php echo $data_kursus->nama_kategori ?></label><br>
					<label>Jumlah Materi : <?php echo $jumlah_materi ?></label><br>
					<label>Nama Pengajar : <?php echo $nama_pengajar ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 mt-5">
					<img src="<?php echo base_url($data_kursus->foto_profil)  ?>" width="300" height="300" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
