<div class="px-4 py-2 container-vista-inmersiva-imagen">
	<?php
	    if( have_rows('imagenes', $args['ID']) ):
			while ( have_rows('imagenes', $args['ID']) ) : the_row();
	?>
				<div class="py-2">
					<img data-lazy="<?php echo get_sub_field('imagen', $args['ID']); ?>" class="secciones-imagenes-image img-fluid rounded" data-no-lazy="1" />
				</div>
	<?php
			endwhile;
		endif;
	?>
</div>