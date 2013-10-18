<!--Categories Section -->
<div id="categoriesSection" class="cAlign">
	<ul>
		<?php if( isset($query_sub_nav) ): ?>
		<?php foreach ($query_sub_nav as $row): ?>
			<li><a href="<?php echo $row->slug; ?>"> <?php echo $row->nombre; ?> </a></li>
		<?php endforeach; ?>
		<?php endif; ?>
			<li><a href="<?php echo base_url('shop'); ?>"> Tienda </a></li>
			<li><a href="<?php echo base_url('contacto'); ?>"> Contacto </a></li>
	</ul>
</div>  <!--end categoriesSection-->
	
<!--Breadcrumbs & Search-->
<div id="breadcrumbSection" class="cAlign">
		
	<p> Se encuentra aqui:  <a href="home">Home </a> 
		
		<?php if (isset($breadcrumbs)) foreach ($breadcrumbs as $row): ?>
		 >> <a href="<?php echo $row['slug']; ?>"> <?php echo $row['nombre']; ?> </a> 
		<?php endforeach; ?>
	</p>
	
	<?php 
		$attributes = array('id' => 'searchForm');
		$hidden = array('submitted' => 'TRUE');
		echo form_open('search', $attributes, $hidden);
	?>
		<fieldset>
			<?php 
				$data = array(
							  'method'		=> 'get',
				              'name'        => 'search',
				              'id'          => 'searchInput',
				              'value'       => 'Busqueda en la web...',
				              'onFocus'     => '',
				              'onBlur'		=> 'Busqueda en la web...'
				            );
				echo form_input($data); 
			?>
		</fieldset>
	<?php echo form_close(); ?>
		
	<div class="cBoth"></div>
		
</div> <!--end breadcrumbSection-->