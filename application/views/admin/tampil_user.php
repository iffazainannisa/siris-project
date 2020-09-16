       <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-cogs"></i> Kelola User Sistem Inventaris
        </div>
        <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
            
            <div class="col-md-12">
              <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h4><i class="far fa-edit"></i> <b >Kelola User</b></h4>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>
                </div>
                <div class="row">
                  <!-- Begin Page Content -->
                  <div class="container-fluid">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary"></h4>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0.5">
                            <thead>
                               <tr style="font-size: 12px; text-align: center;">
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Nama Bidang</th>
                                <!-- <th>Gambar</th> -->
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $no=1;
                                foreach ($user as $us) :
                              ?> 
                              <tr style="font-size: 12px; text-align:center;">
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $us->nama_user; ?></td>
                                <td><?php echo $us->username; ?></td>
                                <td><?php echo $us->level; ?></td>
                                <td><?php echo $us->nama_bidang; ?></td>
                                <!-- <td><?php echo $us->gambar; ?></td> -->
                                <td class="center">
                                   <?php echo anchor('admin/user/edit/'.$us->id_user, '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div>'); ?>
                                   <?php $onclick = array('onclick'=>"return confirm('Anda yakin untuk menghapus data?')");?>
                                  <?php echo anchor('admin/user/user_hapus/'.$us->id_user, '<div class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></div>',$onclick); ?>
                                </td>
                              
                              
                            <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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

<!-- END -->
  