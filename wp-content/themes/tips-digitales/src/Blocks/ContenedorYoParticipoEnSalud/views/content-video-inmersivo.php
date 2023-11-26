<div class="px-4 py-3 container-vista-inmersiva-multimedia">
	<div class="video col-10 mx-auto">
	  	<?php
	  		$videoYoutube = get_sub_field('insertar_video_de_youtube', $args['ID']);

	    	if($videoYoutube == "si"):
	    		echo get_sub_field('contenedor_youtube', $args['ID']);
	      	else:

                $poster = get_field('video_poster', $args['ID']);
                                    
                if($poster == '')
                {
	                $poster = get_field('miniatura', $args['ID']);

	                if($poster == '')
	                    $poster = get_template_directory_uri() . '/public/images/video-poster.png';
                }
	  	?>
	         	<video width="100%" style="border-radius: 15px;" poster="<?php echo $poster; ?>" controls="">
	            	<source src="<?php echo get_sub_field('subir_video', $args['ID']); ?>" type="video/mp4">
	          	</video>
	  	<?php
	      	endif;
	  	?>
	</div>
</div>