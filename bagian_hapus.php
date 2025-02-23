<?php
	include("sess_check.php");
		$id = $_GET['bgn'];	
		$sql = "DELETE FROM bagian WHERE bagian_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: bagian.php?act=delete&msg=success");
?>