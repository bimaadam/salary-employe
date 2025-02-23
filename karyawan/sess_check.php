<?php
	// memulai session
	session_start();
	$sysname ="Sistem Penggajian PT. Triwarga Dian Sakti";
	// membaca nilai variabel session 
	$chk_sess = $_SESSION['kry'];
	// memanggil file koneksi
	include("../conf/koneksi.php");
	include("../conf/library.php");
	// mengambil data pengguna dari tabel pengguna
	$sql_sess = "SELECT * FROM karyawan WHERE karyawan_id='". $chk_sess ."'";
	$ress_sess = mysqli_query($conn, $sql_sess);
	$row_sess = mysqli_fetch_array($ress_sess);
	// menyimpan id_pengguna yang sedang login
	$sess_kryid = $row_sess['karyawan_id'];
	$sess_kryname = $row_sess['karyawan_nama'];
	$sess_kryfoto = $row_sess['karyawan_foto'];
	// mengarahkan ke halaman login.php apabila session belum terdaftar
	if(!isset($chk_sess)){
		header("location: ../login.php?login=false");
	}
?>