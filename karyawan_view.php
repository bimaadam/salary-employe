<!-- Printing -->
	<link rel="stylesheet" href="css/printing.css">
		
<?php
include("sess_check.php");
include("conf/format_tanggal.php");
include("conf/format_rupiah.php");
if($_GET) {
	$kode = $_GET['code'];
	$sql = "SELECT karyawan.*, bagian.* FROM karyawan, bagian WHERE karyawan.bagian_id=bagian.bagian_id
			AND karyawan.karyawan_id='$kode'";
	$query = mysqli_query($conn,$sql);
	$result = mysqli_fetch_array($query);
	
}
else {
	echo "Nomor Transaksi Tidak Terbaca";
	exit;
}
?>
<html>
<head>
</head>
<body>
<div id="section-to-print">
<div id="only-on-print">
<!--	<h2>Profil Project Manager</h2> -->
</div>
<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel">Detail Karyawan</h4>
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
</div>
<div><br/>
<table width="100%">
	<tr>
		<td width="20%"><b>ID Karyawan</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['karyawan_id'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Nama</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['karyawan_nama'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Jenis Kelamin</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['karyawan_jk'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Telepon</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['karyawan_telp'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Alamat</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['karyawan_alamat'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Tempat Lahir</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['karyawan_tptlhr'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Tanggal Lahir</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo format_tanggal($result['karyawan_tgllhr']);?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Bagian</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['bagian_nama'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Mulai Bekerja</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo format_tanggal($result['karyawan_masuk']);?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Status</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['karyawan_status'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Foto</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><img src="img/<?php echo $result['karyawan_foto'];?>" width="100px"></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
</table>
</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
	</div>
</div>

</body>
</html>