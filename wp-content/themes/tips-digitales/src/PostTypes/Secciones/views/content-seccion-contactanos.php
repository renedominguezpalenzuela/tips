<?php 
?>
    <div class="container-fluid">
        <div class="row mx-md-3 my-5">
            <div class="col-12 col-md-12 mb-1">
                <div class="col-md-12">
                    <?php
                        if(get_field('agregar_formulario', get_the_ID()) == 'si')
                        {
                            require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                            $container = new MyBlocksContainer();

                            $container->views_blocks_container('ContenedorFormularioSecciones');
                        }
                    ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row px-4 py-2 pb-5">
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