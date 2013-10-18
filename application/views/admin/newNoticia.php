<div id="bodyContent">
	<div class="inner">
		
		<div id="notifications" class="notice">
			
			<p><?php echo $message; ?></p>
				
		</div>
		
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<?php 
				$attributes = array('id' => 'editForm');
				$hidden = array('submitted' => true);
				echo form_open('admin/new/noticia', $attributes, $hidden);
			?>
			
			<h1>Nueva Noticia</h1> 
			
			<div class="metaHeader">
				<h4>Tags</h4>
				
				<?php echo form_error('item'); ?>
				<ul id="demo1" name="tags_array[]">
				</ul>
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
						
						<h4>Fuente (*Opcional)</h4>
						<p>
							<?php echo form_error('source_name'); ?>
							<?php echo form_input($source_name); ?>
						</p>
						<p>
							<?php echo form_error('source'); ?>
							<?php echo form_input($source); ?>
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

    $(document).ready(function() {
    	$.ajax({
    	   url: '/admin/test',
    	   dataType: 'json',
    	   success:function (data){
    	   
    	      $("#demo1").tagit({
    	      	availableTags: data.tags
    	      });
    	   }
    	});
        
    });
</script>