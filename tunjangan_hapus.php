<?php
	include("sess_check.php");
		$id = $_GET['tjg'];	
		$sql = "DELETE FROM tunjangan WHERE tjg_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: tunjangan.php?act=delete&msg=success");
?>