<div id="bodyContent">
	<div class="inner">
	
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<h1>Noticias</h1>
			<?php 
				$pags = ceil($count/$limit);
				$actual = $offset + 1;
				
				function clean_inside_tags($txt,$tags){
				    
				    preg_match_all("/<([^>]+)>/i",$tags,$allTags,PREG_PATTERN_ORDER);
				
				    foreach ($allTags[1] as $tag){
				    	if ($tag != 'a') {
				    		 $txt = preg_replace("/<".$tag."[^>]*>/i","<".$tag.">",$txt);
				    	}
				    }
				
				    return $txt;
				}
			 ?>
			 <div class="metaHeader">
				<p style="float:right;">
					<?php echo $count; ?> resultados. Pagina <?php echo $actual; ?> de <?php echo $pags; ?>
					<a id="editBttn" href="/admin/new/noticia" class="buttonLink notice"> Crear Noticia </a>
				</p>
			
				<?php echo form_dropdown('menus_drop', $droplist, $tId, 'id="selectForm"'); ?>
				
				<div class="clear"></div>
			
			</div>
			<?php if ($news): ?>
			
			<ul id="articleList">
			<?php foreach($news as $noticia): ?>
				<li class="editList">
					<div class="titleSection">
	
						<h2><?php echo $noticia['title']; ?></h2>
						<span>por <?php echo $noticia['username']; ?> el <?php echo strftime("%e %B, %Y %H:%M:%S", $noticia['date']); ?> | <?php echo $noticia['visits']; ?> visitas | en Noticias | Tags: <?php echo $noticia['tags_list']; ?></span>
						
					</div>
					
					<div class="contentSection">
					<?php 
					
					$allow = '<p><ul><li><strong><a><blockquote>';
					
					$str = $noticia['content'];
					
					$result = strip_tags($str,$allow);
					$result = clean_inside_tags($result,$allow);
					?>
						<?php echo $result/*substr($noticia['content'],0,400)*/;?>
					</div>
					
					<?php if (isset($noticia['images']) && !empty($noticia['images']) ):?>
					<div class="gallerySection">
						<!--<h3><?php echo anchor('/gallery/'.$news['id'], 'Galeria');?></h3>-->
						<h3>Galeria</h3>
						<ul>
						<?php foreach ($noticia['images'] as $img):?>
							<li>
								<!--<a href="/gallery/<?php echo $news['id'].'/'.$img['id'];?>">-->
								<a href="/img/uploads/<?php echo $img['name'];?>" title="">
									<img src="/scripts/timthumb.php?src=/img/uploads/<?php echo $img['name'];?>&h=80&w=80&zc=1" width="80" height="80" alt="" />
								</a>
							</li>
						<?php endforeach;?>
						</ul>
						<div class="clear"></div>
					</div>
					<?php endif;?>
					
					<div class="controlButtonsSection">
						<?php if ($noticia['active']): ?>
							<a id="editBttn" href="/admin/deactivate/noticia/<?php echo $noticia['id']; ?>" class="buttonLink actionBttn notice"> Desactivar </a>
						<?php else: ?>
							<a id="editBttn" href="/admin/activate/noticia/<?php echo $noticia['id']; ?>" class="buttonLink actionBttn notice"> Activar </a>
						<?php endif; ?>
						
						<a id="editBttn" href="/admin/edit/noticia/<?php echo $noticia['id']; ?>" class="buttonLink notice"> Editar </a>
						
						<a href="/admin/delete/noticia/<?php echo $noticia['id']; ?>" class="buttonLink deleteBttn notice"> Eliminar </a>
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
		 	            	 if ( msg.status ) {
		 	            	 	//$(this).parent().parent().slideUp('slow');
		 	            	 	$('#notifications').append('<p>Noticia eliminado correctamente</p>');
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
  
 $("#selectForm").change(function() {
         var src = $(this).val();
 		 var current = "http://" + $(location).attr('host') + '/admin/list/noticias';
 		 //alert(current);
 		 if (src != 0) {
 		 	current = current + '?t='+src;
 		 }
 		  document.location.href = current;
     });
</script>