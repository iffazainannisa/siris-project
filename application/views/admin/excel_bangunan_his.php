<!DOCTYPE html>
<html>
<body>
<body>
    <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=inventaris_bangunan_history.xls");
        header("Pragma: no-cache");
        header("Expires:0");
    ?>

    <table border="1" width="50%">
    	<thead>
    		<tr>
                <th>Id Track</th>
    			<th>Id Bangunan</th>
    			<th>Nomor Inventaris</th>
                <th>Luas Bangunan</th>
                <th>Jumlah Lantai</th>
    			<th>Keterangan</th>
    			<th>Update Time</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php $i=1; foreach ($inventaris_bangunan_history as $ith) {?>
    			<tr>
                    <td><?php echo $ith->id_track;?></td>
    				<td><?php echo $ith->id_bangunan;?></td>
    				<td><?php echo $ith->no_inventaris;?></td>
    				<td><?php echo $ith->luas_bangunan;?></td>
                    <td><?php echo $ith->jumlah_lantai;?></td>
    				<td><?php echo $ith->keterangan;?></td>
    				<td><?php echo $ith->update_time;?></td>
    			</tr>

    		<?php $i++;}?>

    	</tbody>
    </table>


</body>
</html>