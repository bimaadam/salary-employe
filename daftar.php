<?php $pagedesc = "Daftar"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistem Penggajian - <?php echo $pagedesc; ?></title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <h2 class="text-center">Daftar Akun Baru</h2>
                  <br />
                  <form class="user" action="register_process.php" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="karyawan_id" placeholder="ID Karyawan" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <select name="akses" class="form-control" required>
                        <option value="">* Daftar Sebagai *</option>
                        <option value="admin">Admin HRD</option>
                        <option value="direktur">Direktur</option>
                        <option value="karyawan">Karyawan</option>
                        <option value="manager">Manager</option>
                      </select>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success btn-user btn-block">Daftar</button>
                  </form>
                  <br>
                  <center>
                    <p>Udah punya akun? <a href="login.php">Login di sini</a></p>
                  </center>
                  <center>
                    <p>Dev by <a href='https://github.com/bimaadam/' target='_blank'>Bima Adam</a></p>
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
</body>

</html>