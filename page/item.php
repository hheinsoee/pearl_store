<?php

if (isset($_GET['item'])) {
	$id=htmlspecialchars( $_GET['item'], ENT_QUOTES, 'UTF-8');
}
	global $connn;
	$s_item=$connn->query("SELECT * FROM item WHERE id = '$id'")->fetch_assoc();
	$cat_3=$s_item['cat_3'];
	$itemPhoto="media/item/".$id."/i_".$id.".jpg";
	?>
<div>

	<div class="itemShow">
		<div class=" sticky_2 " style="z-index: 4;">
			<div class="p0010 shadow_2 flex_be ce lbg" style="">

				<div id="name" style="font-size: 14pt;color:#069; font-weight: 800;"><?php echo $s_item['name'];?></div>
				<div id="favourite_status<?php echo $id;?>" style="width:80px;" class="right"><?php checkRating($id);?></div>
				
			</div>
			<div class="right"><span style="position: absolute;right:0"><?php fb_like_share('?item='.$id);?></span></div>
		</div>

		<div class="flex wrap">
			<div class="m0505 f1" id="photoPenel">
				<div class="wbg r sticky_3">
					<span style="position: absolute;">
						<?php checkBrandByBrandId($s_item['brand_id']);?>
					</span>	
					<div style="height:90px;margin:300px 0px 5px 0px;position: absolute;z-index: 1" class="p0010 allTextShadowL">
						<span id="item_size<?php echo $id;?>"></span><br>
						<span id="price" style="font-size: 23pt;"><span id="item_price<?php echo $id;?>"></span></span><br>
						<low id="item_id<?php echo $id;?>"></low>
					</div>
					<div id="viewer" style="overflow: hidden;position:absolute;z-index: -1;background-origin: content-box;background-repeat: no-repeat;filter: saturate(1.2)"></div>
					<img  oncontextmenu="return false"
					src="<?php echo $itemPhoto.'?v='.filemtime($itemPhoto);?>" class="stockPhoto" id="PhotoItemId<?php echo $s_item['id'];?>" style="width:100%;min-height:400px;height:100%;object-fit: contain;filter: saturate(1.2);margin-bottom: -10px;">
					<script type="text/javascript">
						ZoomInOut('PhotoItemId<?php echo $s_item['id'];?>',event,'viewer');
					</script>
				</div>
			</div>
			<div id="buyPenel">
				<div class=" sticky_3 stockToBuy _m0505">
				 	<center><?php echo fetchData('rows','stock','item_id',$id);?> မျိုးတွေ့ရှိပါတယ်</center>
					<?php stockByItem($s_item['id']) ;?>
				</div>
			</div>
			<div class="p1010 lbg r f1 m0505"  id="descriptionPenel">
				<p>
					<?php echo $s_item['description'];?>
				</p>
				<?php fb_comment('?item='.$id);?>
				<br><br><br>
			</div>
		</div>
	</div>

	<hr>
	
	<h1>Other</h1>
	<div>
		
		<div class="flex wrap _w42 _m0505 container" id="itemLoader"></div>
		<div id="contentEnd"></div>
	 	<script type="text/javascript">
			var flag = 0;
	 		var limit = 6;
	 		myLoadMore();
	 		window.onscroll=function(){
	 			myLoadMore();
	 		}
			function myLoadMore(){
			 	var theEnd = document.getElementById('contentEnd');
		 		if (theEnd.getBoundingClientRect().top < window.innerHeight) {
					insertContent('itemloader=&offSet='+flag+'&limit='+limit+'&cat_3=<?php echo $cat_3;?>','itemLoader','beforeend');
			 		flag += limit;
		 		}
		 		else{

		 		}
			}
	 	</script>
	</div>
</div>