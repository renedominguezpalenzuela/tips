<?php 

?>
    <div class="container-fluid">
        <div class="row px-md-4 px-2">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 my-lg-auto pb-5">
                <div class="col-12 col-md-12 my-3">
                    <?php
                        if(get_field('agregar_mapa', get_the_ID()) == 'si')
                        {
                            require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                            $container = new MyBlocksContainer();

                            if(get_field('tipo_de_mapa', get_the_ID()) == 'general')
                                $container->views_blocks_container('ContenedorFiltrosMapaGeneral');
                            else
                                $container->views_blocks_container('ContenedorFiltrosMapaIniciativas');
                        }
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 pb-5">
                <?php
                    if(get_field('agregar_mapa', get_the_ID()) == 'si')
                    {
                        require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                        $container = new MyBlocksContainer();

                        if(get_field('tipo_de_mapa', get_the_ID()) == 'general')
                            $container->views_blocks_container('ContenedorMapaGeneral');
                        else
                            $container->views_blocks_container('ContenedorMapaIniciativas');
                    }
                ?>
            </div>
            <?php
                if(get_field('agregar_participacion', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('ContenedorParticipacionAlDia');
                }
                if(get_field('agregar_calendario', get_the_ID()) == 'si')
                {
                    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                    $container = new MyBlocksContainer();

                    $container->views_blocks_container('ContenedorCalendario');
                }
            ?>
        </div>
    </div>