<?php
	$dat_kat = $this->db->query("SELECT * FROM tb_kategori ORDER BY nama_kategori ASC");
?>
<nav id="menu_dashbord" class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
    <a href="" class="navbar-brand">
        <img id="logo" src="<?php echo base_url() ?>img/logo.png" width="100px" alt="brand" />
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
        <li class='nav-item'><a id="mn_beranda" class='nav-link' href='<?php echo base_url() ?>home.html'><span class='oi oi-home'></span>&nbsp;&nbsp;Beranda</a></li>
        <li class="nav-item dropdown">
			<a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<?php foreach ($dat_kat->result() as $row) { ?>
				<?php if($row->nama_kategori=='Others'){continue;} ?>
				<a class="dropdown-item" href="<?php echo base_url('kursus/kategori/'.$row->id_kategori.'.html') ?>"><?php echo $row->nama_kategori ?></a>
			<?php } ?>
			<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Others</a>
        	</div>
		</li>
		<li class="nav-item"><a href="" class="nav-link">Eksplor</a></li>
		<li class="nav-item">
				<form action="<?php echo base_url('kursus/search.html') ?>" class="form-horizontal input-group" method="get">
					<input style="width:500px;margin-left:50px" type="search" placeholder="Cari Kursus" class="form-control form-control-sm" name="q" id="tmenucari">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-light"><span class="animated infinite pulse oi oi-magnifying-glass"></span></button>
                        </div>
				</form>
			</li>
		</ul>
        <ul class="navbar-nav ml-auto">
			<li class="nav-item"><a href="<?php echo base_url('kursus.html') ?>" class="nav-link">Kursus Saya</a></li>
			<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                    <img id="thumbnail_profil" class="rounded-circle" width="40px" src="<?php echo base_url().$_SESSION['gambar_profil'] ?>" alt="profil">&nbsp;&nbsp;
                    <?php echo $_SESSION['nama_depan'] ?>
                </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div href="#" class="dropdown-header">Masuk sebagai <strong><?php echo $_SESSION['nama_depan']." ".$_SESSION['nama_belakang'] ?></strong></div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url() ?>profil.html"><span class="oi oi-person"></span>&nbsp;&nbsp;Profil</a>
                <a class="dropdown-item" href="<?php echo base_url('ubah_profil.html') ?>"><span class="oi oi-wrench"></span>&nbsp;&nbsp;Ubah Profil</a>
                <?php if($_SESSION['instructor']==true){ ?>
                    <a class="dropdown-item bg-success" href="<?php echo base_url('kursusku.html') ?>"><span class="oi oi-book"></span>&nbsp;&nbsp;Kelola Kursus</a>
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

<script>
$('#menu_dashbord').animateCss('fadeInDown');
$('#thumbnail_profil').mouseenter(()=>{
	$('#thumbnail_profil').animateCss('tada');
});
$('#mn_beranda').mouseenter(()=>{
	$('#mn_beranda').animateCss('pulse');
	$('#mn_beranda').css('color','white');
});
$('#mn_beranda').mouseleave(()=>{
	$('#mn_beranda').css('color','');
});
$('#logo').mouseenter(()=>{
	$('#logo').animateCss('swing');
});
$('#logo').click(()=>{
	$('#logo').animateCss('bounce');
});
</script>
