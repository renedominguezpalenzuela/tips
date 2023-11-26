<?php 
    require_once(SRC_PATH . 'Blocks/ContenedorCalendario/MyContenedorCalendario.php');

    $data = new MyContenedorCalendario();
    $eventos = $data->calendar_events_by_ID(get_the_ID());

?>
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-12 mb-3">
                <div class="title-cursos-icon">
                    <span class="iconWaterBlue"></span>
                    <span class="iconWater"></span>
                </div>

                <h1 class="title-cursos px-md-4 px-2"><?php echo get_the_title(); ?></h1>
            </div>
        </div>

        <div class="row px-md-5 py-3">
            <div class="col-12 mb-3 contenedor-eventos-calendario-user">
                <div id="list-calendar-user-events">
                    <?php
                        if($eventos != false):
                            foreach($eventos as $evento):
                    ?>
                                <div class="container-fluid mb-2 eventosUser-calendar-user-events eventUser-<?php echo $evento['ID']; ?>" data-filter="<?php echo $evento['fechaFilter']; ?>">
                                    <div class="row" id="eventToPrint-<?php echo $evento['ID']; ?>">
                                        <div class="col-md-2 col-12">
                                            <span class="d-block mx-auto mesEvent-user">
                                                <?php echo $evento['fechaMonth']; ?>
                                            </span>
                                            <span class="d-block mx-auto diaEvent-user">
                                                <?php echo $evento['fechaDay']; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-10 col-12">
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