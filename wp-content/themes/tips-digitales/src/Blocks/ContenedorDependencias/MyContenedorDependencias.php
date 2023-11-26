<?php

if (!defined('ABSPATH')) { exit; }

class MyContenedorDependencias
{
    private $name       = 'Dependencias';
    private $slug       = 'Dependencias';
    private $post_type  = 'Dependencias';

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
        add_action( 'init', [$this, 'acf_dependencias_field'] );
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

    public function acf_dependencias_field()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63bdbf56ed25d',
            'title' => 'Conoce al equipo',
            'fields' => array(
                array(
                    'key' => 'field_63bdbf9061a5a',
                    'label' => 'Agregar equipo',
                    'name' => 'agregar_equipo',
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
                    'key' => 'field_63bdbf9061b6b',
                    'label' => 'Ancho contenedor',
                    'name' => 'ancho_contenedor_dependencias',
                    'type' => 'select',
                    'instructions' => 'Selecciona el ancho del contenedor, si quieres agregar 2 bloques uno al lado del otro tienes que cambiar el ancho en cada bloque.<br><br>Recuerda que el tamaño de los 2 bloques debe sumar "100"',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63bdbf9061a5a',
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
                        '100' => '100%',
                        '90' => '90%',
                        '80' => '80%',
                        '70' => '70%',
                        '60' => '60%',
                        '50' => '50%',
                        '40' => '40%',
                        '30' => '30%',
                        '20' => '20%',
                        '10' => '10%',
                    ),
                    'default_value' => '100',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_63bdbfba61a5b',
                    'label' => 'Equipos',
                    'name' => 'equipos',
                    'type' => 'flexible_content',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63bdbf9061a5a',
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
                    'layouts' => array(
                        'layout_63bdc323340df' => array(
                            'key' => 'layout_63bdc323340df',
                            'name' => 'equipo',
                            'label' => 'Equipo',
                            'display' => 'block',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_63bdc33461a5d',
                                    'label' => 'Nombre del equipo',
                                    'name' => 'nombre_del_equipo',
                                    'type' => 'text',
                                    'instructions' => '',
                                    'required' => 1,
                                    'conditional_logic' => 0,
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
                                    'key' => 'field_63bdc33d61a5e',
                                    'label' => 'Dependencias',
                                    'name' => 'dependencias',
                                    'type' => 'repeater',
                                    'instructions' => '',
                                    'required' => 1,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'collapsed' => 'field_63bdc3ae61a5f',
                                    'min' => 0,
                                    'max' => 0,
                                    'layout' => 'block',
                                    'button_label' => 'Agregar dependencia',
                                    'sub_fields' => array(
                                        array(
                                            'key' => 'field_63bdc3ae61a5f',
                                            'label' => 'Nombre de la dependencia',
                                            'name' => 'nombre_de_la_dependencia',
                                            'type' => 'text',
                                            'instructions' => '',
                                            'required' => 1,
                                            'conditional_logic' => 0,
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
                                            'key' => 'field_63c2aafc0b0b3',
                                            'label' => 'Tipo de la dependencia',
                                            'name' => 'tipo_de_la_dependencia',
                                            'type' => 'button_group',
                                            'instructions' => 'Tipo A para dependencias Gerenciales o Lideres, Tipo B para las demás dependencias',
                                            'required' => 1,
                                            'conditional_logic' => 0,
                                            'wrapper' => array(
                                                'width' => '',
                                                'class' => '',
                                                'id' => '',
                                            ),
                                            'choices' => array(
                                                'tipoA' => 'Tipo A',
                                                'tipoB' => 'Tipo B',
                                            ),
                                            'allow_null' => 0,
                                            'default_value' => 'tipo',
                                            'layout' => 'horizontal',
                                            'return_format' => 'value',
                                        ),
                                        array(
                                            'key' => 'field_63c2ab860b0b4',
                                            'label' => 'Participantes',
                                            'name' => 'participantes',
                                            'type' => 'repeater',
                                            'instructions' => '',
                                            'required' => 1,
                                            'conditional_logic' => 0,
                                            'wrapper' => array(
                                                'width' => '',
                                                'class' => '',
                                                'id' => '',
                                            ),
                                            'collapsed' => 'field_63c2ac680b0b5',
                                            'min' => 0,
                                            'max' => 0,
                                            'layout' => 'block',
                                            'button_label' => 'Agregar Participante',
                                            'sub_fields' => array(
                                                array(
                                                    'key' => 'field_63c2ac680b0b5',
                                                    'label' => 'Nombre',
                                                    'name' => 'nombre',
                                                    'type' => 'text',
                                                    'instructions' => '',
                                                    'required' => 1,
                                                    'conditional_logic' => 0,
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
                                                    'key' => 'field_63c2ac8c0b0b6',
                                                    'label' => 'Cargo',
                                                    'name' => 'cargo',
                                                    'type' => 'text',
                                                    'instructions' => '',
                                                    'required' => 1,
                                                    'conditional_logic' => 0,
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
                                                    'key' => 'field_63c2ac950b0b7',
                                                    'label' => 'Correo',
                                                    'name' => 'correo',
                                                    'type' => 'email',
                                                    'instructions' => '',
                                                    'required' => 1,
                                                    'conditional_logic' => 0,
                                                    'wrapper' => array(
                                                        'width' => '',
                                                        'class' => '',
                                                        'id' => '',
                                                    ),
                                                    'default_value' => '',
                                                    'placeholder' => '',
                                                    'prepend' => '',
                                                    'append' => '',
                                                ),
                                                array(
                                                    'key' => 'field_63c2aca50b0b8',
                                                    'label' => 'Foto',
                                                    'name' => 'foto',
                                                    'type' => 'image',
                                                    'instructions' => '',
                                                    'required' => 0,
                                                    'conditional_logic' => array(
                                                        array(
                                                            array(
                                                                'field' => 'field_63c2aafc0b0b3',
                                                                'operator' => '==',
                                                                'value' => 'tipoA',
                                                            ),
                                                        ),
                                                    ),
                                                    'wrapper' => array(
                                                        'width' => '',
                                                        'class' => '',
                                                        'id' => '',
                                                    ),
                                                    'return_format' => 'url',
                                                    'preview_size' => 'medium',
                                                    'library' => 'uploadedTo',
                                                    'min_width' => '',
                                                    'min_height' => '',
                                                    'min_size' => '',
                                                    'max_width' => '',
                                                    'max_height' => '',
                                                    'max_size' => '',
                                                    'mime_types' => '',
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            'min' => '',
                            'max' => '',
                        ),
                    ),
                    'button_label' => 'Agregar Equipo',
                    'min' => '',
                    'max' => '',
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