<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#039447">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>DISTANKAN MEDAN | Daftar Proyek</title>


	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-grid.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
	<link href="css/daterangepicker.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-datepicker.css.css" rel="stylesheet" type="text/css">
	<link href="css/import.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="">
</head>

<body>
	<div class="wrapper">
		<!-- Sidebar Holder -->
		<nav id="sidebar" class="bg-midnightblue">
			<div class="sidebar-header text-center">
				<h3>DISTANKAN</h3>
				<strong><img class="img-responsive" src="img/logo.png"></strong>
			</div>
			<ul class="list-unstyled admin-login">
				<li class="admin-avatar mt-5 text-center">
					<img class="img-circle" src="img/avatar.jpg">
					<span><h5>Pegawai 1</h5></span>
				</li>
			</ul>
			<ul class="list-unstyled components">
				<li>
					<a href="tambah_proyek.html">
						<i class="fa fa-home"></i>
						Tambah Proyek
					</a>
				</li>
				<li class="active">
					<a href="proyek_berjalan.php">
						<i class="fa fa-user-circle"></i>
						Proyek Berjalan
					</a>
				</li>
				<li>
					<a href="pembuatan_laporan.php">
						<i class="fa fa-shopping-bag"></i>
						Pembuatan Laporan
					</a>
				</li>
			</ul>
		</nav>

		<?php
		  include "koneksi.php"; //Mengimport database data
		?>

		<!-- Page Content Holder -->
		<div id="content">

			<nav class="navbar navbar-default">
				<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" id="sidebarCollapse" class="btn btn-default navbar-btn">
							<i class="glyphicon glyphicon-align-left"></i>
						</button>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="/front-endadmin/"><i class="fa fa-sign-out"></i> Logout</a></li>
						</ul>
					</div>
				</div>
			</nav>

			<?php 
			$nomorProyek = $_GET['nomorProyek'];
            $sql = mysqli_query($conn, "select *from daftar_proyek where nomorProyek = '$nomorProyek'");

            foreach ($sql as $row) { 
				$namaProyek = $row['namaProyek'];
				$mulaiProyek = $row['mulaiProyek'];
				$selesaiProyek = $row['selesaiProyek'];
				$anggaranProyek = $row['anggaranProyek'];
				$sisaAnggaranProyek = $row['sisaAnggaranProyek'];
		 	}  ?>
			
			<div class="content-fill col-lg-12">
				<div class="row">
					<div class="col-lg-2">
						<h5>Nama Proyek:</h5>
					</div>		
					<div class="col-lg-8">
						<div class="row">
							<h5><?php echo $namaProyek; ?></h5>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<h5>Anggaran:</h5>
					</div>		
					<div class="col-lg-8">
						<div class="row">
							<h5><?php $RpanggaranProyek=number_format($anggaranProyek,2,',','.'); echo "Rp $RpanggaranProyek"; ?></h5>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<h5>Sisa Anggaran:</h5>
					</div>		
					<div class="col-lg-8">
						<div class="row">
							<h5><?php $RpsisaAnggaranProyek=number_format($sisaAnggaranProyek,2,',','.'); echo "Rp $RpsisaAnggaranProyek"; ?></h5>
						</div>
					</div>
				</div>
				<br>
				<br>
				<div class="row"> 
					<div class="col-lg-8">
						<h5>Rincian Kegiatan:</h5>
					</div>		  
					<div class="col-lg-4">
						<button type="button" class="btn btn-midnight pull-right" id="openSpk" data-toggle="modal" data-target="#TambahKegiatan" data-whatever="@fat">Tambah Kegiatan</button>
					</div>		  
					<table id="mytable" class="table table-bordred table-striped">
						<thead>          
							<th><input type="checkbox" id="checkall" /></th>
							<th>No</th>
							<th>Nama Kegiatan</th>
							<th>Anggaran</th>
							<th>Tanggal</th>
							<th>Gambar</th>
							<th>Aksi</th>
						</thead>
						<tbody>
						<?php 
				            $sqlKegiatan = mysqli_query($conn, "select *from Kegiatan_proyek where nomorProyek = '$nomorProyek'");
				            $no = 1;
				            if($sqlKegiatan->num_rows > 0){
				            foreach ($sqlKegiatan as $row) { 
				            	$anggaran=number_format($row['anggaran'],2,',','.'); ?>	
							<tr>
								<td><input type="checkbox" class="checkthis" /></td>
								<td><?php echo $no; ?></td>
								<td><?php echo $row['namaKegiatan']; ?></td>
								<td><?php echo "Rp $anggaran"; ?></td>
								<td><?php echo date('d F Y', strtotime($row['tanggal'])); ?></td>
								<td><img src="img/<?php echo $row['gambar']; ?>" class="img-bukti"></td>
								<td>
									<a href="#" class="btn btn-success btn-xs mr-3"><i class="glyphicon glyphicon-eye-open"></i></a>
									<button type="button" class="btn btn-midnight btn-xs mr-3" id="openSpk" data-toggle="modal" data-target="#exampleModalEdit" data-id="<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-pencil"></i></button>
									<a class="btn btn-red-flat btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-href="crud_kegiatan_proyek.php?id=<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
								</td>
							</tr>
							<?php $no++; }
							}else{
								echo "0 result";
							} ?>
						</tbody>
					</table>

					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">Hapus Produk Ini?</h4>
				</div>
				<div class="modal-body">

					<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda yakin menghapus produk ini?</div>

				</div>
				<div class="modal-footer ">
					<a class="btn btn-danger btn-ok"> Hapus</a>
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Batalkan</button>
				</div>
			</div>
			<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>

	<div class="modal fade" id="TambahKegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="createDetail" action="crud_kegiatan_proyek.php?nomorProyek=<?php echo $nomorProyek; ?>" method="POST" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<label for="namaKegiatan" class="form-control-label">Nama Kegiatan:</label>
							<input type="text" name="namaKegiatan" class="form-control" id="namaKegiatan">
						</div>
						<div class="form-group">
							<label for="anggaran" class="form-control-label">Anggaran:</label>
							<input type="number" name="anggaran" class="form-control" id="anggaran">
						</div>
						
						<div class="form-group">
							<label for="tanggal" class="form-control-label">Tanggal:</label>
							<input type="text" name="tanggal" class="form-control" />
						</div>
						<div class="form-group">
							<label for="gambar" class="form-control-label">Gambar:</label>
							<div class="input-group col-6">
								<span class="input-group-btn">
									<span class="btn btn-default btn-file">
										Browse… <input type="file" id="imgInp" name="gambar">
									</span>
								</span>
								<input type="text" class="form-control" readonly>
							</div>
							<div class="input-group col-6">
								<img id='img-upload' class="img-bukti"/>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
						<button type="submit" class="btn btn-midnight">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Kegiatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="UpdateDetail" action="crud_kegiatan_proyek.php?action=edit&nomorProyek=<?php echo $nomorProyek; ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="fetched-data"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
					<button type="submit" class="btn btn-midnight">Simpan Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.jst"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/import.js"></script>
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/daterangepicker.js"></script>
<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/defaults-id_ID.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
//Hapus Data
$(document).ready(function() {
    $('#delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#exampleModalEdit').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url : 'edit_kegiatan.php',
            data :  'rowid='+ rowid,
            success : function(data){
            $('.fetched-data').html(data);//menampilkan data ke dalam modal
            }                
        });
     });
});
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
		});
	});
</script>

<script type="text/javascript">
	$(function() {
		$('input[name="daterange"]').daterangepicker();
	});
</script>

<script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer>
	$('#TambahKegiatan').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})	
</script>

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

</html>

