<?php
function option($value,$name,$form,$filter,$by){
	global $connn;
	if($filter==''){
		$filterMaker='';
	}
	else{
		$filterMaker='WHERE '.$filter.' = '.$by;
	}
	$search=$connn->query("SELECT * FROM $form");
	while ($data=$search->fetch_assoc()) {
		?>
		<option value="<?php echo $data['id'];?>"><?php echo $data[$name];?></option>
		<?php
	}
}
function checkBox($inputName,$value,$name,$form, $filter,$by , $checkFrom,$checkID,$checkWhere){
	global $connn;
	if($filter==''){
		$filterMaker='';
	}
	else{
		$filterMaker='WHERE '.$filter.' = '.$by;
	}
	$search=$connn->query("SELECT * FROM $form");

	while ($data=$search->fetch_assoc()) {
		if ($checkFrom!='') {
			$get_data=$connn->query("SELECT * FROM $checkFrom WHERE id={$checkID} $checkWhere LIKE '%{$data['id']}%'");
		}
		?>
		<label class="flex ce"><input type="checkbox" name="<?php echo $inputName;?>[]" value="<?php echo $data[$value];?>"><?php echo $data[$name];?></label>
		<?php
	}
	
}

function siteInfo($what){
	global $connn;
	return $connn->query("SELECT * FROM site_info WHERE target = '$what'")->fetch_assoc()['data'];
}
function textCut($n,$text){
	if (strlen($text)>$n) {
		return substr($text,0,$n).'..';
	}
	else{
		return $text;
	}
}

function fetchData($myselect,$myfrom,$mywhere,$target=0){
	global $connn;
	$get_data=$connn->query("SELECT * FROM $myfrom WHERE $mywhere LIKE '%$target%'");
	switch ($myselect) {
		case 'rows':
			return $get_data->num_rows;
			break;
		
		default:
			if ($get_data->num_rows > 0) {
				$show_data=$get_data->fetch_assoc();
				$result=$show_data[$myselect];
				return $result;
			}
			else{
				
			}
			break;
	}
	  
}


function lowestPriceByItemId($itemId){
	global $connn;
	return $connn->query("SELECT * FROM stock WHERE item_id = '$itemId' ORDER BY new_price ASC LIMIT 1")->fetch_assoc()['new_price'];
}
function highestPriceByItemId($itemId){
	global $connn;
	return $connn->query("SELECT * FROM stock WHERE item_id = '$itemId' ORDER BY new_price DESC LIMIT 1")->fetch_assoc()['new_price'];
}
function priceByStockId($stockId){
	global $connn;
	$price= $connn->query("SELECT * FROM stock WHERE id = '$stockId'")->fetch_assoc();
	if ($price['old_price']>$price['new_price']) {
		?>
		<small><s><?php echo number_format($price['old_price']);?> ကျပ်</s></small><br>
		<span id="price"><?php echo number_format($price['new_price']);?> ကျပ်</span>
		<?php
	}
	else{
		?><span id="price"><?php echo number_format($price['new_price']);?> ကျပ်</span><?php
	}
}

function mostItemBy($what,$limit){

}

?>