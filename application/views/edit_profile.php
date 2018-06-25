<div class="container">
  <ol class="breadcrumb" style="margin-top: 70px">
  <li><a href="<?php echo base_url('') ?>">Beranda</a></li>
  <li class="active">Profil</li>
</ol></div>

<div class="carad border-info mb-3">
	<div class="card-header">Ubah Profil</div>
	<div class="card-body text-dark">
	<div class="container" style="width: 100%">
  <form class="form-horizontal" action="<?php echo base_url('l') ?>" method="POST" enctype="multipart/form-data">

      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="<?php echo base_url() ?>" class="avatar img-circle" width="200px" height="200px" alt="avatar">
          
          <input type="file" name="upload_foto" value="" class="form-control">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        
        <form class="form-horizontal" role="form">
            <div class="form-group row">
            <label class="col-lg-3 control-label">Nama Depan </label>
            <div class="col-lg-8">
              <input class="form-control" name="" type="text"   autofocus onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" />
            </div>
          </div>

  			  <div class="form-group row">
            <label class="col-lg-3 control-label">Nama Belakang </label>
            <div class="col-lg-8">
              <input class="form-control" name="" type="text"   autofocus onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" />
            </div>
          </div>

             <div class="form-group row">
            <label class="col-lg-3 control-label">Username </label>
            <div class="col-lg-8">
              <input class="form-control" name="" >
            </div>
          </div>

           <div class="form-group row">
            <label class="col-lg-3 control-label">Email </label>
            <div class="col-lg-8">
              <input class="form-control" name="email" type="email">
            </div>
          </div>

            <div class="form-group row">
            <label class="col-lg-3 control-label">Tanggal Lahir </label>
            <div class="col-lg-8">
              <input class="form-control" name="tgl_lahir" type="date">
            </div>
          </div>

 			<div class="form-group row">
          <div class="form-check form-check-inline">
          	<label class="col-lg-3 control-label">Jenis kelamin </label>
 		 <input class="form-check-input" type="radio" name="" id="" value=""
 		 <label class="form-check-label" for="inlineRadio1">Perempuan</label>
		</div>
		<div class="form-check form-check-inline">
 		 <input class="form-check-input" type="radio" name="" id="" value="">
 		 <label class="form-check-label" for="">Laki-Laki</label>
 		</div>
 	</div>

            <div class="form-group row">
            <label class="col-lg-3 control-label">Alamat</label>
            <div class="col-lg-8">
              <textarea rows="4" class="form-control" cols="80" name="alamat"></textarea>
            </div>
          </div>

    </div><br><br>

    <div class="form-group" style="margin-left: 350px">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" class="btn btn-outline-primary"><span class="glyphicon glyphicon-save"> Simpan</span></button>
        </div>
        </div>
        </form>
        </div>
        </form>
        </div>
        </div>
        </div>