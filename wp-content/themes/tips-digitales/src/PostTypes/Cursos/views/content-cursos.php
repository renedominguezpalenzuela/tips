<?php 

?>
    <div class="container-fluid">
        <div class="row mx-md-3 my-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                <div class="title-cursos-icon">
                    <span class="iconWaterBlue"></span>
                    <span class="iconWater"></span>
                </div>

                <h1 class="title-cursos px-md-4 px-2"><?php echo get_the_title(); ?></h1>
                <div class="descripcion-cursos pt-3 px-md-4 px-2">
                    <?php echo get_field('descripcion', get_the_ID()); ?>
                </div>

                <div class="px-md-4 my-3 mx-md-4 mx-2">
                    <div class="mb-2 accordion" id="accordion_a_quien_va_dirigido_el_curso">
                        <div class="accordion-item p-0">
                            <?php
                                // check if the flexible content field has rows of data
                                if( have_rows('a_quien_va_dirigido_el_curso', get_the_ID()) ):
                                    $cont=0;
                                    $numrows = count( get_field( 'a_quien_va_dirigido_el_curso' ) );

                                    $myClass = 'my-2';

                                    // loop through the rows of data
                                    while ( have_rows('a_quien_va_dirigido_el_curso', get_the_ID()) ) : the_row();

                                        if($cont == 0):
                            ?>
                                            <div class="accordion-header datos-curso-accordion" id="">
                                                <button class="accordion-button-cursos accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <?php echo get_sub_field('nombre', get_the_ID()); ?>
                                                </button>
                                            </div>
                                            <div class="accordion-collapse-cursos">
                            <?php
                                        else:
                                            if($cont == 1)
                                                $myClass = 'mt-3 mb-2';
                                            else
                                                $myClass = 'my-2';
                            ?>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion_a_quien_va_dirigido_el_curso">
                                            <div class="accordion-body accordion-descripcion-cursos <?php echo $myClass; ?> px-4">
                                                    <?php echo get_sub_field('nombre', get_the_ID()); ?>
                                                </div>
                                            </div>
                            <?php
                                        endif;

                                        if($cont == $numrows-1)
                                            echo '</div>';
                                        $cont++;
                                    endwhile;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>

                <div class="px-md-4 my-3 mx-md-4 mx-2">
                    <div class="mb-2 accordion" id="accordion_resumen_del_curso">
                        <div class="accordion-item p-0">
                            <?php
                                // check if the flexible content field has rows of data
                                if( have_rows('resumen_del_curso', get_the_ID()) ):
                                    $cont=0;
                                    $numrows = count( get_field( 'resumen_del_curso' ) );

                                    $myClass = 'my-2';

                                    // loop through the rows of data
                                    while ( have_rows('resumen_del_curso', get_the_ID()) ) : the_row();

                                        if($cont == 0):
                            ?>
                                            <div class="accordion-header datos-curso-accordion" id="">
                                                <button class="accordion-button-cursos accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                <?php echo get_sub_field('valores', get_the_ID()); ?>
                                                </button>
                                            </div>
                                            <div class="accordion-collapse-cursos">
                            <?php
                                        else:
                                            if($cont == 1)
                                                $myClass = 'mt-3 mb-2';
                                            else
                                                $myClass = 'my-2';
                            ?>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion_resumen_del_curso">
                                                <div class="accordion-body accordion-descripcion-cursos <?php echo $myClass; ?> px-4">
                                                    <?php echo get_sub_field('valores', get_the_ID()); ?>
                                                </div>
                                            </div>
                            <?php
                                        endif;

                                        if($cont == $numrows-1)
                                            echo '</div>';
                                        $cont++;
                                    endwhile;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row px-md-4 px-2 mt-5">
                    <?php
                        // check if the flexible content field has rows of data
                        if( have_rows('contenedor_botones', get_the_ID()) ):
                            // loop through the rows of data

                            $numrows = count( get_field( 'contenedor_botones' ) );

                            if($numrows == 1)
                                $buttonCols = 'col-lg-8 col-md-12';
                            elseif($numrows >= 2)
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
                                        <a class="<?php echo $buttonClass; ?>" href="<?php echo get_sub_field('pagina_destino', get_the_ID()); ?>">
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
                <div class="row">
                    <div class="col-12 px-md-4 px-4">
                        <div class="col-md-12 col-sm-12 cursos-imagenes">
                            <img src="<?php echo get_field('imagen_curso', get_the_ID()); ?>" class="img-fluid">
                        </div>

                        <div class="d-grid gap-2 col-md-6 col-sm-12 mx-auto boton_curso">
                            <?php
                                if(get_field('boton_registro_curso', get_the_ID()) == 'no'):
                            ?>
                                <a class="btn btn-outline-primary p-1 mt-3" href="<?php echo get_field('link_curso', get_the_ID()); ?>" target="_blank">
                                    <?php echo get_field('titulo_boton_curso', get_the_ID()); ?>
                                </a>
                            <?php
                                else:
                            ?>
                                <a class="btn btn-outline-primary p-1 mt-3" href="#" data-bs-toggle="modal" data-bs-target="#modalFormulario">
                                    <?php echo get_field('titulo_boton_curso', get_the_ID()); ?>
                                </a>
                            <?php
                                endif;
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>