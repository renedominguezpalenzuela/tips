<div class="modal fade modalDependencias" id="modalTARcarousel-<?php echo $args['ID']; ?>"  tabindex="-1" role="dialog" aria-labelledby="modalTARcarousel-<?php echo $args['ID']; ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
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
                <h2 class="title-secciones"><?php echo get_sub_field('nombre_de_la_dependencia'); ?></h2>
              </div>
            </div>

            <div class="col-md-5">
              <input class="wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-12 col-sm-12 col-md-6" type="button" value="Descargar directorio" onclick="exportPDF('exportData-<?php echo $args['ID']; ?>')">
            </div>

            <div class="col-12">
              <div id="TARcarousel-<?php echo $args['ID']; ?>" class="multi-item-carousel">
                <?php
                  if( have_rows('participantes') ):
                    while ( have_rows('participantes') ) : the_row();
                ?>
                      <div class="col-12 col-md-6 mb-4">
                        <div class="slickItem my-4">
                          <h3 class="mb-0 title-participantes"><?php echo get_sub_field('nombre'); ?></h3>
                          <p class="mb-0 descripcion-participantes"><?php echo get_sub_field('cargo'); ?></p>
                          <div class="row">
                            <div class="col-12 col-md-11">
                              <hr class="hrParticipantes m-0">
                              <p class="descripcion-participantes"><?php echo get_sub_field('correo'); ?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                <?php
                    endwhile;
                  endif;
                ?>
              </div>

              <div class="row exportCanvas" id="exportData-<?php echo $args['ID']; ?>">
                <?php
                  if( have_rows('participantes') ):
                    while ( have_rows('participantes') ) : the_row();
                ?>
                      <div class="col-12 col-md-6 mb-4">
                        <div class="slickItem my-4">
                          <h3 class="mb-0"><?php echo get_sub_field('nombre'); ?></h3>
                          <p class="mb-0"><?php echo get_sub_field('cargo'); ?></p>
                          <div class="row">
                            <div class="col-12 col-md-11">
                              <hr class="hrParticipantes m-0">
                              <p class=""><?php echo get_sub_field('correo'); ?></p>
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
</div>