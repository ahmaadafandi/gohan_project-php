<?php 

 include "koneksi.php"; //Mengimport database data

if($_POST['rowid']) {

$id = $_POST['rowid'];

$sqlKegiatanEdit = mysqli_query($conn, "select *from Kegiatan_proyek where id = '$id'");
	foreach ($sqlKegiatanEdit as $row) { ?>
	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<div class="form-group">
	<label for="namaKegiatan" class="form-control-label">Nama Kegiatan:</label>
	<input type="text" name="namaKegiatan" class="form-control" id="namaKegiatan" value="<?php echo $row['namaKegiatan']; ?>">
</div>
<div class="form-group">
	<label for="anggaran" class="form-control-label">Anggaran:</label>
	<input type="text" name="anggaran" class="form-control" id="anggaran" value="<?php echo $row['anggaran']; ?>">
</div>

<div class="form-group">
	<label for="tanggal" class="form-control-label">Tanggal:</label>
	<input type="text" name="tanggal" class="form-control" value="<?php echo $row['tanggal']; ?>">
</div>
<div class="form-group">
	<label for="gambar" class="form-control-label">Gambar:</label>
	<div class="input-group col-6">
		<span class="input-group-btn">
			<span class="btn btn-default btn-file">
				Browse… <input type="file" id="imgInp" name="gambar" value="<?php echo $row['gambar']; ?>">
			</span>
		</span>
		<input type="text" class="form-control" readonly>
	</div>
	<div class="input-group col-6">
		<img id='img-upload' class="img-bukti" src="img/<?php echo $row['gambar']; ?>"/>
	</div>
</div>

</script>

<?php 
    }
} 

?>
<script type="text/javascript">
	$(function() {
		$('input[name="tanggal"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true
		}, 
		function(start, end, label) {
			var years = moment().diff(start, 'years');
		});
	});
</script>

<script type="text/javascript">
	$(document).ready( function() {
		$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

			var input = $(this).parents('.input-group').find(':text'),
			log = label;

			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}

		});
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#img-upload').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#imgInp").change(function(){
			readURL(this);
		}); 	
	});
</script>