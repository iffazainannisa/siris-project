<!DOCTYPE html>
<html>
<body>
<body>
    <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=inventaris_bangunan.xls");
        header("Pragma: no-cache");
        header("Expires:0");
    ?>

    <table border="1" width="100%">
    	<thead>
    		<tr>
    			<th>Id Bangunan</th>
    			<th>Nomor Inventaris</th>
                <th>Nama Bangunan</th>
                <th>Alamat</th>
                <th>Luas Bangunan</th>
                <th>Jumlah Lantai</th>
                <th>Tahun Perolehan</th>
                <th>Nilai Perolehan</th>
                <th>NJOP</th>
                <th>Id Sumber</th>
                <th>Id Status</th>
                <th>Keterangan</th>
    			<th>Id Bidang</th>
    			<th>Id Kategori Aset</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php $i=1; foreach ($inventaris_bangunan as $ith) {?>
    			<tr>
    				<td><?php echo $ith->id_bangunan;?></td>
    				<td><?php echo $ith->no_inventaris;?></td>
                    <td><?php echo $ith->nama_bangunan;?></td>
    				<td><?php echo $ith->alamat;?></td>
                    <td><?php echo $ith->luas_bangunan;?></td>
                    <td><?php echo $ith->jumlah_lantai;?></td>
                    <td><?php echo $ith->tahun_perolehan;?></td>
                    <td><?php echo $ith->nilai_perolehan;?></td>
                    <td><?php echo $ith->njop;?></td>
                    <td><?php echo $ith->id_sumber;?></td>
                    <td><?php echo $ith->id_status;?></td>
                    <td><?php echo $ith->keterangan;?></td>
                    <td><?php echo $ith->id_bidang;?></td>
    				<td><?php echo $ith->id_kategoriaset;?></td>
    			</tr>

    		<?php $i++;}?>

    	</tbody>
    </table>


</body>
</html>