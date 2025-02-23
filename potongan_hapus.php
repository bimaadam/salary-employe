<?php
	include("sess_check.php");
		$id = $_GET['pot'];	
		$sql = "DELETE FROM potongan WHERE pot_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: potongan.php?act=delete&msg=success");
?>