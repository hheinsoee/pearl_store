<?php
if (isset($_REQUEST['searchHint'])) {
	global $connn;
	$searchText = htmlspecialchars( $_GET['searchHint'], ENT_QUOTES, 'UTF-8');
	$s_brand=$connn->query("SELECT * FROM brand WHERE name LIKE '%$searchText%' OR keywords LIKE '%$searchText%' OR title LIKE '%$searchText%'");
	$s_cat_3=$connn->query("SELECT * FROM cat_3 WHERE name LIKE '%$searchText%' OR keywords LIKE '%$searchText%'");
	$s_item=$connn->query("SELECT * FROM item WHERE name LIKE '%$searchText%' OR description LIKE '%$searchText%' OR keywords LIKE '%$searchText%'");

	$total=  
		$s_brand->num_rows +
	 	$s_cat_3->num_rows +
	 	$s_item->num_rows 
	 	;
	?>
	<div class="p1010">
		<div><a href="?search=<?php echo $hint?>"><big>Total <?php echo $total;?></big></a></div>
		<div><a href="?search=<?php echo $hint?>#brand"><?php echo $s_brand->num_rows;?>&nbsp;Brand</a></div>
		<div><a href="?search=<?php echo $hint?>#cat"><?php echo $s_cat_3->num_rows;?>&nbsp;cattogory</a></div>
		<div><a href="?search=<?php echo $hint?>#item"><?php echo $s_item->num_rows;?>&nbsp;Items</a></div>
	</div>
	<?php
}
?>