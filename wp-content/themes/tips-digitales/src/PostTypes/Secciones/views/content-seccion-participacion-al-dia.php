<?php 
    $titulo = get_the_title();

    $temp = explode(" ", $titulo);

    $firstWord = $temp[0];
    $temp[0] = '';

    $titleWords = implode(" ", $temp);
?>
    <div class="container-fluid">
        <div class="row mx-md-3 my-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                <div class="title-secciones-icon">
                    <span class="iconWaterBlue"></span>
                    <span class="iconWater"></span>
                </div>

                <h1 class="title-secciones px-md-4 px-2"><?php echo $firstWord; ?><span class="title-secciones-secondary"><?php echo $titleWords; ?></span></h1>
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

        <div class="row mx-md-3 my-2">
            <div class="col-12">
                <div class="col-12 pb-4 event px-md-4 px-2">
                    <div class="body-content-participacion" id="tabsParticipacion">
                        <div class="tabsParticipacion pt-3 pb-2 px-3" id="tabsParticipacion1">
                            <?php
                                get_template_part( 'src/PostTypes/Secciones/views/content', 'participacion-dialogos-ciudadanos' );
                            ?>
                        </div>
                        <div class="tabsParticipacion pt-3 pb-2 px-3" id="tabsParticipacion2">
                            <?php
                                get_template_part( 'src/PostTypes/Secciones/views/content', 'participacion-noticias' );
                            ?>
                        </div>
                        <div class="tabsParticipacion pt-3 pb-2 px-3" id="tabsParticipacion3">
                            <?php
                                get_template_part( 'src/PostTypes/Secciones/views/content', 'participacion-version-impresa' );
                            ?>
                        </div>
                        <div class="tabsParticipacion pt-3 pb-2 px-3" id="tabsParticipacion4">
                            <?php
                                get_template_part( 'src/PostTypes/Secciones/views/content', 'participacion-comite-editorial' );
                            ?>
                        </div>
                    </div>

                    <div class="col-md-12 footer-botones-tab">
                        <div class="col-md-12" data-toggle="buttons">
                            <div class="row px-2">
                                <label class="btn btn-tabs-buttons blue col-3 px-md-3 my-auto checked">
                                    <span class="btn-pp blue"></span>

                                    <input type="radio" name="tabsParticipacionAlDia" id="content-1" autocomplete="off" value="tabsParticipacion1" class="inputParticipacion" checked> Diálogos ciudadanos
                                </label>
                                <label class="btn btn-tabs-buttons yellow col-3 px-md-3 my-auto">
                                    <span class="btn-pp yellow"></span>

                                    <input type="radio" name="tabsParticipacionAlDia" id="content-2" autocomplete="off" value="tabsParticipacion2" class="inputParticipacion"> Últimas Noticias
                                </label>
                                <label class="btn btn-tabs-buttons blue col-3 px-md-3 my-auto">
                                    <span class="btn-pp blue"></span>

                                    <input type="radio" name="tabsParticipacionAlDia" id="content-3" autocomplete="off" value="tabsParticipacion3" class="inputParticipacion"> Vesión Impresa
                                </label>
                                <label class="btn btn-tabs-buttons yellow col-3 px-md-3 my-auto">
                                    <span class="btn-pp yellow"></span>

                                    <input type="radio" name="tabsParticipacionAlDia" id="content-4" autocomplete="off" value="tabsParticipacion4" class="inputParticipacion"> Comité editorial
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 pt-4">
                        <?php
                                if(get_field('agregar_encuesta', get_the_ID()) == 'si')
                                {
                                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                                    $container = new MyBlocksContainer();

                                    $container->views_blocks_container('ContenedorEncuesta');
                                }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>