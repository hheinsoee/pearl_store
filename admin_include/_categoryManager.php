<div class="flex">
	<div>
		<div class="sticky_1 ">
			<div>

			</div>
		</div>
	</div>
	<hr>
	<div class="f1">
		<div style="min-height:80vh;" class="container" id="categoryManagerTable">
			<div class="categoryManagerTable">
				<div class="flex ce _p0010 sticky_1 bbg" style="height: var(--height-2);">
					<div id="cat_1">Main Category <button class="fas fa-plus" onclick="showPopUpData('adminForm=addCat_1')">&nbsp;add</button></div>
					<div id="cat_2">Group <button class="fas fa-plus" onclick="showPopUpData('adminForm=addCat_2')">&nbsp;add</button></div>
					<div id="cat_3">Category <button class="fas fa-plus" onclick="showPopUpData('adminForm=addCat_3')">&nbsp;add</button></div>
				</div>
				
				<?php 
				global $connn;
				$searchCat_1=$connn->query("SELECT * FROM cat_1 ORDER BY name ASC");
				if($searchCat_1->num_rows>0){
					while ($cat_1 = $searchCat_1->fetch_assoc()) {
						$cat_1_id=$cat_1['id'];
						?>
						<div class="flex" id="cat1<?php echo $cat_1_id;?>">
							<div class="p1010 wbg" id="cat_1" oncontextmenu="showPopUpData('adminForm=editCat1&id=<?php echo $cat_1_id;?>');return false;">
								<div class="sticky_2">
									<div id="name"><?php echo $cat_1['name'];?></div>
									<div id="keyword"><i><low><?php echo $cat_1['description'];?></low></i></div>
								</div>
							</div>
							<div class="f1">
								<?php
								$filter2=$cat_1_id.'END';
								$searchCat_2=$connn->query("SELECT * FROM cat_2 WHERE cat_1_id LIKE '%$filter2%' ORDER BY name ASC");
								if($searchCat_2->num_rows>0){
									while ($cat_2 = $searchCat_2->fetch_assoc()) {
										$cat_2_id=$cat_2['id'];
										$photoPath="media/cat/cat2_".$cat_2['id'].".jpg";
										?>
										<div class="flex" id="cat2<?php echo $cat_2_id;?>">
											<div class="p1010 wbg shadow_1" id="cat_2" oncontextmenu="showPopUpData('adminForm=editCat2&id=<?php echo $cat_2_id;?>');return false;">
												<div class="sticky_2">
													<div class="flex">
														<div>
															<?php echo $cat_2['name'];?><br>
															<img src="<?php echo $photoPath."?v=".fileatime($photoPath);?>">
														</div>
														<div>
															<?php echo $cat_2['description'];?>
														</div>
													</div>
												</div>
											</div>
											<div class="f1">
												<?php
												$filter3=$cat_2_id.'END';
												$searchCat_3=$connn->query("SELECT * FROM cat_3 WHERE cat_2_id LIKE '%$filter3%' ORDER BY name ASC");
												if($searchCat_3->num_rows>0){
													while ($cat_3 = $searchCat_3->fetch_assoc()) {
														?>
														<div id="cat_3" class="shadow_1 _p1010 wbg flex ce" oncontextmenu="showPopUpData('adminForm=editCat3&id=<?php echo $cat_3['id'];?>');return false;">
															<div></div>
															<div><?php echo $cat_3['name'];?></div>
															<div><low>ပစ္စည်း </low><b><?php echo fetchData('rows','item','tag_cat_3',$cat_3['id'].'END');?></b><low> ခုရှိပါသည်</low></div>
														</div>
														<?php
													}
												}
												else{
													?>
													<button onclick="showPopUpData('adminForm=delCat2&id=<?php echo $cat_2_id;?>')">DELETE</button>
													<?php
												}
												?>
											</div>
										</div>
										<?php
									}
								}
								else{
									?>
									<button onclick="showPopUpData('adminForm=delCat1&id=<?php echo $cat_1_id;?>')">DELETE</button>
									<?php
								}
								?>
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
