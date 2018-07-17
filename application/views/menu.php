<?php
	$dat_kat = $this->db->query("SELECT * FROM tb_kategori ORDER BY nama_kategori ASC");
?>
<style>
#menu_wrapper {
    width:100%;
    position:absolute;
	/* background-color:white;
	border-bottom:3px solid red; */
    top:-100px;
}
.nav-item {
    font-size:13pt;
}
</style>
<div id="menu_wrapper">
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <a href="<?php echo base_url('welcome.html') ?>" class="navbar-brand">
        <img id="logo" src="<?php echo base_url('img/logo.png') ?>" width="100px" alt="brand" />
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
			<a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="oi oi-grid-three-up"></span>&nbsp;&nbsp;Kategori</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<?php foreach ($dat_kat->result() as $row) { ?>
				<?php if($row->nama_kategori=='Others'){continue;} ?>
				<a class="dropdown-item" href="<?php echo base_url('kategori/'.$row->id_kategori.'.html') ?>"><?php echo $row->nama_kategori ?></a>
			<?php } ?>
			<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Others</a>
        	</div>
		</li>
            <li class="nav-item">
                <form  id="mnFrmCari" class="input-group mb-3" action="<?php echo base_url('search.html') ?>" method="get">
                    <input type="search" placeholder="Cari Kursus" class="form-control form-control-sm" name="q" id="tmenucari">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-light"><span class="oi oi-magnifying-glass"></span></button>
                        </div>                    
                </form>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="#" class="nav-link text-light" data-toggle="modal" data-target="#pengajar"><span class="oi oi-briefcase"></span>&nbsp;&nbsp;Menjadi Pengajar</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item"><a class="nav-link text-light" href="<?php echo base_url('masuk.html') ?>"><span class="oi oi-account-login"></span>&nbsp;&nbsp;Masuk</a></li>
            <li class="nav-item"><a class="nav-link text-light" href="<?php echo base_url('daftar.html') ?>"><span class="oi oi-person"></span>&nbsp;&nbsp;Daftar</a></li>
        </ul>
    </div>
</nav>
</div>

<div class="modal fade" id="pengajar">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Header -->
			<div class="modal-header">
				<h4 class="modal-title">Menjadi Pengajar</h4>
			</div>

			<!-- Body -->
			<div class="modal-body">
				<form action="<?php echo base_url('daftar_pengajar.html') ?>" method="post">
				<div class="form-group">
				<input type="text" autofocus style="" class="textbox form-control" name="nama_lengkap" id="nama-lengkap" value="" placeholder="Nama Lengkap" required="required" onkeyup="this.value = this.value.replace(/[^a-z, A-Z]/, '')" />

				<br><input type="email" class="textbox form-control" name="email" value="" id="email" placeholder="E-Mail" required="required">

				<br><input type="password" id="pass" class="textbox form-control" name="password" id="password" value="" placeholder="Kata Sandi" required="required" title =" 8 karakter kata sandi. Gunakan Huruf kecil, huruf besar dan angka" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
				
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success tombol" data-toggle="modal" data-target="#konfirmasi">Daftar</button>
				<button type="button" class="btn btn-danger tombol" data-dismiss="modal">Tutup</button>
			</div>
				</form>
			</div>
		</div>
	</div>
</div>
