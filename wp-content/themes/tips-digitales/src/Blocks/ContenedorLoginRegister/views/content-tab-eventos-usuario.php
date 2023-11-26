<?php
    require_once(SRC_PATH . 'Blocks/ContenedorCalendario/MyContenedorCalendario.php');

    $currentUser = $args['userID'];

    $data = new MyContenedorCalendario();
    $eventos = $data->calendar_events_by_user($currentUser, false);
?>

<div class="container-fluid">
    <div class="row py-3">
        <div class="col-lg-6 col-12 pb-lg-0 pb-5">
            <?php
                get_template_part('src/Blocks/ContenedorCalendario/views/content', 'contenedor-calendario-eventos-usuario', array('userID' => $currentUser));
            ?>
        </div>
        <div class="col-lg-6 col-12 mb-3 contenedor-eventos-calendario-user">
            <div id="list-calendar-user-events">
                <?php
                    if($eventos != false):
                        foreach($eventos as $evento):
                ?>
                            <div class="container-fluid mb-2 eventosUser-calendar-user-events eventUser-<?php echo $evento['ID']; ?>" data-filter="<?php echo $evento['fechaFilter']; ?>">
                                <div class="row" id="eventToPrint-<?php echo $evento['ID']; ?>">
                                    <div class="col-md-3 col-12">
                                        <span class="d-block mx-auto mesEvent-user">
                                            <?php echo $evento['fechaMonth']; ?>
                                        </span>
                                        <span class="d-block mx-auto diaEvent-user">
                                            <?php echo $evento['fechaDay']; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <span class="d-block mx-auto tituloEvent-user">
                                            <?php echo $evento['titulo']; ?>
                                        </span>
                                        <div class="hr2"></div>
                                        <span class="d-block mx-auto direccionEvent-user pt-2">
                                            <?php echo $evento['direccion']; ?>
                                        </span>
                                        <span class="d-block mx-auto horaEvent-user">
                                            <?php echo $evento['fechaHour']; ?>
                                        </span>
                                        <p class="d-block mx-auto descripcionEvent-user pt-2">
                                            <?php echo $evento['descripcion']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end calendar-user-bottom">
                                            <button class="btn btn-primary p-1 my-1 boton_pagination_cursos button-borrar-evento" type="button" data-user="<?php echo $currentUser; ?>" data-event="<?php echo $evento['ID']; ?>">Borrar</button>
                                            <button class="btn btn-primary p-1 my-1 boton_pagination_cursos showPopupCompartirEventos" data-url="<?php echo get_the_permalink($evento['ID']); ?>" data-title="<?php echo $evento['titulo']; ?>" data-event="<?php echo $evento['ID']; ?>" type="button">Compartir</button>
                                            <?php
                                                if($evento['imagen'] == ''):
                                            ?>
                                                    <button class="btn btn-primary p-1 my-1 boton_pagination_cursos button-descargar-evento" type="button" data-event="<?php echo $evento['ID']; ?>" data-name="<?php echo $evento['titulo']; ?>">Descargar</button>
                                            <?php
                                                else:
                                            ?>
                                                    <a href="<?php echo $evento['imagen']; ?>" class="btn btn-primary p-1 my-1 boton_pagination_cursos" type="button" data-event="<?php echo $evento['ID']; ?>" data-name="<?php echo $evento['titulo']; ?>" download>Descargar</a>
                                            <?php
                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                        endforeach;
                    endif;
                ?>
            </div>
            <div class="row no-event-calendar-user-events">
                <div class="col-12">
                    <span class="d-block mx-auto tituloEvent-user">
                        No hay eventos para el día escogido, por favor selecciona otra fecha
                    </span>
                    <div class="hr2"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php

?>