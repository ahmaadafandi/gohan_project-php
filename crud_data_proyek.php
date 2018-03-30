<?php
error_reporting(E_ALL ^ E_NOTICE);
include "koneksi.php";

// file submit.php
// menangkap data yang dikirimkan dari file tambah.php mwnggunakan method = POST

$namaProyek = $_POST['namaProyek'];
$anggaranProyek = $_POST['anggaranProyek'];
$mulaiProyek = $_POST['mulaiProyek'];
$selesaiProyek = $_POST['selesaiProyek'];


// perintah SQL
if($_GET['nomorProyek']){

	$nomorProyek = $_GET['nomorProyek'];


	$sql = mysqli_query($conn, "Delete From daftar_proyek where nomorProyek='$nomorProyek'");
	$sqlKegiaatanProyek = mysqli_query($conn, "Delete From kegiatan_proyek where nomorProyek='$nomorProyek'");

	if ($sql && $sqlKegiaatanProyek){
		//header ('location:view.php');
		header("location:proyek_berjalan.php");
	} else { 
		echo "Data gagal dihapus";
	}

}elseif($_GET['action']=='edit'){

	$nomorProyek = $_POST['nomorProyek'];

	$sql = mysqli_query($conn, "UPDATE daftar_proyek SET namaProyek = '$namaProyek', anggaranProyek = '$anggaranProyek', mulaiProyek = '$mulaiProyek', selesaiProyek = '$selesaiProyek' WHERE nomorProyek = '$nomorProyek'");

	if ($sql){
	//header ('location:view.php');
	header("location:proyek_berjalan.php");
	} else { echo "Data gagal diedit";
	}

}else{

	$sql = mysqli_query($conn, "INSERT INTO daftar_proyek VALUES ('','$namaProyek','$mulaiProyek','$selesaiProyek','$anggaranProyek','$anggaranProyek','Menunggu Persetujuan')");

	if ($sql){
		//header ('location:view.php');
		header("location:tambah_proyek.html");
	} else { 
		echo "Data gagal disimpan";
	}
}

?>