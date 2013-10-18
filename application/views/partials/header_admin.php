
<div id="header" class="">
	<div class="inner">
		<div class="topNav">
			<a href="<?php echo base_url();?>" class="logo">
				<img src="<?php echo base_url();?>img/pl5.png" alt="" />
			</a>
			<ul class="menu">
				<li> <a href="<?php echo base_url("admin/list/destacados"); ?>"> Destacados </a> </li>
				<li> <a href="<?php echo base_url("admin/list/secciones"); ?>"> Secciones </a> </li>
				<li> <a href="<?php echo base_url("admin/list/eventos"); ?>"> Eventos </a> </li>
				<li> <a href="<?php echo base_url("admin/list/noticias"); ?>"> Noticias </a> </li>
				<li> <a href="<?php echo base_url("admin/list/articulos"); ?>"> Articulos </a> </li>
				<li> <a href="<?php echo base_url("admin/list/users"); ?>"> Usuarios </a> </li>
				
				<li> <a href="<?php echo base_url("admin"); ?>"> CPanel </a> </li>		
				
			</ul>
		</div>
		
		<div class="subNav">
			<ul class="menuSub">
				<?php if ($is_logged_in): // esta logueado?? ?>
					<li><p><?php echo 'Bienvenido, '. $user->username; ?></p></li>
					<?php if ($is_admin): ?>
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
</div>
