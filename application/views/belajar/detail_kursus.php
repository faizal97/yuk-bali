<div class="container-fluid">
	<nav class="breadcrumb bg-white">
		<a class="breadcrumb-item" href="<?php echo base_url('home.html') ?>">Beranda</a>
		<a class="breadcrumb-item" href="<?php echo base_url('kursus.html') ?>">Kursus Saya</a>
		<span class="breadcrumb-item active"><?php echo $nama_kursus ?></span>
 	</nav>
	<a class="btn btn-primary" href="<?php echo base_url('kursus.html') ?>">Kembali</a>
	<h1 class="display-3"><?php echo $nama_kursus ?></h1>
	<div class="progress" style="height:50px;font-size:24pt">
		<?php
			$kursus_progress = ($data_kursus->materi_terakhir / $jumlah_materi) * 100;
		 ?>
		<div class="progress-bar progress-bar-striped progress-bar-animated <?php if($data_kursus->materi_terakhir > $jumlah_materi){echo "bg-success";} ?>" role="progressbar" style="width: <?php echo $kursus_progress ?>%" aria-valuenow="<?php echo $kursus_progress ?>" aria-valuemin="0" aria-valuemax="100"><?php if($data_kursus->materi_terakhir > $jumlah_materi){echo "Selesai";}else{echo  $data_kursus->materi_terakhir; ?>&nbsp;/&nbsp;<?php echo $jumlah_materi; ?>&nbsp;Materi<?php } ?></div>
	</div>

	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Materi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($data_materi->result() as $row) {?>
		<tr>
			<td><?php echo $row->urut ?></td>
			<td><?php echo $row->nama_materi ?></td>
			<td><a class="btn btn-outline-success <?php if($data_kursus->materi_terakhir < $row->urut){echo "disabled";} ?>" href="<?php echo base_url('kursus/'.$this->functions->ubahURL($nama_kursus).'/'.$this->functions->ubahURL($row->nama_materi).'.html') ?>">
			<?php if($data_kursus->materi_terakhir < $row->urut){ ?>
				Terkunci&nbsp;&nbsp;<span class="oi oi-lock-locked"></span>
			<?php }elseif($data_kursus->materi_terakhir == $row->urut){ ?>
				Lanjut&nbsp;&nbsp;<span class="oi oi-chevron-right"></span>
			<?php }elseif($data_kursus->materi_terakhir > $row->urut){ ?>
				Ulangi&nbsp;&nbsp;<span class="oi oi-action-undo"></span>
			<?php } ?>
			</a></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>	
</div>
