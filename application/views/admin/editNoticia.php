<div id="bodyContent">
	<div class="inner">
		
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<h1>Editar Noticia</h1>
			<?php 
				$attributes = array('id' => 'editForm');
				$hidden = array('submitted' => true);
				echo form_open('admin/edit_noticia/'.$noticia['id'], $attributes, $hidden);
			?>
			
			 <div class="metaHeader">
				<h2><?php echo $noticia['title']; ?></h2>
				
			</div>
			
			<ul id="articleList">
				<li class="editList">
					<div class="titleSection">
						
						<p>
						<h4>Tags</h4>
							<?php echo form_error('item'); ?>
							<ul id="demo1" name="tags_array[]">
							<?php foreach ($noticia['tags'] as $tag):?>
								<li><?php echo $tag['name']; ?></li>
							<?php endforeach; ?>
							</ul>
						</p>
						
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
							
							<?php echo form_submit($submit); ?>
							<?php if ($noticia['active']): ?>
								<a id="editBttn" href="/admin/deactivate/noticia/<?php echo $noticia['id']; ?>" class="buttonLink actionBttn notice"> Desactivar </a>
							<?php else: ?>
								<a id="editBttn" href="/admin/activate/noticia/<?php echo $noticia['id']; ?>" class="buttonLink actionBttn notice"> Activar </a>
							<?php endif; ?>
							
							<a href="/admin/delete/noticia/<?php echo $noticia['id']; ?>" class="buttonLink deleteBttn notice"> Eliminar </a>
							
						<?php echo form_close(); ?>
					</div>
					
					<?php if (isset($noticia['images']) && !empty($noticia['images']) ):?>
					<div class="gallerySection">
						<h3>Galeria</h3>
						<ul>
						<?php foreach ($noticia['images'] as $img):?>
							<li class="removable">
								<!--<a href="/gallery/<?php echo $news['id'].'/'.$img['id'];?>">-->
								<a href="/img/uploads/<?php echo $img['name'];?>" title="" class="show">
									<img src="/scripts/timthumb.php?src=/img/uploads/<?php echo $img['name'];?>&h=80&w=80&zc=1" width="80" height="80" alt="" />
									<!--<img src="/img/uploads/thumb_<?php echo $img['name'];?>" alt="" />-->
								</a>
								<a href="/admin/delete/image/<?php echo $img['id'];?>" class="remove"></a>
								<a href="/admin/edit/destacado/noticia/<?php echo $img['id'];?>" class="destacar"></a>
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
							echo form_open_multipart('admin/upload/noticia', $attributes);
						?>
						<?php echo form_hidden('articleId', $noticia['id']);?>
							<p>
								<input type="file" name="userfile" />
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
		 	            	 	var current = "http://" + $(location).attr('host') + '/admin/list/noticias';
		 	            	 	document.location.href = current;
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
		 	            	 	$('#notifications').append('<p>'+data.message+'</p>');
		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
		 	            	 } else {
		 	            	 	$('#notifications').append('<p>'+data.message+'</p>');
		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
		 	            	 }
	         }, "json");
	         return false; // don't follow the link!
	});
});
</script>