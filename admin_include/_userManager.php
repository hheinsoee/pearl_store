<div class="flex">
	<div>
		<div class="sticky_1 ">
			<div>
			</div>
		</div>
	</div>
	<hr>
	<div style="min-height:calc(100vh - var(--height-1));" class="f1">
		<div class="container" id="userManagerTable">
			<div class="userManagerTable">
				<div class="flex_be sticky_1 bbg" style="height: var(--height-2);">
					<div class="flex ce _p1010">
						<div id="id">ID</div>
						<div id="name">အမည်</div>
						<div id="phone">ဖုန်းနံပါတ်</div>
						<div id="detail">ဝယ်ယူမှုစာရင်း</div>
						<div id="">စာကားဝှက်ပြောင်းရန်</div>
					</div>
					<div class="p0010"></div>
				</div>
				
				<?php 
				global $connn;
				$searchUser=$connn->query("SELECT * FROM user ORDER BY id DESC");
				if($searchUser->num_rows>0){
					while ($user = $searchUser->fetch_assoc()) {
						$user_id=$user['id'];
						?>
						<div>
							<div class="shadow_1 sticky_2 flex ce _p1010 wbg">
								<div id="id">#<?php echo $user['id'];?></div>
								<div id="name"><?php echo $user['name'];?></div>
								<div id="phone"><?php echo $user['phone'];?></div>
								<div id="detail" onclick="showHide('','userManagerById<?php echo $user['id'];?>')">စာရင်း</div>
								<form class="flex" method="post" action="include.php" target="theIframe" enctype="multipart/form-data" ><input type="hidden" name="adminForm" value="changePassword"><input type="hidden" name="userId" value="<?php echo $user['id'];?>"><input type="" name="newPassword" value="" placeholder="New Password"><button>Change</button></form>
							</div>
							<div class="hide" id="userManagerById<?php echo $user['id'];?>">
								<div class="_p1010 stockManagerTable gbg" style="margin:0px 20px 20px 20px;">
									<?php
									$sOrder=$connn->query("SELECT * FROM orders WHERE user_id ='$user_id' ORDER BY theDate DESC");
									if ($sOrder->num_rows>0) {
										$sr=0;
										?><div>ဝယ်ယူမှု အချက်အလက်များ</div><?php
										while($data=$sOrder->fetch_assoc()){
											$sr+=1;
											$orderId=$data['id'];
											$orderStatus=$data['status'];
											$orderTime=date('d-m-Y h:i a',strtotime($data['theDate']));
											if ($orderStatus==0) {
												$style="style='color:#f00;'";
												$status='Cencel';
											}
											elseif ($orderStatus==1) {
												$style="style='color:#ff0;'";
												$status='Pending';
											}
											elseif ($orderStatus==2) {
												$style="style='color:#9f0;'";
												$status='Delivering';
											}
											elseif ($orderStatus==3) {
												$style="style='color:#0f0;'";
												$status='Success';
											}
											?>
											<div class="_p1010 flex ce" onclick="showPopUpData('voucher=<?php echo $orderId;?>')">
												<div <?php echo $style?>><?php echo $sr;?></div>
												<div <?php echo $style?>><?php echo $orderId;?></div>
												<div <?php echo $style?>><?php echo	$orderTime;?></div>
												<div <?php echo $style?>><?php echo $status;?></div>
											</div>
											<?php
										}	
									}
									else{
										?><div>ဝယ်ယူထားခြင်းမရှိသေးပါ</div><?php
									}
									?>
								</div>
							</div>
						</div>
						<?php
					}
				}
				else{
					echo 'no item';
				}

				?>		
			</div>
		</div>
	</div>
</div>
