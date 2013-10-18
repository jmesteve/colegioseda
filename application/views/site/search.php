
<div id="bodyContent">
	<div class="inner">
		
		<div id="mainContent" class="left content-box drop-shadow lifted">
				
			<h1>Resultados de la busqueda: <span><?php echo $word; ?></span></h1>
			
			<ul id="articles">
			<?php print_r($results['articulos']); ?>
			<?php if (isset($articles) && !empty($articles)):
					 foreach($articles as $post): ?>
				<li> 
					
					<div class="contentSection">	
						<?php echo $post['content'];?>
					</div>
							
				</li>
			<?php endforeach; ?>
			
			</ul>
			
			<?php else:?>
			<div class="contentSection">
				<p> No hay contenidos para esta seccion. </p>
			</div>
			<?php endif; ?>
		</div>
		
		<?php if (isset($template['partials']['sidebar'])) { echo $template['partials']['sidebar']; } ?>
		
	</div>
</div>