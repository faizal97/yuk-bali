<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/dashbord.css">
<div class="container-fluid">
	<h1 class="animated fadeInDown">Jelajah Kursus</h1>
	<div class="row">
	<?php $no=0;$no++;foreach ($data_kursus->result() as $row) {$nama_pengajar=$row->nama_depan." ".$row->nama_belakang;$no++;?>
		<div class="col-sm-3">
		<a class="kursus" href="<?php echo base_url($this->functions->ubahURL($nama_pengajar).'/'.$this->functions->ubahURL($row->nama_kursus).'.html') ?>" style="text-decoration:none;color:black">
		<div id="jelajah<?php echo $no ?>" class="card animated zoomIn">
         <img class="card-img-top img-thumbnail" src="<?php echo base_url($row->gambar_kursus) ?>?<?php echo time() ?>" style="width:300px;height:250px;" alt="Card Image">
         <div class="card-body">
             <h5 class="card-title"><?php echo $row->nama_kursus ?></h5>
			 <p style='line-height:0px;'><?php echo $row->nama_kategori ?></p>
			 <p style='line-height:10px;'><?php echo $row->nama_depan." ".$row->nama_belakang ?></p>		 
         </div>
        </div>
		</a>
		</div>
	<?php } ?>
	</div>
	<br>
	<h1 class="animated fadeInDown">Kursus Terbaru</h1>
	<div class="row">
	<?php $no=0;foreach ($data_kursus_baru->result() as $row) {$nama_pengajar=$row->nama_depan." ".$row->nama_belakang;$no++;?>
		<div class="col-sm-3">
		<a class="kursus" style="text-decoration:none;color:black" href="<?php echo base_url($this->functions->ubahURL($nama_pengajar).'/'.$this->functions->ubahURL($row->nama_kursus).'.html') ?>">
		<div id="jelajah<?php echo $no ?>" class="card animated zoomIn">
         <img class="card-img-top img-thumbnail" src="<?php echo base_url($row->gambar_kursus) ?>?<?php echo time() ?>" style="width:300px;height:250px;" alt="Card Image">
         <div class="card-body">
             <h5 class="card-title"><?php echo $row->nama_kursus ?></h5>
			 <p style='line-height:0px;'><?php echo $row->nama_kategori ?></p>
			 <p style='line-height:10px;'><?php echo $row->nama_depan." ".$row->nama_belakang ?></p>
         </div>
        </div>
		</a>
		</div>
	<?php } ?>
	</div>
</div>
