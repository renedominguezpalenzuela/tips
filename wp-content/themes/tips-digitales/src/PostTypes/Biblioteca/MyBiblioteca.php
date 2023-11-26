<?php

if (!defined('ABSPATH')) { exit; }

class MyBiblioteca
{
    private $name       = 'Biblioteca Tips';
    private $slug       = 'biblioteca-tips';
    private $post_type  = 'biblioteca-tips';

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
            'singular_name'         => __('Biblioteca Tips', APP_TEXTDOMAIN),
            'menu_name'             => __('Biblioteca Tips', APP_TEXTDOMAIN),
            'name_admin_bar'        => __('Biblioteca Tips', APP_TEXTDOMAIN),
            'archives'              => __('Biblioteca Tips archive', APP_TEXTDOMAIN),
            'attributes'            => __('Biblioteca Tips attributes', APP_TEXTDOMAIN),
            'parent_item_colon'     => __('Parent Biblioteca Tips:', APP_TEXTDOMAIN),
            'all_items'             => __('All Biblioteca Tips', APP_TEXTDOMAIN),
            'add_new_item'          => __('Add new Biblioteca Tips', APP_TEXTDOMAIN),
            'add_new'               => __('Add New', APP_TEXTDOMAIN),
            'new_item'              => __('New Biblioteca Tips', APP_TEXTDOMAIN),
            'edit_item'             => __('Edit Biblioteca Tips', APP_TEXTDOMAIN),
            'update_item'           => __('Update Biblioteca Tips', APP_TEXTDOMAIN),
            'view_item'             => __('View Biblioteca Tips', APP_TEXTDOMAIN),
            'view_items'            => __('View Biblioteca Tips', APP_TEXTDOMAIN),
            'search_items'          => __('Search Biblioteca Tips', APP_TEXTDOMAIN),
            'not_found'             => __('No Biblioteca Tips found', APP_TEXTDOMAIN),
            'not_found_in_trash'    => __('No Biblioteca Tips found in trash', APP_TEXTDOMAIN),
            'featured_image'        => __('Featured image', APP_TEXTDOMAIN),
            'set_featured_image'    => __('Set featured image', APP_TEXTDOMAIN),
            'remove_featured_image' => __('Remove featured image', APP_TEXTDOMAIN),
            'use_featured_image'    => __('Use as featured image', APP_TEXTDOMAIN),
            'insert_into_item'      => __('Insert into Biblioteca Tips', APP_TEXTDOMAIN),
            'uploaded_to_this_item' => __('Upload to this Biblioteca Tips', APP_TEXTDOMAIN),
            'items_list'            => __('Biblioteca Tips list', APP_TEXTDOMAIN),
            'items_list_navigation' => __('Biblioteca Tips list navigation', APP_TEXTDOMAIN),
            'filter_items_list'     => __('Filter Biblioteca Tips list', APP_TEXTDOMAIN),
        );
        $args = array(
            'label'                 => $this->name,
            'description'           => $this->name,
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'custom-fields', 'author'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 12,
            'menu_icon'             => 'dashicons-book-alt',
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
            'key' => 'group_63d92e412a008',
            'title' => 'Biblioteca Tips',
            'fields' => array(
                array(
                    'key' => 'field_63d932547be8d',
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
                    'relevanssi_exclude' => 0,
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_63d932ba7be8e',
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
                    'max_width' => 170,
                    'max_height' => 170,
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_63d933067be8f',
                    'label' => 'Tipo de Archivo',
                    'name' => 'tipo_de_archivo',
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
                    'key' => 'field_63d9333a7be90',
                    'label' => 'PDF',
                    'name' => 'pdf',
                    'type' => 'file',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d933067be8f',
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
                    'key' => 'field_63d933ba729df',
                    'label' => 'Caratula',
                    'name' => 'caratula',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d933067be8f',
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
                    'key' => 'field_63d93402729e0',
                    'label' => 'Audio',
                    'name' => 'audio',
                    'type' => 'audio_video_player',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d933067be8f',
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
                    'key' => 'field_63d93422729e1',
                    'label' => 'Video',
                    'name' => 'video',
                    'type' => 'audio_video_player',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d933067be8f',
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
                    'key' => 'field_63d93422830f2',
                    'label' => 'Poster video',
                    'name' => 'video_poster',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d933067be8f',
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
                    'key' => 'field_63d93448729e2',
                    'label' => 'Imagen',
                    'name' => 'imagen',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d933067be8f',
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
                        'value' => 'biblioteca-tips',
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