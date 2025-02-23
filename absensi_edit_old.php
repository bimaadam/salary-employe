<?php
 $pagedesc = "Data Absensi";
 include("sess_check.php");

	if(isset($_GET['abs'])) {
		$sql = "SELECT absensi.*, karyawan.* FROM absensi, karyawan 
				WHERE absensi.karyawan_id=karyawan.karyawan_id AND absensi.absen_id='". $_GET['abs'] ."'";
		$ress = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($ress);
	}

	if(isset($_POST['perbarui'])){
		$id = $_POST['id'];
		$idkry = $_POST['idkry'];
		$in = $_POST['in'];
		$out = $_POST['out'];

		$sqlcekjdw = "SELECT karyawan.*, jadwal.* FROM karyawan, jadwal 
					  WHERE karyawan.jadwal_id=jadwal.jadwal_id AND karyawan.karyawan_id='$idkry'";
		$resscekjdw = mysqli_query($conn, $sqlcekjdw);
		$datajdw = mysqli_fetch_array($resscekjdw);
		$jdwin = $datajdw['jadwal_in'];
		$jdwout = $datajdw['jadwal_out'];
		$st="";	
		if($jdwin<=$in){
			$st = "Terlambat";
		}else{
			$st = "Tepat Waktu";
		}
			
		if($st=="Terlambat"){
			$awal = $in;
		}else{
			$awal = $jdwin;
		}
			
		if($jdwout<=$out){
			//menghitung interval waktu
			$time_in = new DateTime($awal);
			$time_out = new DateTime($jdwout);
			$interval = $time_in->diff($time_out);
			$hrs = $interval->format('%h');
			$mins = $interval->format('%i');
			$mins = $mins/60;
			$int = $hrs + $mins;
			if($int > 4){
				$int = $int - 1;
			}
			$sqlupd = "UPDATE absensi SET absen_masuk='$in', absen_pulang = '$out', absen_status='$st',
						absen_jam='$int' WHERE absen_id = '$id'";
			$resssqlupd = mysqli_query($conn, $sqlupd);
		}else{
			//menghitung interval waktu
			$time_in = new DateTime($awal);
			$time_out = new DateTime($out);
			$interval = $time_in->diff($time_out);
			$hrs = $interval->format('%h');
			$mins = $interval->format('%i');
			$mins = $mins/60;
			$int = $hrs + $mins;
			if($int > 4){
				$int = $int - 1;
			}
			$sqlupd = "UPDATE absensi SET absen_masuk='$in', absen_pulang = '$out', absen_status='$st',
						absen_jam='$int' WHERE absen_id = '$id'";
			$resssqlupd = mysqli_query($conn, $sqlupd);
		}

		if($resssqlupd){
			echo "<script>alert('Update Data Berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'absensi.php'; </script>";
		}else{
			echo("Error description: " . mysqli_error($conn));
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'absensi_edit.php?abs=$id'; </script>";
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
          <h1 class="h3 mb-2 text-gray-800">Data Absensi</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
            </div>
            <div class="card-body">

				<div class="row">
					<div class="col-lg-12 col-md-12">										
						<form class="user" action="" method="POST" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">ID Karyawan</label>
							<div class="col-sm-6">
								<input type="text" name="idkry" class="form-control" placeholder="Nama" value="<?php echo $data['karyawan_id'] ?>" readonly>
								<input type="hidden" name="id" class="form-control" placeholder="ID" value="<?php echo $data['absen_id'] ?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Nama</label>
							<div class="col-sm-6">
								<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['karyawan_nama'] ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Jam Masuk</label>
							<div class="col-sm-6">
								<input type="time" name="in" class="form-control" placeholder="Jam Keluar" value="<?php echo $data['absen_masuk'] ?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Jam Pulang</label>
							<div class="col-sm-6">
								<input type="time" name="out" class="form-control" placeholder="Jam Keluar" value="<?php echo $data['absen_pulang'] ?>" required>
							</div>
						</div>
						<hr/>
						</div>
						<div class="panel-footer">
							<button type="submit" name="perbarui" class="btn btn-success">Update</button>
							<a href="absensi.php" class="btn btn-info">Batal</a>
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
