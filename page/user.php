<?php

if (isset($_GET['user'])&&isset($_SESSION['userId'])) {
	$userWhat=htmlspecialchars($_GET['user'], ENT_QUOTES, 'UTF-8');
	$userId=$_SESSION['userId'];
	?>

	<div class="flex container">
		<div class="wbg">
			<div class="sticky_2 _p1010">
				
			</div>
		</div>
		<div class="f1 flex_ce container">
			<div>

			<?php
			switch ($userWhat) {
				case 'shoppingHistory':
					global $connn;
					global $connn;
					$searchOrder=$connn->query("SELECT * FROM orders WHERE user_id={$_SESSION['userId']} ORDER BY theDate DESC");
					while ($order=$searchOrder->fetch_assoc()) {
						voucher($order['id']);
					}
					break;
				default:
					# code...
					break;
			}
			?>
				
			</div>
		</div>
	</div>
	<?php
}
else{
	?>
	<div style="height:calc(100vh - var(--height-1) - var(--height-2))">
		<div class="flex_ce ce _p1010" style="height:50vh">
			<div>
				<div class="flex ce _w4 wrap _p0010">
					<large style="color:var(--color-a1);"><b>WELCOME</b></large>
					<div>SignIn လုပ်ပြီးမှသာလျင် ဤစာမျက်နာအားရောက်ရှိမည် ဖြစ်ပါသည်</div>
				</div>
				<div class="p0505">
					<button onclick="showPopUpData('signForm=in')"><span class="fas fa-user">&nbsp;</span>Sign In</button>
					<a href="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?>"><button><span class="fas fa-home">&nbsp;</span>Home</button></a>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		window.top.window.showPopUpData("signForm=in");	
	</script>
	<?php
}

?>