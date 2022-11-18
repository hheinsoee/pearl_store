<?php include 'include.php';?>
<!DOCTYPE html>
<html lang="mm">
<head>
	<?php head();?>
	<?php fb_platform();?>
</head>

<body id="theBody">	
	<div id="forceLayer">
	<?php
	if (isset($_SESSION['userId'])) {//force
		global $connn;
		$data=$connn->query("SELECT * FROM user WHERE id = {$_SESSION['userId']}")->fetch_assoc();
		if ($data['verify']!='verify') {
			?>
			<div style="position: fixed;top:0;right: 0;bottom: 0;left: 0;z-index: 9999; background: rgba(0,0,0,0.7);">
				<div class="flex_ce ce" style="height: 100vh;">
				<?php otpCodeForm();?>
				</div>
			</div>
			<?php
		}
		if ($data['password']=='') {
			?>
			<div style="position: fixed;top:0;right: 0;bottom: 0;left: 0;z-index: 999; background: rgba(0,0,0,0.7);">
				<div class="flex_ce ce" style="height: 100vh;">
					<div class="wbg r" style="background-color:#0005">
						<center style="padding:10px 0px;color:#fff;">
							ယခင် password အား ဖျက် ထားပါသဖြင့်<br><big><b>password သစ် တစ်ခုထည့်ပါရန်</b></big>
						</center>
						<?php userInfoEditForm();?>
					</div>
				</div>
			</div>
			<!-- <script>
				//showPopUpData('userInfoEditForm=true');
			</script> -->
			<?php
		}
	}?>	
	</div>

	<div style="z-index:999;position: relative;">
		<div id="crosspenel"></div>
		<div id='alermElement'></div>
		<div class="notiPanel" id='notiPanel'></div>
		<div id="showPopUpLayout"></div>
	</div>
	

	<div id="bodyLayer">
		<?php include "page/pageManager.php";?>
	</div>
	
<div style="position: relative;">
	<iframe src="" id="" name="theIframe" style="
display: none;
position: fixed;
width:300px;
bottom: 0;
background: #0009;
height: 150px;z-index: 999999!important;
border:none;
color:#f99;
"></iframe>
</div>
	<!-- <a style="position: fixed;z-index:99;width:40px;height:40px;border-radius: 50%;bottom: 20px;right:20px;" onclick="myScroll(0,0,'');" class="flex_ce ce fas fa-arrow-up bbg" title="go to top">
	</a> -->
<div style="
position:fixed;
bottom:0;
left:0;
background-color:#f00;
color:#fff;
z-index:99999;
">
ဤwebsite တွင်ရှိသော အချက်အလက်များသည် dataအမှန် မဟုတ်ပဲ sample အနေဖြင့် ပြသထားခြင်းသာဖြစ်သည်။<br/>Admin Account အားဝင်ရောက်ရန် 09252152447 ကိုဆက်သွယ်ပါ
</div>
</body>
</html>