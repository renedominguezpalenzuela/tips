<?php

if (!defined('ABSPATH')) { exit; }

class MyContenedorMapa
{
    private $name       = 'Mapa';
    private $slug       = 'Mapa';
    private $post_type  = 'Mapa';

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
        add_action( 'init', [$this, 'acf_mapa_field'] );

        add_action('wp_ajax_ajax_mapa_general', array($this, 'ajax_mapa_general'));
        add_action('wp_ajax_nopriv_ajax_mapa_general', array($this, 'ajax_mapa_general'));
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

    public function ajax_mapa_general()
    {
        $pageID = esc_attr($_POST["pageID"]);
        $type = esc_attr($_POST["type"]);

        if($type != 'otro')
        {
            $dataMap = $this->get_mapa_csv($pageID);

            if ($dataMap != false)
            {
                $result['type'] = 'success';
                $result['result'] = $dataMap;
            }
            else
            {
                $result['type'] = 'error';
                fclose($handle);
            }

            $result['Logo'] = get_template_directory_uri() . '/public/images/logo.png';
        }
        else
        {
            $postType = get_field('elementos_a_mostrar_en_el_mapa', $pageID);

            $myPosts = get_posts([
                'post_type' => $postType,
                'post_status' => 'publish',
                'numberposts' => -1,
                'orderby' => 'name',
                'order' => 'ASC'
            ]);

            if( $myPosts )
            {
                $object = array();
                $cont = 0;
                foreach ($myPosts as $myPost)
                {
                    $object[$cont]['Tipo'] = $postType;

                    $object[$cont]['Nombre'] = get_the_title($myPost);

                    $object[$cont]['Descripcion'] = get_field('descripcion', $myPost);

                    $object[$cont]['Ingresar'] = get_field('como_hacer_parte', $myPost);

                    $object[$cont]['Localidad'] = get_field('localidad', $myPost)->name;

                    $object[$cont]['Position']= get_field('posicion_en_el_mapa', $myPost);

//Formulario contactar asociacion
                    $userEncargadoID = get_field('usuario_encargado', $myPost);

                    $subject = 'Contactar con: ' . $object[$cont]['Nombre'];
                    $message = '';

                    $fastStart = false;
                    $scrollToContainer = true;

                    if($userEncargadoID)
                        $urlContacto = Better_Messages()->functions->create_conversation_link( $userEncargadoID, $subject, $message, $fastStart, $scrollToContainer );
                    else
                        $urlContacto = '';

                    $object[$cont]['UrlContactar'] = $urlContacto;

                    if( have_rows('personas', $myPost) )
                    {
                        $personas = array();
                        $contP = 0;
                        while ( have_rows('personas', $myPost) )
                        {
                            the_row();

                            $personas[$contP]['Nombre'] = get_sub_field('nombre', $myPost); 
                            $personas[$contP]['Telefono'] = get_sub_field('telefono', $myPost); 
                            $personas[$contP]['Email'] = get_sub_field('email', $myPost); 

                            $foto = get_sub_field('foto', $myPost); 

                            if($foto == '')
                            {
                                $foto = array();

                                $foto['sizes']['thumbnail'] = get_template_directory_uri().'/public/images/slider-personas-small.png';

                                $foto['sizes']['medium_carrusel'] = get_template_directory_uri().'/public/images/slider-personas-big.png';

                            }

                            $personas[$contP]['Foto'] = $foto;
                            $contP++;
                        }

                        $object[$cont]['Personas'] = $personas;
                    }

                    if( have_rows('informes', $myPost) )
                    {
                        $informes = array();
                        $contI = 0;

                        while ( have_rows('informes', $myPost) )
                        {
                            the_row();

                            $informes[$contI]['Nombre'] = get_sub_field('nombre', $myPost); 
                            $informes[$contI]['Archivo'] = get_sub_field('archivo', $myPost); 

                            $contI++;
                        }

                        $object[$cont]['Informes'] = $informes;
                    }
                    else
                        $object[$cont]['Informes'] = false;

                    $cont++;
                }

                $result['type'] = 'success';
                $result['result'] = $object;
                $result['BibliotecaURL'] = get_field('pagina_destino', $pageID);
            }
        }

        if(get_field('agregar_marcadores_por_localidad', $pageID) == 'si')
        {
            if( have_rows('marcadores', $pageID) )
            {
                $markers = [];

                $cont = 0;
                while ( have_rows('marcadores', $pageID) )
                {
                    the_row();
                    $localidad = get_sub_field('localidad', $pageID);

                    $markers[$cont]['nombre'] = $localidad->name;
                    $markers[$cont]['marcador'] = get_sub_field('marcador', $pageID);

                    $cont++;
                }

                $result['markers'] = $markers;
            }
            else
                $result['markers'] = 'false';
        }
        else
        {
            $result['markers'] = get_template_directory_uri() . '/public/images/markers/default.png';
        }         

        $result = json_encode($result);
        echo $result;
        wp_die();
    }

    public function get_mapa_csv($pageID)
    {
        $fileURL = get_field('ubicaciones_general', $pageID);

        $assoc_array = [];
        $handle = fopen($fileURL, "r");

        if ($handle !== false)
        {
            if (($data = fgetcsv($handle, 0, ";")) !== false)
            {
                $data = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data);

                $keys = $data;
            }

            $cont = 0;

            while (($data = fgetcsv($handle, 0, ";")) !== false)
            {
                $assoc_array[] = array_combine($keys, $data);

                $cont++;
            }

            fclose($handle);

            return $assoc_array;
        }
        else
            return false;
    }

    //Retorna las localidades para el mapa de tipo 'OTROS'
    public function get_data_map($pageID)
    {
        $postType = get_field('elementos_a_mostrar_en_el_mapa', $pageID);

        $myPosts = get_posts([
            'post_type' => $postType,
            'post_status' => 'publish',
            'numberposts' => -1,
            'orderby' => 'name',
            'order' => 'ASC'
        ]);

        if( $myPosts )
        {
            $object = array();
            $cont = 0;
            foreach ($myPosts as $myPost)
            {
                $object[$cont]['Nombre'] = get_the_title($myPost);

                $object[$cont]['Localidad'] = get_field('localidad', $myPost)->name;
                $cont++;
            }
        }
        else
            $object = false;

        return $object;
    }

    //Retorna los datos del mapa tipo OTROS
    public function get_data_map_by_ID($postID, $postType)
    {
        $myPosts = get_posts([
            'post_type' => $postType,
            'post_status' => 'publish',
            'numberposts' => 1,
            'orderby' => 'name',
            'order' => 'ASC',
            'p'     => $postID
        ]);

        if( $myPosts )
        {
            $object = array();
            foreach ($myPosts as $myPost)
            {
                $object['Tipo'] = $postType;

                $object['Nombre'] = get_the_title($myPost);

                $object['Descripcion'] = get_field('descripcion', $myPost);

                $object['Ingresar'] = get_field('como_hacer_parte', $myPost);

                $object['Localidad'] = get_field('localidad', $myPost)->name;

                $object['Position'] = get_field('posicion_en_el_mapa', $myPost);

                if( have_rows('personas', $myPost) )
                {
                    $personas = array();
                    $contP = 0;
                    while ( have_rows('personas', $myPost) )
                    {
                        the_row();

                        $personas[$contP]['Nombre'] = get_sub_field('nombre', $myPost); 
                        $personas[$contP]['Telefono'] = get_sub_field('telefono', $myPost); 
                        $personas[$contP]['Email'] = get_sub_field('email', $myPost); 

                        $foto = get_sub_field('foto', $myPost); 

                        if($foto == '')
                        {
                            $foto = array();

                            $foto['sizes']['thumbnail'] = get_template_directory_uri().'/public/images/slider-personas-small.png';

                            $foto['sizes']['medium_carrusel'] = get_template_directory_uri().'/public/images/slider-personas-big.png';

                        }

                        $personas[$contP]['Foto'] = $foto;
                        $contP++;
                    }

                    $object['Personas'] = $personas;
                }

                if( have_rows('informes', $myPost) )
                {
                    $informes = array();
                    $contI = 0;

                    while ( have_rows('informes', $myPost) )
                    {
                        the_row();

                        $informes[$contI]['Nombre'] = get_sub_field('nombre', $myPost); 
                        $informes[$contI]['Archivo'] = get_sub_field('archivo', $myPost); 

                        $contI++;
                    }

                    $object['Informes'] = $informes;
                }
                else
                    $object['Informes'] = false;
            }
        }
        else
            $object = false;

        return $object;
    }

    public function acf_mapa_field()
    {
        $id_home   = get_option('page_on_front');

            acf_add_local_field_group(array(
                'key' => 'group_63e2af30c9e4a',
                'title' => 'Mapa',
                'fields' => array(
                    array(
                        'key' => 'field_63e2af565a2c3',
                        'label' => 'Agregar Mapa?',
                        'name' => 'agregar_mapa',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'relevanssi_exclude' => 0,
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
                        'key' => 'field_63e2b53af1e10',
                        'label' => 'Tipo de mapa',
                        'name' => 'tipo_de_mapa',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
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
                        'relevanssi_exclude' => 0,
                        'choices' => array(
                            'general' => 'Mapa General',
                            'iniciativas' => 'Mapa Banco de Iniciativas',
                            'otro' => 'Mapa Asociación de usuarios, COOPACOS o Veedurias',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'general',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),

                    array(
                        'key' => 'field_63e2b53aa2f21',
                        'label' => 'Descripción del mapa',
                        'name' => 'desripcion_mapa',
                        'type' => 'text',
                        'instructions' => 'Esta descripción es la que aparecera en el mapa del HOME',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
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
                        'relevanssi_exclude' => 0,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),

                    array(
                        'key' => 'field_63f7979b04d3c',
                        'label' => 'Elementos a mostrar en el mapa',
                        'name' => 'elementos_a_mostrar_en_el_mapa',
                        'type' => 'button_group',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
                                    'operator' => '==',
                                    'value' => 'si',
                                ),
                                array(
                                    'field' => 'field_63e2b53af1e10',
                                    'operator' => '==',
                                    'value' => 'otro',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'relevanssi_exclude' => 0,
                        'choices' => array(
                            'asociaciones' => 'Asociaciones',
                            'copacos' => 'COPACOS',
                            'veedurias' => 'Veedurías',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'asociaciones',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),

                    array(
                        'key' => 'field_63d069623adb6',
                        'label' => 'Formulario de contacto',
                        'name' => 'formulario_contacto',
                        'type' => 'acf_cf7',
                        'instructions' => 'Selecciona el formulario a mostrar',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
                                    'operator' => '==',
                                    'value' => 'si',
                                ),
                                array(
                                    'field' => 'field_63e2b53af1e10',
                                    'operator' => '!=',
                                    'value' => 'general',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_63e2b5ecf1e11',
                        'label' => 'Ubicaciones',
                        'name' => 'ubicaciones_general',
                        'type' => 'file',
                        'instructions' => 'Selecciona el archivo CSV con las ubicaciones para el mapa, recuerda que existen varios archivos con ubicaciones cada uno depende del tipo de mapa seleccionado',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
                                    'operator' => '==',
                                    'value' => 'si',
                                ),
                                array(
                                    'field' => 'field_63e2b53af1e10',
                                    'operator' => '!=',
                                    'value' => 'otro',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'relevanssi_exclude' => 1,
                        'return_format' => 'url',
                        'library' => 'all',
                        'min_size' => '',
                        'max_size' => '',
                        'mime_types' => 'csv',
                    ),

                    array(
                        'key' => 'field_638e708465432',
                        'label' => 'Página Biblioteca Tips',
                        'name' => 'pagina_destino',
                        'type' => 'page_link',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
                                    'operator' => '==',
                                    'value' => 'si',
                                ),
                                array(
                                    'field' => 'field_63e2b53af1e10',
                                    'operator' => '==',
                                    'value' => 'otro',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => array(
                            0 => 'secciones',
                            1 => 'cursos',
                            2 => 'page',
                        ),
                        'taxonomy' => '',
                        'allow_null' => 0,
                        'allow_archives' => 0,
                        'multiple' => 0,
                    ),

                    array(
                        'key' => 'field_63e41e522c9fc',
                        'label' => 'Etiquetas "Qué deseas buscar"',
                        'name' => 'etiquetas_mapa',
                        'type' => 'taxonomy',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
                                    'operator' => '==',
                                    'value' => 'si',
                                ),
                                array(
                                    'field' => 'field_63e2b53af1e10',
                                    'operator' => '==',
                                    'value' => 'general',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'relevanssi_exclude' => 0,
                        'taxonomy' => 'tipo',
                        'field_type' => 'multi_select',
                        'allow_null' => 0,
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                    ),
                    array(
                        'key' => 'field_63e41e522d0ad',
                        'label' => 'Tematica',
                        'name' => 'tematica_mapa_iniciativas',
                        'type' => 'taxonomy',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
                                    'operator' => '==',
                                    'value' => 'si',
                                ),
                                array(
                                    'field' => 'field_63e2b53af1e10',
                                    'operator' => '==',
                                    'value' => 'iniciativas',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'relevanssi_exclude' => 0,
                        'taxonomy' => 'tematicas',
                        'field_type' => 'multi_select',
                        'allow_null' => 0,
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                    ),
                    array(
                        'key' => 'field_63e41e522e0ad',
                        'label' => 'Grupo Poblacional',
                        'name' => 'grupo_poblacional_mapa_iniciativas',
                        'type' => 'taxonomy',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
                                    'operator' => '==',
                                    'value' => 'si',
                                ),
                                array(
                                    'field' => 'field_63e2b53af1e10',
                                    'operator' => '==',
                                    'value' => 'iniciativas',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'relevanssi_exclude' => 0,
                        'taxonomy' => 'grupo-poblacional',
                        'field_type' => 'multi_select',
                        'allow_null' => 0,
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                    ),

                    array(
                        'key' => 'field_63cd5b151b76d',
                        'label' => 'Nombre del filtro',
                        'name' => 'nombre_filtro',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
                                    'operator' => '==',
                                    'value' => 'si',
                                ),
                                array(
                                    'field' => 'field_63e2b53af1e10',
                                    'operator' => '==',
                                    'value' => 'otro',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),

                    array(
                        'key' => 'field_63e425729595f',
                        'label' => 'Seleccionar todas las localidades automaticamente',
                        'name' => 'agregar_todas_localidades',
                        'type' => 'button_group',
                        'instructions' => 'Selecciona "Si" para agregar todas las localidades automaticamente en el filtro de localidades y "No" si quieres agregar localidades especificas',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
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
                        'relevanssi_exclude' => 0,
                        'choices' => array(
                            'si' => 'SI',
                            'no' => 'No',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'si',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_63e425729584e',
                        'label' => 'Localidades',
                        'name' => 'localidades_mapa',
                        'type' => 'taxonomy',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
                                    'operator' => '==',
                                    'value' => 'si',
                                ),
                                array(
                                    'field' => 'field_63e425729595f',
                                    'operator' => '==',
                                    'value' => 'no',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'relevanssi_exclude' => 0,
                        'taxonomy' => 'localidades',
                        'field_type' => 'multi_select',
                        'allow_null' => 0,
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'object',
                        'multiple' => 0,
                    ),
                    array(
                        'key' => 'field_63ebc7583a9d3',
                        'label' => 'Agregar marcadores por localidad',
                        'name' => 'agregar_marcadores_por_localidad',
                        'type' => 'button_group',
                        'instructions' => 'Selecciona "Si" para agregar un marcador diferente para cada localidad y "No" si quieres utilizar el marcador por defecto para todos los puntos',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63e2af565a2c3',
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
                        'relevanssi_exclude' => 0,
                        'choices' => array(
                            'si' => 'SI',
                            'no' => 'No',
                        ),
                        'allow_null' => 0,
                        'default_value' => 'no',
                        'layout' => 'horizontal',
                        'return_format' => 'value',
                    ),
                    array(
                        'key' => 'field_63ebc7e63a9d4',
                        'label' => 'Marcadores',
                        'name' => 'marcadores',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63ebc7583a9d3',
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
                        'relevanssi_exclude' => 0,
                        'collapsed' => '',
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'table',
                        'button_label' => '',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_63ebc7ff3a9d5',
                                'label' => 'Localidad',
                                'name' => 'localidad',
                                'type' => 'taxonomy',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'relevanssi_exclude' => 0,
                                'taxonomy' => 'localidades',
                                'field_type' => 'select',
                                'allow_null' => 0,
                                'add_term' => 0,
                                'save_terms' => 0,
                                'load_terms' => 0,
                                'return_format' => 'object',
                                'multiple' => 0,
                            ),
                            array(
                                'key' => 'field_63ebcb093a9d6',
                                'label' => 'Marcador',
                                'name' => 'marcador',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'relevanssi_exclude' => 0,
                                'return_format' => 'url',
                                'preview_size' => 'full',
                                'library' => 'all',
                                'min_width' => 32,
                                'min_height' => 32,
                                'min_size' => '',
                                'max_width' => 64,
                                'max_height' => 64,
                                'max_size' => '',
                                'mime_types' => 'png',
                            ),
                        ),
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
                            'operator' => '!=',
                            'value' => 'default',
                        ),
                        array(
                            'param' => 'post_template',
                            'operator' => '!=',
                            'value' => 'template-participacion-al-dia.php',
                        ),
                        array(
                            'param' => 'post_template',
                            'operator' => '!=',
                            'value' => 'template-contactanos.php',
                        ),
                    ),
                    array(
                        array(
                            'param' => 'page',
                            'operator' => '==',
                            'value' => $id_home,
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));

    }
}