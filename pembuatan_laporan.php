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

		<?php 
			include "koneksi.php";
		 ?>
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
				<li>
					<a href="proyek_berjalan.php">
						<i class="fa fa-user-circle"></i>
						Proyek Berjalan
					</a>
				</li>
				<li class="active">
					<a href="pembuatan_laporan.php">
						<i class="fa fa-shopping-bag"></i>
						Pembuatan Laporan
					</a>
				</li>
			</ul>
		</nav>

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
			<div class="content-fill col-lg-12">
				<div class="row">
					<div class="col-lg-2">
						<h5>Select Nama Proyek:</h5>
					</div>		
					<div class="col-lg-8">
						<div class="row">
							<div class="form-group mr-3 pl-0">
								<div class="icon-addon addon-md">
									<form action="">
										<select class="form-control selectpicker pl-0" data-live-search="true" name="pilihan"  onchange="this.form.submit();">
											<option>-Select-</option>
											<?php 
												$sql = mysqli_query($conn, "select *From daftar_proyek");
												foreach ($sql as $row) { 
													if ($row['statusProyek'] == "Sedang Berjalan") { 
														$namaProyek = $row['namaProyek'];
											 ?>
											<option data-tokens="<?php echo $namaProyek; ?>"><?php echo $namaProyek; ?></option>
										<?php 	} 
										} ?>
										</select>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
				error_reporting(0);
				if($_GET['pilihan']) {
					$namaProyekPilihan = $_GET['pilihan'];
					$sqlPilihan = mysqli_query($conn, "select *From daftar_proyek where namaProyek = '$namaProyekPilihan'");
					foreach ($sqlPilihan as $row) { 
						$nomorProyek = $row['nomorProyek'];
						$mulaiProyek = $row['mulaiProyek'];
						$selesaiProyek = $row['selesaiProyek'];
						$anggaranProyek = $row['anggaranProyek'];
						$sisaAnggaranProyek = $row['sisaAnggaranProyek'];
				 	} 
				 ?>
				<div class="row">
					<div class="col-lg-2">
						<h5>Nama Proyek:</h5>
					</div>		
					<div class="col-lg-8">
						<div class="row">
							<h5><?php echo $namaProyekPilihan; ?></h5>
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
					<table id="mytable" class="table table-bordred table-striped">
						<thead>
							<th>No</th>
							<th>Nama Kegiatan</th>
							<th>Anggaran</th>
							<th>Tanggal</th>
							<th>Gambar</th>
						</thead>
						<tbody>
						<?php 
				            $sqlKegiatan = mysqli_query($conn, "select *from Kegiatan_proyek where nomorProyek = '$nomorProyek'");
				            if($sqlKegiatan->num_rows > 0){
				            foreach ($sqlKegiatan as $row) { 
				            	$anggaran=number_format($row['anggaran'],2,',','.');  ?>	
							<tr>
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['namaKegiatan']; ?></td>
								<td><?php echo "Rp $anggaran"?></td>
								<td><?php echo date('d F Y', strtotime($row['tanggal'])); ?></td>
								<td><img src="img/<?php echo $row['gambar']; ?>" class="img-bukti"></td>
							</tr>
							<?php  }
							} ?>
						</tbody>
					</table>
					<div class="col-lg-12 pull-right">
						<button type="button" class="btn btn-midnight pull-right" data-title="Delete" data-toggle="modal" data-target="#delete">Simpan Laporan</button>
					</div>
					<div class="clearfix"></div>
					<?php } ?>
				</div>
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
	$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})	
</script>


</html>

