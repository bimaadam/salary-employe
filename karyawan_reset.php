<?php
	include("sess_check.php");
		$id = $_GET['kry'];	
		$pass = md5($id);
		$sql = "UPDATE karyawan SET karyawan_pass='". $pass ."'	WHERE karyawan_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);

		header("location: karyawan.php?act=update&msg=success");
?>