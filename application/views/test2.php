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
		  
		 <!--Include CSS-->
		<link rel="stylesheet" href="<?php echo base_url();?>css/reset.css"  type='text/css' />
		<link rel="stylesheet" href="<?php echo base_url();?>css/main2.css" type='text/css' />
		
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
	
	<div id="main">
		<div id="sidebar" class="">
			<!--<a href="/" class="logo">
				<img src="img/pl5.png" alt="" />
			</a>-->
			
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
			
			<ul class="subMenu">
				<li><a href="">Nosotros</a></li>
				<li><a href="">Espai Seda</a></li>
				<li><a href="">Noticias</a></li>
				<li><a href="">Actividades</a></li>
			</ul>
			
		<!--<div id="social-home">
				<h3>Encuentranos en: </h3>
				<ul>
					<li><a href=""><div class="social-link mail"></div></a></li>
					<li><a href=""><div class="social-link facebook"></div></a></li>
					<li><a href=""><div class="social-link twitter"></div></a></li>
				</ul>
			</div>-->
		</div>
		
		<div id="mainContent" class="">
			
			<div class="miniBar">
				<form action="/search" id="searchForm" method="get" target="_self">
					<input class="" id="searchBox" autocomplete="off" type="text" maxlength="2048" name="q" label="Buscar en Sedaval" placeholder="Buscar en Sedaval" dir="" aria-haspopup="true">					
					<button>Go</button>
				</form>
				<ul class="">
					<li><a href="">Log In</a></li>
					<li><a href="">Contact</a></li>
					<li><a href="">Prensa</a></li>
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
				
		</div>
		
	</div>
	
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