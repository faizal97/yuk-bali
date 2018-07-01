<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a  href="<?php echo base_url('admin/beranda.html') ?>" >Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/data_admin.html') ?>">Data Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah Data Admin</li>
  </ol>
</nav>
</div>

<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%;">
  <div class="card-header"><h2>Ubah Data Admin</h2></div>
  <div class="card-body text-dark">
    <div class="card-text">

  <form action="<?php echo base_url('admin/data_admin/ubah_admin/proses/'.$data_admin->id_admin.".html") ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Depan</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nm_depan" name="nm_depan"  value="<?php echo $data_admin->nm_depan ?>" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" / required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Belakang</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nm_belakang" name="nm_belakang" value="<?php echo $data_admin->nm_belakang ?>" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" / required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username_admin" name="username_admin" value="<?php echo $data_admin->username_admin ?>" required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Kata Sandi Lama</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="pass_lama" name="pass_lama" >
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Kata Sandi Baru</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="pass_baru" name="pass_baru">
    </div>
  </div>
<br>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10" style="margin-left: -15px">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href=""><button type="button" class="btn btn-secondary">Batal</button></a>
       </div>
       </div> 
</form>
</div>
</div>
</div>
</div>
</div>
