<div class="flex">
	<div>
		<div class="sticky_1 ">
			<div>
			</div>
		</div>
	</div>
	<hr>
	<div style="min-height:calc(100vh - var(--height-1));" class="f1">
		<div class="container" id="brandManagerTable">
			<div class="brandManagerTable">
				<div class="flex_be sticky_1 bbg" style="height: var(--height-2);">
					<div class="flex ce _p1010">
						<div id="id">ID</div>
						<div id="logo">တံဆိပ် လိုဂို</div>
						<div id="name">တံဆိပ် အမည်</div>
						<div id="title">တံဆိပ် အမျိုးအစား</div>
					</div>
					<div class="p0010"><button onclick="showPopUpData('adminForm=addBrand')"><span class="fas fa-plus"></span>&nbsp;တံဆိပ်သစ်ထည့်ရန်</button></div>
				</div>
				
				<?php 
				global $connn;
				$searchBrand=$connn->query("SELECT * FROM brand ORDER BY id DESC");
				if($searchBrand->num_rows>0){
					while ($brand = $searchBrand->fetch_assoc()) {
						$brand_id=$brand['id'];
						$photoPath="media/brand/brand_".$brand['id'].".jpg";
						?>
						<div>
							<div class="shadow_1 sticky_2 flex ce _p1010 wbg" onclick="showHide('','brandManagerById<?php echo $brand['id'];?>')">
								<div id="id">#<?php echo $brand['id'];?></div>
								<div id="logo"><img src="<?php echo $photoPath.'?v='.filemtime($photoPath);?>"></div>
								<div id="name"><?php echo $brand['name'];?></div>
								<div id="title"><?php echo $brand['title'];?></div>
							</div>
							<div class="hide" id="brandManagerById<?php echo $brand['id'];?>">
								<div class="_p1010 stockManagerTable gbg">
									<div>တံဆိပ် အချက်အလက်များအား ဤနေရာ၌ ပြန်ပြင်နိုင်ပါသည်</div>
									<form method="post" action="include.php" target="theIframe" enctype="multipart/form-data" class="flex _flex ce _ce _p1010">
										<img src="<?php echo $photoPath.'?v='.filemtime($photoPath);?>" style="height: 40px;" onclick="document.getElementById('addPhoto<?php echo $brand_id;?>').click()" id="addPhotoViewer<?php echo $brand_id;?>" >
										<input type="file" name="thePhoto" style="display: none;" id="addPhoto<?php echo $brand_id;?>" onchange="displaySelectedImage(this,'addPhotoViewer<?php echo $brand_id;?>')" accept="image/jpeg">
										<input type="hidden" name="adminForm" value="updateBrand">
										<input type="hidden" name="brandId" value="<?php echo $brand_id;?>">
										<label>Brand&nbsp;Name&nbsp;:<input type="" name="theName" placeholder="Brand Name" value="<?php echo $brand['name'];?>"></label>
										<label>Brand&nbsp;TItle&nbsp;:<input type="" name="theTitle" placeholder="Brand Title" value="<?php echo $brand['title'];?>"></label>
										<button><span class="fas fa-check">&nbsp;</span>Save</button>
									</form>
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
