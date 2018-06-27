<link rel="stylesheet" type="text/css" href="<?php echo base_url('') ?>">
  <div class="container">
	<nav class="breadcrumb bg-white">
     <a class="breadcrumb-item" href="<?php echo base_url('home.html') ?>">Beranda</a>
     <span class="breadcrumb-item active"><?php echo $nama_kursus ?></span>
 </nav>
 </div>

<div class="container" style="width: 100%">
<a href="<?php echo base_url('home.html') ?>" class="btn btn-primary">Kembali</a>
	<div class="card border-info mb-3">
		<div class="card-header">
			<h2><?php echo $nama_kursus ?></h2>
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
					<label>Nama Pengajar : <?php echo $nama_pengajar ?></label><br>
					<a href="" class="form-control btn btn-primary" style="width:80%">DAFTAR</a>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?php echo $data_kursus->deskripsi_kursus ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 mt-5">
					<img src="<?php echo base_url($data_kursus->foto_profil)  ?>" width="300" height="300" alt="">
				</div>
				<div class="col-sm-8 mt-5">
				<h1><?php echo $nama_pengajar ?></h1>
				<h4><?php echo $jumlah_kursus_pengajar ?> Kursus</h4>
					<?php echo $data_kursus->deskripsi_pengajar ?>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-sm-12">
				<h1>Materi Kursus</h1>
					<table class="table table-striped" style="width:80%;" align="center">
					<thead class="thead-dark">
						<tr>
							<td scope="col" class="text-center">No. Materi</td>
							<td scope="col">Nama Materi</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data_materi->result() as $row) {?>
						<tr>
						<td class="text-center" scope="row"><?php echo $row->urut ?></td>
						<td><?php echo $row->nama_materi ?></td>
						</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
