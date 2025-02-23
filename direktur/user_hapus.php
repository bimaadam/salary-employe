<?php
	include("sess_check.php");
		$id = $_GET['usr'];	
		$sql = "DELETE FROM user WHERE user_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: user.php?act=delete&msg=success");
?>