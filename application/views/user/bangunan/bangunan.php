    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-cogs"></i> Kelola Aset Bangunan
        </div>
        <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
          <div class="col-md-12">
            <?php echo anchor('user/bangunan/print_qrcode','<div class="btn btn-info btn-md"><i class="fas fa-print"></i> &nbsp;Print All QRcode</div>','target="_blank"'); ?>
          </div><br/><br/>
          <div class="col-md-12 kecil">
            <div class="card mb-4 py-3 border-left-danger">
              <div class="card-body">
                <h4><i class="far fa-edit"></i> <b >Kelola Bangunan</b></h4>
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
                            <th>Nomor Inventaris</th>
                            <th>Nama Bangunan</th>
                            <th>Alamat</th>
                            <th>Luas Bangunan (m<sup>2</sup>)</th>
                            <th>Jumlah Lantai</th>
                            <th>Tahun Perolehan</th>
                            <th>Nilai Perolehan</th>
                            <th>NJOP</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            function rupiah($angka){
                              if($angka==""){
                                return "";
                              }
                              $hasil_rupiah = "Rp" . number_format($angka,2,',','.');
                              return $hasil_rupiah;
                            }
                          ?>
                          <?php  
                            // $no=1;
                            foreach ($bangunan as $tn) :
                          ?>
                          <tr style="font-size: 12px;">
                          <?php $str = substr($tn->no_inventaris, 2);  ?> 
                            <td><?php echo $str; ?></td>
                            <td><?php echo $tn->nama_bangunan; ?></td>
                            <td><?php echo $tn->alamat; ?></td>
                            <td><?php echo $tn->luas_bangunan; ?></td>
                            <td><?php echo $tn->jumlah_lantai; ?></td>
                            <td><?php echo $tn->tahun_perolehan; ?></td>
                            <td><?php echo rupiah($tn->nilai_perolehan); ?></td>
                            <td><?php echo rupiah($tn->njop); ?></td>
                            <td><span class="badge">
                              <a href="" id="detail" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-detail" data-alamat="<?php echo $tn->alamat;?>" data-nama="<?php echo $tn->nama_bangunan;?>" data-luas="<?php echo $tn->luas_bangunan;?>" data-lantai="<?php echo $tn->jumlah_lantai;?>" data-no="<?php echo $str;?>" data-perolehan="<?php echo $tn->tahun_perolehan;?>" data-nilai="<?php echo rupiah($tn->nilai_perolehan);?>"  data-njop="<?php echo $tn->njop; ?>" data-sumber="<?php echo $tn->nama_sumber; ?>" data-status="<?php echo $tn->nama_status; ?>" data-id="<?php echo $tn->id_bangunan; ?>" data-ket="<?php echo $tn->keterangan; ?>"><i class="fas fa-eye"></i></a>
                              <?php echo anchor('user/bangunan/bangunan_edit/'.$tn->id_bangunan, '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div>'); ?>
                              <?php echo anchor('user/bangunan/qrcode/'.$tn->id_bangunan, '<div class="btn btn-warning btn-sm"><i class="fas fa-qrcode"></i></div>'); ?>
                              <?php $onclick = array('onclick'=>"return confirm('Anda yakin untuk menghapus data?')");?>
                              <?php echo anchor('user/bangunan/bangunan_inventaris_hapus/'.$tn->id_bangunan, '<div class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></div>',$onclick); ?>
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
          <h5 class="modal-title"><i class="fa fa-search"></i> Detail Inventaris Bangunan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
        </div>
        <center>
          <br />
           <img src="" name="image" id="id_bangunan" width="40%">
        </center>
        <div class="modal-body table-responsive">
          <table class="table table-bordered table-striped" style="font-size: 14px;">
            <tbody>
              <tr>
                <th style="">Nama Bangunan</th>
                <td><span id="nama_bangunan"></span></td>
              </tr>
              <tr>
                <th style="">Alamat</th>
                <td><span id="alamat"></span></td>
              </tr>
              <tr>
                <th style="">Nomor Inventaris</th>
                <td><span id="no_inventaris"></span></td>
              </tr>
              <tr>
                <th style="">Luas Bangunan</th>
                <td><span id="luas_bangunan"></span></td>
              </tr>
              <tr>
                <th style="">Jumlah Lantai</th>
                <td><span id="jumlah_lantai"></span></td>
              </tr>
              <tr>
                <th style="">Tahun Perolehan</th>
                <td><span id="tahun_perolehan"></span></td>
              </tr>
              <tr>
                <th style="">Nilai Perolehan</th>
                <td><span id="nilai_perolehan"></span></td>
              </tr>
              <tr>
                <th style="">NJOP</th>
                <td><span id="njop"></span></td>
              </tr>
              <tr>
                <th style="">Sumber</th>
                <td><span id="nama_sumber"></span></td>
              </tr>
              <tr>
                <th style="">Status</th>
                <td><span id="nama_status"></span></td>
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

    <!-- Ajax Bangunan -->
  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click', '#detail', function(){
        var nama = $(this).data('nama');
        var alamat = $(this).data('alamat');
        var id = $(this).data('id');
        var no = $(this).data('no');
        var luas = $(this).data('luas');
        var lantai = $(this).data('lantai');
        var perolehan = $(this).data('perolehan');
        var nilai = $(this).data('nilai');
        var njop = $(this).data('njop');
        var sumber = $(this).data('sumber');
        var status = $(this).data('status');
        var ket = $(this).data('ket');
        $('#nama_bangunan').text(nama);
        $('#alamat').text(alamat);
        $('#id_bangunan').prop('src','<?php echo base_url()?>assets/uploads/qrcode/itemb-'+id+'.png');
        $('#no_inventaris').text(no);
        $('#luas_bangunan').text(luas);
        $('#jumlah_lantai').text(lantai);
        $('#tahun_perolehan').text(perolehan);
        $('#nilai_perolehan').text(nilai);
        $('#njop').text(njop);
        $('#nama_sumber').text(sumber);
        $('#nama_status').text(status);
        $('#keterangan').text(ket);
      })
    })
  </script>