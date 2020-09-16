<!DOCTYPE html>
<html>
<head>
  <title>Print Laporan Ruangan</title>
  <style type="text/css">
  	footer .pagenum:before {
      content: counter(page);
	}
	footer{
		position: fixed; 
        bottom: 0cm; 
        left: 0cm; 
        right: 0cm;
        height: 0cm;
        text-align: right;
        font-size: 9pt;
	}
	header{
		position: fixed; 
        top: -1.3cm; 
        left: 0cm; 
        right: 0cm;
        height: 0cm;
        text-align: center;
	}
  .table-responsive{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    color: black;
  }

  td,th{
    border: 1px solid #000;
    padding: 8px;
    border-collapse: collapse;
    text-align: center;
  }

  th {
    padding-top: 12px;
    padding-bottom: 12px;
    background-color: #d6e6ff;
  }

  </style>

</head>
<body>
		<header>
      <img src="assets/img/bar.png" style="width: 120%;">
       <div class="container">
        <div class="row">
          <div class="col-md-8" style="text-align: right;position: fixed; right: 0.5cm; font-size: 6pt; top: 0.7cm;">
          <?php 
            if($bidang == 1){
             echo "004/L3/RM/UMUM.RT-UTDSMG";
            }else if($bidang == 2){
             echo "004/L3/RM/UMUM.RT-MRSMG"; 
            }else if($bidang == 3){
             echo "004/L3/RM/UMUM.RT-UPJSMG"; 
            }
          ?>          
          </div>
          <div class="col-md-4">
            <img src="assets/img/logo.png" style="width: 8%; right: 0.5cm; position: fixed;">
          </div>
        </div>
      </div>
    </header>
        <div class="container" style="margin-left:3%;margin-top:7%;font-size: 9pt; color: black;text-align: left;">
        <span style="text-transform: uppercase; "><b>DAFTAR INVENTARIS <?php echo $kategori;?><br/><?php echo $bid;?> PMI KOTA SEMARANG</h5></span>
        <p>Tahun : <?php echo date('Y', strtotime($tgl)); ?><br />
        Ruang : <?php echo $ruang->nama_ruang; ?> (Lt <?php echo $ruang->lantai; ?>)</p>
      </div>
    <footer>
      <div class="pagenum-container">Page <span class="pagenum"></span></div>
    </footer>
  
    <div class="table-responsive" style="margin-left: 3%; top:1.5cm; margin-top:-6%; margin-bottom: 4%; margin-right:3%; font-size: 7.5pt; position: relative;">
      <table class="table table-bordered" width="100%">
        <thead class="table-primary">
          <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Nomor Inventaris</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $no = 1;
          foreach ($inventaris as $iv) : 
        ?>
          <tr>
            <td style="text-align: center;"><?php echo $no++; ?></td>
            <td><?php echo $iv->nama_barang; ?></td>
            <td style="text-align: center;"><?php echo $iv->jumlah_baik; ?></td>
            <?php $str = substr($iv->no_inventaris, 2);  ?> 
            <td><?php echo $str; ?></td>
            <td><?php echo $iv->keterangan; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>

    </div>

</body>
</html>