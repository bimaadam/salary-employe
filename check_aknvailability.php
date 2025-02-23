<?php 
require_once("conf/koneksi.php");
// code user username availablity
if(!empty($_POST["id"])) {
	$id= $_POST["id"];
	$sql = "SELECT * FROM akun WHERE akun_kode='$id'";
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)>0){
		echo "<span style='color:red'> Kode sudah terdaftar.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	}else{
		echo "<span style='color:green'> Kode bisa digunakan.</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}

?>
