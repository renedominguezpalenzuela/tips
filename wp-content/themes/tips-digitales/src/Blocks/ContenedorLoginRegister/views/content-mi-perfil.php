<?php
    $currentUser = get_current_user_id();

    if($currentUser != 0)
    {
        $userName = get_user_meta( $currentUser, 'first_name', true );
        $userFoto = get_user_meta( $currentUser, 'user_foto', true );

        if($userFoto == '')
            $userFoto = get_template_directory_uri() . '/public/images/avatar-default.png';

        $userOrgCiudadana = get_user_meta( $currentUser, 'user_orgCiudadana', true);
        $userOrgExtra = get_user_meta( $currentUser, 'user_orgExtra', true );

        if($userOrgCiudadana != '')
        {
            $userOrganizaciones = explode(',', $userOrgCiudadana);

            $orgText = "Miembro de ";
            foreach($userOrganizaciones as $org)
            {
                if($org != 'Otra')
                    $orgText .= $org . ', ';
            }
            
            $orgText = substr($orgText, 0, -2);

            if($userOrgExtra)
                $orgText .= ' y ' . $userOrgExtra;
        }
        else
        {
            $orgText = 'Miembro de la comunidad';
        }
?>
        <div class="container-fluid">
            <div class="row px-md-5 px-0 mx-3 my-4 border-container">
                <div class="col-12 mt-4 event ps-0 pe-0">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                                <div class="name-profile col-lg-6 col-12">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="avatar-myspace" style="background-image: url(<?php echo $userFoto; ?>);">
                                            </div>
                                        </div>
                                        <div class="col-8 my-auto">
                                            <h3 class="px-md-3 px-4 my-auto py-2 nombre-user-edit-perfil"><?php echo $userName; ?></h3>
                                        </div>
                                        <div class="col-2 g-0">
                                            <label class="btn bloque1 blue my-auto float-end">
                                                <input type="radio" name="tabsMiPerfilArr" id="content-4" autocomplete="off" value="tabsMiPerfilArr4" class="inputMiPerfilArr" checked> <i class="fa-regular fa-pen-to-square"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="cargo-block col-lg-6 col-12">
                                    <div class="row">
                                        <div class="d-lg-none col-2">
                                        </div>
                                        <div class="col-10">
                                            <h3 class="px-md-3 px-4 my-auto py-2 cargo-block-text">
                                                <?php echo $orgText; ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="body-content" id="tabsMiPerfilArr">
                        <div class="tabsMiPerfilArr pt-5 pb-5 px-3" id="tabsMiPerfilArr1">
                            <?php
                                require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
                                $container = new MyBlocksContainer();

                                $container->views_blocks_container('ContenedorMiBuzon');
                            ?>
                        </div>
                        <div class="tabsMiPerfilArr pt-3 pb-5 px-3" id="tabsMiPerfilArr2">
                            <?php
                                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'tab-calendario-usuario', array('userID' => $currentUser));
                            ?>
                        </div>
                        <div class="tabsMiPerfilArr pt-3 pb-5 px-3" id="tabsMiPerfilArr3">
                            <?php
                                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'tab-eventos-usuario', array('userID' => $currentUser));
                            ?>
                        </div>

                        <div class="tabsMiPerfilArr pt-4 mt-2 pb-5 px-3" id="tabsMiPerfilArr4">
                            <?php
                                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'tab-editar-perfil', array('userID' => $currentUser));
                            ?>
                        </div>

                    </div>

                    <div class="col-md-12 footer-botones-tab" data-toggle="buttons">
                        <div class="row px-2">
                            <label class="col-lg-3 col-0 px-3">
                            </label>
                            <label class="btn btn-tabs-buttons bloque1 blue col-lg-3 col-4  px-3 checked">
                                <span class="btn-pp blue"></span>

                                <input type="radio" name="tabsMiPerfilArr" id="content-1" autocomplete="off" value="tabsMiPerfilArr1" class="inputMiPerfilArr" checked> Mi buzón
                            </label>
                            <label class="btn btn-tabs-buttons bloque1 yellow col-lg-3 col-4 px-3">
                                <span class="btn-pp yellow"></span>

                                <input type="radio" name="tabsMiPerfilArr" id="content-2" autocomplete="off" value="tabsMiPerfilArr2" class="inputMiPerfilArr"> Calendario
                            </label>
                            <label class="btn btn-tabs-buttons bloque1 blue col-lg-3 col-4 px-3">
                                <span class="btn-pp blue"></span>

                                <input type="radio" name="tabsMiPerfilArr" id="content-3" autocomplete="off" value="tabsMiPerfilArr3" class="inputMiPerfilArr"> Tus eventos
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row px-md-5 px-0 mx-3 my-4 border-container">
                <div class="col-12 mt-4 event ps-0 pe-0">
                    <div class="body-content-abajo" id="tabsMiPerfilAb">
                        <div class="tabsMiPerfilAb pt-3 pb-2 px-3" id="tabsMiPerfilAb1">
                            <?php
                                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'tab-ultimas-noticias', array('userID' => $currentUser));
                            ?>
                        </div>
                        <div class="tabsMiPerfilAb pt-3 pb-2 px-3" id="tabsMiPerfilAb2">
                            <?php
                                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'tab-documentos-usuario', array('userID' => $currentUser));
                            ?>
                        </div>
                        <div class="tabsMiPerfilAb pt-3 pb-2 px-3" id="tabsMiPerfilAb3">
                            <?php
                                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'tab-propuestas-usuario', array('userID' => $currentUser));
                            ?>
                        </div>
                    </div>

                    <div class="col-md-12 footer-botones-tab" data-toggle="buttons">
                        <div class="row px-2">
                            <label class="col-lg-3 col-0 px-3">
                            </label>
                            <label class="btn btn-tabs-buttons bloque2 blue col-lg-3 col-4 px-3 checked">
                                <span class="btn-pp blue"></span>

                                <input type="radio" name="tabsMiPerfilAb" id="content-ab-1" autocomplete="off" value="tabsMiPerfilAb1" class="inputMiPerfilAb" checked> Últimas noticias
                            </label>
                            <label class="btn btn-tabs-buttons bloque2 yellow col-lg-3 col-4 px-3">
                                <span class="btn-pp yellow"></span>

                                <input type="radio" name="tabsMiPerfilAb" id="content-ab-2" autocomplete="off" value="tabsMiPerfilAb2" class="inputMiPerfilAb"> Mis Documentos
                            </label>
                            <label class="btn btn-tabs-buttons bloque2 blue col-lg-3 col-4 px-3">
                                <span class="btn-pp blue"></span>

                                <input type="radio" name="tabsMiPerfilAb" id="content-ab-3" autocomplete="off" value="tabsMiPerfilAb3" class="inputMiPerfilAb"> Mis propuestas
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalPopupCompartirEventos" tabindex="-1" aria-labelledby="modalPopupCompartirLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content-popup-compartir">
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
                                            <h3 class="title-container-yoparticipoensalud px-2">
                                                Compartir
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div id="shareProfileEvento" class="col-12 mx-auto" data-url="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalPopupCompartirDocumentos" tabindex="-1" aria-labelledby="modalPopupCompartirDoumentosLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content-popup-compartir">
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
                                            <h3 class="title-container-yoparticipoensalud px-2">
                                                Compartir
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div id="shareProfileDocumento" class="col-12 mx-auto" data-url="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');
            $container = new MyBlocksContainer();

            $container->views_blocks_container('ContenedorMiBuzonCompartir');
        ?>
<?php
    }
?>