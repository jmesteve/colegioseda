<div id="bodyContent">
	<div class="inner">
	
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<h1>Secciones</h1>
			
			<?php if ($secciones): ?>
			<ul id="sectionList">
			<?php foreach($secciones as $seccion): ?>
				<li>
					<div class="titleSection">
						<h3><?php echo $seccion['name']; ?></h2>
					</div>
					<div class="controlButtonsSection">
						<?php if ($seccion['active']): ?>
							<a id="editBttn" href="/admin/deactivate/seccion/<?php echo $seccion['id']; ?>" class="buttonLink actionBttn notice"> Desactivar </a>
						<?php else: ?>
							<a id="editBttn" href="/admin/activate/seccion/<?php echo $seccion['id']; ?>" class="buttonLink actionBttn notice"> Activar </a>
						<?php endif; ?>
					</div>
					<div class="clear"></div>
				</li>
				
				<?php if ($seccion['children']): ?>
				<ul class="subList">
				<?php foreach($seccion['children'] as $subseccion): ?>
					<li>
						<div class="titleSection">
							<h3><?php echo $subseccion['name']; ?></h2>
						</div>
						<div class="controlButtonsSection">
							<?php if ($subseccion['active']): ?>
								<a id="editBttn" href="/admin/deactivate/seccion/<?php echo $subseccion['id']; ?>" class="buttonLink actionBttn notice"> Desactivar </a>
							<?php else: ?>
								<a id="editBttn" href="/admin/activate/seccion/<?php echo $subseccion['id']; ?>" class="buttonLink actionBttn notice"> Activar </a>
							<?php endif; ?>
						</div>
						<div class="clear"></div>
					</li>
				<?php endforeach; ?>
				<div class="clear"></div>
				</ul>
				<?php endif; ?>
				
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
 $("#selectForm").change(function() {
         var src = $(this).val();
 		 var current = "http://" + $(location).attr('host') + '/admin/list/articulos';
 		 //alert(current);
 		  document.location.href = current +'?s='+src;
 });
</script>