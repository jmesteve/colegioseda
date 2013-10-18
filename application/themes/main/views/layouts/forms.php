<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php echo $template['title']; ?></title>
		
		<meta property="fb:app_id" content="197820343602443" />
		
		<!-- Set up a root directory global variable that all scripts will have access to -->
		<script type="text/javascript" charset="utf-8">
		        CI_ROOT = "<?= base_url() ?>";
		</script> 
		         
		<!--Include CSS-->
		<link rel="stylesheet" href="<?php echo base_url();?>css/reset.css"  type='text/css' />
		<link rel="stylesheet" href="<?php echo base_url();?>css/master.css" type='text/css' />
		
		<!--Custom Fonts-->
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold&v1' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oswald&v1' rel='stylesheet' type='text/css'>
		
		<!-- Include jQuery --> 
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script> 
		
		<!-- Include the functions.js --> 
		<script src="js/functions.js"></script> 
		<script src="js/jquery.timeago.js" type="text/javascript"></script>
		<script src="js/jquery.validate.min.js" type="text/javascript"></script>
		
		<script src="js/register_validation.js" type="text/javascript"></script> 
		
		<!-- Twitter Fetcher -->
		<script src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js"></script>
		
		 
	</head>
	
	<body>
		
		<?php echo $template['partials']['header']; ?>
		
		<?php echo $template['body']; ?>
		
		<?php echo $template['partials']['footer']; ?>
		
		
	
	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
	  		FB.init({appId: '197820343602443', status: true, cookie: true,
	         xfbml: true});
		};
		(function() {
	  		var e = document.createElement('script'); e.async = true;
	  		e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
	  		document.getElementById('fb-root').appendChild(e);
		}());
	
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
		  template: ' <p> <span>"%text%"</span> <a href="http://twitter.com/%user_screen_name%/statuses/%id_str%/"> %time% </a> </p>'
		});
		getTwitters('tweet2', { 
		  id: 'col_sedaval', 
		  count: 5, 
		  enableLinks: true, 
		  ignoreReplies: true, 
		  clearContents: true,
		  template: ' <p> <span>"%text%"</span> <a href="http://twitter.com/%user_screen_name%/statuses/%id_str%/"> %time% </a> </p>'
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