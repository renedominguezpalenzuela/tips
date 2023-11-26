    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                <div class="title-secciones-icon mx-md-3 mx-2">
                    <span class="iconWaterBlue"></span>
                    <span class="iconWater"></span>
                </div>

                <h1 class="title-secciones px-md-5 px-2"><?php echo get_the_title(); ?></h1>
                <div class="descripcion-secciones pt-3 px-md-4 px-2">
                    <?php echo get_field('descripcion', get_the_ID()); ?>
                </div>

                <div class="pt-3 px-md-4 px-2">
                    <form action="" data-toggle="validator" enctype="multipart/form-data" class="login-form" id="loginForm" method="post" novalidate="novalidate">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="mb-3">
                                    <p>
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <span class="wpcf7-form-control-wrap" data-name="email">
                                            <input class="wpcf7-form-control wpcf7-text wpcf7-email form-control" aria-required="true" id="loginEmail" aria-invalid="false" value="" type="email" name="email" required="required" required>
                                        </span>
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <p>
                                        <label class="form-label">Contraseña <span class="text-danger">*</span></label>

                                        <span class="wpcf7-form-control-wrap" data-name="password">
                                            <input class="wpcf7-form-control-password wpcf7-password form-control" id="loginPass" aria-required="true" aria-invalid="false" value="" type="password" name="password" required="required" required>
                                        </span>
                                    </p>
                                    <p>
                                        <input type="checkbox" id="showPass" onclick="showPassword()">
                                        <label class="addPointer" for="showPass">Mostrar contraseña</label>
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <p>
                                        <input class="wpcf7-form-control wpcf7-login btn btn-primary p-1 m-1 col-12 col-sm-12 col-md-6" type="submit" value="Iniciar sesión">
                                    </p>
                                </div>

                            </div>
                        </div> 
                    </form>
                </div>

                <div class="login-links px-md-4 px-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalRecoverPass">Olvidé mi contraseña</a>
                </div>
                <div class="login-links pt-2 px-md-4 px-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalRegister">Crear mi usuario</a>
                </div>

                <div class="row px-md-4 px-2 mt-5">
                    <?php
                        // check if the flexible content field has rows of data
                        if( have_rows('contenedor_botones', get_the_ID()) ):
                            // loop through the rows of data
                            $numrows = count( get_field( 'contenedor_botones' ) );

                            if($numrows == 1)
                                $buttonCols = 'col-lg-8 col-md-12';
                            elseif($numrows == 2)
                                $buttonCols = 'col-lg-6 col-md-12';

                            $cont = 0;
                            while ( have_rows('contenedor_botones', get_the_ID()) ) : the_row();
                                // check current row layout
                                $cont++;
                                if( get_row_layout() == 'boton_izquierda' ):
                                    $buttonClass = "btn btn-primary p-1 my-1 boton_pagination_cursos";

                                    $aditionalClass = get_sub_field('clase_adicional', get_the_ID());

                                    if($aditionalClass != '')
                                        $buttonClass .= ' ' . $aditionalClass;
                    ?>
                                    <div class="<?php echo $buttonCols; ?>">
                                        <a class="<?php echo $buttonClass; ?>" href="<?php echo get_sub_field('pagina_destino', get_the_ID()); ?>">
                                            <i class="fa fa-chevron-left icono-btn-cursos-izq"></i>
                                            <span class="separator-btn-cursos-izq"></span>
                                            <?php echo get_sub_field('titulo_boton', get_the_ID()); ?>
                                        </a>
                                    </div>
                    <?php
                                elseif( get_row_layout() == 'boton_derecha' ):
                                    $buttonClass = "btn btn-primary p-1 my-1 boton_pagination_cursos";

                                    $aditionalClass = get_sub_field('clase_adicional', get_the_ID());

                                    if($aditionalClass != '')
                                        $buttonClass .= ' ' . $aditionalClass;
                    ?>
                                    <div class="<?php echo $buttonCols; ?>">
                                        <a class="<?php echo $buttonClass; ?>" aria-disabled="true" href="<?php echo get_sub_field('pagina_destino', get_the_ID()); ?>">
                                            <?php echo get_sub_field('titulo_boton', get_the_ID()); ?>
                                            <i class="fa fa-chevron-right icono-btn-cursos-der"></i>
                                            <span class="separator-btn-cursos-der"></span>
                                        </a>
                                    </div>
                    <?php
                                endif;
                            endwhile;
                        endif;
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                <?php
                    if(get_field('agregar_video', get_the_ID()) == "si"):
                ?>
                        <div class="row px-md-5 px-lg-2 px-2">

                        <div class="secciones-video col-md-12 col-sm-12">
                            <?php
                                if(get_field('insertar_video_de_youtube', get_the_ID()) == "si"):
                                    echo get_field('video_youtube', get_the_ID());
                                else:
                                    $poster = get_field('video_poster', get_the_ID());
                                    
                                    if($poster == '')
                                      $poster = get_template_directory_uri() . '/public/images/video-poster.png';

                            ?>
                                    <video width="100%" style="border-radius: 15px;" preload="metadata" poster="<?php echo $poster ?>" controls>
                                        <source src="<?php echo get_field('subir_video', get_the_ID()); ?>" type="video/mp4">
                                    </video>
                            <?php
                                endif;
                            ?>
                        </div>
                    </div>
                <?php
                    endif;
                ?>
            </div>
        </div>
    </div>