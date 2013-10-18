

<!--footerSection-->
<div id="footerSection">
	<div class="cAlign">
		<div class="oneFourth">
		
			<h4>Proximas exposiciones</h4>
			<ul class="fullWidthList">
				<li>
					<p><a href="#">Museo Principe Felipe</a><br /> del 7 al 21 de Julio</p>
				</li>
				
				<li>
					<p><a href="#">Colegio de Artesanos de Valencia</a><br /> del 15 al 19 Agosto</p>
				</li>
				
				<li>
					<p><a href="#">Fundacion Bancaja</a><br /> del 10 al 17 de Septiembre</p
				</li>
			</ul>
		</div> <!--end oneFourth footer-->
		
		<div class="oneFourth">
		
			<h4>Ultimos Tweets</h4>
			<ul class="fullWidthList" id="tweet2">
				<p> <span> Porfavor espere mientras los tweets cargan <img src="img/ajax-loader.gif" /> </span> </p>
				<p><a href="http://twitter.com/rem"> Si no puedes esperar, visita mi perfil</a> </p>
			</ul>
			
		</div> <!--end oneFourth footer-->
		
		<div class="oneHalf">
		
			<!--Contact Info-->
			<h4>Sobre nosotros</h4>
			
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			
			<div id="contactInfoSection">
				
				<p>Siguenos:</p>
				
				<ul>
					<li><a href="http://twitter.com/ColegioSedaVlc"><img src="<?php echo base_url("img/twitter.png"); ?>" alt="Twitter" /></a></li>
					<li><a href="http://www.facebook.com/pages/Colegio-del-Arte-Mayor-de-la-Seda/238707152825222"><img src="<?php echo base_url("img/fb.png"); ?>" alt="Facebook" /></a></li>
					<!--<li><a href="#"><img src="img/rss.png" alt="RSS" /></a></li>-->
				</ul>
				
				<p><a href="index.php?p=contacto">Contacta con nosotros &nbsp;&raquo;</a></p>
			</div>
			
			<!-- <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FColegio-del-Arte-Mayor-de-la-Seda%2F238707152825222&amp;width=260&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:260px; height:62px;" allowTransparency="true"></iframe> -->
			
			<!--Subscribe-->
			<h4>Subscribete</h4>
			<p>Introduzca su email para subscribirse a nuestra newsletter</p>
			
			<form action="index.html" method="POST" id="subscribeForm">
				
				<fieldset>
				
					<input type="text" id="subscribeEmail" name="subscribeEmail" value="Introduzca direccion mail" onfocus="if(this.value=='Introduzca direccion mail')this.value=''" onblur="if(this.value=='')this.value='Introduzca direccion mail'"/>
					
					<input type="submit" value"Subscribe&nbsp;&raquo;"/>
				
				</fieldset>
			</form>
		</div> <!--end oneHalf-->
		
	</div> <!--end cAlign-->
	
</div> <!--end footerSection-->

<!--Copyright Info-->
<div id="copyrightSection">
	<img src="<?php echo base_url("img/copy.png"); ?>" alt="Logo Pequeño" />
	<!-- <?php echo img("img/copy.png"); ?> -->
	
	<p>&copy; Copyright 2011.</p>
	
</div> <!--end copyrightSection-->


