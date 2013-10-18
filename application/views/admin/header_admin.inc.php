<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<meta charset="utf-8" />
	
	<title> <?php echo $page_title; ?> </title>
	        
	<!--Include CSS-->
	<link rel="stylesheet" href="css/reset.css"  type='text/css' />
	<link rel="stylesheet" href="css/master.css" type='text/css' />
	<link rel="stylesheet" href="css/admin.css" type='text/css' />
	
	<!--Custom Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold&v1' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oswald&v1' rel='stylesheet' type='text/css'>
	
	<link href='http://fonts.googleapis.com/css?family=Dawning+of+a+New+Day&v1' rel='stylesheet' type='text/css'>

	<!-- Include jQuery --> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script> 
	
	<!-- Include the functions.js --> 
	<script src="js/functions.js"></script> 
	
	<script src="js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="js/register_validation.js" type="text/javascript"></script> 
	
</head>

<body>
	 
	<!-- !Logo & Menu -->
	<div id="header">
		<div class="cAlign">
			<a href="index.php?p=home" id="logoFigure"> Colegio del Arte Mayor de la Seda - Panel de Control </a>
					
			<!--Menu Navigator-->
			<ul id="nav">
			<?php 
				if ( $page == 'home' ) {
					echo '<li>
							<a href="?p=home" class="activeMenuItem"> Home </a> 
						 </li>';
				} else {
					echo '<li>
							<a href="?p=home"> Home </a> 
						 </li>';
				}
				
				if ( $page == 'secciones' ) {
					echo '<li>
							<a href="?p=secciones" class="activeMenuItem">secciones</a> 
						 </li>';
				} else {
					echo '<li>
							<a href="?p=secciones">secciones</a> 
						 </li>';
				}
				
				if ( isset( $_SESSION['user_id'] ) && (isset( $_SESSION['user_group'] ) && $_SESSION['user_group'] == 1) ){				
					if ( $page == 'articulos' ) {
						echo '<li>
						 		<a href="admin.php?p=articulos" class="activeMenuItem">Articulos</a>						
							  </li>';
					} else {
						echo '<li>
						 		<a href="admin.php?p=articulos">Articulos</a>						
							  </li>';
					}
					echo '<li>
					 		<a href="include/actions/logout.php">Log Out</a>						
						  </li>';
				}
			?>
			</ul> <!-- end Menu Navigator-->
			
			<div class="cBoth"></div>
		</div>
	</div> <!-- End Header -->
	
