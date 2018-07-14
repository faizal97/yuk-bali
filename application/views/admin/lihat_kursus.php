<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a  href="<?php echo base_url('admin/beranda.html') ?>" >Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/data_kursus.html') ?>">Data Kursus</a></li>
    <li class="breadcrumb-item active" aria-current="page">	Lihat Kursus</li>
  </ol>
</nav>
</div>
<a class="btn btn-primary" href="<?php echo base_url('admin/data_kursus.html') ?>">Kembali</a>
<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%;">
  <div class="card-header"><h2>Lihat Data Kursus</h2></div>
  <div class="card-body text-dark">
    <div class="card-text">

  <form action="<?php echo base_url('admin/data_kursus/ubah_kursus/proses/'.$data_kursus->id_kursus.".html") ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Kursus</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" name="nama_kursus" value="<?php echo $data_kursus->nama_kursus ?>">
  </div>
</div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Pengajar</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" name="" value="<?php echo ($data_kursus->nama_depan." ".$data_kursus->nama_belakang) ?>">
  </div>
</div>

<div class="table-responsive" style="width:100%">  
    <div class="card-text">
    <table class="table table-bordered ">
  	<thead>
    <tr>
    	<th>No</th>
        <th>Nama Materi</th>
        <th>Url Video</th>
				<th>Aksi</th>
    </tr>
    </thead>
    <tbody>
  	<?php
      foreach($data_materi->result() as $kursus){
      ?>
      <tr>
      <td><?php echo $kursus->urut ?> </td>
      <td ><?php echo $kursus->nama_materi ?> </td>
      <td><?php echo $kursus->url_video ?> </td>
			<td><a href="<?php echo base_url('admin/data_kursus/lihat_kursus/'.$kursus->id_kursus.'/'.$kursus->id_materi.".html") ?>"><button type="button" class="btn btn-outline-success"><i class="fas fa-search"></i></button></a>
			<!-- <a href="<?php //echo base_url('admin/data_kursus/ubah_kursus/'.$kursus->id_kursus.'/'.$kursus->id_materi.".html") ?>"><button type="button" class="btn btn-outline-primary"><i class="far fa-edit"></i></button></a> 
			<a href="<?php //echo base_url('admin/data_kursus/hapus_kursus/'.$kursus->id_kursus.'/'.$kursus->id_materi.".html") ?>"><button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></a> -->
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
