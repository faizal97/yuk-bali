<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/error.css">

    
            <div class="display-1 animated zoomInLeft" style="margin-top: 100px;margin-left:300px"> 
                Oopps !<br>
            </div>
            <label class ="display-4 animated lightSpeedIn" style="font-size: 300%;text-align: center;margin-left:300px"> Maaf halaman <br> yang anda cari<br> tidak ditemukan</label>
            
            <img id="gambar" class="animated bounceInDown" src="<?php echo base_url('img/error1.png')?>" >
    

<script>

var imageSources = ["<?php echo base_url('img/error2.png')?>"]

var index = 0;
setInterval (function(){
  if (index === imageSources.length) {
    index = 0;
  }
  document.getElementById("gambar").src = imageSources[index];
  index++;

} , 6000) 


</script>