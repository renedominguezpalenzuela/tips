<?php

if (!defined('ABSPATH')) { exit; }

class MyContenedorBiblioteca
{
    private $name       = 'ContenedorBiblioteca';
    private $slug       = 'ContenedorBiblioteca';
    private $post_type  = 'ContenedorBiblioteca';

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
        add_rewrite_rule('^secciones/acerca-de-tips/biblioteca-tips/pagina/([0-9]+)/?', 'index.php?/?secciones=acerca-de-tips/biblioteca-tips&paged=$matches[1]', 'top');

        add_rewrite_rule('^secciones/acerca-de-tips/biblioteca-tips/pagina/([0-9]+)/?/search/(.+)/?', 'index.php?/?secciones=acerca-de-tips/biblioteca-tips&paged=$matches[1]&search=$matches[2]', 'top');

        add_rewrite_rule('^secciones/acerca-de-tips/biblioteca-tips/pagina/([0-9]+)/?/search/(.+)/?/filtros/(.+)/?', 'index.php?/?secciones=acerca-de-tips/biblioteca-tips&paged=$matches[1]&search=$matches[2]&filters=$matches[3]', 'top');

        add_action( 'init', [$this, 'acf_contenedor_biblioteca_field'] );
        add_action( 'init', [$this, 'acf_documentos_user_field'] );

        add_action('wp_ajax_ajax_borrar_documento', array($this, 'ajax_borrar_documento'));
        add_action('wp_ajax_nopriv_ajax_borrar_documento', array($this, 'ajax_borrar_documento'));
    }

    public function init_filters()
    {
        apply_filters( 'relevanssi_valid_status', array('publish', 'pending') );
    }

    public function load_styles()
    {
    }

    public function load_scripts()
    {
    }

    public function get_url_filtros($tax, $page, $keyword, $filtros='', $ID='')
    {
        if($ID == '')
        {
            if($keyword != '')
                $slugKeyword = '&keyword=' . urlencode($keyword);
            else
                $slugKeyword = '';

            if($filtros != '')
                $slugFiltro = '&filters=' . urlencode($filtros);
            else
                $slugFiltro = '';

            $url = get_site_url() . '/filtros/' . $tax . '?pagina=' . $page . $slugKeyword . $slugFiltro;
        }
        else
            $url = get_site_url() . '/filtros/' . $tax . '?ID=' . $ID;

        return $url;
    }

    public function get_all_filters($tax)
    {
        $TermsID = get_term_by('slug', $tax, 'filtros')->term_id;

        $args = array
        (
            'taxonomy'  => 'filtros',
            'hide_empty'=> true,
            'parent'    => $TermsID
        );

        $taxTerms = get_terms( $args );

        $objectTerms = new stdClass();

        $objectTerms->terms = array();
        $cont = 0;

        foreach($taxTerms as $term)
        {
            $objectTerms->terms[$cont]['value'] = $term->name;
            $objectTerms->terms[$cont]['id'] = 'filter-' . $term->slug;

            $cont++;
        }

        return $objectTerms;
    }

    public function get_url_pagination($actualURL, $page, $keyword, $filtros)
    {
        if($keyword != '')
            $slugKeyword = '?search=' . urlencode($keyword);
        else
            $slugKeyword = '';

        if($filtros != '')
            $slugFiltro = '&filtros=' . urlencode($filtros);
        else
            $slugFiltro = '';

        $url = $actualURL . 'pagina/' . $page . $slugKeyword . $slugFiltro;

        return $url;
    }

    public function get_url_pagination_perfil($actualURL, $page, $keyword, $type)
    {
        if($keyword != false)
            $slugKeyword = '?search=' . urlencode($keyword);
        else
            $slugKeyword = '';

        if($type != '')
        {
            if($keyword != false)
                $slugTipo = '&tipo=' . urlencode($type);
            else
                $slugTipo = '?tipo=' . urlencode($type);
        }
        else
            $slugTipo = '';

        $url = $actualURL . 'page/' . $page . $slugKeyword . $slugTipo;

        return $url;
    }

    public function get_biblioteca($tax, $page, $keyword, $filtros='', $ID='')
    {
        $url = $this->get_url_filtros($tax, $page, $keyword, $filtros, $ID);
        
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

    public function acf_contenedor_biblioteca_field()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63d93b716e344',
            'title' => 'Contenedor Biblioteca Tips',
            'fields' => array(
                array(
                    'key' => 'field_63d93b9ccc80f',
                    'label' => 'Agregar Biblioteca Tips',
                    'name' => 'agregar_biblioteca_tips',
                    'type' => 'button_group',
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
                        'si' => 'Si',
                        'no' => 'No',
                    ),
                    'allow_null' => 0,
                    'default_value' => 'no',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
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

    public function acf_documentos_user_field()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_64235297e3068',
            'title' => 'Contenedor documentos usuario',
            'fields' => array(
                array(
                    'key' => 'field_642352cce802e',
                    'label' => 'Seleccionar formulario',
                    'name' => 'seleccionar_formulario_subir_archivo_biblioteca',
                    'type' => 'acf_cf7',
                    'instructions' => 'Selecciona el formulario para la subida de archivos a la Biblioteca',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                ),
                array(
                    'key' => 'field_642352cce913f',
                    'label' => 'Descripción subir archivo',
                    'name' => 'descripcion_subir_archivo',
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
                    'new_lines' => '',
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

    public function get_documentos_user($userID, $page, $cant, $keyword=false)
    {
        if($keyword != false)
        {
            $args = array(
                'post_type'     => 'biblioteca-tips',
                's'             => $keyword,
                'relevanssi'    => true,
                'order'         => 'DESC',
                'posts_per_page'=> $cant, 
                'paged'         => $page, 
                'fields'        => 'ids',
                'post_status'   => array('publish', 'pending'),
                'author__in'    => $userID,
            );
        }
        else
        {
            $args = array(
                'posts_per_page'  => $cant,
                'post_type'       => 'biblioteca-tips',
                'author__in'      => $userID,
                'post_status'     => array('publish', 'pending'), 
                'order'           => 'DESC',
                'orderby'         => 'date',
                'paged'           => $page,
                'fields'          => 'ids',
            );
        }

        $myPosts = new WP_Query($args);

        if($keyword != false)
        {
            if(function_exists('relevanssi_do_query'))
                relevanssi_do_query( $myPosts );
        }

        $objectPosts = new stdClass();

        if ( $myPosts->have_posts() )
        {
            $objectPosts->found_posts   = $myPosts->found_posts;
            $objectPosts->posts_per_page= $cant;
            $cont = 0;

            $objectPosts->posts = array();

            while ( $myPosts->have_posts() )
            {
                $myPosts->the_post();

                $myPost = get_the_ID();

                $objectPosts->posts[$cont]['ID'] = $myPost;
                $objectPosts->posts[$cont]['titulo'] = get_the_title($myPost);
                $objectPosts->posts[$cont]['descripcion'] = get_field('descripcion', $myPost);

                $TermsID = get_term_by('slug', 'localidad', 'filtros' )->term_id;

                $args = array
                (
                    'taxonomy'  => 'filtros',
                    'hide_empty'=> true,
                    'parent'    => $TermsID
                );

                $terms = wp_get_post_terms( $myPost, 'filtros', $args ); 

                if(isset($terms[0]))
                    $objectPosts->posts[$cont]['localidad'] = $terms[0]->name;
                else
                    $objectPosts->posts[$cont]['localidad'] = 'Localidad';

                $tipo_de_archivo = get_field('tipo_de_archivo', $myPost);

                if($tipo_de_archivo == 'pdf')
                {
                    $archivo = get_field('pdf', $myPost);
                }
                else
                {
                    $archivo = get_field('imagen', $myPost);
                }

                $objectPosts->posts[$cont]['tipo_de_archivo'] = $tipo_de_archivo;
                $objectPosts->posts[$cont]['archivos'] = $archivo;

                $cont++;
            }
        }
        else
        {
            wp_reset_postdata();

            return false;
        }

        wp_reset_postdata();

        return $objectPosts;

    }

    public function get_documentos_user_by_documentoID($userID, $documentoID)
    {
        $args = array(
            'post_type'       => 'biblioteca-tips',
            'author'          => $userID,
            'post_status'     => array('publish', 'pending'),   
            'order'           => 'DESC',
            'orderby'         => 'date',
            'numberposts'     => -1,
            'fields'          => 'ids',
            'post__in'        => array($documentoID)
        );

        $documentos = get_posts( $args );

        return $documentos;
    }

    public function ajax_borrar_documento()
    {
        $documentoID  = intval(esc_attr($_POST["documentoID"]));
        $userID       = intval(esc_attr($_POST["userID"]));

        if($userID != 0)
        {
            $postID = $this->get_documentos_user_by_documentoID($userID, $documentoID);

            $data = wp_delete_post($postID[0], true); 

            if($data != false)
            {
                $type = 'info';
                $title = 'El documento fue eliminado';
            }
            else
            {
                $type = 'info';
                $title = 'El documento no se pudo eliminar: ' . $postID[0];
            }
        }
        else
        {
            $type = 'error';
            $title = 'Tienes que estar logeado para borrar los documentos';
        }

        $result['type'] = $type;
        $result['title'] = $title;
        $result['documentoID'] = $documentoID;
        $result['userID'] = $userID;

        $result = json_encode($result);
        echo $result;
        wp_die();
    }

}