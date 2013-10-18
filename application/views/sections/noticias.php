<div class="cBoth"></div>

<!--Main Section-->
<div id="mainSection" class="cAlign">
	
	<!--mainContentSection-->
	<div id="mainContentSection">	
			
		<div class="cBoth"></div>
			
		<h1><?php echo $sectionName; ?></h1>
		
		<ul id="articles">
		
		<?php if (isset($articles)) foreach($articles as $post): ?>
			<li> 
				<div class="articleMeta">
				<?php	
					$h =  strtotime($post['date']);
					
					$day = strftime('%e', $h);
					$month = strftime('%h', $h);
				?>	
					<p><?php echo $month; ?><br /><span><?php echo $day; ?></span>th</p>
					<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="col_sedaval" data-lang="es">Tweet</a>
					<a href="http://www.tuenti.com/share" class="tuenti-share-button" icon-style="light"></a>
							
					<div id="fb-root"></div>
					<fb:like href="?sid='.$row['id_seccion'].'&id=' . $row['id'] . '&title=' . $urltitle . '" send="false" layout="button_count" show_faces="false" font=""></fb:like>
				</div> 
				
				<div class="articleBody">
					
					<h3><?php echo anchor($post['sectionSlug'].'/'.$post['slug'], $post['title']); ?></h3>
					<span> por <?php echo $post['author']; ?><abbr class="timeago" title="<?php echo $post['date']; ?>">
					<?php echo strftime("%e %B, %y", strtotime($post['date'])); ?></abbr> en <?php echo $post['sectionName']; ?></span>
					
					<p><?php echo nl2br( $post['content'] ); ?>
					<?php echo anchor($post['sectionSlug'].'/'.$post['slug'], '&#0133;'); ?>
					</p>
				
				</div>
						
			</li>
		<?php endforeach; ?>
				
		</ul>
						
	</div> <!--end mainContentSection-->

	<?php if (isset($template['partials']['sidebar'])) { echo $template['partials']['sidebar']; } ?>
		
	<div class="cBoth"></div>
	
</div> <!--end mainSection-->