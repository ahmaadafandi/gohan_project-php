<?php 

 include "koneksi.php"; //Mengimport database data

if($_POST['nomorProyek']) {

$nomorProyek = $_POST['nomorProyek'];

$sqlProyekEdit = mysqli_query($conn, "select *from daftar_proyek where nomorProyek = '$nomorProyek'");
	foreach ($sqlProyekEdit as $row) { ?>
	<input type="hidden" name="nomorProyek" value="<?php echo $row['nomorProyek']; ?>">
<div class="form-group">
	<label for="namaKegiatan" class="form-control-label">Nama Proyek:</label>
	<input type="text" name="namaProyek" class="form-control" id="namaProyek" value="<?php echo $row['namaProyek']; ?>">
</div>
<div class="form-group">
	<label for="anggaran" class="form-control-label">Anggaran Proyek:</label>
	<input type="number" name="anggaranProyek" class="form-control" id="anggaranProyek" value="<?php echo $row['anggaranProyek']; ?>">
</div>

<div class="form-group">
	<label for="tanggal" class="form-control-label">Tanggal Mulai:</label>
	<input type="text" name="mulaiProyek" value="<?php echo $row['mulaiProyek']; ?>" class="form-control" value="<?php echo $row['mulaiProyek']; ?>">
</div>
<div class="form-group">
	<label for="tanggal" class="form-control-label">Tanggal Selesai:</label>
	<input type="text" name="selesaiProyek" value="<?php echo $row['selesaiProyek']; ?>" class="form-control" value="<?php echo $row['selesaiProyek']; ?>">
</div>

<?php 
    }
} ?>

<script type="text/javascript">
	$(function() {
		$('input[name="mulaiProyek"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true
		}, 
		function(start, end, label) {
			var years = moment().diff(start, 'years');
		});
	});
</script>

<script type="text/javascript">
	$(function() {
		$('input[name="selesaiProyek"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true
		}, 
		function(start, end, label) {
			var years = moment().diff(start, 'years');
		});
	});
</script>
