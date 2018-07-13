<style>
.kursus:hover {
	opacity:0.8;
}
</style>
<div class="container-fluid">
	<nav class="breadcrumb bg-white">
		<a class="breadcrumb-item" href="<?php echo base_url('home.html') ?>">Beranda</a>
		<span class="breadcrumb-item active">Kursus Saya</span>
 	</nav>

	<div class="card">
	 	<div class="card-header">
		 	<h1 class="display-4">Kursus Saya</h1>
		</div>
		<div class="card-body">
		<div class="row">
		<?php foreach ($data_kursus->result() as $row) {
			if($row->jumlah_materi!=0){?>
			<div class="col-sm-3 mb-3">
		<a class="kursus" href="<?php echo base_url('kursus/'.$this->functions->ubahURL($row->nama_kursus).'.html') ?>" style="text-decoration:none;color:black">
		<div class="card">
         <img class="card-img-top img-thumbnail" src="<?php echo base_url($row->gambar_kursus) ?>" width="300px" height="250px" alt="Card Image">
         <div class="card-body">
             <h5 class="card-title"><?php echo $row->nama_kursus ?></h5>
			 <div class="progress" style="height:20px">
			 <?php
				$kursus_progress = ($row->materi_terakhir / $row->jumlah_materi) * 100;
				 
			 ?>
			 	<div class="progress-bar <?php if($row->materi_terakhir > $row->jumlah_materi){echo "bg-success";} ?>" role="progressbar" style="width: <?php echo $kursus_progress ?>%" aria-valuenow="<?php echo $kursus_progress ?>" aria-valuemin="0" aria-valuemax="100"><?php if($row->materi_terakhir > $row->jumlah_materi){echo "Selesai";}else{echo  $row->materi_terakhir; ?>&nbsp;/&nbsp;<?php echo $row->jumlah_materi; ?>&nbsp;Materi<?php } ?></div>
				 <?php } ?>
			 </div>	 
         </div>
        </div>
		</a>
		</div>
		<?php } ?>
		</div>
		</div>
	 </div>
</div>
