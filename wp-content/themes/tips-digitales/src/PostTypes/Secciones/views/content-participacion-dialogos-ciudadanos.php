<?php
    $category = get_term_by('slug', 'dialogos-ciudadanos','category');

    $cantPosts = get_field('dialogos_a_mostrar');

    $args = array
    (
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => $cantPosts,
        'orderby' => 'date',
        'order' => 'DESC',
        'fields' => 'ids',
        'category__in' => $category->term_id,
    );

    $myPosts = get_posts($args);

    $args = array (
        'taxonomy' => 'localidades',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false
    );

    $taxTerms = get_terms($args);

    $localidades = new stdClass();

    $localidades->terms = array();
    $cont = 0;

    foreach($taxTerms as $term)
    {
        $localidades->terms[$cont]['value'] = $term->name;
        $localidades->terms[$cont]['id'] = 'filter-' . $term->slug;

        $cont++;
    }
?>
<div class="container-fluid">
    <div class="row py-0">
        <div class="col-lg-8 col-12">
            <div class="d-flex ms-1 mt-2">
                <span class="iconInfo modIcon me-2"></span>
                <div class="col">
                    <h3 class="title-container-yoparticipoensalud px-2">Diálogos ciudadanos</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="row">
                <div class="col-12">
                    <div class="form-outline col-md-12 pt-0 pb-3">
                        <input class="form-control border-end-0 border searchElement my-2" id="inputFiltroLocalidadDialogos" name='tags-localidad' value='' placeholder='Por localidad' data-tags='<?php echo json_encode($localidades->terms); ?>'>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-0 pb-2">
            <div class="contenedorNoticias pt-2 pb-2">
                <div class="container-fluid">
                    <div class="row" id="isotopeGridParticipacionDialogos">
                        <div class="grid-sizer"></div>
                        <?php
                            if($myPosts):
                                foreach ($myPosts as $post):
                                    $filters = get_the_terms($post, 'localidades');
                                    $classFilters = '';

                                    if($filters):
                                        foreach ($filters as $filter):
                                            $classFilters .= 'filter-' . $filter->slug . ' ';
                                        endforeach;
                                    endif;

                        ?>
                                    <div class="noticiasItem col-6 <?php echo $classFilters; ?>">
                                        <a href="<?php echo get_the_permalink($post); ?>" target="_blank">
                                            <div class="row g-0 participacion-al-dia-noticia-contanier">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <img src="<?php echo get_field('miniatura', $post); ?>" class="img-fluid rounded d-block mx-auto">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12 px-2 my-auto">
                                                    <div class="participacion-al-dia-titulo-noticias pt-3 pb-2 px-2">  <?php echo get_the_title($post); ?>
                                                    </div>
                                                    <p class="participacion-al-dia-resumen-noticias px-2">
                                                        <?php echo get_field('resumen', $post); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                        <?php
                                endforeach;
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    wp_reset_query();
?>