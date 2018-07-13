<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/home.css">
    <div id="content">
        <div id="home" style="background-image:url('<?php echo base_url('img/background/index.png') ?>')">
                <div class="" id="hcari">
                    <form  id="frmCari" class="input-group mb-3" action="<?php echo base_url('search.html') ?>" method="get">
                        <input type="search" placeholder="Apa Yang Ingin Dipelajari ?" class="form-control form-control-lg" name="q" id="tcari" autofocus>
                        <div class="input-group-append">
                            <button type="submit" id="cari" class="btn btn-primary"><span class="oi oi-magnifying-glass"></span></button>
                        </div>                    
                    </form>
                </div>
    </div>
    <script src="<?php echo base_url('js/home.js') ?>"></script>
