<?php 
if (isset($_POST['changeUserInfo'])) {
	if (isset($_SESSION['userId'])) {
		$UPas=htmlspecialchars($_POST['newUserPassword'], ENT_QUOTES, 'UTF-8');
		$UNam=htmlspecialchars($_POST['theName'], ENT_QUOTES, 'UTF-8');
		//$UPho=htmlspecialchars($_POST['thePhone'], ENT_QUOTES, 'UTF-8');
		global $connn;
		if (strlen($UPas)<6) {
			$respondMessage = 'password သည် အနည်းဆုံ ၆ လုံးရှိသင့်ပါသည်။';
		}
		// elseif($connn->query("SELECT * FROM user WHERE phone = '$UPho' AND id!={$_SESSION['userId']}")->num_rows>0){
		// 	$respondMessage = $UPho.' အား အသုံးပြုလျက် အခြားသော အကောင့်တစ်ခုရှိပြီး ဖြစ်၍ အခြားသော ဖုန်းနံပါတ်ရွေးပါ';
		// }
		else{
			$connn->query("UPDATE user SET name='$UNam',password='$UPas', resetPassCode=0 WHERE id={$_SESSION['userId']}");
			$respondMessage = 'အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ';

			?>
			<script type="text/javascript">
				window.top.window.removePopUP();
				window.top.window.document.getElementById('forceLayer').innerHTML='';
			</script>
			<?php
		}
		?>
		<script type="text/javascript">
			window.top.window.showAlerm('<?php echo $respondMessage;?>');
		</script>
		<?php
	}
}

if (isset($_REQUEST['userInfoEditForm'])) {
	userInfoEditForm();
}
function userInfoEditForm(){
	global $connn;
	$data=$connn->query("SELECT * FROM user WHERE id = {$_SESSION['userId']}")->fetch_assoc()
	?>
		<div class="wbg _p1010 r shadow_1">
			<div class="bbg"><big>သင်၏ အချက်အလက်များ</big></div>
			<center>
				<low>လူကြီးမင်းရဲ့အချက်အလက်များကို ပြင်ဆင်နိုင်ပါသည်</low>
			</center>
			<div class="flex_ce ce">
				<form method="post" action="include.php" target="theIframe" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="changeUserInfo" value="Yes">
					<table>
						<tr>
							<td>Name</td>
							<td><input type="text" name="theName" value="<?php echo $data['name'];?>"></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td><input type="tel" name="thePhone" value="<?php echo $data['phone'];?>" autocomplete="off" disabled></td>
						</tr>
						<tr>
							<td>Password</td>
							<td>
								<div class="flex ce">
									<input id="myPassword" type="pw" name="newUserPassword" value="<?php echo $data['password'];?>"  autocomplete="off">
									<low onclick="showHidePassword('myPassword',this)" class="fas fa-eye" style="margin-left:-30px;cursor: pointer;" title="show password"></low>
								</div>
							</td>
						</tr>
					</table>

					<div class="right p0505"><button>Change</button></div>
				</form>
			</div>
		</div>
	<?php
}
?>