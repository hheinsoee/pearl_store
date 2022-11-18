<?php
if (isset($_GET['itemloader'])) {
	$limit=htmlspecialchars(@$_REQUEST['limit'],ENT_QUOTES, 'UTF-8');
	$offSet=htmlspecialchars(@$_REQUEST['offSet'],ENT_QUOTES, 'UTF-8');

	$tag_cat_3=htmlspecialchars(@$_REQUEST['cat3Id'],ENT_QUOTES, 'UTF-8').'END';//tag
	$cat_3=htmlspecialchars(@$_REQUEST['cat_3'],ENT_QUOTES, 'UTF-8');
	$brand_id=htmlspecialchars(@$_REQUEST['brandId'],ENT_QUOTES, 'UTF-8');

 	$sarch_item=$connn->query("SELECT DISTINCT id FROM item WHERE cat_3 = '$cat_3' OR tag_cat_3 LIKE '%$tag_cat_3%' AND status = 1 AND brand_id LIKE '%$brand_id%' LIMIT {$limit} OFFSET {$offSet}");
 	while ($s_item=$sarch_item->fetch_assoc()){
 		item($s_item['id'],'thumbnail_m');
 	}
}

if (isset($_REQUEST['itemManagerTable'])) {
	itemManagerTable(htmlspecialchars($_REQUEST['itemManagerTable'],ENT_QUOTES, 'UTF-8'));
}
function itemManagerTable($search){
	global $connn;
	if (strlen($search)>2) {
		$searchItem=$connn->query("
			SELECT * FROM item 
			WHERE id = '$search' OR name LIKE '%$search%' OR keywords LIKE '%$search%'
			ORDER BY id DESC");
		if($searchItem->num_rows>0){
			while ($item = $searchItem->fetch_assoc()) {
				$item_id=$item['id'];
				?>
				<div id="itemInManagerTable<?php echo $item_id?>">
					<?php itemInManagerTable($item_id);?>
				</div>
				<div class="hide" id="stockManagerBtItem<?php echo $item['id'];?>">
					<div class="_p0010 stockManagerTable dbg" style="margin: 0px 30px 30px 30px;">
						<?php
						$searchStock=$connn->query("SELECT * FROM stock WHERE item_id ='$item_id' ORDER BY id DESC");
						if ($searchStock->num_rows>0) {
							?>
							<div class="flex ce sticky_3 gbg shadow_1">
								<div class="flex ce">
									<div id="id">အမှတ်</div>
									<div id="size">အမျိုးစား</div>
									<div id="ori_price">အရင်းဈေး</div>
									<div id="old_price">ယခင်ဈေး</div>
									<div id="new_price">ယခုဈေး</div>
								</div>
								<button onclick="showPopUpData('adminForm=addStock&id=<?php echo $item_id;?>')"><span class="fas fa-plus">&nbsp;</span>stock သစ်ထည့်ရန်</button>
							</div>
							<?php
							while ($stock=$searchStock->fetch_assoc()) {
								$stockPhoto="media/item/".$stock['item_id']."/i".$stock['item_id']."_s".$stock['id'].".jpg"
								?>
								<form class="flex ce" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
									<div id="id">#<?php echo $stock['id'];?></div>
									<input type="hidden" name="adminForm" value="editStock">
									<input type="hidden" name="stockId" value="<?php echo $stock['id'];?>">
									<input type="hidden" name="itemId" value="<?php echo $stock['item_id'];?>">
									<center><img src="<?php echo $stockPhoto.'?v='.filemtime($stockPhoto);?>" onclick="document.getElementById('addPhoto<?php echo $stock['id'];?>').click()"  id="addPhotoViewer<?php echo $stock['id'];?>" style="width:70px;height:70px;object-fit: contain;"></center>
									<input type="file" name="thePhoto" style="display: none;" id="addPhoto<?php echo $stock['id'];?>" onchange="displaySelectedImage(this,'addPhotoViewer<?php echo $stock['id'];?>')" accept="image/jpeg">
									<input id="size" name="stockSize" value="<?php echo $stock['size'];?>">
									<input id="ori_price" name="stockOriPrice" value="<?php echo $stock['original_price'];?>">
									<input id="old_price" name="stockOldPrice" value="<?php echo $stock['old_price'];?>">
									<input id="new_price" name="stockNewPrice" value="<?php echo $stock['new_price'];?>">
									<button>Save</button>
								</form>
								<?php
							}
						}
						else{
							?><div><?php echo $item['name']." တွင် မည်သည့် ပစ္စည်းမှမရှိပါ တာဝန်ရှိသူအား အကြောင်းကြားပါ";?><button onclick="showPopUpData('adminForm=addStock&id=<?php echo $item_id;?>')"><span class="fas fa-plus">&nbsp;</span>stock သစ်ထည့်ရန်</button></div><?php
						}
						?>
					</div>
				</div>
				<?php
			}
		}
		else{
			?><div class="p1010 wbg"><b>"<?php echo $search;?>"</b> နှင့် ကိုက်ညီသော မည်သည့်ပစ္စည်းမှမေတွ့ရှိပါ</div><?php
		}
	}

}
if (isset($_REQUEST['itemInManagerTable'])) {
	itemInManagerTable(htmlspecialchars($_REQUEST['itemInManagerTable'],ENT_QUOTES, 'UTF-8'));
}
function itemInManagerTable($id){
	global $connn;
	$item=$connn->query("SELECT * FROM item WHERE id = '$id' ORDER BY id DESC")->fetch_assoc();
	?>
	<div class="shadow_1 sticky_2 flex ce _p1010 wbg">
		<div id="id">#<?php echo $item['id'];?></div>
		<div id="name"><?php echo $item['name'];?></div>
		<div id="brand"><?php echo fetchData('name','brand','id',$item['brand_id']);?></div>
		<div id="rating"><?php echo $item['rating'];?></div>
		<div id="rating"><?php echo fetchData('rows','stock','item_id',$item['id']);?> မျိုး</div>
		<div id="action" class="flex ce _m1010">
			<a onclick="showPopUpData('adminForm=editItem&id=<?php echo $item['id'];?>')" class="fas fa-pencil-alt">Edit&nbsp;Item</a>
			<a class="flex ce" onclick="showHide('','stockManagerBtItem<?php echo $item['id'];?>')">Manage&nbsp;Stock&nbsp;<span class="fas fa-angle-down"></span></a>
		</div>
	</div>
	<?php
}




if (isset($_GET['itemId'])) {
	item(htmlspecialchars( $_GET['itemId'], ENT_QUOTES, 'UTF-8'),htmlspecialchars( $_GET['size'], ENT_QUOTES, 'UTF-8'));
}
function item($id,$type){
	global $connn;
	$s_item=$connn->query("SELECT * FROM item WHERE id = '$id'")->fetch_assoc();
switch ($type) {
	case 'thumbnail_s':
		$photo="media/item/".$id."/i_".$id."_s.jpg";
		?>
		<div class="itemThumbnailSmall flex_be ce">
			<div class="flex f1"onclick="showPopUpData('itemId=<?php echo $s_item['id'];?>&size=medium')" title="ကြည့်ရှုရန် နိပ်ပါ" style="cursor: pointer;">
				<img src="<?php echo $photo.'?v='.filemtime($photo);?>" id="photo">
				<div class="p1010">
					<div id="name"><?php echo $s_item['name'];?></div>
					<div id="price"> <?php echo number_format(lowestPriceByItemId($id));?>&nbsp;<small>ကျပ် မှစ၍</small></div>
				</div>
			</div>
			<div class="p1010"><div id="favourite_status<?php echo $id;?>" style="width:40px;" class="right"><?php checkRating($id);?></div></div>
		</div>
		<?php
		break;
	case 'thumbnail_m':
		$photo="media/item/".$id."/i_".$id."_s.jpg";
		?>
		<div class="itemThumbnailMedium">
			<div style="margin-bottom: -200px;height:200px;" id="actionPenel" >
				<div style="position:relative;z-index: 2;height: 100%;" class="flex_ce ce">
					<div class="flex ce dbg p1010 r" style="font-size: 18px;cursor: pointer;" onclick="showPopUpData('itemId=<?php echo $s_item['id'];?>&size=medium')" title="view">
						<span class="fas fa-eye alltextStoke" style="color:transparent;font"></span>&nbsp;view
					</div>
				</div>
			</div>
			<div>
				<img src="<?php echo $photo.'?v='.filemtime($photo);?>" id="photo">
			</div>
			<div class="wbg p1010" style="position: relative;">
				<div class=" allTextShadowL" id="name"><?php echo $s_item['name'];?></div>
				<div class="flex_be ce">
					<div id="price"> <?php echo number_format(lowestPriceByItemId($id));?>&nbsp;<small>ကျပ်</small></div>
					<div id="favourite_status<?php echo $id;?>" style="width:80px;" class="right"><?php checkRating($id);?></div>
				</div>
			</div>

		</div>
		<?php
		break;
	default:
		$photo = "media/item/".$id."/i_".$id.".jpg";
		?>	
		<div style="background-color:rgba(0,0,0,0.4);border-radius: 10px;" class="bg_blr">
			<center class="allTextShadowL" style="position: sticky;top:0;z-index: 99;"><big><?php echo $s_item['name'];?></big></center>
			<div class="itemThumbnailLarge">
				<div style="position: sticky;top:0;">
					<div id="photoPenel" class="wbg r" style="position: sticky;top:0;">
						<div>
							<div id="viewer" style="overflow: hidden;position:absolute;z-index: -1;background-origin: content-box;background-repeat: no-repeat;filter: saturate(1.2)"></div>

							<span style="position: absolute;"><?php checkBrandByBrandId($s_item['brand_id']);?></span>

							<div style="height:90px;margin:250px 0px 5px 0px;position: absolute;" class="p0010 allTextShadowL">
								<span id="item_size<?php echo $id;?>"></span><br>
								<span id="price"><span id="item_price<?php echo $id;?>"></span></span><br>
								<low id="item_id<?php echo $id;?>"></low>
							</div>

							<div class="flex_ce ce">
								<img onload="ZoomInOut('PhotoItemId<?php echo $s_item['id'];?>',event,'viewer')" src="<?php echo $photo.'?v='.filemtime($photo);?>" class="stockPhoto" id="PhotoItemId<?php echo $s_item['id'];?>">
							</div>
						</div>
						<div class=" p1010 r shadow_2" style="position:relative;margin-top: -50px;">
							<div class="flex_be ce">
								<div></div>
								<div class="flex ce">
									<button><a class="f1" href="?item=<?php echo $id;?>"><?php echo $s_item['name'];?> စာမျက်နာသို့သွားရန်</a></button>
									<div id="favourite_status<?php echo $id;?>" style="width:40px;" class="right"><?php checkRating($id);?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="stockToBuy _m0505">
					<?php stockByItem($s_item['id']) ;?>
					<div class="lbg m0505 p1010 r">
						<?php echo $s_item['description'];?> 
					</div>
					<br>
					<br>
					<br>
					<br>
					<br>
				</div>
			</div>
		</div>
		<?php
		break;
}
}
?>