    <!-- <?php //var_dump($pengurus);?> -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="alert bg-content" role="alert">
          <i class="fas fa-cogs"></i> Kelola Aset Kendaraan
        </div>
        <?php echo $this->session->flashdata('pesan');?>
        <!-- Content Row -->
        <div class="row">
          <div class="col-md-12">
            <?php echo anchor('user/kendaraan/print_qrcode','<div class="btn btn-info btn-md"><i class="fas fa-print"></i> &nbsp;Print All QRcode</div>','target="_blank"'); ?>
          </div><br/><br/>
          <div class="col-md-12 kecil">
            <div class="card mb-4 py-3 border-left-danger">
              <div class="card-body">
                <h4><i class="far fa-edit"></i> <b >Kelola Kendaraan</b></h4>
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
                            <th>Nomor Plat</th>
                            <th>Jenis</th>
                            <th>Merk</th>
                            <th>Type</th>
                            <th>Tahun Produksi</th>
                            <th>Tahun Perolehan</th>
                            <th>Nilai Perolehan</th>
                            <th>Keterangan</th>
                            <th>Kondisi</th>
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
                            foreach ($kendaraan as $br) :
                          ?>
                          <tr style="font-size: 12px;">
                            <?php $str = substr($br->no_inventaris, 2);  ?> 
                            <td><?php echo $str; ?></td>
                            <td><?php echo $br->no_plat; ?></td>
                            <td><?php echo $br->nama_jenis; ?></td>
                            <td><?php echo $br->merk; ?></td>
                            <td><?php echo $br->type; ?></td>
                            <td><?php echo $br->tahun_produksi; ?></td>
                            <td><?php echo $br->tahun_perolehan; ?></td>
                            <td><?php echo rupiah($br->nilai_perolehan); ?></td>
                            <td><?php echo $br->keterangan; ?></td>
                            <td><?php echo $br->kondisi; ?></td>
                            <td><span class="badge">
                              <a href="" id="detail" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-detail" data-jenis="<?php echo $br->nama_jenis;?>" data-plat="<?php echo $br->no_plat;?>" data-no="<?php echo $str;?>" data-status="<?php echo $br->nama_status;?>" data-lokasi="<?php echo $br->lokasi;?>" data-merk="<?php echo $br->merk;?>" data-type="<?php echo $br->type;?>" data-rangka="<?php echo $br->no_rangka;?>" data-mesin="<?php echo $br->no_mesin;?>" data-produksi="<?php echo $br->tahun_produksi;?>" data-perolehan="<?php echo $br->tahun_perolehan;?>" data-nilai="<?php echo rupiah($br->nilai_perolehan);?>"  data-bbm="<?php echo $br->jenis_bbm; ?>" data-bpkb="<?php echo $br->bpkb; ?>" data-kondisi="<?php echo $br->kondisi; ?>" data-id="<?php echo $br->id_kendaraan; ?>" data-ket="<?php echo $br->keterangan; ?>"><i class="fas fa-eye"></i></a>
                              <?php echo anchor('user/kendaraan/kendaraan_edit/'.$br->id_kendaraan, '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div>'); ?>
                              <?php echo anchor('user/kendaraan/qrcode/'.$br->id_kendaraan, '<div class="btn btn-warning btn-sm"><i class="fas fa-qrcode"></i></div>'); ?>
                              <?php $onclick = array('onclick'=>"return confirm('Anda yakin untuk menghapus data?')");?>
                                  <?php echo anchor('user/kendaraan/kendaraan_inventaris_hapus/'.$br->id_kendaraan, '<div class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></div>',$onclick); ?>
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
          <h5 class="modal-title"><i class="fa fa-search"></i> Detail Inventaris Kendaraan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
        </div>
        <center>
          <br />
           <img src="" name="image" id="id_kendaraan" width="40%">
        </center>
        <div class="modal-body table-responsive">
          <table class="table table-bordered table-striped" style="font-size: 14px;">
            <tbody>
              <tr>
                <th style="">Jenis Kendaraan</th>
                <td><span id="nama_jenis"></span></td>
              </tr>
              <tr>
                <th style="">Nomor Inventaris</th>
                <td><span id="no_inventaris"></span></td>
              </tr>
              <tr>
                <th style="">Nomor Plat</th>
                <td><span id="no_plat"></span></td>
              </tr>
              <tr>
                <th style="">Status</th>
                <td><span id="nama_status"></span></td>
              </tr>
              <tr>
                <th style="">Lokasi</th>
                <td><span id="lokasi"></span></td>
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
                <th style="">Nomor Rangka</th>
                <td><span id="no_rangka"></span></td>
              </tr>
              <tr>
                <th style="">Nomor Mesin</th>
                <td><span id="no_mesin"></span></td>
              </tr>
              <tr>
                <th style="">Tahun Produksi</th>
                <td><span id="tahun_produksi"></span></td>
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
                <th style="">Jenis BBM</th>
                <td><span id="jenis_bbm"></span></td>
              </tr>
              <tr>
                <th style="">BPKB</th>
                <td><span id="bpkb"></span></td>
              </tr>
              <tr>
                <th style="">Kondisi</th>
                <td><span id="kondisi"></span></td>
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

    <!-- Ajax Kendaraan -->
  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click', '#detail', function(){
        var jenis = $(this).data('jenis');
        var id = $(this).data('id');
        var no = $(this).data('no');
        var plat = $(this).data('plat');
        var status = $(this).data('status');
        var lokasi = $(this).data('lokasi');
        var merk = $(this).data('merk');
        var type = $(this).data('type');
        var rangka = $(this).data('rangka');
        var mesin = $(this).data('mesin');
        var produksi = $(this).data('produksi');
        var perolehan = $(this).data('perolehan');
        var nilai = $(this).data('nilai');
        var bbm = $(this).data('bbm');
        var bpkb = $(this).data('bpkb');
        var kondisi = $(this).data('kondisi');
        var ket = $(this).data('ket');
        $('#nama_jenis').text(jenis);
        $('#id_kendaraan').prop('src','<?php echo base_url()?>assets/uploads/qrcode/itemk-'+id+'.png');
        $('#no_inventaris').text(no);
        $('#no_plat').text(plat);
        $('#nama_status').text(status);
        $('#lokasi').text(lokasi);
        $('#merk').text(merk);
        $('#type').text(type);
        $('#no_rangka').text(rangka);
        $('#no_mesin').text(mesin);
        $('#tahun_produksi').text(produksi);
        $('#tahun_perolehan').text(perolehan);
        $('#nilai_perolehan').text(nilai);
        $('#jenis_bbm').text(bbm);
        $('#bpkb').text(bpkb);
        $('#kondisi').text(kondisi);
        $('#keterangan').text(ket);
      })
    })
  </script>