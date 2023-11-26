<?php

if (!defined('ABSPATH')) { exit; }

class MyVeedurias
{
    private $name       = 'Veedurías';
    private $slug       = 'veedurias';
    private $post_type  = 'veedurias';

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
            'singular_name'         => __('Veedurías', APP_TEXTDOMAIN),
            'menu_name'             => __('Veedurías', APP_TEXTDOMAIN),
            'name_admin_bar'        => __('Veedurías', APP_TEXTDOMAIN),
            'archives'              => __('Veedurías archive', APP_TEXTDOMAIN),
            'attributes'            => __('Veedurías attributes', APP_TEXTDOMAIN),
            'parent_item_colon'     => __('Parent Veedurías:', APP_TEXTDOMAIN),
            'all_items'             => __('All Veedurías', APP_TEXTDOMAIN),
            'add_new_item'          => __('Add new Veedurías', APP_TEXTDOMAIN),
            'add_new'               => __('Add New', APP_TEXTDOMAIN),
            'new_item'              => __('New Veedurías', APP_TEXTDOMAIN),
            'edit_item'             => __('Edit Veedurías', APP_TEXTDOMAIN),
            'update_item'           => __('Update Veedurías', APP_TEXTDOMAIN),
            'view_item'             => __('View Veedurías', APP_TEXTDOMAIN),
            'view_items'            => __('View Veedurías', APP_TEXTDOMAIN),
            'search_items'          => __('Search Veedurías', APP_TEXTDOMAIN),
            'not_found'             => __('No Veedurías found', APP_TEXTDOMAIN),
            'not_found_in_trash'    => __('No Veedurías found in trash', APP_TEXTDOMAIN),
            'featured_image'        => __('Featured image', APP_TEXTDOMAIN),
            'set_featured_image'    => __('Set featured image', APP_TEXTDOMAIN),
            'remove_featured_image' => __('Remove featured image', APP_TEXTDOMAIN),
            'use_featured_image'    => __('Use as featured image', APP_TEXTDOMAIN),
            'insert_into_item'      => __('Insert into Veedurías', APP_TEXTDOMAIN),
            'uploaded_to_this_item' => __('Upload to this Veedurías', APP_TEXTDOMAIN),
            'items_list'            => __('Veedurías list', APP_TEXTDOMAIN),
            'items_list_navigation' => __('Veedurías list navigation', APP_TEXTDOMAIN),
            'filter_items_list'     => __('Filter Veedurías list', APP_TEXTDOMAIN),
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
            'menu_position'         => 12,
            'menu_icon'             => 'dashicons-welcome-widgets-menus',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'query_var'             => true,
            "has_archive"           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'show_in_rest'          => true,
            'rewrite'               => array('slug' => $this->slug, 'with_front' => true),
            'capability_type'       => 'post',
        );

        register_post_type($this->post_type, $args);
    }

    public function acf_fields()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63d92e425d33b',
            'title' => 'Veedurías',
            'fields' => array(
                array(
                    'key' => 'field_63f55f3e7cd8a',
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
                    'key' => 'field_63f55f647cd8b',
                    'label' => 'Posición en el mapa',
                    'name' => 'posicion_en_el_mapa',
                    'type' => 'text',
                    'instructions' => 'Ingresa la Longitud y Latitud, estos datos los puedes obtener en Google Map colocando la dirección en Google Maps y al dar click derecho sobre la ubicación aparece esta posición con un formato como este: 4.705052680872945, -74.03532412858694',
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
                    'key' => 'field_63f55f2c7cd89',
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
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => 'wpautop',
                ),
                array(
                    'key' => 'field_63f55f2c8de90',
                    'label' => 'Como hacer parte',
                    'name' => 'como_hacer_parte',
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
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => 'br',
                ),
                array(
                    'key' => 'field_6426103a102f5',
                    'label' => 'Usuario encargado',
                    'name' => 'usuario_encargado',
                    'type' => 'user',
                    'instructions' => 'Este es el usuario que recibira los mensajes enviados por los usuarios',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'role' => 'usuario_encargado',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'return_format' => 'id',
                ),
                array(
                    'key' => 'field_63f55fd07cd8c',
                    'label' => 'A quien contactar',
                    'name' => 'personas',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'collapsed' => 'field_63f55ff77cd8d',
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'block',
                    'button_label' => 'Agregar usuario',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_63f55ff77cd8d',
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
                            'relevanssi_exclude' => 0,
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_63f5600a7cd8e',
                            'label' => 'Telefono',
                            'name' => 'telefono',
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
                            'key' => 'field_63f560167cd8f',
                            'label' => 'Email',
                            'name' => 'email',
                            'type' => 'email',
                            'instructions' => '',
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
                            'prepend' => '',
                            'append' => '',
                        ),
                        array(
                            'key' => 'field_63f560297cd90',
                            'label' => 'Foto',
                            'name' => 'foto',
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
                            'return_format' => 'array',
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
                    'key' => 'field_63f77d44bfc26',
                    'label' => 'Informes',
                    'name' => 'informes',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'collapsed' => 'field_63f7855cbfc27',
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'block',
                    'button_label' => 'Agregar informe',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_63f7855cbfc27',
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
                            'relevanssi_exclude' => 0,
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_63f78579bfc28',
                            'label' => 'Archivo',
                            'name' => 'archivo',
                            'type' => 'file',
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
                            'library' => 'all',
                            'min_size' => '',
                            'max_size' => '',
                            'mime_types' => 'pdf',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'veedurias',
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