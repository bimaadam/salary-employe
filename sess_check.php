<?php
// memulai session
session_start();
$sysname = "Sistem Penggajian Zoya Cookies";
// membaca nilai variabel session 
$chk_sess = $_SESSION['adm'];
// memanggil file koneksi
include("conf/koneksi.php");
include("conf/library.php");
// mengambil data pengguna dari tabel pengguna
$sql_sess = "SELECT * FROM karyawan WHERE karyawan_id='" . $chk_sess . "'";
$ress_sess = mysqli_query($conn, $sql_sess);
$row_sess = mysqli_fetch_array($ress_sess);
// menyimpan id_pengguna yang sedang login
$sess_admid = $row_sess['karyawan_id'];
$sess_admuser = $row_sess['karyawan_nama'];
$sess_admname = $row_sess['karyawan_nama'];
$sess_admfoto = $row_sess['karyawan_foto'];
// mengarahkan ke halaman login.php apabila session belum terdaftar
if (!isset($chk_sess)) {
	header("location: login.php?login=false");
}
