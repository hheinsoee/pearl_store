<?php
if (isset($_REQUEST['adminForm'])) {
	adminForm(htmlspecialchars($_REQUEST['adminForm'],ENT_QUOTES, 'UTF-8'));
}
function adminForm($what){
	if(fetchData('level','user','id',$_SESSION['userId'])==3) {//is admin
	$id=@htmlspecialchars($_REQUEST['id'],ENT_QUOTES, 'UTF-8');
	global $connn;
	switch ($what) {
		case 'addItem':
			?>
			<form class="p1010 wbg" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<center><big>ပစ္စည်းသစ် ထည့်ရန်</big></center>
				<input type="hidden" name="adminForm" value="addItem">
				<div class="flex_be wrap _f1 _p1010">
					<div class="flex_ce ce">
						<img src="media/addPhoto.png" onclick="document.getElementById('addPhoto').click()"  id="addPhotoViewer" style="width:200px;height:200px;object-fit: contain;">
						<input type="file" name="thePhoto" style="display: none;" id="addPhoto" onchange="displaySelectedImage(this,'addPhotoViewer')" accept="image/jpeg">
					</div>
					<div>
						<label>ပစ္စည်း အမည်<input type="" name="theName" value="" placeholder="ပစ္စည်း အမည်" autocomplete="off" ></label>
						<label>အဓိက အုပ်စု
							<select name="main_cat3">
								<?php option('id','name','cat_3','','');?>
							</select>
						</label>	
					</div>
					<div>					
						<label>Select Brand
							<select name="brandId" required>
								<option value="1111111">None</option>
								<?php option('id','name','brand','','') ;?>
							</select>
						</label>
						<label>ပစ္စည်းအကြောင်း<textarea style="min-height: 100px;" name="description" placeholder="ပစ္စည်းအကြောင်း"></textarea></label>
					</div>
				</div>
				<div class="flex wrap _p1010">
					<?php
					$search2=$connn->query("SELECT * FROM cat_2 ORDER BY name ASC");
					while ($dataCat2=$search2->fetch_assoc()) {
						?><div><?php
						echo $dataCat2['name'];
						$search3=$connn->query("SELECT * FROM cat_3 WHERE cat_2_id LIKE '%{$dataCat2['id']}%'");
						while ($dataCat3=$search3->fetch_assoc()) {
							?>
							<label class="flex ce"><input type="checkbox" name="cat_3[]" value="<?php echo $dataCat3['id'];?>" ><?php echo $dataCat3['name'];?></label>
							<?php
						}
						?></div><?php
					}
					?>
				</div>
				<div>
					<label>ရှာနိုင်မည့်စာလုံး<textarea name="keywords" placeholder="ပစ္စည်းရှာနိုင်မည့်စာလုံး"></textarea></label>
				</div>

				<div class="flex _f1"><button class="fas fa-check">&nbsp; add</button></div>
			</form>
			<?php
			break;
		case 'editItem':
			$item=$connn->query("SELECT * FROM item WHERE id = '$id'")->fetch_assoc();
			$photoPath="media/item/".$id."/i_".$id."_s.jpg";
			?>
			<form class="p1010 wbg" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<center><big>ပစ္စည်းအကြောင်းအရာများ ပြင်ရန်</big></center>
				<input type="hidden" name="adminForm" value="editItem">
				<input type="hidden" name="itemId" value="<?php echo $id?>">
				<div class="flex_be wrap _f1 _p1010">
					<div class="flex_ce ce">
						<img src="<?php echo $photoPath."?v=".fileatime($photoPath);?>" onclick="document.getElementById('addPhoto').click()"  id="addPhotoViewer" style="width:200px;height:200px;object-fit: contain;">
						<input type="file" name="thePhoto" style="display: none;" id="addPhoto" onchange="displaySelectedImage(this,'addPhotoViewer')" accept="image/jpeg">
					</div>
					<div>
						<select name="status">
							<option value="1" selected="selected">Show</option>
							<option value="0">Hide</option>
						</select>
						<label>ပစ္စည်း အမည်<input type="" name="theName" value="<?php echo $item['name'];?>" placeholder="ပစ္စည်း အမည်" autocomplete="off" ></label>		
						<label>အဓိက အုပ်စု
							<select name="main_cat3">
								<option selected value="<?php echo $item['cat_3'];?>"><?php echo fetchData('name','cat_3','id',$item['cat_3']);?></option>
								<?php option('id','name','cat_3','','');?>
							</select>
						</label>
					</div>
					<div>				
						<label>Select Brand
							<select name="brandId" required>
								<option selected value="<?php echo $item['brand_id'];?>"><?php echo fetchData('name','brand','id',$item['brand_id']);?></option>
								<option value="1111111">None</option>
								<?php option('id','name','brand','','') ;?>
							</select>
						</label>
						<label>ပစ္စည်းအကြောင်း<textarea style="min-height: 100px;" name="description" placeholder="ပစ္စည်းအကြောင်း"><?php echo $item['description'];?></textarea></label>
					</div>
				</div>
				tag
				<div class="flex wrap _p1010">
					<?php
					$search2=$connn->query("SELECT * FROM cat_2 ORDER BY name ASC");
					while ($dataCat2=$search2->fetch_assoc()) {
						?><div><?php
						echo $dataCat2['name'];
						$search3=$connn->query("SELECT * FROM cat_3 WHERE cat_2_id LIKE '%{$dataCat2['id']}%'");
						while ($dataCat3=$search3->fetch_assoc()) {
							if (strpos($item['tag_cat_3'],$dataCat3['id']) !== false){
		    					$check='checked';
							}
							else{$check='';}
							?>
							<label class="flex ce"><input type="checkbox" name="cat_3[]" value="<?php echo $dataCat3['id'];?>" <?php echo $check;?> ><?php echo $dataCat3['name'];?></label>
							<?php
						}
						?></div><?php
					}
					?>
				</div>
				<div>
					<label>ရှာနိုင်မည့်စာလုံး<textarea name="keywords" placeholder="ပစ္စည်းရှာနိုင်မည့်စာလုံး"><?php echo $item['keywords'];?></textarea></label>
				</div>
				<div class="flex _f1"><button class="fas fa-check">&nbsp; ပြင်ဆင်ပြီး</button></div>
			</form>
			<?php
			break;
		case 'addStock':
			?>
			<form class="p1010 wbg" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<input type="hidden" name="adminForm" value="addStock">
				<input type="hidden" name="itemId" value="<?php echo $id;?>">
				<center><img src="media/addPhoto.png" onclick="document.getElementById('addPhoto').click()"  id="addPhotoViewer" style="width:160px;height:160px;object-fit: contain;"></center>
				<input type="file" name="thePhoto" style="display: none;" id="addPhoto" onchange="displaySelectedImage(this,'addPhotoViewer')" accept="image/jpeg">
				<label>အမျိုးစား<input type="" name="stockSize" value="" placeholder="Stock အမျိုးစား"></label>
				<label>အရင်းဈေး<input type="" name="stockOriPrice" value="" placeholder="Stock အရင်းဈေး"></label>
				<label>ယခင်ဈေး<input type="" name="stockOldPrice" value="" placeholder="Stock ယခင်ဈေး"></label>
				<label>ယခုဈေး<input type="" name="stockNewPrice" value="" placeholder="Stock ယခုဈေး"></label>
				<button>Add</button>
			</form>
			<?php
			break;
		case 'addBrand':
			?>
			<form class="p1010 wbg" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<center><big>တံဆိပ်သစ်ထည့်ရန်</big></center>
				<input type="hidden" name="adminForm" value="addBrand">
				<center><img src="media/addPhoto.png" onclick="document.getElementById('addPhoto').click()"  id="addPhotoViewer" style="width:160px;height:160px;object-fit: contain;"></center>
				<input type="file" name="thePhoto" style="display: none;" id="addPhoto" onchange="displaySelectedImage(this,'addPhotoViewer')" accept="image/jpeg">
				<label>တံဆိပ်အမည်<input type="" name="theName" value="" placeholder="တံဆိပ်အမည်" autocomplete="off"></label>
				<label>အမျိုးအစား<input type="" name="theTitle" value="" placeholder="အမျိုးအစား" autocomplete="off"></label>
				<div class="flex _f1"><button class="fas fa-check"></button></div>
			</form>
			<?php
			break;
		case 'addCat_1':
			?>
			<form class="p1010 wbg" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<center><big>Create Category</big></center>
				<input type="hidden" name="adminForm" value="addCat_1">
				<label>Name<input type="" name="theName" value="" placeholder="Name" autocomplete="off"></label>
				<label>Description<textarea name="description" placeholder="Description"></textarea></label>
				<div class="flex _f1"><button class="fas fa-check"></button></div>
			</form>
			<?php
			break;
		case 'addCat_2':
			?>
			<form class="p1010 wbg" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<center><big>Create Group</big></center>
				<input type="hidden" name="adminForm" value="addCat_2">
				<center><img src="media/addPhoto.png" onclick="document.getElementById('addPhoto').click()"  id="addPhotoViewer" style="width:160px;height:160px;object-fit: contain;"></center>
				<label>Select Category
					<select name="cat_1" required>
						<?php option('id','name','cat_1','','') ;?>
					</select>
				</label>
				<input type="file" name="thePhoto" style="display: none;" id="addPhoto" onchange="displaySelectedImage(this,'addPhotoViewer')" accept="image/jpeg">
				<label>Name<input type="" name="theName" value="" placeholder="Name" autocomplete="off"></label>
				<label>Description
					<textarea name="description" placeholder="Description" autocomplete="off"></textarea>
				</label>

				<label>Keywords
					<textarea name="keywords" placeholder="Keywords" autocomplete="off"></textarea>
				</label>
				<div class="flex _f1"><button class="fas fa-check"></button></div>
			</form>
			<?php
			break;
		case 'addCat_3':
			?>
			<form class="p1010 wbg" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<center><big>Add Category</big></center>
				<input type="hidden" name="adminForm" value="addCat_3">
				<?php				
				$search=$connn->query("SELECT * FROM cat_2");
				while ($data=$search->fetch_assoc()) {
					?>
					<label class="flex ce"><input type="checkbox" name="cat_2[]" value="<?php echo $data['id'];?>"><?php echo $data['name'];?></label>
					<?php
				}
				?>
				<label>Name<input type="" name="theName" value="" placeholder="Name" autocomplete="off"></label>
				<label>Keywords<textarea placeholder="keywords" name="keywords"></textarea></label>
				<div class="flex _f1"><button class="fas fa-check"></button></div>
			</form>
			<?php
			break;
		case 'editCat1':
			$data=$connn->query("SELECT * FROM cat_1 WHERE id = '$id'")->fetch_assoc();
			?>
			<form class="p1010 wbg" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<center><big>Edit Category</big></center>
				<input type="hidden" name="adminForm" value="editCat_1">
				<input type="hidden" name="cat_id" value="<?php echo $id;?>">
				<label>Name<input type="" name="theName" value="<?php echo $data['name']?>" placeholder="Name" autocomplete="off"></label>
				<label>Description<textarea name="description" placeholder="Description"><?php echo $data['description']?></textarea></label>
				<div class="flex _f1"><button class="fas fa-check"></button></div>
			</form>
			<?php
			break;
		case 'editCat2':
			$data=$connn->query("SELECT * FROM cat_2 WHERE id = '$id'")->fetch_assoc();
			$photoPath="media/cat/cat2_".$id.".jpg";
			?>
			<form class="p1010 wbg" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<center><big>Edit Group</big></center>
				<input type="hidden" name="adminForm" value="editCat_2">
				<input type="hidden" name="cat_id" value="<?php echo $id;?>">
				<center><img src="<?php echo $photoPath."?v=".fileatime($photoPath);?>" onclick="document.getElementById('addPhoto').click()" id="addPhotoViewer" style="width:160px;height:160px;object-fit: contain;"></center>
				<label>Select Category
					<select name="cat_1" required>
						<option selected disabled value="">တစ်ခုခုရွေးပါ</option>
						<?php option('id','name','cat_1','','') ;?>
					</select>
				</label>
				<input type="file" name="thePhoto" style="display: none;" id="addPhoto" onchange="displaySelectedImage(this,'addPhotoViewer')" accept="image/jpeg">
				<label>Name<input type="" name="theName" placeholder="Name" autocomplete="off" value="<?php echo $data['name'];?>"></label>
				<label>Description
					<textarea name="description" placeholder="Description" autocomplete="off"><?php echo $data['description'];?></textarea>
				</label>

				<label>Keywords
					<textarea name="keywords" placeholder="Keywords" autocomplete="off"><?php echo $data['keywords'];?></textarea>
				</label>
				<div class="flex _f1"><button class="fas fa-check"></button></div>
			</form>
			<?php
			break;
		case 'editCat3':
			$data=$connn->query("SELECT * FROM cat_3 WHERE id = '$id'")->fetch_assoc();
			?>
			<form class="p1010 wbg" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<center><big>Edit Category</big></center>
				<input type="hidden" name="adminForm" value="editCat_3">
				<input type="hidden" name="cat_id" value="<?php echo $id;?>">
				<div>
					<?php
					$search=$connn->query("SELECT * FROM cat_2");

					while ($dataCat2=$search->fetch_assoc()) {
						if (strpos($data['cat_2_id'],$dataCat2['id']) !== false){
	    					$check='checked';
						}
						else{$check='';}
						?>
						<label class="flex ce"><input type="checkbox" name="cat_2[]" value="<?php echo $dataCat2['id'];?>" <?php echo $check;?> ><?php echo $dataCat2['name'];?></label>
						<?php
					}?>
				</div>
				<label>Name<input type="" name="theName" value="<?php echo $data['name'];?>" placeholder="Name" autocomplete="off"></label>
				<label>Keywords<textarea placeholder="keywords" name="keywords"><?php echo $data['keywords'];?></textarea></label>
				<div class="flex _f1"><button class="fas fa-check"></button></div>
			</form>
			<?php
			break;
		case 'delCat1':				
			?>
			<form class="p1010 wbg flex_ce ce" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<div>DELETE?</div>
				<input type="hidden" name="adminForm" value="delCat1">
				<input type="hidden" name="cat_id" value="<?php echo $id;?>">
				<button>DElETE</button>
			</form>
			<?php
			break;
		case 'delCat2':				
			?>
			<form class="p1010 wbg flex_ce ce" method="post" action="include.php" target="theIframe" enctype="multipart/form-data">
				<div>DELETE?</div>
				<input type="hidden" name="adminForm" value="delCat2">
				<input type="hidden" name="cat_id" value="<?php echo $id;?>">
				<button>DElETE</button>
			</form>
			<?php
			break;
		default:
			# code...
			break;
	}//switch
	}//is admin
}

if (isset($_REQUEST['showOrder'])) {
	if ($_REQUEST['showOrder'] == 'byDate') {
		$showOrderByDate=date('Y-m-d',htmlspecialchars($_REQUEST['what'], ENT_QUOTES, 'UTF-8'));
		$filter="theDate LIKE '".$showOrderByDate."%' ";
	}
	elseif ($_REQUEST['showOrder'] == 'byId') {
		$showOrderById=htmlspecialchars($_REQUEST['what'], ENT_QUOTES, 'UTF-8');
		$filter="id LIKE '".$showOrderById."%'";
	}
	?>
	<div class="orderManager">

		<div class="flex ce _p1010 bbg m0505 shadow_1 sticky_1" style="border-left:3px solid var(--color-a)">
			<div id="sr">SR</div>
			<div id="orderId">ORDER ID</div>
			<div id="time">TIME</div>
			<div id="name">NAME</div>
			<div id="phone">PHONE</div>
			<div id="address">ADDRESS</div>
			<div id="status">STATUS</div>
			<div id="actionButtons">ACTION</div>
		</div>
		<?php
		global $connn;
		if (fetchData('level','user','id',$_SESSION['userId'])>2) {
			$search_order=$connn->query("SELECT * FROM orders WHERE {$filter}");
			if ($search_order->num_rows>0) {
				while ($theOrder=$search_order->fetch_assoc()) {
					@$sr+=1;
					switch ($theOrder['status']) {
						case '1':
							$calcSstatus='<div style="color: #fc0"><span class="fas fa-square"></span>&nbsp;Pending</div>';
							$color="#fc0";
							break;
						case '2':
							$calcSstatus='<div style="color: #9a0"><span class="fas fa-square"></span>&nbsp;Delivering</div>';
							$color="#9a0";
							break;
						case '3':
							$calcSstatus='<div style="color: #0c0"><span class="fas fa-square"></span>&nbsp;Received</div>';
							$color="#0c0";
							break;
						case '0':
							$calcSstatus='<div style="color: #f00"><span class="fas fa-square"></span>&nbsp;Cencel</div>';
							$color="#f00";
							break;
						
						default:
							# code...
							break;
					}
					?>
					<div class="m0505">
						<div class="flex ce _p1010 wbg shadow_1" style="border-left:3px solid <?php echo $color;?>">
							<div id="sr"><?php echo $sr;?></div>
							<div id="orderId">#<?php echo $theOrder['id'];?></div>
							<div id="time">
								<?php echo date('h:ia',strtotime($theOrder['theDate']));?><br>
								<?php echo date('d-M-Y',strtotime($theOrder['theDate']));?>
							</div>
							<div id="name"><b><?php echo $theOrder['name'];?></b></div>
							<a class="flex ce" href="tel:<?php echo $theOrder['phone'];?>" id="phone" title="call <?php echo $theOrder['phone'];?>"><span class="fas fa-phone">&nbsp;</span><?php echo $theOrder['phone'];?></a>
							<div id="address"><?php echo $theOrder['address'];?></div><div id="status" class="flex ce">
								<?php echo $calcSstatus;?>
							</div>
							<div id="actionButtons" class="flex ce _p0010">
								<form method="post" action="include.php" target="theIframe" enctype="multipart/form-data" class="flex ce">
									<input type="hidden" name="adminForm" value="orderStatus">
									<input type="hidden" name="orderId" value="<?php echo $theOrder['id'];?>">
									<select style="padding:0px;" name="orderStatus" required>
										<option disabled selected value="">Update</option>
										<option value="1">Pending</option>
										<option value="2">Delivering</option>
										<option value="3">Success</option>
										<option value="0">Cancel</option>
									</select>
									<div><button class="fas fa-check"></button></div>
								</form>
								<span onclick="showPopUpData('voucher=<?php echo $theOrder['id'];?>')"><span class="fas fa-eye"></span>&nbsp;View</span>
								<span onclick="showHide('','voucherContainer<?php echo $theOrder['id'];?>');loadBigContent('voucherEditor=<?php echo $theOrder['id'];?>','voucherContainer<?php echo $theOrder['id'];?>')"><span class="fas fa-angle-down"></span>&nbsp;Edit</span>
								<span onclick='window.open("print.php?what=voucher&id=<?php echo $theOrder['id'];?>");'><span class="fas fa-print">&nbsp;</span>Print</span>
							</div>
						</div>
						<div class="hide" id="voucherContainer<?php echo $theOrder['id'];?>">
						</div>
					</div>
					<?php
				}
			}
			else{
				?>
				<div class="flex ce _p1010 wbg m0505 shadow_1" style="border-left:3px solid <?php echo $color;?>">
					<div class="flex ce"> No order</div>
				</div>
				<?php
			}
		}
		?>
	</div>
	<?php
}

function _adminPath($what){
	$logo="media/H_logo.png";
	switch ($what) {
		case 'nav':
			?>
			<nav class="dbg" style="height:var(--height-1);background-color:#000;">
				<div class="flex_be ce">
					<div class="flex ce _p0010">
						<img src="<?php echo $logo."?v=".fileatime($logo);?>" style="height: calc(var(--height-1) - 5px);" >
						<div style="font-size: 20pt;"><?php echo siteInfo('name');?></div>
					</div>
					<div>
						<div class="flex ce _p1010">
							<a href="?admin=true&manager=order" class="flex ce"><span class="fas fa-truck">&nbsp;</span>Order Manager
								<span class="flex_ce ce" style="width:20px;height: 20px;" id="pendingCount"></span>
								<script type="text/javascript">
									loadSmallContent('pendingCount=what','pendingCount');
									setInterval(function () {
										loadSmallContent('pendingCount=what','pendingCount');
									}, 5000);
								</script>
							</a>
							<a href="?admin=true&manager=report"><span class="fa">&#xf201;&nbsp;</span>Report</a>
							<a href="?admin=true&manager=category"><span class="fas fa-bars">&nbsp;</span>Category Manager</a>
							<a href="?admin=true&manager=brand"><span class="fas fa-tag">&nbsp;</span>Brand Manager</a>
							<a href="?admin=true&manager=item"><span class="fas fa-box">&nbsp;</span>Item Manager</a>
							<a href="?admin=true&manager=user"><span class="fas fa-user">&nbsp;</span>User Manager</a>
							<button onclick="showPopUpData('signForm=out')">Sign Out</button>
						</div>
					</div>					
				</div>
			</nav>
			<?php
			break;
		
		default:
			# code...
			break;
	}
}
?>