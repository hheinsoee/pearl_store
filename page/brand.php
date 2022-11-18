<?php
if (isset($_GET['brand'])) {
	$id=htmlspecialchars( $_GET['brand'], ENT_QUOTES, 'UTF-8');
}
global $connn;
$brand=$connn->query("SELECT * FROM brand WHERE id = '$id'")->fetch_assoc();
$bLogo="media/brand/brand_".$id.".jpg";
?>
<div>
	<div class="flex wrap _w3">
		<div style="width: 300px; min-height: calc(100vh - var(--height-1) - var(--height-2));background-image:url('media/brand/brand_bg_<?php echo $id;?>.jpg');background-size:cover; background-attachment: fixed;">
			<div class="lbg sticky_2 flex_ce ce" style="min-height: calc(100vh - var(--height-1) - var(--height-2))">
				<center>
					<div><img src="<?php echo $bLogo.'?v='.filemtime($bLogo);?>" style="max-width:180px;height:200px;object-fit: contain;"/></div>
					<div style="font-size: 22pt;font-weight: 900"><?php echo $brand['name'];?></div>
					<div style="font-size: 12pt;"><?php echo $brand['title'];?></div>
					<?php fb_like_share('?brand='.$id);?>
				</center>
			</div>
		</div>
		<div class="f1">
			<div class="wbg p1010 sticky_2">
				<div class="flex ce">
					<img src="<?php echo $bLogo.'?v='.filemtime($bLogo);?>" style="height:30px;object-fit: contain;"/><?php echo $brand['name'];?> တံဆိပ် ပစ္စည်းများ 	
				</div>
			</div>
			
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
					insertContent('itemloader=&offSet='+flag+'&limit='+limit+'&brandId=<?php echo $id;?>','itemLoader','beforeend');
			 		flag += limit;
		 		}
		 		else{

		 		}
			}
	 	</script>
		</div>
	</div>
</div>