<div class="container-fluid">
<!-- breadcrumb -->
 <nav class="breadcrumb bg-white">
     <a class="breadcrumb-item" href="<?php echo base_url('home.html') ?>">Beranda</a>
     <span class="breadcrumb-item active">Kursus Saya</span>
 </nav>

	<div class="card" style="margin:10px">
        <div class="card-header">
            <h1 class="card-title">Kursus Saya</h1>
        </div>
        <div class="card-body">
        <a data-toggle="modal" href='#tambah-kursus' class="card-title btn btn-primary">Tambah Kursus</a>
        <a href="<?php echo base_url('kursusku/hapus_semua.html') ?>" class="card-title btn btn-danger">Hapus Semua</a>
            <div class="row">
                <?php $no=0;foreach ($query->result() as $row) {$no++; ?>
                <div class="col-sm-3">
                    <div class="card">
							<div id="tombol-sembunyi<?php echo $no ?>" onmouseover="tampil_tombol('<?php echo $no ?>')" style="position:absolute;border:1px solid black;width:100%;height:250px;background-color:rgb(0,0,0,0.8);opacity:0;" onmouseout="hilang_tombol('<?php echo $no ?>')">
                            	<a href="<?php echo base_url('kursusku/kelola/'.str_replace(" ","-",$row->nama_kursus).'.html') ?>" onmouseover="tampil_tombol('<?php echo $no ?>')" class="btn btn-primary" style="width:50%;margin-bottom:5px;margin-left:25%;margin-top:25%">Kelola</a>
                            	<a href="<?php echo base_url('kursusku/hapus/'.str_replace(" ","-",$row->nama_kursus).'.html') ?>" onmouseover="tampil_tombol('<?php echo $no ?>')" class="btn btn-danger" style="width:50%;margin-left:25%;margin-top:5%">Hapus</a>
							</div>
                        <img class="card-img-top" src="<?php echo base_url($row->gambar_kursus) ?>" width="300px" height="250px" alt="Card Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row->nama_kursus ?></h5>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>


        </div>

        <div class="card-footer">
        
        </div>
    </div>
</div>

<!-- Modal tambah kursus -->
<form action="<?php echo base_url('kursusku/tambah_kursus.html') ?>" method="POST"enctype="multipart/form-data">
 <div class="modal fade" id="tambah-kursus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Tambah Kursus</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php $this->load->view('mycourse_add');
             ?>
            </div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success" >Simpan</button>
				<button data-dismiss="modal" class="btn btn-danger">Tutup</button>
			</div>
        </div>
    </div>
 </div>
 </form>
<script>
let kolom_animasi = false;

function tampil_tombol(angka) {
	if(kolom_animasi==true){
		return;
	}
	kolom_animasi = true;
	$('#tombol-sembunyi').stop();
	$('#tombol-sembunyi'+angka).animate({
		opacity:1
	},1);
	kolom_animasi = false;
}
function hilang_tombol(angka) {
	if(kolom_animasi==true){
		return;
	}
	kolom_animasi = true;
	$('#tombol-sembunyi').stop();
	$('#tombol-sembunyi'+angka).animate({
		opacity:0
	},1);
	kolom_animasi = false;
}

var url_string = window.location.href;
var url = new URL(url_string);
var act_modal = url.searchParams.get("modal");
	if(act_modal != null){
		$('#'+act_modal).modal();
	}
</script>
