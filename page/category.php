<?php if (isset($_GET['cat'])) {
	 $cat_lav=htmlspecialchars( $_GET['cat'], ENT_QUOTES, 'UTF-8');
	 $cat_id=htmlspecialchars( $_GET['id'], ENT_QUOTES, 'UTF-8');
	 global $connn;
	 
}
?>
<div>
<?php
if ($cat_lav==2) {
	$photo="media/cat/cat2_".$cat_id.".jpg";
	?>
	<div class="wbg">
		<div class="flex_ce wrap container _p1010">
			<img src="<?php echo $photo.'?v='.filemtime($photo);?>" style="height:120px;">
			<div class="f1">
				<large><?php echo fetchData('name','cat_2','id',$cat_id);?></large><br>
				<low><?php echo fetchData('description','cat_2','id',$cat_id);?></low>
				<br>
				<?php fb_share('?cat=2&id='.$cat_id);?>
			</div>	
		</div>
	</div>
	<?php
	$cat_2_id=$cat_id.'END';
	$search_cat_3=$connn->query("SELECT * FROM cat_3 WHERE cat_2_id LIKE '%$cat_2_id%' ORDER BY name ASC");
	while ($cat_3=$search_cat_3->fetch_assoc()) {
		$cat_3_id=$cat_3['id'].'END';
		?>
 		<div style="margin-bottom: 10vh;" class="container">
 			<a href="?cat=3&id=<?php echo $cat_3['id'];?>" class="flex ce p1010 sticky_2 allTextShadowL" title="<?php echo $cat_3['name'];?> အားကြည့်ရန်"><big><?php echo $cat_3['name'];?></big>&nbsp;<hr class="f1">&nbsp;<i><low><?php echo number_format(fetchData('rows','item','tag_cat_3',$cat_3_id));?>မျိုး</low></i></a>
 			<div class="flex wrap _w4">
 				<div class="flex _m0505">
 					<?php $firstItems=$connn->query("SELECT DISTINCT id FROM item WHERE tag_cat_3 LIKE '%$cat_3_id%' ORDER BY rating DESC LIMIT 2");
 					while ($data=$firstItems->fetch_assoc()){
 						item($data['id'],'thumbnail_m');
 					}
 					?>
 				</div>
 				<div class="f1">
		 			<div class="flex wrap _w4 _m0505"><?php
				 		$sarch_item=$connn->query("SELECT DISTINCT id FROM item WHERE tag_cat_3 LIKE '%$cat_3_id%' ORDER BY rating DESC LIMIT 6 OFFSET 2");
					 	while ($s_item=$sarch_item->fetch_assoc()){
					 		item($s_item['id'],'thumbnail_s');
					 	}
					 	?>
						 <a href="?cat=3&id=<?php echo $cat_3['id'];?>" class="m0505 flex_ce ce wbg shadow_1 r p1010"> 
						 	<center>
							 	<?php echo $cat_3['name'];?><br>
							 	<low><large><?php echo number_format(fetchData('rows','item','tag_cat_3',$cat_3_id));?>မျိုး</large></low>
							</center>
						 </a>
				 	</div>
				 </div>
			</div>
	 	</div><?php
 	}
 	?>
 	<div style="margin-bottom: 10vh;" class="p1010 ">
		<center><big>အမျိုးအစားများ</big></center>
		<div>
			<div class="flex _m0505 wrap _w42">
				<?php 	
				$sarch_cat3=$connn->query("SELECT DISTINCT * FROM cat_2");
			 	while ($cat_3=$sarch_cat3->fetch_assoc()){
			 		$thePhoto="media/cat/cat2_".$cat_3['id'].".jpg";
			 		?>
			 		<a class="wbg p1010" style="text-align: center;" href="?cat=2&id=<?php echo $cat_3['id'];?>">
			 			<div>
				 			<img src="<?php echo $thePhoto.'?v='.filemtime($thePhoto);?>"
				 			style="height:120px;max-width:120px;min-width: 120px;width:100%;object-fit: contain;object-position: 50% 100%;">
				 		</div>
			 			<big><?php echo $cat_3['name'];?></big>
			 		</a>
			 		<?php
			 	}	
			 	;?>
		 	</div>
		</div>
	</div>
 	<?php
 }
 elseif ($cat_lav==3) {
 	?>
 	<center class="lbg p0010 sticky_2 shadow_2"><big><?php echo fetchData('name','cat_3','id',$cat_id);?></big></center>
 	<div class="flex wrap _w42 _m0505 container" id="itemLoader">
 		
 		
 	</div>
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
	 		if (theEnd.getBoundingClientRect().top < window.innerHeight + 100) {
				insertContent('itemloader=&offSet='+flag+'&limit='+limit+'&cat3Id=<?php echo $cat_id;?>','itemLoader','beforeend');
		 		flag += limit;
	 		}
	 		else{

	 		}
		}
 	</script>
 	<?php
 }
?>
</div>