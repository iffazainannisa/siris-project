<body class="bg-pictur">
	<div class="container">
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
                <?php echo anchor('kepala/dashboard/edit_profile/'.$userku['id_user'], '<div class="dropdown-item"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Edit Profile</div>'); ?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>

        </nav>
        <!-- End of Topbar -->
	</div>
	<div class="container about text-center">
		<h3 style="font-size: 42pt; font-weight: bold; color: black;">SISTEM <span> INVENTARIS</span></h3>
		<p style="font-size: 28pt;color: black;"><b>PMI Kota Semarang</b></p>
		<center><div class="garis" style="width: 150px; margin-top: 0.5%;"></div></center>
		<div class="row">
			<div class="col-md-4">
				<?php echo anchor('kepala/dashboard/bidang/1', img(array('src' => base_url('assets/img/udd.png'), 'width'=>'60%', 'class'=>'border border-danger btn-zoom'))); ?>
			</div>
			<div class="col-md-4">
				<?php echo anchor('kepala/dashboard/bidang/2', img(array('src' => base_url('assets/img/markas.png'), 'width'=>'60%', 'class'=>'border border-danger btn-zoom'))); ?>
			</div>
			<div class="col-md-4">
				<?php echo anchor('kepala/dashboard/bidang/3', img(array('src' => base_url('assets/img/upj.png'), 'width'=>'60%', 'class'=>'border border-danger btn-zoom'))); ?>
				
			</div>
		</div>
	</div>

	<!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <img src="<?php echo base_url('assets/img/out.png')?>" width="40%">
            <h3 class="modal-title" id="exampleModalLabel">Anda yakin ingin keluar?</h3>

            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <a class="btn btn-primary" href="<?php echo base_url('auth/logout') ?>">Keluar</a>
          </div>
        </div>
      </div>
    </div>