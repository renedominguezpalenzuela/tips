<?php

if (!defined('ABSPATH')) { exit; }

class MyContenedorEncuesta
{
    private $name       = 'Encuesta';
    private $slug       = 'encuesta';
    private $post_type  = 'encuesta';

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
        add_action( 'init', [$this, 'acf_encuesta_field'] );
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

    public function acf_encuesta_field()
    {
        $id_home   = get_option('page_on_front');

        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_640f9b93f1b29',
            'title' => 'Encuesta',
            'fields' => array(
                array(
                    'key' => 'field_640f9bdf75441',
                    'label' => 'Agregar encuesta?',
                    'name' => 'agregar_encuesta',
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
                    'key' => 'field_640f9bdf86552',
                    'label' => 'Ancho contenedor',
                    'name' => 'ancho_contenedor_encuesta',
                    'type' => 'select',
                    'instructions' => 'Selecciona el ancho del contenedor, si quieres agregar 2 bloques uno al lado del otro tienes que cambiar el ancho en cada bloque.<br><br>Recuerda que el tamaño de los 2 bloques debe sumar "100"',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_640f9bdf75441',
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
                    'key' => 'field_640f9c3d75442',
                    'label' => 'Tipo de encuesta',
                    'name' => 'tipo_de_encuesta',
                    'type' => 'button_group',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_640f9bdf75441',
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
                        'vertical' => 'Vertical',
                        'horizontal' => 'Horizontal',
                    ),
                    'allow_null' => 0,
                    'default_value' => 'vertical',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_640f9c7975443',
                    'label' => 'Encuesta ID',
                    'name' => 'encuesta_id',
                    'type' => 'number',
                    'instructions' => 'Ingresa el ID de la encuesta que quieres mostrar, el ID lo puedes ver en la sección donde se crean las encuestas',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_640f9bdf75441',
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
                    'min' => '',
                    'max' => '',
                    'step' => '',
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

        endif;
    }

}