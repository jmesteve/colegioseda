<div class="cBoth"></div>

<!--Main Section-->
<div id="mainSection" class="cAlign">
	
	<?php if ($message !== ''): ?>
	<div id="banners" class="notice">
		
		<h3>Notificaciones</h3>
		<p><?php echo $message; ?></p>
		<!--<img src="http://lorempixum.com/555/100/abstract" alt="" />-->
			
	</div>
	<?php endif; ?>	
	
	
	<h1><?php echo $article['title']; ?></h1>
	
	<?php 
		$attributes = array('id' => 'editForm');
		$hidden = array('submitted' => true);
		echo form_open('admin/editArticulo/'.$article['slug'], $attributes, $hidden);
	?>
		<fieldset>
			
			<p>
				<?php echo form_error('title'); ?>
				<?php echo form_input($title); ?>
			</p>
			<p>
				<?php echo form_error('content'); ?>
				<?php echo form_textarea($content); ?>
			</p>
			<?php echo form_submit('submit', 'Guardar Cambios'); ?>
				   
		</fieldset>
	<?php echo form_close(); ?>
			
	</div>	
		
	<div class="cBoth"></div>
	
</div> <!--end mainSection-->