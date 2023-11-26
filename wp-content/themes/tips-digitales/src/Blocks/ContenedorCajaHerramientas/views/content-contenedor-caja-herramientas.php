<?php
    require_once(SRC_PATH . 'Blocks/ContenedorCajaHerramientas/MyContenedorCajaHerramientas.php');

    $herramientas = new MyContenedorCajaHerramientas();

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $keyword = (get_query_var('search')) ? get_query_var('search') : '';

    if( $keyword == '' && $paged == 1 )
        $scroll = 'false';
    else
        $scroll = 'true';

    $keyword = urldecode($keyword);

    if(isset($_GET['ID']))
    {
        $scroll = 'true';
        $temp = $herramientas->get_herramientas('herramientas', '', '', $_GET['ID']);
    }
    else 
        $temp = $herramientas->get_herramientas('herramientas', $paged, $keyword);

?>
    <div class="container-fluid px-md-3 pb-4">
        <div class="container-cajaherramientas px-3 py-3">
            <div class="row">
                <div class="col-md-5 col-12">
                    <form method="get" action="<?php echo get_the_permalink(); ?>" class="search-form py-2" id="searchFormHerramientas">

                        <div class="input-group pb-3">
                            <?php
                                if($keyword == 'false')
                                    $keywordInput = '';
                                else
                                    $keywordInput = $keyword;
                            ?>
                            
                            <input class="form-control inputTextElement" id="searchHerramientas" type="search" name="search" placeholder="Buscar..." value="<?php echo esc_attr($keywordInput); ?>">

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
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-outline col-lg-8 col-md-12">
                        <button class="wpcf7-form-control wpcf7-login btn btn-primary my-2 col-12 col-sm-12 float-end" id='removeAllTags' type='button' data-url="<?php echo get_permalink(); ?>">Limpiar filtros</button>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <?php
                        $hasBoton =get_field('agregar_boton_biblioteca_tips');

                        if($hasBoton == 'si'):
                            $buttonClass = 'btn btn-primary p-1 my-1 boton_pagination_cursos';

                            $aditionalClass = get_field('clase_adicional_biblioteca_tips');

                            if($aditionalClass != ''):
                                $buttonClass .= ' ' . $aditionalClass;
                            endif;
                    ?>
                            <div class="col-12 col-lg-6 my-md-2 my-0 float-end">
                                <a class="<?php echo $buttonClass; ?>" aria-disabled="true" href="<?php echo get_field('pagina_destino_biblioteca_tips', get_the_ID()); ?>">
                                    <?php echo get_field('titulo_boton_biblioteca_tips', get_the_ID()); ?>
                                    <i class="fa fa-chevron-right icono-btn-cursos-der"></i>
                                    <span class="separator-btn-cursos-der"></span>
                                </a>
                            </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-4 mb-2" id="herramientasContainer" data-scroll="<?php echo ($scroll); ?>">
                    <div class="container-fluid">
                        <?php
                            if($keyword == '')
                                $keyword = 'false';

                            if($temp->found_posts > 0):
                                if($keyword != 'false'):
                        ?>
                                    <div class="col-md-12 mb-4">
                                        <span class="title-secciones">Hemos encontrado (<?php echo $temp->found_posts; ?>) resultados para </span><span class="title-secciones highlightSearch">"<?php echo $keyword; ?>"</span>
                                    </div>
                        <?php
                                endif;
                        ?>
                                <div class="row" id="isotopeGrid">
                                    <div class="grid-sizer"></div>
                                    <?php
                                        foreach($temp->posts as $herramienta):
                                    ?>
                                            <div class="herramientaItem col-6 py-2 pb-4">
                                                <div class="mt-4 mt-md-1 px-2">
                                                    <div class="d-flex">
                                                        <span class="iconInfo me-2"></span>
                                                        <h3 class="tipo-herramientas"><?php echo $herramienta->taxName; ?></h3>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-9 pb-4">
                                                            <h3 class="titulo-herramientas ps-3">
                                                                <?php echo mb_strimwidth($herramienta->title, 0, 35, '...');
                                                                ?>
                                                            </h3>
                                                            <div class="descripcion-herramientas ps-3">
                                                                <?php echo mb_strimwidth($herramienta->descripcion, 0, 140, '...');;
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-3 mt-md-0 px-0 mt-4 d-block mx-auto">
                                                            <div class="download-file">
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-herramientas-<?php echo $herramienta->ID; ?>" data-file="<?php echo $herramienta->archivo; ?>">
                                                                    <img src="<?php echo $herramienta->icono; ?>" class="img-fluid d-block mx-auto">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modales">
                                                  <div class="modal modal-herramientas" id="modal-herramientas-<?php echo $herramienta->ID; ?>" aria-labelledby="modal-herramientas-<?php echo $herramienta->ID; ?>Label" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                      <div class="modal-content">
                                                        <div class="modal-header py-1">
                                                          <div class="container-fluid">
                                                            <div class="col-md-12 pb-0">
                                                              <button type="button" class="btn-close buttonClose-modal-herramientas" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="col-md-12 pt-4">
                                                              <div class="row">
                                                                <div class="col-12">
                                                                  <div class="d-flex">
                                                                    <span class="iconInfo me-2"></span>
                                                                    <h3 class="tipo-herramientas">
                                                                      <?php echo $herramienta->taxName; ?>
                                                                    </h3>
                                                                  </div>
                                                                  <div class="row">
                                                                    <div class="col-12 col-md-8">
                                                                      <h3 class="titulo-herramientas px-3"><?php echo $herramienta->title; ?></h3>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="modal-body modal-body-herramienta py-2">
                                                          <div class="container-vista-inmersiva-herramienta">
                                                            <?php
                                                              if($herramienta->tipoArchivo == 'audio' || $herramienta->tipoArchivo == 'video')
                                                                $caratula = $herramienta->caratula;
                                                              else
                                                                $caratula = '';

                                                              get_template_part('src/Blocks/ContenedorCajaHerramientas/views/content', $herramienta->tipoArchivo . '-inmersivo', array('file' => $herramienta->archivo, 'caratula' => $caratula));
                                                            ?>
                                                          </div>
                                                        </div>
                                                        <div class="modal-footer py-1">
                                                          <div class="col-md-12">
                                                            <a href="<?php echo $herramienta->archivo; ?>" class="d-block mx-auto wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-md-4" download>Descargar</a>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                        <?php
                            else:
                        ?>
                                <div class="col-md-12 mb-4">
                                    <span class="title-secciones">Lo sentimos, no encontramos resultados </span><span class="title-secciones highlightSearch"><?php echo ($keyword == 'false') ? '' : 'para ' . $keyword; ?></span>
                                </div>
                        <?php
                            endif;
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php
                    if($temp->found_posts > $temp->posts_per_page):
                        $paginas = $temp->found_posts / $temp->posts_per_page;
                        $paginas = ceil($paginas);

                        $actualURL = get_the_permalink();
                        $nextLink = '';
                        if($paged < $paginas):
                            $nextPage = $herramientas->get_url_pagination($actualURL, $paged + 1, $keyword);

                            $nextLink = '<a id="morePagination" class="wpcf7-form-control wpcf7-login btn btn-primary p-1 m-1 col-12 col-lg-2 col-md-4 float-end" href="' . $nextPage . '">Cargar más</a>';
                        endif;
                ?>
                        <div class="col-md-12 py-3">
                            <div class="row justify-content-center paginationScroll">
                                <?php echo $nextLink; ?>
                            </div>

                            <div class="page-load-status">
                              <div class="loader-ellips infinite-scroll-request">
                                <span class="loader-ellips__dot"></span>
                                <span class="loader-ellips__dot"></span>
                                <span class="loader-ellips__dot"></span>
                                <span class="loader-ellips__dot"></span>
                              </div>
                              <p class="infinite-scroll-last">End of content</p>
                              <p class="infinite-scroll-error">No more pages to load</p>
                            </div>
                        </div>
                <?php
                    endif;
                ?>
            </div>

        </div>
    </div>