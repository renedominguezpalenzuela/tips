<?php
    $args = [
        'post_type'      => 'secciones',
        'posts_per_page' => 1,
        'post_name__in'  => ['donde-esta-tips-en-bogota'],
        'fields'         => 'ids' 
    ];
    $pageID = get_posts( $args )[0];

    $bibliotecaURL = get_field('link_biblioteca_tips', $pageID);
    $equipoParticipacionURL = get_field('link_contacta_a_tu_gestor', $pageID);

    if(get_field('agregar_todas_localidades') == 'si')
    {
        $args = array (
            'taxonomy' => 'localidades',
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false
        );

        $localidadesFilters = get_terms($args);
    }
    else
    {
        $localidadesFilters = get_field('localidades_mapa');
    }
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

                <div class="col-12 col-md-12 my-3">
                    <?php
                        if(get_field('agregar_mapa', get_the_ID()) == 'si')
                        {
                            require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                            $container = new MyBlocksContainer();

                            if(get_field('tipo_de_mapa', get_the_ID()) == 'general')
                                $container->views_blocks_container('ContenedorFiltrosMapaGeneral');
                            else
                                $container->views_blocks_container('ContenedorFiltrosMapaIniciativas');
                        }
                    ?>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                <?php
                    if(get_field('agregar_mapa', get_the_ID()) == 'si')
                    {
                        require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                        $container = new MyBlocksContainer();

                        if(get_field('tipo_de_mapa', get_the_ID()) == 'general')
                            $container->views_blocks_container('ContenedorMapaGeneral');
                        else
                            $container->views_blocks_container('ContenedorMapaIniciativas');
                    }
                ?>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                <div class="row mx-2 my-2">
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
        </div>

        <div class="container-fluid">
            <div class="row mx-1 pb-4">
                <?php
                    if(get_field('agregar_timeline', get_the_ID()) == 'si')
                    {
                        require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                        $container = new MyBlocksContainer();

                        $container->views_blocks_container('ContenedorTimeline');
                    }
                ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mx-1 pb-5">
                <div class="col-12 mx-auto">
                    <div class="row">
                        <?php
                            if(get_field('agregar_participacion', get_the_ID()) == 'si')
                            {
                                require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                                $container = new MyBlocksContainer();

                                $container->views_blocks_container('ContenedorParticipacionAlDia');
                            }
                        ?>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-5 mb-3">
                            <div class="px-0">
                                <div class="bloque-info-filtros-left p-2">
                                    <div class="container-fluid px-4 pt-4 m-1">
                                        <div class="d-flex">
                                            <span class="iconInfo me-2"></span>
                                            <h3 class="title-bloque-info-filtros">Más sobre Iniciativas</h3>
                                        </div>
                                        <h3 class="ms-3 title-bloque-info-filtros titulo-filtros-mapa-1">
                                        </h3>
                                    </div>
                                    <div class="container-fluid pb-0">
                                        <div class="row mx-auto">
                                            <div class="col">
                                            </div>
                                            <div class="col-md-auto py-2">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-dialogos-agendas">
                                                    <img src="<?php echo get_template_directory_uri() . '/public/images/dialogos-agenda.png'; ?>" class="img-fluid rounded mx-auto d-block"/>
                                                </a>
                                            </div>
                                            <div class="col">
                                            </div>
                                        </div>
                                        <div class="row mx-auto">
                                            <div class="col">
                                            </div>
                                            <div class="col-md-auto pt-2 pb-5">
                                                <div class="row">
                                                    <div class="col-md-6 col-6 mx-auto">
                                                        <a href="<?php echo $bibliotecaURL; ?>">
                                                            <img src="<?php echo get_template_directory_uri() . '/public/images/biblioteca-icon.png'; ?>" class="img-fluid rounded mx-auto d-block"/>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6 col-6 mx-auto">
                                                        <a href="<?php echo $equipoParticipacionURL; ?>">
                                                            <img src="<?php echo get_template_directory_uri() . '/public/images/contactar-icon.png'; ?>" class="img-fluid rounded mx-auto d-block"/>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modales">
                <div class="modal" id="modal-dialogos-agendas" aria-labelledby="Label" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered modal-xl px-3">
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
                                  <h3 class="px-2 title-bloque-info-filtros titulo-modal-filtros-mapa-1">Diálogos Ciudadanos y Agenda Social en iniciativas Ciudadanas
                                  </h3>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal-body py-2 px-4 row">
                        <div class="col-lg-3 col-md-12 col-12">
                            <div class="accordion accordionLocalidades">
                                <div class="accordion-item px-2 py-4 pb-1">
                                    <div class="accordion-header datos-curso-accordion" id="">
                                        <button id="accordion_filtros_localidades_modal" class="accordion-button-title accordion-button collapsed" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosLocalidadModal" aria-expanded="true" aria-controls="collapseFiltrosLocalidadModal" data-temp='Localidad'>
                                            Localidad
                                        </button>
                                    </div>
                                    <div class="accordion-type-select">
                                        <div id="collapseFiltrosLocalidadModal" class="accordion-collapse accordion-collapse-filtros collapse show collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
                                            <div class="accordion-body accordion-descripcion-localidades mt-3 mb-2 px-2">
                                                <?php
                                                foreach($localidadesFilters as $term):

                                                    $taxElement = json_encode($term->term_id);
                                                    ?>
                                                    <button type="button" class="ElementFiltrosLocalidadModal list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
                                                        <?php echo $term->name; ?>
                                                    </button>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dataLocalidades">
                                <?php
                                    if( have_rows('videos_y_agendas', $pageID) ):
                                        while( have_rows('videos_y_agendas', $pageID) ) : the_row();
                                            $localidad = get_sub_field('localidad', $pageID);
                                            $video = get_sub_field('video', $pageID);

                                            $poster = get_field('video_poster', $pageID);

                                            if($poster == '')
                                              $poster = get_template_directory_uri() . '/public/images/video-poster.png';

                                            $agenda = get_sub_field('agenda', $pageID);
                                ?>
                                            <div class="infoLocalidad-<?php echo $localidad; ?>" data-video="<?php echo $video; ?>" data-agenda="<?php echo $agenda; ?>", data-poster="<?php echo $poster; ?>">
                                            </div>
                                <?php
                                        endwhile;
                                    else :
                                    endif;
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12 col-12">
                            <div class="container-vista-inmersiva-multimedia-donde-esta-tips py-4">
                                <div class="video row d-block mx-auto">
                                    <video class="disabled" id="videoPlayer" width="100%" height="400" preload controls>
                                        <source src="" id="videoSource" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="row pb-4">
                        <div class="col-md-12">
                            <a href="" class="d-block mx-auto wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-md-4 disabled" id="agendaFile" download>Descargar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modales">
        <div class="modal" id="modal-contactar-iniciativa" aria-labelledby="Label" tabindex="-1">
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
                          <h3 class="px-2 title-bloque-info-filtros titulo-modal-filtros-mapa-1">Contactar iniciativa
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