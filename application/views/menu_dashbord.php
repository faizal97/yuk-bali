<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
    <a href="#" class="navbar-brand">
        <img src="<?php echo base_url() ?>img/logo.png" width="100px" alt="brand" />
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
        <li class='nav-item'><a class='nav-link' href='<?php echo base_url() ?>home.html'><span class='oi oi-home'></span>&nbsp;&nbsp;Beranda</a></li>
        <li class="nav-item"><a href="" class="nav-link">Kategori</a></li>
		<li class="nav-item"><a href="" class="nav-link">Eksplor</a></li>
		</ul>
        <ul class="navbar-nav ml-auto">
			<li class="nav-item"><a href="" class="nav-link">Kursus Terdaftar</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                    <img class="rounded-circle" width="40px" src="<?php echo base_url().$_SESSION['gambar_profil'] ?>" alt="profil">&nbsp;&nbsp;
                    <?php echo $_SESSION['nama_depan'] ?>
                </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div href="#" class="dropdown-header">Masuk sebagai <strong><?php echo $_SESSION['nama_depan']." ".$_SESSION['nama_belakang'] ?></strong></div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url() ?>profil.html"><span class="oi oi-person"></span>&nbsp;&nbsp;Profil</a>
                <a class="dropdown-item" href="#"><span class="oi oi-wrench"></span>&nbsp;&nbsp;Edit Profil</a>
                <?php if($_SESSION['instructor']==true){ ?>
                    <a class="dropdown-item bg-success" href="<?php echo base_url('kursusku.html') ?>"><span class="oi oi-book"></span>&nbsp;&nbsp;Kursusku</a>
                <?php }else{ ?>
                    <a class="dropdown-item bg-warning" href="<?php echo base_url('aktivasi_pengajar.html') ?>"><span class="oi oi-briefcase"></span>&nbsp;&nbsp;Jadi Pengajar</a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url() ?>keluar.html"><span class="oi oi-account-logout"></span>&nbsp;&nbsp;Keluar</a>
            </div>
            </li>
        </ul>
    </div>
</nav>
