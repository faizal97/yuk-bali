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
			<label class="display-4"><?php echo $nama_kursus ?></label><label class="text-muted h2">&nbsp;/&nbsp;</label><label class="h2"><?php echo $data_kursus->nama_kategori ?></label><label class="text-muted h2">&nbsp;/&nbsp;</label><label class="h2"><?php echo $jumlah_materi ?> Materi</label>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col">
					<img class="rounded float-left mr-3" src="<?php echo base_url($data_kursus->gambar_kursus)  ?>" width="300" height="300" alt="">
					<h1 class="display-4">Tentang Kursus</h1>
					<?php echo $data_kursus->deskripsi_kursus ?>
				</div>
			</div>
			
			<div class="row mt-5">
				<div class="col">
					<hr>
				</div>
				<?php if($id_pengajar != $_SESSION['id_pengajar']){ ?>
				<div class="col-sm-2">
					<a href="<?php echo base_url($this->functions->ubahURL($nama_pengajar).'/'.$this->functions->ubahURL($nama_kursus).'/daftar_kursus.html') ?>" class="btn btn-outline-primary btn-lg btn-block">DAFTAR</a>
				</div>
				<?php } ?>
				<div class="col">
					<hr>
				</div>
			</div>
			<h1 class="display-4 mt-3">Profil Pengajar</h1>
			<div class="row">
				<div class="col-sm-4 mt-1">
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
					<hr>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-sm-12">
				<h1>Materi Kursus</h1>
					<table class="table table-striped table-hover table-responsive-lg" style="width:80%;" align="center">
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
