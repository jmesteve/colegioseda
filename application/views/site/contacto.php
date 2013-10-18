<div id="bodyContent">
	<div class="inner">
		
		<div id="mainContent" class="left content-box drop-shadow lifted">
		
			
			<h1>Contacto</h1>
			<div class="titleSection">
			<p> Puede ponerse en contacto con nosotros rellenando el formulario disponible a continuacion. </p>
			<p>	Nos pondremos en contacto con usted tan pronto como nos sea posible. </p>
			</div>
			<div class="sectionSeparator"></div>
			
			<div class="titleSection">
				<div class="oneHalf"> 
								
					<p><strong>Submit your story</strong></p> 
					<p>Si tienes algo que te gustaria contarnos, una sugerencia, o simplemente te apetece saludarnos, 
						<a href="mailto:story@basics.com">mandanos un email</a>
						.
					</p> 
					<p>Nosotros lo leeremos y trataremos de responderte.</p> 
								
				</div> <!-- end oneHalf --> 
				 
				<div class="oneHalf"> 
								
					<p><strong>Informacion de contacto</strong></p> 
					<p>Email: 
						<a href="mailto:contact@colegiodelartemayordelaseda.es">contact@colegiodelartemayordelaseda.es</a>
					</p> 
					<p>Pagina Web: <a href="www.colegiodelartemayordelaseda.es">www.colegiodelartemayordelaseda.es</a></p> 
								
				</div> <!-- end oneHalf --> 
				<div class="clear"></div>
			</div>
			
			<div class="sectionSeparator"></div>
			
			<div class="controlButtonsSection">
			<?php 
				$attributes = array('id' => 'contactForm');
				$hidden = array('submitted' => true);
				echo form_open('contacto', $attributes, $hidden);
			?>
				<!--<fieldset>-->
					<p><?php echo $message; ?></p>
					<p>
						<?php echo form_error('name'); ?>
						<?php echo form_input($name); ?>
						<label for="contactName">Tu nombre <span>(obligatorio)</span></label>
					</p>
					<p>
						<?php echo form_error('email'); ?>
						<?php echo form_input($email); ?>
						<label for="contactEmail">Tu email <span>(obligatorio)</span></label>
					</p>
					<p>
						<?php echo form_error('comment'); ?>
						<?php echo form_textarea($comment); ?>
					</p>
					<?php echo form_submit('submit', 'Enviar Mensaje'); ?>
						   
				<!--</fieldset>-->
			<?php echo form_close(); ?>
			</div>
		
		<!--<input type="text" id="contactName" name="name" />--> 
		<!--<input type="text" id="contactEmail" name="email" />--> 
		<!--<textarea name="message" id="contactMessage" cols="30" rows="10"></textarea>--> 
	
		</div>
			
		<?php if (isset($template['partials']['sidebar'])) { echo $template['partials']['sidebar']; } ?>		
	</div>
</div>