<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a  href="<?php echo base_url('admin/beranda.html') ?>" >Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/data_kursus.html') ?>">Data Kursus</a></li>
    <li class="breadcrumb-item active" aria-current="page">	Lihat Kursus</li>
  </ol>
</nav>
</div>
<a class="btn btn-primary" style="margin-left:120px" href="<?php echo base_url('admin/data_kursus/lihat_kursus/'.$id_kursus.'.html') ?>">Kembali</a>
<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%;">
  <div class="card-header"><h2>Lihat Data Kursus</h2></div>
  <div class="card-body text-dark">
    <div class="card-text">

  <form action="<?php echo base_url('admin/data_kursus/ubah_kursus/proses/'.$data_materi->id_kursus.".html") ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">No Urut</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" name="nama_kursus" value="<?php echo $data_materi->urut ?>">
  </div>
</div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Materi</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" name="" value="<?php echo $data_materi->nama_materi ?>">
  </div>
</div>

<div class="table-responsive" style="width:100%">  
    <div class="card-text">
    <table class="table table-bordered ">
  	<thead>
    <tr>
    	<th>No</th>
        <th>Pertanyaan</th>
        <th>Piliahan 1</th>
		<th>Piliahan 2</th>
		<th>Piliahan 3</th>
		<th>Piliahan 4</th>
		<th>Jawaban</th>
		<!-- <th>Aksi</th> -->
    </tr>
    </thead>
    <tbody>
  	<?php
	  $no = 0;
      foreach($data_soal->result() as $kursus){
		$no++;
		$jawab = 'pilihan'. $kursus->jawaban;
      ?>
      <tr>
      <td><?php echo $no ?> </td>
      <td ><?php echo $kursus->nama_soal ?> </td>
      <td><?php echo $kursus->pilihan1 ?> </td>
	  <td><?php echo $kursus->pilihan2 ?> </td>
	  <td><?php echo $kursus->pilihan3 ?> </td>
	  <td><?php echo $kursus->pilihan4 ?> </td>
	  <td><?php echo $kursus->$jawab ?> </td>
			<td>
			<!-- <a href="<?php //echo base_url('admin/data_kursus/ubah_kursus/'.$id_kursus.'/'.$kursus->id_materi.".html") ?>"><button type="button" class="btn btn-outline-primary"><i class="far fa-edit"></i></button></a> 
			<a href="<?php //echo base_url('admin/data_kursus/hapus_kursus/'.$id_kursus.'/'.$kursus->id_materi.".html") ?>"><button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></a> -->
			</td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
</form>
</div>
</div>
</div>
</div>
