<div class="container-vista-inmersiva-multimedia">
	<div class="caratula-audio py-3">
		<img data-lazy="<?php echo get_sub_field('caratula', $args['ID']); ?>" class="secciones-imagenes-image d-block mx-auto rounded" data-no-lazy="1" />
	</div>

	<div class="audio">
		<audio preload="none" controls="">
			<source src="<?php echo get_sub_field('audio', $args['ID']); ?>" type="audio/mpeg">
		</audio>
	</div>

</div>