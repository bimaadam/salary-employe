<?php
	include("sess_check.php");
		$id = $_GET['abs'];	
		$sql = "DELETE FROM abs WHERE abs_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		$sql2 = "DELETE FROM absensi WHERE abs_id='". $id ."'";
		$ress2 = mysqli_query($conn, $sql2);
		header("location: absensi.php?act=delete&msg=success");
?>