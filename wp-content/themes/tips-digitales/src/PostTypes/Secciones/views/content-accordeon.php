<div class="col-lg-3 col-md-6 col-12 pb-3 accordion" id="accordion_<?php echo $args['ID']; ?>">
  <div class="accordion-item p-0">
    <div class="accordion-header datos-curso-accordion" id="">
      <button class="accordion-button-participantes accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $args['ID']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $args['ID']; ?>">
        <?php echo get_sub_field('nombre_del_equipo'); ?>
      </button>
    </div>
    <div class="accordion-type-select">
      <div id="collapse<?php echo $args['ID']; ?>" class="accordion-collapse collapse collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
        <div class="accordion-body accordion-descripcion-cursos mt-3 mb-2 px-2">
					<?php
					    if( have_rows('dependencias') ):
                $cont = 1;
  							while ( have_rows('dependencias') ) : the_row();
					?>
                  <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#modalTARcarousel-<?php echo $args['ID']; ?>-<?php echo $cont; ?>">
                  	<?php echo get_sub_field('nombre_de_la_dependencia'); ?>
                  </button>
				  <?php
                  $cont++;
  							endwhile;
  						endif;
					?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  if( have_rows('dependencias') ):
    $cont = 1;
    while ( have_rows('dependencias') ) : the_row();

      $tipo = get_sub_field('tipo_de_la_dependencia');

      get_template_part('src/PostTypes/Secciones/views/content', 'dependencia-' . $tipo, array('ID' => $args['ID'] . '-' . $cont) );

      $cont++;
    endwhile;
  endif;
?>