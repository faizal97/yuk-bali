<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/dashbord.css">
<div class="container-fluid">
	<h1>Jelajah Kursus</h1>
	<div class="row">
	<?php foreach ($data_kursus->result() as $row) {?>
		<div class="col-sm-3">
		<div class="card">
         <img class="card-img-top" src="<?php echo base_url($row->gambar_kursus) ?>" width="300px" height="250px" alt="Card Image">
         <div class="card-body">
             <h5 class="card-title"><?php echo $row->nama_kursus ?></h5>
			 <p style='line-height:0px;'><?php echo $row->nama_kategori ?></p>
			 <p style='line-height:10px;'><?php echo $row->nama_depan." ".$row->nama_belakang ?></p>
			 <button class="btn btn-success form-control">DAFTAR</button>
         </div>
        </div>
		</div>
	<?php } ?>
	</div>
	<br>
	<h1>Kursus Terbaru</h1>
	<div class="row">
	<?php foreach ($data_kursus_baru->result() as $row) {?>
		<div class="col-sm-3">
		<div class="card">
         <img class="card-img-top" src="<?php echo base_url($row->gambar_kursus) ?>" width="300px" height="250px" alt="Card Image">
         <div class="card-body">
             <h5 class="card-title"><?php echo $row->nama_kursus ?></h5>
			 <p style='line-height:0px;'><?php echo $row->nama_kategori ?></p>
			 <p style='line-height:10px;'><?php echo $row->nama_depan." ".$row->nama_belakang ?></p>
			 <button class="btn btn-success form-control">DAFTAR</button>
         </div>
        </div>
		</div>
	<?php } ?>
	</div>
</div>
