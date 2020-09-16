<!DOCTYPE html>
<html>
<body>
<body>
    <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=inventaris_kendaraan.xls");
        header("Pragma: no-cache");
        header("Expires:0");
    ?>

    <table border="1" width="100%">
    	<thead>
    		<tr>
    			<th>Id Kendaraan</th>
                <th>Nomor Plat</th>
    			<th>Nomor Inventaris</th>
                <th>Status</th>
                <th>Lokasi</th>
                <th>Merek</th>
                <th>Type</th>
                <th>Nomor Rangka</th>
                <th>Nomor Mesin</th>
                <th>Tahun Produksi</th>
                <th>Tahun Perolehan</th>
                <th>Nilai Perolehan</th>
                <th>Jenis BBM</th>
                <th>BPKB</th>
                <th>Keterangan</th>
                <th>Kondisi</th>
    			<th>Id Bidang</th>
    			<th>Id Jenis Aset</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php $i=1; foreach ($inventaris_kendaraan as $ith) {?>
    			<tr>
    				<td><?php echo $ith->id_kendaraan;?></td>
                    <td><?php echo $ith->no_plat;?></td>
    				<td><?php echo $ith->no_inventaris;?></td>
                    <td><?php echo $ith->id_status;?></td>
    				<td><?php echo $ith->lokasi;?></td>
                    <td><?php echo $ith->merk;?></td>
                    <td><?php echo $ith->type;?></td>
                    <td><?php echo $ith->no_rangka;?></td>
                    <td><?php echo $ith->no_mesin;?></td>
                    <td><?php echo $ith->tahun_produksi;?></td>
                    <td><?php echo $ith->tahun_perolehan;?></td>
                    <td><?php echo $ith->nilai_perolehan;?></td>
                    <td><?php echo $ith->jenis_bbm;?></td>
                    <td><?php echo $ith->bpkb;?></td>
                    <td><?php echo $ith->keterangan;?></td>
                    <td><?php echo $ith->kondisi;?></td>
                    <td><?php echo $ith->id_bidang;?></td>
    				<td><?php echo $ith->id_jenisaset;?></td>
    			</tr>

    		<?php $i++;}?>

    	</tbody>
    </table>


</body>
</html>