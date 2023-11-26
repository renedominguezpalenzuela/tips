<?php
    require_once(SRC_PATH . 'Blocks/ContenedorBiblioteca/MyContenedorBiblioteca.php');

    $biblioteca = new MyContenedorBiblioteca();

    $keyword = (get_query_var('search')) ? get_query_var('search') : '';

    $localidades    = $biblioteca->get_all_filters('localidad');
    $grupo          = $biblioteca->get_all_filters('grupo-poblacional');
    $tematica       = $biblioteca->get_all_filters('tematica');

    $keyword = urldecode($keyword);

?>
    <div class="container-fluid px-md-4 pt-4">
        <div class="row">
            <div class="col-12">
                <form method="get" action="<?php echo get_the_permalink(); ?>" class="search-form py-2" id="searchFormBiblioteca">
                    
                    <div class="input-group pb-0">
                        <input class="form-control inputTextElement" id="searchHerramientas" type="search" name="search" placeholder="Buscar..." value="<?php echo esc_attr($keyword); ?>">

                        <div class="input-group-append">
                            <button type="submit" class="btn searchElement2">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                        <div class="alert alert-danger alert-search form-outline col-md-12 fade show" data-visible="false" role="alert">
                          Ingrese mínimo tres caracteres para realizar la búsqueda
                        </div>
                    </div>
                </form>

                <div class="form-outline col-md-12">
                    <input class="form-control border-end-0 border searchElement my-2" id="inputFiltroLocalidad" name='tags-localidad' value='' placeholder='Por localidad' data-tags='<?php echo json_encode($localidades->terms); ?>'>
                </div>
                <div class="form-outline col-md-12">
                    <input class="form-control border-end-0 border searchElement my-2" id="inputFiltroGrupo" name='tags-grupo' value='' placeholder='Por grupo poblacional'data-tags='<?php echo json_encode($grupo->terms); ?>'>
                </div>
                <div class="form-outline col-md-12">
                    <input class="form-control border-end-0 border searchElement my-2" id="inputFiltroTematica" name='tags-tematica' value='' placeholder='Por temática' data-tags='<?php echo json_encode($tematica->terms); ?>'>
                </div>
                <div class="form-outline col-md-12">
                    <button class="wpcf7-form-control wpcf7-login btn btn-primary my-2 col-12 col-sm-12 col-md-5 float-end" id='removeAllTags' type='button' data-url="<?php echo get_permalink(); ?>">Limpiar filtros</button>
                </div>
            </div>
        </div>
    </div>