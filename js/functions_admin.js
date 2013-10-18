$(document).ready(function(){   
	
	var currentPag = 1;
	
	$(function() {
	 	$('.deleteBttn').click( function() {
				 var where_to = confirm("Deseas realmente borrar esta entrada??");
	 	       	 if (where_to== true)
	 	       	 {
	 	       	 	$.get( $(this).attr('href'), function(msg) {
	 	            	 if ( msg == "ok" ) {
	 	            	 	alert( "Elemento borrado Correctamente. " );
	 	            	 	location.reload();
	 	            	 } else {
	 	            	 	alert( "Se ha producido algun error: " + msg );
	 	            	 	location.reload();
	 	            	 }
	 	         	});
	 	         }
	 	         return false; // don't follow the link!
	 	});
	 });
		        
	$('.target').change(function() {
	  var sectionId = document.getElementById('tableSelect').value;
	  window.location.href = "admin.php?p=articulos&sec=" + sectionId;
	});
	
	function destino( datos )	{
	
		var table,size,xmlhttp,pagina;
		datos = typeof(datos) != 'undefined' ? datos : 'include/actions/fetchTableData.php';
		
		table = document.navegador.tableSelect.options[document.navegador.tableSelect.selectedIndex].value;
		size = document.navegador.sizeSelect.options[document.navegador.sizeSelect.selectedIndex].value;
		
		$.ajax( {
		    type: "GET",
		    url: datos,
		    data: "t="+ table +"&s="+ size + "&page=" + currentPag,
		    success: function(data){
		    	document.getElementById("tableData").innerHTML=data;
		    	
		    	// Registrar la llamada a los botones de accion [Delete de momento solo]
		    	 
		    	//$('html, body').animate({ scrollTop: $('#mainSection').offset().top }, 350);
		    }
		});
	}
	
});