    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column bg-picture">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-cogs"></i> Kelola Aset Tanah
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
                          <li class="breadcrumb-item"><?php echo anchor('user/tanah','<i class="fas fa-qrcode"></i> Kelola Tanah'); ?></li>
                          <li class="breadcrumb-item active" aria-current="page">Generate QR Code</li>
                        </ol>
                      </nav>
                  </b></h6>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>                
                </div>
                <div class="card-body">
                <?php  
                  $qrCode = new Endroid\QrCode\QrCode('Tanah ('.$idin->no_inventaris.'); Alamat = '.$idin->alamat.'; Luas = '.$idin->luas_tanah.'; Tahun Perolehan = '.$idin->tahun_perolehan);
                  $qrCode->writeFile('assets/uploads/qrcode/itemt-'.$idin->id_tanah.'.png');
                ?>
                <center><img src="<?php echo base_url('assets/uploads/qrcode/itemt-'.$idin->id_tanah.'.png')?>" style="width: 200px;">
                <br />
                <?php $str = substr($idin->no_inventaris, 2);  ?> 
                <?php echo $str; ?>
                </center>
                </div><br />
                <center>
                   <form method="post" action="<?php echo base_url('user/tanah/print_qrcode_custom') ?>" target="_blank">
                        <div class="form-group">
                          <label class="col-form-label">Masukkan Jumlah</label>
                            <?php echo form_hidden('id_tanah', $idin->id_tanah); ?>
                            <input type="number" name="jumlah" value="1" class="form-control" style="width: 30%;" readonly>
                            <?php echo form_error('jumlah','<div class="text-danger small ml-3">','</div>') ?>
                            <button type="submit" name="edit" class="btn btn-success" size="8px" style="margin-top: 2%;"><i class="fas fa-print"></i> Print</button>
                        </div>
                        
                      </form> 
                </center>


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