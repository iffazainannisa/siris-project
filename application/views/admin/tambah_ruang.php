    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-plus-square"></i> Tambah Ruang
        </div>
        <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h4><i class="far fa-edit"></i> <b >Form Tambah Ruang</b></h4>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>

                  <!-- U untuk UDD, M untuk Markas, J untuk UPJ -->

                <form method="post" action="<?php echo site_url('admin/ruang/tambah_aksi') ?>">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Ruang</label>
                    <div class="col-sm-8">
                      <input type="text" name="nama_ruang" placeholder="Masukkan Nama Ruang" class="form-control" required>
                      <?php echo form_error('nama_ruang','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Lantai</label>
                    <div class="col-sm-8">
                      <input type="number" name="lantai" placeholder="Masukkan Nomor Lantai" class="form-control" required>
                      <?php echo form_error('lantai','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Bidang</label>
                    <div class="col-sm-8">
                      <select name="nama_bidang" class="form-control select2" style="width: 100%;">
                        <option value="">--Pilih Bidang--</option>
                        <?php foreach($bidang as $bg) : ?>
                        <option value="<?php echo $bg->id_bidang; ?>"><?php echo $bg->nama_bidang; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('nama_bidang','<div class="text-danger small ml-3">','</div>') ?>
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