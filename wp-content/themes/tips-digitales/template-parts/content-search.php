<div class="container">
  <div class="container">
    <div class="d-flex px-4 px-md-5 pt-5 pb-3">
      <span class="iconInfo"></span>
      <h3 class="title-container-yoparticipoensalud px-2">
      	<?php
				/* translators: %s: search query. */
			   printf( esc_html__( 'Encontramos estos resultados sobre: "%s"', 'tips-digitales' ), '<span>' . get_search_query() . '</span>' );
				?>
		  </h3>
		</div>
			
    <div class="col-md-12">
      <div class="row">
        <?php
            while ( have_posts() ):
              the_post();

              $postType = get_post_type(get_the_ID());

              $imageThumb = '';
              $desc = '';
              $url = '';
              
              if($postType == 'secciones'):
                $imageThumb = get_field('imagen_estatica', get_the_ID());
                $desc = get_field('descripcion', get_the_ID());
              elseif($postType == 'cursos'):
                $imageThumb = get_field('imagen_curso', get_the_ID());
                $desc = get_field('descripcion', get_the_ID());
              elseif($postType == 'eventos'):
                $imageThumb = get_field('pieza_grafica', get_the_ID());
                $desc = get_field('descripcion', get_the_ID());
              elseif($postType == 'post'):
                $imageThumb = get_field('miniatura', get_the_ID());
                $desc = wp_strip_all_tags(get_the_excerpt(get_the_ID()));
              elseif($postType == 'yoparticipoensalud'):
                $imageThumb = get_field('miniatura', get_the_ID());
                $desc = get_field('texto_descriptivo_vista_inmersiva', get_the_ID());
              elseif($postType == 'biblioteca-tips'):
                $desc = get_field('descripcion', get_the_ID());
                $url = get_bloginfo('url') . '/secciones/acerca-de-tips/biblioteca-tips/?ID=' . get_the_ID();
              elseif($postType == 'herramientas'):
                $desc = get_field('descripcion', get_the_ID());
                $url = get_bloginfo('url') . '/secciones/representantes-de-la-ciudadania/caja-de-herramientas/?ID=' . get_the_ID();
              elseif($postType == 'asociaciones'):
                $desc = get_field('descripcion', get_the_ID());
                $url = get_bloginfo('url') . '/secciones/representantes-de-la-ciudadania/asociaciones-de-usuarios/?mapaID=' . get_the_title();
              elseif($postType == 'copacos'):
                $desc = get_field('descripcion', get_the_ID());
                $url = get_bloginfo('url') . '/secciones/representantes-de-la-ciudadania/copacos/?mapaID=' . get_the_title();
              elseif($postType == 'veedurias'):
                $desc = get_field('descripcion', get_the_ID());
                $url = get_bloginfo('url') . '/secciones/representantes-de-la-ciudadania/veedurias/?mapaID=' . get_the_title();
              else:
                if (has_post_thumbnail(get_the_ID())):
                  $imageThumb = get_the_post_thumbnail_url(get_the_ID(),'medium');
                endif;
              endif;

              if($imageThumb == ''):
                $imageThumb = get_template_directory_uri() . '/public/images/' . 'miniatura-default.png';
              endif;

              if($desc == ''):
                $desc = wp_strip_all_tags(get_the_excerpt(get_the_ID()));
              endif;

              if($url == '')
                $url = get_the_permalink(get_the_ID());
        ?>
              <div class="col-12">
                <article id="post-<?php the_ID(); ?>" class="pt-4 borderBottomSearch">
                  <div class="row align-items-center">
                    <a href="<?php echo $url; ?>" target="_blank">
                      <div class="row py-3">
                        <div class="col-md-3 col-sm-12">
                          <div class="featured-image-container d-flex justify-content-center align-items-center">
                            <img src="<?php echo $imageThumb; ?>" alt="<?php echo get_the_title(); ?>" width="300" height="200" class="w-100 rounded" />
                          </div>
                        </div>

                        <div class="col-md-9 col-sm-12">
                          <div class="d-flex px-0 px-md-3 py-md-0 py-4 pb-3">
                              <p>
                                  <span class="iconInfo"></span>
                              </p>
                              <h3 class="title-container-noticias px-2">
                                  <?php echo get_the_title(get_the_ID()); ?>
                              </h3>
                          </div>
                          <div class="descripcion-secciones pt-3 px-md-4 px-2">
                            <?php echo mb_strimwidth($desc, 0, 350, '...'); ?>       
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </article><!-- #post-<?php the_ID(); ?> -->
              </div>
        <?php
            endwhile;
        ?>
        <div class="col-12">
          <div class="col-8 mx-auto pt-5 pb-4">
            <?php wp_pagenavi(); ?>
          </div>
          <div class="d-flex justify-content-center my-3">
            <h3 class="title-container-yoparticipoensalud px-2">
  		        Tal vez puedas encontrar resultados adicionales en nuestro mapa
            </h3>
  		    </div>
          <div class="container">
            <div class="d-flex justify-content-center my-3 py-4">
              <a href="
              <?php echo get_bloginfo('url') . '/secciones/donde-esta-tips-en-bogota/'; ?>" class="btn btn-tabs-buttons yellow col-md-3 col-12 px-3">
                Ver Mapa
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>