<?php 
?>
    <div class="container-fluid">
        <div class="row mx-md-3 my-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                <div class="title-secciones-icon">
                    <span class="iconWaterBlue"></span>
                    <span class="iconWater"></span>
                </div>

                <h1 class="title-secciones px-md-4 px-2"><?php echo get_the_title(); ?></h1>
                <div class="descripcion-secciones pt-3 px-md-4 px-2">
                    <?php echo get_field('descripcion', get_the_ID()); ?>
                </div>
                <div class="row px-md-4 px-2 mt-5">
                    <?php
                        // check if the flexible content field has rows of data
                        if( have_rows('contenedor_botones', get_the_ID()) ):
                            // loop through the rows of data
                            $numrows = count( get_field( 'contenedor_botones' ) );

                            if($numrows == 1)
                                $buttonCols = 'col-lg-8 col-md-12';
                            elseif($numrows >= 2)
                                $buttonCols = 'col-lg-6 col-md-12';

                            $cont = 0;
                            while ( have_rows('contenedor_botones', get_the_ID()) ) : the_row();
                                // check current row layout
                                $cont++;
                                if( get_row_layout() == 'boton_izquierda' ):
                                    $buttonClass = "btn btn-primary p-1 my-1 boton_pagination_cursos";

                                    $aditionalClass = get_sub_field('clase_adicional', get_the_ID());

                                    if($aditionalClass != '')
                                        $buttonClass .= ' ' . $aditionalClass;
                    ?>
                                    <div class="<?php echo $buttonCols; ?>">
                                        <a class="<?php echo $buttonClass; ?>" href="<?php echo get_sub_field('pagina_destino', get_the_ID()); ?>">
                                            <i class="fa fa-chevron-left icono-btn-cursos-izq"></i>
                                            <span class="separator-btn-cursos-izq"></span>
                                            <?php echo get_sub_field('titulo_boton', get_the_ID()); ?>
                                        </a>
                                    </div>
                    <?php
                                elseif( get_row_layout() == 'boton_derecha' ):
                                    $buttonClass = "btn btn-primary p-1 my-1 boton_pagination_cursos";

                                    $aditionalClass = get_sub_field('clase_adicional', get_the_ID());

                                    if($aditionalClass != '')
                                        $buttonClass .= ' ' . $aditionalClass;
                    ?>
                                    <div class="<?php echo $buttonCols; ?>">
                                        <a class="<?php echo $buttonClass; ?>" aria-disabled="true" href="<?php echo get_sub_field('pagina_destino', get_the_ID()); ?>">
                                            <?php echo get_sub_field('titulo_boton', get_the_ID()); ?>
                                            <i class="fa fa-chevron-right icono-btn-cursos-der"></i>
                                            <span class="separator-btn-cursos-der"></span>
                                        </a>
                                    </div>
                    <?php
                                endif;
                            endwhile;
                        endif;
                    ?>
                </div>

                <?php
                    if(get_field('agregar_biblioteca_tips', get_the_ID()) == 'si')
                    {
                        require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                        $container = new MyBlocksContainer();

                        $container->views_blocks_container('ContenedorFiltrosBiblioteca');
                ?>
                        <div class="pb-2">
                        </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                <?php
                    if(get_field('agregar_video', get_the_ID()) == "si"):
                        get_template_part('src/PostTypes/Secciones/views/content', 'video');
                    endif;

                    if(get_field('agregar_imagenes', get_the_ID()) == "si"):
                        if(get_field('tipo_imagenes', get_the_ID()) == "imagen_cursos"):
                            get_template_part('src/PostTypes/Secciones/views/content', 'imagenes-cursos');
                        else:
                            get_template_part('src/PostTypes/Secciones/views/content', 'imagen-estatica');
                        endif;
                    endif;
                ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mx-md-3 my-md-2 px-2 px-md-4">
            <?php
                if(get_field('agregar_mapa', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

            ?>
                    <div class="col-md-5 col-12">
                        <?php
                            if(get_field('tipo_de_mapa', get_the_ID()) == 'general')
                                $container->views_blocks_container('ContenedorFiltrosMapaGeneral');
                            else if(get_field('tipo_de_mapa', get_the_ID()) == 'iniciativas')
                                $container->views_blocks_container('ContenedorFiltrosMapaIniciativas');
                            else
                                $container->views_blocks_container('ContenedorFiltrosMapaOtros');
                        ?>
                    </div>
                    <div class="col-md-7 col-12">
                        <?php
                            if(get_field('tipo_de_mapa', get_the_ID()) == 'general')
                                $container->views_blocks_container('ContenedorMapaGeneral');
                            else if(get_field('tipo_de_mapa', get_the_ID()) == 'iniciativas')
                                $container->views_blocks_container('ContenedorMapaIniciativas');
                            else
                                $container->views_blocks_container('ContenedorMapaOtros');
                        ?>
                    </div>
                    <div class="pb-5">
                    </div>
            <?php
                }
                if(get_field('agregar_equipo', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('EquipoParticipacion');
            ?>
                    <div class="pb-5">
                    </div>
            <?php
                }

                if(get_field('agregar_timeline', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('ContenedorTimeline');
            ?>
                    <div class="pb-5">
                    </div>
            <?php
                }

                if(get_field('agregar_participacion', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('ContenedorParticipacionAlDia');
                }
                if(get_field('agregar_calendario', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('ContenedorCalendario');
            ?>
                    <div class="pb-5">
                    </div>
            <?php
                }
                if(get_field('agregar_formulario', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('ContenedorFormularioSecciones');
            ?>
                    <div class="pb-5">
                    </div>
            <?php
                }
                if(get_field('agregar_yoparticipoensalud', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('ContenedorYoParticipoEnSalud');
            ?>
                    <div class="pb-5">
                    </div>
            <?php
                }
                if(get_field('agregar_caja_de_herramientas', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('ContenedorCajaHerramientas');
            ?>
                    <div class="pb-2">
                    </div>
            <?php
                }
                if(get_field('agregar_biblioteca_tips', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('ContenedorBiblioteca');
            ?>
                    <div class="pb-2">
                    </div>
            <?php
                }
            ?>
        </div>
    </div>