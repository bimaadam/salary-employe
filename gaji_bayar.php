<?php
	include("sess_check.php");

	include("conf/format_tanggal.php");
	include("conf/format_rupiah.php");
	$abs = $_GET['abs'];
	$sqla = "SELECT * FROM abs WHERE abs_id='$_GET[abs]'";
	$ressa = mysqli_query($conn, $sqla);
	$dataa = mysqli_fetch_array($ressa);
	$bln = $dataa['abs_bln'];
	$th = $dataa['abs_th'];
	$bl = $dataa['abs_bl'];

	$sql = "SELECT gaji_karyawan.*, karyawan.*, bagian.* FROM gaji_karyawan, karyawan, bagian 
			WHERE karyawan.bagian_id=bagian.bagian_id AND gaji_karyawan.karyawan_id=karyawan.karyawan_id 
			AND gaji_karyawan.abs_id='$abs' AND gaji_karyawan.gaj_stt='Approved'";
	$ress = mysqli_query($conn, $sql);

	// deskripsi halaman
	$pagedesc = "Rekap Gaji Karyawan Periode " .$bln."-".$th;
	$pagetitle = str_replace(" ", "_", $pagedesc)
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">

	<title><?php echo $pagetitle ?></title>
	
	<link href="img/honda.jpg" rel="icon" type="images/x-icon">


	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/offline-font.css" rel="stylesheet">
	<link href="css/custom-report.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<section id="header-kop">
		<div class="container-fluid">
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td class="text-left" width="20%">
							<img src="img/honda.jpg" alt="logo-tds" width="70" />
						</td>
						<td class="text-center" width="60%">
						<b>PT. Triwarga Dian Sakti</b> <br>
						Jl. Jend. Sudirman Km. 31 Kranji Bekasi<br>
						Telp: 021-8866511 <br>
						<td class="text-right" width="20%">
						</td>
					</tr>
				</tbody>
			</table>
			<hr class="line-top" />
		</div>
	</section>

	<section id="body-of-report">
		<div class="container-fluid">
			<h5 class="text-center">Rekap Gaji Karyawan Periode <?php echo $bln;?>-<?php echo $th;?></h5>
			<br />	

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="5%"><center>No</center></th>
						<th width="8%"><center>ID</center></th>
						<th width="10%"><center>Nama</center></th>
						<th width="10%"><center>Metode Pembayaran</center></th>
						<th width="10%"><center>Tanggal</center></th>
						<th width="10%"><center>Gaji</center></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$n=1;
					$tot = 0;
					while($data=mysqli_fetch_array($ress)){
						$gaji = $data['gaj_bersih'];
						echo '<tr>';
						echo '<td class="text-center">'. $n .'</td>';
						echo '<td class="text-center">'. $data['karyawan_id'] .'</td>';
						echo '<td class="text-nowrap">'. $data['karyawan_nama'] .'</td>';
						echo '<td class="text-center">'. $data['gaj_pay'] .'</td>';
						echo '<td class="text-center">'. format_tanggal($data['gaj_tgl']) .'</td>';
						echo '<td class="text-center">'. format_rupiah($data['gaj_bersih']) .'</td>';
						$n++;
						$tot+=$gaji;
						}
						?>
				</tbody>
				<tfoot>
						<th width="10%" colspan="5"><center>Total Pembayaran Gaji</center></th>
						<th width="10%"><?php echo format_rupiah($tot);?></th>				
				</tfoot>
				
		</div><!-- /.container -->
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			window.print();
		});
	</script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!-- jTebilang JavaScript -->
	<script src="js/jTerbilang.js"></script>

</body>
</html>