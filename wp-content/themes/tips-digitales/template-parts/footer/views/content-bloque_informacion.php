<?php
?>
		<div class="col">
			<span class="titulo_bloque_datos"><?php echo get_sub_field('titulo'); ?></span>
			<div class="bloque_datos">
				<?php
				    if( have_rows('descripciones', 'option') ):
						while ( have_rows('descripciones', 'option') ) : the_row();
				?>
			    			<span class="descripcion_bloque_datos"><?php echo get_sub_field('descripcion'); ?></span>
			    <?php
						endwhile;
					endif;
				?>
			</div>
		</div>
<?php
?>