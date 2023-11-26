<div class="row px-md-4 px-2">
    <?php
        // check if the flexible content field has rows of data
        if( have_rows('imagenes', get_the_ID()) ):
            // loop through the rows of data
            while ( have_rows('imagenes', get_the_ID()) ) : the_row();
                $buttonClass = 'col-md-6 col-sm-12 secciones-imagenes';

                $aditionalClass = get_sub_field('clase_adicional', get_the_ID());

                if($aditionalClass != '')
                    $buttonClass .= ' ' . $aditionalClass;
    ?>
        <div class="<?php echo $buttonClass; ?>">
            <a href="<?php echo get_sub_field('pagina_curso', get_the_ID()); ?>">
                <img src="<?php echo get_sub_field('imagen', get_the_ID()); ?>" class="secciones-imagenes-image img-fluid rounded"/>
                <div class="secciones-imagenes-middle">
                    <div class="secciones-imagenes-text">Ver más</div>
                </div>
            </a>
        </div>

    <?php
            endwhile;
        endif;
    ?>
</div>