<?php
 $pagedesc = "Data Absensi";
 include("sess_check.php");

	if(isset($_GET['kry'])) {
		$kry = $_GET['kry'];
		$abs = $_GET['abs'];

		$sqlk = "SELECT * FROM karyawan WHERE karyawan_id='$_GET[kry]'";
		$ressk = mysqli_query($conn, $sqlk);
		$datak = mysqli_fetch_array($ressk);

		$sqla = "SELECT * FROM abs WHERE abs_id='$_GET[abs]'";
		$ressa = mysqli_query($conn, $sqla);
		$dataa = mysqli_fetch_array($ressa);
		$bln = $dataa['abs_bln'];
		$th = $dataa['abs_th'];
		$bl = $dataa['abs_bl'];

		$sqlcek = "SELECT absensi.*,karyawan.*,abs.* FROM absensi,karyawan,abs WHERE absensi.karyawan_id=karyawan.karyawan_id AND absensi.abs_id=abs.abs_id
					AND abs.abs_id='$abs' AND karyawan.karyawan_id='$kry'";
		$resscek = mysqli_query($conn, $sqlcek);
		$rowscek = mysqli_num_rows($resscek);
		$datacek = mysqli_fetch_array($resscek);
		if($rowscek>0){
			$h=$datacek['absensi_h'];
			$s=$datacek['absensi_s'];
			$i=$datacek['absensi_i'];
			$a=$datacek['absensi_a'];							
		}else{
			$h="0";
			$s="0";
			$i="0";
			$a="0";
		}
	}
	
	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$abs = $_POST['abs'];
		$rows = $_POST['rows'];
		$h = $_POST['h'];
		$s = $_POST['s'];
		$i = $_POST['i'];
		$a = $_POST['a'];
		if($rows>0){
			$sql  = "UPDATE absensi SET absensi_h='".$h."', absensi_s='".$s."', absensi_i='".$i."', absensi_a='".$a."' WHERE karyawan_id='".$id."' AND abs_id='".$abs."'";
			$ress = mysqli_query($conn, $sql);
			if($ress){
				echo "<script>alert('Update Data Berhasil!');</script>";
				echo "<script type='text/javascript'> document.location = 'absensi_lihat.php?abs=$abs'; </script>";
			}else{
			//	echo("Error description: " . mysqli_error($conn));
				echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
				echo "<script type='text/javascript'> document.location = 'absensi_input.php?kry=$id&abs=$abs'; </script>";
			}
		}else{
			$sql  = "INSERT INTO absensi(abs_id,karyawan_id,absensi_h,absensi_s,absensi_i,absensi_a)VALUES('$abs','$id','$h','$s','$i','$a')";
			$ress = mysqli_query($conn, $sql);
			if($ress){
				echo "<script>alert('Update Data Berhasil!');</script>";
				echo "<script type='text/javascript'> document.location = 'absensi_lihat.php?abs=$abs'; </script>";
			}else{
			//	echo("Error description: " . mysqli_error($conn));
				echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
				echo "<script type='text/javascript'> document.location = 'absensi_input.php?kry=$id&abs=$abs'; </script>";
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
          <h1 class="h3 mb-2 text-gray-800">Data Absensi</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><a href="absensi_lihat.php?abs=<?php echo $abs;?>"><i class="fa fa-arrow-circle-left"></i></a>  Input Absensi <?php echo $bln;?>-<?php echo $th;?> </h6>
            </div>
            <div class="card-body">

				<div class="row">
					<div class="col-lg-12 col-md-12">										
						<form class="user" action="" method="POST" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">ID Karyawan</label>
							<div class="col-sm-6">
								<input type="text" name="id" id="id" class="form-control" placeholder="ID Karyawan" value="<?php echo $datak['karyawan_id'];?>" readonly>
								<input type="hidden" name="abs"  class="form-control" value="<?php echo $abs;?>" readonly>
								<input type="hidden" name="rows"  class="form-control" value="<?php echo $rowscek;?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Nama</label>
							<div class="col-sm-6">
								<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $datak['karyawan_nama'];?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Hadir</label>
							<div class="col-sm-6">
								<input type="number" name="h" class="form-control" placeholder="Nama" value="<?php echo $h;?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Sakit</label>
							<div class="col-sm-6">
								<input type="number" name="s" class="form-control" placeholder="Nama" value="<?php echo $s;?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Izin</label>
							<div class="col-sm-6">
								<input type="number" name="i" class="form-control" placeholder="Nama" value="<?php echo $i;?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Alfa</label>
							<div class="col-sm-6">
								<input type="number" name="a" class="form-control" placeholder="Submit" value="<?php echo $a;?>" required>
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
