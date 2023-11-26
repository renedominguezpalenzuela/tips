<?php

if (!defined('ABSPATH')) { exit; }

class MyContenedorCalendario
{
    private $name       = 'Calendario';
    private $slug       = 'Calendario';
    private $post_type  = 'Calendario';

    public function __construct()
    {
    }

    public function init()
    {
        $this->init_actions();
        $this->init_filters();
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_slug()
    {
        return $this->slug;
    }

    public function get_post_type()
    {
        return $this->post_type;
    }

    public function init_actions()
    {
        add_action( 'init', [$this, 'acf_calendario_field'] );

        add_action('wp_ajax_ajax_calendar_events', array($this, 'ajax_calendar_events'));
        add_action('wp_ajax_nopriv_ajax_calendar_events', array($this, 'ajax_calendar_events'));

        add_action('wp_ajax_ajax_calendar_events_user', array($this, 'ajax_calendar_events_user'));
        add_action('wp_ajax_nopriv_ajax_calendar_events_user', array($this, 'ajax_calendar_events_user'));

        add_action('wp_ajax_ajax_calendar_asistir', array($this, 'ajax_calendar_asistir'));
        add_action('wp_ajax_nopriv_ajax_calendar_asistir', array($this, 'ajax_calendar_asistir'));

        add_action('wp_ajax_ajax_calendar_borrar', array($this, 'ajax_calendar_borrar'));
        add_action('wp_ajax_nopriv_ajax_calendar_borrar', array($this, 'ajax_calendar_borrar'));
    }

    public function init_filters()
    {
    }

    public function load_styles()
    {
    }

    public function load_scripts()
    {
    }

    public function ajax_calendar_events()
    {
        $start      = esc_attr($_POST["start"]);
        $end        = esc_attr($_POST["end"]);
        $taxonomies = esc_attr($_POST["taxonomies"]);

        $taxonomies = json_decode($taxonomies);

        if($taxonomies == false)
        {
            $args = array
            (
                'post_type' => 'eventos',
                'order' => 'ASC',
                'numberposts'   => -1,
                'fields'        => 'ids',
                'post_status'   => 'publish',
                'meta_query' => array
                (
                    'relation'      => 'AND',
                    array(
                        'key'       => 'fecha',
                        'compare'   => '>=',
                        'value'     => $start,
                    ),
                    array(
                        'key'       => 'fecha',
                        'compare'   => '<=',
                        'value'     => $end,
                    )
                )
            );
        }
        else
        {
            $args = array
            (
                'post_type' => 'eventos',
                'order' => 'ASC',
                'numberposts'   => -1,
                'fields'        => 'ids',
                'post_status'   => 'publish',
                'meta_query' => array
                (
                    'relation'      => 'AND',
                    array(
                        'key'       => 'fecha',
                        'compare'   => '>=',
                        'value'     => $start,
                    ),
                    array(
                        'key'       => 'fecha',
                        'compare'   => '<=',
                        'value'     => $end,
                    )
                ),
                'tax_query' => array
                (
                    array(
                      'taxonomy' => 'seccion',
                      'field' => 'term_id', 
                      'terms' => $taxonomies,
                      'include_children' => false
                    )
                )
            );
        }

        $eventosID = get_posts($args);

        if($eventosID)
        {
            $cont = 0;

            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            foreach ($eventosID as $eventoID)
            {
                $fechaTemp = get_field('fecha', $eventoID);
                $fechaCalendario = explode(" ", $fechaTemp);

                $terms = wp_get_post_terms( $eventoID, 'seccion', array( 'fields' => 'ids' ) );

                $eventos[$cont]['ID'] = $eventoID;
                $eventos[$cont]['categoria'] = get_the_title($eventoID);

                $eventos[$cont]['categoria'] = $terms;

                $eventos[$cont]['titulo'] = get_the_title($eventoID);
                $eventos[$cont]['descripcion'] = get_field('descripcion', $eventoID);
                $eventos[$cont]['direccion'] = get_field('direccion', $eventoID);
                $eventos[$cont]['fechaCalendario'] = $fechaCalendario[0];


                $strTime   = strtotime($fechaTemp);
                $day    = date('j', $strTime);
                $month  = $meses[date('n', $strTime) - 1];
                $year   = date('Y', $strTime);
                $hour   = date('g:i a', $strTime);

                $eventos[$cont]['fechaMostrar'] = $day . ' de ' . $month . ' de ' . $year . ' ' . $hour;

                $eventos[$cont]['fechaFilter']     = $day . '/' . $month . '/' . $year;

                $cont++;
            }

            $result['type'] = 'success';
            $result['result'] = $eventos;
        }
        else
            $result['type'] = 'no-events';

        $result = json_encode($result);
        echo $result;
        wp_die();
    }

    public function calendar_last_events($size)
    {
        date_default_timezone_set('America/Bogota');

        $start = date("Y-m-01");

        $args = array
        (
            'post_type' => 'eventos',
            'meta_key'          => 'fecha',
            'orderby'           => 'meta_value',
            'order'             => 'ASC',
            'numberposts'   => $size,
            'fields'        => 'ids',
            'post_status'   => 'publish',
            'meta_query' => array
            (
                array(
                    'key'       => 'fecha',
                    'compare'   => '>=',
                    'value'     => $start,
                ),
            )
        );

        $eventosID = get_posts($args);

        if($eventosID)
        {
            $cont = 0;

            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            foreach ($eventosID as $eventoID)
            {
                $fechaTemp = get_field('fecha', $eventoID);
                $fechaCalendario = explode(" ", $fechaTemp);

                $terms = wp_get_post_terms( $eventoID, 'seccion', array( 'fields' => 'ids' ) );

                $eventos[$cont]['ID'] = $eventoID;
                $eventos[$cont]['categoria'] = $terms;
                $eventos[$cont]['titulo'] = get_the_title($eventoID);
                $eventos[$cont]['descripcion'] = get_field('descripcion', $eventoID);
                $eventos[$cont]['direccion'] = get_field('direccion', $eventoID);
                $eventos[$cont]['fechaCalendario'] = $fechaCalendario[0];

                $strTime   = strtotime($fechaTemp);

                $day    = date('j', $strTime);
                $month  = $meses[date('n', $strTime) - 1];
                $year   = date('Y', $strTime);
                $hour   = date('g:i a', $strTime);

                $eventos[$cont]['fechaDay']     = $day;
                $eventos[$cont]['fechaMonth']   = $month;
                $eventos[$cont]['fechaYear']    = $year;
                $eventos[$cont]['fechaHour']    = $hour;

                $eventos[$cont]['imagen']       = get_field('pieza_grafica', $eventoID);

                $eventos[$cont]['fechaFilter']     = $day . '/' . $month . '/' . $year;

                $cont++;
            }
            
            return $eventos;
        }
        else
            return false;
    }

    public function calendar_events_by_user($userID, $allEvents = false)
    {
        $data = get_user_meta( $userID, 'user_eventos', true); 

        if($data)
        {
            $eventosUser = explode(',', $data);

            if(count($eventosUser) == 0)
                $eventosUser = false;
        }
        else
            $eventosUser = false;

        if($eventosUser == false)
            return false;

        date_default_timezone_set('America/Bogota');
        $start = date("Y-m-d h:i a");

        if($allEvents == true)
        {
            $args = array
            (
                'post_type'     => 'eventos',
                'meta_key'      => 'fecha',
                'orderby'       => 'meta_value',
                'order'         => 'ASC',
                'numberposts'   => -1,
                'fields'        => 'ids',
                'post_status'   => 'publish',
                'include'       => $eventosUser
            );
        }
        else
        {
            $args = array
            (
                'post_type'     => 'eventos',
                'meta_key'      => 'fecha',
                'orderby'       => 'meta_value',
                'order'         => 'ASC',
                'numberposts'   => -1,
                'fields'        => 'ids',
                'post_status'   => 'publish',
                'include'       => $eventosUser,
                'meta_query' => array
                (
                    array(
                        'key'       => 'fecha',
                        'compare'   => '>=',
                        'value'     => $start,
                    ),
                )
            );
        }

        $eventosID = get_posts($args);

        if($eventosID)
        {
            $cont = 0;

            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            foreach ($eventosID as $eventoID)
            {
                $fechaTemp = get_field('fecha', $eventoID);
                $fechaCalendario = explode(" ", $fechaTemp);

                $terms = wp_get_post_terms( $eventoID, 'seccion', array( 'fields' => 'ids' ) );

                $eventos[$cont]['ID'] = $eventoID;
                $eventos[$cont]['categoria'] = $terms;
                $eventos[$cont]['titulo'] = get_the_title($eventoID);
                $eventos[$cont]['descripcion'] = get_field('descripcion', $eventoID);
                $eventos[$cont]['direccion'] = get_field('direccion', $eventoID);
                $eventos[$cont]['fechaCalendario'] = $fechaCalendario[0];

                $strTime   = strtotime($fechaTemp);

                $day    = date('j', $strTime);
                $month  = $meses[date('n', $strTime) - 1];
                $year   = date('Y', $strTime);
                $hour   = date('g:i a', $strTime);

                $eventos[$cont]['fechaDay']     = $day;
                $eventos[$cont]['fechaMonth']   = $month;
                $eventos[$cont]['fechaYear']    = $year;
                $eventos[$cont]['fechaHour']    = $hour;

                $eventos[$cont]['imagen']       = get_field('pieza_grafica', $eventoID);

                $eventos[$cont]['fechaFilter']     = $day . '/' . $month . '/' . $year;

                $cont++;
            }
            
            return $eventos;
        }
        else
            return false;
    }

    public function calendar_events_by_ID($eventID)
    {
        date_default_timezone_set('America/Bogota');
        $start = date("Y-m-d h:i a");

        $args = array
        (
            'post_type'     => 'eventos',
            'meta_key'      => 'fecha',
            'orderby'       => 'meta_value',
            'order'         => 'ASC',
            'numberposts'   => 1,
            'fields'        => 'ids',
            'post_status'   => 'publish',
            'p'             => $eventID
        );

        $eventosID = get_posts($args);

        if($eventosID)
        {
            $cont = 0;

            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            foreach ($eventosID as $eventoID)
            {
                $fechaTemp = get_field('fecha', $eventoID);
                $fechaCalendario = explode(" ", $fechaTemp);

                $terms = wp_get_post_terms( $eventoID, 'seccion', array( 'fields' => 'ids' ) );

                $eventos[$cont]['ID'] = $eventoID;
                $eventos[$cont]['categoria'] = $terms;
                $eventos[$cont]['titulo'] = get_the_title($eventoID);
                $eventos[$cont]['descripcion'] = get_field('descripcion', $eventoID);
                $eventos[$cont]['direccion'] = get_field('direccion', $eventoID);
                $eventos[$cont]['fechaCalendario'] = $fechaCalendario[0];

                $strTime   = strtotime($fechaTemp);

                $day    = date('j', $strTime);
                $month  = $meses[date('n', $strTime) - 1];
                $year   = date('Y', $strTime);
                $hour   = date('g:i a', $strTime);

                $eventos[$cont]['fechaDay']     = $day;
                $eventos[$cont]['fechaMonth']   = $month;
                $eventos[$cont]['fechaYear']    = $year;
                $eventos[$cont]['fechaHour']    = $hour;

                $eventos[$cont]['imagen']       = get_field('pieza_grafica', $eventoID);

                $eventos[$cont]['fechaFilter']     = $day . '/' . $month . '/' . $year;

                $cont++;
            }
            
            return $eventos;
        }
        else
            return false;
    }

    public function ajax_calendar_events_user()
    {
        $userID = esc_attr($_POST["user"]);

        $eventos = $this->calendar_events_by_user($userID, false);

        if($eventos)
        {
            $result['type'] = 'success';
            $result['result'] = $eventos;

            if($eventos != false):
                ob_start();
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
                                    <button class="btn btn-primary p-1 my-1 boton_pagination_cursos button-borrar-evento" type="button" data-user="<?php echo $userID; ?>" data-event="<?php echo $evento['ID']; ?>">Borrar</button>
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
                $content = ob_get_clean();

                $result['content'] = $content;

            endif;
        }
        else
            $result['type'] = 'no-events';

        $result = json_encode($result);
        echo $result;
        wp_die();
    }

    public function ajax_calendar_asistir()
    {
        $eventID      = intval(esc_attr($_POST["eventID"]));
        $userID        = intval(esc_attr($_POST["userID"]));

        if($userID != 0)
        {
            $data = get_user_meta( $userID, 'user_eventos', true); 

            if($data)
            {
                $temp = explode(',', $data);

                if(!in_array($eventID, $temp))
                {
                    $data .= ',' . $eventID;

                    update_user_meta( $userID, 'user_eventos', $data );
                    $type = 'success';
                    $title = 'Gracias por registrarte en este evento';
                }
                else
                {
                    $type = 'info';
                    $title = 'Ya te habias registrado a este evento';
                }
            }
            else
            {
                $data = $eventID;

                add_user_meta( $userID, 'user_eventos', $data );
                $type = 'success';
                $title = 'Gracias por registrarte en este evento';
            }
        }
        else
        {
            $type = 'error';
            $title = 'Tienes que estar logeado para registrarte al evento';
        }

        $result['type'] = $type;
        $result['title'] = $title;

        $result = json_encode($result);
        echo $result;
        wp_die();
    }

    public function ajax_calendar_borrar()
    {
        $eventID      = intval(esc_attr($_POST["eventID"]));
        $userID        = intval(esc_attr($_POST["userID"]));

        if($userID != 0)
        {
            $data = get_user_meta( $userID, 'user_eventos', true); 

            if($data)
            {
                $temp = explode(',', $data);

                $pos = array_search($eventID, $temp);

                if($pos !== false)
                {
                    unset($temp[$pos]);

                    if(count($temp) == 0)
                        $dataSave = "";
                    else
                        $dataSave = implode(',', $temp);

                    update_user_meta( $userID, 'user_eventos',  $dataSave);

                    $type = 'info';
                    $title = 'El evento fue borrado de tu calendario';
                }
                else
                {
                    $type = 'error';
                    $title = 'No hay eventos a borrar';
                }
            }
            else
            {
                $type = 'error';
                $title = 'No hay eventos a borrar';
            }
        }
        else
        {
            $type = 'error';
            $title = 'Tienes que estar logeado para registrarte al evento';
        }

        $result['type'] = $type;
        $result['title'] = $title;
        $result['eventID'] = $eventID;
        $result['userID'] = $userID;

        $result = json_encode($result);
        echo $result;
        wp_die();
    }

    public function acf_calendario_field()
    {
        $id_home   = get_option('page_on_front');

        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63c815edd5cc3',
            'title' => 'Calendario',
            'fields' => array(
                array(
                    'key' => 'field_63c81784b3491',
                    'label' => 'Agregar calendario',
                    'name' => 'agregar_calendario',
                    'type' => 'button_group',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'si' => 'Si',
                        'no' => 'No',
                    ),
                    'allow_null' => 0,
                    'default_value' => 'no',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_63cfec21d6668',
                    'label' => 'Ancho contenedor',
                    'name' => 'ancho_contenedor_calendario',
                    'type' => 'select',
                    'instructions' => 'Selecciona el ancho del contenedor, si quieres agregar 2 bloques uno al lado del otro tienes que cambiar el ancho en cada bloque.<br><br>Recuerda que el tamaño de los 2 bloques debe sumar "100"',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63c81784b3491',
                                'operator' => '==',
                                'value' => 'si',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        100 => '100%',
                        90 => '90%',
                        80 => '80%',
                        70 => '70%',
                        60 => '60%',
                        50 => '50%',
                        40 => '40%',
                        30 => '30%',
                        20 => '20%',
                        10 => '10%',
                    ),
                    'default_value' => 100,
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_63d019691f672',
                    'label' => 'Utiliza filtros?',
                    'name' => 'utiliza_filtros_contenedor_calendario',
                    'type' => 'button_group',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63c81784b3491',
                                'operator' => '==',
                                'value' => 'si',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'si' => 'Si',
                        'no' => 'No',
                    ),
                    'allow_null' => 0,
                    'default_value' => 'no',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_63d017eda262c',
                    'label' => 'Tipos de filtros',
                    'name' => 'tipos_de_filtros_contenedor_calendario',
                    'type' => 'button_group',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63c81784b3491',
                                'operator' => '==',
                                'value' => 'si',
                            ),
                            array(
                                'field' => 'field_63d019691f672',
                                'operator' => '==',
                                'value' => 'si',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'selector' => 'Mostrar selector de filtros',
                        'automaticos' => 'Filtros automáticos',
                    ),
                    'allow_null' => 0,
                    'default_value' => '',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_63c8190ffd1a7',
                    'label' => 'Filtros',
                    'name' => 'filtros_contenedor_calendario',
                    'type' => 'taxonomy',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63c81784b3491',
                                'operator' => '==',
                                'value' => 'si',
                            ),
                            array(
                                'field' => 'field_63d019691f672',
                                'operator' => '==',
                                'value' => 'si',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'taxonomy' => 'seccion',
                    'field_type' => 'multi_select',
                    'allow_null' => 0,
                    'add_term' => 0,
                    'save_terms' => 0,
                    'load_terms' => 0,
                    'return_format' => 'id',
                    'multiple' => 0,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'secciones',
                    ),
                    array(
                        'param' => 'page_type',
                        'operator' => '!=',
                        'value' => 'parent',
                    ),
                    array(
                        'param' => 'post_template',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ),
                array(
                    array(
                        'param' => 'page',
                        'operator' => '==',
                        'value' => $id_home,
                    ),
                ),
                array(
                    array(
                        'param' => 'post_template',
                        'operator' => '==',
                        'value' => 'template-contactanos.php',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => array(
                1 => 'the_content',
                2 => 'excerpt',
                3 => 'discussion',
                4 => 'comments',
                5 => 'revisions',
                6 => 'slug',
                7 => 'author',
                8 => 'format',
                10 => 'featured_image',
                11 => 'categories',
                12 => 'tags',
                13 => 'send-trackbacks',
            ),
            'active' => true,
            'description' => '',
        ));

        endif;
    }
}