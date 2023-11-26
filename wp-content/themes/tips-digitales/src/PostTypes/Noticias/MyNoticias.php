<?php
if (!defined('ABSPATH')) { exit; }

class MyNoticias
{
    private $name       = 'Noticias';
    private $slug       = 'noticias';
    private $post_type  = 'noticias';

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
        add_action( 'init', [$this, 'acf_single_fields'] );
        add_action( 'init', [$this, 'acf_sidebar_fields'] );
    }

    public function init_filters()
    {
    }

    public function acf_single_fields()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63fe2d7604dab',
            'title' => 'Contenido listado de noticias',
            'fields' => array(
                array(
                    'key' => 'field_63fe2daf012cc',
                    'label' => 'Resumen',
                    'name' => 'resumen',
                    'type' => 'textarea',
                    'instructions' => 'Ingresa el texto que se mostrara en el listado de noticias, no debe ser mayor a 150 caracteres',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => 150,
                    'rows' => '',
                    'new_lines' => 'br',
                ),
                array(
                    'key' => 'field_63fe2e7c012cd',
                    'label' => 'Miniatura',
                    'name' => 'miniatura',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'return_format' => 'url',
                    'preview_size' => 'full',
                    'library' => 'uploadedTo',
                    'min_width' => 300,
                    'min_height' => 200,
                    'min_size' => '',
                    'max_width' => 300,
                    'max_height' => 200,
                    'max_size' => '',
                    'mime_types' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => array(
                0 => 'excerpt',
                1 => 'featured_image',
                2 => 'send-trackbacks',
            ),
            'active' => true,
            'description' => '',
        ));

        endif;
    }

    public function acf_sidebar_fields()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_6400dcbc2ab3d',
            'title' => 'Sidebar Settings',
            'fields' => array(
                array(
                    'key' => 'field_6400dfd290498',
                    'label' => 'Contenedor periódico',
                    'name' => '',
                    'type' => 'accordion',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_6400dd1f4c220',
                    'label' => 'Titulo contenedor',
                    'name' => 'titulo_contenedor_periodico',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
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
                    'key' => 'field_6400e2120cf3b',
                    'label' => 'Quiero publicar',
                    'name' => 'quiero_publicar',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_6400ec920cf3c',
                            'label' => 'Titulo',
                            'name' => 'titulo',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'relevanssi_exclude' => 0,
                            'default_value' => 'Quiero publicar',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_6400eca50cf3d',
                            'label' => 'Link',
                            'name' => 'link',
                            'type' => 'page_link',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'relevanssi_exclude' => 0,
                            'post_type' => '',
                            'taxonomy' => '',
                            'allow_null' => 0,
                            'allow_archives' => 1,
                            'multiple' => 0,
                        ),
                    ),
                ),
                array(
                    'key' => 'field_6400eef1513fa',
                    'label' => 'Biblioteca TIPS',
                    'name' => 'biblioteca_tips',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_6400eef1513fb',
                            'label' => 'Titulo',
                            'name' => 'titulo',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'relevanssi_exclude' => 0,
                            'default_value' => 'Biblioteca TIPS',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_6400eef1513fc',
                            'label' => 'Link',
                            'name' => 'link',
                            'type' => 'page_link',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'relevanssi_exclude' => 0,
                            'post_type' => '',
                            'taxonomy' => '',
                            'allow_null' => 0,
                            'allow_archives' => 1,
                            'multiple' => 0,
                        ),
                    ),
                ),
                array(
                    'key' => 'field_6400ef05513fd',
                    'label' => 'Comité editorial',
                    'name' => 'comite_editorial',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_6400ef05513fe',
                            'label' => 'Titulo',
                            'name' => 'titulo',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'relevanssi_exclude' => 0,
                            'default_value' => 'Comité editorial',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_6400ef05513ff',
                            'label' => 'Link',
                            'name' => 'link',
                            'type' => 'page_link',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'relevanssi_exclude' => 0,
                            'post_type' => '',
                            'taxonomy' => '',
                            'allow_null' => 0,
                            'allow_archives' => 1,
                            'multiple' => 0,
                        ),
                    ),
                ),
                array(
                    'key' => 'field_6400dfee90499',
                    'label' => 'Contenedor otras noticias',
                    'name' => '',
                    'type' => 'accordion',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_6400dd534c221',
                    'label' => 'Titulo contenedor',
                    'name' => 'titulo_contenedor_noticias_relacionadas',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
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
                    'key' => 'field_6400de331df35',
                    'label' => 'Cantidad noticias a mostrar',
                    'name' => 'cant_noticias',
                    'type' => 'number',
                    'instructions' => 'Cantidad de noicias que se van a mostrar en el bloque de "Otras noticias"',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'default_value' => 10,
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
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options-sidebar',
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