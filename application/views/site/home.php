<div id="bodyContent">
	
	<div class="inner">
		<div id="social-home">
			<!--<h3>Encuentranos en: </h3>-->
			<ul>
				<li><a href="/contacto"><div class="social-link mail"></div></a></li>
				<li><a href="http://www.facebook.com/pages/Colegio-del-Arte-Mayor-de-la-Seda/238707152825222"><div class="social-link facebook"></div></a></li>
				<li><a href="http://www.twitter.com/col_sedaval"><div class="social-link twitter"></div></a></li>
			</ul>
		</div>
		
		<div id="sliderSection">
			<!-- !NivoSlider -->
			<div class="slider-wrapper theme-default">
			    
			    <div class="ribbon"></div>
			    
			    <?php $cont = 1; ?>
			    
			    <div id="slider" class="nivoSlider">
			    	<?php foreach ($query_slider as $row): ?>
			   
			        <a href="<?php echo $row->url; ?>">
			        	<img src="/scripts/timthumb.php?src=/img/uploads/<?php echo $row->name;?>&h=361&w=640&zc=1" alt="" title="#htmlcaption<?php echo $cont;?>"/>
			        </a>
			        <?php $cont += 1; ?>
			    	<?php endforeach; ?>
			    </div>
			    
			    <?php $cont = 1; ?>
			    
			    <?php foreach ($query_slider as $row): ?>
			    <div id="htmlcaption<?php echo $cont; ?>" class="nivo-html-caption">
			        <strong><?php echo $row->title; ?></strong>
			        <?php echo $row->content; ?>
			    </div>
			    <?php $cont += 1; ?>
			    <?php endforeach; ?>
			    
			</div>
		</div>
		
		<div id="homeContent" class="content-box drop-shadow lifted">
			<!--
				<form action="/search" id="searchForm" method="get" target="_self">
					<input class="" id="searchBox" autocomplete="off" type="text" maxlength="2048" name="q" label="Buscar en Sedaval" placeholder="Buscar en Sedaval" value="" dir="" aria-haspopup="true">					
					<button>Go</button>
				</form>
				-->
			<h1>Noticias</h1>
			<!-- "previous page" action -->
			<a class="prev browse left"></a>
			
			<!-- root element for scrollable -->
			<div class="scrollable">   
			   
			   <!-- root element for the items -->
			   <div class="items">
			   <?php if (isset($news)) foreach($news as $post):?>
				   <div>
				   	<?php
				   		$day = strftime('%e', $post['date']);
				   		$day2 = strftime('%d', $post['date']);
				   		$month = strftime('%h', $post['date']);
				   		$month2 = strftime('%m', $post['date']);
				   		$year = strftime('%Y', $post['date']);
				   	?>
				   		<h3><?php echo anchor($year.'/'.$month2.'/'.$day2.'/'.$post['slug'], $post['title']); ?></h3>
				   		<span class=""><?php echo $month.' '.$day.', '.$year;?></span>
				   </div>
			   <?php endforeach;?>
			      
			    </div>
			   
			</div>
			
			<!-- "next page" action -->
			<a class="next browse right"></a>
			<div class="clear"></div>
		</div>
	</div>
</div>

<script>
// execute your scripts when the DOM is ready. this is mostly a good habit
$(function() {
	// initialize scrollable
	$(".scrollable").scrollable();
});
</script>