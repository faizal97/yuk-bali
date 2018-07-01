<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a  href="<?php echo base_url('admin/beranda.html') ?>" >Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/data_kategori.html') ?>">Data Katgeori</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Katgeori</li>
  </ol>
</nav>
</div>
<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%;">
  <div class="card-header"><h2>Tambah Data Kategori</h2></div>
  <div class="card-body text-dark">
    <div class="card-text">

  <form  action="<?php echo base_url('admin/data_kategori/tambah_kategori/proses.html') ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Kategori</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" / required="" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" />
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