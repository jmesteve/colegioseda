<div id="bodyContent">
	<div class="inner">
	
		<div id="mainContent" class="content-box drop-shadow lifted">
			
			<h1>Usuarios</h1>
			<?php 
				$pags = ceil($count/$limit);
				$actual = $offset + 1;
			 ?>
			 <div class="metaHeader">
				<p style="float:right;">
					<?php echo $count; ?> resultados. Pagina <?php echo $actual; ?> de <?php echo $pags; ?>
				</p>
				
				<?php echo form_dropdown('users_drop', $droplist, $gId, 'id="selectForm"'); ?>
				<div class="clear"></div>
			</div>
			
			<?php if ($users): ?>
			<table>
				<tr>
				<?php $columnas = array('Nick','email','Nombre','Apellidos', 'Telefono', 'Grupo', 'Registro'); ?>
				
				<?php foreach( $columnas as $col): ?>
				<td><h4><?php echo $col; ?></h4></td>
				<?php endforeach; ?>
				
				<!--los td de los botones de  activar, editar y borrar-->
				<!-- Hacer Admin -->
				<td></td>
				<!-- Activar/desactivar -->
				<td></td>
				<!-- Eliminar -->
				<td></td>
				
				</tr>
				
				<?php foreach($users as $user): ?>
				<tr>
					<td><p><?php echo $user['username']; ?></p></td>
					<td><p><?php echo $user['email']; ?></p></td>
					<td><p><?php echo $user['first_name']; ?></p></td>
					<td><p><?php echo $user['last_name']; ?></p></td>
					<td><p><?php echo $user['telefono']; ?></p></td>
					<td><p><?php echo $user['group']; ?></p></td>
					<td><p><?php echo date('d-m-Y',$user['created_on']); ?></p></td>
					
					<?php if ($user['group_id'] != 1):?>
					<td class="action">
						<a id="editBttn" href="/admin/makeAdmin/<?php echo $user['id']; ?>" class="buttonLink adminBttn"> Admin </a>
					</td>
					<?php else:?>
					<td class="action">
					</td>
					<?php endif;?>
					
					<td class="action">
						<?php if ($user['active']):?>
						<a href="/admin/deactivate/user/<?php echo $user['id']; ?>" class="buttonLink actionBttn"> Desactivar </a> 
						<?php else: ?>
						<a href="/admin/activate/user/<?php echo $user['id']; ?>" class="buttonLink actionBttn"> Activar </a>
						<?php endif; ?>
					</td>
					
					<td class="action"> <a href="/admin/delete/user/<?php echo $user['id']; ?>" class="buttonLink deleteBttn"> Eliminar </a> </td>
					
					<!--<td class="action"> <a id="editBttn" href="admin/editUser/<?php echo $user['id']; ?>" class="buttonLink"> Edit </a> </td>-->
				</tr>
				<?php endforeach; ?>
				
				<!--<script>$("tr:odd").css("background-color", "#E2CEAD");</script>-->
				
			</table>
			<div class="paginatorSection">
			<?php echo $paginator; ?>
			</div>
			
			<?php else: ?>
				<p> No ha habido resultados.</p>
			<?php endif; ?>		
			
		</div> <!--end mainContentLeft-->
	</div>
</div>


<script type="text/javascript">

$(function() {
 	$('.adminBttn').click( function() {
			$.get( $(this).attr('href'), 
 	       	 			function( data ) {
		 	            	 if ( data.status ) {
		 	            	 	$(this).parent().parent().slideUp('slow').delay(500);
		 	            	 	$('#notifications').children('p:first').text(data.message);
		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
		 	            	 } else {
		 	            	 	$('#notifications').children('p:first').text(data.message);
		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
		 	            	 }
 	         }, "json");
 	         return false; // don't follow the link!
 	});
 });
 
$(function() {
 	$('.actionBttn').click( function() {
			$.get( $(this).attr('href'), 
 	       	 			function( data ) {
		 	            	 if ( data.status ) {
		 	            	 	$(this).parent().parent().slideUp('slow').delay(500);
		 	            	 	$('#notifications').children('p:first').text(data.message);
		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
		 	            	 } else {
		 	            	 	$('#notifications').children('p:first').text(data.message);
		 	            	 	$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
		 	            	 }
 	         }, "json");
 	         return false; // don't follow the link!
 	});
 });
 
$(function() {
 	$('.deleteBttn').click( function() {
			 var where_to = confirm("¿Deseas realmente borrar este usuario?");
 	       	 if (where_to== true)
 	       	 {
 	       	 	$.get( $(this).attr('href'), 
 	       	 			function( msg ) {
		 	            	 if ( msg.status ) {
		 	            	 	//$(this).parent().parent().slideUp('slow');
		 	            	 	//$('#notifications').children('p:first').text('Usuario eliminado correctamente');
		 	            	 	//$('#notifications').delay(500).slideDown().delay(5000).slideUp('slow');
		 	            	 	location.reload();
		 	            	 } else {
		 	            	 	alert( "Se ha producido algun error: " + msg.status );
		 	            	 }
 	         	}, "json");
 	         }
 	         return false; // don't follow the link!
 	});
 });
 
 
  
 $("#selectForm").change(function() {
         var src = $(this).val();
         if(src != 0){
	 		 var current = "http://" + $(location).attr('host') + '/admin/list/users';
	 		  document.location.href = current +'?g='+src;
	 	 }
     });
     
</script>
