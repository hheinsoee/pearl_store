<div class="scr1" style="z-index: 99999!important;position:fixed;top:0;bottom:0;right: 0;left: 0;background-color:#a00;color:#fff">
	<div class="flex_ce ce p1010" style="height:100vh;">
		<div style="font-size: 18pt;">Computer သို့မဟုတ်<br>screen size အလျား 1000 pixel နှင့် အထက်ရှိသော<br>Device ဖြင့်ဤစာမျက်နာကိုဖွင့်ပါ Bro</div>
	</div>
</div>
<div style="background-color: #999">
<?php
	if (isset($_SESSION['userId'])) {
		if (fetchData('level','user','id',$_SESSION['userId'])==3) {
			_adminPath('nav');
			?><div style="padding-top:var(--height-1);"> <?php
			if (isset($_GET['manager'])) {
				
				switch (htmlspecialchars($_GET['manager'], ENT_QUOTES, 'UTF-8')) {
					case 'category':
						include 'admin_include/_categoryManager.php';
						break;
					case 'report':
						include 'admin_include/_reporter.php';
						break;
					case 'brand':
						include 'admin_include/_brandManager.php';
						break;
					case 'item':
						include 'admin_include/_itemManager.php';
						break;
					case 'order':
						include 'admin_include/_orderManager.php';
						break;
					case 'user':
						include 'admin_include/_userManager.php';
						break;
				}

			}
			else{
				include 'admin_include/_orderManager.php';
			}
			?></div><?php
		}
		else{
			echo "u r not admin";
		}
	} 
	else{
		?>
		<div class="flex_ce ce" style="min-height: 80vh;z-index: 99;position: relative;"><?php 
		sign('in');
		?></div>
		<div style="position:fixed;top:0;right: 0;left: 0;bottom:0;background-image:url(media/shopping.jpg);filter: saturate(1) blur(10px);-z-index: -999;background-size: cover;opacity: 0.3;background-position: center;">
		</div><?php
	}
	?>
</div>