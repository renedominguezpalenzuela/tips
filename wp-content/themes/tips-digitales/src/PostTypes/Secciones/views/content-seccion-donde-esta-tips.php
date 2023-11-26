<?php
    $bibliotecaURL = get_field('link_biblioteca_tips');
    $equipoParticipacionURL = get_field('link_contacta_a_tu_gestor');

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

                <h1 class="title-secciones px-md-4 px-2">
                    <?php echo get_the_title(); ?>
                </h1>
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

            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-2">
                <div class="row mx-3 my-2">
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
    </div>

    <div class="container-fluid" id="bloque-info-filtros">
        <div class="row mx-md-3 px-md-4 pt-lg-2 pt-2">
            <div class="col-12 col-sm-12 col-md-12 col-lg-5 mb-3">
                <div class="px-0">
                    <div class="bloque-info-filtros-left p-2">
                        <div class="container-fluid px-4 pt-4 m-1">
                            <div class="d-flex">
                                <span class="iconInfo me-2"></span>
                                <h3 class="title-bloque-info-filtros">Más sobre</h3>
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
                                <div class="col-md-auto col-sm-auto col-auto pt-2 pb-5">
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

            <div class="col-12 col-sm-12 col-md-12 col-lg-7 mb-0">
                <div class="px-3">
                    <div class="row">
                        <div class="container-fluid px-md-4 px-4 pt-2 mx-1 mt-1">
                            <div class="d-flex">
                                <span class="iconInfo me-2"></span>
                                <h3 class="title-bloque-info-filtros titulo-filtros-mapa-1"></h3>
                            </div>

                            <div class="row">
                                <div class="descripcion-bloque-info-filtros pt-3">
                                    <?php
                                        if( have_rows('descripcion_por_filtro') ):
                                            while( have_rows('descripcion_por_filtro') ) : the_row();
                                                $filtroID = get_sub_field('filtro');
                                                $descripcionFija = get_sub_field('descripcion');
                                    ?>
                                                <div id="filtroID-<?php echo $filtroID; ?>">
                                                    <?php echo $descripcionFija; ?>
                                                </div>
                                    <?php
                                            endwhile;
                                        else :
                                        endif;
                                    ?>
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
                              <h3 class="px-2 title-bloque-info-filtros titulo-modal-filtros-mapa-1">
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
                                if( have_rows('videos_y_agendas') ):
                                    while( have_rows('videos_y_agendas') ) : the_row();
                                        $localidad = get_sub_field('localidad');
                                        $video = get_sub_field('video');

                                        $poster = get_sub_field('video_poster');
                                        if($poster == '')
                                            $poster = get_template_directory_uri() . '/public/images/video-poster.png';

                                        $agenda = get_sub_field('agenda');
                            ?>
                                        <div class="infoLocalidad-<?php echo $localidad; ?>" data-video="<?php echo $video; ?>" data-poster="<?php echo $poster; ?>" data-agenda="<?php echo $agenda; ?>">
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
                                <video class="disabled" id="videoPlayer" width="100%" preload controls>
                                    <source src="" id="videoSource" type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div>
                  </div>

                  <div class="row px-5 pb-4">
                    <div class="col-md-12">
                        <a href="" class="d-block mx-auto wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-md-4 disabled" id="agendaFile" download>Descargar agenda de la localidad</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bloque-hide" id="bloque-info-proyectos-de-inversion">
        <div class="row mx-md-3 px-md-4 pt-lg-2 pt-4">
            <div class="col-12 mb-4">
                <div class="px-0">
                    <div class="bloque-proyectos-de-inversion px-3">
                        <div class="container-fluid px-1 pt-4 m-1">
                            <div class="row">
                                <div class="d-flex col-md-7">
                                    <span class="iconInfo me-2"></span>
                                    <h3 class="title-bloque-info-filtros">
                                        <?php echo get_field('titulo_proyectos_de_inversion_local'); ?>
                                    </h3>
                                </div>

                                <div class="col-md-5 py-0 d-lg-block d-none">
                                    <div class="marginTop-5 accordion accordionLocalidades">
                                        <div class="accordion-item px-2 pb-4">
                                            <div class="accordion-header datos-curso-accordion" id="">
                                                <button id="accordion_filtros_localidades_PDI_B" class="accordion-button-title accordion-button collapsed" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosLocalidadPDI" aria-expanded="true" aria-controls="collapseFiltrosLocalidadPDI" data-temp='Localidad'>
                                                    Localidad
                                                </button>
                                            </div>
                                            <div class="accordion-type-select">
                                                <div id="collapseFiltrosLocalidadPDI" class="accordion-collapse accordion-collapse-filtros collapse show collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
                                                    <div class="accordion-body accordion-descripcion-localidades mt-3 mb-2 px-2">
                                                        <?php
                                                        foreach($localidadesFilters as $term):

                                                            $taxElement = json_encode($term->term_id);
                                                            ?>
                                                            <button type="button" class="ElementFiltrosLocalidadPDI list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
                                                                <?php echo $term->name; ?>
                                                            </button>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                        <button type="button" class="ElementFiltrosLocalidadPDI list-group-item list-group-item-action" data-name="Todas las localidades" data-term="0">
                                                            Todas las localidades
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid pb-2">
                            <div class="row mx-auto">
                                <div class="col-md-12 col-12 px-md-5 py-lg-0 py-md-3 py-3 d-lg-none d-block">
                                    <div class="accordion accordionLocalidades">
                                        <div class="accordion-item px-2 pt-0 pb-2">
                                            <div class="accordion-header datos-curso-accordion" id="">
                                                <button id="accordion_filtros_localidades_PDI_T" class="accordion-button-title accordion-button collapsed" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosLocalidadPDI" aria-expanded="true" aria-controls="collapseFiltrosLocalidadPDI" data-temp='Localidad'>
                                                    Localidad
                                                </button>
                                            </div>
                                            <div class="accordion-type-select">
                                                <div id="collapseFiltrosLocalidadPDI" class="accordion-collapse accordion-collapse-filtros collapse show collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
                                                    <div class="accordion-body accordion-descripcion-localidades mt-3 mb-2 px-2">
                                                        <?php
                                                        foreach($localidadesFilters as $term):

                                                            $taxElement = json_encode($term->term_id);
                                                            ?>
                                                            <button type="button" class="ElementFiltrosLocalidadPDI list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
                                                                <?php echo $term->name; ?>
                                                            </button>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                        <button type="button" class="ElementFiltrosLocalidadPDI list-group-item list-group-item-action" data-name="Todas las localidades" data-term="0">
                                                            Todas las localidades
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 px-md-5">
                                    <div class="proyectos-inversion-local-carousel">
                                        <?php
                                            if( have_rows('elementos_carrusel') ):
                                                while( have_rows('elementos_carrusel') ) : the_row();

                                                    $localidadesClass = '';
                                                    $localidadesTemp = get_sub_field('localidad');
                                                    
                                                    foreach($localidadesTemp as $localidad)
                                                    {
                                                        $localidadesClass .= 'localidadPDI-' . $localidad . ' ';
                                                    }

                                                    $poster = get_sub_field('miniatura');
                                                    if($poster == '')
                                                      $poster = get_template_directory_uri() . '/public/images/video-poster.png';
                                        ?>
                                                    <div class="col-md-12 px-2 pb-4 <?php echo $localidadesClass; ?>">
                                                        <div class="sliders-proyectos-inversion-local">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-proyectos-inversion-local" data-video="<?php echo get_sub_field('video'); ?>" data-poster="<?php echo $poster; ?>">
                                                                        <img src="<?php echo get_sub_field('miniatura'); ?>" class="img-fluid rounded"/>
                                                                    </a>
                                                                    <div class="proyectos-inversion-local-titulo-slider">
                                                                        <div class="title-bloque-info-filtros py-3 pb-1">
                                                                            <?php echo get_sub_field('titulo'); ?>
                                                                        </div>

                                                                        <div class="descripcion-bloque-info-filtros">
                                                                            <?php echo get_sub_field('descripcion'); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                        <?php
                                                endwhile;
                                            else :
                                            endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modales">
                            <div class="modal" id="modal-proyectos-inversion-local" aria-labelledby="Label" tabindex="-1">
                              <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header py-4">
                                    <div class="container-fluid">
                                      <div class="col-md-12 pb-0">
                                        <button type="button" class="btn-close buttonClose-modal-proyectos-inversion-local" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="modal-body py-1 px-4 row">
                                    <div class="col-md-12 col-12">
                                        <div class="container-vista-inmersiva-multimedia-donde-esta-tips">
                                            <div class="video row d-block mx-auto">
                                                <video id="videoPlayer-proyectos-inversion-local" width="100%" height="100%" preload controls>
                                                    <source src="" id="videoSource-proyectos-inversion-local" type="video/mp4">
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row py-1 px-4">
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4">
                <div class="px-0">
                    <div class="row">
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
            </div>
        </div>
    </div>

    <div class="container-fluid bloque-hide" id="bloque-info-oficinas-participacion">
        <div class="row mx-md-3 px-md-4 p-2 pb-4">
            <div clss="col-12 col-sm-12 col-md-12 mb-3">
                <div class="px-0">
                    <div class="bloque-oficinas-participacion px-3">
                        <div class="container-fluid px-1 pt-4 m-1">
                            <div class="d-flex">
                                <span class="iconInfo me-2"></span>
                                    <?php
                                        if( have_rows('subredes') ):
                                            while( have_rows('subredes') ) : the_row();

                                                $localidadesClass = '';
                                                $localidadesTemp = get_sub_field('localidad');
                                                
                                                foreach($localidadesTemp as $localidad)
                                                {
                                                    $localidadesClass .= 'localidadSubred-' . $localidad . ' ';
                                                }
                                    ?>
                                                <h3 class="title-bloque-info-filtros localidadesSUBRED <?php echo $localidadesClass; ?>">
                                                    SUBRED <?php echo get_sub_field('titulo'); ?>
                                                </h3>
                                    <?php
                                            endwhile;
                                        endif;
                                    ?>
                            </div>
                        </div>
                        <div class="container-fluid pb-0">
                            <div class="row">
                                <div class="col-xl-7 col-lg-6 col-md-12 col-12 px-4">
                                    <?php
                                        if( have_rows('subredes') ):
                                            while( have_rows('subredes') ) : the_row();

                                                $localidadesClass = '';
                                                $localidadesTemp = get_sub_field('localidad');
                                                
                                                foreach($localidadesTemp as $localidad)
                                                {
                                                    $localidadesClass .= 'localidadSubred-' . $localidad . ' ';
                                                }
                                    ?>
                                                <p class="descripcion-bloque-info-filtros py-3 localidadesSUBRED <?php echo $localidadesClass; ?>">
                                                    <?php echo get_sub_field('descripcion'); ?>
                                                </p>
                                    <?php
                                            endwhile;
                                        endif;
                                    ?>
                                </div>

                                <div class="col-xl-5 col-lg-6 col-md-12 col-12 px-md-4 px-3">
                                    <?php
                                        if( have_rows('subredes') ):
                                            while( have_rows('subredes') ) : the_row();

                                                $localidadesClass = '';
                                                $localidadesTemp = get_sub_field('localidad');
                                                
                                                foreach($localidadesTemp as $localidad)
                                                {
                                                    $localidadesClass .= 'localidadSubred-' . $localidad . ' ';
                                                }

                                                $imgSubred = get_sub_field('imagen_subredes');

                                                if($imgSubred):
                                    ?>
                                                    <img src="<?php echo $imgSubred; ?>" class="img-fluid mx-auto rounded localidadesSUBRED <?php echo $localidadesClass; ?>" />
                                    <?php
                                                endif;
                                            endwhile;
                                        endif;
                                    ?>
                                    <?php 
                                        $idBoton = get_field('boton_conoce_al_equipo_de_participacion');
                                    ?>
                                    <a href="<?php echo get_the_permalink($idBoton); ?>" class="d-block mx-auto my-4 wpcf7-form-control button-tips btn btn-primary col-md-8">
                                        <?php echo get_the_title($idBoton); ?>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bloque-hide" id="bloque-info-laboratorio-tips">
        <div class="row mx-md-3 px-md-4 p-2 pb-4">
            <div clss="col-12 col-sm-12 col-md-12 mb-3">
                <div class="px-0">
                    <div class="bloque-laboratorio-tips px-3">
                        <div class="container-fluid px-1 pt-4 m-1">
                            <div class="row">
                                <div class="d-flex col-md-7">
                                    <span class="iconInfo me-2"></span>
                                    <h3 class="title-bloque-info-filtros">
                                        <?php echo get_field('titulo_laboratorio_tips'); ?>
                                    </h3>
                                </div>

                                <div class="col-md-5 py-0 d-lg-block d-none">
                                    <div class="marginTop-5 accordion accordionLocalidades">
                                        <div class="accordion-item px-2 pb-4">
                                            <div class="accordion-header datos-curso-accordion" id="">
                                                <button id="accordion_filtros_localidades_LT_B" class="accordion-button-title accordion-button collapsed" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosLocalidadLT" aria-expanded="true" aria-controls="collapseFiltrosLocalidadLT" data-temp='Localidad'>
                                                    Localidad
                                                </button>
                                            </div>
                                            <div class="accordion-type-select">
                                                <div id="collapseFiltrosLocalidadLT" class="accordion-collapse accordion-collapse-filtros collapse show collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
                                                    <div class="accordion-body accordion-descripcion-localidades mt-3 mb-2 px-2">
                                                        <?php
                                                            foreach($localidadesFilters as $term):

                                                                $taxElement = json_encode($term->term_id);
                                                            ?>
                                                            <button type="button" class="ElementFiltrosLocalidadLT list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
                                                                <?php echo $term->name; ?>
                                                            </button>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                        <button type="button" class="ElementFiltrosLocalidadLT list-group-item list-group-item-action" data-name="Todas las localidades" data-term="0">
                                                            Todas las localidades
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid pb-0">
                            <div class="row">
                                <div class="col-md-12 px-md-5 px-2">
                                    <div class="row">
                                        <div class="col-12 px-md-5 px-3 pb-4 d-lg-none d-block">
                                            <div class="accordion accordionLocalidades">
                                                <div class="accordion-item px-2 py-4 pb-1">
                                                    <div class="accordion-header datos-curso-accordion" id="">
                                                        <button id="accordion_filtros_localidades_LT_T" class="accordion-button-title accordion-button collapsed" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosLocalidadLT" aria-expanded="true" aria-controls="collapseFiltrosLocalidadLT" data-temp='Localidad'>
                                                            Localidad
                                                        </button>
                                                    </div>
                                                    <div class="accordion-type-select">
                                                        <div id="collapseFiltrosLocalidadLT" class="accordion-collapse accordion-collapse-filtros collapse show collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
                                                            <div class="accordion-body accordion-descripcion-localidades mt-3 mb-2 px-2">
                                                                <?php
                                                                    foreach($localidadesFilters as $term):

                                                                        $taxElement = json_encode($term->term_id);
                                                                    ?>
                                                                    <button type="button" class="ElementFiltrosLocalidadLT list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
                                                                        <?php echo $term->name; ?>
                                                                    </button>
                                                                    <?php
                                                                endforeach;
                                                                ?>
                                                                <button type="button" class="ElementFiltrosLocalidadLT list-group-item list-group-item-action" data-name="Todas las localidades" data-term="0">
                                                                    Todas las localidades
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8 col-11 mx-auto pt-3 pb-4">
                                            <div class="sliders-laboratorio-tips-big">
                                            <?php
                                                $poster = get_field('poster_video_laboratirio_tips');
                                                if($poster == '')
                                                  $poster = get_template_directory_uri() . '/public/images/video-poster.png';
                                            ?>
                                                <video id="videoPlayer-laboratorio-tips" width="100%" height="100%" poster="<?php echo $poster;?>" preload controls>
                                                    <source src="<?php echo get_field('video_laboratirio_tips');?>" id="videoSource-laboratorio-tips" type="video/mp4">
                                                </video>

                                                <img src="" id="image-laboratorio-tips" style="width: 100%; height: 100%;display:none;" />
                                            </div>
                                        </div>


<div class="col-md-12">
    <div class="sliders-laboratorio-tips-thumbnails">
        <?php
            if( have_rows('elementos_carrusel_laboratorio_tips') ):
                $cont = 0;

                while( have_rows('elementos_carrusel_laboratorio_tips') ) : the_row();

                    $localidadesClass = '';
                    $localidad = get_sub_field('localidad');
                    
                    $localidadesClass .= 'localidadLT-B-' . $localidad . ' ';

                    if( have_rows('multimedia') ):
                        while( have_rows('multimedia') ) : the_row();
        ?>
                            <div class="col-md-12 px-2 pb-4 <?php echo $localidadesClass; ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="#modal-laboratorio-tips" data-bs-toggle="modal" class="showLabTipsImageModal" data-image="<?php echo get_sub_field('miniatura')['sizes']['large']; ?>">
                                            <img data-lazy="<?php echo get_sub_field('miniatura')['sizes']['thumbnail']; ?>" class="img-fluid rounded" data-no-lazy="1"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
        <?php
                        $cont++;
                        endwhile;
                    else :
                    endif;
                endwhile;
            else :
            endif;
        ?>
    </div>
</div>

<!--
<div class="modales">
    <div class="modal" id="modal-laboratorio-tips" aria-labelledby="Label" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header py-4">
            <div class="container-fluid">
              <div class="col-md-12 pb-0">
                <button type="button" class="float-end btn-close buttonClose-laboratorio-tips" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            </div>
          </div>

          <div class="modal-body py-1 px-4 row">
            <div class="col-md-12 col-12">
                <div class="container-vista-inmersiva-multimedia-donde-esta-tips">
                    <div class="row d-block mx-auto">
                        <img src="" id="image-laboratorio-tips" class=""/>
                    </div>
                </div>
            </div>
          </div>

          <div class="row py-1 px-4">
          </div>
        </div>
      </div>
    </div>
</div>->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>