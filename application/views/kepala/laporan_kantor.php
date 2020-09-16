    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-newspaper"></i> Laporan Aset Peralatan dan Perlengkapan Kantor <b style="text-transform: uppercase;"><?= $bidang; ?></b>
        </div>
        <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="card mb-2 py-1 border-left-danger">
                <div class="card-body">
                  <h5><i class="fas fa-store-alt"></i> <b >Laporan Inventaris</b></h5>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>
                </div>
                <form method="post" action="<?php echo base_url('kepala/dashboard/laporan_all/'.$id_bidang) ?>" target="_blank">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" style="margin-left: 3%;">Ruang</label>
                    <div class="col-sm-8" style="margin-left: -7%; margin-top: 1%;">
                      <select name="ruang" class="form-control select2" style="width: 100%;" required="required">
                        <option value="">-- Pilih Ruang --</option>
                        <option value="all">Semua Ruangan</option>
                        <?php foreach($ruang as $rg) : ?>
                        <option value="<?php echo $rg->id_ruang; ?>"><?php echo $rg->nama_ruang; ?> (Lt <?php echo $rg->lantai;?>)</option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('ruang','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" style="margin-left: 3%;">Kondisi</label>
                    <div class="col-sm-8" style="margin-left: -7%; margin-top: 1%;">
                      <select name="kondisi" class="form-control select2" style="width: 100%;" required="required">
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                      </select>
                      <?php echo form_error('kondisi','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" style="margin-left: 3%;">Tanggal</label>
                    <div class="col-sm-8" style="margin-left: -7%;">
                      <div class="input-group date">
                        <input type="text" placeholder="Masukkan tanggal akhir" class="form-control pull-right" id="datepicker" name="tgl" required="required">
                     </div>
                      <?php echo form_error('kondisi','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <button type="submit" name="edit" class="btn btn-success btn-sm ml-4 mb-3"><i class="fas fa-eye"></i> Lihat</button>
                  <br />
                </form>
            </div>
          </div>
          <div class="col-md-2"></div>
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