<?php

if (isset($_REQUEST['checkRating'])) {
	checkRating(@htmlspecialchars($_REQUEST['checkRating'], ENT_QUOTES, 'UTF-8'));
}
function checkRating($itemId){
	global $connn;
	$numberOfRate = $connn->query("SELECT * FROM item WHERE id = '$itemId'")->fetch_assoc()['rating'];

	if (isset($_SESSION['userId'])) {
		$user_id=@$_SESSION['userId'];
		if($connn->query("SELECT * FROM rating WHERE item_id = '$itemId' AND user_id='$user_id'")->num_rows>0){
			$style= "style='font-size:15pt;color:var(--color-like)!important;' title='click to unlike'";
		}
		else {
			$style= "style='font-size:15pt;color:transparent!important;-webkit-text-stroke: 1px var(--color-like);' title='like'";
		}
	}
	else {
		$style= "style='font-size:15pt;color:transparent!important;-webkit-text-stroke: 1px var(--color-like);' title='like'";
	}
	?>
	<form method="post" action="include.php" target="theIframe" enctype="multipart/form-data" style="display: none">
		<input type="submit" name="likeOnOff" value="<?php echo $itemId;?>" id="likeOnOff<?php echo $itemId;?>">
	</form>
	<a onclick="document.getElementById('likeOnOff<?php echo $itemId;?>').click()"><span class="fas fa-heart" <?php echo $style;?>></span>&nbsp;<?php echo $numberOfRate;?></a><?php
}
?>