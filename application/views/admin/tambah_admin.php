<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/data_admin.html') ?>"> Data Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Admin</li>
  </ol>
</nav>
</div>
<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%;">
  <div class="card-header"><h2>Tambah Data Admin</h2></div>
  <div class="card-body text-dark">
    <div class="card-text">

  <form  action="<?php echo base_url('admin/data_admin/tambah_admin/proses.html') ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Depan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nm_depan" name="nm_depan" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" / required="" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" />
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Belakang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nm_belakang" name="nm_belakang" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" / required onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" />
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username_admin" name="username_admin" required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Kata Sandi</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password_admin" name="password_admin" title =" 8 Karakter Kata Sandi. Gunakan huruf kapital, huruf kecil dan angka" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" >
    </div>
  </div>
<br>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10" style="margin-left: -15px">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="submit" class="btn btn-success">Batal</button>
       </div>
       </div> 
</form>
</div>
</div>
</div>
</div>
</div>