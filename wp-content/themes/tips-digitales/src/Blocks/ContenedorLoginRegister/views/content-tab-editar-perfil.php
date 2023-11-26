<?php
    $userEmail = get_userdata($args['userID'])->user_email;
    $userTelefono = get_user_meta( $args['userID'], 'user_telefono', true );

    $uploadFoto = get_template_directory_uri() . '/public/images/icon-upload-avatar.png';

?>

<div class="container-fluid">
    <form action="" data-toggle="validator" enctype="multipart/form-data" class="editUser-form row" id="editUserForm" method="post" novalidate="novalidate">
        <input type="hidden" id="userID" name="userID" value="<?php echo $args['userID']; ?>">

        <div class="col-12">
            <div class="d-flex ms-1 mt-4">
                <span class="iconInfo modIcon me-2"></span>
                <div class="col">
                    <h3 class="title-container-yoparticipoensalud px-2">Editar perfil</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 pb-4">
            <div class="col pt-3 px-3">
                <h3 class="container-changeFoto px-2">Cambiar foto</h3>
            </div>

            <label class="label d-block mx-auto" title="Cambia tu foto">
              <img class="d-block mx-auto img-fluid rounded editPhoto" id="editPhoto" src="<?php echo $uploadFoto; ?>" alt="avatar">
              <input type="file" class="sr-only" id="updateFoto" name="updateFoto" accept="image/*">
            </label>

            <div class="progress">
              <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>

            <div class="modal fade" id="modalPhoto" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1">
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
                                  Recortar foto
                                </h3>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                          <img id="imagePhoto" src="">
                        </div>
                    </div>
                    <div class="row px-4 py-3">
                        <div class="col-md-6 col-12">
                            <button type="button" class="btn btn-primary p-1 my-1 boton_pagination_cursos" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-md-6 col-12">
                            <button type="button" class="btn btn-primary p-1 my-1 boton_pagination_cursos" id="crop">Recortar</button>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="form-label">Número de teléfono</label>
                <input type="text" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" name="updateTelefono" placeholder="" value="<?php echo $userTelefono; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" name="updatePass" placeholder="" value="">
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Localidad en la que vive
                </label>
                <?php
                    get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'select-localidades', array('userID' => $args['userID']));
                ?>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Organización o proceso de participación
                </label>
                <?php
                    get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'select-organizaciones-ciudadanas', array('userID' => $args['userID']));
                ?>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="form-label">Agregar correo de recuperación</label>
                <input type="text" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" name="updateEmail" value="<?php echo $userEmail; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar Contraseña</label>
                <input type="password" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" name="updatePassConfirm" placeholder="" value="">
            </div>

            <div class="mb-3">
                <label class="form-label">
                Identidad de género
                </label>
                <?php
                    get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'select-identidad-genero', array('userID' => $args['userID']));
                ?>
            </div>
            <div class="mb-4">
                <label class="form-label">¿A qué población diferencial pertenece?</label>
                <?php
                    get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'select-poblaciones-diferenciales', array('userID' => $args['userID']));
                ?>
            </div>
            <div class="row mb-0">
                <div class="col">
                    <a href="<?php echo get_permalink( get_page_by_path( 'mi-perfil' ) ); ?>" class="btn btn-primary p-1 my-1 boton_pagination_cursos" href="#">
                        Cancelar
                    </a>
                </div>
                <div class="col">

                    <input name="action" value="ajax_update" type="hidden"/>

                    <input type="submit" class="btn btn-primary p-1 my-1 boton_pagination_cursos" value="Guardar">
                </div>
            </div>
        </div>
    </form>
</div>