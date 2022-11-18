<?php
if(isset($_REQUEST['admin'])){
	include 'page/admin.php';
}
else{
	?>
	<div style="padding:calc(var(--height-1) + var(--height-2)) 0px var(--height-3) 0px;min-height:calc(100vh - 150px - var(--height-2) - var(--height-3))">
		
		<div>
			<?php
			if(isset($_REQUEST['search'])){
				mainNav('home');
				include 'page/search.php';
			}
			elseif(isset($_REQUEST['cat'])){
				mainNav('home');
				include 'page/category.php';
			}

			elseif(isset($_REQUEST['item'])){
				mainNav('home');
				include 'page/item.php';
			}

			elseif(isset($_REQUEST['brand'])){
				mainNav('home');
				include 'page/brand.php';
			}
			elseif(isset($_REQUEST['user'])){
				mainNav('user');
				include 'page/user.php';
			  footer();
			}
			else{
				mainNav('home');
				include 'page/home.php';
			  footer();
			}
			?>
		</div><!-- error -->
		<!-- <div class="scr4 scr3" style="width: var(--width-1);">
			<div class="sticky_2" style="height: calc(100vh - var(--height-1) - var(--height-2))">
				<div class="_m0505" style="display: flex;flex-direction: column;justify-content: flex-end;height: calc(100vh - var(--height-1) - var(--height-2) - var(--height-3));padding-bottom:var(--height-3) ; ">
					<?php 
					//if (isset($_SESSION['userId'])) {?>
						<div id="miniCartContainer" style="width: 260px;">
							<?php //cart('mini');?>
						</div><?php 
					//}
					//else{
						?><div class="flex_ce ce"><?php //sign('in');?></div><?php
					//}
					?>
				</div>
			</div>
		</div> -->
		<div style="position: fixed;right:0;bottom: var(--height-3);z-index: 9;border-radius: 10px;	"  class="shadow_2 scr4 scr3">
			<?php 
				if (isset($_SESSION['userId'])) {?>
					<div id="miniCartContainer" style="width: 260px;">
						<?php cart('mini');?>
					</div><?php 
				}
				else{
					
				}
				?>
		</div>
	</div>
	<?php
}
?>