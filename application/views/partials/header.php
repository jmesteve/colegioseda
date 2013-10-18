
<div id="header" class="">
	<div class="inner">
		<div class="topNav">
			<a href="<?php echo base_url();?>" class="logo">
				<img src="<?php echo base_url();?>img/pl5.png" alt="" />
			</a>
			<ul class="menu">
			<?php foreach ($query_main_nav as $row): ?>
				<li> 
					<a href="<?php echo base_url($row['slug']);?>"> <?php echo $row['name'];?> </a>
					<!-- <ul>
					<?php foreach ($row['children'] as $subrow): ?>
						<li> <a href="<?php echo base_url($subrow['slug']);?>"> <?php echo $subrow['name'];?> </a> </li>
					<?php endforeach; ?>
					</ul> -->
				</li>
			<?php endforeach; ?>
				
			</ul>
		</div>
		
		<div class="subNav">
			<ul class="menuSub">
				<?php if ($is_logged_in): // esta logueado?? ?>
					<li><p><?php echo 'Bienvenido, '. $user->username; ?></p></li>
					<?php if ($is_admin): ?> 
						<li><a href="<?php echo base_url("admin/cpanel"); ?>"> Administar </a> </li>
						<li><a href="<?php echo base_url("members/logout"); ?>"> Logout </a> </li>
					<?php else: ?>
						<a href="<?php echo base_url("members/logout"); ?>"> Logout </a>
					<?php endif; ?>
							
				<?php else: ?> 
					<a href="<?php echo base_url("members/login"); ?>"> Login </a>
				<?php endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
		
		<div class="clear"></div>
		<!--<div class="shadow"></div>-->
	</div>
	<div class="clear"></div>
</div>