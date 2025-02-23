<?php
	include("sess_check.php");

	include("conf/format_tanggal.php");
	include("conf/format_rupiah.php");
	$bln = $_GET['bl'];
	$th = $_GET['th'];
	
	if($bln=="all"){
		$pagedesc = "Semua Data Jurnal";
		$periode = "- Semua";
		$sql = "SELECT jurnal.*, akun.* FROM jurnal, akun 
				WHERE jurnal.akun_kode=akun.akun_kode AND jurnal.akun_kode!='0' ORDER BY jurnal.jurnal_tgl ASC";
		$ress = mysqli_query($conn, $sql);

/*		$sqldeb = "SELECT jurnal.*, akun.* FROM jurnal, akun 
				WHERE jurnal.akun_kode=akun.akun_kode AND akun.akun_jenis='Debet' AND jurnal.akun_kode!='0'
				ORDER BY jurnal.jurnal_tgl ASC";
		$ressdeb = mysqli_query($conn, $sqldeb);
		$deb =0;
		while($datadeb = mysqli_fetch_array($ressdeb)){
			$debet = $datadeb['jurnal_jml'];
			$deb+=$debet;
		}

		$sqlkre = "SELECT jurnal.*, akun.* FROM jurnal, akun 
				WHERE jurnal.akun_kode=akun.akun_kode AND akun.akun_jenis='Kredit'
				ORDER BY jurnal.jurnal_tgl ASC";
		$resskre = mysqli_query($conn, $sqlkre);
		$kre =0;
		while($datakre = mysqli_fetch_array($resskre)){
			$kredit = $datakre['jurnal_jml'];
			$kre+=$kredit;
		}
*/
	}else{
								if($bln=="01"){
									$bl = "Januari";
								}else if($bln=="02"){
									$bl = "Februari";
								}else if($bln=="03"){
									$bl = "Maret";
								}else if($bln=="04"){
									$bl = "April";
								}else if($bln=="05"){
									$bl = "Mei";
								}else if($bln=="06"){
									$bl = "Juni";
								}else if($bln=="07"){
									$bl = "Juli";
								}else if($bln=="08"){
									$bl = "Agustus";
								}else if($bln=="09"){
									$bl = "September";
								}else if($bln=="10"){
									$bl = "Oktober";
								}else if($bln=="11"){
									$bl = "November";
								}else{			
									$bl = "Desember";
								}			
		$pagedesc = "Data Jurnal Periode " .$bl."-".$th;
		$periode = "Periode ".$bl." ".$th;
		$sql = "SELECT jurnal.*, akun.* FROM jurnal, akun 
				WHERE jurnal.akun_kode=akun.akun_kode AND jurnal.akun_kode!='0'
				AND jurnal.jurnal_bl='$bln' AND jurnal.jurnal_th='$th'
				ORDER BY jurnal.jurnal_tgl ASC";
		$ress = mysqli_query($conn, $sql);

	/*	$sqldeb = "SELECT jurnal.*, akun.* FROM jurnal, akun 
				WHERE jurnal.akun_kode=akun.akun_kode AND akun.akun_jenis='Debet' AND jurnal.akun_kode!='0'
				AND jurnal.jurnal_bl='$bln' AND jurnal.jurnal_th='$th'
				ORDER BY jurnal.jurnal_tgl ASC";
		$ressdeb = mysqli_query($conn, $sqldeb);
		$deb =0;
		while($datadeb = mysqli_fetch_array($ressdeb)){
			$debet = $datadeb['jurnal_jml'];
			$deb+=$debet;
		}

		$sqlkre = "SELECT jurnal.*, akun.* FROM jurnal, akun 
				WHERE jurnal.akun_kode=akun.akun_kode AND akun.akun_jenis='Kredit'
				AND jurnal.jurnal_bl='$bln' AND jurnal.jurnal_th='$th'
				ORDER BY jurnal.jurnal_tgl ASC";
		$resskre = mysqli_query($conn, $sqlkre);
		$kre =0;
		while($datakre = mysqli_fetch_array($resskre)){
			$kredit = $datakre['jurnal_jml'];
			$kre+=$kredit;
		}
		*/
	}

	// deskripsi halaman
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
			<h5 class="text-center">Data Jurnal <?php echo $periode;?></h5>
			<br />	

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="5%"><center>No</center></th>
						<th width="8%"><center>No. Trx</center></th>
						<th width="8%"><center>No. Reff</center></th>
						<th width="8%"><center>Akun</center></th>
						<th width="8%"><center>Tanggal</center></th>
						<th width="8%"><center>Keterangan</center></th>
						<th width="8%"><center>Beban Gaji (D)</center></th>
						<th width="8%"><center>Hutang Gaji (K)</center></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$n=1;
					while($data=mysqli_fetch_array($ress)){
						echo '<tr>';
						echo '<td class="text-center">'. $n .'</td>';
						echo '<td class="text-center">'. $data['jurnal_trx'] .'</td>';
						echo '<td class="text-nowrap">'. $data['jurnal_reff'] .'</td>';
						echo '<td class="text-center">'.$data['akun_kode'].'<br/>'.$data['akun_nama'].'</td>';
						echo '<td class="text-center">'. IndonesiaTgl($data['jurnal_tgl']) .'</td>';
						echo '<td class="text-center">'. $data['jurnal_ket'] .'</td>';
						echo '<td class="text-center">'. format_rupiah($data['jurnal_jml']) .'</td>';
						echo '<td class="text-center">'. format_rupiah($data['jurnal_jml']) .'</td>';
						$n++;
						}
						?>
				</tbody>
				
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