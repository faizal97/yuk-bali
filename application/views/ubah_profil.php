<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a  href="<?php echo base_url('home.html') ?>" >Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('profil.html') ?>">Profil</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah Profil</li>
  </ol>
</nav>
</div>

<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%;">
  <div class="card-header"><h2>Ubah Profil</h2></div>
  <div class="card-body text-dark">
    <div class="card-text">

  <form action="<?php echo base_url('ubah_profil/proses.html') ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Depan</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nama_depan" name="nama_depan"  value="<?php echo $data_pelajar->nama_depan ?>" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" / required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Belakang</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="nama_belakang" name="nama_belakang"  value="<?php echo $data_pelajar->nama_belakang ?>" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" / required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email"  value="<?php echo $data_pelajar->email ?>" required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
    <div class="col-sm-10">
      <input type="date"  class="form-control"  name="tgl_lahir"  value="<?php echo $data_pelajar->tgl_lahir ?>">
    </div>
  </div>

<div class="form-group row">
<label class="col-sm-2 col-form-label" style="margin-left:">Jenis Kelamin</label>

<div class="form-check form-check-inline">
<div class="col-sm-10">
 <input type="radio"  required value="Laki-Laki" <?php if ($data_pelajar->jenis_kelamin=='Laki-Laki'){echo"checked";} ?> name="jenis_kelamin">
  <label class="form-check-label">Laki-Laki</label>
</div>
<div class="form-check form-check-inline">
  <input type="radio"  required value="Perempuan" <?php if ($data_pelajar->jenis_kelamin=='Perempuan'){echo"checked";} ?> name="jenis_kelamin">
  <label class="form-check-label" >Perempuan</label>
</div>
</div>
</div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-10">
    <textarea required class="form-control" name="alamat" rows="4" cols="96" name="alamat"  placeholder="Masukan Alamat Lengkap"><?php echo ($data_pelajar->alamat) ?></textarea>
    </div>
  </div>

  <div class="form-group row">
  <label class="col-sm-2 col-form-label">Foto Profil</label>
	<div class="col-sm-10">
  <div class="input-group">
  <div class="custom-file">
  
    <input name="foto_profil" type="file" class="custom-file-input" id="">
    <label class="custom-file-label" for="inputGroupFile04"  >Pilih Berkas</label>
  </div>
  </div>
  </div>
  </div>

<br>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10" style="margin-left: -15px">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn btn-secondary">Batal</button>
       </div>
       </div> 
</form>
</div>
</div>
</div>
</div>
</div>
