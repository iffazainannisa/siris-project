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
                    <div class="menu-active">
                      <?php echo anchor('user/mesin','<i class="fas fa-clipboard"></i> &nbsp;Kelola Mesin'); ?>
                    </div>
                    <div class="menu-active" style="background: #ff968c;" style="font-size: 12pt;">
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
                  <h4><i class="far fa-edit"></i> <b >Kelola Inventaris </b></h4>
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
                        <?php if ($cek == "all" || $cek == ""){}
                         else{ ?>
                        <p style="border: 2px solid red; padding: 5px;"><b>Nama Mesin</b> : <?php echo $aset['nama_barang']; ?><br />
                        <b>Tahun Perolehan</b> : <?php echo $aset['tahun_perolehan']; ?></br />
                        <b>Jumlah Total</b> : <?php echo $aset['jumlah_total']; ?></p>
                        <br/>
                        <?php } ?>
                        <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0.5">
                            <thead>
                              <tr style="font-size: 12px; text-align: center;">
                                <th>Inventaris</th>
                                <th>Nama Barang</th>
                                <th>Total</th>
                                <th>Baik</th>
                                <th>Rusak</th>
                                <th>Ruang</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php  
                                foreach ($inventaris as $iv) :
                              ?>
                              <tr style="font-size: 12px;">
                                <?php $str = substr($iv->no_inventaris, 2);  ?>
                                <td><?php echo $str; ?></td>
                                <td><?php echo $iv->nama_barang; ?></td>
                                <td><?php echo $iv->jumlah_barang; ?></td>
                                <td><?php echo $iv->jumlah_baik; ?></td>
                                <td><?php echo $iv->jumlah_buruk; ?></td>
                                <td><?php echo $iv->nama_ruang; ?> (Lt <?php echo $iv->lantai; ?>)</td>
                                <td><span style="background-color: yellow;"><?php echo $iv->keterangan; ?></span></td>
                                <td><span class="badge">
                                  <a href="" id="detail" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-detail" data-barang="<?php echo $iv->nama_barang;?>" data-id="<?php echo $iv->id_inventaris; ?>" data-no="<?php echo $str; ?>" data-jumlah="<?php echo $iv->jumlah_barang; ?>" data-baik="<?php echo $iv->jumlah_baik; ?>" data-buruk="<?php echo $iv->jumlah_buruk; ?>" data-ruang="<?php echo $iv->nama_ruang; ?> (Lt <?php echo $iv->lantai; ?>" data-ket="<?php echo $iv->keterangan; ?>"><i class="fas fa-eye"></i></a>
                                  <?php echo anchor('user/mesin/barang_inventaris_edit/'.$iv->id_inventaris, '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div>'); ?>
                                  <?php echo anchor('user/mesin/qrcode/'.$iv->id_inventaris, '<div class="btn btn-warning btn-sm"><i class="fas fa-qrcode"></i></div>'); ?>
                                    <?php $onclick = array('onclick'=>"return confirm('Anda yakin untuk menghapus data?')");?>
                                  <?php echo anchor('user/mesin/mesin_inventaris_hapus/'.$iv->id_inventaris, '<div class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></div>',$onclick); ?>
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
          <h5 class="modal-title"><i class="fa fa-search"></i> Detail Inventaris Mesin</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
        </div>
        <center>
          <br />
           <img src="" name="image" id="id_inventaris" width="40%">
        </center>
        <div class="modal-body table-responsive">
          <table class="table table-bordered table-striped" style="font-size: 14px;">
            <tbody>
              <tr>
                <th style="">Nama Mesin</th>
                <td><span id="nama_barang"></span></td>
              </tr>
              <tr>
                <th style="">Nomor Inventaris</th>
                <td><span id="no_inventaris"></span></td>
              </tr>
              <tr>
                <th style="">Jumlah Total</th>
                <td><span id="jumlah_barang"></span></td>
              </tr>
              <tr>
                <th style="">Jumlah Baik</th>
                <td><span id="jumlah_baik"></span></td>
              </tr>
              <tr>
                <th style="">Jumlah Rusak</th>
                <td><span id="jumlah_buruk"></span></td>
              </tr>
              <tr>
                <th style="">Lokasi</th>
                <td><span id="nama_ruang"></span></td>
              </tr>
              <tr>
                <th style="">Keterangan</th>
                <td><span id="keterangan"></span></td>
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
        var id = $(this).data('id');
        var no = $(this).data('no');
        var jumlah = $(this).data('jumlah');
        var baik = $(this).data('baik');
        var buruk = $(this).data('buruk');
        var ruang = $(this).data('ruang');
        var ket = $(this).data('ket');
        $('#nama_barang').text(barang);
        $('#id_inventaris').prop('src','<?php echo base_url()?>assets/uploads/qrcode/item-'+id+'.png');
        $('#no_inventaris').text(no);
        $('#jumlah_barang').text(jumlah);
        $('#jumlah_baik').text(baik);
        $('#jumlah_buruk').text(buruk);
        $('#nama_ruang').text(ruang);
        $('#keterangan').text(ket);
      })
    })
  </script>