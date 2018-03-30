<?php
error_reporting(E_ALL ^ E_NOTICE);
include "koneksi.php";

// file submit.php
// menangkap data yang dikirimkan dari file tambah.php mwnggunakan method = POST


$nomorProyek = $_GET['nomorProyek'];

$id = $_POST['id'];
$namaKegiatan = $_POST['namaKegiatan'];
$anggaran = $_POST['anggaran'];
$tanggal = $_POST['tanggal'];


$folder = './img/';
$source = $_FILES['gambar']['tmp_name'];
$gambar = $_FILES['gambar']['name'];

// perintah SQL
if($_GET['action']=='edit'){

	$sql_kegiatan_proyek = mysqli_query($conn, "select *From kegiatan_proyek where id='$id'");
	foreach ($sql_kegiatan_proyek as $row) { 
		$anggaranAwal = $row['anggaran'];
	}

	$sqlSelectProyek = mysqli_query($conn, "SELECT *FROM daftar_proyek WHERE nomorProyek = '$nomorProyek'");

	while ($data = mysqli_fetch_array($sqlSelectProyek)) {
              $sisaAnggaranProyek  = $data['sisaAnggaranProyek'];
          } 

    $sisaAnggaranProyek = $sisaAnggaranProyek + $anggaranAwal - $anggaran;

	$sqlUpdateProyek = mysqli_query($conn, "UPDATE daftar_proyek SET sisaAnggaranProyek = '$sisaAnggaranProyek' WHERE nomorProyek = '$nomorProyek'");

	$sql = mysqli_query($conn, "UPDATE kegiatan_proyek SET namaKegiatan = '$namaKegiatan', anggaran = '$anggaran', tanggal = '$tanggal', gambar = '$gambar' WHERE id = '$id'");

	if ($sql_kegiatan_proyek && $sqlSelectProyek && $sqlUpdateProyek && $sql && move_uploaded_file($source, $folder.$gambar))
	{
	//header ('location:view.php');
	header("location:detail_proyek_berjalan.php?nomorProyek=$nomorProyek");
	} else { echo "Data gagal diedit";
	}

}elseif($_GET['id']){

	$id = $_GET['id'];

	$sql = mysqli_query($conn, "select *From kegiatan_proyek where id='$id'");
	foreach ($sql as $row) { 
		$nomorProyek = $row['nomorProyek'];
		$anggaran = $row['anggaran'];
	}

	$sqlSelectProyek = mysqli_query($conn, "SELECT *FROM daftar_proyek WHERE nomorProyek = '$nomorProyek'");

	while ($data = mysqli_fetch_array($sqlSelectProyek)) {
              $sisaAnggaranProyek  = $data['sisaAnggaranProyek'];
          } 

    $sisaAnggaranProyek += $anggaran;

	$sqlUpdateProyek = mysqli_query($conn, "UPDATE daftar_proyek SET sisaAnggaranProyek = '$sisaAnggaranProyek' WHERE nomorProyek = '$nomorProyek'");


	$sqlHapus = mysqli_query($conn, "Delete From kegiatan_proyek where id='$id'");

	if ($sql && $sqlSelectProyek && $sqlUpdateProyek && $sqlHapus){
	//header ('location:view.php');
	header("location:detail_proyek_berjalan.php?nomorProyek=$nomorProyek");
	} else { echo "Data gagal dihapus";
	}

}else{

	$sqlSelectProyek = mysqli_query($conn, "SELECT *FROM daftar_proyek WHERE nomorProyek = '$nomorProyek'");

	while ($data = mysqli_fetch_array($sqlSelectProyek)) {
              $sisaAnggaranProyek  = $data['sisaAnggaranProyek'];
          } 

    $sisaAnggaranProyek -= $anggaran;

	$sqlUpdateProyek = mysqli_query($conn, "UPDATE daftar_proyek SET sisaAnggaranProyek = '$sisaAnggaranProyek' WHERE nomorProyek = '$nomorProyek'");

	$sql = mysqli_query($conn, "INSERT INTO kegiatan_proyek VALUES ('','$nomorProyek','$namaKegiatan','$anggaran','$tanggal','$gambar')");

	if ($sqlSelectProyek && $sqlUpdateProyek && $sql  && move_uploaded_file($source, $folder.$gambar))
	{
		//header ('location:view.php');
		header("location:detail_proyek_berjalan.php?nomorProyek=$nomorProyek");
	} else { 
		echo "Data gagal disimpan";
	}
}

?>