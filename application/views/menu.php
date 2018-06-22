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
        <img src="<?php echo base_url('img/logo.png') ?>" width="100px" alt="brand" />
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link text-light"  href="#"><span class="oi oi-grid-three-up"></span>&nbsp;&nbsp;Kategori</a></li>
            <li class="nav-item">
                <form  id="mnFrmCari" class="input-group mb-3" action="">
                    <input type="search" placeholder="Cari Kursus" class="form-control form-control-sm" name="tcari" id="tmenucari">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-light"><span class="oi oi-magnifying-glass"></span></button>
                        </div>                    
                </form>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link text-light" href="#"><span class="oi oi-briefcase"></span>&nbsp;&nbsp;Menjadi Pengajar</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item"><a class="nav-link text-light" href="<?php echo base_url('masuk.html') ?>"><span class="oi oi-account-login"></span>&nbsp;&nbsp;Masuk</a></li>
            <li class="nav-item"><a class="nav-link text-light" href="<?php echo base_url('daftar.html') ?>"><span class="oi oi-person"></span>&nbsp;&nbsp;Daftar</a></li>
        </ul>
    </div>
</nav>
</div>
