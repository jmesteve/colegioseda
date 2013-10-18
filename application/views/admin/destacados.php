<div id="bodyContent">
	<div class="inner">
	
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<h1>Destacados</h1>
			
			<?php if ($destacados): ?>
			<ul id="sectionList">
			<?php foreach($destacados as $destacado): ?>
				<li>
					<div class="fullSection">
						<!--<h3><?php echo $destacado->name; ?></h2>-->
						<div class="oneHalf">
							<img src="/scripts/timthumb.php?src=/img/uploads/<?php echo $destacado->name;?>&h=280&w=450&zc=1"/>
						</div>
						<div class="oneHalf">
<!--							<?php 
								$attributes = array('id' => 'editForm');
								$hidden = array('submitted' => true);
								echo form_open('admin/edit_destacado/'.$destacado->id, $attributes, $hidden);
							?>
							<h4>Descripcion (*Opcional)</h4>
							<p>
								<?php echo form_error('content'); ?>
								<?php echo form_input($content); ?>
							</p>
							<?php echo form_submit($submit); ?>
								
							<?php echo form_close(); ?>
-->
							<p><?php echo $destacado->content; ?></p>
							
							<?php if ($destacado->active): ?>
								<a id="editBttn" href="/admin/deactivate/destacado/<?php echo $destacado->id; ?>" class="buttonLink actionBttn notice"> Desactivar </a>
							<?php else: ?>
								<a id="editBttn" href="/admin/activate/destacado/<?php echo $destacado->id; ?>" class="buttonLink actionBttn notice"> Activar </a>
							<?php endif; ?>
							
							<a href="/admin/delete/destacado/<?php echo $destacado->id; ?>" class="buttonLink deleteBttn notice"> Eliminar </a>
							
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</li>
				
			<?php endforeach; ?>
			<div class="clear"></div>
			</ul>
			
			<?php else: ?>
				<p> No ha habido resultados.</p>
			<?php endif; ?>
		</div> <!--end mainContentLeft-->
	</div>
</div>


<script type="text/javascript">
$(function() {
 	$('.deleteBttn').click( function() {
			 var where_to = confirm("¿Deseas realmente borrar este destacado?");
 	       	 if (where_to== true)
 	       	 {
// 	       	 	$.get( $(this).attr('href'), 
// 	       	 			function( msg ) {
//		 	            	 if ( msg.status ) {
//		 	            	 	var current = "http://" + $(location).attr('host') + '/admin/list/destacados';
//		 	            	 	document.location.href = current;
//		 	            	 } else {
//		 	            	 	alert( "Se ha producido algun error: " + msg.status );
//		 	            	 }
// 	         	}, "json");
				return true;
 	         }
 	         return false; // don't follow the link!
 	});
 });
 /*
  $(function() {
   	$('.actionBttn').click( function() {
  			$.get( $(this).attr('href'), 
   	       	 			function( data ) {
  		 	            	 	location.reload();
  		 	            }, "json");
   	         return false; // don't follow the link!
   	});
   });
  */
</script>