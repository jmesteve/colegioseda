<div class="cBoth"></div>

<!--Main Section-->
<div id="mainSection" class="cAlign">
	
		<div class="cBoth"></div>
			
		<h1><?php echo $sectionName; ?></h1>
		
		<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
		
		<hr />
		
		<ul id="galleryList">
		
		<?php if (isset($articles)) foreach($articles as $post): ?>
			<li class="oneThird columnSeparator"> 
		
				<h3><?php echo anchor($post['sectionSlug'].'/'.$post['slug'], $post['title']); ?></h3>
				<a href="<?php echo $post['sectionSlug'].'/'.$post['slug']; ?>"><img class="borderImg columnImg" src="http://lorempixum.com/275/100/abstract" alt="" /></a>					
				<p><?php echo substr(nl2br( $post['content'] ),0,100); ?>
				
				</p>
				<a href="<?php echo $post['sectionSlug'].'/'.$post['slug']; ?>" class="buttonLink"> Mas Informacion </a>
						
			</li>
		<?php endforeach; ?>
				
		</ul>
						
		
	<div class="cBoth"></div>
	
</div> <!--end mainSection-->