<!-- !Logo & Menu -->
	<div id="header">
		<div class="cAlign">
			<a href="/" id="logoFigure"> Colegio del Arte Mayor de la Seda </a>
			
			<!--Menu Navigator-->
			<ul id="nav">
				<!-- class="activeMenuItem -->
				<?php foreach ($query_main_nav as $row): ?>
				<li> 
					<a href=" <?php echo $row->id ?> "> <?php echo $row->nombre ?> </a>
					<ul>
					<?php foreach ($row->hijos as $subrow): ?>
						<li> <a href=" <?php echo $subrow->id ?> "> <?php echo $subrow->nombre ?> </a> </li>
					<?php endforeach; ?>	
					</ul>
				</li>
				<?php endforeach; ?>
				
								
				<!-- Añadimos entrada para la seccion Usuario del menu de navegacion -->
				<li>
					
				<?php if ($is_logged_in): // esta logueado?? ?>

					<p> <?php echo $user->username; ?> </p>
							
					<?php if ($is_admin): ?>
					<ul class="logSubMenu">
						<li> <a href="admin.php?p=home"> Administracion </a> </li>
						<li> <a href="include/actions/logout.php"> Logout </a> </li>
					</ul>
					<?php else: ?>
					<ul class="logSubMenu">
						<li> <a href="include/actions/logout.php"> Logout </a> </li>
					</ul>
					<?php endif; ?>
							
				<?php else: ?> 
				  <p>LogIn</p>
				  <ul>
					<li>
						<?php 
							$attributes = array('id' => 'signInForm');
							$hidden = array('submitted' => 'TRUE');
							echo form_open('auth/login', $attributes, $hidden);
						?>
							<fieldset>
								<?php 
									$data = array(
									              'name'        => 'name',
									              'id'          => 'sign_in_name',
									              'value'       => 'Usuario...'
									            );
									echo form_input($data); 
								?>
								<?php 
									$data = array(
									              'name'        => 'pass',
									              'id'          => 'sign_in_pass',
									              'value'       => 'Password...'
									            );
									echo form_input($data); 
								?>
								<span>
									<?php echo form_submit('submit', 'LOGIN'); ?>
									<a href="index.php?p=registration"> Registrate </a>
								</span>
									
							</fieldset>
						<?php echo form_close(); ?>
					</li>
				</ul>
				
				<?php endif; ?>
				
				</li>
								
			</ul> <!-- end Menu Navigator-->
			
			<div class="cBoth"></div>
			
		</div>	
	</div> <!-- End Header -->

