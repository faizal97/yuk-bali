<?php
	$query = $this->db->query("SELECT * FROM tb_materi WHERE id_materi NOT IN (SELECT id_materi FROM tb_soal) AND id_kursus='$id_kursus' ORDER BY urut");
?>
<div>
	<label for="id_materi">Nama Materi</label>
	<select class="form-control" name="id_materi" id="id_materi" required>
		<?php foreach ($query->result() as $row) {?>
			<option value="<?php echo $row->id_materi ?>"><?php echo $row->urut ?>.&nbsp;<?php echo $row->nama_materi ?></option>
		<?php }?>
	</select>
</div>
