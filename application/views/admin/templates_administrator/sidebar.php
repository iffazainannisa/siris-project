<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
   <ul class="navbar-nav sidebar sidebar-dark accordion bg-pink" id="accordionSidebar" \>

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin/dashboard') ?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-notes-medical"></i>
        </div>
        <div class="sidebar-brand-text mx-1">SISTEM INVENTARIS</div>
      </a>
      <hr class="sidebar-divider my-0">
      <br />
      <!-- Divider -->
      <div class="bg-head">
          <h6 style="padding-top: 2%; margin-left: 9%;font-size: 10pt;">Home Admin</h6>
      </div>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url('admin/dashboard') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      

      <div class="bg-head">
          <h6 style="padding-top: 2%; margin-left: 9%; font-size: 10pt;">Kelola Aset</h6>
      </div>


      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-layer-group"></i>
          <span>Bidang</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sub-Menu :</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/bidang') ?>">Kelola Bidang</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages6" aria-expanded="true" aria-controls="collapsePages">
          <i class="fab fa-trello"></i>
          <span>Jenis Aset</span>
        </a>
        <div id="collapsePages6" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sub-Menu :</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/jenis/tambah') ?>">Tambah Jenis Aset</a>
            <a class="collapse-item" href="<?php echo base_url('admin/jenis') ?>">Kelola Jenis Aset</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-door-closed"></i>
          <span>Ruang</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sub-Menu :</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/ruang/tambah') ?>">Tambahkan Ruang</a>
            <a class="collapse-item" href="<?php echo base_url('admin/ruang') ?>">Kelola Ruang</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-building"></i>
          <span>Status Kepemilikan</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sub-Menu :</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/status/tambah') ?>">Tambah Status</a>
            <a class="collapse-item" href="<?php echo base_url('admin/status') ?>">Kelola Status</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-wallet"></i>
          <span>Sumber</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sub-Menu :</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/sumber/tambah') ?>">Tambah Sumber</a>
            <a class="collapse-item" href="<?php echo base_url('admin/sumber') ?>">Kelola Sumber</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-user-cog"></i>
          <span>User</span>
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sub-Menu :</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/user/tambah') ?>">Tambah User</a>
            <a class="collapse-item" href="<?php echo base_url('admin/user') ?>">Kelola User</a>
          </div>
        </div>
      </li>


           <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-archive"></i>
          <span>Inventaris</span>
        </a>
        <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sub-Menu :</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/barang') ?>">Kelola Barang Kantor</a>
            <a class="collapse-item" href="<?php echo base_url('admin/mesin') ?>">Kelola Mesin</a>
            <a class="collapse-item" href="<?php echo base_url('admin/kendaraan') ?>">Kelola Kendaraan</a>
            <a class="collapse-item" href="<?php echo base_url('admin/tanah') ?>">Kelola Tanah</a>
            <a class="collapse-item" href="<?php echo base_url('admin/bangunan') ?>">Kelola Bangunan</a>  
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
                <?php echo anchor('admin/dashboard/edit_profile/'.$userku['id_user'], '<div class="dropdown-item"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Edit Profile</div>'); ?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->