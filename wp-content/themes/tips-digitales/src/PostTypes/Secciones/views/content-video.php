<div class="row px-md-4 px-2">

    <div class="secciones-video col-md-12 col-sm-12">
        <?php
            if(get_field('insertar_video_de_youtube', get_the_ID()) == "si"):
                echo get_field('video_youtube', get_the_ID());
            else:
                $poster = get_field('video_poster', get_the_ID());
                if($poster == '')
                  $poster = get_template_directory_uri() . '/public/images/video-poster.png';
          ?>
                <video width="100%" style="border-radius: 15px;" id="modalMultimediaVideo" preload="metadata" poster="<?php echo $poster; ?>" controls>
                    <source src="<?php echo get_field('subir_video', get_the_ID()); ?>" type="video/mp4">
                </video>
        <?php
            endif;
        ?>
    </div>
</div>