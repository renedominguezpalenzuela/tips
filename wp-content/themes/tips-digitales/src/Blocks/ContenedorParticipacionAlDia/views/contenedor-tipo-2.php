    <div class="container-participacion-al-dia-tipo-2 px-3">
      <div class="page-load-status-container-participacion container-fluid">
          <div class="loader-ellips infinite-scroll-request">
              <span class="loader-ellips__dot"></span>
              <span class="loader-ellips__dot"></span>
              <span class="loader-ellips__dot"></span>
              <span class="loader-ellips__dot"></span>
          </div>
      </div>

      <div class="container-loading-participacion">
      </div>

      <div class="px-4 py-3">
        <h3 class="title-participacion-al-dia-localidad text-center">
          Participación <span class="title-secciones-secondary"> al Día </span><span class="title-localidad-secondary"></span>
        </h3>
        <?php
          $args = array(
              'post_type'      => 'post',
              'numberposts' => 6,
              'orderby'        => 'date',
              'order'          => 'DESC',
              'fields'         => 'ids',
              'category_name'  => 'noticias',
              'post_status'    => 'publish',
          );

          $posts = get_posts($args);

        ?>
        <div class="row mx-4 mb-2 participacion-al-dia-noticias-slider">
          <?php
            if ( $posts ):
              foreach ($posts as $myPost)
              {
          ?>
                <div class="col-12 px-3 mb-2">
                  <a href="<?php echo get_the_permalink($myPost); ?>">
                    <div class="col-10 mx-auto mb-2">
                      <img src="<?php echo get_field('miniatura', $myPost); ?>" class="img-fluid w-100 rounded d-block mx-auto">
                    </div>
                    <div class="col-12">
                      <h3 class="title-sidebar-related">
                        <?php echo get_the_title($myPost); ?>
                      </h3>
                      <div class="resume-sidebar-related mb-2">
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
        </div>

        <div class="col-12 my-2">   
          <?php
            $urlParticipacion =  get_the_permalink(get_page_by_path( 'participacion-al-dia', OBJECT,'secciones' ));

            $urlPublicar = get_the_permalink(get_page_by_path( 'quiero-publicar', OBJECT,'secciones' ));
          ?>

          <div class="row pt-4 justify-content-center">
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