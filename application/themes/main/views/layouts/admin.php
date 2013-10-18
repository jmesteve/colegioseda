<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<title><?php echo $template['title']; ?></title>
		
		<meta property="fb:app_id" content="197820343602443" />
		
		<!-- Set up a root directory global variable that all scripts will have access to -->
		<script type="text/javascript" charset="utf-8">
		        CI_ROOT = "<?= base_url() ?>";
		</script>         
		  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
		  
		<!--Include CSS-->
		<link rel="stylesheet" href="<?php echo base_url();?>css/reset.css"  type='text/css' />
		<!--<link rel="stylesheet" href="<?php echo base_url();?>css/master.css" type='text/css' />-->
		<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" type='text/css' />
		
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.tagit.css">
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/tinyeditor.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.wysiwyg.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.lightbox-0.5.css" />
		
		
		<!--Custom Fonts-->
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold&v1' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oswald&v1' rel='stylesheet' type='text/css'>
		
		<!-- Include jQuery --> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
		
		<!-- Include the functions.js --> 
		<script src="<?php echo base_url(); ?>js/functions.js"></script> 
		<script src="<?php echo base_url(); ?>js/jquery.timeago.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/tag-it.js"></script>
		<script src="<?php echo base_url();?>js/jquery.lightbox-0.5.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/tinyeditor.js"></script>
		
		
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.wysiwyg.js"></script>
		 
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
		$(function() {
		    $('.gallerySection ul li a.show').lightBox();
		});
	</script>
	
	<script type="text/javascript">
	var my_instance = new TINY.editor.edit('editor',{
		id:'contentArticle',
		width:750,
		height:250,
		cssclass:'te',
		controlclass:'tecontrol',
		rowclass:'teheader',
		dividerclass:'tedivider',
		controls:['bold','italic','underline','strikethrough','|','subscript','superscript','|',
				  'orderedlist','unorderedlist','|','outdent','indent','|','leftalign',
				  'centeralign','rightalign','blockjustify','|','unformat','|','undo','redo','n',
				  'font','size','style','|','image','hr','link','unlink','|','cut','copy','paste','print'],
		footer:true,
		fonts:['Helvetica','Verdana','Arial','Georgia','Trebuchet MS'],
		xhtml:true,
		cssfile:'tinyeditor.css',
		bodyid:'editor',
		footerclass:'tefooter',
		toggle:{text:'source',activetext:'wysiwyg',cssclass:'toggle'},
		resize:{cssclass:'resize'}
	});
	
	$(function() {
	 	$('#editForm').submit( function() {
				 my_instance.post();
	 	         return true; // don't follow the link!
	 	});
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