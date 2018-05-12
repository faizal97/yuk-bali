<body>
<div class="container-fluid">
	<table align="center" class="table">
		<thead>
				<th>No</th>
				<th>Nama Kursus</th>
				<th>Kategori</th>
				<th>Gambar</th>
				<th>Tgl Dibuat</th>
				<th>Tindakan</th>
			</tr>
		</thead>
		<tbody>
			<tr>
	<?php
	$num = 0;
	 foreach ($query->result() as $row){
	 $num++;
	?>
			<tr>
				<td><?php echo $num ?></td>
				<td><?php echo $row->nama_kursus ?></td>
				<td><?php echo $row->nama_kategori ?></td>
				<td><img src="<?php echo base_url().$row->gambar_kursus ?>" width="100px" height="100px"></td>
				<td><?php echo $row->tgl_buat ?></td>
				<td><a href="<?php echo base_url()."kelola_kursus/".str_replace(" ","_",$row->nama_kursus) ?>.html" title="">Kelola</a></td>
			</tr>
	<?php
	}	if(count($query->result())<=0){
		echo "<td colspan=5 align=center style='font-size:20pt;'>Data Kursus Kosong !</td>";
	}
	?>
	<tr>
		<td><a href="<?php echo base_url() ?>tambah_kursus.html" title="">Tambah</a></td>
	</tr>
		</tbody>
	</table>
	</div>
</body>