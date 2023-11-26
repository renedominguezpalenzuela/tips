<div class="container-fluid">
  <div class="row mx-4 my-2">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
      <div class="row mb-3 px-md-4 px-4 pb-3">

        <?php
          if( have_rows('timeline', get_the_ID()) ):
        ?>
            <div class="col container-timeline pt-5">
                <div class="box-timeline">
                    <ul class='timeline'>
                        <?php
                            while ( have_rows('timeline', get_the_ID()) ) : the_row();
                                $dateTemp = get_sub_field('fecha_evento');
                                $fecha = explode(' ', $dateTemp);
                        ?>
                                <li>
                                    <div class="fecha-timeline d-flex">
                                        <div class="titleIcon">
                                            <span class="iconWaterBlue"></span>
                                            <span class="iconWater"></span>
                                        </div>
                                        <div class="fecha-text-timeline">
                                            <h3 class="mb-0"><?php echo $fecha[0]; ?></h3>
                                            <h3 class="mb-0"><?php echo $fecha[1]; ?></h3>
                                        </div>
                                    </div>

                                    <div class="titulo-timeline">
                                        <?php echo get_sub_field('titulo_evento'); ?>
                                    </div>

                                    <div class="descripcion-timeline">
                                        <?php echo get_sub_field('descripcion_evento'); ?>
                                    </div>
                                </li>
                        <?php
                            endwhile;
                        ?>
                    </ul>
                </div>
            </div>
        <?php
            else :
                // no layouts found
            endif;
        ?>
      </div>
    </div>
  </div>
</div>
<?php

?>