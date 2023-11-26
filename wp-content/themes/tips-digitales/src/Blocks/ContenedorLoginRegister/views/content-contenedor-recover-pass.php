<?php
  $grupo_recover_pass = get_field('grupo_recuperar_contrasena', 'option');

  if($grupo_recover_pass == null || $grupo_recover_pass == '')
    $grupo_recover_pass['descripcion'] = '';
?>
<div class="modal fade modal-formulario" id="modalRecoverPass" tabindex="-1" role="dialog" aria-labelledby="modalRecoverPassLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content px-4 py-2">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="content-fluid">
          <div class="row p-3 mt-3 ml-3 mr-3 ">
            <div class="col-12">
              <div class="title-secciones-icon mx-md-3 mx-2">
                <span class="iconWaterBlue"></span>
                <span class="iconWater"></span>
              </div>
              <h3 class="title-secciones px-md-5 px-2">Recupera tu contraseña</h3>
              <div class="descripcion-secciones pt-3 px-md-5 px-2">
                <p><?php echo $grupo_recover_pass['descripcion']; ?></p>

                <form action="" data-toggle="validator" enctype="multipart/form-data" class="recover-pass-form" id="recoverPassForm" method="post" novalidate="novalidate">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <p>
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <span class="wpcf7-form-control-wrap" data-name="email">
                                        <input class="wpcf7-form-control wpcf7-text wpcf7-email form-control" aria-required="true" id="recoverPassEmail" aria-invalid="false" value="" type="email" name="email" required="required" required>
                                    </span>
                                </p>
                            </div>

                            <div class="mb-3">
                                <p>
                                    <input class="wpcf7-form-control wpcf7-login btn btn-primary p-1 m-1 col-12 col-sm-12 col-md-6" type="submit" value="Recuperar contraseña">
                                </p>
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