<?php $pagedesc = "Login"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Penggajian - <?php echo $pagedesc; ?></title>
  <!-- <link href="img/honda.jpg" rel="icon" type="images/x-icon"> -->

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-6 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12 col-lg-offset-4 col-md-4 col-md-offset-4"><?php include("layout_alert.php"); ?></div>
            </div><!-- /.row -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <!-- <center><img src="img/honda.jpg" width="130" height="120"></center> -->
                  <h2 class="text-center">Sistem Penggajain | Rinbim.dev</h2>
                  <br />
                  <form class="user" action="login_auth.php" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="karyawanid">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <select name="akses" class="form-control" required>
                        <option value="">*** Login Sebagai ***</option>
                        <option value="admin">Admin HRD</option>
                        <option value="direktur">Direktur</option>
                        <option value="karyawan">Karyawan</option>
                        <option value="manager">Manager</option>
                      </select>

                    </div>
                    <hr>
                    <input type="submit" class="btn btn-secondary btn-user btn-block" name="login" value="Login">
                  </form>
                  <!-- <button class="btn btn-primary align-center" name="daftar" value="Daftar">Daftar Admin</button> -->
                  <br>
                  <center>
                    <p>Dev by <a href='https://github.com/bimaadam/' title='bimaadamrin.my.id' target='_blank'>Bima Adam</a></p>
                  </center>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
</body>

</html>