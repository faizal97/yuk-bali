<div class="container">
  <ol class="breadcrumb" style="margin-top: 70px">
  <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>">Beranda</a></li>
  <li class="breadcrumb-item active">Profil</li>
</ol></div>
<div class="card border-info mb-3" style="margin-top:10px;width:75%;margin-left: 160px">
<div class="container" style="width: 100%; margin-right: : 50px; margin-top: 30px; font-size: 14pt; font-weight: bold">


    <div class="row">
		<div class="col-sm-6">
            <a href="<?php echo base_url('ubah_profil.html') ?>"><button type="button" class="btn btn-primary"><span class="far fa-edit"> Ubah Profil</span></button></a><br><br>
                <i class=""></i><?php echo strtoupper($data_profil->nama_depan." ".$data_profil->nama_belakang) ?><hr>
                <i class="far fa-envelope"></i> <?php echo $data_profil->email ?><hr>
                <i class="far fa-calendar-alt"></i><?php echo $data_profil->tgl_lahir ?>  <hr>
                <i class="fas "> <?php echo $data_profil->jenis_kelamin ?></i><hr>
                <i class="fas fa-home"> <?php echo $data_profil->alamat ?> </i><hr></p> <br><br>
			</div>
        <div class="col-sm-6">
        	<img src="<?php echo base_url($this->session->gambar_profil) ?>" width="400" alt="" class="img-rounded">
        </div>

                </div>
        </div>
</div>
<br>
