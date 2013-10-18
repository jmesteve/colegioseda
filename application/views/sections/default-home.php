<div id="bodyContent">
	<div class="inner">
		
		<div id="mainContent" class="left content-box drop-shadow lifted">
				
			<h1><?php echo $section_info['name']; ?></h1>
			
			<?php if (isset($articles) && !empty($articles)):?>
			<ul id="articles">
			<?php foreach($articles as $post): ?>
				<li> 
					<div class="contentSection">	
						<?php echo $post['content'];?>
					</div>
					
					<?php if (isset($post['images']) && !empty($post['images']) ):?>
					<div class="sectionSeparator"></div>
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
					
					<div class="sectionSeparator"></div>
					<div class="shareSection">
						<ul>
							<!-- Start Shareaholic Sexybookmark HTML-->
							<!--<div class="shr_class shareaholic-show-on-load"></div>-->
							
							<li><a href="http://www.tuenti.com/share" class="tuenti-share-button" icon-style="light"></a></li>
							<li><fb:like send="false" layout="button_count" width="64" show_faces="false"></fb:like></li>
							<li><a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="col_sedaval" data-lang="es">Twittear</a></li>
							<li><g:plusone size="medium"></g:plusone></li>
						</ul>
						<div class="clear"></div>
					</div>
					<div class="sectionSeparator"></div>
							
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

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=197820343602443";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Coloca esta petición de presentación donde creas oportuno. -->
<script type="text/javascript">
  window.___gcfg = {lang: 'es'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<script type="text/javascript" src="http://widgets.tuenti.com/widgets.js"></script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'sedaval'; // required: replace example with your forum shortname
    var disqus_identifier = '<?php echo '/'.$year.'/'.$month2.'/'.$day.'/'.$news['slug']; ?>';
    var disqus_developer = 0; // developer mode is on

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>

