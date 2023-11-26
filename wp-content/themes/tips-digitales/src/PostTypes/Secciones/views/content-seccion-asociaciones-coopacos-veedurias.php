<?php 
    if(isset($_GET['mapaID']))
        $scroll = 'true';
    else
        $scroll = 'false';
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

    <div class="container-fluid" id="ACOVE" data-scroll="<?php echo ($scroll); ?>">
        <div class="row px-md-4 px-2 pb-5">
            <?php
                if(get_field('agregar_mapa', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();
            ?>
                    <div class="col-lg-4 col-12">
                        <?php
                            if(get_field('tipo_de_mapa', get_the_ID()) == 'general')
                                $container->views_blocks_container('ContenedorFiltrosMapaGeneral');
                            else if(get_field('tipo_de_mapa', get_the_ID()) == 'iniciativas')
                                $container->views_blocks_container('ContenedorFiltrosMapaIniciativas');
                            else
                                $container->views_blocks_container('ContenedorFiltrosMapaOtros');
                        ?>
                    </div>
                    <div class="col-lg-8 col-12">
                        <?php
                            if(get_field('tipo_de_mapa', get_the_ID()) == 'general')
                                $container->views_blocks_container('ContenedorMapaGeneral');
                            else if(get_field('tipo_de_mapa', get_the_ID()) == 'iniciativas')
                                $container->views_blocks_container('ContenedorMapaIniciativas');
                            else
                                $container->views_blocks_container('ContenedorMapaOtros');
                        ?>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="modales">
        <div class="modal" id="modal-contactar-asociacion" aria-labelledby="Label" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header py-1">
                    <div class="container-fluid">
                      <div class="col-md-12 pb-0">
                        <button type="button" class="btn-close buttonClose-modal-dialogos-agendas" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="col-md-12 pt-4">
                        <div class="row">
                          <div class="col-lg-9 col-12">
                            <div class="d-flex">
                              <span class="iconInfo me-2"></span>
                              <h3 class="px-2 title-bloque-info-filtros titulo-modal-filtros-mapa-1">Contactar <?php echo get_the_title(); ?>
                              </h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal-body py-2 px-4 row">
                    <div class="col-md-12 col-12">
                        <?php
                            echo get_field('formulario_contacto');
                        ?>
                    </div>
                  </div>
                </div>
            </div>
        </div>


        <div class="modal" id="modal-informes-asociacion" aria-labelledby="Label" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header py-1">
                    <div class="container-fluid">
                      <div class="col-md-12 pb-0">
                        <button type="button" class="btn-close buttonClose-modal-dialogos-agendas" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="col-md-12 pt-4">
                        <div class="row">
                          <div class="col-lg-9 col-12">
                            <div class="d-flex">
                              <span class="iconInfo me-2"></span>
                              <h3 class="px-2 title-bloque-info-filtros titulo-modal-filtros-mapa-1">Informes <?php echo get_the_title(); ?>
                              </h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal-body py-2 px-4 row">
                    <div class="col-md-12 col-12">
                        <div id="bodyModalInformes">
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>