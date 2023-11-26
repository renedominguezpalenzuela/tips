<?php

if (!defined('ABSPATH')) { exit; }

class MyContenedorCajaHerramientas
{
    private $name       = 'CajaHerramientas';
    private $slug       = 'CajaHerramientas';
    private $post_type  = 'CajaHerramientas';

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
        add_rewrite_rule('^secciones/representantes-de-la-ciudadania/caja-de-herramientas/pagina/([0-9]+)/?', 'index.php?/?secciones=representantes-de-la-ciudadania/caja-de-herramientas&paged=$matches[1]', 'top');

        add_rewrite_rule('^secciones/representantes-de-la-ciudadania/caja-de-herramientas/pagina/([0-9]+)/?/search/(.+)/?', 'index.php?/?secciones=representantes-de-la-ciudadania/caja-de-herramientas&paged=$matches[1]&search=$matches[2]', 'top');

        add_action( 'init', [$this, 'acf_caja_herramientas_field'] );
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

    public function get_url_pagination($actualURL, $page, $keyword)
    {
        if($keyword != '')
            $slugKeyword = '?search=' . urlencode($keyword);
        else
            $slugKeyword = '';

        $url = $actualURL . 'pagina/' . $page . $slugKeyword;

        return $url;
    }

    public function get_herramientas($tax, $page, $keyword, $ID='')
    {
        if($ID == '')
        {
            if($keyword != 'false')
                $url = get_site_url() . '/tipo-herramientas/' . $tax . '?pagina=' . $page . '&keyword=' . urlencode($keyword);
            else
                $url = get_site_url() . '/tipo-herramientas/' . $tax . '?pagina=' . $page;
        }
        else
        {
            $url = get_site_url() . '/tipo-herramientas/' . $tax . '?ID=' . $ID;
        }

        //$json = file_get_contents($url);

        $response = wp_remote_get($url);
        $obj = [
            'found_posts' => 0,
            'posts_per_page'=> 0
        ];
       
        if (is_wp_error($response)) {
            // Manejar errores
            $obj['error'] = "Error: " . $response->get_error_message();
            $obj = (object)$obj;
        } else {
            // Obtener el contenido de la respuesta
            $json = wp_remote_retrieve_body($response);
        
            $obj = json_decode($json);
        }

        return $obj;
    }

    public function acf_caja_herramientas_field()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63d5989182383',
            'title' => 'Caja de Herramientas',
            'fields' => array(
                array(
                    'key' => 'field_63d5994b0e85d',
                    'label' => 'Agregar caja de herramientas?',
                    'name' => 'agregar_caja_de_herramientas',
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
                    'key' => 'field_63d8466004997',
                    'label' => 'Agregar botón Biblioteca Tips',
                    'name' => 'agregar_boton_biblioteca_tips',
                    'type' => 'button_group',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d5994b0e85d',
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
                    'relevanssi_exclude' => 0,
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
                    'key' => 'field_63d846a004999',
                    'label' => 'Titulo botón',
                    'name' => 'titulo_boton_biblioteca_tips',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d8466004997',
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
                    'relevanssi_exclude' => 0,
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_63d846bc0499a',
                    'label' => 'Página destino',
                    'name' => 'pagina_destino_biblioteca_tips',
                    'type' => 'page_link',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d8466004997',
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
                    'relevanssi_exclude' => 0,
                    'post_type' => array(
                        0 => 'secciones',
                    ),
                    'taxonomy' => '',
                    'allow_null' => 0,
                    'allow_archives' => 0,
                    'multiple' => 0,
                ),
                array(
                    'key' => 'field_63d847010499b',
                    'label' => 'Clase adicional',
                    'name' => 'clase_adicional_biblioteca_tips',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d8466004997',
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