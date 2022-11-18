<?php
	date_default_timezone_set('Asia/Yangon');
	$today=date('Y-m-d 00:00:00');

	session_start();
	include 'in/setthwe.php';
	include 'in/smsSender.php';
	include 'in/fb.php';
	include 'in/function.php';
	include 'in/session.php';
	include 'in/resizeImg.php';

	include 'in/_action.php';
	
	include 'in/_admin.php';
	include 'in/_order.php';
	include 'in/_user.php';
	include 'in/_rating.php';
	include 'in/_search.php';
	include 'in/_brand.php';
	include 'in/_cart.php';
	include 'in/_stock.php';
	include 'in/_item.php';

	include 'in/parts.php';

	function admin(){
	if (isset($_SESSION['userId'])&&fetchData('userLevel','user','id',$_SESSION['userId'])==3) {
		echo "pass";
	}
}
?>