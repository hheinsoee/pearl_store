<?php
function head(){
	$defaulttitle=siteInfo('name');
	$defaultDescription=siteInfo('welcome');
	$defaultKeywords='H thanlyin, သန်လျင်, shop, shopping,';
	$defaultOgImg='media/shopping.jpg';
	$defaultOrigynalLink=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];

	global $connn;
	if(isset($_GET['item'])){
		$id=htmlspecialchars($_GET['item'], ENT_QUOTES, 'UTF-8');
		$data=$connn->query("SELECT * FROM item WHERE id = '$id'")->fetch_assoc();
		$title='('.number_format(lowestPriceByItemId($id)).' ကျပ်) | '.$data['name'];
		$description=$data['description'];
		$keywords=$data['keywords'];
		$ogImg='media/item/'.$id.'/i_'.$id.'.jpg';
		$origynalLink='item='.@$data['id'];
	}
	elseif(isset($_GET['brand'])){
		$id=htmlspecialchars($_GET['brand'], ENT_QUOTES, 'UTF-8');
		$data=$connn->query("SELECT * FROM brand WHERE id = '$id'")->fetch_assoc();
		$title=$data['name'].' at '.siteInfo('name');
		$description=$data['name'].' ရဲ့ '.$data['title'].' '.siteInfo('name').' မှာရှိတယ်';
		$keywords=$data['keywords'];
		$ogImg='media/brand/brand_'.@$id.'.jpg';
		$origynalLink='brand='.@$data['id'];
	}
	elseif(isset($_GET['cat'])&&$_GET['cat']==2){
		$id=htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
		$data=$connn->query("SELECT * FROM cat_2 WHERE id = '$id'")->fetch_assoc();
		$title=siteInfo('name').' မှာ '.@$data['name'].' ရပြီနော်';
		$description=$data['description'];
		$keywords=$data['keywords'];
		$ogImg='media/cat/cat2_'.$id.'.jpg';
		$origynalLink='cat=2&id='.@$data['id'];
	}
	else{
		$title=$defaulttitle;
		$description=$defaultDescription;
		$keywords=$defaultKeywords;
		$ogImg=$defaultOgImg;
		$origynalLink=$defaultOrigynalLink;
	}

	?>
	<title><?php echo $title;?></title>
	<link rel="shortcut icon" type="image/x-icon" href="media/H.ico" />
	<link rel="stylesheet" type="text/css" href="style/main.css">
	<link rel="canonical" href="<?php echo $origynalLink;?>">

	<link type="text/plain" rel="author" href="humans.txt" />

	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=no" />

	<!-- <meta http-equiv="content-language" content="en-us" /> -->
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta charset="UTF-8">
	<meta content="utf-8" http-equiv="encoding">
	<meta name="theme-color" content="#000" />

	
	<meta name="description" content="<?php echo $description;?>">
	<meta name="keywords" content="<?php echo $keywords;?>" />
	<meta name="robots" content="index , follow ">
	<meta property="og:image" content="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?>/<?php echo $ogImg;?>">
	<meta property="og:image:type" content="image/jpg" />
	<meta property="og:image:width" content="400" />
	<meta property="og:image:height" content="300" />
	<meta property="og:description" content="<?php echo $description;?>">
	<meta property="og:title" content="<?php echo $title;?>">
	<meta property="og:url" content="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">
	<meta property="og:type" content="website">
	<meta property="fb:app_id" content="470431720486736" />


	<?php
	$path = glob("script/*.js");
	foreach($path as $files){
 		?><script type="text/javascript" src="script/<?php echo pathinfo($files, PATHINFO_BASENAME );?>?v=<?php echo filemtime('script/'.pathinfo($files, PATHINFO_BASENAME ));?>"></script><?php
	}
}
function developer($type){
	?>
	<div class="flex_ce ce">
		<a href="https://www.heinsoe.pro" target="_blank" class="flex ce" style="color:#999!important;font-size: 7.5pt;">
		developed & designed by&nbsp;www.heinsoe.com
		</a>
	</div>
	<?php
}

function userNav(){
	?><div class="flex_ar ce _p0510 gbg userNav"><?php 
	if (isset($_SESSION['userId'])) {?>
			<!-- <a onclick="showPopUpData('cart=mini')"><span class="fas fa-comment-alt">&nbsp;</span>Noti<dot2></dot2></a> -->
		<div class="dropDownMenu">
			<span class="fas fa-user">&nbsp;</span><?php echo fetchData('name','user','id',$_SESSION['userId']) ;?>&nbsp;<span class="fas fa-angle-down"></span>
			<div class="dropDownLayer">
				<a href="?user=shoppingHistory"><span class="fas fa-shopping-bag">&nbsp;</span>Shopping Record</a>
				<a onclick="showPopUpData('userInfoEditForm')"><i class="fas fa-user-cog">&nbsp;</i>Update User Infomation</a>
				<a onclick="showPopUpData('signForm=out')">
					<span class="fas fa-sign-out-alt">&nbsp;</span>Signout
				</a>
			</div>
		</div>

		<a onclick="showPopUpData('cart=mini')"><span class="fas fa-shopping-cart">&nbsp;</span>cart</a>

		<?php 
		if ( isAdmin() == true) {
			?><div onclick="window.open('?admin')"><span class="fas fa-briefcase">&nbsp;</span>Site Manager</div><?php
		}
	}
	else{
		?>
		<pre onclick="showPopUpData('signForm=in')" class=" p0010"><span class="fas fa-user"></span><span>&nbsp;Login</span></pre>
		<?php
	}
	?></div><?php
}
function mainNav($type){
	$logo="media/H_logo.png";
	?>
	<nav>
		<div id="nav" class="flex_be ce _ce _flex_be">
			<div class="p0010">
				<a href="/" class="flex_ce ce">
					<img id="logo" src="<?php echo $logo.'?v='.filemtime($logo);?>" style='max-width:10vw;object-fit:contain'>
					<div style="font-size: 18pt" class="p0010"><?php echo siteInfo('name');?></div>
					<div><?php echo siteInfo('title');?></div>
				</a>
			</div>
			<div>
				<div class="flex ce"><?php searchForm('nav');?></div>
				<div class="flex ce p1010 _p1010 _flex _ce">
					<!-- <div><ico class="fas fa-question"></ico><span class="scr4">&nbsp;help</span></div> -->
					<a class="scr4 scr3" href="https://www.facebook.com/HThanlyin" target="_blank"><ico class="fab fa-facebook"></ico></a>
					<a class="scr4 scr3" href="https://m.me/HThanlyin" target="_blank"><ico class="fab fa-facebook-messenger"></ico></a>
					<a href="tel:+95<?php echo siteInfo('phone');?>"><ico class="fas fa-phone"></ico></a>
				</div>

				<div class="mainMenu ">
					<?php userNav();?>
				</div>
			</div>
		</div>
		<div style="overflow-x: auto;background-color: var(--color-a1)">
		<?php 
		switch ($type) {
			case 'user':
				//userControlNav();
				break;
			default:
				categoryNav();
				break;
		}
		?>
		</div>
	</nav>
	<script type="text/javascript">
		if (window.innerWidth < 1500) {
			var prevScrollpos = window.pageYOffset;
			window.onscroll = function() {
			var currentScrollPos = window.pageYOffset;
			  if (prevScrollpos > currentScrollPos) {
			    document.documentElement.style.setProperty('--height-1', '50px');
			  } else {
			    document.documentElement.style.setProperty('--height-1', '30px');
			  }
			  prevScrollpos = currentScrollPos;
			}
		}
	</script>

	<?php
}

function userControlNav(){
	?>
	<div class="wbg flex ce _p0010 shadow_1" style="height: var(--height-2)">
		<div><a href="?user=shoppingHistory">Shopping Record</a></div>
		<div>YOOR FAV ITEMS</div>
	</div>
	<?php 
}
function categoryNav(){
	global $connn;
	$s_cat_1=$connn->query("SELECT * FROM cat_1 ORDER BY name ASC");
	?>
	<div class="categoryNav shadow_1 _p0010 flex">

	<?php while($cat_1=$s_cat_1->fetch_assoc()){
		?>
		<div class="mainCategory">
			<pre id="mainCategory" class="flex ce"><?php echo $cat_1['name']?></pre>
			<div class="categoryGroupContainer">
				<div class="flex wrap">
					<?php 
					$filter2=$cat_1['id'].'END';
					$s_cat_2=$connn->query("SELECT * FROM cat_2 WHERE cat_1_id LIKE '%$filter2%' ORDER BY name ASC");
					while($cat_2=$s_cat_2->fetch_assoc()){
						$photo="media/cat/cat2_".$cat_2['id'].".jpg";
						?>
						<div id="categoryGroup">
							<div><b><a href="?cat=2&id=<?php echo $cat_2['id'];?>"><?php echo $cat_2['name'];?></a></b></div>
							<div class="flex">
								<a href="?cat=2&id=<?php echo $cat_2['id'];?>">
									<img id="categoryGroupPhoto" src="<?php echo $photo.'?v='.filemtime($photo);?>">
								</a>
								<div class="_p0510">
								<?php 
									$filter3=$cat_2['id'].'END';
									$s_cat_3=$connn->query("SELECT * FROM cat_3 WHERE cat_2_id LIKE '%$filter3%' ORDER BY name ASC");
									while($cat_3=$s_cat_3->fetch_assoc()){
										?>
										<pre><a id="link" href="?cat=3&id=<?php echo $cat_3['id'];?>"><?php echo $cat_3['name'];?></a></pre>
								<?php } ?>
								</div>
							</div>
						</div>

					<?php } ?>

				</div>
			</div>
		</div>

	<?php } ?>

	</div>
	<?php
}


function searchForm($type){
	switch ($type) {
		case 'nav':
			?>
			<div class="searchFormContainer" id="nav_search_form">
				<div id="searchForm" class="searchForm">
					<form class="flex_be ce ">
						<input type="search" name="search" placeholder="ရှာကြည့်ပါ" onkeyup="showHint(this.value,'searchHintContainer')" value="<?php echo @htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8');?>" autocomplete="off" required="required">
						<button class="fas fa-search"></button>
						<span id="close" class="p1010 fas fa-times" title="close Search" onclick="document.getElementById('searchForm').className='searchForm'"></span>
					</form>
					<div style="position: absolute;background-color:var(--color-a)" >
						<div id="searchHintContainer">
						</div>
					</div>
				</div>
				<button class="fas fa-search" id="smallSearchButton" onclick="document.getElementById('searchForm').className='sSearchForm'"></button>
			</div>
			<?php
			break;
		case 'main':
			?>
			<div class="searchFormMain">
				<form class="flex_be ce">
					<input type="search" name="search" placeholder="ရှာကြည့်ပါ" onkeyup="showHint(this.value,'searchHintContainerMain')" value="<?php echo @htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8');?>" autocomplete="off" required="required">
					<button class="fas fa-search"></button>
				</form>
				<div style="position: absolute;">
					<div id="searchHintContainerMain" class="lbg r">
					</div>
				</div>
			</div>
			<?php
			break;
		default:

			break;
	}
}

function mainSlider(){
	?>
	<div class="flex_be mySlider">
		<?php departmentPart('slide');?>
		<!-- <div id="slide"  class="flex_ce ce gbg">
			<div>
				<large>UNIVERSITY NAME</large>
				<div>
					City<br>
					<i>since 1060</i>
				</div>
			</div>
		</div> -->

	</div>
	<script type="text/javascript">
		startSlide();
	</script>
	<?php
}

function footer(){
	$logo="media/H_logo.png";
	?>
	<div class="flex_ce ce ">
		<div>
			<center style="padding-top: 100px;" class="_p1010">
				<img src="<?php echo $logo.'?v='.filemtime($logo);?>" alt="H" title="H" height="100"><br>
				<large><?php echo siteInfo('name');?></large><br>
				<span><?php echo siteInfo('title');?></span>
				<div><div class="fb-like" data-href="https://www.facebook.com/pg/HThanlyin" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div></div>
				
				<div>copyright&copy;&nbsp;2019 - <?php echo date('Y');?>&nbsp;<?php echo $_SERVER['HTTP_HOST'];?></div>

				<?php developer('nostyle');?>
			</center>
			<div class="flex_ar wrap _p1010 _m1010">
				<div>
				</div>
			</div>
			<!-- <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FHThanlyin%2Fvideos%2F972607296405860%2F&show_text=0&width=560" width="100%" height="315" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe> -->
		</div>
	</div>
	<?php
}
?>