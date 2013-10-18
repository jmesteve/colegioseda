
<div id="bodyContent">
	<div class="inner">
	
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<h1> Registro de Usuario </h1>
			
			<?php 
				$attributes = array('id' => 'regForm', 'class' => 'form_panel');
				$hidden = array('submitted' => 'TRUE');
				echo form_open('members/register', $attributes, $hidden);
			?>
				<fieldset>
					<p>
						<?php echo form_input($name); ?>
						<label for="user_name">Tu nombre</label>
						<?php echo form_error('name', '<label class="error">', '</label>' ); ?>
					</p>
					<p>
						<?php echo form_input($lastname); ?>
						<label for="user_last">Tus apellidos</label>
						<?php echo form_error('lastname', '<label class="error">', '</label>' ); ?>
					</p>
					<p>
						<?php echo form_input($tlf); ?>
						<label for="nick">Tu telefono</label>
						<?php echo form_error('tlf', '<label class="error">', '</label>' ); ?>
					</p>
				</fieldset>
				<fieldset>
					<p>
						<?php echo form_input($nick); ?>
						<label for="nick">Tu nick</label>
						<?php echo form_error('nick', '<label class="error">', '</label>' ); ?>
					</p>
					<p>
						<?php echo form_input($mail); ?>
						<label for="mail">Tu email</label>
						<?php echo form_error('mail', '<label class="error">', '</label>' ); ?>
					</p>
				</fieldset>
				<fieldset>
					<p>
						<?php echo form_password($pass); ?>
						<label for="pass">Tu contraseña</label>
						<?php echo form_error('pass', '<label class="error">', '</label>' ); ?>
					</p>
					<p>
						<?php echo form_password($pass2); ?>
						<label for="pass2">Repita su contraseña</label>
						<?php echo form_error('pass2', '<label class="error">', '</label>' ); ?>	    
					</p>
				</fieldset>
				<fieldset class="no-border">
				 	<?php echo form_submit('submit', 'REGISTRATE'); ?>
				 			
				</fieldset>
			<?php echo form_close(); ?>
			
		</div> <!--end mainContentLeft-->
		<div class="clear"></div>
	
	</div>
</div>