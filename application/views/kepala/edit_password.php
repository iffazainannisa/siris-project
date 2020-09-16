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
      <!-- Begin Page Content -->
      <div class="container kecil">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: #fce6e8;">
              <li class="breadcrumb-item"><?php echo anchor('kepala/dashboard','<i class="fas fa-fw fa-tachometer-alt"></i> Dashboard'); ?></li>
              <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-user-edit"></i> Edit Password
              </li>
            </ol>
          </nav>
        <?php echo $this->session->flashdata('message');?>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-3">
              <div class="card mb-4 py-3 border-bottom-danger">
                <div class="card-body">
                  <b>Menu</b>
                  <div class="garis"></div>
                  <div class="menu">
                  <div class="menu-active">
                      <?php echo anchor('kepala/dashboard/edit_profile/'.$user->id_user, '<i class="fas fa-user-edit"></i> &nbsp;Edit Profile'); ?>
                    </div>
                    <div class="menu-active" style="background: #ff968c;">
                      <?php echo anchor('kepala/dashboard/edit_password/'.$user->id_user, '<i class="fas fa-key"></i> &nbsp;Edit Password'); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h4><i class="far fa-edit"></i> <b >Edit Password</b></h4>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>
                </div>

                <form method="post" action="<?php echo base_url('kepala/dashboard/update_password') ?>">
                    <?php echo form_hidden('id_user', $user->id_user); ?>
                  <div class="form-group row">
                    <label for="lama" class="col-sm-3 col-form-label" style="margin-left: 3%;">Password Lama</label>
                    <div class="col-sm-6">
                      <input type="password" class="form-control" name="lama" id="lama" placeholder="Masukkan Password Lama">
                      <?php echo form_error('lama','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="baru" class="col-sm-3 col-form-label" style="margin-left: 3%;">Password Baru</label>
                    <div class="col-sm-6">
                      <input type="password" class="form-control" name="baru" id="baru" placeholder="Masukkan Password Baru">
                      <?php echo form_error('baru','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="ulang" class="col-sm-3 col-form-label" style="margin-left: 3%;">Konfirmasi Password</label>
                    <div class="col-sm-6">
                      <input type="password" class="form-control" name="ulang" id="ulang" placeholder="Konfirmasi Ulang Password">
                      <?php echo form_error('ulang','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <br />
                  <div class="form-group row">
                    <div class="col-sm-6" style="margin-left: 67%;">
                      <button type="submit" name="edit" class="btn btn-success" size="50px">Simpan</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
        </div>

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->
      
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>


    <!-- Modal -->
    <div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
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