<?php
if (!defined('ABSPATH')) { exit; }

class MyContenedorMultimedia
{
    private $name       = 'ModalMultimedia';
    private $slug       = 'modal-multimedia';

    public function __construct()
    {
    }

    public function init()
    {
        $this->init_actions();
        $this->acf_fields_theme();
    }

    public function init_actions()
    {
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_slug()
    {
        return $this->slug;
    }

    public function acf_fields_theme()
    {
        if( function_exists('acf_add_local_field_group') ):

            acf_add_local_field_group(array(
                'key' => 'group_6384b7c8eeee8',
                'title' => 'Contenedor Múltimedia',
                'fields' => array(
                    array(
                        'key' => 'field_6384b970525b0',
                        'label' => '',
                        'name' => 'grupo_multimedia',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'row',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_6384b7d2ca028',
                                'label' => 'Mostrar contenedor',
                                'name' => 'mostrar_contenedor',
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
                                'default_value' => '',
                                'layout' => 'horizontal',
                                'return_format' => 'value',
                            ),
                            array(
                                'key' => 'field_6384bd19f55ae',
                                'label' => 'Titulo',
                                'name' => 'titulo',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_6384b7d2ca028',
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
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_6384bd2ef55af',
                                'label' => 'Descripción',
                                'name' => 'descripcion',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_6384b7d2ca028',
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
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_638e111845851',
                                'label' => 'Insertar video de Youtube?',
                                'name' => 'insertar_video_de_youtube',
                                'type' => 'button_group',
                                'instructions' => 'Selecciona "Si" para insertar un video de Youtube',
                                'required' => 1,
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_6384b7d2ca028',
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
                                'key' => 'field_6384ba598ef09',
                                'label' => 'URL Video de Youtube',
                                'name' => 'contenedor_youtube',
                                'type' => 'oembed',
                                'instructions' => 'Ingresa la URL del video de Youtube',
                                'required' => 1,
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_638e111845851',
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
                                'width' => '',
                                'height' => 300,
                            ),
                            array(
                                'key' => 'field_6382228d445853',
                                'label' => 'Subir video',
                                'name' => 'subir_video',
                                'type' => 'file',
                                'instructions' => 'Seleccione el video a subir',
                                'required' => 1,
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_638e111845851',
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
                                'return_format' => 'url',
                                'library' => 'uploadedTo',
                                'min_size' => '',
                                'max_size' => '',
                                'mime_types' => 'mp4,mpeg4,mpeg,mpg',
                            ),
                            array(
                                'key' => 'field_6382228d456954',
                                'label' => 'Poster video',
                                'name' => 'video_poster',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_638e111845851',
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
                    array(
                        'key' => 'field_6384bdbcf55b1',
                        'label' => 'Contenedor botones',
                        'name' => 'contenedor_botones',
                        'type' => 'flexible_content',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_6384b7d2ca028',
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
                            'layout_6384bdceb8ae5' => array(
                                'key' => 'layout_6384bdceb8ae5',
                                'name' => 'boton_si',
                                'label' => 'Botón SI',
                                'display' => 'block',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_6384bdf4f55b2',
                                        'label' => 'Titulo Botón',
                                        'name' => 'titulo_boton',
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
                                        'key' => 'field_6384be02f55b3',
                                        'label' => 'Acción',
                                        'name' => 'accion',
                                        'type' => 'text',
                                        'instructions' => '',
                                        'required' => 0,
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
                                ),
                                'min' => '',
                                'max' => '',
                            ),
                            'layout_6384be9a653de' => array(
                                'key' => 'layout_6384be9a653de',
                                'name' => 'boton_no',
                                'label' => 'Botón No',
                                'display' => 'block',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_6384be9a653df',
                                        'label' => 'Titulo Botón',
                                        'name' => 'titulo_boton',
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
                                        'key' => 'field_6384be9a653e0',
                                        'label' => 'Acción',
                                        'name' => 'accion',
                                        'type' => 'text',
                                        'instructions' => '',
                                        'required' => 0,
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
                                ),
                                'min' => '',
                                'max' => '',
                            ),
                        ),
                        'button_label' => 'Agregar Botón',
                        'min' => 0,
                        'max' => 2,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'theme-general-settings',
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