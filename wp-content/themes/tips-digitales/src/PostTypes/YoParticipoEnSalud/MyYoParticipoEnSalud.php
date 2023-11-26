<?php

if (!defined('ABSPATH')) { exit; }

class MyYoParticipoEnSalud
{
    private $name       = 'YoParticipoEnSalud';
    private $slug       = 'yoparticipoensalud';
    private $post_type  = 'yoparticipoensalud';

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
            'singular_name'         => __('YoParticipoEnSalud', APP_TEXTDOMAIN),
            'menu_name'             => __('YoParticipoEnSalud', APP_TEXTDOMAIN),
            'name_admin_bar'        => __('YoParticipoEnSalud', APP_TEXTDOMAIN),
            'archives'              => __('YoParticipoEnSalud archive', APP_TEXTDOMAIN),
            'attributes'            => __('YoParticipoEnSalud attributes', APP_TEXTDOMAIN),
            'parent_item_colon'     => __('Parent YoParticipoEnSalud:', APP_TEXTDOMAIN),
            'all_items'             => __('All YoParticipoEnSalud', APP_TEXTDOMAIN),
            'add_new_item'          => __('Add new YoParticipoEnSalud', APP_TEXTDOMAIN),
            'add_new'               => __('Add New', APP_TEXTDOMAIN),
            'new_item'              => __('New YoParticipoEnSalud', APP_TEXTDOMAIN),
            'edit_item'             => __('Edit YoParticipoEnSalud', APP_TEXTDOMAIN),
            'update_item'           => __('Update YoParticipoEnSalud', APP_TEXTDOMAIN),
            'view_item'             => __('View YoParticipoEnSalud', APP_TEXTDOMAIN),
            'view_items'            => __('View YoParticipoEnSalud', APP_TEXTDOMAIN),
            'search_items'          => __('Search YoParticipoEnSalud', APP_TEXTDOMAIN),
            'not_found'             => __('No YoParticipoEnSalud found', APP_TEXTDOMAIN),
            'not_found_in_trash'    => __('No YoParticipoEnSalud found in trash', APP_TEXTDOMAIN),
            'featured_image'        => __('Featured image', APP_TEXTDOMAIN),
            'set_featured_image'    => __('Set featured image', APP_TEXTDOMAIN),
            'remove_featured_image' => __('Remove featured image', APP_TEXTDOMAIN),
            'use_featured_image'    => __('Use as featured image', APP_TEXTDOMAIN),
            'insert_into_item'      => __('Insert into YoParticipoEnSalud', APP_TEXTDOMAIN),
            'uploaded_to_this_item' => __('Upload to this YoParticipoEnSalud', APP_TEXTDOMAIN),
            'items_list'            => __('YoParticipoEnSalud list', APP_TEXTDOMAIN),
            'items_list_navigation' => __('YoParticipoEnSalud list navigation', APP_TEXTDOMAIN),
            'filter_items_list'     => __('Filter YoParticipoEnSalud list', APP_TEXTDOMAIN),
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
            'menu_position'         => 9,
            'menu_icon'             => 'dashicons-media-interactive',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'query_var'             => true,
            "has_archive"           => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => false,
            'show_in_rest'          => false,
            'rewrite'               => array('slug' => $this->slug, 'with_front' => true),
            'capability_type'       => 'post',
            'taxonomies'            => array( 'seccion' ),
        );

        register_post_type($this->post_type, $args);
    }

    public function acf_fields()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63d30eba3b600',
            'title' => 'YoParticipoEnSalud',
            'fields' => array(
                array(
                    'key' => 'field_63d30faed53a6',
                    'label' => 'Miniatura',
                    'name' => 'miniatura',
                    'type' => 'image',
                    'instructions' => 'Es la imagen que aparece en el carrusel de la campaña #YoParticipoEnSalud, la imagen debe ser de 700x350',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'url',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => 700,
                    'min_height' => 350,
                    'min_size' => '',
                    'max_width' => 700,
                    'max_height' => 350,
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_63d451f765e80',
                    'label' => 'Contenido',
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
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_63d4540665e84',
                    'label' => 'Texto descriptivo',
                    'name' => 'texto_descriptivo_vista_inmersiva',
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
                    'key' => 'field_63d582416c3a6',
                    'label' => 'Link ver más',
                    'name' => 'link_carrusel_yoparticipoensalud',
                    'type' => 'page_link',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array(
                        0 => 'secciones',
                    ),
                    'taxonomy' => '',
                    'allow_null' => 0,
                    'allow_archives' => 0,
                    'multiple' => 0,
                ),
                array(
                    'key' => 'field_63d4520165e81',
                    'label' => 'Contenido vista inmersiva',
                    'name' => 'contenido_vista_inmersiva',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => 0,
                    'max' => 1,
                    'layout' => 'row',
                    'button_label' => 'Agregar contenido',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_63d4523e65e82',
                            'label' => 'Tipo de contenido',
                            'name' => 'tipo_de_contenido',
                            'type' => 'select',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'choices' => array(
                                'imagen' => 'Imagen',
                                'video' => 'Video',
                                'audio' => 'Audio',
                            ),
                            'default_value' => 'imagen',
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 1,
                            'ajax' => 0,
                            'return_format' => 'value',
                            'placeholder' => '',
                        ),
                        array(
                            'key' => 'field_63e582b201422',
                            'label' => 'Imagenes',
                            'name' => 'imagenes',
                            'type' => 'repeater',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_63d4523e65e82',
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
                            'collapsed' => 'field_63e582be01423',
                            'min' => 0,
                            'max' => 0,
                            'layout' => 'block',
                            'button_label' => 'Agregar imagen',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_63e582be01423',
                                    'label' => 'Imagen',
                                    'name' => 'imagen',
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
                                    'max_width' => '',
                                    'max_height' => '',
                                    'max_size' => '',
                                    'mime_types' => '',
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_63d566e4313e1',
                            'label' => 'Insertar video de Youtube?',
                            'name' => 'insertar_video_de_youtube',
                            'type' => 'button_group',
                            'instructions' => 'Selecciona "Si" para insertar un video de Youtube',
                            'required' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_63d4523e65e82',
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
                            'key' => 'field_63d567c1313e3',
                            'label' => 'URL Video de Youtube',
                            'name' => 'contenedor_youtube',
                            'type' => 'oembed',
                            'instructions' => 'Ingresa la URL del video de Youtube',
                            'required' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_63d566e4313e1',
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
                            'height' => 400,
                        ),
                        array(
                            'key' => 'field_63d5675b313e2',
                            'label' => 'Subir video',
                            'name' => 'subir_video',
                            'type' => 'file',
                            'instructions' => 'Seleccione el video a subir',
                            'required' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_63d566e4313e1',
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
                            'library' => 'all',
                            'min_size' => '',
                            'max_size' => '',
                            'mime_types' => 'mp4,mpeg4,mpeg,mpg',
                        ),

                        array(
                            'key' => 'field_63d5675b424f3',
                            'label' => 'Poster video',
                            'name' => 'video_poster',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_63d566e4313e1',
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

                        array(
                            'key' => 'field_63d576a1d7f08',
                            'label' => 'Caratula',
                            'name' => 'caratula',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_63d4523e65e82',
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
                            'key' => 'field_63d576cbd7f09',
                            'label' => 'Audio',
                            'name' => 'audio',
                            'type' => 'audio_video_player',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_63d4523e65e82',
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
                            'general_type' => 'audio',
                            'mime_types' => 'mp3',
                            'return_format' => 'url',
                            'library' => 'all',
                            'min_size' => '',
                            'max_size' => '',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'yoparticipoensalud',
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