<div id="head_board" style="position: fixed;top:0;right:0;bottom:0;left: 0;z-index: -1;">
	<img src="media/shopping.jpg?v=<?php echo filemtime('media/shopping.jpg');?>" style="width:110%;height:110%;object-fit: cover;object-position: 50%;position: absolute;z-index: -1;filter: blur(5px);">
	<!-- <video autoplay muted loop id="myVideo" style="position: fixed;
  min-width: 100vw;height:100vh;object-fit:cover;object-position: 50% 50%;z-index: -1;filter: blur(8px)">
	  <source src="media/city.mp4" type="video/mp4">
	  Your browser does not support HTML5 video.
	</video> -->
	<div  style="background:linear-gradient(rgba(0,0,0,1), rgba(0,0,0,0.5), rgba(0,0,0,0.8));height:100vh;">
	</div>
</div>
<script type="text/javascript">
	
window.onscroll = function() {
  if (document.body.scrollTop>document.documentElement.scrollTop) {
    var myScrollTop=document.body.scrollTop;
  }
  else{
    var myScrollTop=document.documentElement.scrollTop;
  }
  var opacityForHead=1.2-(myScrollTop/(window.innerHeight-window.innerHeight*0.6));
  document.getElementById("head_board").style.opacity =opacityForHead;
   
};
</script>


<div style="min-height: 500px;height:calc(100vh - var(--height-1) - var(--height-2));" id="start">
	<div style="padding:10vh 10vw;">
		<div style="color:#fff;">
			<span style="font-size:10vmin;font-weight:900;"><?php echo siteInfo('name');?></span>
			<large><?php echo siteInfo('title');?></large>
		</div>
		<div style="color:#fff">
			<span><?php echo siteInfo('welcome');?></span><br>
			<span class="fas fa-dollar-sign">&nbsp</span> မှန်ကန်သော ဈေးနှုန်း <br>
			<span class="fas fa-truck">&nbsp</span> မြန်ဆန်သော ပို့ဆောင်မှု ဖြင့်<br>
			တစ်နေရာတည်း မှာ ကြိုက်တာရှာ ယူ အိမ်ရောက်ပို့ပေးမည်<br>
		</div>
		<br>
		<?php searchForm('main');?>

	</div>

	<div style="
	height:150px;
	margin-top:50px;
	position: absolute;
	right: 0;left: 0;">
		<center  onclick="myScroll('',1,'')"
		style="
  -webkit-animation: mymove 1s infinite; /* Safari 4.0 - 8.0 */
  -webkit-animation-timing-function: linear; /* Safari 4.0 - 8.0 */
  animation: mymove 1s infinite;
  animation-timing-function: linear;">
			<div style="color:#fff">Go</div>
			<div style="width:0px;border-top:20px solid rgba(255,255,255,0.8);border-right:20px solid transparent;border-left:20px solid transparent;
			"></div>
		</center>
	</div>
</div>


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

<div style="margin-bottom: 10vh;">
	<div>
		<center><big>အမှတ်တံဆိပ်များ</big></center>
		<div class="scrollX dragscroll">
			<div id="scrollXContainer">
				<?php brandThumbnail('');?>
			</div>
		</div>
	</div>
</div>


<div>
	<div class="flex wrap _w4 _p1010"  style="margin-bottom: 20vh;">
		<div>
			<div class="sticky_2">
				<big class="p0010">အကြံပြုထားသောအရာများ</big>
				<div class="_m0505">
					<?php 	
					$sarch_item=$connn->query("SELECT DISTINCT id FROM item WHERE tag_cat_3 LIKE '%%' AND status = 1 ORDER BY rating DESC LIMIT 8 ");
				 	while ($s_item=$sarch_item->fetch_assoc()){
				 		item($s_item['id'],'thumbnail_s');
				 	}	
				 	;?>
				 </div>
		 	</div>
		</div>
		<div style="max-width: 1000px;margin:auto;" class="f1">
			<big class="p1010">နောက်ဆုံးတင်သော ပစ္စည်းများ</big>
		 	<div class="flex _m0505 wrap container">
				<?php 	
				$sarch_item=$connn->query("SELECT DISTINCT id FROM item WHERE tag_cat_3 LIKE '%%' AND status = 1 ORDER BY id DESC LIMIT 10");
			 	while ($s_item=$sarch_item->fetch_assoc()){
			 		item($s_item['id'],'thumbnail_m');
			 	}	
			 	;?>
		 	</div>

		</div>
	</div>
</div>



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

