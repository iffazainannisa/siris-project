    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-cogs"></i> Kelola Aset Mesin atau Alat Berat
        </div>
        <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-3">
              <div class="card mb-4 py-3 border-bottom-danger">
                <div class="card-body">
                  <b>Menu</b>
                  <div class="garis"></div>
                  <div class="menu">
                    <div class="menu-active" style="background: #ff968c;">
                      <?php echo anchor('user/mesin','<i class="fas fa-clipboard"></i> &nbsp;Kelola Mesin'); ?>
                    </div>
                    <div class="menu-active" style="font-size: 12pt;">
                      <i class="fas fa-list-alt"></i> &nbsp;Kelola Inventaris</div>
                      <form method="post" action="<?php echo base_url('user/mesin/inventaris') ?>">
                        <select name="nama" class="form-control select2" style="width: 100%;">
                          <option value="">-- Pilih Nama Mesin --</option>
                          <option value="all">Semua Mesin</option>
                          <?php foreach($barang as $bg) : ?>
                          <option value="<?php echo $bg->id_barang; ?>"><?php echo $bg->nama_barang; ?> (<?php echo $bg->tahun_perolehan;?>)</option>
                          <?php endforeach; ?>
                        </select>
                        <br />
                        <button type="submit" name="edit" class="btn btn-success" size="8px" style="margin-top: 2%;"><i class="fas fa-search"></i> Cari</button>
                      </form>
                </div>
                </div>
              </div>
              <?php echo anchor('user/mesin/print_qrcode','<div class="btn btn-info btn-md"><i class="fas fa-print"></i> &nbsp;Print All QRcode</div>','target="_blank"'); ?>

            </div>
            <div class="col-md-9 kecil">
              <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                  <h4><i class="far fa-edit"></i> <b >Kelola Mesin</b></h4>
                  <div class="garis" style="width: 100%; margin-bottom: 2%;"></div>
                </div>
                <div class="row">
                  <!-- Begin Page Content -->
                  <div class="container-fluid">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary"></h4>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0.5">
                            <thead>
                              <tr style="font-size: 12px; text-align: center;">
                                <th>Jenis</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Tahun Perolehan</th>
                                <th>Sumber</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                function rupiah($angka){
                                  $hasil_rupiah = "Rp" . number_format($angka,2,',','.');
                                  return $hasil_rupiah;
                                }
                              ?>
                              <?php  
                                foreach ($barang as $br) :
                              ?>
                              <tr style="font-size: 12px;">
                                <td><?php echo $br->nama_jenis; ?></td>
                                <td><?php echo $br->nama_barang; ?></td>
                                <td><?php echo $br->jumlah_total; ?></td>
                                <td><?php echo rupiah($br->harga_satuan); ?></td>
                                <td><?php echo $br->tahun_perolehan; ?></td>
                                <td><?php echo $br->nama_sumber; ?></td>
                                <td><?php echo $br->nama_status; ?></td>
                                <td><span class="badge">
                                  <a href="" id="detail" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-detail" data-barang="<?php echo $br->nama_barang;?>" data-jenis="<?php echo $br->nama_jenis; ?>" data-merk="<?php echo $br->merk; ?>" data-type="<?php echo $br->type; ?>" data-sn="<?php echo $br->serial_number; ?>" data-tahun="<?php echo $br->tahun_perolehan; ?>" data-harga="<?php echo $br->harga_satuan; ?>" data-sumber="<?php echo $br->nama_sumber; ?>" data-status="<?php echo $br->nama_status; ?>"><i class="fas fa-eye"></i></a>
                                  <?php echo anchor('user/mesin/barang_mesin_edit/'.$br->id_barang, '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div>'); ?>
                                <span onclick="javascript : return confirm('Anda yakin untuk menghapus data?')"><?php echo anchor('user/mesin/barang_mesin_hapus/'.$br->id_barang, '<div class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></div>'); ?></span>
                                </span>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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

    <!-- Modal Detail -->
    <div id="modal-detail" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fa fa-search"></i> Detail Mesin</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body table-responsive">
          <table class="table table-bordered table-striped" style="font-size: 14px;">
            <tbody>
              <tr>
                <th style="">Nama Mesin</th>
                <td><span id="nama_barang"></span></td>
              </tr>
              <tr>
                <th style="">Jenis</th>
                <td><span id="nama_jenis"></span></td>
              </tr>
              <tr>
                <th style="">Merk</th>
                <td><span id="merk"></span></td>
              </tr>
              <tr>
                <th style="">Type</th>
                <td><span id="type"></span></td>
              </tr>
              <tr>
                <th style="">Serial Number</th>
                <td><span id="serial_number"></span></td>
              </tr>
              <tr>
                <th style="">Tahun Perolehan</th>
                <td><span id="tahun_perolehan"></span></td>
              </tr>
              <tr>
                <th style="">Harga Satuan</th>
                <td><span id="harga_satuan"></span></td>
              </tr>
              <tr>
                <th style="">Sumber</th>
                <td><span id="nama_sumber"></span></td>
              </tr>
              <tr>
                <th style="">Status</th>
                <td><span id="nama_status"></span></td>
              </tr>
            </tbody>
         </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Ajax Mesin -->
  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click', '#detail', function(){
        var barang = $(this).data('barang');
        var jenis = $(this).data('jenis');
        var merk = $(this).data('merk');
        var type = $(this).data('type');
        var sn = $(this).data('sn');
        var tahun = $(this).data('tahun');
        var harga = $(this).data('harga');
        var sumber = $(this).data('sumber');
        var status = $(this).data('status');
        $('#nama_barang').text(barang);
        $('#nama_jenis').text(jenis);
        $('#merk').text(merk);
        $('#type').text(type);
        $('#serial_number').text(sn);
        $('#tahun_perolehan').text(tahun);
        $('#harga_satuan').text(harga);
        $('#nama_sumber').text(sumber);
        $('#nama_status').text(status);
      })
    })
  </script>