<?php

if (!defined('ABSPATH')) { exit; }

class MyTaxonomies
{
	public function __construct()
	{
	}

	public function init()
	{
        $this->init_actions();
	}

    public function init_actions()
	{
        add_action('init', array($this, 'build_taxonomies'));
    }

    public function init_filters()
    {

    }

    public function build_taxonomies()
    {
        $this->add_secciones_taxonomy();
        $this->add_herramientas_taxonomy();
        $this->add_biblioteca_filtros_taxonomy();

//Taxonomias para los filtros del mapa
        $this->add_tipo_taxonomy();
        $this->add_localidades_taxonomy();
        $this->add_tematica_taxonomy();
        $this->add_grupo_poblacionañ_taxonomy();

//Taxonomias para el perfil del usuaio
        $this->add_organizaciones_ciudadanas_taxonomy();
        $this->add_identidad_genero_taxonomy();
        $this->add_poblacion_diferencial_taxonomy();

//Taxonomias para los filtros del periodico
        $this->add_year_taxonomy();
    }

    public function add_secciones_taxonomy()
    {
        $labels = array(
            'name'              => 'Secciones asociadas',
            'singular_name'     => 'Sección',
            'search_items'      => 'Sección',
            'popular_items'     => '',
            'all_items'         => 'Todos',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nuevo',
            'new_item_name'     => 'Nuevo',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> false,
			"publicly_queryable"	=> false,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'seccion', 'with_front' => true,  'hierarchical' => true, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "seccion",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "seccion", [ "cursos", "post" ], $args );
    }

    public function add_herramientas_taxonomy()
    {
        $labels = array(
            'name'              => 'Tipo de Herramientas',
            'singular_name'     => 'Tipo de Herramienta',
            'search_items'      => 'Tipo de Herramienta',
            'popular_items'     => '',
            'all_items'         => 'Todos',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nuevo',
            'new_item_name'     => 'Nuevo',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> true,
			"publicly_queryable"	=> true,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'tipo-herramientas', 'with_front' => true,  'hierarchical' => false, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "tipo-herramienta",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "tipo-herramientas", [ "herramientas" ], $args );
    }

    public function add_biblioteca_filtros_taxonomy()
    {
        $labels = array(
            'name'              => 'Filtros asociados',
            'singular_name'     => 'Filtro',
            'search_items'      => 'Filtro',
            'popular_items'     => '',
            'all_items'         => 'Todos',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nuevo',
            'new_item_name'     => 'Nuevo',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> true,
			"publicly_queryable"	=> true,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'filtros', 'with_front' => true,  'hierarchical' => false, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "filtros",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "filtros", [ "biblioteca-tips" ], $args );
    }

    public function add_tipo_taxonomy()
    {
        $labels = array(
            'name'              => 'Filtro Etiquetas',
            'singular_name'     => 'Tipo',
            'search_items'      => 'Tipo',
            'popular_items'     => '',
            'all_items'         => 'Todas',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nueva',
            'new_item_name'     => 'Nueva',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> true,
			"publicly_queryable"	=> true,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'tipo', 'with_front' => true,  'hierarchical' => false, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "tipo",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "tipo", [ "secciones" ], $args );
    }

    public function add_localidades_taxonomy()
    {
        $labels = array(
            'name'              => 'Filtro Localidades',
            'singular_name'     => 'Localidad',
            'search_items'      => 'Localidad',
            'popular_items'     => '',
            'all_items'         => 'Todas',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nueva',
            'new_item_name'     => 'Nueva',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> true,
			"publicly_queryable"	=> true,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'localidades', 'with_front' => true,  'hierarchical' => false, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "localidades",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "localidades", [ "secciones", "post" ], $args );
    }

    public function add_organizaciones_ciudadanas_taxonomy()
    {
        $labels = array(
            'name'              => 'Organizaciones Ciudadanas',
            'singular_name'     => 'Organizacion Ciudadana',
            'search_items'      => 'Organizacion Ciudadana',
            'popular_items'     => '',
            'all_items'         => 'Todas',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nueva',
            'new_item_name'     => 'Nueva',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> true,
			"publicly_queryable"	=> true,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'organizaciones-ciudadanas', 'with_front' => true,  'hierarchical' => false, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "organizaciones-ciudadanas",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "organizaciones-ciudadanas", [ "post" ], $args );
    }

    public function add_identidad_genero_taxonomy()
    {
        $labels = array(
            'name'              => 'Identidad Genero',
            'singular_name'     => 'Identidad Genero',
            'search_items'      => 'Identidad Genero',
            'popular_items'     => '',
            'all_items'         => 'Todas',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nueva',
            'new_item_name'     => 'Nueva',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> true,
			"publicly_queryable"	=> true,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'identidad-genero', 'with_front' => true,  'hierarchical' => false, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "identidad-genero",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "identidad-genero", [ "post" ], $args );
    }

    public function add_poblacion_diferencial_taxonomy()
    {
        $labels = array(
            'name'              => 'Población Diferencial',
            'singular_name'     => 'Población Diferencial',
            'search_items'      => 'Población Diferencial',
            'popular_items'     => '',
            'all_items'         => 'Todas',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nueva',
            'new_item_name'     => 'Nueva',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> true,
			"publicly_queryable"	=> true,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'poblacion-diferencial', 'with_front' => true,  'hierarchical' => false, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "poblacion-diferencial",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "poblacion-diferencial", [ "post" ], $args );
    }

    public function add_tematica_taxonomy()
    {
        $labels = array(
            'name'              => 'Filtro Tematicas',
            'singular_name'     => 'Tematica',
            'search_items'      => 'Tematica',
            'popular_items'     => '',
            'all_items'         => 'Todas',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nueva',
            'new_item_name'     => 'Nueva',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> true,
			"publicly_queryable"	=> true,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'tematicas', 'with_front' => true,  'hierarchical' => false, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "tematicas",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "tematicas", [ "secciones" ], $args );
    }

    public function add_grupo_poblacionañ_taxonomy()
    {
        $labels = array(
            'name'              => 'Filtro Grupo Poblacional',
            'singular_name'     => 'Grupo Poblacional',
            'search_items'      => 'Grupo Poblacional',
            'popular_items'     => '',
            'all_items'         => 'Todos',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nueva',
            'new_item_name'     => 'Nueva',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> true,
			"publicly_queryable"	=> true,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'grupo-poblacional', 'with_front' => true,  'hierarchical' => false, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "grupo-poblacional",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "grupo-poblacional", [ "secciones" ], $args );
    }

    public function add_year_taxonomy()
    {
        $labels = array(
            'name'              => 'Filtro Año de publicación',
            'singular_name'     => 'Año de publicación',
            'search_items'      => 'Año de publicación',
            'popular_items'     => '',
            'all_items'         => 'Todos',
            'parent_item'       => 'superior',
            'parent_item_colon' => 'superior',
            'edit_item'         => '',
            'update_item'       => '',
            'add_new_item'      => 'Nueva',
            'new_item_name'     => 'Nueva',
        );

        $args = array(
            'hierarchical'      	=> true,
            'labels'            	=> $labels,
			"public" 				=> true,
			"publicly_queryable"	=> true,
			"hierarchical" 			=> true,
			"show_ui" 				=> true,
			"show_in_menu" 			=> true,
			"show_in_nav_menus" 	=> false,
			"query_var" 			=> true,
			"rewrite" 				=> [ 'slug' => 'fecha-publicacion', 'with_front' => true,  'hierarchical' => false, ],
			"show_admin_column" 	=> true,
			"show_in_rest" 			=> true,
			"show_tagcloud" 		=> false,
			"rest_base" 			=> "fecha-publicacion",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" 		=> "wp/v2",
			"show_in_quick_edit" 	=> false,
			"sort" 					=> false,
			"show_in_graphql" 		=> false,
        );

		register_taxonomy( "fecha-publicacion", [ "secciones" ], $args );
    }

}