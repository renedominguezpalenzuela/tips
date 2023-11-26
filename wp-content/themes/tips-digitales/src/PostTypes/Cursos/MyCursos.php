<?php

if (!defined('ABSPATH')) { exit; }

class MyCursos
{
    private $name       = 'Cursos';
    private $slug       = 'cursos';
    private $post_type  = 'cursos';

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
            'singular_name'         => __('Cursos', APP_TEXTDOMAIN),
            'menu_name'             => __('Cursos', APP_TEXTDOMAIN),
            'name_admin_bar'        => __('Cursos', APP_TEXTDOMAIN),
            'archives'              => __('Cursos archive', APP_TEXTDOMAIN),
            'attributes'            => __('Cursos attributes', APP_TEXTDOMAIN),
            'parent_item_colon'     => __('Parent Curso:', APP_TEXTDOMAIN),
            'all_items'             => __('All Cursos', APP_TEXTDOMAIN),
            'add_new_item'          => __('Add new Curso', APP_TEXTDOMAIN),
            'add_new'               => __('Add New', APP_TEXTDOMAIN),
            'new_item'              => __('New Curso', APP_TEXTDOMAIN),
            'edit_item'             => __('Edit Curso', APP_TEXTDOMAIN),
            'update_item'           => __('Update Curso', APP_TEXTDOMAIN),
            'view_item'             => __('View Curso', APP_TEXTDOMAIN),
            'view_items'            => __('View Curso', APP_TEXTDOMAIN),
            'search_items'          => __('Search Curso', APP_TEXTDOMAIN),
            'not_found'             => __('No Curso found', APP_TEXTDOMAIN),
            'not_found_in_trash'    => __('No Curso found in trash', APP_TEXTDOMAIN),
            'featured_image'        => __('Featured image', APP_TEXTDOMAIN),
            'set_featured_image'    => __('Set featured image', APP_TEXTDOMAIN),
            'remove_featured_image' => __('Remove featured image', APP_TEXTDOMAIN),
            'use_featured_image'    => __('Use as featured image', APP_TEXTDOMAIN),
            'insert_into_item'      => __('Insert into Curso', APP_TEXTDOMAIN),
            'uploaded_to_this_item' => __('Upload to this Curso', APP_TEXTDOMAIN),
            'items_list'            => __('Curso list', APP_TEXTDOMAIN),
            'items_list_navigation' => __('Curso list navigation', APP_TEXTDOMAIN),
            'filter_items_list'     => __('Filter Curso list', APP_TEXTDOMAIN),
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
            'menu_position'         => 7,
            'menu_icon'             => 'dashicons-welcome-learn-more',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'query_var'             => true,
            "has_archive"           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'show_in_rest'          => false,
            'rewrite'               => array('slug' => $this->slug, 'with_front' => true),
            'capability_type'       => 'post',
            'taxonomies'            => array( 'seccion' ),
        );

        //add_action( 'add_meta_boxes', [$this, 'metabox_newsletter'] );
        //add_action( 'acf/save_post', [$this, 'metabox_save_newsletter']);

        register_post_type($this->post_type, $args);
    }

    public function acf_fields()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_638e894f7654f',
            'title' => 'Cursos',
            'fields' => array(
                array(
                    'key' => 'field_638e898cf7eb1',
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
                    'key' => 'field_638e89a5f7eb2',
                    'label' => 'Descripción',
                    'name' => 'descripcion',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'visual',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_638e8a9424164',
                    'label' => 'Contenedor Botones',
                    'name' => 'contenedor_botones',
                    'type' => 'flexible_content',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layouts' => array(
                        'layout_638e8a9f6d136' => array(
                            'key' => 'layout_638e8a9f6d136',
                            'name' => 'boton_izquierda',
                            'label' => 'Botón Izquierda',
                            'display' => 'block',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_638e8aba24165',
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
                                    'key' => 'field_638e8cda24167',
                                    'label' => 'Página destino',
                                    'name' => 'pagina_destino',
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
                                        0 => 'page',
                                        1 => 'cursos',
                                        2 => 'secciones',
                                    ),
                                    'taxonomy' => '',
                                    'allow_null' => 0,
                                    'allow_archives' => 0,
                                    'multiple' => 0,
                                ),
                                array(
                                    'key' => 'field_638e8cda24168',
                                    'label' => 'Clase adicional',
                                    'name' => 'clase_adicional',
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
                        'layout_638e8d0524168' => array(
                            'key' => 'layout_638e8d0524168',
                            'name' => 'boton_derecha',
                            'label' => 'Botón Derecha',
                            'display' => 'block',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_638e8d0524169',
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
                                    'key' => 'field_638e8d052416a',
                                    'label' => 'Página destino',
                                    'name' => 'pagina_destino',
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
                                        0 => 'page',
                                        1 => 'cursos',
                                        2 => 'secciones',
                                    ),
                                    'taxonomy' => '',
                                    'allow_null' => 0,
                                    'allow_archives' => 0,
                                    'multiple' => 0,
                                ),
                                array(
                                    'key' => 'field_638e8d052416b',
                                    'label' => 'Clase adicional',
                                    'name' => 'clase_adicional',
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
                array(
                    'key' => 'field_638e9289e2cc7',
                    'label' => 'A quién va dirigido el curso',
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
                    'key' => 'field_638e89f0f7eb3',
                    'label' => 'Datos',
                    'name' => 'a_quien_va_dirigido_el_curso',
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
                    'max' => 0,
                    'layout' => 'block',
                    'button_label' => '',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_638e8a0ef7eb4',
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
                    ),
                ),
                array(
                    'key' => 'field_638e9299e2cc8',
                    'label' => 'Resumen del curso',
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
                    'key' => 'field_638e8a2ef7eb5',
                    'label' => 'Datos',
                    'name' => 'resumen_del_curso',
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
                    'max' => 0,
                    'layout' => 'block',
                    'button_label' => '',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_638e8a36f7eb6',
                            'label' => 'Valores',
                            'name' => 'valores',
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
                ),
                array(
                    'key' => 'field_638e92d5e683e',
                    'label' => 'Imagen y Link del curso',
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
                    'key' => 'field_638e9322e683f',
                    'label' => 'Imagen del curso',
                    'name' => 'imagen_curso',
                    'type' => 'image',
                    'instructions' => '',
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
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_638e94b199868',
                    'label' => 'Titulo botón curso',
                    'name' => 'titulo_boton_curso',
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
                    'key' => 'field_6391e4b6a91f8',
                    'label' => 'Botón para registrarse al curso?',
                    'name' => 'boton_registro_curso',
                    'type' => 'button_group',
                    'instructions' => 'Selecciona "Si" para que al ser presionado el Botón aparezca el Popup con el formulario de registro. Selecciona "No" para que el Botón te permita insertar un enlace para ingresar al curso desde un link externo.',
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
                    'key' => 'field_638e9344e6840',
                    'label' => 'Link del curso',
                    'name' => 'link_curso',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_6391e4b6a91f8',
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
                    'default_value' => '',
                    'placeholder' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'cursos',
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