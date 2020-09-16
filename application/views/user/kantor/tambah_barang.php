    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column bg-picture">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-plus-square"></i> Tambah Aset Peralatan dan Perlengkapan Kantor
        </div>
        <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h4><i class="far fa-edit"></i> <b >Form Tambah Aset</b></h4>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>

                <form method="post" action="<?php echo base_url('user/kantor/tambah_aksi') ?>">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Aset</label>
                    <div class="col-sm-8">
                      <input type="text" name="nama_aset" placeholder="Masukkan Nama Aset" class="form-control" required>
                      <?php echo form_error('nama_aset','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Merk</label>
                    <div class="col-sm-8">
                      <input type="text" name="merk" placeholder="Masukkan Merk" class="form-control">
                      <?php echo form_error('merk','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Type</label>
                    <div class="col-sm-8">
                      <input type="text" name="type" placeholder="Masukkan Type" class="form-control">
                      <?php echo form_error('type','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Sumber</label>
                    <div class="col-sm-8">
                      <select name="sumber" class="form-control select2" style="width: 100%;" required="required">
                        <option value="">--Pilih Sumber--</option>
                        <?php foreach($sumber as $smbr) : ?>
                        <option value="<?php echo $smbr->id_sumber; ?>"><?php echo $smbr->nama_sumber; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('sumber','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-8">
                      <select name="status" class="form-control select2" style="width: 100%;" required="required">
                        <option value="">--Pilih Status--</option>
                        <?php foreach($status as $smbr) : ?>
                        <option value="<?php echo $smbr->id_status; ?>"><?php echo $smbr->nama_status; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('status','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jenis Aset</label>
                    <div class="col-sm-8">
                      <select name="jenis" class="form-control select2" style="width: 100%;" required="required">
                        <option value="">--Pilih Jenis Aset--</option>
                        <?php foreach($jenis as $smbr) : ?>
                        <option value="<?php echo $smbr->id_jenisaset; ?>"><?php echo $smbr->nama_jenis; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('jenis','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tahun Perolehan</label>
                    <div class="col-sm-8">
                      <input type="number" name="tahun" placeholder="Masukkan Tahun Perolehan" class="form-control" required>
                      <?php echo form_error('tahun','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jumlah Barang</label>
                    <div class="col-sm-8">
                      <input type="number" name="jumlah" placeholder="Masukkan Jumlah Barang" class="form-control" required>
                      <?php echo form_error('jumlah','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Harga Satuan</label>
                    <div class="col-sm-8">
                      <input type="number" name="harga" placeholder="Masukkan Harga Satuan" class="form-control" required>
                      <?php echo form_error('harga','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  
                  <?php echo form_hidden('id_bidang', $userku['id_bidang']); ?>
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