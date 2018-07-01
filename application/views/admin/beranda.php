<link rel="stylesheet" href="<?php echo base_url('css/admin.css') ?>">
<div class="sejajar"style="margin-bottom: 150px">
<label id="haloadmin"> Selamat Datang,<br>  <?php echo $_SESSION['nm_depan']." ".$_SESSION['nm_belakang'] ?> </label>
    <div class="samping">
    
        <div id="kotak1">
            <a style="color:white" href="<?php echo base_url('admin/data_pelajar.html') ?>" ><img id="logokotak1" src="<?php echo base_url('img/beranda/decul.png') ?>" >
            <h4> Data Pelajar</h4>
            <label id="ket"> Mempunyai Data Sebanyak : <?php echo $jumlah_pelajar ?> Data Pelajar</label></a>
        </div>

        <div id="kotak2" style="margin-left:470px">
          <a style="color:white" href="<?php echo base_url('admin/data_pengajar.html') ?>" > <img id="logokotak2" src="<?php echo base_url('img/beranda/pengajaar.png') ?>" >
            <h4> Data Pengajar</h4>
            <label id="ket"> Mempunyai Data Sebanyak : <?php echo $jumlah_pengajar ?> Data Pengajar</label></a>
        </div>
    </div>

    <div class="samping" style="margin-top:350px">
        <div id="kotak3">
           <a style="color:white" href="<?php echo base_url('admin/data_kursus.html') ?>" > <img id="logokotak3" src="<?php echo base_url('img/beranda/course.png') ?>" >
            <h4> Data Kursus</h4>
            <label id="ket"> Mempunyai Data Sebanyak : <?php echo $jumlah_kursus ?> Data Kursus</label></a>
        </div>

        <div id="kotak4" style="margin-left:470px">
           <a style="color:white" href=""><img id="logokotak4" src="<?php echo base_url('img/beranda/laporan.png') ?>" >
            <h4 style="margin-bottom:45px"> Data Laporan</h4></a>
            
        </div>
    </div>
</div>
<script>
(function() {

var quotes = $("#haloadmin");
var quoteIndex = 1;

function showNextQuote() {
    ++quoteIndex;
    quotes.eq(quoteIndex % quotes.length)
        .fadeIn(2000)
        .delay(2000)
        .fadeOut(2000, showNextQuote);
}

showNextQuote();

})();
</script>