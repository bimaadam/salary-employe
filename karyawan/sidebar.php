    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
			<img src="../img/honda.jpg" alt="brand" width="90" class="float-left image-brand">
        </div>
<!--        <div class="sidebar-brand-text mx-3">PT. Triwarga Dian Sakti</div>-->
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
	  <?php
		if($pagedesc == "Dashboard") {
			$dsb = "active";
		}else {
			$dsb = "";
		}

		if($pagedesc == "Data Karyawan") {
			$kr = "active";
			$cl = "";
			$sh = "show";
		}else {
			$kr = "";
			$cl = "collapsed";
			$sh = "";
		}

		if($pagedesc == "Data Absensi") {
			$ab = "active";
			$clab = "";
			$shab = "show";
		}else {
			$ab = "";
			$clab = "collapsed";
			$shab = "";
		}

		if($pagedesc == "Data Bagian") {
			$ps = "active";
			$clps = "";
			$shps = "show";
		}else {
			$ps = "";
			$clps = "collapsed";
			$shps = "";
		}

		if($pagedesc == "Data Tunjangan") {
			$jd = "active";
			$cljd = "";
			$shjd = "show";
		}else {
			$jd = "";
			$cljd = "collapsed";
			$shjd = "";
		}

		if($pagedesc == "Data Bonus") {
			$bn = "active";
			$clbn = "";
			$shbn = "show";
		}else {
			$bn = "";
			$clbn = "collapsed";
			$shbn = "";
		}

		if($pagedesc == "Data Lembur") {
			$lm = "active";
			$cllm = "";
			$shlm = "show";
		}else {
			$lm = "";
			$cllm = "collapsed";
			$shlm = "";
		}

		if($pagedesc == "Data Kasbon") {
			$ks = "active";
			$clks = "";
			$shks = "show";
		}else {
			$ks = "";
			$clks = "collapsed";
			$shks = "";
		}

		if($pagedesc == "Data Potongan") {
			$pt = "active";
			$clpt = "";
			$shpt = "show";
		}else {
			$pt = "";
			$clpt = "collapsed";
			$shpt = "";
		}

		if($pagedesc == "Data Gaji") {
			$gj = "active";
			$clgj = "";
			$shgj = "show";
		}else {
			$gj = "";
			$clgj = "collapsed";
			$shgj = "";
		}
		?>
      <li class="nav-item <?php echo $dsb;?>">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $ab;?>">
        <a class="nav-link <?php echo $clab;?>" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-book"></i>
          <span>Absensi</span>
        </a>
        <div id="collapseThree" class="collapse <?php echo $shab;?>" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $ab;?>" href="absensi.php">Data Absensi</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $jd;?>">
        <a class="nav-link <?php echo $cljd;?>" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Tunjangan</span>
        </a>
        <div id="collapseFive" class="collapse <?php echo $shjd;?>" aria-labelledby="headingFive" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $jd;?>" href="tunjangan.php">Data Tunjangan</a>
          </div>
        </div>
      </li>
      
	  <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $lm;?>">
        <a class="nav-link <?php echo $cllm;?>" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
          <i class="fas fa-fw fa-clock"></i>
          <span>Lembur</span>
        </a>
        <div id="collapseSeven" class="collapse <?php echo $shlm;?>" aria-labelledby="headingSeven" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $lm;?>" href="lembur.php">Data Lembur</a>
          </div>
        </div>
      </li>
	  	  
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $pt;?>">
        <a class="nav-link <?php echo $clpt;?>" href="#" data-toggle="collapse" data-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
          <i class="fas fa-fw fa-cut"></i>
          <span>Potongan</span>
        </a>
        <div id="collapseNine" class="collapse <?php echo $shpt;?>" aria-labelledby="headingNine" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $pt;?>" href="potongan.php">Data Potongan</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $gj;?>">
        <a class="nav-link <?php echo $clgj;?>" href="#" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
          <i class="fas fa-fw fa-money-bill-alt"></i>
          <span>Gaji</span>
        </a>
        <div id="collapseTen" class="collapse <?php echo $shgj;?>" aria-labelledby="headingTen" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $gj;?>" href="gaji.php">Data Gaji</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
