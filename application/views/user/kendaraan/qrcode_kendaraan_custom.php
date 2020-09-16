<!DOCTYPE html>
<html>
<head>
  <title>Print QRCode Custom</title>

  <style type="text/css">

	header{
		position: fixed; 
        top: -1cm; 
        left: 0cm; 
        right: 0cm;
        height: 0cm;
        text-align: center;
        font-size: 10px;
	}
	figure {
	  /*position: relative;*/
	  width: 180px;
	  height: 75.6px;
	  text-align: center;
	  font-style: italic;
	  font-size: 8pt;
	  text-indent: 0;
	  border: thin silver solid;
	  margin:0%;
	  padding: 0.5em;
	  margin-bottom: 7px;
	  margin-left:7px;
	}

	<?php 
		$y = $stock/3;
		$h=($stock/$y)*(10+$stock);
	?>

	@page{
		size: 410px <?php echo $h;?>em;
		margin-left: 3.78px;
		margin-right: 3.78px;
		margin-top : 19px;
		margin-bottom: 0px;
	}
	
  </style>

</head>
<body>
    <?php $str = substr($idin->no_inventaris, 2);  ?>
    <div>
			<?php 
				$x = 1;
				$imagesPerRow = 2;
				while ($x <= $stock) { 
			?>
				<figure style="display: inline-block;">
					<img src="assets/uploads/qrcode/itemk-<?= $idin->id_kendaraan;?>.png" style="height: 60px; border: 2px solid #000;">
					<figcaption><?php echo $str; ?></figcaption>
				</figure>
			<?php 
					if($x % $imagesPerRow == 0){
						echo '<br />';
					}
					$x++; 
				}
				if($stock % 2 == 1){
					echo '<figure style="display: inline-block; border:none;">';
					echo '</figure>';
				} 
			?>
    </div>

</body>
</html>