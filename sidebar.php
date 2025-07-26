<style>
  .sidebar {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(145deg, #263238 0%, #37474f 50%, #455a64 100%);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.05);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
  }

  .sidebar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.02) 0%, transparent 50%);
    pointer-events: none;
  }

  .sidebar-brand {
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding: 1.5rem 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
  }

  .sidebar-brand::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
    transition: left 0.6s;
  }

  .sidebar-brand:hover::before {
    left: 100%;
  }

  .sidebar-brand:hover {
    background: rgba(255, 255, 255, 0.08);
    transform: translateY(-1px);
  }

  .sidebar-brand img {
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
    transition: transform 0.3s ease;
  }

  .sidebar-brand:hover img {
    transform: scale(1.02);
  }

  .sidebar-brand-text {
    background: linear-gradient(135deg, #90caf9 0%, #64b5f6 50%, #42a5f5 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 600;
    font-size: 1.1rem;
    letter-spacing: 0.3px;
  }

  .nav-item {
    margin: 0.3rem 0.8rem;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
  }

  .nav-item .nav-link {
    position: relative;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    color: #eceff1;
    border-radius: 8px;
    margin: 2px 0;
    padding: 0.85rem 1.2rem;
    font-weight: 500;
    font-size: 0.9rem;
    border: 1px solid transparent;
    backdrop-filter: blur(10px);
  }

  .nav-item .nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(144, 202, 249, 0.08), rgba(100, 181, 246, 0.08));
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 8px;
  }

  .nav-item:hover .nav-link::before {
    opacity: 1;
  }

  .nav-item:hover .nav-link {
    background: rgba(255, 255, 255, 0.08);
    transform: translateX(6px);
    color: #90caf9;
    border-color: rgba(144, 202, 249, 0.25);
    box-shadow: 0 3px 12px rgba(144, 202, 249, 0.15);
  }

  .nav-item .nav-link i {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-right: 0.8rem;
    width: 18px;
    text-align: center;
    font-size: 1rem;
  }

  .nav-item:hover .nav-link i {
    transform: scale(1.1);
    color: #90caf9;
  }

  .nav-item.active .nav-link {
    background: linear-gradient(135deg, rgba(144, 202, 249, 0.15), rgba(100, 181, 246, 0.12));
    color: #90caf9;
    border-color: rgba(144, 202, 249, 0.3);
    box-shadow: 0 4px 15px rgba(144, 202, 249, 0.2);
  }

  .nav-item.active .nav-link i {
    color: #90caf9;
  }

  .sidebar-divider {
    border-color: rgba(255, 255, 255, 0.12);
    margin: 1.5rem 1.2rem;
    position: relative;
  }

  .sidebar-divider::after {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(144, 202, 249, 0.5), transparent);
  }

  #sidebarToggle {
    background: linear-gradient(135deg, #90caf9, #64b5f6);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    width: 38px;
    height: 38px;
    box-shadow: 0 3px 12px rgba(144, 202, 249, 0.25);
  }

  #sidebarToggle:hover {
    background: linear-gradient(135deg, #64b5f6, #42a5f5);
    transform: scale(1.05) rotate(90deg);
    box-shadow: 0 4px 15px rgba(144, 202, 249, 0.35);
  }

  /* Professional UMKM Styling */
  .nav-link span {
    font-weight: 500;
    letter-spacing: 0.3px;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .sidebar-brand-text {
      font-size: 1rem;
    }
    
    .nav-item .nav-link {
      padding: 0.7rem 1rem;
      font-size: 0.85rem;
    }
  }

  /* Scrollbar styling */
  .sidebar::-webkit-scrollbar {
    width: 5px;
  }

  .sidebar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
  }

  .sidebar::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #90caf9, #64b5f6);
    border-radius: 3px;
  }

  .sidebar::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #64b5f6, #42a5f5);
  }

  /* Professional hover states */
  .nav-item .nav-link:focus {
    box-shadow: 0 0 0 2px rgba(144, 202, 249, 0.3);
    outline: none;
  }
</style>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <img src="img/logo.png" alt="Logo" style="height: 90px;">
    <div class="sidebar-brand-text mx-3">Zoya Cookies</div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item <?php echo $dsb; ?>">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <li class="nav-item <?php echo $kr; ?>">
    <a class="nav-link" href="karyawan.php">
      <i class="fas fa-fw fa-users"></i>
      <span>Karyawan</span>
    </a>
  </li>

  <li class="nav-item <?php echo $ab; ?>">
    <a class="nav-link" href="absensi.php">
      <i class="fas fa-fw fa-clock"></i>
      <span>Absensi</span>
    </a>
  </li>

  <li class="nav-item <?php echo $ps; ?>">
    <a class="nav-link" href="bagian.php">
      <i class="fas fa-fw fa-building"></i>
      <span>Bagian</span>
    </a>
  </li>

  <li class="nav-item <?php echo $pt; ?>">
    <a class="nav-link" href="potongan.php">
      <i class="fas fa-fw fa-minus-circle"></i>
      <span>Potongan</span>
    </a>
  </li>

  <li class="nav-item <?php echo $gj; ?>">
    <a class="nav-link" href="gaji.php">
      <i class="fas fa-fw fa-wallet"></i>
      <span>Gaji</span>
    </a>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

  <!-- User Profile Section -->
  <li class="nav-item">
    <a class="nav-link" href="profile.php">
      <i class="fas fa-fw fa-user"></i>
      <span>Profil</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="pengaturan.php">
      <i class="fas fa-fw fa-cogs"></i>
      <span>Pengaturan</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->