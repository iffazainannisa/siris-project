    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column bg-picture">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-cogs"></i> Kelola Mesin atau Alat Berat
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
                          <li class="breadcrumb-item"><?php echo anchor('user/mesin/inventaris','<i class="far fa-edit"></i> Kelola Inventaris'); ?></li>
                          <li class="breadcrumb-item active" aria-current="page">Edit Inventaris</li>
                        </ol>
                      </nav>
                  </b></h6>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>

                <?php foreach($inventaris as $iv) :?>
                <form method="post" action="<?php echo base_url('user/mesin/barang_inventaris_update') ?>">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Aset</label>
                    <div class="col-sm-8">
                      <?php echo form_hidden('id_inventaris', $iv->id_inventaris); ?>
                      <?php echo form_hidden('id_barang', $iv->id_barang); ?>
                      <?php echo form_hidden('id_ruang', $iv->id_ruang); ?>
                      <?php echo form_hidden('fix_ruang', $iv->fix_ruang); ?>
                      <?php echo form_hidden('jumlah_before', $iv->jumlah_barang); ?>
                      <?php echo form_hidden('no_inventaris', substr($iv->no_inventaris,0,7)); ?>
                      <input type="text" name="nama_aset" class="form-control" value="<?php echo $iv->nama_barang;?>" readonly>
                      <?php echo form_error('nama_aset','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nomor Inventaris</label>
                    <div class="col-sm-8">
                      <?php $str = substr($iv->no_inventaris, 2);  ?>
                      <input type="text" name="nomor" value="<?php echo $str;?>" class="form-control" readonly>
                      <?php echo form_error('nomor','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jumlah Barang</label>
                    <div class="col-sm-8">
                      <input type="number" name="jumlah" value="<?php echo $iv->jumlah_barang;?>" class="form-control" required>
                      <?php echo form_error('jumlah','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jumlah Baik</label>
                    <div class="col-sm-8">
                      <input type="number" name="baik" value="<?php echo $iv->jumlah_baik;?>" class="form-control" required>
                      <?php echo form_error('baik','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jumlah Rusak</label>
                    <div class="col-sm-8">
                      <input type="number" name="buruk" value="<?php echo $iv->jumlah_buruk;?>" class="form-control" required>
                      <?php echo form_error('buruk','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Ruang</label>
                    <div class="col-sm-8">
                      <select name="ruang" class="form-control select2" style="width: 100%;" required="required">
                        <option value="<?php echo $iv->id_ruang;?>"><?php echo $iv->nama_ruang;?> (Lt <?php echo $iv->lantai;?>)</option>
                        <?php foreach($ruang as $rg) : ?>
                        <option value="<?php echo $rg->id_ruang; ?>"><?php echo $rg->nama_ruang; ?> (Lt <?php echo $rg->lantai;?>)</option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('ruang','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                      <input type="text" name="ket" value="<?php echo $iv->keterangan;?>" class="form-control" readonly>
                      <?php echo form_error('ket','<div class="text-danger small ml-3">','</div>') ?>
                    </div>
                  </div>
                  
                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
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