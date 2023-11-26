<?php
    require_once(SRC_PATH . 'Blocks/ContenedorFormularioSecciones/MyContenedorFormularioSecciones.php');

    $currentUser = $args['userID'];

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $type = (get_query_var('tipo')) ? get_query_var('tipo') : '';
    $keyword = (get_query_var('search')) ? get_query_var('search') : false;

    if($type != 'propuestas')
        $keyword = false;

    $posts_per_page = 8;

    $data = new MyContenedorFormularioSecciones();
    $propuestas = $data->get_array_propuestas_user($currentUser, $paged, $posts_per_page, $keyword);

    $uploadFoto = get_template_directory_uri() . '/public/images/documentos-icon.png';

    if($propuestas != false)
    {
        $nextLink = '';

        if($propuestas->found_posts > $propuestas->posts_per_page)
        {
            $paginas = $propuestas->found_posts / $propuestas->posts_per_page;

            $paginas = ceil($paginas);

            $actualURL = get_the_permalink();

            if($paged < $paginas)
            {
                $nextPage = $data->get_url_pagination($actualURL, $paged + 1, $keyword, $type);

                $nextLink = '<a id="morePagination" class="wpcf7-form-control wpcf7-login btn btn-primary p-1 m-1 col-12 col-lg-2 col-md-4 float-end" href="' . $nextPage . '">Cargar más</a>';
            }
        }
    }

    $grupo_header   = get_field('grupo_header', 'option');

?>

<div class="container-fluid">
    <div class="row py-0">
        <div class="col-xl-4 col-12">
            <div class="d-flex ms-1 mt-2">
                <span class="iconInfo modIcon me-2"></span>
                <div class="col">
                    <h3 class="title-container-yoparticipoensalud px-2">Mis propuestas</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-12">
            <div class="row">
                <div class="col-xl-4 col-12">
                    <form method="get" action="<?php echo get_the_permalink(); ?>" class="search-form py-2" id="searchFormPropuestas">
                        <div class="input-group pb-3">
                            <?php
                                if($keyword == 'false')
                                    $keywordInput = '';
                                else
                                    $keywordInput = $keyword;
                            ?>
                            
                            <input class="form-control inputTextElement" id="searchHerramientas" type="search" name="search" placeholder="Buscar..." value="<?php echo esc_attr($keywordInput); ?>">
                            
                            <input type="hidden" name="tipo" value="propuestas" />

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
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="form-outline col-12">
                        <a href="<?php echo $grupo_header['pagina_quiero_publicar']; ?>" class="wpcf7-form-control wpcf7-login btn btn-primary my-2 col-12 col-sm-12 float-end">Participación al día</a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="form-outline col-12">
                        <a href="<?php echo $grupo_header['pagina_proponer_iniciativa']; ?>" class="wpcf7-form-control wpcf7-login btn btn-primary my-2 col-12 col-sm-12 float-end">Proponer una iniciativa</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="contenedor-propuestas-user pt-2 pb-0">
            <div class="col-12 mb-0 pt-4" id="propuestasScroll">
                <?php
                    if($propuestas != false):
                        foreach($propuestas->posts as $propuesta):
                ?>
                        <div class="propuestasItems container-fluid pb-5 propuestaUser-<?php echo $propuesta['ID']; ?>">
                            <div class="row px-2 px-xl-4 px-lg-2">
                                <div class="col-xl-2 col-lg-4 col-12">
                                    <div class="row pb-4 pb-lg-0">
                                        <div class="col-6 col-xl-7">
                                            <img class="d-block float-lg-end mx-auto img-fluid rounded" src="<?php echo $uploadFoto; ?>">
                                        </div>
                                        <div class="col-6 col-xl-5">
                                            <span class="d-block mx-auto mesPropuesta-user">
                                                <?php echo $propuesta['fechaMonth']; ?>
                                            </span>
                                            <span class="d-block mx-auto diaPropuesta-user">
                                                <?php echo $propuesta['fechaDay']; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-10 col-lg-8 col-12 px-md-4">
                                    <span class="d-block mx-auto tituloPropuesta-user">
                                        <?php echo $propuesta['titulo']; ?>
                                    </span>
                                    <p class="descripcionPropuesta-user pt-2">
                                        <?php
                                            echo mb_strimwidth($propuesta['descripcion'], 0, 200, '...');
                                        ?> 
                                    </p>
                                </div>
                            </div>

                            <div class="row px-2 px-xl-4 px-lg-2">
                                <div class="col-xl-2 col-lg-4 col-12">
                                </div>
                                <div class="col-xl-10 col-lg-8 col-12 px-md-4">
                                    <div class="d-grid d-md-flex propuesta-user-bottom">
                                        <div class="col-md-4 col-12">
                                            <button class="btn btn-primary p-1 my-1 boton_pagination_cursos button-borrar-propuesta" type="button" data-user="<?php echo $currentUser; ?>" data-propuesta="<?php echo $propuesta['ID']; ?>">Borrar</button>
                                        </div>
                                        <div class="col-md-4 col-12"></div>
                                        <div class="col-md-4 col-12">
                                            <a href="#" class="btn btn-primary p-1 my-1 boton_pagination_cursos" type="button" data-bs-toggle="modal" data-bs-target="#modal-propuestas-<?php echo $propuesta['ID']; ?>">Ver propuesta</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modales">
                              <div class="modal fade modal-propuestas" id="modal-propuestas-<?php echo $propuesta['ID']; ?>" aria-labelledby="modal-propuestas-<?php echo $propuesta['ID']; ?>Label" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header pt-2">
                                        <div class="col-md-12 pb-4">
                                          <button type="button" class="btn-close buttonClose-modal-herramientas" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    </div>

                                    <div class="modal-body modal-body-herramienta row px-5 py-2">
                                        <div class="col-lg-6 col-12">
                                            <div class="col-12 containerPropuesta-documentos-modal px-3 py-3">
                                                <div class="slider-propuestas">
                                                    <?php
                                                        foreach($propuesta['archivos'] as $archivo):
                                                    ?>
                                                        <div class="slickItem my-2">
                                                            <?php

                                                                $mime = $data->getUrlMimeType($archivo);

                                                                if(strstr($mime, "video"))
                                                                {
                                                                    $tipoArchivo = 'video';
                                                                }
                                                                else if(strstr($mime, "image"))
                                                                {
                                                                    $tipoArchivo = 'imagen';
                                                                }
                                                                else if(strstr($mime, "pdf"))
                                                                {
                                                                    $tipoArchivo = 'pdf';
                                                                }
                                                                else if(strstr($mime, "audio"))
                                                                {
                                                                    $tipoArchivo = 'audio-no-caratula';
                                                                }

                                                                get_template_part('src/Blocks/ContenedorCajaHerramientas/views/content', $tipoArchivo . '-inmersivo', array('file' => $archivo));
                                                            ?>
                                                        </div>
                                                    <?php
                                                        endforeach;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-2">
                                                <div class="slider-propuestas-paginas" data-actual='0'>
                                                </div>
                                            </div>
                                            <div class="row py-2">
                                                <div class="col-6">
                                                    <a href="#" class="btn btn-primary p-1 my-1 boton_pagination_cursos button-descargar-archivo-actual-propuesta" type="button" data-titulo="<?php echo $propuesta['titulo']; ?>" data-archivos='<?php echo json_encode($propuesta['archivos']); ?>' download>Descargar archivo actual</a>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn btn-primary p-1 my-1 boton_pagination_cursos button-descargar-adjuntos-propuesta" type="button" data-titulo="<?php echo $propuesta['titulo']; ?>" data-archivos='<?php echo json_encode($propuesta['archivos']); ?>'>Descargar todos los adjuntos</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-12 px-4 py-md-3 py-4">
                                            <div class="col-12" id="download-propuesta-<?php echo $propuesta['ID']; ?>">
                                                <div class="d-flex pt-3">
                                                    <span class="iconInfo me-2"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h3 class="localidadPropuesta-user">
                                                              <?php echo $propuesta['localidad']; ?>
                                                            </h3>
                                                        </div>
                                                        <div class="col-12">
                                                            <h2 class="tituloPropuesta-modal">
                                                              <?php echo $propuesta['titulo']; ?>
                                                            </h2>
                                                        </div>
                                                        <?php
                                                            if(isset($propuesta['organizaciones'])):
                                                        ?>
                                                            <div class="col-12 propuestaClon">
                                                                <h3 class="localidadPropuesta-user">
                                                                  <?php echo $propuesta['organizaciones']; ?>
                                                                </h3>
                                                            </div>
                                                        <?php
                                                            endif;
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="descripcionPropuesta-modal">
                                                            <?php echo $propuesta['descripcion']; ?>
                                                        </p>
                                                    </div>

                                                        <?php
                                                            if(isset($propuesta['descripcionesExtra1'])):
                                                        ?>
                                                            <div class="col-12 iniciativaClon">
                                                                <p class="descripcionPropuesta-modal">
                                                                    <?php echo $propuesta['descripcionesExtra1']; ?>
                                                                </p>
                                                            </div>
                                                        <?php
                                                            endif;
                                                        ?>

                                                        <?php
                                                            if(isset($propuesta['descripcionesExtra2'])):
                                                        ?>
                                                            <div class="col-12 iniciativaClon">
                                                                <p class="descripcionPropuesta-modal">
                                                                    <?php echo $propuesta['descripcionesExtra2']; ?>
                                                                </p>
                                                            </div>
                                                        <?php
                                                            endif;
                                                        ?>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="col-6 mx-auto">
                                                        <button class="btn btn-primary p-1 my-1 boton_pagination_cursos button-descargar-datos-propuesta" type="button" data-titulo="<?php echo $propuesta['titulo']; ?>" data-propuesta='<?php echo $propuesta['ID']; ?>'>Descargar datos de la propuesta</button>
                                                    </div>
                                                </div>
                                            </div>
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
                                No tienes propuestas para mostrar
                            </span>
                            <div class="hr2"></div>
                        </div>
                <?php
                    endif;
                ?>
            </div>

            <?php
                if($propuestas != false):
            ?>
                <div class="col-md-12 pt-5">
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

<?php

?>