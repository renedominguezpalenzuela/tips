<?php
    require_once(SRC_PATH . 'Blocks/ContenedorBiblioteca/MyContenedorBiblioteca.php');

    $currentUser = $args['userID'];

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $type = (get_query_var('tipo')) ? get_query_var('tipo') : '';
    $keyword = (get_query_var('search')) ? get_query_var('search') : false;

    if($type != 'documentos')
        $keyword = false;

    $posts_per_page = 8;

    $data = new MyContenedorBiblioteca();
    $documentos = $data->get_documentos_user($currentUser, $paged, $posts_per_page, $keyword);

    $uploadFoto = get_template_directory_uri() . '/public/images/icon-upload-avatar.png';

    if($documentos != false)
    {
        $nextLink = '';

        if($documentos->found_posts > $documentos->posts_per_page)
        {
            $paginas = $documentos->found_posts / $documentos->posts_per_page;

            $paginas = ceil($paginas);

            $actualURL = get_the_permalink();

            if($paged < $paginas)
            {
                $nextPage = $data->get_url_pagination_perfil($actualURL, $paged + 1, $keyword, $type);

                $nextLink = '<a id="morePaginationDocumentos" class="wpcf7-form-control wpcf7-login btn btn-primary p-1 m-1 col-12 col-lg-2 col-md-4 float-end" href="' . $nextPage . '">Cargar más</a>';
            }
        }
    }
?>

<div class="container-fluid">
    <div class="row py-0">
        <div class="col-lg-8 col-12">
            <div class="d-flex ms-1 mt-2">
                <span class="iconInfo modIcon me-2"></span>
                <div class="col">
                    <h3 class="title-container-yoparticipoensalud px-2">Mis Documentos</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="row">
                <div class="col-12">
                    <form method="get" action="<?php echo get_the_permalink(); ?>" class="search-form py-2" id="searchFormDocumentos">
                        <div class="input-group pb-3">
                            <?php
                                if($keyword == 'false')
                                    $keywordInput = '';
                                else
                                    $keywordInput = $keyword;
                            ?>
                            
                            <input class="form-control inputTextElement" id="searchDocumentos" type="search" name="search" placeholder="Buscar..." value="<?php echo esc_attr($keywordInput); ?>">
                            
                            <input type="hidden" name="tipo" value="documentos" />

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
            </div>
        </div>

        <div class="pt-1 pb-0">
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="col pt-3 px-3">
                        <h3 class="container-changeFoto text-center px-2">Nuevo documento</h3>
                    </div>

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-subir-documento">
                        <img class="d-block mx-auto img-fluid rounded editPhoto" src="<?php echo $uploadFoto; ?>">
                    </a>

                    <div class="col py-3 px-3">
                        <h3 class="descripcion-secciones px-4"><?php echo get_field('descripcion_subir_archivo', 'option'); ?></h3>
                    </div>

                    <div class="modales">
                      <div class="modal fade modal-subir-documento" id="modal-subir-documento" aria-labelledby="modal-subir-documento-Label" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content">
                            <div class="modal-header py-1">
                              <div class="container-fluid">
                                <div class="col-md-12 pb-3">
                                  <button type="button" class="btn-close buttonClose-modal-herramientas" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="col-md-12 pt-4">
                                  <div class="row">
                                    <div class="col-lg-9 col-12">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="modal-body modal-body-herramienta py-2">
                                <div class="container-vista-inmersiva-herramienta">
                                    <?php
                                        $formID = get_field('seleccionar_formulario_subir_archivo_biblioteca', 'option');

                                      echo do_shortcode('[contact-form-7 id="' . $formID . '" title="Subir archivo a la biblioteca TIPS"]');
                                    ?>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="contenedor-propuestas-user col-xl-8 col-12">
                    <div class="row" id="documentosScroll">
                        <?php
                            if($documentos != false):
                                foreach($documentos->posts as $documento):
                        ?>
                                    <div class="documentosItems documentoUser-<?php echo $documento['ID']; ?> col-md-6 col-12 py-2 pb-4">
                                        <div class="row">
                                            <div class="col-md-4 col-12 pb-4">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-documentos-<?php echo $documento['ID']; ?>">
                                                    <img src="<?php echo get_template_directory_uri() . '/public/images/biblioteca-icon.png'; ?>" class="img-fluid rounded mx-auto d-block"/>
                                                </a>
                                            </div>
                                            <div class="col-md-8 col-12">
                                                <a href="#" class="button-borrar-documento float-end" data-user="<?php echo $currentUser; ?>" data-documento="<?php echo $documento['ID']; ?>">
                                                    <i class="fa-solid fa-x"></i>
                                                </a>

                                                <span class="d-block mx-auto localidadDocumento-user">
                                                    <?php
                                                        echo $documento['localidad'];
                                                    ?>            
                                                </span>

                                                <span class="d-block mx-auto tituloDocumento-user">
                                                    <?php
                                                        echo mb_strimwidth($documento['titulo'], 0, 22, '...');
                                                    ?>            
                                                </span>

                                                <div class="col-12">
                                                    <div class="col-12">
                                                        <div class="col-md-6 col-12">
                                                            <button class="btn btn-primary p-1 my-1 boton_pagination_cursos showPopupCompartirDocumentos" type="button" data-user="<?php echo $currentUser; ?>" data-propuesta="<?php echo $documento['ID']; ?>" data-url="<?php echo $documento['archivos']; ?>" data-title="<?php echo $documento['titulo']; ?>">Compartir</button>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modales">
                                          <div class="modal fade modal-documentos" id="modal-documentos-<?php echo $documento['ID']; ?>" aria-labelledby="modal-documentos-<?php echo $documento['ID']; ?>Label" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                              <div class="modal-content">
                                                <div class="modal-header py-2">
                                                  <div class="container-fluid">
                                                    <div class="col-md-12 pb-0">
                                                      <button type="button" class="btn-close buttonClose-modal-herramientas" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="col-md-12 pt-4">
                                                      <div class="row">
                                                        <div class="col-lg-9 col-12">
                                                          <div class="d-flex">
                                                            <span class="iconInfo me-2"></span>
                                                            <h3 class="tipo-herramientas">
                                                              <?php echo $documento['titulo']; ?>
                                                            </h3>
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-12 col-md-8">
                                                              <h3 class="titulo-herramientas px-3"></h3>
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
                                                            get_template_part('src/Blocks/ContenedorCajaHerramientas/views/content', $documento['tipo_de_archivo'] . '-inmersivo', array('file' => $documento['archivos']));
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <div class="col-md-12">
                                                        <a href="<?php echo $documento['archivos']; ?>" class="d-block mx-auto wpcf7-form-control button-tips btn btn-primary p-1 m-1 col-md-4" download>Descargar</a>
                                                    </div>
                                                </div>

                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                        <?php
                                endforeach;
                            else:
                        ?>
                                <div class="col-12">
                                    <span class="d-block mx-auto tituloEvent-user">
                                        No tienes documentos para mostrar
                                    </span>
                                    <div class="hr2"></div>
                                </div>
                        <?php
                            endif;
                        ?>
                    </div>

                    <div class="row">
                        <?php
                            if($documentos != false && $nextLink != ''):
                        ?>
                            <div class="col-md-12 pt-5">
                                <div class="row justify-content-center paginationScrollDocumentos">
                                    <?php echo $nextLink; ?>
                                </div>

                                <div class="page-load-status-documentos">
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
        </div>
    </div>
</div>

<?php

?>