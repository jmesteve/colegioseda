<div id="bodyContent">
	<div class="inner">
	
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			
			<h1>Articulos</h1>
			<?php 
				$pags = ceil($count/$limit);
				$actual = $offset + 1;
			 ?>
			 <div class="metaHeader">
				<p style="float:right;">
					<?php echo $count; ?> resultados. Pagina <?php echo $actual; ?> de <?php echo $pags; ?>
					<a id="editBttn" href="/admin/new/articulo" class="buttonLink notice"> Crear Articulo </a>
				</p>
				<?php echo form_dropdown('menus_drop', $droplist, $sId, 'id="selectForm"'); ?>
				
				<div class="clear"></div>
			</div>
			
			<?php if ($articles): ?>
			
			<ul id="articleList">
			<?php foreach($articles as $article): ?>
				<li class="editList">
					<div class="titleSection">
	
						<h2><?php echo $article['title']; ?></h2>
						<span>por <?php echo $article['author_name']; ?> el <?php echo strftime("%e %B, %Y %H:%M:%S", $article['date']); ?> | <?php echo $article['visits']; ?> visitas | en <?php echo $article['section_name']; ?> </span>
						
					</div>
					
					<div class="contentSection">
						<?php echo substr($article['content'],0,400);?>
					</div>
					
					<?php if (isset($article['images']) && !empty($article['images']) ):?>
					<div class="gallerySection">
						<!--<h3><?php echo anchor('/gallery/'.$news['id'], 'Galeria');?></h3>-->
						<h3>Galeria</h3>
						<ul>
						<?php foreach ($article['images'] as $img):?>
							<li>
								<!--<a href="/gallery/<?php echo $news['id'].'/'.$img['id'];?>">-->
								<a href="/img/uploads/<?php echo $img['name'];?>" title="">
									<img src="/scripts/timthumb.php?src=/img/uploads/<?php echo $img['name'];?>&h=80&w=80&zc=1" width="80" height="80" alt="" />
									<!--<img src="/img/uploads/thumb_<?php echo $img['name'];?>" alt="" />-->
								</a>
							</li>
						<?php endforeach;?>
						</ul>
						<div class="clear"></div>
					</div>
					<?php endif;?>
					
					<div class="controlButtonsSection">
						<?php if ($article['active']): ?>
							<a id="editBttn" href="/admin/deactivate/articulo/<?php echo $article['id']; ?>" class="buttonLink actionBttn notice"> Desactivar </a>
						<?php else: ?>
							<a id="editBttn" href="/admin/activate/articulo/<?php echo $article['id']; ?>" class="buttonLink actionBttn notice"> Activar </a>
						<?php endif; ?>
						
						<a id="editBttn" href="/admin/edit/articulo/<?php echo $article['id']; ?>" class="buttonLink notice"> Editar </a>
						
						<a href="/admin/delete/articulo/<?php echo $article['id']; ?>" class="buttonLink deleteBttn notice"> Eliminar </a>
					</div>
					<div class="clear"></div>
				</li>
			<?php endforeach; ?>
			<div class="clear"></div>
			</ul>
			<div class="paginatorSection">
				<?php echo $paginator; ?>
			</div>
			<?php else: ?>
				<p> No ha habido resultados.</p>
			<?php endif; ?>
		</div> <!--end mainContentLeft-->
	</div>
</div>


<script type="text/javascript">
$(function() {
 	$('.deleteBttn').click( function() {
			 var where_to = confirm("¿Deseas realmente borrar este articulo?");
 	       	 if (where_to== true)
 	       	 {
 	       	 	$.get( $(this).attr('href'), 
 	       	 			function( msg ) {
 	       	 				alert(msg.status);
		 	            	 if ( msg.status ) {
		 	            	 	$(this).parent().parent().slideUp('slow');
		 	            	 	$('#notifications').children('p:first').text('Articulo eliminado correctamente');
		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
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
  
 $("#selectForm").change(function() {
         var src = $(this).val();
 		 var current = "http://" + $(location).attr('host') + '/admin/list/articulos';
 		 //alert(current);
 		  document.location.href = current +'?s='+src;
     });
</script>