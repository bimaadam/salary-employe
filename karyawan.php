<?php
 $pagedesc = "Data Karyawan";
 include("sess_check.php");
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
          <h1 class="h3 mb-2 text-gray-800">Data Karyawan</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
				<a href="karyawan_tambah.php" class="btn btn-success">Tambah</a>
            </div>
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="8%">ID</th>
						<th width="10%">Nama</th>
						<th width="8%">Telepon</th>
						<th width="10%">Bagian</th>
						<th width="10%">Status</th>
						<th width="10%">Opsi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i = 1;
					$sql = "SELECT karyawan.*, bagian.* FROM karyawan, bagian WHERE karyawan.bagian_id=bagian.bagian_id ORDER BY karyawan.karyawan_nama ASC";
					$ress = mysqli_query($conn, $sql);
					while($data = mysqli_fetch_array($ress)) {
						echo '<tr>';
						echo '<td class="text-center">'. $i .'</td>';
						echo '<td class="text-center">'. $data['karyawan_id'] .'</td>';
						echo '<td class="text-nowrap">'. $data['karyawan_nama'] .'</td>';
						echo '<td class="text-center">'. $data['karyawan_telp'] .'</td>';
						echo '<td class="text-center">'. $data['bagian_nama'] .'</td>';
						echo '<td class="text-center">'. $data['karyawan_status'] .'</td>';
						echo '<td class="text-center">
							<a href="#myModal" data-toggle="modal" data-load-id="'.$data['karyawan_id'].'" data-remote-target="#myModal .modal-body" class="btn btn-info btn-circle btn-sm"><i class="fas fa-info-circle"></i></a>
							<a href="karyawan_edit.php?kry='. $data['karyawan_id'] .'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a>';?>
							<a href="karyawan_hapus.php?kry=<?php echo $data['karyawan_id'];?>" onclick="return confirm('Apakah anda yakin akan menghapus <?php echo $data['karyawan_nama'];?>?');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
							<a href="karyawan_reset.php?kry=<?php echo $data['karyawan_id'];?>" onclick="return confirm('Apakah anda yakin akan mereset password <?php echo $data['karyawan_nama'];?>?');" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-recycle"></i></a></td>
						<?php
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
