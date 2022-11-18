<div class="flex">
	<div>
		<div class="sticky_1 ">
			<div>
			</div>
		</div>
	</div>
	<hr>
	<div style="min-height:calc(100vh - var(--height-1));" class="f1">
		<div class="container">
			<div class="itemManagerTable">
				<div class=" sticky_1 bbg">
					<div class="_p0010 flex_be ce">
						<div class="flex ce">
							<big>Item&nbsp;Manager</big>
							<input id="searchItem" type="" name="adminSearch" value="<?php echo @$_REQUEST['adminSearch'];?>" placeholder="search" onkeyup="loadBigContent('itemManagerTable='+this.value,'itemManagerTable'); myScroll(0,0,'');">
						</div>
						<div class="p0010">
							<button onclick="showPopUpData('adminForm=addItem')"><span class="fas fa-plus">&nbsp;</span>ပစ္စည်းသစ်တင်ရန်</button>
						</div>
					</div>
					<div class="flex ce _p0010" style="height: var(--height-2);">
						<div id="id">ID</div>
						<div id="name">NAME</div>
						<div id="brand">BRAND</div>
						<div id="rating">RATING</div>
						<div id="countStock">STOCK</div>
						<div id="action">ACTION</div>
					</div>
				</div>				
				<div id="itemManagerTable">
					 
				</div>		
			</div>
		</div>
	</div>
</div>
