
    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-plus-square"></i> Detail Inventaris Tanah
        </div>
       
      <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h6> 
                  <b> <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: #fce6e8;">
                          <li class="breadcrumb-item"><?php echo anchor('admin/tanah','<i class="fas fa-search"></i> Kelola Inventaris Tanah'); ?></li>
                          <li class="breadcrumb-item active" aria-current="page">Detail Tanah</li>
                        </ol>
                      </nav>
                  </b></h6>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>
                <?php foreach ($inventaris_tanah as $bgn ) : ?>

                <form>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">No Inventaris</label>
                    <div class="col-sm-8">
                       <?php echo form_hidden('id_tanah', $bgn->id_tanah); ?>
                      <input required="required" type="text" name="no_inventaris"  class="form-control" value="<?php echo  $bgn->no_inventaris?>" readonly>
                    </div>
                  </div>
                 
                

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                      <input required="required" type="text" name="alamat" class="form-control" value="<?php echo  $bgn->alamat?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Luas Tanah</label>
                    <div class="col-sm-8">
                      <input required="required" type="number" name="luas_tanah" class="form-control" value="<?php echo  $bgn->luas_tanah?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tahun Perolehan</label>
                    <div class="col-sm-8">
                      <input required="required" type="text" name="thn_perolehan" class="form-control" value="<?php echo  $bgn->tahun_perolehan?>" readonly>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nilai Perolehan</label>
                    <div class="col-sm-8">
                      <input required="required" type="number" name="nilai_perolehan" class="form-control" value="<?php echo  $bgn->nilai_perolehan?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">NJOP</label>
                    <div class="col-sm-8">
                      <input type="text" name="njop" class="form-control" value="<?php echo $bgn->njop?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Sumber</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="<?php echo $bgn->nama_sumber?>" readonly>
                    </div>
                  </div>

                  

                 <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="<?php echo $bgn->nama_status?>" readonly>
                    </div>
                  </div>

                 <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Kategori Aset</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="<?php echo $bgn->nama_aset?>" readonly>
                    </div>
                  </div>

  

                  <div class="form-group row">
                  
                      <label class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                      <input type="text" name="keterangan" class="form-control" value="<?php echo $bgn->keterangan?>" readonly>
                    </div>
                    
                  </div>




                 

                  <!-- <button type="submit" name="submit" class="btn btn-primary">Simpan</button> -->
                </form>

              <?php endforeach;?>
                
              
                </div>
              </div>
            </div>

            <!-- <div class="col-md-3"></div> -->
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