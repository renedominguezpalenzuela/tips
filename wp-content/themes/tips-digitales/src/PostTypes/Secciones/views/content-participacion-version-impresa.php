<?php
    if(isset($_GET['periodico']))
        $periodico = ($_GET['periodico']) ? $_GET['periodico'] : 'false';
    else
        $periodico = 'last';

    if(isset($_GET['publicacion']))
        $year = ($_GET['publicacion']) ? $_GET['publicacion'] : '';
    else
        $year = '';

    if($periodico != 'false' && $periodico != 'last')
    {
        $args = array
        (
            'post_type' => '3d-flip-book',
            'post_status' => 'publish',
            'numberposts' => -1,
            'tax_query' => array
            (
                array
                (
                    'taxonomy' => 'fecha-publicacion',
                    'field' => 'slug', 
                    'terms' => $year,
                    'operator' => 'IN'
                )
            ),
            'orderby' => 'date',
            'order' => 'DESC',
            'fields' => 'ids',
        );
    }
    else
    {
        $cantPosts = get_field('periodicos_a_mostrar');

        $args = array
        (
            'post_type' => '3d-flip-book',
            'post_status' => 'publish',
            'numberposts' => $cantPosts,
            'orderby' => 'date',
            'order' => 'DESC',
            'fields' => 'ids',
        );
    }

    $myPosts = get_posts($args);

    $args = array (
        'taxonomy' => 'fecha-publicacion',
        'orderby' => 'name',
        'order' => 'DESC',
        'hide_empty' => false
    );

    $taxTerms = get_terms($args);

    $years = new stdClass();

    $years->terms = array();
    $cont = 0;

    foreach($taxTerms as $term)
    {
        $years->terms[$cont] = $term->name;

        $cont++;
    }
?>
<div class="container-fluid">
    <div class="row py-0">
        <div class="col-lg-8 col-12">
            <div class="d-flex ms-1 mt-2">
                <span class="iconInfo modIcon me-2"></span>
                <div class="col">
                    <h3 class="title-container-yoparticipoensalud px-2">Versión Impresa</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="row">
                <div class="col-12">
                    <div class="form-outline col-md-12 pt-0 pb-3">
                        <input class="form-control border-end-0 border searchElement my-2" id="inputFiltroPeriodico" name='tags-years' value='<?php echo $year; ?>' placeholder='Por año de publicación' data-url='<?php echo get_permalink(); ?>' data-tags='<?php echo json_encode($years->terms); ?>'>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-0 pb-2">
            <div class="contenedorNoticias pt-4 pb-2">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                            if($myPosts):
                                foreach ($myPosts as $post):
                                    $tituloBoton = get_field('titulo_del_boton', $post);
                                    $edicion = get_field('edicion', $post);

                                    if($tituloBoton == '')
                                        $tituloBoton = 'Edición ' . $edicion;
                        ?>
                                    <div class="col-12 col-md-6 col-lg-4 mb-3 text-center">
                                        <?php
                                            echo do_shortcode('[3d-flip-book mode="thumbnail-lightbox" id="' . $post . '" template="short-white-book-view" lightbox="dark-shadow"][/3d-flip-book]');

                                            echo do_shortcode('[3d-flip-book mode="link-lightbox" id="' . $post . '" classes="btn,btn-primary,p-1,my-4,boton_pagination_cursos"]' . $tituloBoton . '[/3d-flip-book]')
                                        ?>
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
  wp_reset_postdata();
?>