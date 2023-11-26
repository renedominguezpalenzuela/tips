<?php

if (!defined('ABSPATH')) { exit; }

class MyHerramientas
{
    private $name       = 'Herramientas';
    private $slug       = 'herramientas';
    private $post_type  = 'herramientas';

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
        add_action( 'init', [$this, 'acf_fields'] );
        add_action( 'init', [$this, 'add_post_type'] );
    }

    public function init_filters()
    {
    }

    public function add_post_type()
    {
        $labels = array(
            'name'                  => $this->name,
            'singular_name'         => __('Herramientas', APP_TEXTDOMAIN),
            'menu_name'             => __('Mis Herramientas', APP_TEXTDOMAIN),
            'name_admin_bar'        => __('Herramientas', APP_TEXTDOMAIN),
            'archives'              => __('Herramientas archive', APP_TEXTDOMAIN),
            'attributes'            => __('Herramientas attributes', APP_TEXTDOMAIN),
            'parent_item_colon'     => __('Parent Herramientas:', APP_TEXTDOMAIN),
            'all_items'             => __('All Herramientas', APP_TEXTDOMAIN),
            'add_new_item'          => __('Add new Herramientas', APP_TEXTDOMAIN),
            'add_new'               => __('Add New', APP_TEXTDOMAIN),
            'new_item'              => __('New Herramienta', APP_TEXTDOMAIN),
            'edit_item'             => __('Edit Herramienta', APP_TEXTDOMAIN),
            'update_item'           => __('Update Herramienta', APP_TEXTDOMAIN),
            'view_item'             => __('View Herramienta', APP_TEXTDOMAIN),
            'view_items'            => __('View Herramientas', APP_TEXTDOMAIN),
            'search_items'          => __('Search Herramientas', APP_TEXTDOMAIN),
            'not_found'             => __('No Herramientas found', APP_TEXTDOMAIN),
            'not_found_in_trash'    => __('No Herramientas found in trash', APP_TEXTDOMAIN),
            'featured_image'        => __('Featured image', APP_TEXTDOMAIN),
            'set_featured_image'    => __('Set featured image', APP_TEXTDOMAIN),
            'remove_featured_image' => __('Remove featured image', APP_TEXTDOMAIN),
            'use_featured_image'    => __('Use as featured image', APP_TEXTDOMAIN),
            'insert_into_item'      => __('Insert into Herramientas', APP_TEXTDOMAIN),
            'uploaded_to_this_item' => __('Upload to this Herramienta', APP_TEXTDOMAIN),
            'items_list'            => __('Herramientas list', APP_TEXTDOMAIN),
            'items_list_navigation' => __('Herramientas list navigation', APP_TEXTDOMAIN),
            'filter_items_list'     => __('Filter Herramientas list', APP_TEXTDOMAIN),
        );
        $args = array(
            'label'                 => $this->name,
            'description'           => $this->name,
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'custom-fields'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 11,
            'menu_icon'             => 'dashicons-admin-tools',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'query_var'             => true,
            "has_archive"           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => false,
            'show_in_rest'          => false,
            'rewrite'               => array('slug' => $this->slug, 'with_front' => true),
            'capability_type'       => 'post',
        );

        register_post_type($this->post_type, $args);
    }

    public function acf_fields()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63d58b957dbc2',
            'title' => 'Herramientas',
            'fields' => array(
                array(
                    'key' => 'field_63d594f18af90',
                    'label' => 'Descripción',
                    'name' => 'descripcion',
                    'type' => 'textarea',
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
                    'key' => 'field_63d5951d8af91',
                    'label' => 'Icono',
                    'name' => 'icono',
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
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '170',
                    'max_height' => '170',
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_63d83104d3c2a',
                    'label' => 'Tipo de Archivo',
                    'name' => 'archivo',
                    'type' => 'select',
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
                        'pdf' => 'PDF',
                        'imagen' => 'Imagen',
                        'video' => 'Video',
                        'audio' => 'Audio',
                    ),
                    'default_value' => 'pdf',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_63d8319dd3c2b',
                    'label' => 'PDF',
                    'name' => 'pdf',
                    'type' => 'file',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d83104d3c2a',
                                'operator' => '==',
                                'value' => 'pdf',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'return_format' => 'url',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                    'mime_types' => 'pdf',
                ),
                array(
                    'key' => 'field_63d83b2be4c62',
                    'label' => 'Caratula',
                    'name' => 'caratula',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d83104d3c2a',
                                'operator' => '==',
                                'value' => 'audio',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'return_format' => 'url',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_63d831b9d3c2c',
                    'label' => 'Audio',
                    'name' => 'audio',
                    'type' => 'audio_video_player',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d83104d3c2a',
                                'operator' => '==',
                                'value' => 'audio',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'general_type' => 'audio',
                    'mime_types' => '',
                    'return_format' => 'url',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                ),
                array(
                    'key' => 'field_63d83225d3c2d',
                    'label' => 'Video',
                    'name' => 'video',
                    'type' => 'audio_video_player',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d83104d3c2a',
                                'operator' => '==',
                                'value' => 'video',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'general_type' => 'video',
                    'mime_types' => '',
                    'return_format' => 'url',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                ),
                array(
                    'key' => 'field_63d83225e4d3e',
                    'label' => 'Poster video',
                    'name' => 'video_poster',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d83104d3c2a',
                                'operator' => '==',
                                'value' => 'video',
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
                array(
                    'key' => 'field_63d8324fd3c2e',
                    'label' => 'Imagen',
                    'name' => 'imagen',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d83104d3c2a',
                                'operator' => '==',
                                'value' => 'imagen',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'return_format' => 'url',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'herramientas',
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