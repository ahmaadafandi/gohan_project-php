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
	<link href="css/import.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="">

	<link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
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
			<div class="content-fill col-lg-12">
				<br>
				<br>
				<div class="row">   
					<table id="dataTables" class="table table-bordred table-striped" class="display" cellspacing="0" width="100%">
						<thead>  
							<tr>        
								<th><input type="checkbox" id="checkall" /></th>
								<th>ID</th>
								<th>Nama</th>
								<th>Anggaran</th>
								<th>Tanggal</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>							
						<?php 

		                    $sql = mysqli_query($conn, "select *from daftar_proyek");

				            if($sql->num_rows > 0){
					            foreach ($sql as $row) { 
					            	if ($row['statusProyek'] == "Sedang Berjalan" or $row['statusProyek'] == "Tidak Disetujui") { 
					            		$anggaranProyek=number_format($row['anggaranProyek'],2,',','.'); ?>	
									<tr>
		                          		<td><input type="checkbox" class="checkthis" /></td>
										<td><?php echo $row['nomorProyek']; ?></td>
										<td><?php echo $row['namaProyek']; ?></td>
										<td><?php echo "Rp $anggaranProyek;"; ?></td>
										<td><?php echo date('d F Y', strtotime($row['mulaiProyek'])); ?></td>
										<td><?php echo $row['statusProyek']; ?></td>
										<?php 
										if ($row['statusProyek'] == "Sedang Berjalan"){ ?>
											<td>
												<a href="detail_proyek_berjalan.php?nomorProyek=<?php echo $row['nomorProyek']; ?>" class="btn btn-success btn-xs mr-3"><i class="glyphicon glyphicon-eye-open"></i></a>
												<button type="button" class="btn btn-midnight btn-xs mr-3" id="openSpk" data-toggle="modal" data-target="#editProyek" data-id="<?php echo $row['nomorProyek']; ?>"><i class="glyphicon glyphicon-pencil"></i></button>
												<a class="btn btn-red-flat btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-href="crud_data_proyek.php?nomorProyek=<?php echo $row['nomorProyek']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
											</td>
										<?php 
										}else{ ?>
											<td>
												<a class="btn btn-red-flat btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-href="crud_data_proyek.php?nomorProyek=<?php echo $row['nomorProyek']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
											</td>
										<?php } ?>
									</tr>
									<?php } 
								}
		                 	} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editProyek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Proyek</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="createDetail" action="crud_data_proyek.php?action=edit&nomorProyek=" method="POST">
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

	<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">Hapus Produk Ini?</h4>
				</div>
				<div class="modal-body">

					<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda yakin menghapus proyek ini?</div>

				</div>
				<div class="modal-footer ">
					<a type="button" class="btn btn-danger btn-ok" ><span class="glyphicon glyphicon-ok-sign"></span> Ya</a>
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Tidak</button>
				</div>
			</div>
			<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>
</div>
</div>
</div>
</body>

<script src="jquery-1.12.0.min.js"></script>
<script src="jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
  $('#dataTables').DataTable();
} );
</script>


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
$(document).ready(function(){
    $('#editProyek').on('show.bs.modal', function (e) {
        var nomorProyek = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url : 'edit_proyek.php',
            data :  'nomorProyek='+ nomorProyek,
            success : function(data){
            $('.fetched-data').html(data);//menampilkan data ke dalam modal
            }                
        });
     });
});
</script>

<script type="text/javascript">
//Hapus Data
$(document).ready(function() {
    $('#delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
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

</html>

