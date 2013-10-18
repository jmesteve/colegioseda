<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#">
	<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
			<title><?php echo $template['title']; ?></title>
			
			<!-- Set up a root directory global variable that all scripts will have access to -->
			<script type="text/javascript" charset="utf-8">
			        CI_ROOT = "<?= base_url() ?>";
			</script>
			<!-- Include jQuery --> 
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
			<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
			<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>-->       
			  
			 <!--Include CSS-->
			<link rel="stylesheet" href="<?php echo base_url();?>css/reset.css"  type='text/css' />
			<!--<link rel="stylesheet" href="<?php echo base_url();?>css/master.css" type='text/css' />-->
			<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" type='text/css' />
			
			<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.lightbox-0.5.css" />
			
			<!--Custom Fonts-->
			
			<!-- Include the functions.js --> 
			<script src="<?php echo base_url(); ?>js/functions.js"></script> 
			<script src="<?php echo base_url(); ?>js/jquery.timeago.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>js/jquery.lightbox-0.5.js"></script>
			
			<!-- Twitter Fetcher -->
			<script src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js"></script>
			
			<!--nivoSlider-->	
			<link rel="stylesheet" href="<?php echo base_url(); ?>css/nivo-slider.css" type="text/css" media="screen" /> 
			<link rel="stylesheet" href="<?php echo base_url(); ?>css/themes/default/default.css" type="text/css" media="screen" />
			 
			<script src="<?php echo base_url(); ?>js/jquery.nivo.slider.pack.js"></script>
			
		</head>
	
	<body>
		<?php setlocale(LC_ALL, 'es_ES'); ?>
		
		<?php echo $template['partials']['header']; ?>
		
		<div id="notifications" class="inner clear">
		
		</div>
		<?php echo $template['body']; ?>
		
		<?php echo $template['partials']['footer']; ?>
	
	<script type="text/javascript">
	//$(window).load(function() {
	  // Handler for .ready() called
	  <?php if (isset($notification) && !empty($notification)): ?>
	  $('#notifications').html('<p><?php echo $notification; ?></p>');
	  $("#notifications").css("border", "1px solid rgba(34, 25, 25, 0.25)");
	  $('#notifications').delay(5000).slideDown();
	  <?php	else: ?>
	  $('#notifications').hide();
	  <?php endif; ?>
	//});
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
	
	<script type="text/javascript">
		$(function() {
		    $('.gallerySection ul li a').lightBox();
		});
	</script>
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
	 
	<script type="text/javascript" charset="utf-8">
		getTwitters('tweet', { 
		  id: 'col_sedaval', 
		  count: 5, 
		  enableLinks: true, 
		  ignoreReplies: true, 
		  clearContents: true,
		  template: ' <li><span>&nbsp;&raquo;&nbsp; "%text%"</span> <a href="http://twitter.com/%user_screen_name%/statuses/%id_str%/"> %time% </a> </li>'
		});
	</script>
	
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-26789500-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
	
	</body>

</html>