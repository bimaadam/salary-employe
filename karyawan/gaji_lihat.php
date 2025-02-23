<?php
 $pagedesc = "Data Gaji";
 include("sess_check.php");
 include("../conf/format_rupiah.php");
	if(isset($_GET['abs'])) {
		$abs = $_GET['abs'];
		$sqla = "SELECT * FROM abs WHERE abs_id='$_GET[abs]'";
		$ressa = mysqli_query($conn, $sqla);
		$dataa = mysqli_fetch_array($ressa);
		$bln = $dataa['abs_bln'];
		$th = $dataa['abs_th'];
		$bl = $dataa['abs_bl'];
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

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Gaji</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><a href="gaji.php"><i class="fa fa-arrow-circle-left"></i></a>  Data Gaji Periode <?php echo $bln;?>-<?php echo $th;?> </h6>
            </div>
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="5%"><center>No</center></th>
						<th width="8%"><center>ID</center></th>
						<th width="10%"><center>Nama</center></th>
						<th width="5%"><center>Gapok</center></th>
						<th width="5%"><center>Tunjangan</center></th>
						<th width="5%"><center>Lembur</center></th>
						<th width="5%"><center>Potongan</center></th>
						<th width="5%"><center>Gaji Bersih</center></th>
						<th width="5%"><center>Status</center></th>
						<th width="5%"><center>Opsi</center></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$n = 1;
					$sql = "SELECT gaji_karyawan.*, karyawan.*, bagian.* FROM gaji_karyawan, karyawan, bagian 
							WHERE karyawan.bagian_id=bagian.bagian_id AND gaji_karyawan.karyawan_id=karyawan.karyawan_id 
							AND gaji_karyawan.gaj_stt='Menunggu Approval' AND gaji_karyawan.abs_id='$abs'";
					$ress = mysqli_query($conn, $sql);
					while($data = mysqli_fetch_array($ress)) {
						$idkry = $data['karyawan_id'];
						$gapok = $data['bagian_gaji'];
						$galem = $data['bagian_lembur'];
						$num = $data['gaj_no'];
						
						$jamlembur = 0;
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

						//cari pengajuan
						$sqlc = "SELECT * FROM gaji_karyawan WHERE karyawan_id='$idkry' AND abs_id='$abs'";
						$ressc = mysqli_query($conn, $sqlc);
						$rowsc = mysqli_num_rows($ressc);
						$datac = mysqli_fetch_array($ressc);
						if($rowsc>0){
							$st = $datac['gaj_stt'];
						}else{
							$st = "Belum Diajukan";
						}

				
						echo '<tr>';
						echo '<td class="text-center">'. $n .'</td>';
						echo '<td class="text-center">'. $data['karyawan_id'] .'</td>';
						echo '<td class="text-nowrap">'. $data['karyawan_nama'] .'</td>';
						echo '<td class="text-center">'. format_rupiah($gapok) .'</td>';
						echo '<td class="text-center">'. format_rupiah($tjg) .'</td>';
						echo '<td class="text-center">'. format_rupiah($ttllembur) .'</td>';
						echo '<td class="text-center">'. format_rupiah($pot) .'</td>';
						echo '<td class="text-center">'. format_rupiah($bersih) .'</td>';
						echo '<td class="text-center">'. $st .'</td>';
						echo '<td class="text-center">
							<a href="gaji_input.php?kry='. $data['karyawan_id'].'&abs='. $abs.'&no='. $num.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a></tr>';												
						$n++;
						}
						?>
				</tbody>
                </table>
              </div>
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
