<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a  href="<?php echo base_url('admin/beranda.html') ?>" >Beranda</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Pengajar</li>
  </ol>
</nav>
</div>

<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%">
  <div class="card-header"><h2>Data Pengajar</h2></div>
  <div class="card-body text-dark">

   <button onclick="konfirmasiHapus('all')" type="button" class="btn btn-danger">Hapus Data</button></a><br><br>

    <form class="form-inline" style="float: right;"  action="<?php echo base_url('admin/data_pengajar/cari_data.html') ?>"  method="get">
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
        <th>Jumlah Kursus</th>
        <th>Upvote</th>
        <th>Downvote</th>
        <th>Foto Profil</th>
        <th>Tindakan</th>
    </tr>
    </thead>
    <tbody>
  	<?php
      $no = $nomor;
      foreach($tampil->result() as $pengajar){
				$no++;
				$id_pengajar = $pengajar->id_pengajar;
				$data_jumlah = $this->db->query("SELECT COUNT(tb_kursus.id_kursus) AS jumlah_kursus FROM tb_kursus WHERE id_pengajar='$id_pengajar'");
				$data_jumlah = $data_jumlah->row();
				$jumlah_kursus = $data_jumlah->jumlah_kursus;
			?>
      <tr>
      <td><?php echo $no ?></td>
      <td ><?php echo ($pengajar->nama_depan." ".$pengajar->nama_belakang) ?> </td>
      <td><?php echo $jumlah_kursus ?></td>
      <td><?php echo $pengajar->upvote ?> </td>
      <td><?php echo $pengajar->downvote ?> </td>
      <td><img src="<?php echo base_url($pengajar->foto_profil) ?>?<?php echo time() ?>" width="100" height="100" alt=""> </td>
			<td class="text-center"><a href="<?php echo base_url('admin/data_pengajar/hapus_pengajar/'.$pengajar->id_pengajar.".html") ?>"><button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></a></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
    </div>
 </div>
  </div>
<?php $this->functions->buatPagination('tb_pengajar','admin/data_pengajar.html',$aktif); ?>
</div>
    
</div>

<script type="text/javascript">
  function konfirmasiHapus(tipe) {
    let a = confirm("Anda Yakin Ingin Menghapus Data Ini?")
  if(a){
    window.location.assign("<?php echo base_url('pengajar/data_pengajar/hapus/semua') ?>")
  }
  }

</script>
