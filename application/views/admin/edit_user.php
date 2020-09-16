
    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-plus-square"></i> Edit User
        </div>
       
      <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
          <div class="col-md-1"></div>
            <div class="col-md-6">
              <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h6><i class="far fa-edit"></i> <b >Form Edit User</b></h6>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>

                  <?php foreach ($user as $usr ) : ?>
                <form method="post" action="<?php echo base_url().'admin/user/update'; ?>">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama User</label>
                    <div class="col-sm-6">
                       <?php echo form_hidden('id_user', $usr->id_user); ?>
                       <?php echo form_hidden('before', $usr->username); ?>
                      <input required="required" type="text" name="nama_user"  class="form-control" value="<?php echo  $usr->nama_user?>">
                    </div>
                  </div>
                 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-6">
                      <input required="required" type="text" name="username" class="form-control" value="<?php echo  $usr->username?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Level</label>
                    <div class="col-sm-6">
                     <select name="level" class="form-control select2" style="width: 100%;">
                          <option value="<?php echo  $usr->level?>"><?php echo  $usr->level?></option>
                          <option value="admin">admin</option>
                          <option value="kepala">kepala</option>
                          <option value="user">user</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Bidang</label>
                    <div class="col-sm-6">
                      <select name="bidang" class="form-control select2" style="width: 100%;">
                        <option value="<?php echo $usr->id_bidang;?>"><?php echo $usr->nama_bidang;?></option>
                        <?php foreach($bidang as $bg) : ?>
                        <option value="<?php echo $bg->id_bidang; ?>"><?php echo $bg->nama_bidang; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('bidang','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </form>

              <?php endforeach;?>
                
              
                </div>
              </div>
            </div>

            <!-- <div class="col-md-3"></div> -->
            <div class="row">
              <div class="container-fluid">
              
            <div class="col-md-0"></div>
               <div class="col-md-12">
              <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h6><i class="far fa-edit"></i> <b >Form Edit Password User</b></h6>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>
                <?php foreach ($user as $usr ) : ?>
              

                <form method="post" action="<?php echo base_url().'admin/user/update1'; ?>">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Username</label>
                    <div class="col-sm-8">
                       <?php echo form_hidden('id_user', $usr->id_user); ?>
                      <input required="required" type="text" name="username"  class="form-control" value="<?php echo  $usr->username?>"readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                      <input required="required" type="password" name="password"  class="form-control">
                    </div>
                  </div>
                   
                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </form>

              <?php endforeach;?>
                </div>
              </div>
            </div> 
              </div>
            </div>


        


           

            

          <!-- End Content Row -->
        </div>

        
        
          
         <!-- End of Main Content -->
      </div>
     
         
      
        

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