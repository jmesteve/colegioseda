<div id="bodyContent">
	<div class="inner">
		
		<div id="mainContent" class="left content-box drop-shadow lifted">
				
			<h1><?php echo $section_info['name']; ?></h1>
			
			<ul id="articles">
			
			<?php if (isset($articles) && !empty($articles)):
					 foreach($articles as $post): ?>
				<li> 
					
					<div class="contentSection">	
						<?php echo $post['content'];?>
					</div>
					
					<?php if (isset($post['images']) && !empty($post['images']) ):?>
					<div class="gallerySection">
						<!--<h3><?php echo anchor('/gallery/'.$news['id'], 'Galeria');?></h3>-->
						<ul>
						<?php foreach ($post['images'] as $img):?>
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
					
					<div class="shareSection">
						<ul>
							<li><a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-via="col_sedaval" data-lang="es">Tweet</a></li>
							<li><a href="http://www.tuenti.com/share" class="tuenti-share-button" icon-style="light"></a></li>
									
							<li><div id="fb-root"></div>
							<fb:like href="" send="false" layout="button_count" show_faces="false" font=""></fb:like></li>
						</ul>
						<div class="clear"></div>
					</div>
					
					<!--<?php	
						$h =  date('Y-m-d  hh:mm:ss',$post['date']);
						
						$day = strftime('%e', $post['date']);
						$day2 = strftime('%d', $post['date']);
						$month = strftime('%h', $post['date']);
						$month2 = strftime('%m', $post['date']);
						$year = strftime('%Y', $post['date']);
					?> 
					
					<div class="articleBody">
						
						<h3><?php echo anchor($section_info['slug'].'/'.$post['slug'], $post['title']); ?></h3>
						<span> por <?php echo $post['author_name']; ?> el <abbr class="timeago" title="<?php echo date('d M y, H:i:s',$post['date']); ?>">
						<?php echo strftime("%e %B, %y", $post['date']); ?></abbr> </span>
						
						<p><?php echo nl2br( $post['content'] ); ?></p>
					
					</div> -->
							
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