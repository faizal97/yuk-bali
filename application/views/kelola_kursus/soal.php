<?php
	$query_materi = $this->db->query("SELECT * FROM tb_soal JOIN tb_materi ON tb_materi.id_materi = tb_soal.id_materi WHERE tb_materi.id_kursus='$id_kursus' ORDER BY tb_materi.urut");
?>
<div class="container-fluid">
	<h1>Soal</h1>
	<a data-toggle="modal" href='#tambah-soal'>
		<button class="btn btn-primary">
			Tambah Soal
		</button>
	</a>	
	<a href="">
		<button class="btn btn-danger">
			Hapus Semua
		</button>
	</a>

	<table class="table">
		<thead>
			<tr>
				<td>No Materi</td>
				<td>Nama Materi</td>
				<td colspan="2">Aksi</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($query_materi->result() as $row) {?>
				<tr>
					<td><?php echo $row->urut ?></td>
					<td><?php echo $row->nama_materi ?></td>
					<td><a href="<?php echo base_url('kursusku/kelola/'.$this->functions->ubahURL($title).'/soal/'.$this->functions->ubahURL($row->nama_materi).'.html') ?>" class="btn btn-success">Kelola</a></td>
					<td><a href="#" class="btn btn-danger">Hapus</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<!-- Modal tambah kursus -->
<form action="<?php echo base_url('kursusku/kelola/'.str_replace(" ","-",$title).'/tambah_soal.html') ?>" method="POST" enctype="multipart/form-data">
 <div class="modal fade" id="tambah-soal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Tambah Soal</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php $this->load->view('kelola_kursus/tambah_soal');
             ?>
            </div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success" >Simpan</button>
				<button data-dismiss="modal" class="btn btn-danger">Tutup</button>
			</div>
        </div>
    </div>
 </div>
 </form>
