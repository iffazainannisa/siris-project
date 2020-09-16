<!DOCTYPE html>
<html>
<body>
<body>
    <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=inventaris_mesin_history.xls");
        header("Pragma: no-cache");
        header("Expires:0");
    ?>

    <table border="1" width="50%">
    	<thead>
    		<tr>
                <th>Id Track</th>
    			<th>Id Inventaris</th>
                <th>Id Barang</th>
    			<th>Nomor Inventaris</th>
                <th>Jumlah Barang</th>
                <th>Jumlah Baik</th>
                <th>Jumlah Buruk</th>
                <th>Id Ruang</th>
                <th>Fix Ruang</th>
    			<th>Keterangan</th>
    			<th>Update Time</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php $i=1; foreach ($inventaris_mesin_history as $ith) {?>
    			<tr>
    				<td><?php echo $ith->id_track;?></td>
                    <td><?php echo $ith->id_inventaris;?></td>
                    <td><?php echo $ith->id_barang;?></td>
                    <td><?php echo $ith->no_inventaris;?></td>
                    <td><?php echo $ith->jumlah_barang;?></td>
                    <td><?php echo $ith->jumlah_baik;?></td>
                    <td><?php echo $ith->jumlah_buruk;?></td>
                    <td><?php echo $ith->id_ruang;?></td>
                    <td><?php echo $ith->fix_ruang;?></td>
                    <td><?php echo $ith->keterangan;?></td>
                    <td><?php echo $ith->update_time;?></td>
    			</tr>

    		<?php $i++;}?>

    	</tbody>
    </table>


</body>
</html>