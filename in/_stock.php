<?php 
function stockByItem($itemId){
	global $connn;
	$search_stock=$connn->query("SELECT * FROM stock WHERE item_id = '$itemId' ORDER BY new_price DESC");
	if ($search_stock->num_rows<1) {
		?>
		<div id="stock" class="wbg r shadow_1 p1010 m0505">ပစ္စည်မရှိသေးပါ မကြာမီရမည်</div>
		<?php
	}
	else{
		while ($stock=$search_stock->fetch_assoc()) {
			$photo_s="media/item/".$itemId."/i".$itemId."_s".$stock['id']."_s.jpg";
			$photo_l="media/item/".$itemId."/i".$itemId."_s".$stock['id'].".jpg";
			?>
			<div id="stock" class="wbg r shadow_1" 
			onclick="
			document.getElementById('PhotoItemId<?php echo $itemId;?>').src = '<?php echo $photo_l.'?v='.filemtime($photo_l);?>';
			document.getElementById('item_size<?php echo $itemId;?>').innerHTML = '<?php echo $stock['size'];?>';
			document.getElementById('item_price<?php echo $itemId;?>').innerHTML = '<?php echo number_format($stock['new_price']);?><small>ကျပ်</small>';
			document.getElementById('item_id<?php echo $itemId;?>').innerHTML = '#<?php echo $stock['id'];?>';
			"
			>
				<div class="flex_be ce wbg r shadow_1">
					<div class="flex ce _p0505">
						<img src="<?php echo $photo_s.'?v='.filemtime($photo_s);?>" id="stockPhoto" class="r">
						<div><?php echo $stock['size'];?></div>
					</div>
					<div class="flex ce _p1010 _m1010">
						<div class="right"><?php priceByStockId($stock['id']);?></div>
						<button onclick="showHide('','stockEdit<?php echo $stock['id'];?>')">
							<span class="fas fa-cart-plus">&nbsp;</span><span>Buy</span>
						</button>
					</div>					
				</div>
				<div id="checkNumberOfStockInCart<?php echo $stock['id'];?>">
					<?php echo checkNumberOfStockInCart($stock['id']);?>
				</div>
			</div>
			<?php
		}
	}
}
?>