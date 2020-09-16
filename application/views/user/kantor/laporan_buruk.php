<!DOCTYPE html>
<html>
<head>
  <title>Print Laporan Kerusakan</title>

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
          <div class="col-md-8" style="text-align: right;position: fixed; right: 0.5cm; font-size: 9pt;">
          </div>
          <div class="col-md-4">
            <img src="assets/img/logo.png" style="width: 8%; right: 0.5cm; position: fixed;">
          </div>
        </div>
      </div>
    </header>
      <div class="container-fluid" style="margin-top:7%; font-size: 9pt; color: black;">
        <center>
          <span style="text-transform: uppercase;"><b><?php echo $bid;?></b><br />
            <b>PALANG MERAH INDONESIA</b><br />
            <b>KOTA SEMARANG</b><br />
            <b>LAPORAN KERUSAKAN</b><br />
            <b><?php echo $kategori;?></b><br />
            <?php 
              $semester = date("m",strtotime($tgl));
              $tahun = date("Y",strtotime($tgl));
              echo "<b>";
              if ($semester>6){
                echo "JULI S.D. DESEMBER ".$tahun;
              }else{
                echo "JANUARI S.D. JUNI ".$tahun;
              }
              echo "</b><br />";

            ?>
          </span>
      </center>
      </div>
    <footer>
      <div class="pagenum-container">Page <span class="pagenum"></span></div>
    </footer>
    
    <div class="table-responsive" style="margin-left: 5%; top:1.5cm; margin-top:-4%; margin-bottom: 4%; margin-right:5%; font-size: 7.5pt; position: relative;">
      <table class="table table-bordered" width="100%">
        <thead class="table-primary">
          <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang Rusak</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $no = 1;
          foreach ($inventaris as $iv) : 
        ?>
          <tr>
            <td><?php echo $no++;?></td>
            <td style="text-align: left;"><?php echo $iv->nama_barang;?></td>
            <td><?php echo $iv->jumlah_buruk;?></td>
            <td style="text-align: left;">
                <?php echo $iv->nama_ruang.' Lt '.$iv->lantai; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>

</body>
</html>