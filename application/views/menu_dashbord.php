<div class="container-fluid">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a href="#" class="navbar-brand">
        <img src="<?php echo base_url() ?>img/logo.png" width="100px" alt="brand" />
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
        <li class='nav-item'><a class='nav-link' href='<?php echo base_url() ?>home.html'><span class='oi oi-home'></span>&nbsp;&nbsp;Beranda</a></li>
        <?php if($_SESSION['status']=='instructor'){ ?>
        <li class='nav-item'><a class='nav-link' href='<?php echo base_url() ?>kursusku.html'><span class='oi oi-file'></span>&nbsp;&nbsp;Kursus</a></li>
        <?php };?>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                    <img class="rounded-circle" width="40px" src="<?php echo base_url().$_SESSION['gambar_profil'] ?>" alt="profil">&nbsp;&nbsp;
                    <?php echo $_SESSION['nama_depan'] ?>
                </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div href="#" class="dropdown-header">Masuk sebagai <strong><?php echo $_SESSION['username'] ?></strong></div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url() ?>profil.html"><span class="oi oi-person"></span>&nbsp;&nbsp;Profil</a>
                <a class="dropdown-item" href="#"><span class="oi oi-wrench"></span>&nbsp;&nbsp;Edit Profil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url() ?>keluar.html"><span class="oi oi-account-logout"></span>&nbsp;&nbsp;Keluar</a>
            </div>
            </li>
        </ul>
    </div>
</nav>
</div>