<?php
//admin order status
if (isset($_POST['adminForm'])) {
	//public
	$idByTime=time();
	$adminForm=@htmlspecialchars($_POST['adminForm'], ENT_QUOTES, 'UTF-8');
	//order managment
	$orderId=@htmlspecialchars($_POST['orderId'], ENT_QUOTES, 'UTF-8');
	//brand
	$brandId=@htmlspecialchars($_POST['brandId'], ENT_QUOTES, 'UTF-8');
	//item
	$itemId=@htmlspecialchars($_POST['itemId'], ENT_QUOTES, 'UTF-8');
	//cat & brand management 
	$theName=@htmlspecialchars($_POST['theName'], ENT_QUOTES, 'UTF-8');
	$theTitle=@htmlspecialchars($_POST['theTitle'], ENT_QUOTES, 'UTF-8');
	$description=@htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
	$keywords=@htmlspecialchars($_POST['keywords'], ENT_QUOTES, 'UTF-8');
	$cat_1=@htmlspecialchars($_POST['cat_1'], ENT_QUOTES, 'UTF-8').'END';
	$cat_2=@htmlspecialchars($_POST['cat_2'], ENT_QUOTES, 'UTF-8').'END';
	$cat_3=@htmlspecialchars($_POST['cat_3'], ENT_QUOTES, 'UTF-8').'END';
	$cat_id=@htmlspecialchars($_POST['cat_id'], ENT_QUOTES, 'UTF-8');

	//stock
	$stockId=@htmlspecialchars($_POST['stockId'], ENT_QUOTES, 'UTF-8');	
	$stockSize=@htmlspecialchars($_POST['stockSize'], ENT_QUOTES, 'UTF-8');
	$stockOriPrice=@htmlspecialchars($_POST['stockOriPrice'], ENT_QUOTES, 'UTF-8');
	$stockOldPrice=@htmlspecialchars($_POST['stockOldPrice'], ENT_QUOTES, 'UTF-8');	
	$stockNewPrice=@htmlspecialchars($_POST['stockNewPrice'], ENT_QUOTES, 'UTF-8');
	if(fetchData('level','user','id',$_SESSION['userId'])==3) {//is admin
	global $connn;
	switch ($adminForm) {
		case 'changePassword':
			$userId=@htmlspecialchars($_POST['userId'], ENT_QUOTES, 'UTF-8');
			$newPassword=@htmlspecialchars($_POST['newPassword'], ENT_QUOTES, 'UTF-8');
			$connn->query("UPDATE user SET password = '$newPassword' WHERE id = '	$userId'");
			?>
			<script type="text/javascript">
				window.top.window.showNoti("password Change ပြီး");
			</script>
			<?php
			break;
		case 'addItem':
			$main_cat3=$_POST['main_cat3'];
			if ($theName==''||$description==''||$main_cat3==''||$_POST['cat_3']==''||$keywords==''||$_FILES['thePhoto']['tmp_name']=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				mkdir('media/item/'.$idByTime);
				chmod('media/item/'.$idByTime, 0755 );
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,800,'','media/item/'.$idByTime.'/i_'.$idByTime.'.jpg');
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,200,'','media/item/'.$idByTime.'/i_'.$idByTime.'_s.jpg');
				$cat_2Array='';
				foreach($_POST['cat_3'] as $value) {
					$cat_2Array.=$value.'END ';
				}
				$connn->query("INSERT INTO item (id , name, description, cat_3, tag_cat_3, brand_id, keywords) VALUES ('$idByTime','$theName','$description','$main_cat3' ,'$cat_2Array','$brandId','$keywords')");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("ပစ္စည်းသစ်အား ပေါင်းပြီး <br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
					window.top.window.removePopUP();
				</script>
				<?php
			}
			break;
		case 'editItem':
			$main_cat3=$_POST['main_cat3'];
			$status=@$_POST['status'];
			if ($theName==''||$description==''||$main_cat3==''||$_POST['cat_3']==''||$keywords=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,800,'','media/item/'.$itemId.'/i_'.$itemId.'.jpg');
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,200,'','media/item/'.$itemId.'/i_'.$itemId.'_s.jpg');
				$cat_2Array='';
				foreach($_POST['cat_3'] as $value) {
					$cat_2Array.=$value.'END ';
				}
				$connn->query("UPDATE `item` SET `name`='$theName',`description`='$description',`cat_3`='$main_cat3',`tag_cat_3`='$cat_2Array',`brand_id`='$brandId',`keywords`='$keywords',`status`='$status'  WHERE id='$itemId' ");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("ပစ္စည်းအား ပြင်ဆင်ပြီး <br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		case 'addStock':
			if ($stockSize==''||$stockOriPrice==''||$stockOldPrice==''||$stockNewPrice==''||$_FILES['thePhoto']['tmp_name']=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,100,'','media/item/'.$itemId.'/i'.$itemId.'_s'.$idByTime.'_s.jpg');
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,800,'','media/item/'.$itemId.'/i'.$itemId.'_s'.$idByTime.'.jpg');
				$connn->query("INSERT INTO `stock`(`id`, `size`, `original_price`, `old_price`, `new_price`, `item_id`) VALUES ('$idByTime','$stockSize','$stockOriPrice','$stockOldPrice','$stockNewPrice','$itemId')");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("stockသစ် အား ထည့်ပြီး<br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		case 'editStock':
			if ($stockId==''||$stockSize==''||$stockOriPrice==''||$stockOldPrice==''||$stockNewPrice==''){
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,100,'','media/item/'.$itemId.'/i'.$itemId.'_s'.$stockId.'_s.jpg');
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,800,'','media/item/'.$itemId.'/i'.$itemId.'_s'.$stockId.'.jpg');
				$connn->query("UPDATE `stock` SET `size`='$stockSize',`original_price`='$stockOriPrice',`old_price`='$stockOldPrice',`new_price`='$stockNewPrice' WHERE id = '$stockId'");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("stock အားပြင်ဆင်ပြီး<br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		case 'addBrand':
			if ($theName==''||$theTitle==''||$_FILES['thePhoto']['tmp_name']=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,200,'','media/brand/brand_'.$idByTime.'.jpg');
				$connn->query("INSERT INTO brand (id , name, title) VALUES ('$idByTime','$theName','$theTitle')");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("တံဆိပ်သစ် အသစ်အား ထည့်ပြီး <br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		case 'orderStatus':

			$status=$connn->query("SELECT status FROM orders WHERE id ='$orderId'")->fetch_assoc()['status'];
			if ($status==0||$status==3) {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("ရောင်းရပြီးသော (သို့) ဖျက်သိမ်းပြီးသော order အား ပြင်ဆင်ခွင့်မပေးထားပါ");
				</script>
				<?php
			}
			else{
				$orderStatus=@htmlspecialchars($_POST['orderStatus'], ENT_QUOTES, 'UTF-8');
				$connn->query("UPDATE orders SET status ='$orderStatus' WHERE id = '$orderId'");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("ပြင်ဆင်ပြီး");
				</script>
				<?php
			}
			break;
		case 'updateOrder':
			$status=$connn->query("SELECT status FROM orders WHERE id ='$orderId'")->fetch_assoc()['status'];
			if ($status==0||$status==3) {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("ရောင်းရပြီးသော (သို့) ဖျက်သိမ်းပြီးသော order အား ပြင်ဆင်ခွင့်မပေးထားပါ");
				</script>
				<?php
			}
			else{
				$resiverName=@htmlspecialchars($_POST['resiverName'], ENT_QUOTES, 'UTF-8');
				$resiverPhone=@htmlspecialchars($_POST['resiverPhone'], ENT_QUOTES, 'UTF-8');
				$resiverAddress=@htmlspecialchars($_POST['resiverAddress'], ENT_QUOTES, 'UTF-8');
				$connn->query("UPDATE orders SET name ='$resiverName' , phone = '$resiverPhone', address = '$resiverAddress' WHERE id = '$orderId'");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("ပြင်ဆင်ပြီး");
					window.top.window.loadBigContent('voucherEditor=<?php echo $orderId;?>','voucherContainer<?php echo $orderId;?>');
				</script>
				<?php
			}
			break;
		case 'updateCart':

			$status=$connn->query("SELECT status FROM orders WHERE id ='$orderId'")->fetch_assoc()['status'];
			if ($status==0||$status==3) {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("ရောင်းရပြီးသော (သို့) ဖျက်သိမ်းပြီးသော order အား ပြင်ဆင်ခွင့်မပေးထားပါ");
				</script>
				<?php
			}
			else{
				$cartId=@htmlspecialchars($_POST['cartId'], ENT_QUOTES, 'UTF-8');
				$number=@htmlspecialchars($_POST['number'], ENT_QUOTES, 'UTF-8');
				if ($number>0) {
					$connn->query("UPDATE cart SET `number` ='$number' WHERE id = '$cartId'");
					;?>
					<script type="text/javascript">
						window.top.window.showNoti("ပြင်ဆင်ပြီး");
						window.top.window.loadBigContent('voucherEditor=<?php echo $orderId;?>','voucherContainer<?php echo $orderId;?>');
					</script>
					<?php
				}
				else{
					;?>
					<script type="text/javascript">
						window.top.window.showAlerm("အရေအတွက် အား အနည်းဆုံး ၁ ခုထားပါ (သို့မဟုတ်) ဤ ပစ္စည်းအား ပယ်ဖျက်လိုက်ပါ");;
					</script>
					<?php
				}
			}
			break;
		case 'deleteCart':
			$status=$connn->query("SELECT status FROM orders WHERE id ='$orderId'")->fetch_assoc['status'];
			if ($status==0||$status==3) {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("ရောင်းရပြီးသော (သို့) ဖျက်သိမ်းပြီးသော order အား ပြင်ဆင်ခွင့်မပေးထားပါ");
				</script>
				<?php
			}
			else{
				$cartId=@htmlspecialchars($_POST['cartId'], ENT_QUOTES, 'UTF-8');
				$connn->query("DELETE FROM `cart` WHERE id = '$cartId' ");
				;?>
				<script type="text/javascript">
					window.top.window.showNoti("ပယ်ဖျက်ပြီး");
					window.top.window.loadBigContent('voucherEditor=<?php echo $orderId;?>','voucherContainer<?php echo $orderId;?>');
				</script>
				<?php
			}
			break;
		case 'addCat_1':
			if ($theName==''||$description=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				$connn->query("INSERT INTO  cat_1 ( id , name , description) VALUES ('$idByTime','$theName','$description')");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("Category အသစ်အား ပေါင်းပြီး <br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		case 'addCat_2':
			if ($theName==''||$_FILES['thePhoto']['tmp_name']=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,200,'','media/cat/cat2_'.$idByTime.'.jpg');
				$connn->query("INSERT INTO  cat_2 (id , name, cat_1_id, description, keywords) VALUES ('$idByTime','$theName','$cat_1','$description','$keywords')");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("Group အသစ်အား ပေါင်းပြီး <br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		case 'addCat_3':
			if ($theName==''||$keywords==''||$_POST['cat_2']=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				$cat_2Array='';
				foreach($_POST['cat_2'] as $value) {
					$cat_2Array.=$value.'END ';
				}
				$connn->query("INSERT INTO  cat_3 (id , name, cat_2_id, keywords) VALUES ('$idByTime','$theName','$cat_2Array','$keywords')");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("category အသစ်အား ပေါင်းပြီး <br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		case 'editCat_1':
			if ($theName==''||$description=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				$connn->query("UPDATE `cat_1` SET `name`='$theName',`description`='$description' WHERE id='$cat_id'");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("Category အား ပြင်ဆင်ပြီး <br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		case 'editCat_2':
			if ($theName=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,200,'','media/cat/cat2_'.$cat_id.'.jpg');
				$connn->query("UPDATE `cat_2` SET `name`='$theName',`cat_1_id`='$cat_1', `description`='$description', `keywords`='$keywords'  WHERE id='$cat_id'");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("Group အား ပြင်ဆင်ပြီး <br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		case 'editCat_3':
			if ($theName==''||$keywords==''||$_POST['cat_2']=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				$cat_2Array='';
				foreach($_POST['cat_2'] as $value) {
					$cat_2Array.=$value.'END ';
				}
				$connn->query("UPDATE `cat_3` SET `name`='$theName',`cat_2_id`='$cat_2Array',`keywords`='$keywords' WHERE id = '$cat_id'");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("category အား ပြင်ဆင်ပြီး <br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		case 'delCat1':
			if ($connn->query("SELECT * FROM cat_2 WHERE cat_1_id LIKE '%$cat_id%'")->num_rows == 0) {
				$connn->query("DELETE FROM `cat_1` WHERE id = {$cat_id}");
				?>
				<script type="text/javascript">
					window.top.removePopUP();
					window.top.document.getElementById('cat1<?php echo $cat_id;?>').style.display='none';
					window.top.window.showNoti("category အားဖျက်ပြီး");
				</script>
				<?php
			}
			else{
				?>
				<script type="text/javascript">
					window.top.window.showNoti("category အားဖျက်၍မရပါ");
				</script>
				<?php
			}
			break;
		case 'delCat2':
			if ($connn->query("SELECT * FROM cat_3 WHERE cat_2_id LIKE '%$cat_id%'")->num_rows == 0) {
				$connn->query("DELETE FROM `cat_2` WHERE id = {$cat_id}");
				unlink("media/cat/cat2_".$cat_id.".jpg");
				?>
				<script type="text/javascript">
					window.top.removePopUP();
					window.top.document.getElementById('cat2<?php echo $cat_id;?>').style.display='none';
					window.top.window.showNoti("category အားဖျက်ပြီး");
				</script>
				<?php
			}
			else{
				?>
				<script type="text/javascript">
					window.top.window.showNoti("category အားဖျက်၍မရပါ");
				</script>
				<?php
			}
			break;
		case 'updateBrand':
			if ($theName==''||$theTitle=='') {
				?>
				<script type="text/javascript">
					window.top.window.showAlerm("အချက်အလက်များအား ပြည့်စုံစွာ ဖြည့်ပေးပါ");
				</script>
				<?php
			}
			else{
				output_thumbnail($_FILES['thePhoto']['tmp_name'] ,200,'','media/brand/brand_'.$brandId.'.jpg');
				$connn->query("UPDATE `brand` SET `name`='$theName',`title`='$theTitle' WHERE id='$brandId'");
				?>
				<script type="text/javascript">
					window.top.window.showNoti("Brand အား ပြင်ဆင်ပြီး <br> စာမျက်နာအား reload ပြန်လုပ်ပေးပါ");
				</script>
				<?php
			}
			break;
		default:
			# code...
			break;
		}
	}
}

//Liking action
if (isset($_POST['likeOnOff'])) {
	if (isset($_SESSION['userId'])) {
	
		$user_id=@$_SESSION['userId'];
		$likeItemid=@htmlspecialchars($_POST['likeOnOff'], ENT_QUOTES, 'UTF-8');
		if($connn->query("SELECT * FROM rating WHERE item_id = '$likeItemid' AND user_id='$user_id'")->num_rows>0){
			$connn->query("DELETE FROM rating WHERE item_id = '$likeItemid'");
			$connn->query("UPDATE item SET rating=rating-1 WHERE id='$likeItemid'");
			$respondMessage = 'Unliked';		
		}
		else{
			$connn->query("INSERT INTO rating ( item_id , user_id ) VALUES ('$likeItemid','$user_id')");
			$respondMessage = 'liked';
			$connn->query("UPDATE item SET rating=rating+1 WHERE id='$likeItemid'");
		}
		?>
		<script type="text/javascript">
			window.top.window.loadSmallContent('checkRating=<?php echo $likeItemid;?>','favourite_status<?php echo $likeItemid;?>');
			window.top.window.showNoti('<?php echo $respondMessage;?>');
		</script>
		<?php
	}
	else{
		$respondMessage = 'Sign In ဝင်ထားရန်လိုအပ်ပါသည်';
		?>
		<script type="text/javascript">
			window.top.window.showAlerm('<?php echo $respondMessage;?>');
			window.top.window.showPopUpData('signForm=in');
		</script>
		<?php		
	}
}

// Action By User
if (isset($_POST['formName'])) {
	if (isset($_SESSION['userId'])) {
		global $connn;
		$user= $_SESSION['userId'];
		
		$stock_id=@htmlspecialchars($_POST['stock_id'], ENT_QUOTES, 'UTF-8');
		$number=@htmlspecialchars($_POST['qty'], ENT_QUOTES, 'UTF-8');

		$reseiverName=@htmlspecialchars($_POST['reseiverName'], ENT_QUOTES, 'UTF-8');
		$reseiverPhone=@htmlspecialchars($_POST['reseiverPhone'], ENT_QUOTES, 'UTF-8');
		$reseiverAddress=@htmlspecialchars($_POST['reseiverAddress'], ENT_QUOTES, 'UTF-8');

		switch ($_POST['formName']) {
			case 'addCart':
				if ($number>0) {
					$id=time();
					$checkCart=$connn->query("SELECT * FROM cart WHERE user_id = '$user' AND stock_id = $stock_id AND order_id=0 ");
					if($checkCart->num_rows>0){
						$cartId=$checkCart->fetch_assoc()['id'];
						$connn->query("UPDATE cart SET number ='$number' WHERE id ='$cartId' ");
						$respondMessage ='updated';
					}
					else{ //new one
						$connn->query("INSERT INTO cart ( id , stock_id, user_id, number ) VALUES ('$id','$stock_id','$user','$number')");
						$respondMessage = 'add';
					}
				}
				else{
					$respondMessage = 'အနည်းဆုံး အရေအတွက် တစ်ခုရွေးပါ';
				}
				break;
			case 'delCart':
				$connn->query("DELETE FROM cart WHERE stock_id = '$stock_id' AND user_id= '$user' AND order_id =0 ");
				$respondMessage ='deleted';
				break;
			case 'makeOrder':
				// fetch form cart
				if (date('H')<21 && date('H')>8) {
					if($reseiverName==''||$reseiverPhone==''||$reseiverAddress==''){
						?>
						<script type="text/javascript">
							window.top.window.showAlerm('အချက်အလက်များပြည့်စုံစွာဖြည့်ပါ');
						</script>
						<?php
					}
					else{
						$order_id=time();
						$fetchStock=$connn->query("SELECT * FROM cart WHERE user_id = '$user' AND order_id = 0 ");
						if ($fetchStock->num_rows>0) {
							$time=date('Y-m-d H:i:s');
							while ($cart=$fetchStock->fetch_assoc()) {
								$stockPrice=fetchData('new_price','stock','id',$cart['stock_id']);
								$ori_Price=fetchData('original_price','stock','id',$cart['stock_id']);
								$connn->query("UPDATE cart SET c_price='$stockPrice', ori_Price ='$ori_Price',  order_id = '$order_id' WHERE id = {$cart['id']} ");
							}
							// inseart order new order
							$connn->query("INSERT INTO orders 
								(id, theDate, user_id , name,  phone , address_code , address , status ) VALUES 
								('$order_id','$time','$user','$reseiverName', '$reseiverPhone' ,0,'$reseiverAddress','1')");

							?>
							<script type="text/javascript">
								window.top.window.showAlerm('order အားအောင် မြင်စွာ တင်ပြီးပါပြီ မကြာမီ <?php echo siteInfo('name');?> မှ အကြောင်းကြားပေး ပါမည်');
								window.top.window.removePopUP();
								window.top.window.loadBigContent('cart=mini','miniCartContainer');
							</script>
							<?php
						}
						else{
							?>
							<script type="text/javascript">
								window.top.window.showAlerm('လူကြီးမင်းရွေးချယ်ထားသော ပစ္စည်း မရှိသေးပါ သဖြင့် order လုပ်ခြင်း မအောင်မြင်ပါ၊ အနည်းဆုံး တစ်ခုရွေးပေးပါ');
								window.top.window.removePopUP();
							</script>
							<?php
						}
					}
				}
				else{
					?>
					<script type="text/javascript">
						window.top.window.showAlerm('မင်္ဂလာပါ H Store ၏ ဝန်ဆောင်မှုများမှာ 9am မှ 9pm အထိသာဖြစ်ပါ၍ အဆင်မပြေမှုဖြစ်သွားသည့်အတွက် တောင်းပန်ပါတယ်');
						window.top.window.removePopUP();
					</script>
					<?php
				}
				break;
		}
		?>
		<script type="text/javascript">
			window.top.window.showNoti('<?php echo $respondMessage;?>');
			window.top.window.loadBigContent('cart=mini','miniCartContainer');
			window.top.window.loadSmallContent('checkNumberOfStockInCart=<?php echo @$stock_id;?>','checkNumberOfStockInCart<?php echo $stock_id;?>');
			window.top.window.document.getElementById('stockEdit<?php echo $stock_id;?>').className='hide';
		</script>
		<?php 
	}
	else{
		$respondMessage = 'ပစ္စည်းများ ဝယ်ယူရန် Sign In ဝင်ထားရန်လိုအပ်ပါသည်';
		?>
		<script type="text/javascript">
			window.top.window.showAlerm('<?php echo $respondMessage;?>');
			window.top.window.showPopUpData('signForm=in');
		</script>
		<?php					
	}
}

?>