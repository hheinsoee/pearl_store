<?php 
function checkBrandByBrandId($brandId){
	global $connn;
	$check_brand=$connn->query("SELECT * FROM brand WHERE id = $brandId");
	if ($check_brand->num_rows>0) {
		$data=$check_brand->fetch_assoc();
		$brandPhoto="media/brand/brand_".$brandId.".jpg";
		?>

		<a href="?brand=<?php echo $brandId;?>" style="position: relative;z-index:4;" class="allTextShadowL p1010 flex ce" title="<?php echo $data['name'];?> တံဆိပ် ပစ္စည်းများအား ကြည့်မည်" id="brandTag">
		<img style="height:60px;max-width: 80px;object-fit: contain;filter:Chroma(Color = #FFFFFF)" src="<?php echo $brandPhoto.'?v='.filemtime($brandPhoto);?>">
		<?php echo $data['name'];?>
		</a>

		<?php 
	}
	else{

	}
}

function brandThumbnail($id){
	global $connn;
	if ($id=='') {
	$check_brand=$connn->query("SELECT * FROM brand");
		while ($data=$check_brand->fetch_assoc()) {
			brandThumbnail($data['id']);
		}
	}
	else{
		$data=$connn->query("SELECT * FROM brand WHERE id={$id}")->fetch_assoc();
		$brandPhoto="media/brand/brand_".$id.".jpg";
		?>
		<div class="wbg">
			<center>
				<div>
					<img id="brandLogo" src="<?php echo $brandPhoto.'?v='.filemtime($brandPhoto);?>" 
					style="width: 140px;height: 100px;margin-bottom: -10px;object-fit: contain;object-position: 50% 50%;padding: 20px;">
				</div>
				<div class="p1010">
					<big><b><?php echo $data['name'];?></b></big><br>
					<?php echo $data['title'];?>
				</div>
			</center>
			<div class="flex_ce ce hover" style="height:200px;margin-top:-200px;position: relative;">
				<a class="dbg r p1010" href="?brand=<?php echo $data['id'];?>" title="<?php echo $data['name'];?> အမှတ်တံဆိပ်ပစ္စည်း အား ကြည့်ရန်"><?php echo $data['name'];?><br>ပစ္စည်း အား ကြည့်ရန်</a>
			</div>
		</div>
		<?php
	}
}
?>