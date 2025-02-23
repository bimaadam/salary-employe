<?php
	include("sess_check.php");
		$id = $_GET['jur'];	
		$sql = "DELETE FROM jurnal WHERE jurnal_trx='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: jurnal.php?act=delete&msg=success");
?>