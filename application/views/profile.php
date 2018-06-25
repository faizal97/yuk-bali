<div class="container">
  <ol class="breadcrumb" style="margin-top: 70px">
  <li><a href="<?php echo base_url('') ?>">Beranda</a></li>
  <li class="active">Profil</li>
</ol></div>
<div class="card border-info mb-3" style="margin-top:10px;width:75%;margin-left: 160px">
<div class="container" style="width: 100%; margin-right: : 50px; margin-top: 30px; font-size: 14pt; font-weight: bold">

            <div class="col-sm-7">
            <a href="<?php echo base_url('') ?>"><button type="button" class="btn btn-primary"><span class="far fa-edit"> Ubah Profil</span></button></a>
                <i class=""></i><?php echo strtoupper($nama_depan." ".$nama_belakang) ?><hr>
                <i></i>Username : <?php echo $username ?><hr>
                <i class="far fa-envelope"></i> <?php echo $row->email ?><hr>
                <i class="far fa-calendar-alt"></i><?php echo $row->tgl_lahir ?>  <hr>
                <i class="fas "> <?php echo $row->jenis_kelamin ?></i><hr>
                <i class="fas fa-home"> <?php echo $row->alamat ?> </i><hr></p> <br><br>
              
                    </div>


    <div class="row">
        <div class="col-sm-4">
        <img src="<?php echo base_url($this->session->foto_profil) ?>" alt="" class="img-rounded img-responsive">
        </div>
        <div class="col-sm-1">
        </div>

                </div>
        </div>
</div>
</div>
<br>