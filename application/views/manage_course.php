<div class="container-fluid" align="center">
    <label for="nama_kursus" style="margin-right:400px">Nama Kursus :</label>
    <input type="text" name="nama_kursus" id="nama_kursus" class="form-control" style="width:500px" value="<?php echo $data->nama_kursus ?>">

    <label for="kategori" style="margin-right:420px">Kategori :</label>
    <select class="form-control" style="width:500px" name="kategori" id="kategori">
        <?php 
            foreach ($kategori->result() as $row) {
                if ($data->id_kategori==$row->id_kategori){
                    $pilih = "selected='selected'";
                }
                else{
                    $pilih ="";
                }
                echo "<option value='$row->id_kategori' $pilih>$row->nama_kategori</option>";
            }
        ?>
    </select>
    <label for="gambar_kursus" style="margin-right:400px">Gambar Kursus :</label>
    <img src="<?php echo base_url().$data->gambar_kursus ?>" style="width:500px;height:300px" class="form-control">
    
    <label for="deskripsi_kursus" style="margin-right:400px">Deskripsi Kursus :</label>
    <textarea name="deskripsi_kursus" id="deskripsi_kursus" class="form-control" style="width:500px"><?php echo $data->deskripsi ?></textarea>
    
    <a href="<?php echo base_url() ?>kelola_kursus/hapus/<?php echo str_replace(" ","_",$title) ?>.html"><button class="btn btn-danger">HAPUS KURSUS</button></a>
    <a href="<?php echo base_url('kursusku.html') ?>"><button class="btn btn-success">Kembali</button></a>
    <a href="<?php echo base_url('kelola_kursus/kelola_materi/'.str_replace(" ","_",$title))?>"><button class="btn btn-primary">Kelola Materi</button></a>
</div>