<?php
	include("sess_check.php");
		$id = $_GET['akn'];	
		$sql = "DELETE FROM akun WHERE akun_kode='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: akun.php?act=delete&msg=success");
?>