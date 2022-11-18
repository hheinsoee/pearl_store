<?php 
function isAdmin(){
	if (fetchData('level','user','id',$_SESSION['userId'])>2) {
		return true;
	}
	else{
		return false;
	}
}
//--------------action---------------
// autoSignin
if  (isset($_COOKIE['mhathtar'])&&!@$_COOKIE['mhathtar']==''){
	global $connn;
	$token=$_COOKIE['mhathtar'];
	$checkUser=$connn->query("SELECT * FROM user WHERE token = '$token'");
	if ($checkUser->num_rows == 1) {
		$_SESSION['userId']=$checkUser->fetch_assoc()['id'];	
	}
	else{
		logOut();
	}
}
else{
	logOut();
}
function logOut(){
	if (isset($_SESSION['userId'])||isset($_COOKIE['mhathtar'])) {
		setcookie('mhathtar','', time() - 3600, "/");
		session_destroy();
		?>
		<script type="text/javascript">
			window.top.window.location.reload();
		</script>
		<?php
	}
	else{
		setcookie('mhathtar', '', time() - 3600, "/");
		session_destroy();
	}
}

if (isset($_POST['sign'])) {
	$status='none';
	switch ($_POST['sign']) {
		case 'up':
			$uName=$_POST['userName'];
			$uPhone=$_POST['userPhone'];
			$uPassword=$_POST['userPassword'];
			$uPassword2=$_POST['userPassword2'];
			if ($uName==''||$uPhone==''||$uPassword==''||$uPassword2=='') {
				$theRespondMessage='အချက်အလက်ပြည့်စုံ စွာ ရိုက်ထည့်ပါ';
			}
			elseif($uPassword==$uPassword2){
			$filtered_phone_number = filter_var($uPhone, FILTER_SANITIZE_NUMBER_INT);
     		// Remove "-" from number
		    $phone_to_check = str_replace("-", "", $filtered_phone_number);
		    // Check the lenght of number
		    // This can be customized if you want phone number from a specific country
		    if (strlen($phone_to_check) < 8 || strlen($phone_to_check) > 14) {
		      $theRespondMessage='ဖုန်းနံပါတ်အား မှန်ကန်စွာ ရိုက်ထည့်ပါ';
		    } 
		    else {
					global $connn;
					if($connn->query("SELECT * FROM user WHERE phone = '$uPhone'")->num_rows>0){
						$theRespondMessage= $uPhone.' အား အသုံးပြုလျက် အခြားသော အကောင့်တစ်ခုရှိပြီး ဖြစ်၍ အခြားသော ဖုန်းနံပါတ်ရွေးပါ';
					}
					else{
						$otpCode = rand ( 10000 , 99999);

			    	$token=bin2hex(openssl_random_pseudo_bytes(64));
			      $cookies = hash_hmac('sha256',$token, SECRET_KEY).hash_hmac('sha256',$user_data['id'], SECRET_KEY);
			      setcookie('mhathtar', $cookies, time() + (86400 * 30 * 12 * 10), "/");//10 year

						$connn->query("INSERT INTO user (`name`, `phone`, `password`, `level`, `verify`, `token`) VALUES ('$uName','$uPhone','$uPassword',1,'$otpCode', '$cookies')");

						$status='success';
					}
				}
			}
			else{
				$theRespondMessage='Password နှစ်ခု တူညီမှုမရှိပါ ဤ password အား နောက်အကြိမ်များတွင် Sign In လုပ်ရန် မှတ်ထားသင့်ပါသည်။';
			}
			break;
		case 'in':
			$uPhone=$_POST['userPhone'];
			$pWord=$_POST['userPassword'];
			if ($uPhone=='') {
				$theRespondMessage='Phone Number ရိုက်ထည့်ပါ';
			}
			elseif ($pWord=='') {
				$theRespondMessage='Password ရိုက်ထည့်ပါ';
			}
			else{
				global $connn;
				$checkUsername=$connn->query("SELECT * FROM user WHERE phone = '$uPhone'");
				$user_data=$checkUsername->fetch_assoc();
				if ($checkUsername->num_rows>0) {
					if ($pWord==$user_data['password']) {
				    	//$_SESSION['userId']=$user_data['id'];
				    	$token=bin2hex(openssl_random_pseudo_bytes(64));
				      $cookies = hash_hmac('sha256',$token, SECRET_KEY).hash_hmac('sha256',$user_data['id'], SECRET_KEY);
				      setcookie('mhathtar', $cookies, time() + (86400 * 30 * 12 * 10), "/");//10 year

				    	$connn->query("UPDATE user SET resetPassCode=0 , token = '$cookies' WHERE phone = '$uPhone' ");
						$status='success';
					}
					elseif($pWord==$user_data['resetPassCode']&&$user_data['resetPassCode']!=0){
				     	//$_SESSION['userId']=$user_data['id'];
				    	$token=bin2hex(openssl_random_pseudo_bytes(64));
				      $cookies = hash_hmac('sha256',$token, SECRET_KEY).hash_hmac('sha256',$user_data['id'], SECRET_KEY);

				      setcookie('mhathtar', $cookies, time() + (86400 * 30 * 12 * 10), "/");//10 year
				    	$connn->query("UPDATE user SET password='', token = '$cookies' WHERE phone = '$uPhone'");
					 		$status='success';
					}
					else{
						$theRespondMessage='password မှန်ကန်မှုမရှိပါ';
					}
				}
				else{
					$theRespondMessage=$uPhone.' ဖြင့် အကောင့် ဖွင့်ထားခြင်း မရှိသေးပါ';
				}
			}
			break;
		case 'out':
			logOut();
			break;
		case 'resetPassword':
			$userPhone = htmlspecialchars( $_POST['userPhone'], ENT_QUOTES, 'UTF-8');
			$filtered_phone_number = filter_var($userPhone, FILTER_SANITIZE_NUMBER_INT);
     		// Remove "-" from number
		    $phone_to_check = str_replace("-", "", $filtered_phone_number);
		    // Check the lenght of number
		    // This can be customized if you want phone number from a specific country
		    if (strlen($phone_to_check) < 8 || strlen($phone_to_check) > 14) {
		      $theRespondMessage='ဖုန်းနံပါတ်အား မှန်ကန်စွာ ရိုက်ထည့်ပါ';
		    } 
		    else{
				global $connn;
				if ($connn->query("SELECT phone FROM user WHERE phone = {$userPhone}")->num_rows>0) {
					$passcode=rand ( 100000 , 999999);//create passcode
					$connn->query("UPDATE user SET resetPassCode='$passcode' WHERE phone = '$userPhone'");
					$text='လူကြီးမင်းရဲ့ အကောင့်အား ဝင်ရောက်ရန် ယာယီ password '.$passcode.' အားသုံးပါ';
					$theRespondMessage=$userPhone.'အား ယာယီ password တစ်ခု ပို့ပေးပါလိမ့်မည်<br>၎င်း password အားအသုံးပြုလျက် Sign In ဝင်ပါ';
					?>
					<script type="text/javascript">
						window.top.window.showPopUpData('signForm=in');
					</script>
					<?php

					smsSender($userPhone,$text);
				}
				else{
					$theRespondMessage= $userPhone.' ဖြင့် အကောင့်ဖွင့်ထားခြင်းမရှိသေးပါ';
				}
			}
			break;
	}

	if ($status=='success') {
		?>
		<script type="text/javascript">
			window.top.window.location.reload();
		</script>
		<?php
	}
	else{
		?>
		<script type="text/javascript">
			window.top.window.showAlerm('<?php echo $theRespondMessage;?>');
		</script>
		<?php
	}
}


//-------------FORM-------------------


if (isset($_REQUEST['signForm'])) {
	sign($_REQUEST['signForm']);
}
function sign($action){
	switch ($action) {
		case 'resetPassword':
			?>
			<form class="wbg p1010 r shadow_1h" method="post" action="include.php"  enctype="multipart/form-data" target="theIframe">
				<input type="hidden" name="sign" value="resetPassword">
				<center style="max-width: 300px;">
					<small>သင့်အကောင့်၏ဖုန်းနံပါတ်အား sign in လုပ်နိုင်သော  ယာယီ password တစ်ခု ပို့ပေးပါလိမ့်မည်။ ကျေးဇူးပြ၍ သင့်အကောင့်ဖုန်းနံပါတ်အား ရိုက်ထည့်ပါ</small>
					<br><hr>
					<br>
					<div style="max-width: 200px;">
						<label>အကောင့်၏ဖုန်းနံပါတ်<input type="" name="userPhone" placeholder="အကောင့်၏ဖုန်းနံပါတ်"></label>
						<div class="flex _f1"><button>ယာယီသုံး password ပို့ရန်</button></div>
					</div>
				</center>
			</form>
			<?php
			break;
		case 'in':
			?>
			<div>
				<center>
				<img src="media/H_logo.png?v=<?php echo filemtime('media/H_logo.png');?>" style="max-height: 80px;margin-bottom: -20px;">
				<div class="lbg p1010 r shadow_1" style="max-width: 280px">
					<div id="signFormIn">
						<center>
							<div><big>Sign In</big></div>
						</center>
						<br>
						<form method="post" action="include.php"  enctype="multipart/form-data" target="theIframe">
							<input type="hidden" name="sign" value="in">
							<div class="flex ce"><span class="fas fa-phone">&nbsp;</span><input type="username" name="userPhone" placeholder="09 Phone Number" value="09"></div>
							<div class="flex ce"><span class="fas fa-lock">&nbsp;</span><input type="password" name="userPassword" placeholder="password"></div>
							<hover><span onclick="showPopUpData('signForm=resetPassword')">password မေ့သွားပြီလား?</span></hover>
							<div class="right"><br><button>Sign In</button></div>
						</form>
						<div><br><a onclick="changeSignForm('In','Up')">အကောင့်မရှိသေးပါ အသစ်လုပ်မည်</a></div>
					</div>
					<div id="signFormUp" class="hide">
						<center>
							<div><big>Sign Up</big></div>
							<low>အကောင့်သစ်လုပ်ရန် <br>အချက်အလက်များ ဖြည့်ပေးပါ</low>
						</center>
						<br>
						<form method="post" action="include.php"  enctype="multipart/form-data" target="theIframe">
							<input type="hidden" name="sign" value="up">
							<div class="flex ce"><span class="fas fa-user">&nbsp;</span><input type="username" name="userName" placeholder="Your Name"></div>
							<div class="flex ce"><span class="fas fa-phone">&nbsp;</span><input type="tel" name="userPhone" placeholder="09 Phone Number" value="09"></div>
							<div class="flex ce"><span class="fas fa-lock">&nbsp;</span><input type="password" name="userPassword" placeholder="Password"></div>
							<div class="flex ce"><span class="fas fa-lock">&nbsp;</span><input type="password" name="userPassword2" placeholder="Confirm password"></div>
							<div class="right"><button>Sign Up</button></div>
						</form>
						<br>
						<a onclick="changeSignForm('Up','In')">အကောင့်ရှိသည် Sign In လုပ်မည်</a>
					</div>
				</div>
				</center>
			</div>
			<?php
			break;
		case 'out':
			?>
			<div class="p1010 m0505 wbg r shadow_l">
				<center>
					<img src="media/H_logo.png?v=<?php echo filemtime('media/H_logo.png');?>" style="max-height: 80px;padding:20px;"><br>
					<big style="color:var(--color-a1)">Sign Out?</big>
					<br>
					<i>Sign Out ထွက်ရန်သေချာပါသလား</i>
					<form method="post" action="include.php"  enctype="multipart/form-data" target="theIframe">
						<input type="hidden" name="sign" value="out">
						<div><button>Sign&nbsp;Out</button></div>
					</form>
				</center>
			</div>
			<?php
			break;
	}
}

if (isset($_POST['otpCode'])) {
	if (isset($_SESSION['userId'])) {
		global $connn;
		$dataOpt=$connn->query("SELECT * FROM user WHERE id = {$_SESSION['userId']} AND verify != 'verify'")->fetch_assoc()['verify'];
		if ($dataOpt==$_POST['otpCode']) {
			$connn->query("UPDATE `user` SET `verify`='verify' WHERE id={$_SESSION['userId']} ");
			?>
			<script type="text/javascript">
				window.top.window.location.reload();
			</script>
			<?php
		}
		else{
			$theRespondMessage='ကုဒ် မှားနေပါသည်';
			?>
			<script type="text/javascript">
				window.top.window.showAlerm('<?php echo $theRespondMessage;?>');
			</script>
			<?php
		}
	}
}

if (isset($_REQUEST['otpCodeForm'])) {
	otpCodeForm();
}
function otpCodeForm(){
	if (isset($_SESSION['userId'])) {
		?>
		<div class="wbg r p1010">
			<center>
				လူကြီးမင်းရဲ့ ဖုန်းနံပါတ်အား<br>အတည်ပြုပြီးမှသာလျင်<br>အကောင့်အား အသုံးပြုနိုင်မည်ဖြစ်ပါသည်
				<br><?php echo fetchData('phone','user','id',$_SESSION['userId']);?> မှ
				<?php resentCode();?>
				<br><low><?php echo fetchData('phone','user','id',$_SESSION['userId']);?> ဖုန်း၏ Message မှ ရရှိသော<br>၎င်း ကုဒ် ၅ လုံးအား<br>ဤနေရာတွင်ဖြည့်ပြီး အတည်ပြုပါ</center></low>
			</center>
			<div class="p1010">
				<form method="post" action="include.php"  enctype="multipart/form-data" target="theIframe">
					<input type="" name="otpCode" value="" placeholder="ကုဒ်အား SMS တွင် ကြည့်ပါ">
					<div class="flex _f1"><button>အတည်ပြုသည်</button></div>
				</form>
			</div>
			<center>------OR------</center>
			<form method="post" action="include.php"  enctype="multipart/form-data" target="theIframe">
				<input type="hidden" name="sign" value="out">
				<div class="right">သို့မဟုတ် <button>Sign&nbsp;Out</button> လုပ်ပါ</div>
			</form>
		</div>
		<?php
	}
}

function resentCode(){
	?>
	<form method="post" action="include.php"  enctype="multipart/form-data" target="theIframe">
		<input type="submit" name="resentOTPCode" value="ကုဒ် ရယူရန်နိပ်ပါ" style="color:#f00">
	</form>
	<?php
}
if (isset($_POST['resentOTPCode'])) {
	if (isset($_SESSION['userId'])) {

		$userPhone=fetchData('phone','user','id',$_SESSION['userId']);
		$uName=fetchData('name','user','id',$_SESSION['userId']);
		$otpCode=fetchData('verify','user','id',$_SESSION['userId']);
		$phone=$userPhone;
		$text='မဂ်လာပါ '.$uName.' H အကောင့်အားအတည်ပြုရန် '.$otpCode.' ကိုသုံးပါ';
		?>		
		<script type="text/javascript">
			window.top.window.resentOTPCodeButton();
		</script>
		<?php	
		smsSender($phone,$text);	
	}
}
?>