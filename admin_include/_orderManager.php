<div class="flex">
	<div class="gbg">
		<div class="sticky_1 ">
			<div>
				<div>
					<input class="dbg m0505" type="" name="" value="" onkeyup="loadBigContent('showOrder=byId&what='+this.value,'orderManagerTable');myScroll(0,0,'');myScroll(0,0,'');" placeholder="enter vocher ID">
				</div>
				<div class="p1010 shadow_1 m0505 dbg " onclick="loadBigContent('showOrder=byDate&what=<?php echo strtotime('today');?>','orderManagerTable');myScroll(0,0,'');myScroll(0,0,'');" id="intervelClick">
					<div class="flex_be ce">Today<span id="pendingCount"></span></div>
					<?php echo date('d-M-Y l');?>
					<script type="text/javascript">
						loadSmallContent('pendingCount=what','pendingCount');
						setInterval(function () {
							loadSmallContent('pendingCount=what','pendingCount');
						}, 10000);
					</script>
				</div>
				<div>
					<?php
					global $connn;
					$sOrderY=$connn->query("SELECT * FROM orders GROUP BY YEAR(theDate) ORDER BY theDate DESC");
					while ($dataY=$sOrderY->fetch_assoc()) {

						$year=date('Y',strtotime($dataY['theDate']));
						?>
						<div class="p1010 dbg shadow_1 m0505">
							<div><?php echo $year;?></div>
							<?php 
							$sOrderM=$connn->query("SELECT * FROM orders WHERE YEAR(theDate)='$year' GROUP BY MONTH(theDate)  ORDER BY theDate DESC");
							while ($dataM=$sOrderM->fetch_assoc()) {
								$month=date('m',strtotime($dataM['theDate']));
								?>
								<div class="p0505">
									<div style="cursor: pointer;" class="flex_be ce" onclick="showHide('','container<?php echo $month.'_'.$year;?>')">
										<span><?php echo date('F',strtotime($dataM['theDate']));?></span>
										<span class="fas fa-angle-down"></span>
									</div><?php 
									$sOrderD=$connn->query("SELECT * FROM orders WHERE MONTH(theDate)='$month' AND YEAR(theDate)='$year' GROUP BY DAY(theDate)  ORDER BY theDate DESC");
									?><div class="hide" id="container<?php echo $month.'_'.$year;?>"><?php
									while ($dataD=$sOrderD->fetch_assoc()) {
										?><div class="p0005" onclick="loadBigContent('showOrder=byDate&what=<?php echo strtotime($dataD['theDate']);?>','orderManagerTable');myScroll(0,0,'');myScroll(0,0,'');"><pre><?php echo date('d-M l',strtotime($dataD['theDate']));?></pre></div><?php 
									}
									?></div><?php
								?></div><?php
							}
						?></div><?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="f1" style="min-height:calc(100vh - var(--height-1));">
		<div id="orderManagerTable">
			<div id="todayResult"></div>
			<script>
				setInterval(loadBigContent('showOrder=byDate&what=<?php echo strtotime('today');?>','todayResult'), 3000);
			</script>
		</div>
	</div>
</div>
