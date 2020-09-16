
    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-plus-square"></i> Edit Inventaris Bangunan
        </div>
       
      <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h4><i class="far fa-edit"></i> <b >Form Edit Inventaris Bangunan History</b></h4>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>
                 <?php foreach ($inventaris_bangunan_history as $ibh ) : ?>
              

                <form method="post" action="<?php echo base_url().'admin/history/update_bangunan_his'; ?>">
                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nomor Inventaris</label>
                    <div class="col-sm-8">
                       <?php echo form_hidden('id_track', $ibh->id_track); ?>
                      <input required="required" type="text" name="no_inventaris"  class="form-control" value="<?php echo  $ibh->no_inventaris?>">
                    </div>
                  </div>

                 <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Bangunan</label>
                    <div class="col-sm-8">
                      <select name="bangunan" class="form-control select2" style="width: 100%;">
                        <option value="<?php echo $ibh->id_bangunan;?>"><?php echo $ibh->nama_bangunan;?></option>
                        <?php foreach($inventaris_bangunan as $ib) : ?>
                        <option value="<?php echo $ib->id_bangunan; ?>"><?php echo $ib->nama_bangunan; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('bangunan','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div> 

                 <!--  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Bangunan</label>
                    <div class="col-sm-8">
                      <?php foreach($inventaris_bangunan as $ib) : ?>
                      <input required="required" type="number" name="bangunan" class="form-control" value="<?php echo  $ib->nama_bangunan?>" <?php echo $ibh->nama_bangunan;?> readonly>
                       <?php endforeach; ?>
                    </div>
                  </div> -->
                 
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Luas Bangunan</label>
                    <div class="col-sm-8">
                      <input required="required" type="number" name="luas_bangunan" class="form-control" value="<?php echo  $ibh->luas_bangunan?>">
                    </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jumlah Lantai</label>
                    <div class="col-sm-8">
                      <input required="required" type="number" name="jml_lantai" class="form-control" value="<?php echo  $ibh->jumlah_lantai?>">
                    </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tanggal Update Terakahir</label>
                    <div class="col-sm-8">
                      <input required="required" type="date" name="update_time" class="form-control" value="<?php echo  $ibh->update_time?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                      <input  type="text" name="keterangan" class="form-control" value="<?php echo  $ibh->keterangan?>">
                    </div>
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
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