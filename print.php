<?php
include 'include.php';
$what=@htmlspecialchars( $_GET['what'], ENT_QUOTES, 'UTF-8');
$id=@htmlspecialchars( $_GET['id'], ENT_QUOTES, 'UTF-8');
global $connn;
switch ($what) {
	//case 'voucher':
		//$data=$connn->query("SELECT * FROM orders WHERE id ={$id}")->fetch_assoc();

	//break;
	
	default:
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title><?php echo $id;?></title>
			<link rel="shortcut icon" type="image/x-icon" href="media/H_logo.png" />
			<link rel="stylesheet" type="text/css" href="style/main.css">
			<link type="text/plain" rel="author" href="humans.txt" />
			<meta name="viewport" content="width=500px, initial-scale=1, minimum-scale=1, user-scalable=no" />
			<!-- <meta http-equiv="content-language" content="en-us" /> -->
			<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
			<meta charset="UTF-8">
			<meta content="utf-8" http-equiv="encoding">
			<meta name="theme-color" content=" rgb(148, 2, 0)" />

			<meta name="robots" content="no">
			<style type="text/css">
				body{background-color:#000;}
				*{font-size: 8pt;}
				#sr,#thePrice,#qty,#cost{text-align: right}
				thead,tfoot{font-weight: 900;}
				@page { size: 58mm auto}
				#printcontent>*{background-color: #fff; width: 58mm;}
			</style>

			<script type="text/javascript">
				function printIt(){
					window.print();
					window.close();
				}
			</script>
		</head>
		<body class="flex_ce">
			<div>
				<div id="printcontent" style="border:1pt solid #f00;"><!-- ################################################################## -->
					<div>
						<div style="min-height: 50mm">
							<table>
								<thead class="">
									<tr>
										<td colspan="5">
											<div class="flex_ce ce">
												<div>Id #123146789 </div>
											</div>
										</td>
									</tr>
									<tr>
										<td id="sr">စဉ်</td>
										<td>ပစ္စည်း</td>
										<td id="thePrice">ဈေးနှုန်း</td>
										<td id="qty">အရေတွက်</td>
										<td id="cost">ကျသင့်ငွေ</td>
									</tr>
								</thead>
								<tbody class="">
									<tr>
										<td id="sr">1</td>
										<td>name</td>
										<td id="thePrice">1000</td>
										<td id="qty">2</td>
										<td id="cost">2000</td>
									</tr>
								</tbody>
								<tfoot class="">
									<tr>
										<td colspan="4" class="right">စုစုပေါင်း</td>
										<td id="cost">2000</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div>
							<company class="_p0005">
								<div><b><?php echo siteInfo('name');?></b>&nbsp;<?php echo siteInfo('title');?></div>
								<div>0925215247 email@mail.com</div>
								<div>address address address</div>
								<center><?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?></center>
							</company>
						</div>
					</div>
				</div>
				<div class="right"><button onclick="printIt()">print</button></div>
			</div>
		</body>
		</html>
		<?php
		break;
}
?>