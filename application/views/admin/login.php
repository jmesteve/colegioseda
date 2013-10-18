<div id="bodyContent">
	<div class="inner">
	
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<h1> Log In </h1>
			
			<?php 
				$attributes = array('id' => 'signInForm', 'class' => 'form_panel');
				$hidden = array('submitted' => 'TRUE');
				echo form_open('admin', $attributes, $hidden);
			?>
				<fieldset>
				
					<div id="infoMessage"><?php echo $message; ?></div>
					<p>
						<?php echo form_input($username); ?>
						<!--<label for="user_name">Nombre de usuario</label>-->
					</p>
					<p>
						<?php echo form_password($password); ?>
						<!--<label for="user_pass">Contraseña</label>-->
					</p>
				</fieldset>
				
				<fieldset class="no-border">	
					<?php echo form_submit('submit', 'LOG IN'); ?>
		   		</fieldset>
			<?php echo form_close(); ?>
						
			<div class="cBoth"></div>
			
		</div> <!--end mainContentLeft-->
	</div>
</div>
