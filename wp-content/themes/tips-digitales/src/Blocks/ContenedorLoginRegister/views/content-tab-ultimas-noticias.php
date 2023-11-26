<?php
    $grupo_header   = get_field('grupo_header', 'option');
?>
<div class="container-fluid" id="contenedor-ultimas-noticias-by-localidad">
    <div class="row py-0">
        <div class="col-xl-7 col-12">
            <div class="d-flex ms-1 mt-2">
                <span class="iconInfo modIcon me-2"></span>
                <div class="col">
                    <h3 class="title-container-yoparticipoensalud px-2">Últimas noticias</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-12">
            <?php
                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'select-localidades', array('userID' => 0, 'ID' => 'ultimasNoticiasLocalidad'));
            ?>
        </div>

        <div class="row">
            <div class="px-3">
                <div class="container-ultimas-noticias-by-localidad">
                    <div class="page-load-status-container-ultimas-noticias container-fluid">
                        <div class="loader-ellips infinite-scroll-request">
                            <span class="loader-ellips__dot"></span>
                            <span class="loader-ellips__dot"></span>
                            <span class="loader-ellips__dot"></span>
                            <span class="loader-ellips__dot"></span>
                        </div>
                    </div>

                    <div class="container-loading-ultimas-noticias">
                    </div>

                    <div class="row">
                        <div class="col-md-10 col-12 mx-auto pt-5">
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
                            <div class="row mx-4 mb-2 ultimas-noticias-localidad-slider">
                                <?php
                                    if ( $posts ):
                                        foreach ($posts as $myPost)
                                        {
                                ?>
                                            <div class="col-12 px-3 mb-2">
                                                <a href="<?php echo get_the_permalink($myPost); ?>">
                                                    <div class="col-12 mb-3">
                                                        <img src="<?php echo get_field('miniatura', $myPost); ?>" class="img-fluid w-100 rounded d-block mx-auto">
                                                    </div>
                                                    <div class="col-12">
                                                        <h3 class="title-ultimas-noticias-profile">
                                                            <?php echo get_the_title($myPost); ?>
                                                        </h3>
                                                        <div class="resume-sidebar-related pb-3">
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
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-10 mx-auto pt-3 pb-5">
                    <a class="btn btn-primary p-1 my-1 boton_pagination_cursos" href="<?php echo $grupo_header['pagina_participacion_al_dia']; ?>?noticias">
                        Todas las noticias
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>