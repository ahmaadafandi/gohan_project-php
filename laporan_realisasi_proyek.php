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
					<span><h5>Kepala Dinas</h5></span>
				</li>
			</ul>
			<ul class="list-unstyled components">
				<li class="active">
					<a href="laporan_realisasi_proyek.php">
						<i class="fa fa-home"></i>
						Laporan Realisasi Proyek
					</a>
				</li>
				<li>
					<a href="persetujuan_proyek.php">
						<i class="fa fa-user-circle"></i>
						Persetujuan Proyek
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
			<div class="content-fill col-lg-12">
				<br>
				<br>
				<div class="row">   
					<table id="mytable" class="table table-bordred table-striped">
						<thead>          
							<th><input type="checkbox" id="checkall" /></th>
							<th>ID</th>
							<th>Nama</th>
							<th>Anggaran</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th>Aksi</th>
						</thead>
						<tbody>							
						<?php 

		                   $sql = mysqli_query($conn, "select *from daftar_proyek");

				            if($sql->num_rows > 0){
					            foreach ($sql as $row) { 
					            	if ($row['statusProyek'] == "Sedang Berjalan") { 
					            		$anggaranProyek=number_format($row['anggaranProyek'],2,',','.'); ?>	
									<tr>
		                          		<td><input type="checkbox" class="checkthis" /></td>
										<td><?php echo $row['nomorProyek']; ?></td>
										<td><?php echo $row['namaProyek']; ?></td>
										<td><?php echo "Rp $anggaranProyek;"; ?></td>
										<td><?php echo date('d F Y', strtotime($row['mulaiProyek'])); ?></td>
										<td><?php echo $row['statusProyek']; ?></td>
										<td><a href="detail_proyek_berjalan.html" class="btn btn-success btn-xs mr-3"><i class="glyphicon glyphicon-eye-open"></i></a></td>
									<?php } 
		                 		} 
		                 	}?>
							</tr>
						</tbody>
					</table>

					<div class="clearfix"></div>
					<div class="col-lg-12">
						<div class="row">
							<div class="pagination-midnight col-lg-12 col-md-12 col-sm-12 pull-right">
								<ul class="pagination m-0 pull-right">
									<li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
									<li class="active"><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
								</ul>
							</div>
						</div>
					</div>
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
				<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Ya</button>
				<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Tidak</button>
			</div>
		</div>
		<!-- /.modal-content --> 
	</div>
	<!-- /.modal-dialog --> 
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

</html>

