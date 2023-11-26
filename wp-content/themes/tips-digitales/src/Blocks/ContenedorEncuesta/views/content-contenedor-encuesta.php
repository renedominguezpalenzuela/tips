<?php
  $ancho = get_field('ancho_contenedor_encuesta');

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

  $tipo = get_field('tipo_de_encuesta');
  $encuestaID = get_field('encuesta_id');

?>
<div class="<?php echo $ancho; ?> pt-lg-0 pt-4">
  <div class="col">
    <div class="container-encuesta px-4 py-4">
      <div class="container-fluid">
        <?php
          get_template_part('src/Blocks/ContenedorEncuesta/views/contenedor', $tipo, array('encuestaID' => $encuestaID));
        ?>
      </div>
    </div>
  </div>
</div>