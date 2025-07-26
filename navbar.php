<!-- Topbar Navbar -->
<span class="mr-2 d-none d-lg-inline text-white">
  <font size="5px"><b>Sistem Penggajian</b></font>
</span>

<ul class="navbar-nav ml-auto">
  <div class="topbar-divider d-none d-sm-block"></div>
  <!-- Nav Item - User Information -->
  <li class="nav-item">
    <div class="nav-link">
      <span class="mr-2 d-none d-lg-inline text-white medium"><b><?php echo $sess_admname; ?></b></span>
      <img class="img-profile rounded-circle" src="img/<?php echo $sess_admfoto; ?>" style="border: 2px solid rgba(144, 202, 249, 0.3);">
    </div>
  </li>
</ul>

<style>
.navbar {
  background: linear-gradient(90deg, #263238 0%, #37474f 50%, #455a64 100%) !important;
}

.navbar .text-white {
  color: #eceff1 !important;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  font-weight: 600;
}

.navbar .text-white b {
  background: linear-gradient(135deg, #90caf9 0%, #64b5f6 50%, #42a5f5 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.topbar-divider {
  width: 0;
  height: 2rem;
  border-right: 1px solid rgba(255, 255, 255, 0.15);
  margin: auto 1rem;
}

.img-profile {
  transform: scale(1.0);
  transition: transform 0.3s ease;
}

.img-profile:hover {
  transform: scale(1.05);
  border-color: rgba(144, 202, 249, 0.6) !important;
}
</style>

