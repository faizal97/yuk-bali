<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/admin.css') ?>">
<script src="<?php echo base_url('js/menu.js') ?>"></script>
<div id="mySidenav" class="sidenav" style="background-color:#292F33">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="<?php echo base_url('admin/beranda.html') ?>"  style="border-bottom: 1px solid">Beranda</a>
 <button class="dropdown-btn" style="border-bottom: 1px solid ">Data
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a  href="<?php echo base_url('admin/data_admin.html') ?>" style="border-bottom: 1px solid ">Data Admin</a>
    <a  href="<?php echo base_url('admin/data_kategori.html') ?>"  style="border-bottom: 1px solid ">Data Kategori</a>
    <a href="<?php echo base_url('admin/data_pelajar.html') ?>"  style="border-bottom: 1px solid ">Data Pelajar</a>
    <a href="<?php echo base_url('admin/data_pengajar.html') ?>" style="border-bottom: 1px solid ">Data Pengajar</a>
    <a href="<?php echo base_url('admin/data_kursus.html') ?>" style="border-bottom: 1px solid ">Data Kursus</a>
  </div>

 <button class="dropdown-btn" style="border-bottom: 1px solid ">Laporan
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="<?php echo base_url('admin/laporan/kursus.html')?>" target="_BLANK" style="border-bottom: 1px solid ">Laporan Kursus</a>
  </div>
<a href="<?php echo base_url('admin/keluar.html')?>" style="border-bottom: 1px solid">Keluar</a>
</div>
</div>

<div class="animated slideInDown" style="background-color:#292F33">
<span style="font-size:30px;margin-left:150px;color:white;cursor:pointer" onclick="openNav(); ">&#9776; </span>
<span id=tgl-skrg style="color:white; float:right;margin-right:20px; margin-top: 10px" ></span>
<span style="color:white; float:right;margin-right:20px; margin-top: 10px" >Halo, <?php echo $_SESSION['nm_depan'] ?></span>
</div>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
     

