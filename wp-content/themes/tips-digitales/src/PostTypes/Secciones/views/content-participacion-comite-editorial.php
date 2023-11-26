<?php
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
    $link3['link'] = $grupo_header['pagina_contacto'];
    $link3['titulo'] = 'Contactar Comité editorial';
?>

<div class="container-fluid">
    <div class="row py-0">
        <div class="col-12">
            <div class="d-flex ms-1 mt-2">
                <span class="iconInfo modIcon me-2"></span>
                <div class="col">
                    <h3 class="title-container-yoparticipoensalud px-2">Comité editorial</h3>
                </div>
            </div>
        </div>

        <div class="px-4 pt-2 pb-2">
            <div class="px-2 pt-0 pb-2">
                <div class="container-fluid contenedorEditorialNoticias">
                    <div class="row">
                        <div class="containerComiteEditorial">
                            <?php
                                if( have_rows('funcionarios') ):
                                    while ( have_rows('funcionarios') ) : the_row();

                                        $imagen = get_sub_field('foto');
                                        $nombre = get_sub_field('nombre');
                                        $subtitulo = get_sub_field('subtitulo');
                                        $descripcion = get_sub_field('descripcion');
                            ?>
                                        <div class="comiteEditorial-Item px-2 pt-4">
                                            <div class="row">
                                                <div class="col-lg-4 col-10 mx-auto pb-4">
                                                    <img src="<?php echo $imagen['sizes']['medium_carrusel']; ?>" class="secciones-imagenes-image img-fluid rounded">
                                                </div>
                                                <div class="col-lg-8 col-12 py-1">
                                                    <div class="row">
                                                        <h3 class="title-secciones">
                                                            <?php echo $nombre; ?>
                                                        </h3>
                                                        <h3 class="subtitle-secciones">
                                                            <?php echo $subtitulo; ?>
                                                        </h3>
                                                        <div class="descripcion-secciones">
                                                            <?php echo $descripcion; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    endwhile;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

                    <div class="px-2">
                        <div class="row">
                            <a class="g-0 col-md-4 col-12 sidebarItems py-3 d-block my-auto" href='<?php echo $link2['link']; ?>'>
                                <div class="borderLineComite row mx-auto text-center text-lg-start col-12">
                                    <div class="col-lg-6 col-12">
                                        <span class="iconBibiotecaComite"></span>
                                    </div>
                                    <div class="col-lg-6 col-12 my-auto">
                                        <span class="title-ultimas-noticias-buttons"><?php echo $link2['titulo']; ?></span>
                                    </div>
                                </div>
                            </a>

                            <a class="g-0 col-md-4 col-12 sidebarItems py-3 d-block my-auto" href='<?php echo $link3['link']; ?>'>
                                <div class="borderLineComite row mx-auto text-center text-lg-start col-12">
                                    <div class="col-lg-6 col-12">
                                        <span class="iconComiteEditorialComite"></span>
                                    </div>
                                    <div class="col-lg-6 col-12 my-auto">
                                        <span class="title-ultimas-noticias-buttons"><?php echo $link3['titulo']; ?></span>
                                    </div>
                                </div>
                            </a>

                            <a class='g-0 col-md-4 col-12 sidebarItems py-3 d-block my-auto' href='<?php echo $link1['link']; ?>'>
                                <div class="row mx-auto text-center text-lg-start col-12">
                                    <div class="col-lg-6 col-12">
                                        <span class="iconQuieroPublicarComite"></span>
                                    </div>
                                    <div class="col-lg-6 col-12 my-auto">
                                        <span class="title-ultimas-noticias-buttons">
                                            <?php echo $link1['titulo']; ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
        </div>
    </div>
</div>