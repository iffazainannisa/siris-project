    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column kecil">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
        <i class="fas fa-home"></i> Home
      </div>

      <div class="alert alert-success" role="alert">
        <hr />
        <h4><i class="fas fa-smile-wink"></i> Selamat Datang!</h4>
        <p>Selamat Datang di <b>SISTEM INVENTARIS PMI KOTA SEMARANG</b> Bidang <strong style="text-transform: uppercase;"><?php echo $bidang; ?></strong>
        <hr />
      </div>

        <!-- Content Row -->
        <div class="row">
          <!-- Earnings (Monthly) Card Example -->
          <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('kepala/dashboard/laporan_kantor/'.$id_bidang) ?>" style="text-decoration: none;">
            <div class="card bg-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">Peralatan Kantor</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totalkantor']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-business-time fa-4x text-light"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <!-- Earnings (Monthly) Card Example -->
          <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('kepala/dashboard/laporan_mesin/'.$id_bidang) ?>" style="text-decoration: none;">
            <div class="card bg-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">Mesin atau Alat Berat</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totalmesin']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-tools fa-4x text-light"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <!-- Earnings (Monthly) Card Example -->
          <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('kepala/dashboard/laporan_kendaraan/'.$id_bidang) ?>" style="text-decoration: none;">
            <div class="card bg-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">Kendaraan</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totalkendaraan']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-shuttle-van fa-4x text-light"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <!-- Pending Requests Card Example -->
          <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('kepala/dashboard/laporan_tanah/'.$id_bidang) ?>" style="text-decoration: none;">
            <div class="card bg-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">Tanah</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totaltanah']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-layer-group fa-4x text-light"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
             <a class="col-md-3 col-sm-8 mb-4 btn-zoom" href="<?php echo base_url('kepala/dashboard/laporan_bangunan/'.$id_bidang) ?>" style="text-decoration: none;">
            <div class="card bg-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 font-weight-bold text-light text-uppercase mb-1">Bangunan</div>
                    <div class="h3 mb-0 font-weight-bold text-light"><?php echo $count_data['totalbangunan']; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="far fa-building fa-4x text-light"></i>
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
      <footer class="sticky-footer bg-white" style="bottom: 0;">
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