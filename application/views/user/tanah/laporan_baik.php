<!DOCTYPE html>
<html>
<head>
  <title>Print Laporan Semester</title>
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
          <img src="assets/img/logo.png" style="width: 8%; right: 0cm; position: fixed;">
        </div>
      </div>
    </div>
  </header>
    <div class="container-fluid" style="margin-top:7%;font-size: 9pt; color: black;">
      <center>
        <span style="text-transform: uppercase;"><b><?php echo $bid;?></b><br />
          <b>PALANG MERAH INDONESIA</b><br />
          <b>KOTA SEMARANG</b><br />
          <b>DAFTAR ASET TETAP</b><br />
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
    
    <div class="table-responsive" style="margin-left: -1%;top:1.5cm; margin-top:-4%; margin-bottom: 4%; margin-right:-1%; font-size: 7.5pt; position: relative;">
      <table class="table table-bordered" width="100%">
        <thead class="table-primary">
          <tr>
            <th>No.</th>
            <th>Alamat</th>
            <th>Luas Tanah (m<sup>2</sup>)</th>
            <th>Tahun Perolehan</th>
            <th>Nilai Perolehan</th>
            <th>NJOP</th>
            <th>Sumber</th>
            <th>Status Kepemilikan</th>
            <th>Keterangan</th>
          </tr>
          <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
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
          $no = 1; $total=0;
          foreach ($inventari as $iv) : 
        ?>
          <tr>
            <td width="2%"><?php echo $no++;?></td>
            <td width="9%" style="text-align: left;"><?php echo $iv->alamat;?></td>
            <td width="6%"><?php echo $iv->luas_tanah;?></td>
            <td width="5%"><?php echo $iv->tahun_perolehan;?></td>
            <td width="6%"><?php echo rupiah($iv->nilai_perolehan);?></td>
            <?php $total=$total+($iv->nilai_perolehan);?>
            <td width="6%"><?php echo rupiah($iv->njop);?></td>
            <td width="5%"><?php echo $iv->nama_sumber;?></td>
            <td width="6%"><?php echo $iv->nama_status;?></td>
            <td width="9%"><?php echo $iv->keterangan;?></td>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="4" style="text-align: right;">Jumlah Total</td>
          <td><?php echo rupiah($total);?></td>
          <td colspan="4"></td>
        </tr>
        </tbody>
      </table>

    </div>

</body>
</html>