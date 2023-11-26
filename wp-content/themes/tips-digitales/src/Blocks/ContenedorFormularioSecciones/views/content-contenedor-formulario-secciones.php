<?php
  $ancho = get_field('ancho_contenedor_formulario');

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

  $only_user_logged = get_field('only_user_logged');
?>
  <div class="<?php echo $ancho; ?>">
    <div class="col">
      <?php
        if($only_user_logged == 'si'):

          if($userID != 0)
            $classDisabled = 'enabledElement';
          else
            $classDisabled = 'disabledElement';
      ?>
          <div id="<?php echo $classDisabled; ?>">
            <div class="container-formulario-secciones pb-4">
              <?php echo get_field('formulario_contenedor_formulario'); ?>
            </div>
          </div>
      <?php
        else:
      ?>
          <div class="container-formulario-secciones pb-4">
            <?php echo get_field('formulario_contenedor_formulario'); ?>
          </div>
      <?php
        endif;
      ?>
    </div>
  </div>
<?php

?>