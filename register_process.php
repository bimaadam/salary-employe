<?php
include('conf/koneksi.php');

$karyawan_id = $_POST['karyawan_id'];
$nama = $_POST['nama'];
$pass = md5($_POST['password']);
$akses = $_POST['akses'];

mysqli_query($conn, "INSERT INTO karyawan (karyawan_id, karyawan_nama, karyawan_pass, karyawan_status) 
VALUES ('$karyawan_id', '$nama', '$pass', 'Aktif')");

if ($akses == 'admin' || $akses == 'manager') {
    mysqli_query($conn, "INSERT INTO user (karyawan_id, user_akses, user_stt) 
	VALUES ('$karyawan_id', '$akses', 'Aktif')");
} elseif ($akses == 'direktur') {
    mysqli_query($conn, "INSERT INTO direktur (username, password) 
	VALUES ('$karyawan_id', '$pass')");
}

header("Location: login.php?daftar=success");
