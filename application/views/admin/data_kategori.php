<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Kategori</li>
  </ol>
</nav>
</div>

<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%">
  <div class="card-header"><h2>Data Kategori</h2></div>
  <div class="card-body text-dark">
    <a href="<?php echo base_url('admin/data_kategori/tambah_kategori.html') ?>"><button type="button" class="btn btn-primary">Tambah Data</button></a>

   <button onclick="konfirmasiHapus('all')" type="button" class="btn btn-danger">Hapus Data</button></a><br><br>

    <form class="form-inline" style="float: right;"  action="<?php echo base_url('admin/data_kategori/cari_data.html') ?>"  method="get">
     <input type="text" name="q" id="search_text" placeholder="Cari Data" class="form-control">
   </form>
   <br><br>

    <div class="card-text">
    <table class="table table-bordered">
  	<thead>
    <tr>
    	<th>No</th>
        <th>Nama Kategori</th>
        <th>Tindakan</th>
    </tr>
    </thead>
    <tbody>
  	<?php
      $no = $nomor;
      foreach($tampil->result() as $kategori){
        $no++;
      ?>
      <tr>
      <td><?php echo $no ?> </td>
      <td><?php echo $kategori->nama_kategori ?> </td>
      <td><a href="<?php echo base_url('admin/data_kategori/ubah_kategori/'.$kategori->id_kategori.".html") ?>"><button type="button" class="btn btn-outline-primary"><i class="far fa-edit"></i></button></a> 
        <a href="<?php echo base_url('admin/data_kategori/hapus_kategori/'.$kategori->id_kategori.".html") ?>"><button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></a>
      </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
    </div>
 
  </div>
<?php $this->functions->buatPagination($query_kategori,$link,$aktif); ?>
</div>
    
</div>

<script type="text/javascript">
  function konfirmasiHapus(tipe) {
    let a = confirm("Anda Yakin Ingin Menghapus Data Ini?")
  if(a){
    window.location.assign("<?php echo base_url('admin/data_kategori/hapus/semua') ?>")
  }
  }

</script>