<?php

if (!defined('ABSPATH')) { exit; }

class MyPropuestas
{
    private $name       = 'Propuestas';
    private $slug       = 'propuestas';
    private $post_type  = 'propuestas';

    public function __construct()
    {
    }

    public function init()
    {
        //wp-admin/edit.php?post_type=propuestas
        $this->init_actions();
        $this->init_filters();

        add_rewrite_rule('^mi-perfil/pagina/([0-9]+)/?/tipo/(.+)/?/search/(.+)/?', 'index.php?/?pagename=mi-perfil&paged=$matches[1]&tipo=$matches[2]&search=$matches[3]', 'top');
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
            'singular_name'         => __('Propuestas', APP_TEXTDOMAIN),
            'menu_name'             => __('Propuestas', APP_TEXTDOMAIN),
            'name_admin_bar'        => __('Propuestas', APP_TEXTDOMAIN),
            'archives'              => __('Propuestas archive', APP_TEXTDOMAIN),
            'attributes'            => __('Propuestas attributes', APP_TEXTDOMAIN),
            'parent_item_colon'     => __('Parent Propuestas:', APP_TEXTDOMAIN),
            'all_items'             => __('All Propuestas', APP_TEXTDOMAIN),
            'add_new_item'          => __('Add new Propuestas', APP_TEXTDOMAIN),
            'add_new'               => __('Add New', APP_TEXTDOMAIN),
            'new_item'              => __('New Propuestas', APP_TEXTDOMAIN),
            'edit_item'             => __('Edit Propuestas', APP_TEXTDOMAIN),
            'update_item'           => __('Update Propuestas', APP_TEXTDOMAIN),
            'view_item'             => __('View Propuestas', APP_TEXTDOMAIN),
            'view_items'            => __('View Propuestas', APP_TEXTDOMAIN),
            'search_items'          => __('Search Propuestas', APP_TEXTDOMAIN),
            'not_found'             => __('No Propuestas found', APP_TEXTDOMAIN),
            'not_found_in_trash'    => __('No Propuestas found in trash', APP_TEXTDOMAIN),
            'featured_image'        => __('Featured image', APP_TEXTDOMAIN),
            'set_featured_image'    => __('Set featured image', APP_TEXTDOMAIN),
            'remove_featured_image' => __('Remove featured image', APP_TEXTDOMAIN),
            'use_featured_image'    => __('Use as featured image', APP_TEXTDOMAIN),
            'insert_into_item'      => __('Insert into Propuestas', APP_TEXTDOMAIN),
            'uploaded_to_this_item' => __('Upload to this Propuestas', APP_TEXTDOMAIN),
            'items_list'            => __('Propuestas list', APP_TEXTDOMAIN),
            'items_list_navigation' => __('Propuestas list navigation', APP_TEXTDOMAIN),
            'filter_items_list'     => __('Filter Propuestas list', APP_TEXTDOMAIN),
        );
        $args = array(
            'label'                 => $this->name,
            'description'           => $this->name,
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'custom-fields', 'author'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => false,
            'menu_position'         => 12,
            'menu_icon'             => 'dashicons-welcome-widgets-menus',
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'query_var'             => true,
            "has_archive"           => true,
            'exclude_from_search'   => true,
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
            'key' => 'group_641e5ce528cb3',
            'title' => 'Propuestas',
            'fields' => array(
                array(
                    'key' => 'field_641e5d1b8625b',
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
                    'key' => 'field_641e5d278625c',
                    'label' => 'Tipo',
                    'name' => 'tipo',
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
                    'key' => 'field_641e5d4a8625d',
                    'label' => 'ID',
                    'name' => 'id',
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
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'propuestas',
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