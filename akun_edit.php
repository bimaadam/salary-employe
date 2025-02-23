<?php
 $pagedesc = "Data Akun";
 include("sess_check.php");

	if(isset($_GET['akn'])) {
		$sql = "SELECT * FROM akun WHERE akun_kode='". $_GET['akn'] ."'";
		$ress = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($ress);
	}

	if(isset($_POST['perbarui'])) {
		$id = addslashes($_POST['id']);
		$kode = addslashes($_POST['kode']);
		$nama = addslashes($_POST['nama']);

		if($id!=$kode){
			$sqlcek = "SELECT * FROM akun WHERE akun_kode='$kode'";
			$resscek = mysqli_query($conn, $sqlcek);
			$rows = mysqli_num_rows($resscek);
			if($rows<1){
				$sql = "UPDATE akun SET
						akun_kode='". $kode ."',
						akun_nama='". $nama ."'
					WHERE akun_kode='". $id ."'";
				$ress = mysqli_query($conn, $sql);
				if($ress){
					echo "<script>alert('Edit Data Berhasil!');</script>";
					echo "<script type='text/javascript'> document.location = 'akun.php'; </script>";
				}else{
				//	echo("Error description: " . mysqli_error($conn));
					echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
					echo "<script type='text/javascript'> document.location = 'akun_edit.php?akn=$id'; </script>";
				}
			}else{
				header("location: akun_edit.php?akn=$id&act=add&msg=double");			
			}
		}else{
				$sql = "UPDATE akun SET
						akun_nama='". $nama ."'
					WHERE akun_kode='". $id ."'";
				$ress = mysqli_query($conn, $sql);
				if($ress){
					echo "<script>alert('Edit Data Berhasil!');</script>";
					echo "<script type='text/javascript'> document.location = 'akun.php'; </script>";
				}else{
				//	echo("Error description: " . mysqli_error($conn));
					echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
					echo "<script type='text/javascript'> document.location = 'akun_edit.php?akn=$id'; </script>";
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

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Akun</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
            </div>
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
            <div class="card-body">

				<div class="row">
					<div class="col-lg-12 col-md-12">										
						<form class="user" action="" method="POST" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Kode Akun</label>
							<div class="col-sm-6">
								<input type="text" name="kode" class="form-control" value="<?php echo $data['akun_kode'];?>" required>
								<input type="hidden" name="id" class="form-control" value="<?php echo $data['akun_kode'];?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Nama Akun</label>
							<div class="col-sm-6">
								<input type="text" name="nama" class="form-control" placeholder="Nama Akun" value="<?php echo $data['akun_nama'];?>" required>
							</div>
						</div>
						<hr/>
						</div>
						<div class="panel-footer">
							<button type="submit" name="perbarui" class="btn btn-success">Update</button>
							<a href="akun.php" class="btn btn-info">Batal</a>
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
