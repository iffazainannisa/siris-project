    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
        <i class="fas fa-tachometer-alt"></i> Dashboard
      </div>

      <div class="alert alert-success" role="alert">
        <hr />
        <h4><i class="fas fa-smile-wink"></i> Selamat Datang!</h4>
        <p>Selamat Datang di <b>SISTEM INVENTARIS PMI KOTA SEMARANG</b>, Anda Login Sebagai <strong><?php echo $userku["nama_user"]; ?></strong></p>
        <hr />
      </div>
        <!-- Content Row -->
        <div class="row">

          <!-- Earnings (Monthly) Card Example -->
          <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('admin/bidang');?>" style="text-decoration: none;">
            <div class="card bg-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">Bidang</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totalbidang']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-layer-group fa-4x text-light"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <!-- Earnings (Monthly) Card Example -->
          <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('admin/jenis');?>" style="text-decoration: none;">
            <div class="card bg-pink shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">Jenis Aset</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totaljenisaset']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fab fa-trello fa-4x text-light"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <!-- Earnings (Monthly) Card Example -->
          <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('admin/ruang');?>" style="text-decoration: none;">
            <div class="card bg-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">Ruang</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totalruang']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-door-closed fa-4x text-light"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <!-- Earnings (Monthly) Card Example -->
          <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('admin/status');?>" style="text-decoration: none;">
            <div class="card bg-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">Status Kepemilikan</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totalstatus']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-building fa-4x text-light"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <!-- Pending Requests Card Example -->
          <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('admin/sumber');?>" style="text-decoration: none;">
            <div class="card bg-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">Sumber</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totalsumber']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-wallet fa-4x text-light"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
          
          <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('admin/user');?>" style="text-decoration: none;">
            <div class="card bg-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">User</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totaluser']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user-cog fa-4x text-light"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

<!-- Content Row -->
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; PMI Kota Semarang 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
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