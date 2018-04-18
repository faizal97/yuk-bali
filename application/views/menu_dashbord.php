<div id="menu" class="sticky-top" style="border:1px solid black;margin-left:5px;margin-right:5px;background:black;font-size:20pt">
|&nbsp;
<?php
    foreach ($menu ->result() as $row) {
        echo "<a href='".base_url()."$row->halaman_tujuan'>$row->nama_menu</a>";
        echo "&nbsp;|&nbsp;";
    }
?>
</div>