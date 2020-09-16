<!DOCTYPE html>
<html>
<body>
<body>
    <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=inventaris_tanah.xls");
        header("Pragma: no-cache");
        header("Expires:0");
    ?>

    <table border="1" width="100%">
    	<thead>
    		<tr>
    			<th>Id Tanah</th>
    			<th>Nomor Inventaris</th>
                <th>Alamat</th>
                <th>Luas Tanah</th>
                <th>Tahun Perolehan</th>
                <th>Nilai Perolehan</th>
                <th>NJOP</th>
                <th>Id Sumber</th>
                <th>Id Status</th>
                <th>Keterangan</th>
                <th>Id Kategori Aset</th>
    			<th>Id Bidang</th>
    			
    		</tr>
    	</thead>
    	<tbody>
    		<?php $i=1; foreach ($inventaris_tanah as $ith) {?>
    			<tr>
    				<td><?php echo $ith->id_tanah;?></td>
    				<td><?php echo $ith->no_inventaris;?></td>
                    <td><?php echo $ith->alamat;?></td>
    				<td><?php echo $ith->luas_tanah;?></td>
                    <td><?php echo $ith->tahun_perolehan;?></td>
                    <td><?php echo $ith->nilai_perolehan;?></td>
                    <td><?php echo $ith->njop;?></td>
                    <td><?php echo $ith->id_sumber;?></td>
                    <td><?php echo $ith->id_status;?></td>
                    <td><?php echo $ith->keterangan;?></td>
                    <td><?php echo $ith->id_kategoriaset;?></td>
                    <td><?php echo $ith->id_bidang;?></td>		
    			</tr>

    		<?php $i++;}?>

    	</tbody>
    </table>


</body>
</html>