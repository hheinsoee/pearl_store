<?php
if (isset($_GET['pendingCount'])) {
	global $connn;
	$today =date('Y-m-d', strtotime('today'));
	$result=$connn->query("SELECT * FROM orders WHERE status = 1 AND theDate LIKE '$today%' ")->num_rows;
	if ($result > 0) {
		?><span class="flex_ce ce" style="width:20px;height: 20px;background-color: #f00;border-radius: 50%"><?php 
		echo $result;
		?></span><?php
	}else{
		?><?php
	}
}
if (isset($_REQUEST['voucherEditor'])) {
	voucherEditor(htmlspecialchars($_REQUEST['voucherEditor'], ENT_QUOTES, 'UTF-8'));
}
function voucherEditor($id){
	if(fetchData('level','user','id',$_SESSION['userId'])==3) {//is admin
		?>
		<div class="p1010 flex _f1 wrap _m1010" style="background-color: rgba(0,0,0,0.4);">
			<?php
			global $connn;
			$order=$connn->query("SELECT * FROM orders WHERE id = '$id' ")->fetch_assoc();
			$orderId=$order['id'];
			$cartItem=$connn->query("SELECT * FROM cart WHERE order_id='$orderId'");
			?>
			<div class="wbg shadow_1 p1010">
				<b>ဘောက်ချာနံပါတ် #<?php echo $id;?></b>
				<low>ပေးပို့ရမည့် အမည် ဖုန်း နှင့် လိပ်စာ</low>
				<form method="post" action="include.php" target="theIframe" enctype="multipart/form-data" >
					<input type="hidden" name="adminForm" value="updateOrder">
					<input type="hidden" name="orderId" value="<?php echo $id;?>">
					<input type="" name="resiverName" value="<?php echo $order['name'];?>" placeholder="ပစ္စည်း လက်ခံမည့်သူ အမည်">
					<input type="" name="resiverPhone" value="<?php echo $order['phone'];?>" placeholder="ပစ္စည်း လက်ခံမည့်သူ၏ ဖုန်း">
					<textarea placeholder="ပေးပို့ရမည့် လိပ်စာ" name="resiverAddress"><?php echo $order['address'];?></textarea>
					<div class="right"><button>Save</button></div>
				</form>
			</div>

			<div class="wbg shadow_1">
					<div class="flex ce _p1010 wbg shadow_1">
						<b style="width:170px">ပစ္စည်း</b>
						<b style="width:100px">အမျိုးအစား</b>
						<b style="width:100px;text-align: right;">ဈေးနှုန်း</b>
						<b style="width:200px;text-align: center;">အရေအတွက်</b>
						<b style="width:100px;">သင့်ငွေ</b>
					</div>
				<?php
				while ($cart=$cartItem->fetch_assoc()) {
					$itemId=fetchData('item_id','stock','id',$cart['stock_id']);
					$photo="media/item/".$itemId."/i".$itemId."_s".$cart['stock_id'].".jpg";
					?>
					<div class="flex ce _p1010">
						<img src="<?php echo $photo.'?v='.filemtime($photo);?>" style="height:50px;width:50px;object-fit: contain;">
						<div style="width: 100px;">
							<?php echo fetchData('name','item','id',$itemId);?><br>
						</div>
						<div style="width: 100px;">
							<?php echo fetchData('size','stock','id',$cart['stock_id']);?>
						</div>
						<div style="width: 100px;text-align: right;">
							<?php echo number_format($cart['c_price']);?>&nbsp;Ks
						</div>
						<div style="width:200px;" class="flex ce">
							<form class="flex ce" method="post" action="include.php" target="theIframe" enctype="multipart/form-data" >
								<input type="hidden" name="adminForm" value="updateCart">
								<input type="hidden" name="orderId" value="<?php echo $id;?>">
								<input type="hidden" name="cartId" value="<?php echo $cart['id'];?>">
								<input class="p0010" type="number" name="number" value="<?php echo $cart['number'];?>" style="text-align: right;width:30px;">
								<button>Save</button>
							</form>
							<form method="post" action="include.php" target="theIframe" enctype="multipart/form-data" >
								<input type="hidden" name="adminForm" value="deleteCart">
								<input type="hidden" name="orderId" value="<?php echo $id;?>">
								<input type="hidden" name="cartId" value="<?php echo $cart['id'];?>">
								<button>delete</button>
							</form>
						</div>
						<div style="width:100px;">
							<?php $theTotal=$cart['c_price']*$cart['number'];?>
							<?php echo number_format($theTotal);?>Ks
						</div>
					</div>
					<?php
					@$total+=$theTotal;
				}
				?>
				<div class="p1010 right" style="width:690px;"><big>စုစုပေါင်း <span id="price"><?php echo number_format(@$total);?>&nbsp;Ks</span></big></div>
			</div>
		</div>
		<div style="height:100px;">
		</div>
		<?php
	}
}

if (isset($_REQUEST['voucher'])) {
	voucher(htmlspecialchars($_REQUEST['voucher'], ENT_QUOTES, 'UTF-8'));
}
function voucher($id=0){
	global $connn;
	if ($id > 0) {
		$sOrder=$connn->query("SELECT * FROM orders WHERE id = $id ");
		if ($sOrder->num_rows>0) {
			$order=$sOrder->fetch_assoc();
			
			$orderStatus=$order['status'];
			$orderId=$id;

			$voucherContainerClass='show';
			switch ($orderStatus) {
				case '1':
					$voucherHeadStyle="style='background-color:#a70;color:#fff'";
					$status='<span class="fas fa-shopping-bag">&nbsp;</span>Pending';
					$statusMessage='မကြာမီဖုန်းဆက် အတည်ပြုပေးပါမည်';
					break;
				case '2':
					$voucherHeadStyle="style='background-color:#770;color:#fff'";
					$status='<span class="fas fa-truck">&nbsp;</span>Delivering';
					$statusMessage='လူကြီးမင်းထံသို့ လာရောက်ပို့ဆောင်နေပါပြီ';
					break;
				case '3':
					$voucherHeadStyle="style='background-color:#090;color:#fff'";
					$status='<span class="fas fa-check">&nbsp;</span>Received';
					$statusMessage='ပစ္စည်းအား ပို့ဆောင်ပြီး ဝယ်ယူမှုအားကျေးဇူးတင်ပါတယ်';
					break;
				case '0':
					$voucherHeadStyle="style='background-color:#900;color:#fff'";
					$status='<span class="fas fa-times">&nbsp;</span>Cancel';
					$statusMessage='ဤ order အားပယ်ဖျက်ပြီးဖြစ်ပါသည်';
					break;
				default:
					$voucherHeadStyle="class='bbg'";
					break;
			}
		}
		else{
			echo 'no data #error';
		}
		$secondFilter="";
	}
	else{
		$orderStatus=0;
		$orderId=0;

		$voucherContainerClass='';
		$secondFilter="AND user_id = '".$_SESSION['userId']."'";
	}
	?>
	<div>
		<div class="voucher shadow_2" id="voucherId<?php echo $orderId;?>">
			<?php if($orderId>0){
			;?>
			<div <?php echo $voucherHeadStyle;?> onclick="showHide('','voucher<?php echo $orderId;?>')">
				<center>
					<div>#<?php echo $orderId;?></div>
					<div><?php echo date('h:i a - d M Y',strtotime($order['theDate']));?></div>
				</center>
				<div class="flex_be _p1010">
					<div style="width: 150px;">
						<div><span class="fas fa-user">&nbsp;</span><?php echo $order['name'];?></div>
						<div><span class="fas fa-phone">&nbsp;</span><?php echo $order['phone'];?></div>
						<div><span class="fas fa-map">&nbsp;</span><?php echo $order['address'];?></div>
					</div>
					<div>
						<div style="width: 150px;">
							<?php echo $status;?><br>
							<small><low><?php echo $statusMessage;?></low></small>
						</div>
					</div>
				</div>
			</div>
			<?php } ;?>
			<div id="voucher<?php echo $orderId;?>" class='<?php echo $voucherContainerClass;?>'>
				<div class="table">
					<div>
						<div class="gbg flex ce" style="position: sticky;top:0;z-index: 99;">
							<span id="sir">စဉ်</span>
							<span id="item">ပစ္စည်း</span>
							<span id="thePrice">ဈေးနှုန်း</span>
							<span id="number">ခုရေ</span>
							<span id="cost">ကျသင့်ငွေ</span>
						</div>
						<?php
						$searchStock=$connn->query("SELECT * FROM cart WHERE order_id='$orderId' $secondFilter ");	
						while ($data=$searchStock->fetch_assoc()) {
							$item_id=fetchData('item_id','stock','id',$data['stock_id']);
							@$sir+=1;
							if($orderId>0){
								$price = $data['c_price'];
							}
							else{
								$price = fetchData('new_price','stock','id',$data['stock_id']);
							}

							$photo="media/item/".$item_id."/i".$item_id."_s".$data['stock_id'].".jpg";
							?>

						<div class="flex ce">
							<span id="sir"><?php echo $sir;?></span>
							<span id="item">
								<div class="flex ce">
									<img src="<?php echo $photo.'?v='.filemtime($photo);?>" style="height: 30px;width:30px;object-fit: contain;"> 
									<div>
										<small><?php echo fetchData('name','item','id',$item_id);?></small><br>
										<?php echo fetchData('size','stock','id',$data['stock_id']);?>
									</div>
								</div>
							</span>
							<span id="thePrice">
								<?php 
								echo number_format($price);
								?>
							</span>
							<span id="number"><?php echo number_format($data['number']);?>	</span>
							<span id="cost"><?php echo number_format($data['number']*fetchData('new_price','stock','id',$data['stock_id']));?> Ks</span>
						</div>
						
						<?php
						@$total+=$data['number']*$price;
						}
						?>
					</div>
				</div>	

				<div class="wbg right p0010">
					စုစုပေါင်း <big><span id="price"><?php echo number_format(@$total);?> Ks</span></big>
				</div>
				<!-- <div class="wbg right p0010">
					<div>delivery 500</div>
				</div> -->
				<?php if($orderId==0){ 
					if (date('H')<21 && date('H')>8) {
					?>
					<small class="p1010">မင်္ဂလာပါ H Store ၏ ဝန်ဆောင်မှုများမှာ 9am မှ 9pm အထိဖြစ်ပါသည်။</small>
					<div class="flex_ce">
						<form style="max-width: 360px;" method="post" action="include.php" target="theIframe" enctype="multipart/form-data" class="wbg">
							<input type="hidden" name="formName" value="makeOrder">
							<input type="name" name="reseiverName" autocomplete="off" placeholder="လက်ခံမည့်သူ">
							<input type="tel" name="reseiverPhone" autocomplete="off" placeholder="လက်ခံမည့်သူ ၏ ဖုန်း">
							<textarea placeholder="လိပ်စာအပြည့်စုံ" name="reseiverAddress"></textarea>
							<small class="p1010">အချက်အလက်များ စစ်ဆေးပြီး order အားအတည်ပြုရန် confirm ကိုနိပ်ပါ</small>

							<div class="flex _f1 _p1010"><button>Confirm</button></div>
						</form>
					</div>
					<?php 
				 }
				 else{
				 	?><div class="p1010 ">မင်္ဂလာပါ H Store ၏ ဝန်ဆောင်မှုများမှာ<br><b>9am မှ 9pm အထိသာဖြစ်ပါ၍</b><br>ယခုမှာယူ၍ မရနိုင်ပါ</div><?php
				 }
				} 
				?>
			</div>
		</div>
	</div>
		<?php

}
?>