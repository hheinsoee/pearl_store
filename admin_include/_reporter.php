<?php
//210 297 A4 Size
global $connn;
if (@$_GET['startDate']=='') {
	$startDate=date('Y-m-01');
}
else{
	$startDate=$_GET['startDate'];
}
if (@$_GET['endDate']=='') {
	$endDate=date('Y-m-d');
}
else{
	$endDate=$_GET['endDate'];
}
$startTime=$startDate.' 00:00:00';
$endTime=$endDate.' 23:59:59';
$sch=$connn->query("
	SELECT  stock_id, COUNT(*) 
	FROM cart 
	INNER JOIN orders 
	ON cart.order_id = orders.id 
	WHERE orders.status=3 AND orders.theDate BETWEEN '$startTime' AND '$endTime'
	GROUP BY(cart.stock_id) 
	ORDER BY SUM(cart.c_price * cart.number) DESC");
?>
<div class="flex">
	<div  class="gbg ">
		<div id="header" class="sticky_1 p1010 dbg r m0505">
			<div>ရောင်းအား အစီရင်ခံချက်</div>
			 <hr>
			 <form>
			 	<input type="hidden" name="admin" value="true">
			 	<input type="hidden" name="manager" value="report">
				<label>Start Date<input type="date" name="startDate" value="<?php echo $startDate;?>"></label>
				<label>End Date<input type="date" name="endDate" value="<?php echo $endDate;?>"></label>
				<div class="right"><button class="right">Report</button></div>
			</form>
		</div>
	</div>
	<hr>
	<div style="min-height:calc(100vh - var(--height-1));" class="f1">
		<div style="width:calc(210mm - 30px);margin:auto;" class="wbg shadow_2 repoter">
			<div class="bbg sticky_1 p0010 flex_be ce" style="height: var(--height-2)">
				<div><?php echo date('d-m-Y',strtotime($startDate));?>&nbsp;<low>မှ</low>&nbsp;<?php echo  date('d-m-Y',strtotime($endDate));?><low>&nbsp;ထိ&nbsp;</low>	</div>
				<div id="TotalSaleAmount">
				</div>		
			</div>
			<div id="header" class="gbg sticky_2">
				<div id="sr">စဉ်</div>
				<div id="item">ပစ္စည်း</div>
				<div id="type">အမျိုးခွဲ</div>
				<div id="numOfTime">အကြိမ်</div>
				<div id="number">အရေအတွက်</div>
				<div id="amount">ရောင်ရငွေ</div>
				<div id="number">အရင်း</div>
				<div id="amount">အမြတ်</div>
			</div>
			<?php $srNo=0; while($data=$sch->fetch_assoc()){  $srNo+=1?>
			<div id="row">
				<div id="sr"><?php echo $srNo;?></div>
				<div id="item">
					<?php echo fetchData('name','item','id',fetchData('item_id','stock','id',$data['stock_id']));?><br>
					<small><low>#<?php echo fetchData('item_id','stock','id',$data['stock_id']);?></low></small>
				</div>
				<div id="type">
					<?php echo fetchData('size','stock','id',$data['stock_id']);?><br>
					<small><low>#<?php echo $data['stock_id'];?></low></small>
				</div>
				<?php
				$schSellStock=$connn->query("SELECT * FROM cart INNER JOIN orders ON cart.order_id = orders.id WHERE cart.stock_id = {$data['stock_id']}");//OnThisTime
					$sellAmount=0;
					$SellNumber=0;
					$ori=0;
				while ($sellData = $schSellStock->fetch_assoc()) {
					$SellNumber =   $sellData['number'] + $SellNumber;

					$ori = ($sellData['ori_price'] * $sellData['number']) + $ori;
					$sellAmount = ($sellData['c_price'] * $sellData['number']) + $sellAmount;
				}
				?>
				<div id="numOfTime"><?php echo number_format($schSellStock->num_rows);?>&nbsp;<small><low>ကြိမ်</low></small></div>
				<div id="number"><?php echo number_format($SellNumber);?>&nbsp;<small><low>ခု</low></small></div>
				<div id="amount"><?php echo number_format($sellAmount);?>&nbsp;<small><low>ကျပ်</low></small></div>
				<div id="amount"><?php echo number_format($ori);?>&nbsp;<small><low>ကျပ်</low></small></div>
				<div id="amount"><?php echo number_format($sellAmount - $ori);?>&nbsp;<small><low>ကျပ်</low></small></div>
			</div>
			<?php 
			$TotalSale = $sellAmount + @$TotalSale;
			$TotalOri= $ori + @$TotalOri;
			$TotalInt= ($sellAmount - $ori) + @$TotalInt;
			} ?>
		</div>
		<script type="text/javascript">
			document.getElementById('TotalSaleAmount').innerHTML="ရောင်းရငွေ&nbsp;<?php echo number_format($TotalSale);?> - <?php echo number_format($TotalOri);?> = <?php echo number_format($TotalInt);?> ကျပ်";
		</script>
	</div>
</div>