    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-plus-square"></i> Letakkan Aset Mesin atau Alat Berat
        </div>
        <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h4><i class="far fa-edit"></i> <b >Form Letakkan Aset</b></h4>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>

                <form method="post" action="<?php echo base_url('user/mesin/letakkan_aksi') ?>">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Mesin</label>
                    <div class="col-sm-8">
                      <select name="nama" class="form-control select2" style="width: 100%;" required="required">
                        <option value="">-- Pilih Nama Mesin --</option>
                        <?php foreach($barang as $bg) : ?>
                        <option value="<?php echo $bg->id_barang; ?>"><?php echo $bg->nama_barang; ?> (<?php echo $bg->tahun_perolehan;?>)</option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('nama','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jumlah Mesin</label>
                    <div class="col-sm-8">
                      <input type="number" name="jumlah" placeholder="Masukkan Jumlah Mesin" class="form-control" required>
                      <?php echo form_error('jumlah','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jumlah Baik</label>
                    <div class="col-sm-8">
                      <input type="number" name="baik" placeholder="Masukkan Jumlah Mesin Kondisi Baik" class="form-control" required>
                      <?php echo form_error('baik','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Ruang</label>
                    <div class="col-sm-8">
                      <select name="ruang" class="form-control select2" style="width: 100%;" required="required">
                        <option value="">-- Pilih Ruang --</option>
                        <?php foreach($ruang as $rg) : ?>
                        <option value="<?php echo $rg->id_ruang; ?>"><?php echo $rg->nama_ruang; ?> (Lt <?php echo $rg->lantai; ?>)</option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('ruang','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  
                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                  <button name="button" id="button" value="true" type="reset" class="btn btn-danger">Reset</button>
                </form>
                </div>
              </div>
            </div>
            <div class="col-md-3"></div>

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