<div id="bodyContent">
	<div class="inner">
		
		<div id="notifications" class="notice">
			
			<p><?php echo $message; ?></p>
				
		</div>
		
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<?php 
				$attributes = array('id' => 'editForm');
				$hidden = array('submitted' => true);
				echo form_open('admin/new/articulo', $attributes, $hidden);
			?>
			
			<h1>Nuevo Articulo</h1>
			
			
			
			<div class="metaHeader">
				<h4>Seccion</h4>
				<?php echo form_dropdown('menus_drop', $droplist, NULL, 'id="selectForm"'); ?>
			</div>
			
			<ul id="articleList">
				<li class="editList">
					<div class="titleSection">
						
						<h4>Titulo</h4>
						<p>
							<?php echo form_error('title'); ?>
							<?php echo form_input($title); ?>
						</p>
						
					</div>
					
					<div class="contentSection">
						
						<h4>Contenido</h4>
						<p>
							<?php echo form_error('content'); ?>
							<?php echo form_textarea($content); ?>
						</p>
						
						<p>
							<?php echo form_checkbox($check); ?>
							Activar
						</p>
						<?php echo form_submit('submit', 'Guardar Cambios'); ?>
							
						
					</div>
					
					<?php echo form_close(); ?>
					
					<div class="clear"></div>
				</li>
			<div class="clear"></div>
			</ul>
		</div> <!--end mainContentLeft-->
	</div>
</div>


<script type="text/javascript">
//$('#contentArticle').wysiwyg();
</script>