<!DOCTYPE html>
<html>
<body>
<body>
    <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=inventaris_tanah_history.xls");
        header("Pragma: no-cache");
        header("Expires:0");
    ?>

    <table border="1" width="50%">
    	<thead>
    		<tr>
                <th>Id Track</th>
    			<th>Id Tanah</th>
    			<th>Nomor Inventaris</th>
    			<th>Luas Tanah</th>
    			<th>Keterangan</th>
    			<th>Update Time</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php $i=1; foreach ($inventaris_tanah_history as $ith) {?>
    			<tr>
                    <td><?php echo $ith->id_track;?></td>
    				<td><?php echo $ith->id_tanah;?></td>
    				<td><?php echo $ith->no_inventaris;?></td>
    				<td><?php echo $ith->luas_tanah;?></td>
    				<td><?php echo $ith->keterangan;?></td>
    				<td><?php echo $ith->update_time;?></td>
    			</tr>

    		<?php $i++;}?>

    	</tbody>
    </table>
</body>
</html>