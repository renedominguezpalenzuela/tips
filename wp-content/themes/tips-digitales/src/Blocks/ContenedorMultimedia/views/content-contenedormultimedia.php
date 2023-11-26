<?php 
  $grupo_multimedia = get_field('grupo_multimedia', 'option');
  
    if($grupo_multimedia['mostrar_contenedor'] == 'si'):
?>
      <!-- Modal -->
      <div class="modal fade modal-multimedia" id="modalMultimedia" tabindex="-1" role="dialog" aria-labelledby="modalMultimediaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body border-0">
              <div class="video">
                <?php echo $grupo_multimedia['contenedor_youtube']; ?>
              </div>
              <div class="titulo">
                <span><?php echo $grupo_multimedia['titulo']; ?></span>
              </div>
              <div class="descripcion">
                <span><?php echo $grupo_multimedia['descripcion']; ?></span>
              </div>
            </div>
            <div class="modal-footer border-0">
              <?php
                if( have_rows('contenedor_botones', 'option') ):
                  while ( have_rows('contenedor_botones', 'option') ) : the_row();
                    if( get_row_layout() == 'boton_si' ):
                      ?>
                        <button type="button" class="btn btn-multimedia btn-multimedia-si"><?php echo get_sub_field('titulo_boton'); ?></button>
                      <?php
                    elseif( get_row_layout() == 'boton_no' ):
                      ?>
                        <button type="button" class="btn btn-multimedia btn-multimedia-no" data-bs-dismiss="modal"><?php echo get_sub_field('titulo_boton'); ?></button>
                      <?php
                    endif;
                  endwhile;
                endif;
              ?>
            </div>
          </div>
        </div>
      </div>
<?php
    endif;
?>
<script>
  var showModalMultimedia = '<?php echo $grupo_multimedia['mostrar_contenedor']; ?>';
</script>
