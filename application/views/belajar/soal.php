<div class="container">
	<div class="card mt-10 mb-10" style="margin-top:10px;margin-bottom:10px;">
		<div class="card-header">
			<label class="display-4"><?php echo $nama_materi ?> (<?php echo $jumlah_soal ?> Soal)</label>
		</div>
		<form action="<?php echo base_url('kursus/'.$this->functions->ubahURL($nama_kursus).'/'.$this->functions->ubahURL($nama_materi).'/cek_soal.html') ?>" method="post" class="">
		<div class="card-body">
			<div class="tab-content">
				<?php $no=0;foreach ($data_soal->result() as $row) {$no++;?>
					<div class="tab-pane container" id="soal<?php echo $no ?>">
					<p><?php echo $no ?>.&nbsp;<?php echo $row->nama_soal ?></p>
					<?php
					$pilihan_array =[
						[
							'pilihan' => $row->pilihan1,
							'value' => 1
						],
						[
							'pilihan' => $row->pilihan2,
							'value' => 2
						],
						[
							'pilihan' => $row->pilihan3,
							'value' => 3
						],
						[
							'pilihan' => $row->pilihan4,
							'value' => 4
						]
					];
					shuffle($pilihan_array);
					?>
							<div class="row">
								<div class="col-sm-12">
									<p><input type="radio" required name="soal<?php echo $no ?>" id="soalA<?php echo $no ?>" value="<?php echo $pilihan_array[0]['value'] ?>|<?php echo $row->id_detail_soal ?>">&nbsp;A. <?php echo $pilihan_array[0]['pilihan'] ?></p>
								</div>
								<div class="col-sm-12">
									<p><input type="radio" required name="soal<?php echo $no ?>" id="soalB<?php echo $no ?>" value="<?php echo $pilihan_array[1]['value'] ?>|<?php echo $row->id_detail_soal ?>">&nbsp;B. <?php echo $pilihan_array[1]['pilihan'] ?></p>
								</div>
								<div class="col-sm-12">
									<p><input type="radio" required name="soal<?php echo $no ?>" id="soalC<?php echo $no ?>" value="<?php echo $pilihan_array[2]['value'] ?>|<?php echo $row->id_detail_soal ?>">&nbsp;C. <?php echo $pilihan_array[2]['pilihan'] ?></p>
								</div>
								<div class="col-sm-12">
									<p><input type="radio" required name="soal<?php echo $no ?>" id="soalD<?php echo $no ?>" value="<?php echo $pilihan_array[3]['value'] ?>|<?php echo $row->id_detail_soal ?>">&nbsp;D. <?php echo $pilihan_array[3]['pilihan'] ?></p>
								</div>
							</div>
							<?php if($no<$jumlah_soal){ ?>
							<a href="#" onclick="buka_tab('soal<?php $no_selanjutnya = $no + 1;echo $no_selanjutnya; ?>')" class="ml-auto btn btn-outline-primary" style="margin-right:100px;margin-bottom:50px;">Selanjutnya&nbsp;&nbsp;<span class="oi oi-chevron-right"></span></a>
							<?php } ?>
							<?php if($no>1){ ?>
							<a href="#" onclick="buka_tab('soal<?php $no_sebelumnya = $no - 1;echo $no_sebelumnya; ?>')" class="ml-auto btn btn-outline-primary" style="margin-right:100px;margin-bottom:50px;"><span class="oi oi-chevron-left">&nbsp;&nbsp;Kembali</span></a>
							<?php } ?>
							<?php if($no==$jumlah_soal){ ?>
								<button type="submit" class="btn-block btn btn-outline-success">Selesai</button>
							<?php } ?>
						</div>
				<?php } ?>
				<ul class="nav nav-tabs">
		<?php $no=0;foreach ($data_soal->result() as $row) {$no++;?>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#soal<?php echo $no ?>"><?php echo $no ?></a>
			</li>
		<?php } ?>
		</ul>
		
			</div>
		</div>
		</form>
	</div>
</div>
<script>
$(document).ready(()=>{
	$('a[href="#soal1"]').tab('show');
});

function buka_tab(id) {
	$('a[href="#' + id + '"]').tab('show');
}
</script>
