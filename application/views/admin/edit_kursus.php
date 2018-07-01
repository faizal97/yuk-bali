<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a  href="<?php echo base_url('admin/beranda.html') ?>" >Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/data_kursus.html') ?>">Data Kursus</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah Data Kursus</li>
  </ol>
</nav>
</div>

<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%;">
  <div class="card-header"><h2>Ubah Data Kursus</h2></div>
  <div class="card-body text-dark">
    <div class="card-text">

  <form action="<?php echo base_url('admin/data_kursus/ubah_kursus/proses/'.$data_kursus->id_kursus.".html") ?>" method="POST" enctype="multipart/form-data">

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Kursus</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nama_depan" name="nama_kursus"  value="<?php echo $data_kursus->nama_depan ?>" required>
    </div>
  </div>

   <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Pengajar</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nama_belakang" disabled name="" value="<?php echo ($data_kursus->nama_depan."   ".$kursus->nama_belakang) ?>" required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal Dibuat</label>
    <div class="col-sm-10">
      <input type="date"  class="form-control"  name="tgl_buat" value="<?php echo $data_kursus->tgl_buat?>">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Deskripsi Kursus</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control"  name="deskripsi_kursus" value="<?php echo $data_kursus->deskripsi_kursus?>">
    </div>
  </div>

  <div class="form-group row">
  <label class="col-sm-2 col-form-label">Gambar Kursus</label>
	<div class="col-sm-10">
  <div class="input-group">
  <div class="custom-file">
  
    <input type="file" class="custom-file-input" id="">
    <label class="custom-file-label" for="inputGroupFile04" name="gambar_kursus" >Pilih File</label>
  </div>
  </div>
  </div>
  </div>

<br>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10" style="margin-left: -15px">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="submit" class="btn btn-secondary">Batal</button>
       </div>
       </div> 
</form>
</div>
</div>
</div>
</div>
</div>
