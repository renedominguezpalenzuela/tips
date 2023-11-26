<?php
    $uploadFoto = get_template_directory_uri() . '/public/images/icon-upload-avatar.png';

?>
<div class="modal fade modal-formulario" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="modalRegisterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-register">
    <div class="modal-content px-4 py-2">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="content-fluid">
          <div class="row p-1 mt-3">
            <div class="col-12">
              <div class="title-secciones-icon mx-md-3 mx-2">
                <span class="iconWaterBlue"></span>
                <span class="iconWater"></span>
              </div>
              <h3 class="title-secciones px-md-5 px-2">¡Quiero Participar!</h3>
              <div class="descripcion-secciones pt-3 px-2">
                <form action="" data-toggle="validator" enctype="multipart/form-data" class="register-form" id="registerForm" method="post" novalidate="novalidate">
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-12 col-lg-6">
                          <div class="mb-3">
                            <label class="form-label">Nombre y apellido<span class="text-danger">*</span></label>
                            <input type="text" class="wpcf7-form-control wpcf7-text form-control" aria-required="true" id="registerName" aria-invalid="false" value="" name="registerName" required="required" required>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Tipo de documento de identidad<span class="text-danger">*</span></label>
                            <select class="selectpicker form-select wpcf7-form-control wpcf7-text form-control" aria-required="true" id="registerTipoDocumento" aria-invalid="false" name="registerTipoDocumento" required="required" required>
                              <option value="default" selected>Seleccionar</option>
                              <option value="CEDULA">CEDULA</option>
                              <option value="PASAPORTE">PASAPORTE</option>
                              <option value="CEDULA DE EXTRANJERIA">CEDULA DE EXTRANJERIA</option>
                              <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Número de documento de identidad<span class="text-danger">*</span></label>
                            <input type="text" class="wpcf7-form-control wpcf7-text form-control" aria-required="true" id="registerDocumento" aria-invalid="false" value="" name="registerDocumento" required="required" required>
                          </div>
                        </div>
                        <div class="col-12 col-lg-6">
                          <div class="mb-3">
                            <label class="form-label">Fotografía<span class="text-danger"></span></label>

            <label class="label d-block mx-auto" title="Cambia tu foto">
              <img class="d-block mx-auto img-fluid rounded editPhoto" id="editNewUserPhoto" src="<?php echo $uploadFoto; ?>" alt="avatar">
              <input type="file" class="sr-only" id="registerFoto" name="registerFoto" accept="image/*">
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
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-lg-6">
                          <div class="mb-3">
                            <label class="form-label">Número de teléfono<span class="text-danger">*</span></label>
                            <input type="text" class="wpcf7-form-control wpcf7-text form-control" aria-required="true" id="registerTelefono" aria-invalid="false" value="" name="registerTelefono" required="required" required>
                          </div>
                        </div>

                        <div class="col-12 col-lg-6">
                          <div class="mb-3">
                            <label class="form-label">Fecha de nacimiento<span class="text-danger">*</span></label>
                            <input type="text" class="wpcf7-form-control wpcf7-text form-control" id="registerDate" aria-required="true" aria-invalid="false" value="" name="registerDate" required="required" required onkeydown="return false">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-lg-6">
                          <div class="mb-3">
                            <label class="form-label">Correo eletrónico<span class="text-danger">*</span></label>
                            <input type="email" class="wpcf7-form-control wpcf7-text wpcf7-email form-control" aria-required="true" id="registerEmail" aria-invalid="false" value="" name="registerEmail" required="required" required>
                          </div>
                        </div>

                        <div class="col-12 col-lg-6">
                          <div class="mb-3">

                            <label class="form-label">Identidad de género<span class="text-danger">*</span></label>
                            <select class="selectpicker form-select wpcf7-form-control wpcf7-text form-control" aria-required="true" id="registerIdentidadGenero" aria-invalid="false" name="registerIdentidadGenero" required="required" required>
                              <option value="default" selected>Seleccionar</option>
                              <option value="Femenino">Femenino</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Hombre Transgenero">Hombre Transgenero</option>
                              <option value="Mujer Transgenero">Mujer Transgenero</option>
                              <option value="Bigenero">Bigenero</option>
                              <option value="No Binario">No Binario</option>
                              <option value="No sabe">No sabe/No contesta</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-lg-6">
                          <div class="mb-3">
                            <label class="form-label">Localidad en la que vive<span class="text-danger">*</span></label>
                            <?php
                                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'select-localidades', array('userID' => 0, 'size' => 5, 'body' => false, 'ID' => 'registerLocalidad'));
                            ?>
                          </div>
                        </div>

                        <div class="col-12 col-lg-6">
                          <div class="mb-3">
                            <label class="form-label">¿A qué población diferencial pertenece?<span class="text-danger">*</span></label>
                            <?php
                                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'select-poblaciones-diferenciales', array('userID' => 0, 'size' => 5, 'body' => false, 'ID' => 'registerPoblacionDiferencial', 'type' => 'select'));
                            ?>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-lg-6">
                          <div class="mb-3">
                            <label class="form-label">Organización ciudadana o proceso de participación al cual pertenece<span class="text-danger">*</span></label>
                            <?php
                                get_template_part('src/Blocks/ContenedorLoginRegister/views/content', 'select-organizaciones-ciudadanas', array('userID' => 0, 'size' => 5, 'body' => false, 'ID' => 'registerOrganiacionCiudadana', 'type' => 'select'));
                            ?>
                          </div>
                        </div>

                        <div class="col-12 col-lg-6">
                          <div class="mb-3" id="otraOrganizacion">
                            <label class="form-label">Otra organización<span class="text-danger">*</span></label>
                            <input type="text" class="wpcf7-form-control wpcf7-text form-control" aria-required="true" id="registerOtraOrganizacion" aria-invalid="false" value="" name="registerOtraOrganizacion" required="required" required>
                          </div>

                          <div class="mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="registerAceptarRegistro" name="registerAceptarRegistro" aria-required="true" aria-invalid="false" required="required" required>
                            <label class="form-label addPointer" for="registerAceptarRegistro">Acepta politica de tratamiento de datos<span class="text-danger">*</span></label>
                          </div>

                          <div class="col-* d-flex justify-content-center">

                            <input name="action" value="ajax_register" type="hidden"/>

                            <input type="submit" class="wpcf7-form-control wpcf7-login btn btn-primary p-1 m-1 col-12 col-sm-12 col-md-6" value="Terminar registro">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>