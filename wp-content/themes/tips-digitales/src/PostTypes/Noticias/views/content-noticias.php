<?php 
    $titulo = 'Participación al Día';

    $temp = explode(" ", $titulo);

    $firstWord = $temp[0];
    $temp[0] = '';

    $titleWords = implode(" ", $temp);

    $cantPosts = get_field('cant_noticias', 'option');

    $categories = get_the_category(get_the_ID());

    if ( ! empty( $categories ) )
    {
        $args = array
        (
            'post_type' => 'post',
            'post_status' => 'publish',
            'numberposts' => $cantPosts,
            'orderby' => 'date',
            'order' => 'DESC',
            'fields' => 'ids',
            'exclude' => get_the_ID(),
            'category__in' => $categories[0]->term_id,
        );
    }
    else
    {
        $args = array
        (
            'post_type' => 'post',
            'post_status' => 'publish',
            'numberposts' => $cantPosts,
            'orderby' => 'date',
            'order' => 'DESC',
            'fields' => 'ids',
            'exclude' => get_the_ID()
        );
    }

    $relatedPosts = get_posts($args);

    $currentUser = get_current_user_id();

    $grupo_header = get_field('grupo_header', 'option');

    if($currentUser != 0)
        $link1 = get_field('quiero_publicar', 'option');
    else
    {
        $link1 = get_field('quiero_publicar', 'option');
        $link1['link'] = $grupo_header['pagina_quiero_participar'];
    }

    $link2 = get_field('biblioteca_tips', 'option');
    $link3 = get_field('comite_editorial', 'option');

?>
    <div class="container-fluid">
        <div class="row mx-md-3 mx-1 mt-5 mb-2">
            <div class="col-12 col-xl-9 col-lg-8 mb-3">
                <div class="row">
                    <div class="col-lg-9 col-12 mb-2">
                        <div class="title-secciones-icon">
                            <span class="iconWaterBlue"></span>
                            <span class="iconWater"></span>
                        </div>

                        <h2 class="title-secciones px-md-4 px-2">
                            <a class="initialColor" href="<?php echo $grupo_header['pagina_participacion_al_dia']; ?>">
                                <?php echo $firstWord; ?>
                                <span class="title-secciones-secondary">
                                    <?php echo $titleWords; ?>
                                </span>
                            </a>
                        </h2>
                        <div class="row px-lg-4 px-2 mt-lg-5 mt-md-3 mt-2">
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="row px-2 pb-md-4">
                            <span class="date-container-noticias my-auto col-12"><?php echo get_the_date('M/Y'); ?></span>
                            <div id="share" class="col-12 my-auto"></div>

                            <?php
                                require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                                $container = new MyBlocksContainer();

                                $container->views_blocks_container('ContenedorMiBuzonCompartir');
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-12 px-4">
                        <div class="col-12">
                            <div class="d-flex px-0 px-md-3 py-md-0 py-4 pb-3">
                                <p>
                                    <span class="iconInfo"></span>
                                </p>
                                <h1 class="title-container-noticias px-2">
                                    <?php echo get_the_title(); ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 px-0">
                        <div class="col-12 px-4 px-md-5 pb-3 singleNoticias">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="col-lg-12 px-0">
                        <div class="col-12 px-4 px-md-5">
                            <?php
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-3 col-lg-4 mb-3">
                <div class="row">
                    <div class="col-lg-12 px-0 py-3">
                        <div class="col-12 px-4 px-md-5 ps-lg-0 pe-lg-4">
                            <div class="container-sidebar-noticias px-4 py-4">
                                <div class="col-12 pt-2 pb-4">
                                    <div class="d-flex">
                                        <span class="iconInfo modIcon me-2"></span>
                                        <h3 class="title-container-sidebar">
                                            <?php echo get_field('titulo_contenedor_periodico', 'option'); ?>
                                        </h3>
                                    </div>
                                    <div class="mx-2 px-2 py-2 sidebarItems">
                                        <a href='<?php echo $link1['link']; ?>'>
                                            <div class="row mx-auto text-center text-lg-start">
                                                <div class="col-lg-4 col-12">
                                                    <span class="iconQuieroPublicarNews"></span>
                                                </div>
                                                <div class="col-lg-8 col-12 my-auto">
                                                    <span class="title-sidebar-elements">
                                                        <?php echo $link1['titulo']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="borderLineSidebar mx-2 my-0"></div>

                                    <div class="mx-2 px-2 py-2 sidebarItems">
                                        <a href='<?php echo $link2['link']; ?>'>
                                            <div class="row mx-auto text-center text-lg-start">
                                                <div class="col-lg-4 col-12">
                                                    <span class="iconBibiotecaNews"></span>
                                                </div>
                                                <div class="col-lg-8 col-12 my-auto">
                                                    <span class="title-sidebar-elements"><?php echo $link2['titulo']; ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="borderLineSidebar mx-2 my-0"></div>

                                    <div class="mx-2 px-2 py-2 sidebarItems">
                                        <a href='<?php echo $link3['link']; ?>?comite=true'>
                                                <div class="row mx-auto text-center text-lg-start">
                                                <div class="col-lg-4 col-12">
                                                    <span class="iconComiteEditorialNews"></span>
                                                </div>
                                                <div class="col-lg-8 col-12 my-auto">
                                                    <span class="title-sidebar-elements"><?php echo $link3['titulo']; ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="borderLineSidebar mx-2 my-0"></div>
                                </div>
                                <div class="col-12 pt-2 pb-1">
                                    <div class="d-flex">
                                        <span class="iconInfo modIcon me-2"></span>
                                        <h3 class="title-container-sidebar">
                                            <?php echo get_field('titulo_contenedor_noticias_relacionadas', 'option'); ?>
                                        </h3>
                                    </div>
                                    <div class="row mx-2 mb-2 otrosArticulos">
                                        <?php
                                            foreach ($relatedPosts as $myPost)
                                            {
                                        ?>
                                                <a href="<?php echo get_the_permalink($myPost); ?>">
                                                    <div class="col-12 mb-3">
                                                        <div class="col-12 mb-3">
                                                            <img src="<?php echo get_field('miniatura', $myPost); ?>" class="img-fluid w-100 rounded d-block mx-auto">
                                                        </div>
                                                        <div class="col-12">
                                                            <h3 class="title-sidebar-related">
                                                                <?php echo get_the_title($myPost); ?>
                                                            </h3>
                                                            <div class="resume-sidebar-related">
                                                                <?php echo get_field('resumen', $myPost); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>