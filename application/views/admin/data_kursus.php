<div class="container" style="margin-top: 15px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a  href="<?php echo base_url('admin/beranda.html') ?>" >Beranda</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Kursus</li>
  </ol>
</nav>
</div>

<div class="container" style="margin-top: 35px">
<div class="card border-dark mb-3" style="width: 100%">
  <div class="card-header"><h2>Data Kursus</h2></div>
  <div class="card-body text-dark">

   <button onclick="konfirmasiHapus('all')" type="button" class="btn btn-danger">Hapus Data</button></a><br><br>

    <form class="form-inline" style="float: right;"  action="<?php echo base_url('admin/data_kursus/cari_data.html') ?>"  method="get">
     <input type="text" name="q" id="search_text" placeholder="Cari Data" class="form-control">
   </form>
   <br><br>

<div class="table-responsive" style="width:100%">  
    <div class="card-text">
    <table class="table table-bordered ">
  	<thead>
    <tr>
    	<th>No</th>
        <th>Nama Kursus</th>
        <th>Jumlah Materi</th>
        <th>Nama Pengajar</th>
        <th>Tanggal Dibuat </th>
        <th>Gambar Kursus</th>
        <th width="200">Tindakan</th>
    </tr>
    </thead>
    <tbody>
  	<?php
      $no = $nomor;
      foreach($tampil->result() as $kursus){
				$no++;
				$id_kursus = $kursus->id_kursus;
				$data_jumlah = $this->db->query("SELECT COUNT(tb_materi.id_materi) AS jumlah_materi FROM tb_materi WHERE id_kursus='$id_kursus'");
				$data_jumlah = $data_jumlah->row();
				$jumlah_materi = $data_jumlah->jumlah_materi
      ?>
      <tr>
      <td><?php echo $no ?> </td>
      <td ><?php echo $kursus->nama_kursus ?> </td>
      <td><?php echo $jumlah_materi ?> </td>
      <td><?php echo ($kursus->nama_depan."   ".$kursus->nama_belakang) ?> </td>
      <td><?php echo $kursus->tgl_buat ?></td>
      <td><img src="<?php echo base_url($kursus->gambar_kursus) ?>?<?php echo time() ?>" width="100" height="100" alt=""></td>

      <td><a href="<?php echo base_url('admin/data_kursus/lihat_kursus/'.$kursus->id_kursus.".html") ?>"><button type="button" class="btn btn-outline-success"><i class="fas fa-search"></i></button></a>

        <a href="<?php echo base_url('admin/data_kursus/ubah_kursus/'.$kursus->id_kursus.".html") ?>"><button type="button" class="btn btn-outline-primary"><i class="far fa-edit"></i></button></a> 

        <a href="<?php echo base_url('admin/data_kursus/hapus_kursus/'.$kursus->id_kursus.".html") ?>"><button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></a>

      </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
    </div>
 </div>
  </div>
<?php $this->functions->buatPagination('tb_kursus','admin/data_kursus.html',$aktif); ?>
</div>
    
</div>

<script type="text/javascript">
  function konfirmasiHapus(tipe) {
    let a = confirm("Anda Yakin Ingin Menghapus Data Ini?")
  if(a){
    window.location.assign("<?php echo base_url('kursus/data_kursus/hapus/semua') ?>")
  }
  }

</script>
