<div class="container">
	<h1 class="display-4 text-center animated zoomIn"><?php echo $nama_kategori ?></h1>
<a href="<?php echo base_url() ?>" class="btn btn-primary animated fadeIn">Kembali</a>
<br><br>
	<?php foreach ($data_kursus->result() as $row) {?>
	<div class="row" style="margin-bottom:20px">
		<div class="col">
			<img class="animated zoomIn" src="<?php echo base_url($row->gambar_kursus) ?>" width="400" height="200" alt="">
		</div>
		<div class="col animated jackInTheBox">
			<h2><?php echo $row->nama_kursus  ?></h2>
			<h3><?php echo $row->nama_depan." ".$row->nama_belakang ?></h3><br>
			<a class="btn btn-success form-control h-30" style="font-size:18pt" href="<?php echo base_url($this->functions->ubahURL($row->nama_depan." ".$row->nama_belakang).'/'.$this->functions->ubahURL($row->nama_kursus).'.html') ?>">Detail</a>
		</div>
	</div>
	<?php } ?>
</div>
