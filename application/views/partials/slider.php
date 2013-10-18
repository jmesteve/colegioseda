<!-- sliderSection -->
<div id="sliderSection" class="cAlign">
	
	<!-- !NivoSlider -->
	<div class="slider-wrapper theme-default">
	    
	    <div class="ribbon"></div>
	    <?php $cont = 1; ?>
	    
	    <div id="slider" class="nivoSlider">
			<?php foreach ($query_slider as $row): ?>
		    <a href="<?php echo $row->url; ?>">    
	        	<img src="<?php echo '/img/slider/'.$row->nombre; ?>" alt="" title="#htmlcaption<?php echo $cont; ?>"/>
		    </a>
		    <?php $cont += 1; ?>
			<?php endforeach; ?>
		</div>
		
		<?php $cont = 1; ?>
		
		<?php foreach ($query_slider as $row): ?>
	    <div id="htmlcaption<?php echo $cont; ?>" class="nivo-html-caption">
	        <?php echo $row->mensaje; ?>
	    </div>
	    <?php $cont += 1; ?>
		<?php endforeach; ?>
	    
	</div>
		
</div> <!-- end sliderSection -->