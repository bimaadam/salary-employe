<?php
 $pagedesc = "Data Gaji";
 include("sess_check.php");
 if(isset($_POST['simpan'])){
		$period = $_POST['period'];
		$stt = "Menunggu Approval";
		
		
		$sqlab = "SELECT * FROM abs WHERE abs_id='$period'";
		$ressab = mysqli_query($conn, $sqlab);
		$datab =mysqli_fetch_array($ressab);
		$bl = $datab['abs_bl'];
		$th = $datab['abs_th'];
		
		
		//input gaji
		$sql  = "INSERT INTO gaji(abs_id,gaji_stt)VALUES('$period','$stt')";
		$ress = mysqli_query($conn, $sql);		

		//cari gaji
		$sqlg = "SELECT * FROM gaji WHERE abs_id='$period'";
		$ressg = mysqli_query($conn, $sqlg);
		$datag = mysqli_fetch_array($ressg);
		$gid = $datag['gaji_id'];

		if($ress){
			$sqlkary = "SELECT karyawan.*, bagian.* FROM karyawan, bagian WHERE karyawan.bagian_id=bagian.bagian_id AND karyawan.karyawan_status='Aktif'";
			$resskary = mysqli_query($conn, $sqlkary);
			while($data=mysqli_fetch_array($resskary)){
				$idkry = $data['karyawan_id'];
				$num = $idkry.'-'.$bl.$th;
				$gapok = $data['bagian_gaji'];
				$galem = $data['bagian_lembur'];
				
				$jamlembur = 0.0;
				$tjg = 0;
				$pot = 0;
				$ttllembur=0;;
				
				//cari lembur
				$sqllem = "SELECT * FROM lembur WHERE karyawan_id='$idkry' AND lembur_bl='$bl' AND lembur_th='$th'";
				$resslem = mysqli_query($conn, $sqllem);
				while($datalem = mysqli_fetch_array($resslem)){
					$jamlembur+=$datalem['lembur_jam'];
				}												
				$ttllembur = $jamlembur*$galem;
												
				//cari tunjangan
				$sqltjg = "SELECT * FROM tunjangan WHERE karyawan_id='$idkry' AND tjg_bl='$bl' AND tjg_th='$th'";
				$resstjg = mysqli_query($conn, $sqltjg);
				while($datatjg = mysqli_fetch_array($resstjg)){
					$tjg+=$datatjg['tjg_jml'];
				}
				
				//cari potongan
				$sqlpot = "SELECT * FROM potongan WHERE karyawan_id='$idkry' AND pot_bl='$bl' AND pot_th='$th'";
				$resspot = mysqli_query($conn, $sqlpot);
				while($datapot = mysqli_fetch_array($resspot)){
					$pot+=$datapot['pot_jml'];
				}
				
				$masukan = $gapok+$ttllembur+$tjg;
				$keluaran = $pot;
				$bersih = $masukan-$keluaran;

				$sqlgaji  = "INSERT INTO gaji_karyawan(gaj_no,karyawan_id,gaji_id,gaj_jam,gaj_tjg,gaj_pot,gaj_stt,gaj_pok,gaj_bersih)
						VALUES('$num','$idkry','$gid','$ttllembur','$tjg','$pot','$stt','$gapok','$bersih')";
				$ressgaji = mysqli_query($conn, $sqlgaji);		
				if($ressgaji){
					echo "<script>alert('Pengajuan berhasil!');</script>";
					echo "<script type='text/javascript'> document.location = 'gaji.php'; </script>";					
				}else{
					echo("Error description: " . mysqli_error($conn));
				//	echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
					//echo "<script type='text/javascript'> document.location = 'gaji_tambah.php'; </script>";
				}					
			}
		}else{
			echo("Error description: " . mysqli_error($conn));
		//	echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			//echo "<script type='text/javascript'> document.location = 'gaji_tambah.php'; </script>";
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
  <link href="img/honda.jpg" rel="icon" type="images/x-icon">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Gaji</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Pengajuan Gaji</h6>
            </div>
            <div class="card-body">

				<div class="row">
					<div class="col-lg-12 col-md-12">										
						<form class="user" action="" method="POST" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Periode</label>
							<div class="col-sm-6">
								<select class="form-control" name="period" required>
								<?php
									$mySql = "SELECT * FROM abs WHERE abs_id NOT IN(SELECT abs_id FROM gaji) ORDER BY abs_id DESC";
									$myQry = mysqli_query($conn, $mySql);
									echo "<option value=''>====== Pilih Periode ======</option>";
									while ($myData = mysqli_fetch_array($myQry)) {
										$dataKry=$data['abs_id'];
										if ($myData['abs_id']== $dataKry) {
											$cek = " selected";
										} else { $cek=""; }
											echo "<option value='$myData[abs_id]' $cek>$myData[abs_bln] - $myData[abs_th] </option>";
										}
									?>
									</select>
							</div>
						</div>
						<hr/>
						</div>
						<div class="panel-footer">
							<button type="submit" name="simpan" class="btn btn-success">Ajukan</button>
							<a href="gaji.php" class="btn btn-info">Batal</a>
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

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
