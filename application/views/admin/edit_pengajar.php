<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a  href="<?php echo base_url('admin/beranda.html') ?>" >Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/data_pengajar.html') ?>">Data Pengajar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah Data Pengajar</li>
  </ol>
</nav>
</div>

<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%;">
  <div class="card-header"><h2>Ubah Data pengajar</h2></div>
  <div class="card-body text-dark">
    <div class="card-text">

  <form action="<?php echo base_url('admin/data_pengajar/ubah_pengajar/proses/'.$data_pengajar->id_pengajar.".html") ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Depan</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nama_depan" name="nama_depan"  value="<?php echo $data_pengajar->nama_depan ?>" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" / required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Belakang</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nama_belakang" name="nama_belakang"  value="<?php echo $data_pengajar->nama_belakang ?>" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" / required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Upvote</label>
    <div class="col-sm-10">
      <input class="form-control"  name="upvote" disabled value="<?php echo $data_pengajar->upvote ?>">
    </div>
  </div>


  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Downvote</label>
    <div class="col-sm-10">
    <input type="text" class="form-control"  name="downvote" disabled value="<?php echo ($data_pengajar->downvote) ?>">
    </div>
  </div>

  <div class="form-group row">
  <label class="col-sm-2 col-form-label">Foto Profil</label>
	<div class="col-sm-10">
  <div class="input-group">
  <div class="custom-file">
  
    <input type="file" class="custom-file-input" id="">
    <label class="custom-file-label" for="inputGroupFile04" name="foto_profil" >Pilih File</label>
  </div>
  </div>
  </div>
  </div>

<br>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10" style="margin-left: -15px">
        <a href=""><button type="button" class="btn btn-primary">Simpan</button></a>
        <a href=""><button type="button" class="btn btn-secondary">Batal</button></a>
       </div>
       </div> 
</form>
</div>
</div>
</div>
</div>
</div>
