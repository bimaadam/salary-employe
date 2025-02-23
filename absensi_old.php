<?php
 $pagedesc = "Data Absensi";
 include("sess_check.php");
 $now = date('Y-m-d');
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
          <h1 class="h3 mb-2 text-gray-800">Data Absensi</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
					        <form method="get" class="user" name="laporan" onSubmit="return valid();"> 
								<div class="form-group row">
									<label class="col-form-label col-sm-4">Tanggal</label>
									<label class="col-form-label col-sm-4">Keterangan</label>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<input type="date" class="form-control" name="tgl" value="<?php echo $now?>" required>
									</div>
									<div class="col-sm-4">
										<select class="form-control" name="ktr" required>
											<option value="Semua" selected>Semua</option>
											<option value="Terlambat">Terlambat</option>
											<option value="Tepat Waktu">Tepat Waktu</option>
										</select>
									</div>
									<div class="col-sm-4">
										<input type="submit" name="submit" value="Lihat Absensi" class="btn btn-primary">
									</div>
								</div>
							</form>
							</div>
						</div>
						<?php
							if(isset($_GET['submit'])){
								$no=0;
								$tgl = $_GET['tgl'];
								$ktr = $_GET['ktr'];
								if($ktr=='Semua'){									
									$sql = "SELECT absensi.*, karyawan.* FROM absensi, karyawan 
											WHERE absensi.karyawan_id=karyawan.karyawan_id 
											AND absensi.absen_tgl='$tgl' ORDER BY absensi.absen_id DESC";
								}else{
									$sql = "SELECT absensi.*, karyawan.* FROM absensi, karyawan 
											WHERE absensi.karyawan_id=karyawan.karyawan_id 
											AND absensi.absen_tgl='$tgl' AND absensi.absen_status='$ktr'
											ORDER BY absensi.absen_id DESC";
								}
								$ress = mysqli_query($conn, $sql);
							?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Absensi <?php echo $ktr;?>, Tanggal <?php echo IndonesiaTgl($tgl);?></h6>
            </div>
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="1%">No</th>
						<th width="10%">ID Karyawan</th>
						<th width="10%">Nama</th>
						<th width="8%">Jam Masuk</th>
						<th width="8%">Jam Keluar</th>
						<th width="10%">Keterangan</th>
						<th width="8%">Opsi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 1;
				while($data = mysqli_fetch_array($ress)) {
					$msk = $data['absen_masuk'];
					$plg = $data['absen_pulang'];
					if($msk==$plg){
						$ket = "Belum absen pulang";
					}else{
						$ket = $plg;
					}
					echo '<tr>';
					echo '<td class="text-center">'. $i .'</td>';
					echo '<td class="text-center">'. $data['karyawan_id'] .'</td>';
					echo '<td class="text-center">'. $data['karyawan_nama'] .'</td>';
					echo '<td class="text-center">'. $data['absen_masuk'] .'</td>';
					echo '<td class="text-center">'. $ket .'</td>';
					echo '<td class="text-center">'. $data['absen_status'] .'</td>';
					echo '<td class="text-center">
						<a href="absensi_edit.php?abs='. $data['absen_id'] .'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a>';?>
						<a href="absensi_hapus.php?abs=<?php echo $data['absen_id'];?>" onclick="return confirm('Apakah anda yakin akan menghapus absensi <?php echo $data['karyawan_nama'];?>?');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a></td>
					<?php
					echo '</td>';
					echo '</tr>';												
					$i++;
					}
				?>
				</tbody>
                </table>
				<div class="form-group">
					<a href="absensi_cetak.php?tgl=<?php echo $tgl;?>&ktr=<?php echo $ktr;?>" target="_blank" class="btn btn-warning">Cetak</a>
				</div>
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
	<?php }else{ 
			$no=0;
			$tgl 	 = $now;
			$sql = "SELECT absensi.*, karyawan.* FROM absensi, karyawan WHERE
					absensi.karyawan_id=karyawan.karyawan_id AND absensi.absen_tgl='$tgl' ORDER BY absensi.absen_id DESC";
			$ress = mysqli_query($conn, $sql);
	?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Semua Absensi, Tanggal <?php echo IndonesiaTgl($now);?></h6>
            </div>
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="1%">No</th>
						<th width="10%">ID Karyawan</th>
						<th width="10%">Nama</th>
						<th width="8%">Jam Masuk</th>
						<th width="8%">Jam Keluar</th>
						<th width="10%">Keterangan</th>
						<th width="8%">Opsi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 1;
				while($data = mysqli_fetch_array($ress)) {
					$msk = $data['absen_masuk'];
					$plg = $data['absen_pulang'];
					if($msk==$plg){
						$ket = "Belum absen pulang";
					}else{
						$ket = $plg;
					}
					echo '<tr>';
					echo '<td class="text-center">'. $i .'</td>';
					echo '<td class="text-center">'. $data['karyawan_id'] .'</td>';
					echo '<td class="text-center">'. $data['karyawan_nama'] .'</td>';
					echo '<td class="text-center">'. $data['absen_masuk'] .'</td>';
					echo '<td class="text-center">'. $ket .'</td>';
					echo '<td class="text-center">'. $data['absen_status'] .'</td>';
					echo '<td class="text-center">
						<a href="absensi_edit.php?abs='. $data['absen_id'] .'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a>';?>
						<a href="absensi_hapus.php?abs=<?php echo $data['absen_id'];?>" onclick="return confirm('Apakah anda yakin akan menghapus absensi <?php echo $data['karyawan_nama'];?>?');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a></td>
					<?php
					echo '</td>';
					echo '</tr>';												
					$i++;
					}
				?>
				</tbody>
                </table>
				<div class="form-group">
					<a href="absensi_cetak.php?tgl=<?php echo $tgl;?>&ktr=<?php echo 'Semua';?>" target="_blank" class="btn btn-warning">Cetak</a>
				</div>
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

		<?php }?>
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
