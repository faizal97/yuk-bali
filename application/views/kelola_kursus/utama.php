<style>
.jarak-bawah {
	margin-bottom:10px;
}
.menu-utama:hover {
	background-color:rgb(0,0,0,0.2);
	cursor:pointer;
}
</style>
<div class="container-fluid">
	<h1>Menu Utama</h1>

	<div class="row">
		<div class="col-sm-6 jarak-bawah">
			<a onclick="bukamenu('materi')" style="text-decoration:none;color:black">
				<div class="card menu-utama">
					<div class="card-body">
						<img src="<?php echo base_url('img/thumbnail_menu/kelola_kursus/materi.png') ?>" width="300" height="200" alt="">
						<h1 class="card-text text-center">Materi</h1>
					</div>
				</div>
			</a>
		</div>
		<div class="col-sm-6 jarak-bawah">
			<a onclick="bukamenu('soal')" style="text-decoration:none;color:black">
				<div class="card menu-utama">
					<div class="card-body">
						<img src="<?php echo base_url('img/thumbnail_menu/kelola_kursus/soal.png') ?>" width="300" height="200" alt="">
						<h1 class="card-text text-center">Soal</h1>
					</div>
				</div>
			</a>
		</div>
		<div class="col-sm-6 jarak-bawah">
			<a onclick="bukamenu('laporan')" style="text-decoration:none;color:black">
				<div class="card menu-utama">
					<div class="card-body">
						<img src="<?php echo base_url('img/thumbnail_menu/kelola_kursus/report.png') ?>" width="300" height="200" alt="">
						<h1 class="card-text text-center">Laporan</h1>
					</div>
				</div>
			</a>
		</div>
		<div class="col-sm-6 jarak-bawah">
			<a onclick="bukamenu('pengaturan')" style="text-decoration:none;color:black">
				<div class="card menu-utama">
					<div class="card-body">
						<img src="<?php echo base_url('img/thumbnail_menu/kelola_kursus/setting.png') ?>" width="300" height="200" alt="">
						<h1 class="card-text text-center">Pengaturan</h1>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
<script>
	function bukamenu(id) {
		$('a[href="#' + id + '"]').tab('show');
	}
</script>

