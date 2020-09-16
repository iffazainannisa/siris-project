<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
   <ul class="navbar-nav sidebar sidebar-dark accordion bg-pink" id="accordionSidebar" \>

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('kepala/dashboard/bidang/'.$id_bidang) ?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-notes-medical"></i>
        </div>
        <div class="sidebar-brand-text mx-1">SISTEM INVENTARIS</div>
      </a>
      <hr class="sidebar-divider my-0">
      <br />
      <!-- Divider -->
      <div class="bg-head">
          <h6 style="padding-top: 2%; margin-left: 9%;font-size: 10pt;">Menu</h6>
      </div>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url('kepala/dashboard') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url('kepala/dashboard/bidang/'.$id_bidang) ?>">
          <i class="fas fa-home"></i>
          <span>Home</span></a>
      </li>
      

      <div class="bg-head">
          <h6 style="padding-top: 2%; margin-left: 9%; font-size: 10pt;">Daftar Aset</h6>
      </div>


      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('kepala/dashboard/laporan_kantor/'.$id_bidang) ?>">
            <i class="fas fa-business-time"></i>
            <span>Peralatan Kantor</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('kepala/dashboard/laporan_mesin/'.$id_bidang) ?>">
            <i class="fas fa-tools"></i>
            <span>Mesin/Alat Berat</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('kepala/dashboard/laporan_kendaraan/'.$id_bidang) ?>">
            <i class="fas fa-shuttle-van"></i>
            <span>Kendaraan</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('kepala/dashboard/laporan_tanah/'.$id_bidang) ?>">
            <i class="fas fa-layer-group"></i>
            <span>Tanah</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('kepala/dashboard/laporan_bangunan/'.$id_bidang) ?>">
            <i class="fas fa-building"></i>
            <span>Bangunan</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $userku["nama_user"]; ?></span>
                <img class="img-profile rounded-circle" src="<?php echo base_url('assets/img/shortcut.png')?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->