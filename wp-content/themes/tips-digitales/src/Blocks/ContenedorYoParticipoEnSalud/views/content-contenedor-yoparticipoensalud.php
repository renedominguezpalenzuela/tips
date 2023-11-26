<?php
  $ancho = get_field('ancho_contenedor_yoparticipoensalud');

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


  $grid = get_field('diseno_carrusel_yoparticipoensalud');
  $dots = get_field('pestanas_carrusel_yoparticipoensalud');

  switch($grid)
  {
    case '4x2': $colBootstrap = 'col-md-3 col-12';
                $col = 4;
                $row = 2;
                break;

    case '4x1': $colBootstrap = 'col-md-3 col-12';
                $col = 4;
                $row = 1;
                break;

    case '3x2': $colBootstrap = 'col-md-4 col-12';
                $col = 3;
                $row = 2;
                break;

    case '3x1': $colBootstrap = 'col-md-4 col-12';
                $col = 3;
                $row = 1;
                break;

    case '2x2': $colBootstrap = 'col-md-6 col-12';
                $col = 2;
                $row = 2;
                break;

    case '2x1': $colBootstrap = 'col-md-6 col-12';
                $col = 2;
                $row = 1;
                break;

    case '1x1': $colBootstrap = 'col-md-12 col-12';
                $col = 1;
                $row = 1;
                break;
  }

  $lastPosts = $col * $row * $dots;

  $args = array
  (
      'post_type' => 'yoparticipoensalud',
      'order' => 'DESC',
      'numberposts'   => $lastPosts,
      'fields'        => 'ids',
      'post_status'   => 'publish',
  );

  $myPosts = get_posts($args);
?>
  <div class="<?php echo $ancho; ?>">
    <div class="my-2 mb-3 pb-3">
      <div class="container-yoparticipoensalud">
        <div class="col-12">
          <div class="d-flex px-4 px-md-5 pt-5 pb-3">
            <p>
              <span class="iconInfo"></span>
            </p>
            <h3 class="title-container-yoparticipoensalud px-2">
              <?php echo get_field('titulo_carrusel_yoparticipoensalud'); ?>
            </h3>
          </div>
        </div>

        <div class="col-12">
          <div class="yoparticipoensalud-carousel px-5 pb-4" data-row="<?php echo $row; ?>" data-col="<?php echo $col; ?>">
            <?php
              if($myPosts):
                $cont = 0;
                foreach ($myPosts as $myPost):
            ?>
                  <div class="col-md-12 px-2 pb-4">
                    <div class="slickItem sliders-yoparticipo">
                      <div class="row">
                        <div class="col-md-12">
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modal-yoparticipo" data-position="<?php echo $cont; ?>">
                            <img src="<?php echo get_field('miniatura', $myPost); ?>" class="secciones-imagenes-image img-fluid rounded"/>
                            <div class="yoparticipo-titulo-slider">
                              <div class="yoparticipo-titulo-slider-text"><?php echo get_the_title($myPost); ?></div>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
            <?php
                $cont++;
                endforeach;
              endif;
            ?>
          </div>
        </div>

        <div class="modales">
          <div class="modal modal-yoparticipo" id="modal-yoparticipo" aria-labelledby="modal-yoparticipo-Label" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header py-1">
                </div>

                <div class="modal-body modal-body-inmersivo py-2">
                  <div class="yoparticipoensalud-carousel-inmersivo">
                    <?php
                      if($myPosts):
                        foreach ($myPosts as $myPost):
                    ?>
                        <div class="col-md-12">
                          <div class="container-fluid">
                            <div class="col-md-12 pb-0">
                              <button type="button" class="btn-close buttonClose-modal-yoparticipo" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="col-md-12 pt-4">
                              <div class="row">
                                <div class="col-lg-9 col-12">
                                  <div class="d-flex px-2 pt-2">
                                    <p>
                                      <span class="iconInfo"></span>
                                    </p>
                                    <h3 class="title-container-yoparticipoensalud px-2">
                                      <?php echo get_field('titulo_carrusel_yoparticipoensalud'); ?>
                                    </h3>
                                  </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                  <a href="<?php echo get_field('link_carrusel_yoparticipoensalud', $myPost); ?>" class="float-end wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-12 col-sm-12 col-md-12">Ver más</a>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="" id="carrusel-inmersivo-<?php echo $myPost; ?>">
                            <?php
                              if( have_rows('contenido_vista_inmersiva', $myPost) ):

                                while ( have_rows('contenido_vista_inmersiva', $myPost) ) : the_row();

                                  $tipo = get_sub_field('tipo_de_contenido', $myPost);

                                  get_template_part('src/Blocks/ContenedorYoParticipoEnSalud/views/content', $tipo . '-inmersivo', array('ID' => $myPost));

                                endwhile;
                              endif;
                            ?>
                          </div>

                          <div class="px-4 py-2 texto-descriptivo-modal-yoparticipo">
                            <?php
                              echo get_field('texto_descriptivo_vista_inmersiva', $myPost);
                            ?>
                          </div>
                        </div>
                    <?php
                        endforeach;
                      endif;
                    ?>
                  </div>
                </div>

                <div class="modal-footer py-1">
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
<?php

?>