<?php
// memulai session
session_start();
// memanggil file koneksi
include("conf/koneksi.php");
// mengecek apakah tombol login sudah di tekan atau belum
if(isset($_POST['login'])) {
	// mengecek apakah username dan password sudah di isi atau belum
	if(empty($_POST['username']) || empty($_POST['password'])) {
		// mengarahkan ke halaman login.php
		header("location: login.php?err=empty");
	}else{
		// membaca nilai variabel username dan password
		$username = $_POST['username'];
		$password = $_POST['password'];
		$akses = $_POST['akses'];
		// mencegah sql injection
		$username = htmlentities(trim(strip_tags($username)));
		$password = htmlentities(trim(strip_tags($password)));
		$pass = md5($password);
		if($akses=="admin"){
			// memeriksa username di tabel admin
			$sql = "SELECT user.*, karyawan.* FROM user, karyawan WHERE user.karyawan_id=karyawan.karyawan_id AND
					karyawan.karyawan_id='". $username ."' AND karyawan.karyawan_pass='". $pass ."' AND user.user_stt='Aktif' AND user.user_akses='Admin HRD'";
			$ress = mysqli_query($conn, $sql);
			$rows = mysqli_num_rows($ress);
			$dataku = mysqli_fetch_array($ress);
			// mendaftarkan session jika username di temukan
			if($rows == 1) {
				// membuat variabel session
				$_SESSION['adm'] = strtolower($dataku['karyawan_id']);
				// mengarahkan ke halaman indeks.php
				header("location: index.php?login=success");
			}else{
				header("location: login.php?err=not_found");
			}
		}else if($akses=="direktur"){
			// memeriksa username di tabel admin
			$sql = "SELECT * FROM direktur WHERE username='". $username ."' AND password='". $pass ."'";
			$ress = mysqli_query($conn, $sql);
			$rows = mysqli_num_rows($ress);
			$dataku = mysqli_fetch_array($ress);
			// mendaftarkan session jika username di temukan
			if($rows == 1) {
				// membuat variabel session
				$_SESSION['dir'] = strtolower($dataku['id_dir']);
				// mengarahkan ke halaman indeks.php
				header("location: direktur/index.php?login=success");
			}else{
				header("location: login.php?err=not_found");
			}
		}else if($akses=="karyawan"){
			// memeriksa username di tabel admin
			$sql = "SELECT * FROM karyawan WHERE karyawan_id='". $username ."' AND karyawan_pass='". $pass ."' AND karyawan_status='Aktif'";
			$ress = mysqli_query($conn, $sql);
			$rows = mysqli_num_rows($ress);
			$dataku = mysqli_fetch_array($ress);
			// mendaftarkan session jika username di temukan
			if($rows == 1) {
				// membuat variabel session
				$_SESSION['kry'] = strtolower($dataku['karyawan_id']);
				// mengarahkan ke halaman indeks.php
				header("location: karyawan/index.php?login=success");
			}else{
				header("location: login.php?err=not_found");
			}
		}else{
			// memeriksa username di tabel admin
			$sql = "SELECT user.*, karyawan.* FROM user, karyawan WHERE user.karyawan_id=karyawan.karyawan_id AND
					karyawan.karyawan_id='". $username ."' AND karyawan.karyawan_pass='". $pass ."' AND user.user_stt='Aktif' AND user.user_akses='Manager'";
			$ress = mysqli_query($conn, $sql);
			$rows = mysqli_num_rows($ress);
			$dataku = mysqli_fetch_array($ress);
			// mendaftarkan session jika username di temukan
			if($rows == 1) {
				// membuat variabel session
				$_SESSION['mng'] = strtolower($dataku['karyawan_id']);
				// mengarahkan ke halaman indeks.php
				header("location: manager/index.php?login=success");
			}else{
				header("location: login.php?err=not_found");
			}
		}
	}
}
?>