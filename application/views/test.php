<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<title>Test</title>
		
		<!-- Set up a root directory global variable that all scripts will have access to -->
		<script type="text/javascript" charset="utf-8">
		        CI_ROOT = "<?= base_url() ?>";
		</script>
		<!-- Include jQuery --> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>-->       
		  
		 <!--Include CSS-->
		<link rel="stylesheet" href="<?php echo base_url();?>css/reset.css"  type='text/css' />
		<!--<link rel="stylesheet" href="<?php echo base_url();?>css/master.css" type='text/css' />-->
		<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" type='text/css' />
		
		<!--Custom Fonts-->
		
		<!-- Include the functions.js --> 
		<script src="<?php echo base_url(); ?>js/functions.js"></script> 
		<script src="<?php echo base_url(); ?>js/jquery.timeago.js" type="text/javascript"></script>
		
		<!--nivoSlider-->	
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/nivo-slider.css" type="text/css" media="screen" /> 
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/themes/default/default.css" type="text/css" media="screen" />
		 
		<script src="<?php echo base_url(); ?>js/jquery.nivo.slider.pack.js"></script>
		
	</head>
	
	<body>
		
	<div id="header" class="">
		<div class="inner">
			<div class="topNav">
				<a href="/" class="logo">
					<img src="img/pl5.png" alt="" />
				</a>
				<ul class="menu">
					<li><a href="">Nosotros</a></li>
					<li><a href="">Espai Seda</a></li>
					<li><a href="">Noticias</a></li>
					<li><a href="">Actividades</a></li>
					<li><a href="">Historia</a></li>
					<li><a href="">Cofradia</a></li>
					<li><a href="">Archivo</a></li>
					<li><a href="">Colecciones</a></li>
				</ul>
			</div>
			<!--<div class="subNav drop-shadow lifted">
				<ul class="menuSub">
					<li><a href="">Junta de Gobierno</a></li>
					<li><a href="">Sede</a></li>
				</ul>
			</div>-->
			<div class="clear"></div>
			<!--<div class="shadow"></div>-->
		</div>
	</div>
	
<div id="bodyContent">
	<div class="inner">
		<div id="social-home">
			<!--<h3>Encuentranos en: </h3>-->
			<ul>
				<li><a href=""><div class="social-link mail"></div></a></li>
				<li><a href=""><div class="social-link facebook"></div></a></li>
				<li><a href=""><div class="social-link twitter"></div></a></li>
			</ul>
		</div>
		
		<div id="sliderSection">
			<!-- !NivoSlider -->
			<div class="slider-wrapper theme-default">
			    
			    <div class="ribbon"></div>
			    
			    <div id="slider" class="nivoSlider">
				    <a href="/">    
			        	<img src="<?php echo base_url(); ?>img/slide.jpeg" alt="" title="#htmlcaption1"/>
				    </a>
				    <a href="/">    
				    	<img src="<?php echo base_url(); ?>img/slide.jpeg" alt="" title="#htmlcaption2"/>
				    </a>
				</div>
				
			    <div id="htmlcaption1" class="nivo-html-caption">
			        Esto es el contenido
			    </div>
			    <div id="htmlcaption2" class="nivo-html-caption">
			        Esto es el contenido 2
			    </div>
			    
			</div>
		</div>
		
		<div id="mainContent" class="inner drop-shadow lifted">
			
			
			<div class="contentHeader">
				
				<form action="/search" id="searchForm" method="get" target="_self">
					<input class="" id="searchBox" autocomplete="off" type="text" maxlength="2048" name="q" label="Buscar en Sedaval" placeholder="Buscar en Sedaval" dir="" aria-haspopup="true">					
					<button>Go</button>
				</form>
				
				<h2>Noticias</h2>
				
			</div>
			
			<ul class="homeList">
				<li>
					<!--<ul class="tags">
						<li><a href="/">Valencia</a></li>
						<li><a href="/">Prensa</a></li>
					</ul>-->
					<h3><a href="">Sed semper euismod ligula</a></h3> <span class=""> November 6, 2011</span>
				</li>
				<li>
					<!--<ul class="tags">
						<li><a href="/">Valencia</a></li>
						<li><a href="/">Juan</a></li>
						<li><a href="/">TV</a></li>
					</ul>-->
					<h3><a href="">Phasellus condimentum sapien sed eros</a></h3> <span class=""> November 6, 2011</span>
				</li>
				<li>
					<!--<ul class="tags">
						<li><a href="/">TV</a></li>
					</ul>-->
					<h3><a href="">In tempus consectetur mauris sit</a></h3> <span class=""> November 6, 2011</span>
				</li>
				<li>
					<!--<ul class="tags">
						<li><a href="/">Valencia</a></li>
						<li><a href="/">TV</a></li>
					</ul>-->
					<h3><a href="">Cras iaculis luctus tellus quis ultrices</a></h3> <span class=""> November 6, 2011</span>
				</li>
				<li>
					<!--<ul class="tags">
						<li><a href="/">Valencia</a></li>
					</ul>-->
					<h3><a href="">Vivamus aliquet fringilla diam</a></h3> <span class=""> November 6, 2011</span>
				</li>
			</ul>
			
			<div class="controller">
				<a href=""><div class="next"></div>
			</div>
			
		</div>
	
	</div>
</div>
	<!--Copyright Info-->
	<div id="copyrightSection">
		<img src="<?php echo base_url("img/copy2.png"); ?>" alt="Logo Pequeño" />		
		<p>&copy; Copyright 2011 - </p>
		
	</div> <!--end copyrightSection-->
	
	<script type="text/javascript">
	 // Spanish
	 jQuery.timeago.settings.strings = {
	    prefixAgo: "hace",
	    prefixFromNow: "dentro de",
	    suffixAgo: "",
	    suffixFromNow: "",
	    seconds: "menos de un minuto",
	    minute: "un minuto",
	    minutes: "unos %d minutos",
	    hour: "una hora",
	    hours: "%d horas",
	    day: "un día",
	    days: "%d días",
	    month: "un mes",
	    months: "%d meses",
	    year: "un año",
	    years: "%d años"
	 };
	 
	 jQuery(document).ready(function() {
	   jQuery("abbr.timeago").timeago();
	 });
	 </script>
	<script type="text/javascript">
	$('#slider').nivoSlider({
	    effect:'slideInLeft',
	    directionNav:false,
	    directionNavHide:false,
	    controlNav: false
	});
	
	$(window).load(function() {
	    $('#slider').nivoSlider();
	});
	</script>
	</body>
</html>