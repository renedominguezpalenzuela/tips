<?php 
  if(is_home() || is_front_page())
    $ubicacion = 'home';
  else
    $ubicacion = 'internas';

  if($ubicacion == 'internas')
  {
    $classIMG = 'col-10 mx-auto mb-3';
    $px = 'px-0';
  }
  else
  {
    $classIMG = 'col-12 mb-3';
    $px = 'px-3';
  }

?>
    <div class="container-participacion-al-dia-<?php echo $ubicacion; ?> <?php echo $px; ?> py-3">
      <h3 class="title-secciones text-center">Participación <span class="title-secciones-secondary"> al Día </span></h3>
      <?php
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'fields'        => 'ids',
            'category_name'  => 'noticias',
            'post_status'    => 'publish',
        );

        $posts = get_posts($args);

      ?>
      <div class="row mx-2 mb-2">
        <?php
          if ( $posts ):
            foreach ($posts as $myPost)
            {
        ?>
              <div class="col-12 mb-2">
                <a href="<?php echo get_the_permalink($myPost); ?>">
                  <div class="<?php echo $classIMG; ?>">
                    <img src="<?php echo get_field('miniatura', $myPost); ?>" class="img-fluid w-100 rounded d-block mx-auto">
                  </div>
                  <div class="col-12">
                    <h3 class="title-sidebar-related">
                      <?php echo get_the_title($myPost); ?>
                    </h3>
                    <div class="resume-sidebar-related pb-2">
                      <?php echo get_field('resumen', $myPost); ?>
                    </div>
                    <span class="title-sidebar-related float-end">Leer más</span>
                    <div class="linea-divisoria pt-4"></div>
                  </div>
                </a>
              </div>
        <?php
            }
          else:
              // no se encontraron posts
          endif;
        ?>

        <div class="col-12 mb-1 block-noticias-tipo-1-<?php echo $ubicacion; ?>">   
          <?php
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'fields'        => 'ids',
                'category_name'  => 'noticias',
                'post_status'    => 'publish',
                'offset'         => 1 // Omitir el primer post (el más reciente)
            );
          
            $posts = get_posts($args);

            if ( $posts ):
              foreach ($posts as $myPost)
              {
          ?>
                <div class="col-12 my-3">
                  <a href="<?php echo get_the_permalink($myPost); ?>">
                    <div class="row g-0 participacion-al-dia-noticia-contanier">
                      <div class="col-md-6 col-12">
                        <img src="<?php echo get_field('miniatura', $myPost); ?>" class="img-fluid w-100 rounded d-block mx-auto">
                      </div>
                      <div class="col-md-6 col-12 ps-md-3 my-md-auto my-3">
                        <h3 class="title-sidebar-related">
                          <?php echo get_the_title($myPost); ?>
                        </h3>
                        <p class="resume-sidebar-related">
                          <?php echo get_field('resumen', $myPost); ?>
                        </p>
                        <span class="title-sidebar-related float-end">
                          Leer más
                        </span>
                      </div>
                    </div>
                  </a>
                </div>
          <?php
              }
            else:
                // no se encontraron posts
            endif;
            wp_reset_postdata();
          ?>
          <?php
            $urlParticipacion =  get_the_permalink(get_page_by_path( 'participacion-al-dia', OBJECT,'secciones' ));

            $urlPublicar = get_the_permalink(get_page_by_path( 'quiero-publicar', OBJECT,'secciones' ));
          ?>
        </div>

          <div class="col-12 pt-xl-0 pt-lg-2 pt-1">
            <div class="row pt-2">
              <div class="col-md-4 col-12">
                <a href="<?php echo $urlParticipacion . '?noticias'; ?>" class="btn btn-primary p-1 my-1 mx-1 boton_pagination_cursos">Todas las noticias</a>
              </div>
              <div class="col-md-4 col-12">
                <a href="<?php echo $urlPublicar; ?>" class="btn btn-primary p-1 my-1 mx-1 boton_pagination_cursos">Quiero publicar</a>
              </div>
              <div class="col-md-4 col-12">
                <a href="<?php echo $urlParticipacion . '?periodico'; ?>" class="btn btn-primary p-1 my-1 mx-1 boton_pagination_cursos">Periódico impreso</a>
              </div>
            </div>
          </div>

      </div>
    </div>
