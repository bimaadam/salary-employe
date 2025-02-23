<?php
	// memulai session
	session_start();
	$sysname ="Sistem Penggajian PT. Triwarga Dian Sakti";
	// membaca nilai variabel session 
	$chk_sess = $_SESSION['dir'];
	// memanggil file koneksi
	include("../conf/koneksi.php");
	include("../conf/library.php");
	// mengambil data pengguna dari tabel pengguna
	$sql_sess = "SELECT * FROM direktur WHERE id_dir='". $chk_sess ."'";
	$ress_sess = mysqli_query($conn, $sql_sess);
	$row_sess = mysqli_fetch_array($ress_sess);
	// menyimpan id_pengguna yang sedang login
	$sess_dirid = $row_sess['id_dir'];
	$sess_diruser = $row_sess['username'];
	$sess_dirname = $row_sess['nama_lengkap'];
	$sess_dirfoto = $row_sess['foto_dir'];
	// mengarahkan ke halaman login.php apabila session belum terdaftar
	if(!isset($chk_sess)){
		header("location: ../login.php?login=false");
	}
?>