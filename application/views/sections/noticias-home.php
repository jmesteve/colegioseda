<div id="bodyContent">
	<div class="inner">
		
		<div id="mainContent" class="left content-box drop-shadow lifted">
			
			<?php 
				$pags = ceil($count/$limit);
				$actual = $offset + 1;
				
				function clean_inside_tags($txt,$tags){
				    
				    preg_match_all("/<([^>]+)>/i",$tags,$allTags,PREG_PATTERN_ORDER);
				
				    foreach ($allTags[1] as $tag){
				        $txt = preg_replace("/<".$tag."[^>]*>/i","<".$tag.">",$txt);
				    }
				
				    return $txt;
				}
			 ?>
				
			<h1><?php echo $section_info['name']; ?></h1>
			
			<ul id="articles">
			
			<?php if (isset($news)) foreach($news as $post): ?>
				<li> 
					
					<div class="titleSection">
					<?php	
						$h =  date('Y-m-d  hh:mm:ss',$post['date']);
						
						$day = strftime('%e', $post['date']);
						$day2 = strftime('%d', $post['date']);
						$month = strftime('%h', $post['date']);
						$month2 = strftime('%m', $post['date']);
						$year = strftime('%Y', $post['date']);
					?>
		
						<h2><?php echo anchor($year.'/'.$month2.'/'.$day2.'/'.$post['slug'], $post['title']); ?></h2>
						<span>
							<?php echo strftime("el %e de %B, %Y", $post['date']);?>
						</span>
					</div>
					
					<div class="contentSection">
					<?php 
						$allow = '<p><ul><li><blockquote><strong><a><img>';
						$clean = '<p><ul><li><blockquote><strong><a>';
						
						$fix_empty_p = "/<p[^>]*> <\\/p[^>]*>/"; 
						
						$str = $post['content'];
						
						$result = strip_tags($str,$allow);
						$result = clean_inside_tags($result,$clean);
						
						$result = preg_replace($fix_empty_p, '', $result);
					?>
						<?php echo $result/*substr($result, 0,400)*/;?>
					</div>
					
							
				</li>
			<?php endforeach; ?>
					
			</ul>
			<div id="paginator">
				<?php echo $paginator; ?>
			</div>
				
			
		</div>
		
		<?php if (isset($template['partials']['sidebar'])) { echo $template['partials']['sidebar']; } ?>
		
	</div>
</div>