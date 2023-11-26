<?php
  $nameDependencia = mb_convert_case(get_sub_field('nombre_de_la_dependencia'), MB_CASE_TITLE, 'UTF-8');
?>

<div class="modal fade modalDependencias" id="modalTARcarousel-<?php echo $args['ID']; ?>"  tabindex="-1" role="dialog" aria-labelledby="modalTARcarousel-<?php echo $args['ID']; ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-7">
              <div class="d-flex">
                <span class="iconInfo me-2"></span>
                <h2 class="title-secciones"><?php echo $nameDependencia; ?></h2>
              </div>        
            </div>

            <div class="col-md-5 mb-4">
              <input class="wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-12 col-sm-12 col-md-6 button-descargar-dependencia" type="button" value="Descargar directorio" data-dependencia="<?php echo $args['ID']; ?>" data-name="<?php echo $nameDependencia; ?>">
            </div>

            <div class="col-12">
              <div id="TARcarousel-<?php echo $args['ID']; ?>" class="dependencia-tipo-a" data-bs-interval="false">
                <?php
                  if( have_rows('participantes') ):
                    while ( have_rows('participantes') ) : the_row();
                      $fotoParticipante = get_sub_field('foto');

                      if($fotoParticipante == "")
                        $fotoParticipante = get_template_directory_uri().'/public/images/default-participante-dependencia.jpg';
                ?>
                      <div class="slickItem">
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <img src="<?php echo $fotoParticipante; ?>" class="img-target" alt="">
                          </div>

                          <div class="col-12 col-md-6 my-auto">
                            <div class="float-left">
                              <h3 class="title-participantes">
                                <?php echo mb_convert_case(get_sub_field('nombre'), MB_CASE_TITLE, 'UTF-8'); ?></h3>
                              <p class="mb-0 descripcion-participantes">
                                <?php echo mb_convert_case(get_sub_field('cargo'), MB_CASE_TITLE, 'UTF-8'); ?></p>
                              <div class="row">
                                <div class="col-12 col-md-10">
                                  <hr class="hrParticipantes m-0">
                                  <p class="descripcion-participantes"><?php echo get_sub_field('correo'); ?></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                <?php
                    endwhile;
                  endif;
                ?>
              </div>
            </div>

            <div class="row exportCanvas" id="exportData-<?php echo $args['ID']; ?>">
              <?php
                if( have_rows('participantes') ):
                  while ( have_rows('participantes') ) : the_row();
                    $fotoParticipante = get_sub_field('foto');

                    if($fotoParticipante == "")
                      $fotoParticipante = get_template_directory_uri().'/public/images/default-participante-dependencia.jpg';
              ?>
                    <div class="row py-4">
                      <div class="col-12 col-md-6">
                        <img src="<?php echo $fotoParticipante; ?>" class="img-target" alt="">
                      </div>

                      <div class="col-12 col-md-6 mt-4">
                        <div class="float-left">
                          <h3 class="title-participantes"><?php echo mb_convert_case(get_sub_field('nombre'), MB_CASE_TITLE, 'UTF-8'); ?></h3>
                          <p class="mb-0 descripcion-participantes"><?php echo mb_convert_case(get_sub_field('cargo'), MB_CASE_TITLE, 'UTF-8'); ?></p>
                          <div class="row">
                            <div class="col-12 col-md-10">
                              <hr class="hrParticipantes m-0">
                              <p class="descripcion-participantes"><?php echo get_sub_field('correo'); ?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
              <?php
                  endwhile;
                endif;
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>