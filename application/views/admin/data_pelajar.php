<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data pelajar</li>
  </ol>
</nav>
</div>

<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%">
  <div class="card-header"><h2>Data Pelajar</h2></div>
  <div class="card-body text-dark">

   <button onclick="konfirmasiHapus('all')" type="button" class="btn btn-danger">Hapus Data</button></a><br><br>

    <form class="form-inline" style="float: right;"  action="<?php echo base_url('admin/data_pelajar/cari_data.html') ?>"  method="get">
     <input type="text" name="q" id="search_text" placeholder="Cari Data" class="form-control">
   </form>
   <br><br>

<div class="table-responsive" style="width:100%">  
    <div class="card-text">
    <table class="table table-bordered ">
  	<thead>
    <tr>
    	<th>No</th>
        <th>Nama Lengkap</th>
        <th>Email</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Foto Profil</th>
        <th>Tindakan</th>
    </tr>
    </thead>
    <tbody>
  	<?php
      $no = $nomor;
      foreach($tampil->result() as $pelajar){
        $no++;
      ?>
      <tr>
      <td><?php echo $no ?> </td>
      <td ><?php echo ($pelajar->nama_depan."   ".$pelajar->nama_belakang) ?> </td>
      <td><?php echo $pelajar->email ?> </td>
      <td><?php echo $pelajar->tgl_lahir ?> </td>
      <td><?php echo $pelajar->jenis_kelamin ?> </td>
      <td><?php echo $pelajar->alamat ?> </td>
      <td><?php echo $pelajar->foto_profil ?> </td>
      <td><a href="<?php echo base_url('admin/data_pelajar/ubah_pelajar/'.$pelajar->id_pelajar.".html") ?>"><button type="button" class="btn btn-outline-primary"><i class="far fa-edit"></i></button></a> 
        <a href="<?php echo base_url('admin/data_pelajar/hapus_pelajar/'.$pelajar->id_pelajar.".html") ?>"><button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></a>
      </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
    </div>
 </div>
  </div>
<?php $this->functions->buatPagination($query_pelajar,$link,$aktif); ?>
</div>
    
</div>

<script type="text/javascript">
  function konfirmasiHapus(tipe) {
    let a = confirm("Anda Yakin Ingin Menghapus Data Ini?")
  if(a){
    window.location.assign("<?php echo base_url('pelajar/data_pelajar/hapus/semua') ?>")
  }
  }

</script>