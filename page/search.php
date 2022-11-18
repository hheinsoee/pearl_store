<?php
$searchText =htmlspecialchars( $_GET['search'], ENT_QUOTES, 'UTF-8');
$s_brand=$connn->query("SELECT * FROM brand WHERE name LIKE '%$searchText%' OR keywords LIKE '%$searchText%' OR title LIKE '%$searchText%'");
$cat_2=$connn->query("SELECT * FROM cat_2 WHERE name LIKE '$searchText' OR keywords LIKE '%$searchText%'");
$cat_3=$connn->query("
	SELECT * 
	FROM cat_3  
	WHERE cat_3.name 
	LIKE '%$searchText%' 
	OR cat_3.keywords 
	LIKE '%$searchText%'");
$s_item=$connn->query("SELECT * FROM item WHERE name LIKE '%$searchText%' OR description LIKE '%$searchText%' OR keywords LIKE '%$searchText%'");

$total=  
	$s_brand->num_rows +
 	$s_item->num_rows 
 	;
?>

<div>
	<div style="max-width: 1000px ;margin:auto;">
		<center><large>"<?php echo $searchText;?>" ဖြင့်ရှာဖွေမှု</large></center>
		<center><?php echo $total;?> ခု တွေ့ရှိပါသည်။</center>
		<br>
		<?php if ($s_brand->num_rows>0) {
			?>
			<div>
				အမှတ်တံဆိပ်&nbsp;<?php echo $s_brand->num_rows;?>&nbsp;ခုတွေ့ရှိပါသည်
				<div class="scrollX dragscroll">
					<div id="scrollXContainer">
						<?php while ($da=$s_brand->fetch_assoc()) {
							brandThumbnail($da['id']);
						}?>
					</div>
				</div>
			</div>
			<?php
		} 
		
		if ($cat_3->num_rows>0) {
			?>
			<div>
				အမျိုးအုပ်စု&nbsp;<?php echo $cat_3->num_rows;?>&nbsp;ခုတွေ့ရှိပါသည်
				<div>
					<div class="flex wrap">
						<?php 
						while ($da=$cat_3->fetch_assoc()) {
							?><a href="?cat=3&id=<?php echo $da['id'];?>" class="p1010 wbg r m0505 shadow_1">
								<?php echo $da['name'];?>
								<?php echo fetchData('rows','item','tag_cat_3',$da['id']);?> မျိုး 
							</a>
							<?php
						}?>
						<div class="f1"></div>
					</div>
				</div>
			</div>
			<?php
		} 

		if ($s_item->num_rows>0) {
			?>
			<div>
				ပစ္စည်း&nbsp;<?php echo $s_item->num_rows;?>&nbsp;ခုတွေ့ရှိပါသည်
				<div class="flex wrap _m0505">
					<?php while ($da=$s_item->fetch_assoc()) {
						item($da['id'],'thumbnail_m');
					}?>
				</div>
			</div>
			<?php
		}
		?>
		
		
	</div>
</div>