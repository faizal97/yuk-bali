<div class="container-fluid">
	<h1>Laporan</h1>
	<h2>Jumlah Pelajar : <?php echo $jumlah_siswa ?></h2>
	<br>

	<h3>Data Pelajar</h3>
	<?php $no=0;foreach ($laporan_pelajar->result() as $row) {$no++; ?>
	<table class="table table-stripped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Lengkap</th>
				<th>Materi Terakhir</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $row->nama_depan." ".$row->nama_belakang ?></td>
				<td><?php echo $row->materi_terakhir ?></td>
			</tr>
		</tbody>
	</table>
	<?php } ?>
	<a href="<?php echo base_url('laporan/pelajar/'.$id_kursus.'.html') ?>" target="_BLANK" class="btn btn-outline-success">Selengkapnya&nbsp;&nbsp;<span class="oi oi-chevron-right"></span></a>
<br>
<br>
		<h3>Data Nilai</h3>
	<?php $no=0;foreach ($laporan_nilai->result() as $row) {$no++; ?>
	<?php
		$id_materi = $row->id_materi;
		$query = $this->db->query("SELECT * FROM tb_materi WHERE id_materi='$id_materi'");
		$query = $query->row();
		$nama_materi = $query->nama_materi;
	?>
	<table class="table table-stripped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Lengkap</th>
				<th>Materi</th>
				<th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $row->nama_depan." ".$row->nama_belakang ?></td>
				<td><?php echo $nama_materi ?></td>
				<td><?php echo $row->nilai ?></td>
			</tr>
		</tbody>
	</table>
	<?php } ?>
	<a href="<?php echo base_url('laporan/nilai/'.$id_kursus.'.html') ?>" target="_BLANK" class="btn btn-outline-success">Selengkapnya&nbsp;&nbsp;<span class="oi oi-chevron-right"></span></a>
</div>
