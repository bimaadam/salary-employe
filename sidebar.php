<style>
  .sidebar {
    transition: all 0.4s ease-in-out;
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    box-shadow: 4px 0 15px rgba(0, 0, 0, 0.3);
  }

  .nav-item .nav-link {
    position: relative;
    transition: all 0.3s ease-in-out;
    color: #ecf0f1;
  }

  .nav-item:hover .nav-link {
    background-color: rgba(255, 255, 255, 0.1);
    padding-left: 1.5rem;
    color: #1abc9c;
  }

  .nav-item .nav-link i {
    transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
  }

  .nav-item:hover .nav-link i {
    transform: rotate(-5deg) scale(1.1);
    color: #1abc9c;
  }

  .sidebar-brand {
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding: 1rem 0;
    transition: all 0.3s ease;
  }

  .sidebar-brand:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #1abc9c;
  }

  .collapse-inner a {
    transition: all 0.2s ease-in-out;
  }

  .collapse-inner a:hover {
    color: #16a085;
    padding-left: 8px;
    font-weight: 500;
  }

  .collapse.show {
    animation: fadeInDown 0.3s ease-in-out;
  }

  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  #sidebarToggle {
    background-color: #1abc9c;
    transition: background-color 0.3s;
  }

  #sidebarToggle:hover {
    background-color: #16a085;
  }
</style>
<!-- badgePro -->
<style>
  .badge-basic {
    background-color: #3498db;
    color: white;
    font-size: 0.6rem;
    margin-left: 6px;
    padding: 2px 5px;
    border-radius: 5px;
  }

  .badge-pro {
    background-color: #e67e22;
    color: white;
    font-size: 0.6rem;
    margin-left: 6px;
    padding: 2px 5px;
    border-radius: 5px;
  }
</style>


<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-text mx-3">Admin Dashboard</div>
  </a>
  <hr class="sidebar-divider my-0">

  <?php
  function badge($type)
  {
    if ($type == 'basic') return '<span class="badge-basic">Basic</span>';
    else return '<span class="badge-pro">PRO</span>';
  }
  ?>

  <li class="nav-item <?php echo $dsb; ?>">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard <?= badge('basic') ?></span>
    </a>
  </li>

  <li class="nav-item <?php echo $kr; ?>">
    <a class="nav-link <?php echo $cl; ?>" href="#" data-toggle="collapse" data-target="#collapseTwo">
      <i class="fas fa-fw fa-user"></i>
      <span>Karyawan <?= badge('basic') ?></span>
    </a>
    <div id="collapseTwo" class="collapse <?php echo $sh; ?>">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?php echo $kr; ?>" href="karyawan.php">Data Karyawan</a>
      </div>
    </div>
  </li>

  <li class="nav-item <?php echo $ab; ?>">
    <a class="nav-link <?php echo $clab; ?>" href="#" data-toggle="collapse" data-target="#collapseThree">
      <i class="fas fa-fw fa-book"></i>
      <span>Absensi <?= badge('basic') ?></span>
    </a>
    <div id="collapseThree" class="collapse <?php echo $shab; ?>">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?php echo $ab; ?>" href="absensi.php">Data Absensi</a>
      </div>
    </div>
  </li>

  <li class="nav-item <?php echo $ps; ?>">
    <a class="nav-link <?php echo $clps; ?>" href="#" data-toggle="collapse" data-target="#collapseFour">
      <i class="fas fa-fw fa-signal"></i>
      <span>Bagian <?= badge('basic') ?></span>
    </a>
    <div id="collapseFour" class="collapse <?php echo $shps; ?>">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?php echo $ps; ?>" href="bagian.php">Data Bagian</a>
      </div>
    </div>
  </li>

  <li class="nav-item <?php echo $pt; ?>">
    <a class="nav-link <?php echo $clpt; ?>" href="#" data-toggle="collapse" data-target="#collapseNine">
      <i class="fas fa-fw fa-cut"></i>
      <span>Potongan <?= badge('basic') ?></span>
    </a>
    <div id="collapseNine" class="collapse <?php echo $shpt; ?>">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?php echo $pt; ?>" href="potongan.php">Data Potongan</a>
      </div>
    </div>
  </li>

  <li class="nav-item <?php echo $gj; ?>">
    <a class="nav-link <?php echo $clgj; ?>" href="#" data-toggle="collapse" data-target="#collapseTen">
      <i class="fas fa-fw fa-money-bill-alt"></i>
      <span>Gaji <?= badge('basic') ?></span>
    </a>
    <div id="collapseTen" class="collapse <?php echo $shgj; ?>">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?php echo $gj; ?>" href="gaji.php">Data Gaji</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->