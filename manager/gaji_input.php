<?php
 $pagedesc = "Data Gaji";
 include("sess_check.php");
 include("../conf/format_rupiah.php");

	if(isset($_GET['kry'])) {
		$kry = $_GET['kry'];
		$abs = $_GET['abs'];
		$no = $_GET['no'];

		$sqla = "SELECT * FROM abs WHERE abs_id='$_GET[abs]'";
		$ressa = mysqli_query($conn, $sqla);
		$dataa = mysqli_fetch_array($ressa);
		$bln = $dataa['abs_bln'];
		$th = $dataa['abs_th'];
		$bl = $dataa['abs_bl'];
		
		$sql = "SELECT gaji_karyawan.*, karyawan.*, bagian.* FROM gaji_karyawan, karyawan, bagian 
				WHERE karyawan.bagian_id=bagian.bagian_id AND gaji_karyawan.karyawan_id=karyawan.karyawan_id 
				AND gaji_karyawan.gaj_no='$no'";
		$ress = mysqli_query($conn, $sql);
		while($data = mysqli_fetch_array($ress)) {
			$gapok = $data['bagian_gaji'];
			$galem = $data['bagian_lembur'];
			$nama = $data['karyawan_nama'];
			$kry = $data['karyawan_id'];
			$pay = $data['gaj_pay'];
			$ket = $data['gaj_ket'];
					
			$jamlembur = 0;
			$tjg = 0;
			$pot = 0;
			$ttllembur=0;;
				
			//cari lembur
			$sqllem = "SELECT * FROM lembur WHERE lembur_bl='$bl' AND lembur_th='$th' AND karyawan_id='$kry'";
			$resslem = mysqli_query($conn, $sqllem);
			while($datalem = mysqli_fetch_array($resslem)){
					$jamlembur+=$datalem['lembur_jam'];
			}												
			$ttllembur = $jamlembur*$galem;
													
						//cari tunjangan
			$sqltjg = "SELECT * FROM tunjangan WHERE tjg_bl='$bl' AND tjg_th='$th' AND karyawan_id='$kry'";
			$resstjg = mysqli_query($conn, $sqltjg);
			while($datatjg = mysqli_fetch_array($resstjg)){
				$tjg+=$datatjg['tjg_jml'];
			}
						
			//cari potongan
			$sqlpot = "SELECT * FROM potongan WHERE pot_bl='$bl' AND pot_th='$th' AND karyawan_id='$kry'";
			$resspot = mysqli_query($conn, $sqlpot);
			while($datapot = mysqli_fetch_array($resspot)){
				$pot+=$datapot['pot_jml'];
			}
			$masukan = $gapok+$ttllembur+$tjg;
			$keluaran = $pot;
			$bersih = $masukan-$keluaran;
			
		}

	}
	
	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$no = $_POST['no'];
		$via = $_POST['via'];
		$gapok = $_POST['gapok'];
		$tjg = $_POST['tjg'];
		$lembur = $_POST['lembur'];
		$pot = $_POST['pot'];
		$bersih = $_POST['bersih'];
		$ket = $_POST['ket'];
		$app = $_POST['app'];
		$now = date('Y-m-d');
		$bln = $_POST['bln'];
		$th = $_POST['th'];
		$bl = $_POST['bl'];
		
		$ketjur = "Gaji Bulan ".$bln."-".$th;

		$wd = "TRX";
		$noj = buatKode("jurnal",$wd);
		
		if($app=="Approved"){
			$sql = "UPDATE gaji_karyawan SET
						gaj_lembur='". $lembur ."',
						gaj_tjg='". $tjg ."',
						gaj_pot='". $pot ."',
						gaj_pok='". $gapok ."',
						gaj_stt='". $app ."',
						gaj_bersih='". $bersih ."',
						gaj_pay='". $via ."',
						gaj_tgl='". $now ."',
						gaj_ket='". $ket ."'
					WHERE gaj_no='". $no ."'";
			$ress = mysqli_query($conn, $sql);


			$sqljur = "INSERT INTO jurnal(jurnal_trx,jurnal_reff,jurnal_tgl,akun_kode,jurnal_jml,jurnal_ket,jurnal_bl,jurnal_th)
				VALUES('$noj','$no','$now','0','$bersih','$ketjur','$bl','$th')";
			$ressjur = mysqli_query($conn, $sqljur);

			if($ress){
				echo "<script>alert('Update data berhasil!');</script>";
				echo "<script type='text/javascript'> document.location = 'gaji_lihat.php?abs=$abs'; </script>";
			}else{
			//	echo("Error description: " . mysqli_error($conn));
				echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
				echo "<script type='text/javascript'> document.location = 'gaji_input.php?kry=$id&abs=$abs&no=$no'; </script>";
			}
		}else{
			$sql = "UPDATE gaji_karyawan SET
						gaj_stt='". $app ."',
						gaj_pay='". $via ."',
						gaj_ket='". $ket ."'
					WHERE gaj_no='". $no ."'";
			$ress = mysqli_query($conn, $sql);
			if($ress){
				echo "<script>alert('Update data berhasil!');</script>";
				echo "<script type='text/javascript'> document.location = 'gaji_lihat.php?abs=$abs'; </script>";
			}else{
			//	echo("Error description: " . mysqli_error($conn));
				echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
				echo "<script type='text/javascript'> document.location = 'gaji_input.php?kry=$id&abs=$abs&no=$no'; </script>";
			}			
		}
		
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $sysname;?> - <?php echo $pagedesc;?></title>
  <link href="../img/honda.jpg" rel="icon" type="images/x-icon">

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<?php
 include("sidebar.php");
?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-info topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
<?php
 include("navbar.php");
?>
        </nav>
        <!-- End of Topbar -->
<script type="text/javascript">
	function checkIdAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
		url: "check_idavailability.php",
		data:'id='+$("#id").val(),
		type: "POST",
		success:function(data){
			$("#user-availability-status").html(data);
			$("#loaderIcon").hide();
		},
		error:function (){}
	});
	}
</script>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Gaji</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><a href="gaji_lihat.php?abs=<?php echo $abs;?>"><i class="fa fa-arrow-circle-left"></i></a>  Data Gaji Periode <?php echo $bln;?>-<?php echo $th;?> </h6>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">										
						<form class="user" action="" method="POST" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">ID Karyawan</label>
							<div class="col-sm-6">
								<input type="text" name="id" id="id" class="form-control" placeholder="ID Karyawan" value="<?php echo $kry;?>" readonly>
								<input type="hidden" name="no"  class="form-control" value="<?php echo $no;?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Nama</label>
							<div class="col-sm-6">
								<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $nama;?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Gaji Pokok</label>
							<div class="col-sm-6">
								<input type="text" name="gapok1" class="form-control" placeholder="Nama" value="<?php echo format_rupiah($gapok);?>" readonly>
								<input type="hidden" name="gapok" class="form-control" placeholder="Nama" value="<?php echo $gapok;?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Tunjangan</label>
							<div class="col-sm-6">
								<input type="text" name="tjg1" class="form-control" placeholder="Nama" value="<?php echo format_rupiah($tjg);?>" readonly>
								<input type="hidden" name="tjg" class="form-control" placeholder="Nama" value="<?php echo $tjg;?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Lembur</label>
							<div class="col-sm-6">
								<input type="text" name="lembur1" class="form-control" placeholder="Nama" value="<?php echo format_rupiah($ttllembur);?>" readonly>
								<input type="hidden" name="lembur" class="form-control" placeholder="Nama" value="<?php echo $ttllembur;?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Potongan</label>
							<div class="col-sm-6">
								<input type="text" name="pot1" class="form-control" placeholder="Nama" value="<?php echo format_rupiah($pot);?>" readonly>
								<input type="hidden" name="pot" class="form-control" placeholder="Nama" value="<?php echo $pot;?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Gaji Bersih</label>
							<div class="col-sm-6">
								<input type="text" name="bersih1" class="form-control" placeholder="Nama" value="<?php echo format_rupiah($bersih);?>" readonly>
								<input type="hidden" name="bersih" class="form-control" placeholder="Nama" value="<?php echo $bersih;?>" readonly>
								<input type="hidden" name="bln" class="form-control" placeholder="Nama" value="<?php echo $bln;?>" readonly>
								<input type="hidden" name="th" class="form-control" placeholder="Nama" value="<?php echo $th;?>" readonly>
								<input type="hidden" name="bl" class="form-control" placeholder="Nama" value="<?php echo $bl;?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Metode Pembayaran</label>
							<div class="col-sm-6">
								<select class="form-control" name="via" required>
									<option value="<?php echo $pay;?>" selected><?php echo $pay;?></option>";
									<option value="Cash">Cash</option>";
									<option value="Transfer">Transfer</option>";
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Keterangan</label>
							<div class="col-sm-6">
								<textarea name="ket" class="form-control"><?php echo $ket;?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Approval</label>
							<div class="col-sm-6">
								<select class="form-control" name="app" required>
									<option value="" selected>=== Pilih Approval ==</option>";
									<option value="Approved">Approved</option>";
									<option value="Rejected">Rejected</option>";
								</select>
							</div>
						</div>
						<hr/>
						</div>
						<div class="panel-footer">
							<button type="submit" name="update" class="btn btn-success">Update</button>
						</div>
						</div><!-- /.panel -->
						</form>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->

			</div>
          </div>

        </div>
        <!-- /.container-fluid -->

		<!-- Large modal -->
			<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<p>Sedang memproses…</p>
						</div>
					</div>
				</div>
			</div>    

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
	  <?php 
		include("layout_bottom.php");
	  ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

<script>
		var app = {
			code: '0'
		};
		
		$('[data-load-id]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-id');
					if(code) {
						$($this.data('remote-target')).load('karyawan_view.php?code='+code);
						app.code = code;
						
					}
		});		

</script>
</body>
</html>
