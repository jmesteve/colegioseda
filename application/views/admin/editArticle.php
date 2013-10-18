<div id="bodyContent">
	<div class="inner">
		
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<h1>Editar Articulo</h1>
			<?php 
				$attributes = array('id' => 'editForm');
				$hidden = array('submitted' => true);
				echo form_open('admin/edit_articulo/'.$article['id'], $attributes, $hidden);
			?>
			
			
			
			 <div class="metaHeader">
				<p> <h2><?php echo $article['title'] ? $article['title'] : 'Nuevo Articulo'; ?></h2> en <?php echo form_dropdown('menus_drop', $droplist, $article['sectionId'], 'id="selectForm"'); ?></p>
				
				<div class="clear"></div>
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
							<?php echo form_submit($submit); ?>
							
							<?php if ($article['active']): ?>
								<a id="editBttn" href="/admin/deactivate/articlo/<?php echo $article['id']; ?>" class="buttonLink actionBttn notice"> Desactivar </a>
							<?php else: ?>
								<a id="editBttn" href="/admin/activate/articulo/<?php echo $article['id']; ?>" class="buttonLink actionBttn notice"> Activar </a>
							<?php endif; ?>
							
							<a href="/admin/delete/articulo/<?php echo $article['id']; ?>" class="buttonLink deleteBttn notice"> Eliminar </a>
							
						<?php echo form_close(); ?>
					</div>
					
					<?php if (isset($article['images']) && !empty($article['images']) ):?>
					<div class="gallerySection">
						<h3>Galeria</h3>
						<ul>
						<?php foreach ($article['images'] as $img):?>
							<li class="removable">
								<!--<a href="/gallery/<?php echo $news['id'].'/'.$img['id'];?>">-->
								<a href="/img/uploads/<?php echo $img['name'];?>" title="" class="show">
									<img src="/scripts/timthumb.php?src=/img/uploads/<?php echo $img['name'];?>&h=80&w=80&zc=1" width="80" height="80" alt=""/>
									<!--<img src="/img/uploads/thumb_<?php echo $img['name'];?>" alt="" />-->
									
								</a>
								<a href="/admin/delete/image/<?php echo $img['id'];?>" class="remove"></a>
								<a href="/admin/edit/destacado/articulo/<?php echo $img['id'];?>" class="destacar"></a>
							</li>
						<?php endforeach;?>
						</ul>
						<div class="clear"></div>
					</div>
					<?php endif;?>
					
						
					
					<div class="controlButtonsSection">
						<h4>Subir Imagen</h4>
						<?php 
							$attributes = array('id' => 'uploadForm');
							echo form_open_multipart('admin/upload/articulo', $attributes);
						?>
							
						<?php echo form_hidden('articleId', $article['id']);?>
						<p>
							<input type="file" name="userfile" />
							
						</p>
						<h4>Descripcion</h4>
						<p>
							<input type="text" name="desc"/>
						</p>
						<p>
							<input type="submit" value="upload" />
						</p>
						</form>
					</div>
					
					<div class="clear"></div>
				</li>
			<div class="clear"></div>
			</ul>
		</div> <!--end mainContentLeft-->
	</div>
</div>

<script type="text/javascript">
// And now convert textarea #wysiwyg into Wysywyg editor.

//$('#contentArticle').wysiwyg();

$(function() {
 	$('.remove').click( function() {
			 var where_to = confirm("¿Deseas realmente borrar este imagen?");
 	       	 if (where_to== true)
 	       	 {
 	       	 	$.get( $(this).attr('href'), 
 	       	 			function( msg ) {
		 	            	 if ( msg.status ) {
		 	            	 	//var current = "http://" + $(location).attr('host') + '/admin/list/articulos';
		 	            	 	//document.location.href = current;
		 	            	 	location.reload();
		 	            	 } else {
		 	            	 	alert( "Se ha producido algun error: " + msg.status );
		 	            	 }
 	         	}, "json");
 	         }
 	         return false; // don't follow the link!
 	});
 });
 
 $(function() {
  	$('.destacar').click( function() {
 			 var where_to = confirm("¿Deseas realmente destacar esta imagen?");
  	       	 if (where_to== true)
  	       	 {
  	       	 	return true;
  	         }
  	         return false; // don't follow the link!
  	});
  });
  
$(function() {
 	$('.deleteBttn').click( function() {
			 var where_to = confirm("¿Deseas realmente borrar este articulo?");
 	       	 if (where_to== true)
 	       	 {
 	       	 	$.get( $(this).attr('href'), 
 	       	 			function( msg ) {
		 	            	 if ( msg.status ) {
		 	            	 	//var current = "http://" + $(location).attr('host') + '/admin/list/articulos';
		 	            	 	//document.location.href = current;
		 	            	 	location.reload();
		 	            	 } else {
		 	            	 	alert( "Se ha producido algun error: " + msg.status );
		 	            	 }
 	         	}, "json");
 	         }
 	         return false; // don't follow the link!
 	});
 });
 
 $(function() {
  	$('.actionBttn').click( function() {
 			$.get( $(this).attr('href'), 
	       	 			function( data ) {
		 	            	 if ( data.status ) {
		 	            	 	$(this).parent().parent().slideUp('slow').delay(500);
		 	            	 	$('#notifications').children('p:first').text(data.message);
		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
		 	            	 } else {
		 	            	 	$('#notifications').children('p:first').text(data.message);
		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
		 	            	 }
  	         }, "json");
  	         return false; // don't follow the link!
  	});
  });
</script>