    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column bg-picture">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-plus-square"></i> Kelola Aset Kendaraan
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
                          <li class="breadcrumb-item"><?php echo anchor('user/kendaraan','<i class="far fa-edit"></i> Kelola Kendaraan'); ?></li>
                          <li class="breadcrumb-item active" aria-current="page">Edit Kendaraan</li>
                        </ol>
                      </nav>
                  </b></h6>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>

                <?php foreach($kendaraan as $kd) :?>

                <form method="post" action="<?php echo base_url('user/kendaraan/kendaraan_update') ?>">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nomor Inventaris</label>
                    <div class="col-sm-8">
                      <?php echo form_hidden('id_kendaraan', $kd->id_kendaraan); ?>
                      <?php echo form_hidden('before', $kd->no_plat); ?>
                      <?php $str = substr($kd->no_inventaris, 2);  ?> 
                      <input type="text" name="iv" value="<?php echo $str; ?>" class="form-control" readonly>
                      <?php echo form_error('iv','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nomor Plat</label>
                    <div class="col-sm-8">
                      <input type="text" name="plat" value="<?php echo $kd->no_plat; ?>" class="form-control" required>
                      <?php echo form_error('plat','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jenis Aset</label>
                    <div class="col-sm-8">
                      <select name="jenis" class="form-control select2" style="width: 100%;" required="required">
                        <option value="<?php echo $kd->id_jenisaset;?>"><?php echo $kd->nama_jenis;?></option>
                        <?php foreach($jenis as $smbr) : ?>
                        <option value="<?php echo $smbr->id_jenisaset; ?>"><?php echo $smbr->nama_jenis; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('jenis','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-8">
                      <select name="status" class="form-control select2" style="width: 100%;" required="required">
                        <option value="<?php echo $kd->id_status;?>"><?php echo $kd->nama_status;?></option>
                        <?php foreach($status as $smbr) : ?>
                        <option value="<?php echo $smbr->id_status; ?>"><?php echo $smbr->nama_status; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('status','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Lokasi</label>
                    <div class="col-sm-8">
                      <input type="text" name="lokasi" value="<?php echo $kd->lokasi;?>" class="form-control" required>
                      <?php echo form_error('lokasi','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Merk</label>
                    <div class="col-sm-8">
                      <input type="text" name="merk" value="<?php echo $kd->merk;?>" class="form-control" required>
                      <?php echo form_error('merk','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Type</label>
                    <div class="col-sm-8">
                      <input type="text" name="type" value="<?php echo $kd->type;?>" class="form-control" required>
                      <?php echo form_error('type','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nomor Rangka</label>
                    <div class="col-sm-8">
                      <input type="text" name="rangka" value="<?php echo $kd->no_rangka;?>" class="form-control" required>
                      <?php echo form_error('rangka','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                 <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nomor Mesin</label>
                    <div class="col-sm-8">
                      <input type="text" name="mesin" value="<?php echo $kd->no_mesin;?>" class="form-control" required>
                      <?php echo form_error('mesin','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tahun Produksi</label>
                    <div class="col-sm-8">
                      <input type="number" name="produksi" value="<?php echo $kd->tahun_produksi;?>" class="form-control" required>
                      <?php echo form_error('produksi','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tahun Perolehan</label>
                    <div class="col-sm-8">
                      <input type="number" name="tahun" value="<?php echo $kd->tahun_perolehan;?>" class="form-control" required>
                      <?php echo form_error('tahun','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nilai Perolehan</label>
                    <div class="col-sm-8">
                      <input type="number" name="nilai" value="<?php echo $kd->nilai_perolehan;?>" class="form-control" required>
                      <?php echo form_error('nilai','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jenis BBM</label>
                    <div class="col-sm-8">
                      <input type="text" name="bbm" value="<?php echo $kd->jenis_bbm;?>" class="form-control" required>
                      <?php echo form_error('bbm','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">BPKB</label>
                    <div class="col-sm-8">
                      <input type="text" name="bpkb" value="<?php echo $kd->bpkb;?>" class="form-control" required>
                      <?php echo form_error('bpkb','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                      <input type="text" name="ket" value="<?php echo $kd->keterangan;?>" class="form-control" required>
                      <?php echo form_error('ket','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                   <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Kondisi</label>
                    <div class="col-sm-8">
                      <select name="kondisi" class="form-control select2" style="width: 100%;" required="required">
                        <option value="<?php echo $kd->kondisi; ?>"><?php echo $kd->kondisi; ?></option>
                        <option value="baik">baik</option>
                        <option value="rusak">rusak</option>
                      </select>
                      <?php echo form_error('kondisi','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <?php echo form_hidden('id_bidang', $userku['id_bidang']); ?>
                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                  <button name="button" id="button" value="true" type="reset" class="btn btn-danger">Reset</button>
                </form>
                <?php endforeach; ?>
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