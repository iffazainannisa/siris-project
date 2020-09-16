<!DOCTYPE html>
<html>
<head>
  <title>Print All QRCode</title>
 
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
		<div>
		<?php 
			$x = 1;
			foreach ($idin as $id) : 
		?>
			<?php 
				$imagesPerRow = 2;
				$str = substr($id->no_inventaris, 2);
				if($x==2){
					$z = 2;
				}else{
					$z= 1;
				}
				while ($x <= $z) { 
			?>
				<figure style="display:inline-block;">
					<img src="assets/uploads/qrcode/itemb-<?= $id->id_bangunan;?>.png" style="height: 60px; border: 2px solid #000;">
					<figcaption><?php echo $str; ?></figcaption>
				</figure>
			<?php 
					if($x % $imagesPerRow == 0){
						echo '<br />';
					}
					$x++; 
				}
				if($z % 2 == 1){
					$x = 2;
				}else{
					$x=1;
				} 
			?>
		<?php endforeach; ?>
		<?php if($stock % 2 == 1){
					echo '<figure style="display: inline-block; border:none;">';
					echo '</figure>';
				}
		?>
		</div>
</body>
</html>