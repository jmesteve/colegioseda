<div id="bodyContent">
	<div class="inner">
	
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<h1>Eventos</h1>
			
			<div class="titleSection">
			<p>No esta activado esta seccion todavia...</p>
			</div>
		</div> <!--end mainContentLeft-->
	</div>
</div>

<script type="text/javascript">
$(function() {
 	$('.deleteBttn').click( function() {
			 var where_to = confirm("¿Deseas realmente borrar este articulo?");
 	       	 if (where_to== true)
 	       	 {
 	       	 	$.get( $(this).attr('href'), 
 	       	 			function( msg ) {
		 	            	 if ( msg.status ) {
		 	            	 	//$(this).parent().parent().slideUp('slow');
		 	            	 	$('#notifications').append('<p>Noticia eliminado correctamente</p>');
		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
		 	            	 } else {
		 	            	 	alert( "Se ha producido algun error: " + msg.status );
		 	            	 }
 	         	}, "json");
 	         }
 	         return false; // don't follow the link!
 	});
 });
 
 $(function() {
  	$('.actionBttn').click( function() {
 			$.get( $(this).attr('href'), 
  	       	 			function( data ) {
 		 	            	 if ( data.status ) {
 		 	            	 	$(this).parent().parent().slideUp('slow').delay(500);
 		 	            	 	$('#notifications').append('<p>'+data.message+'</p>');
 		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
 		 	            	 } else {
 		 	            	 	$('#notifications').append('<p>'+data.message+'</p>');
 		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
 		 	            	 }
  	         }, "json");
  	         return false; // don't follow the link!
  	});
  });
  
 $("#selectForm").change(function() {
         var src = $(this).val();
 		 var current = "http://" + $(location).attr('host') + '/admin/list/noticias';
 		 //alert(current);
 		 if (src != 0) {
 		 	current = current + '?t='+src;
 		 }
 		  document.location.href = current;
     });
</script>