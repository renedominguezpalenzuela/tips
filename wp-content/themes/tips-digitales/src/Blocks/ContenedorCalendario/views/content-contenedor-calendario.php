<?php
    $ancho = get_field('ancho_contenedor_calendario');

    $hasFilters = get_field('utiliza_filtros_contenedor_calendario');

    if($hasFilters == 'si')
    {
        $tipoFilters = get_field('tipos_de_filtros_contenedor_calendario');

        $tax = get_field('filtros_contenedor_calendario');

        $filtros = json_encode($tax);
    }
    else
    {
        $filtros = false;
    }

  if($ancho == '100')
      $ancho = 'col-md-12 col-12';
  else if($ancho == '90')
      $ancho = 'col-lg-10 col-md-12 col-12';
  else if($ancho == '80')
      $ancho = 'col-lg-9 col-md-12 col-12';
  else if($ancho == '70')
      $ancho = 'col-lg-8 col-md-12 col-12';
  else if($ancho == '60')
      $ancho = 'col-lg-7 col-md-12 col-12';
  else if($ancho == '50')
      $ancho = 'col-lg-6 col-md-12 col-12';
  else if($ancho == '40')
      $ancho = 'col-lg-5 col-md-12 col-12';
  else if($ancho == '30')
      $ancho = 'col-lg-4 col-md-12 col-12';
  else if($ancho == '20')
      $ancho = 'col-lg-3 col-md-12 col-12';
  else if($ancho == '10')
      $ancho = 'col-lg-2 col-md-12 col-12';

  $userID = get_current_user_ID();
?>
    <div class="<?php echo $ancho; ?>">
        <div class="col">
            <div class="container-calendario py-3">
                <div class="page-load-status-container-calendario container-fluid">
                    <div class="loader-ellips infinite-scroll-request">
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                    </div>
                </div>

                <div class="container-loading-calendario">
                </div>

                <?php
                    if($hasFilters == 'si' && $tipoFilters == "selector"):
                ?>
                        <div class="selector-filtros col-md-6 col-10 pt-4 d-block mx-auto">
                            <div class="accordion" id="accordion_filtros">
                                <div class="accordion-item p-0">
                                    <div class="accordion-header datos-curso-accordion" id="">
                                        <button id="principalFiltros" class="accordion-button-title accordion-button collapsed" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltros" aria-expanded="false" aria-controls="collapseFiltros">
                                            Eventos
                                        </button>
                                    </div>
                                    <div class="accordion-type-select">
                                        <div id="collapseFiltros" class="accordion-collapse accordion-collapse-calendario collapse collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
                                            <div class="accordion-body accordion-descripcion-scroll mt-3 mb-2 px-2">
                                            <?php
                                                foreach($tax as $taxElement):
                                                
                                                        $term = get_term($taxElement);

                                                        if($term->name == 'Acerca de TIPS')
                                                            $taxElement = $filtros;
                                                        else
                                                            $taxElement = json_encode($taxElement);
                                            ?>
                                                <button type="button" class="eventosElement list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
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

                        </div>
                <?php
                    endif;
                ?>
                <div class="px-3" id='calendar' data-filters="<?php echo $filtros; ?>"></div>

                <span class="container-calendario-info">Haz click sobre la fecha para tener toda la información</span>

            </div>
        </div>

        <?php
            if(is_home() || is_front_page()):
        ?>
                <div class="col pt-lg-4">
        <?php
                if(get_field('agregar_encuesta', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('ContenedorEncuesta');
                }
        ?>
                </div>
        <?php
            endif;
        ?>

    </div>

    <div class="modal fade modal-calendario" id="modalEvents" data-toggle="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-calendario">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-calendario px-4 pt-0 pb-3">
                    <div class="events-container">
                        <h3 class="modal-title-calendario title py-2"></h3>

                        <h6 class="accent modal-subtitle-calendario mb-0">
                            Descripción
                        </h6>

                        <p class="accent modal-descripcion-calendario my-1 mb-3"></p>

                        <h6 class="accent modal-subtitle-calendario mb-0">
                            Dirección
                        </h6>
                        <p class="accent modal-direccion-calendario my-1 mb-3">
                        </p>

                        <div class="row borderBottom">
                            <div class="col-7">
                                <h6 class="accent modal-subtitle-calendario mb-0">
                                    Fecha
                                </h6>
                                <p class="accent modal-fecha-calendario my-1">
                                </p>

                            </div>
                            <div class="col-5 col-5 my-auto">
                                <?php
                                    if($userID == 0):
                                ?>
                                        <a href="<?php echo get_the_permalink(get_page_by_path( 'iniciar-sesion' ) ); ?>" class="wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-12 col-sm-12 col-md-12">Quiero asistir</a>
                                <?php
                                    else:
                                ?>
                                        <input class="wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-12 col-sm-12 col-md-12 modal-button-asistir" type="button" value="Quiero asistir" data-user="<?php echo $userID; ?>" data-event="">
                                <?php
                                    endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>