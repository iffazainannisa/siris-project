
    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-plus-square"></i> Detail Inventaris Kendaraan 
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
                          <li class="breadcrumb-item"><?php echo anchor('admin/kendaraan','<i class="fas fa-search"></i> Kelola Inventaris Kendaraan'); ?></li>
                          <li class="breadcrumb-item active" aria-current="page">Detail Kendaraan</li>
                        </ol>
                      </nav>
                  </b></h6>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>
                <?php foreach ($inventaris_kendaraan as $bgn ) : ?>
              

                <form>
                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nomor Inventaris</label>
                    <div class="col-sm-8">
                      <input required="required" type="text" name="no_inventaris" class="form-control" value="<?php echo  $bgn->no_inventaris?>" readonly >
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nomor Plat</label>
                    <div class="col-sm-8">
                       <?php echo form_hidden('id_kendaraan', $bgn->id_kendaraan); ?>
                      <input required="required" type="text" name="no_plat"  class="form-control" value="<?php echo  $bgn->no_plat?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Lokasi</label>
                    <div class="col-sm-8">
                      <input required="required" type="text" name="lokasi" class="form-control" value="<?php echo  $bgn->lokasi?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Merek</label>
                    <div class="col-sm-8">
                      <input required="required" type="text" name="merk" class="form-control" value="<?php echo  $bgn->merk?>"readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tipe</label>
                    <div class="col-sm-8">
                      <input required="required" type="text" name="type" class="form-control" value="<?php echo  $bgn->type?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nomor Rangka</label>
                    <div class="col-sm-8">
                      <input required="required" type="text" name="no_rangka" class="form-control" value="<?php echo  $bgn->no_rangka?>" readonly>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nomor Mesin</label>
                    <div class="col-sm-8">
                      <input required="required" type="text" name="no_mesin" class="form-control" value="<?php echo  $bgn->no_mesin?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tahun Produksi</label>
                    <div class="col-sm-8">
                      <input type="number" name="tahun_produksi" class="form-control" value="<?php echo $bgn->tahun_produksi?>" readonly>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tahun Perolehan</label>
                    <div class="col-sm-8">
                      <input type="number" name="thn_perolehan" class="form-control" value="<?php echo $bgn->tahun_perolehan?>"readonly>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nilai Perolehan</label>
                    <div class="col-sm-8">
                      <input type="number" name="nilai_perolehan" class="form-control" value="<?php echo $bgn->nilai_perolehan?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jenis BBM</label>
                    <div class="col-sm-8">
                      <input type="text" name="jenis_bbm" class="form-control" value="<?php echo $bgn->jenis_bbm?>" readonly>
                    </div>
                  </div>


                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">BPKB</label>
                    <div class="col-sm-8">
                      <input type="text" name="bpkb" class="form-control" value="<?php echo $bgn->bpkb?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Kondisi</label>
                    <div class="col-sm-8">
                      <input type="text" name="kondisi" class="form-control" value="<?php echo $bgn->kondisi?>" readonly>
                    </div>
                  </div>




                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Bidang</label>
                    <div class="col-sm-8">
                      <input type="text" name="kondisi" class="form-control" value="<?php echo $bgn->nama_bidang?>" readonly>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Aset</label>
                    <div class="col-sm-8">
                      <input type="text" name="kondisi" class="form-control" value="<?php echo $bgn->nama_jenis?>" readonly>
                    </div>
                  </div>

                

                


                  <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                      <input type="text" name="keterangan" class="form-control" value="<?php echo $bgn->keterangan?>"readonly>
                    </div>
                    
                  </div>     

                  
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