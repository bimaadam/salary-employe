<?php
 $pagedesc = "Data Gaji";
 include("sess_check.php");
 include("../conf/format_tanggal.php");
 include("../conf/format_rupiah.php");
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
				<!--<a href="gaji_tambah.php" class="btn btn-success">Ajukan</a>-->
            </div>
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead align="center">
					<tr>
						<th width="1%">No</th>
						<th width="10%">Periode</th>
						<th width="5%">Total Karyawan</th>
						<th width="5%">Menunggu Approval</th>
						<th width="5%">Rejected</th>
						<th width="5%">Approved</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i = 1;
					$sql = "SELECT * FROM abs ORDER BY abs_id DESC";
					$ress = mysqli_query($conn, $sql);
					while($data = mysqli_fetch_array($ress)) {
						$ab = $data['abs_id'];
						
					//hitung karyawan
					$sqlkry = "SELECT * FROM karyawan WHERE karyawan_status='Aktif'";
					$resskry = mysqli_query($conn, $sqlkry);
					$rowskry = mysqli_num_rows($resskry);
					
					//cek gaji
					$sqlcek = "SELECT * FROM gaji_karyawan WHERE abs_id='$ab'";
					$resscek = mysqli_query($conn, $sqlcek);
					$rowscek = mysqli_num_rows($resscek);
					
					if($rowscek>0){
						//cek pengajuan
						$sqlapp = "SELECT * FROM gaji_karyawan WHERE abs_id='$ab' AND gaj_stt='Menunggu Approval'";
						$ressapp = mysqli_query($conn, $sqlapp);
						$rowsapp = mysqli_num_rows($ressapp);

						//cek rejected
						$sqlrej = "SELECT * FROM gaji_karyawan WHERE abs_id='$ab' AND gaj_stt='Rejected'";
						$ressrej = mysqli_query($conn, $sqlrej);
						$rowsrej = mysqli_num_rows($ressrej);

						//cek accepted
						$sqlacc = "SELECT * FROM gaji_karyawan WHERE abs_id='$ab' AND gaj_stt='Approved'";
						$ressacc = mysqli_query($conn, $sqlacc);
						$rowsacc = mysqli_num_rows($ressacc);
					
					}else{
						$rowsapp = "0";
						$rowsrej = "0";
						$rowsacc = "0";
					}
					
						
						
					echo '<tr>';
					echo '<td class="text-center">'. $i .'</td>';
					echo '<td class="text-center">'. $data['abs_bln'] .'-'.$data['abs_th'].'</td>';
					echo '<td class="text-center">'. $rowskry.'<br/> <a href="gaji_all.php?abs='. $data['abs_id'] .'" class="btn btn-warning btn-sm">Lihat</i></a></td>';
					echo '<td class="text-center">'. $rowsapp.'<br/> <a href="gaji_wait.php?abs='. $data['abs_id'] .'" class="btn btn-warning btn-sm">Lihat</i></a></td>';
					echo '<td class="text-center">'. $rowsrej.'<br/> <a href="gaji_rej.php?abs='. $data['abs_id'] .'" class="btn btn-warning btn-sm">Lihat</i></a></td>';
					echo '<td class="text-center">'. $rowsacc.'<br/> <a href="gaji_app.php?abs='. $data['abs_id'] .'" class="btn btn-warning btn-sm">Lihat</i></a></td>';
					echo '</tr>';												
					$i++;
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
