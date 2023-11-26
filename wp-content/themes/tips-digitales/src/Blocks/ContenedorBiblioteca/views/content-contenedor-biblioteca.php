<?php
    require_once(SRC_PATH . 'Blocks/ContenedorBiblioteca/MyContenedorBiblioteca.php');

    $biblioteca = new MyContenedorBiblioteca();

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $keyword = (get_query_var('search')) ? get_query_var('search') : '';
    $filtros = (get_query_var('filters')) ? get_query_var('filters') : '';

    $keyword = urldecode($keyword);
    $filtros = urldecode($filtros);

    if( $keyword == '' && $filtros == '' && $paged == 1 )
        $scroll = 'false';
    else
        $scroll = 'true';

    if(isset($_GET['ID']))
    {
        $scroll = 'true';
        $temp = $biblioteca->get_biblioteca('todos', '', '', '', $_GET['ID']);
    }
    else
        $temp = $biblioteca->get_biblioteca('todos', $paged, $keyword, $filtros);
?>
    <div class="container-fluid px-md-3 pb-4">
        <div class="container-biblioteca px-3 py-3">
            <div class="row">
                <div class="col-md-12 mt-4 mb-2" id="herramientasContainer" data-scroll="<?php echo ($scroll); ?>">
                    <div class="container-fluid">
                        <?php
                            if($temp->found_posts > 0):
                                if($keyword != ''):
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
                                                $classFilters = str_replace(',', ' ', $herramienta->filters);
                                    ?>
                                            <div class="herramientaItem col-6 py-2 pb-4 <?php echo $classFilters; ?>">
                                                <div class="mt-4 mt-md-1 px-2">
                                                    <div class="d-flex">
                                                        <span class="iconInfo me-2"></span>
                                                        <h3 class="tipo-herramientas"><?php echo $herramienta->localidad; ?></h3>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-9 pb-4">
                                                            <h3 class="titulo-herramientas ps-3">
                                                                <?php echo mb_strimwidth($herramienta->title, 0, 80, '...');;
                                                                ?>            
                                                            </h3>
                                                            <div class="descripcion-herramientas ps-3">
                                                                <?php echo mb_strimwidth($herramienta->descripcion, 0, 200, '...');;
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
                                                                        <?php echo $herramienta->localidad; ?>
                                                                      </h3>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
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
                                    <span class="title-secciones">Lo sentimos, no encontramos resultados para </span><span class="title-secciones highlightSearch"><?php echo $keyword; ?></span>
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
                            $nextPage = $biblioteca->get_url_pagination($actualURL, $paged + 1, $keyword, $filtros);

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