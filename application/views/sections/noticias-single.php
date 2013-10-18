<div id="bodyContent">
	<div class="inner">
		
		<div id="mainContent" class="left content-box drop-shadow lifted">
			
			<div class="titleSection">
			<?php if (isset($news)):?>
			<?php	
				$h =  date('Y-m-d  hh:mm:ss',$news['date']);
				
				$day = strftime('%e', $news['date']);
				$month = strftime('%h', $news['date']);
				$month2 = strftime('%m', $news['date']);
				$year = strftime('%Y', $news['date']);
			?>
			
				<h2><?php echo $news['title'];?></h2>
				<span>
					<?php echo strftime("el %e de %B, %Y", $news['date']);?>
				</span>
			</div>
			
			<div class="contentSection">
				
				<?php echo $news['content'];?>
				
				<div class="metaSection clearfix">
					<ul class="clearfix">
					<?php if(isset($news['source']) && !empty($news['source'])): ?>
						<li class="clearfix">
							<strong>Via</strong>
							<a href="<?php echo $news['source'];?>"><?php echo $news['source_name'];?></a>
						</li>
					<?php endif; ?>
						<li class="clearfix">
							<strong>Tags</strong>
							<?php foreach ($news['tags'] as $tag):?>
								<a href="/noticias/<?php echo $tag['name'];?>"><?php echo $tag['name'];?></a>
							<?php endforeach;?>
						</li>
					</ul>
				</div>
				
			</div>
			
			
			<?php if (isset($news['images']) && !empty($news['images']) ):?>
			<div class="sectionSeparator"></div>
			<div class="gallerySection">
				<!--<h3><?php echo anchor('/gallery/'.$news['id'], 'Galeria');?></h3>-->
				<ul>
				<?php foreach ($news['images'] as $img):?>
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
			
			<div class="commentSection">
				<div id="disqus_thread"></div>
				<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
				<a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
				
				<div class="cBoth"></div>
			</div>
			
			<?php endif; ?>
			
		</div>
		
		<?php if (isset($template['partials']['sidebar'])) { echo $template['partials']['sidebar']; } ?>
		
	</div>
</div>


<!--<script type="text/javascript">
var SHRSB_Settings = {"shr_class":{"src":"/css","link":"","service":"5,7,88,78,2,52","apikey":"6ffe2cbf142c45bd4cd03b01ec46b8658","localize":true,"shortener":"google","shortener_key":"","designer_toolTips":true,"twitter_template":"${title} - ${short_link} via @Shareaholic"}};
</script>

<script type="text/javascript">
(function() {
var sb = document.createElement("script"); sb.type = "text/javascript";sb.async = true;
sb.src = ("https:" == document.location.protocol ? "https://dtym7iokkjlif.cloudfront.net" : "http://cdn.shareaholic.com") + "/media/js/jquery.shareaholic-publishers-sb.min.js";
var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(sb, s);
})();
</script>-->

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
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>

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
