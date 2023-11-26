<?php
  require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
  $container = new MyBlocksContainer();

  $ancho = get_field('ancho_contenedor_dependencias');

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
?>
    <div class="<?php echo $ancho; ?>">
      <div class="col">
        <div class="row">
          <?php
            if( have_rows('equipos', get_the_ID()) ):
              $cont = 1;
              while ( have_rows('equipos', get_the_ID()) ) : the_row();
                $container->views_blocks_container('ContenedorDependencias', array('ID' => $cont));
                $cont++;
              endwhile;
            else :
                // no layouts found
            endif;
          ?>
        </div>
      </div>
    </div>
<?php

?>