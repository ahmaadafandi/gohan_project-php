<?php 

include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = mysqli_query($conn, "select *From user where username ='$username'");
foreach ($sql as $row) { 
	$hakAkses = $row['hakAkses'];
} 

if($hakAkses == 'pegawai'){
	header("location:tambah_proyek.html");
}else{
	header("location:laporan_realisasi_proyek.php");
}

?>