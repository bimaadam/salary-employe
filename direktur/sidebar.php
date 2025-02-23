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

		if($pagedesc == "Data User") {
			$us = "active";
			$clus = "";
			$shus = "show";
		}else {
			$us = "";
			$clus = "collapsed";
			$shus = "";
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

		if($pagedesc == "Data Akun") {
			$ak = "active";
			$clak = "";
			$shak = "show";
		}else {
			$ak = "";
			$clak = "collapsed";
			$shak = "";
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

		if($pagedesc == "Data Bagian") {
			$bg = "active";
			$clbg = "";
			$shbg = "show";
		}else {
			$bg = "";
			$clbg = "collapsed";
			$shbg = "";
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
		
		if($pagedesc == "Data Akun") {
			$ak = "active";
			$clak = "";
			$shak = "show";
		}else {
			$ak = "";
			$clak = "collapsed";
			$shak = "";
		}
		
		if($pagedesc == "Data Jurnal") {
			$jr = "active";
			$cljr = "";
			$shjr = "show";
		}else {
			$jr = "";
			$cljr = "collapsed";
			$shjr = "";
		}

		if($pagedesc == "Jurnal Gaji") {
			$jg = "active";
			$cljg = "";
			$shjg = "show";
		}else {
			$jg = "";
			$cljg = "collapsed";
			$shjg = "";
		}
		?>
      <li class="nav-item <?php echo $dsb;?>">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $kr;?>">
        <a class="nav-link <?php echo $cl;?>" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-user"></i>
          <span>Karyawan</span>
        </a>
        <div id="collapseTwo" class="collapse <?php echo $sh;?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $kr;?>" href="karyawan.php">Data Karyawan</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $bg;?>">
        <a class="nav-link <?php echo $clbg;?>" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
          <i class="fas fa-fw fa-signal"></i>
          <span>Bagian</span>
        </a>
        <div id="collapse4" class="collapse <?php echo $shbg;?>" aria-labelledby="heading4" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $bg;?>" href="bagian.php">Data Bagian</a>
          </div>
        </div>
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

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $ak;?>">
        <a class="nav-link <?php echo $clak;?>" href="#" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
          <i class="fas fa-fw fa-folder"></i>
          <span>Akun</span>
        </a>
        <div id="collapse11" class="collapse <?php echo $shak;?>" aria-labelledby="heading11" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $ak;?>" href="akun.php">Data Akun</a>
          </div>
        </div>
      </li>
	  
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $jr;?>">
        <a class="nav-link <?php echo $cljr;?>" href="#" data-toggle="collapse" data-target="#collapse12" aria-expanded="true" aria-controls="collapse12">
          <i class="fas fa-fw fa-file"></i>
          <span>Jurnal</span>
        </a>
        <div id="collapse12" class="collapse <?php echo $shjr;?>" aria-labelledby="heading12" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $jr;?>" href="jurnal.php">Data Jurnal</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $jg;?>">
        <a class="nav-link <?php echo $cljg;?>" href="#" data-toggle="collapse" data-target="#collapse13" aria-expanded="true" aria-controls="collapse13">
          <i class="fas fa-fw fa-archive"></i>
          <span>Jurnal Gaji</span>
        </a>
        <div id="collapse13" class="collapse <?php echo $shjg;?>" aria-labelledby="heading13" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $jg;?>" href="jurnalgaji.php">Jurnal Gaji</a>
          </div>
        </div>
      </li>
	  
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $us;?>">
        <a class="nav-link <?php echo $clus;?>" href="#" data-toggle="collapse" data-target="#collapse13" aria-expanded="true" aria-controls="collapse13">
          <i class="fas fa-fw fa-users"></i>
          <span>User</span>
        </a>
        <div id="collapse13" class="collapse <?php echo $shus;?>" aria-labelledby="heading13" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?php echo $us;?>" href="user.php">Data User</a>
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
