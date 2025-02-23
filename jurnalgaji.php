<?php
 $pagedesc = "Jurnal Gaji";
 include("sess_check.php");
 include("conf/format_tanggal.php");
 include("conf/format_rupiah.php");
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
          <h1 class="h3 mb-2 text-gray-800">Jurnal Gaji</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
            <div class="card-body">		  
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
					        <form method="get" class="user" name="laporan" onSubmit="return valid();"> 
								<div class="form-group row">
									<label class="col-form-label col-sm-4">Bulan</label>
									<label class="col-form-label col-sm-4">Tahun</label>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<select class="form-control" name="bln" required>
											<option value="" selected>== Pilih Bulan ==</option>
											<option value="01">Januari</option>
											<option value="02">Februari</option>
											<option value="03">Maret</option>
											<option value="04">April</option>
											<option value="05">Mei</option>
											<option value="06">Juni</option>
											<option value="07">Juli</option>
											<option value="08">Agustus</option>
											<option value="09">September</option>
											<option value="10">Oktober</option>
											<option value="11">November</option>
											<option value="12">Desember</option>
										</select>
									</div>
									<div class="col-sm-4">
										<select class="form-control" name="thn" required>
											<option value="" selected>== Pilih Tahun ==</option>
											<?php
												$ynow = date('Y');
												for($x=$ynow;$x>=2010;$x--){
											?>
											<option value="<?php echo $x;?>"><?php echo $x;?></option>
											<?php 
												}
												?>
										</select>
									</div>
									<div class="col-sm-4">
										<input type="submit" name="submit" value="Lihat" class="btn btn-primary">
									</div>
								</div>
							</form>
						<hr/>
							</div>
						</div>
						</div>
						</div>
						<?php
							if(isset($_GET['submit'])){
								$no=0;
								$bln = $_GET['bln'];
								$thn = $_GET['thn'];
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

								$sql = "SELECT jurnal.*, akun.* FROM jurnal, akun 
										WHERE jurnal.akun_kode=akun.akun_kode 
										AND jurnal.jurnal_bl='$bln' AND jurnal.jurnal_th='$thn' AND jurnal.akun_kode='0'
										ORDER BY jurnal.jurnal_tgl DESC";
								$ress = mysqli_query($conn, $sql);
							?>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Jurnal Gaji Periode <?php echo $bl;?>-<?php echo $thn;?>    <!--<a href="jurnal_cetak.php?bl=<?php echo $bln;?>&th=<?php echo $thn;?>" target="_blank" class="btn btn-info btn-sm">Cetak</a>--></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead align="center">
					<tr>
						<th width="1%">No</th>
						<th width="10%">No. Trx</th>
						<th width="10%">No. Reff</th>
						<th width="10%">Tanggal</th>
						<th width="10%">Akun</th>
						<th width="10%">Hutang Gaji (D)</th>
						<th width="10%">KAS (K)</th>
						<th width="10%">Keterangan</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i = 1;
					while($data = mysqli_fetch_array($ress)) {
						echo '<tr>';
						echo '<td class="text-center">'. $i .'</td>';
						echo '<td class="text-left">'. $data['jurnal_trx'] .'</td>';
						echo '<td class="text-left">'. $data['jurnal_reff'] .'</td>';
						echo '<td class="text-center">'. format_tanggal($data['jurnal_tgl']) .'</td>';
						echo '<td class="text-left">'.$data['akun_nama'].'</td>';
						echo '<td class="text-left">'. format_rupiah($data['jurnal_jml']) .'</td>';
						echo '<td class="text-left">'. format_rupiah($data['jurnal_jml']) .'</td>';
						echo '<td class="text-left">'. $data['jurnal_ket'] .'</td>';
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
							<?php }else{?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Semua Jurnal Gaji <!--    <a href="jurnal_cetak.php?bl=all&th=all" target="_blank" class="btn btn-info btn-sm">Cetak</a>--></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead align="center">
					<tr>
						<th width="1%">No</th>
						<th width="10%">No. Trx</th>
						<th width="10%">No. Reff</th>
						<th width="10%">Tanggal</th>
						<th width="10%">Akun</th>
						<th width="10%">Hutang Gaji (D)</th>
						<th width="10%">KAS (K)</th>
						<th width="10%">Keterangan</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i = 1;
					$sql = "SELECT jurnal.*, akun.* FROM jurnal, akun 
							WHERE jurnal.akun_kode=akun.akun_kode AND jurnal.akun_kode='0'
							ORDER BY jurnal.jurnal_tgl DESC";
					$ress = mysqli_query($conn, $sql);
					while($data = mysqli_fetch_array($ress)) {
						echo '<tr>';
						echo '<td class="text-center">'. $i .'</td>';
						echo '<td class="text-left">'. $data['jurnal_trx'] .'</td>';
						echo '<td class="text-left">'. $data['jurnal_reff'] .'</td>';
						echo '<td class="text-center">'. format_tanggal($data['jurnal_tgl']) .'</td>';
						echo '<td class="text-left">'.$data['akun_nama'].'</td>';
						echo '<td class="text-left">'. format_rupiah($data['jurnal_jml']) .'</td>';
						echo '<td class="text-left">'. format_rupiah($data['jurnal_jml']) .'</td>';
						echo '<td class="text-left">'. $data['jurnal_ket'] .'</td>';
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
							<?php
							}
							?>							
							
							
							
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
