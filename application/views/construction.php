<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Colegio del arte mayor de la Seda</title>


<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
<script type="text/javascript" src="js/construction/jquery.countdown.js"></script>


<!-- jquery countdown-->
<script type="text/javascript">
$(function () {
var austDay = new Date("November 15, 2011 12:00:00");
    $('#defaultCountdown').countdown({until: austDay, layout: '{dn} {dl}, {hn} {hl}, {mn} {ml}, and {sn} {sl}'});
    $('#year').text(austDay.getFullYear());
    });
</script>


<!-- jquery slider -->
<script type="text/javascript">

$(function() {
    $("#slidertext").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev"
    });
});

</script>

<!--script for IE6-image transparency recover-->
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.7a-min.js"></script>
<script>
  /* EXAMPLE */
  DD_belatedPNG.fix('#logo img,#main,.counter,.twitter,.flickr,.facebook,.youtube,#submit_button,.prev img,.next img,#email_input');
  
</script>
<![endif]--> 



</head>

<body>


<div class="container">
	
    <div id="header">
    
    	 <div id="contact_details">
        	<p><a href="#">contact@colegiodelartemayordelaseda.es</a></p>
			<!--<p><a href="#">phone : 555-534-231</a></p>-->
		</div><!--end contact details-->     
                
	</div><!--end header-->
    
    <div style="clear:both"></div> 
              
	<div id="main">

		 <div id="content">
               <div id="logo">
               	<a href="index.html"><img src="img/logo2.png" alt="logo"/></a>
               </div><!--end logo-->     
              <div class="text">
              <h2>Esta pagina web se encuentra en construccion.</h2>
              </div><!--end text-->
                  
              <div class="counter">
              <h3>Tiempo estimado para la apertura:</h3>
              <div id="defaultCountdown"></div>

         </div><!--end counter-->
                 
         <div class="details">
	    	<h3>Nos puedes seguir en:</h3>
        	<div class="social">
        		<a href="http://twitter.com/col_sedaval" class="twitter"><img src="img/construction/twitter.png" alt="logo"/></a>
        		<a href="http://www.facebook.com/pages/Colegio-del-Arte-Mayor-de-la-Seda/238707152825222" class="facebook"><img src="img/construction/facebook.png" alt="logo"/></a>
        	</div>
	     </div><!--end details-->  
	  </div><!--end content-->
            
</div><!--end main-->

</div><!--end class container-->

</body>

</html>
