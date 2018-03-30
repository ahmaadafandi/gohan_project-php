<?php
error_reporting(E_ALL ^ E_NOTICE);
include "koneksi.php";

// file submit.php
// menangkap data yang dikirimkan dari file tambah.php mwnggunakan method = POST


$nomorProyek = $_GET['nomorProyek'];

// perintah SQL
$sql = mysqli_query($conn, "UPDATE daftar_proyek SET statusProyek = 'Sedang Berjalan' WHERE nomorProyek = '$nomorProyek'");

if ($sql){
//header ('location:view.php');
header("location:persetujuan_proyek.php");
} else { echo "Data gagal disimpan";
}

?>