<link rel="stylesheet" href="<?php echo base_url('css/admin.css') ?>">
<div class="sejajar"style="margin-bottom: 350px">
<label id="haloadmin"> Selamat Datang,<br> Admin </label>
    <div class="samping">
    
        <div id="kotak1" class="animated zoomIn">
            <img id="logokotak1" src="<?php echo base_url('img/beranda/decul.png') ?>" >
            <h4> Data Pelajar</h4>
            <label id="ket"> Mempunyai Data Sebanyak : <?php echo $jumlah_pelajar ?> Data Pelajar</label>
        </div>
        <div id="kotak2" class="animated zoomIn" style="margin-left:470px">
            <img id="logokotak2" src="<?php echo base_url('img/beranda/pengajaar.png') ?>" >
            <h4> Data Pengajar</h4>
            <label id="ket"> Mempunyai Data Sebanyak : <?php echo $jumlah_pengajar ?> Data Pengajar</label>
        </div>
    </div>
    <div class="samping" class="animated zoomIn" style="margin-top:370px">
        <div id="kotak3">
            <img id="logokotak3" src="<?php echo base_url('img/beranda/course.png') ?>" >
            <h4> Data Kursus</h4>
            <label id="ket"> Mempunyai Data Sebanyak : <?php echo $jumlah_kursus ?> Data Kursus</label>
        </div>
        <div id="kotak4" class="animated zoomIn" style="margin-left:470px">
            <img id="logokotak4" src="<?php echo base_url('img/beranda/laporan.png') ?>" >
            <h4 style="margin-bottom:45px"> Data Laporan</h4>
            
        </div>
    </div>
</div>
<script>
(function() {

var quotes = $("#haloadmin");
var quoteIndex = 1;

function showNextQuote() {
    
    quotes.eq(quoteIndex % quotes.length)
        .fadeIn(2000)
        .delay(2000)
        .fadeOut(2000, showNextQuote);
}

showNextQuote();

})();
</script>
