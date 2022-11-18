<?php 
if (isset($_REQUEST['checkNumberOfStockInCart'])) {
	echo checkNumberOfStockInCart(htmlspecialchars($_REQUEST['checkNumberOfStockInCart'], ENT_QUOTES, 'UTF-8'));
}
function checkNumberOfStockInCart($stock_id){
	global $connn;
	$user = @$_SESSION['userId'];
	$check=$connn->query("SELECT * FROM cart WHERE stock_id = '$stock_id' AND user_id = '$user' AND order_id=0");
	$data = $check->fetch_assoc();
	if ($check->num_rows>0) {
		?>
		<div class="right p0010">
			<low>
				<form method="post" action="include.php" target="theIframe" enctype="multipart/form-data" style="display: none">
					<input type="hidden" name="formName" value="delCart">					
					<input type="hidden" name="stock_id" value="<?php echo $stock_id;?>">
					<button id="cart<?php echo $stock_id;?>DelButton"></button>
				</form>

				<div class="flex_be">
					<span><?php echo $data['number'];?> ခုဝယ်ရန် ခြင်းထဲထည့်ပြီး</span>
				 	<a title="ဤ ပစ္စည်းအား ပါယ်မည်" onclick="document.getElementById('cart<?php echo $stock_id;?>DelButton').click()">ပယ်ဖျက်ရန်<span class="fas fa-trash-alt"></span></a>
				</div>
			</low>
		</div>
		<?php
	}
	else{}
		?>
		<div class="hide" id="stockEdit<?php echo $stock_id;?>">
			<div class="p1010">
				<form method="post" action="include.php" target="theIframe" enctype="multipart/form-data" class="flex ce">
					<small>မှာယူမည့်အရေအတွက်</small>
					<div class="flex ce  _shadow_l">
						<input type="hidden" name="formName" value="addCart">
						<input type="hidden" name="stock_id" value="<?php echo $stock_id;?>">
						<div class="flex_ce ce" style="background-color: #fff;border-radius: 20px;overflow:hidden;padding: 0px 10px;">
							<ico class="fas fa-angle-left" onclick="InDe(-1,'qty<?php echo $stock_id;?>')"></ico>
							<input id="qty<?php echo $stock_id;?>" type="number" name="qty" value="0<?php echo @$data['number'];?>" style="width:30px;border:none;padding: 0;text-align: center;height:20px;">
							<ico class="fas fa-angle-right" onclick="InDe(+1,'qty<?php echo $stock_id;?>')"></ico>
						</div>
						<button style="border-radius: 20px;"><span class="fas fa-check"></span></button>
					</div>
				</form>
			</div>
		</div>
		<?php
}

if (isset($_GET['cart'])) {
	cart(htmlspecialchars($_GET['cart'], ENT_QUOTES, 'UTF-8'));
}
function cart($type){
	global $connn;
	$cartUser=@$_SESSION['userId'];
	$searchItemInCart=$connn->query("SELECT * FROM cart WHERE user_id = '$cartUser' AND order_id=0");
	switch ($type) {
		case 'mini':
			?>
			<div>
				<div style="float: right;">
					<span style="
					  webkit-animation: rotate 1s infinite; /* Safari 4.0 - 8.0 */
					  -webkit-animation-timing-function: linear; /* Safari 4.0 - 8.0 */
					  animation: rotate 1s infinite;
					  animation-timing-function: linear;
					  ;margin-top:-50px;
					  height:40px;width:40px;
					  border-radius: 50%;
					  border:2px solid var(--color-a);
					  " class="flex_ce ce m0505 wbg shadow_1" onclick="showHide('','showHideCart')"><span style="font-size: 18pt;color:var(--color-a)" class=" fas fa-shopping-basket"></span></span>
				</div>
				<div id="showHideCart" class="show" style="max-width: 400px;">
					<div class=" r bg_blr" style="background-color:rgba(0,0,0,0.5);">
						<div class="_m0505 p0505 r" style="max-height:calc(100vh - 200px);overflow: auto;">
						<?php
						if ($searchItemInCart->num_rows>0) {
							?>
							<div style="color:#fff">
								<center onclick="showHide('','showHideCart')">hide</center>
								<low>ဝယ်ယူအားပေးမှု အတွက် အထူးကျေးဇူးတင်ရှိပါသည်။ ရွေးချယ်ထားသော အရာများအား ဤနေရာတွင်ပြင်ဆင် နိုင်ပါသည်။</low>
							</div>
							<?php
							while ($data=$searchItemInCart->fetch_assoc()) {
								cartItem($data['id']);
								@$totalPrice += fetchData('new_price','stock','id',$data['stock_id'])*$data['number'];
							}
						}
						else{
							?><div class="p1010 wbg shadow_1 r">ခြင်းထဲ၌ မည်သည့်ပစ္စည်းမှမရှိသေးပါ</div><?php
						}
						?>
						</div>
						<big class="flex_be _f1 r bbg p1010" onclick="showPopUpData('voucher=0')">
							<span>check out</span><span class="right">total <?php echo number_format(@$totalPrice);?> ကျပ်</span>
						</big>
					</div>
				</div>
			</div>
			<?php
			break;
		
		default:
			# code...
			break;
	}
}

function cartItem($id){
	global $connn;
	$cartUser=@$_SESSION['userId'];
	$WhatInCart=$connn->query("SELECT * FROM cart WHERE id = '$id' ")->fetch_assoc();
	$Stock=$connn->query("SELECT * FROM stock WHERE id = {$WhatInCart['stock_id']} ")->fetch_assoc();
	$photoPath="media/item/".$Stock['item_id']."/i".$Stock['item_id']."_s".$Stock['id'].".jpg";
	?>
	<div class="lbg r shadow_1 cartItem">
		<div class="flex_be ce wbg r shadow_1" onclick="showHide('','stockEdit<?php echo $Stock['id'];?>')" style="cursor: pointer;">
			<div class="flex ce wbg r">
				<img src="<?php echo $photoPath.'?v='.filemtime($photoPath);?>" style="height:40pt;max-width: 50px;object-fit: contain;">
				<div class="p0010">
					<?php echo $Stock['size'];?>
					<small class="flex ce">
						<div id="price"><?php echo number_format($Stock['new_price']);?></div>
						<span>&nbsp;x&nbsp;</span>
						<div><?php echo number_format($WhatInCart['number']);?></div>
					</small>
				</div>
			</div>
			<div class="p0010 right flex ce _p1010">
				<b id="price"><?php echo number_format($Stock['new_price']*$WhatInCart['number']);?>&nbsp;<small>ks</small></b>
				<form method="post" action="include.php" target="theIframe" enctype="multipart/form-data" style="display: none">
					<input type="hidden" name="formName" value="delCart">					
					<input type="hidden" name="stock_id" value="<?php echo $Stock['id'];?>">
					<button id="cart<?php echo $id;?>DelButton"></button>
				</form>
				<a class="fas fa-trash-alt" title="ဤ ပစ္စည်းအား ပါယ်မည်" onclick="document.getElementById('cart<?php echo $id;?>DelButton').click()"></a>
			</div>
		</div>
		<div id="stockEdit<?php echo $Stock['id'];?>" class="hide">
			
			<div>
				<form method="post" action="include.php" target="theIframe" enctype="multipart/form-data" class="flex ce p1010">
					<small>မှာယူမည့်အရေအတွက်</small>
					<div class="flex ce  _shadow_l">
						<input type="hidden" name="formName" value="addCart">
						<input type="hidden" name="stock_id" value="<?php echo $Stock['id'];?>">
						<div class="flex_ce ce" style="background-color: #fff;border-radius: 20px;overflow:hidden;padding: 0px 10px;">
							<ico class="fas fa-angle-left" onclick="InDe(-1,'qty<?php echo $Stock['id'];?>')"></ico>
							<input id="qty<?php echo $Stock['id'];?>" type="number" name="qty" value="<?php echo $WhatInCart['number'];?>" style="width:30px;border:none;padding: 0;text-align: center;height:20px;">
							<ico class="fas fa-angle-right" onclick="InDe(+1,'qty<?php echo $Stock['id'];?>')"></ico>
						</div>

						<button style="border-radius: 20px;"><span class="fas fa-check"></span></button>
					</div>
				</form>
				<center>
					<big><?php echo fetchData('name','item','id', $Stock['item_id']);?></big>
				</center>
				<a class="flex _f1"><button onclick="showPopUpData('itemId=<?php echo $Stock['item_id'];?>&size=medium')">View <?php echo fetchData('name','item','id', $Stock['item_id']);?></button></a>
			</div>

		</div>
	</div>
	<?php
}
?>