<?php
	if(!isset($args['caratula']))
	    $caratula = get_template_directory_uri() . '/public/images/video-poster.png';
	else
		$caratula = $args['caratula'];
?>

<div class="container-vista-inmersiva-multimedia">
	<?php
		if($caratula != ''):
	?>
			<div class="caratula-audio py-3">
				<img src="<?php echo $caratula; ?>" class="secciones-imagenes-image d-block mx-auto rounded" />
			</div>
	<?php
		endif;
	?>

	<div class="audio">
		<audio preload="none" controls="">
			<source src="<?php echo $args['file']; ?>" type="audio/mpeg">
		</audio>
	</div>
</div>