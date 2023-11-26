<?php

if (!defined('ABSPATH')) { exit; }

class MyContenedorFormularioSecciones
{
    private $name       = 'FormularioSecciones';
    private $slug       = 'FormularioSecciones';
    private $post_type  = 'FormularioSecciones';

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

    public function after_save_data_form_proponer_iniciativa($insert_id)
    {
        global $wpdb;

        $table_name = $wpdb->prefix.'db7_forms';

        $results    = $wpdb->get_results( "SELECT * FROM $table_name WHERE form_id = $insert_id LIMIT 1", OBJECT );

        if ( !empty($results) )
        {
            $form_data  = unserialize( $results[0]->form_value );

            if(isset($form_data["userID"]))
                $userID = $form_data["userID"];
            else
                $userID = 0;

            if(isset($form_data["proponerIniciativa"]))
                $proponerIniciativa = $form_data["proponerIniciativa"];
            else
                $proponerIniciativa = false;

            if($proponerIniciativa == "true")
            {
                if($userID != 0)
                {
                    $post_id = wp_insert_post(array
                    (
                       'post_type' => 'propuestas',
                       'post_title' => $form_data['nombre_iniciativa'],
                       'post_status' => 'publish',
                       'post_author' => $userID
                    ));

                    update_field('descripcion', $form_data['describe_iniciativa'], $post_id);
                    update_field('tipo', 'iniciativa', $post_id);
                    update_field('id', $insert_id, $post_id);

                    $filename = $insert_id . '-' . $userID;
                    $cont = 1;

                    foreach($form_data["upload-file-iniciativas"] as $fileURL)
                    {
                        $newFilename = $filename . '-' . $cont;

                        $moveFile = $this->move_files_to_uploads($fileURL, $newFilename, $insert_id);

                        $newData[$cont-1] = $moveFile;

                        $cont++;
                    }

                    $form_data["upload-file-iniciativas"] = $newData;

                    $wpdb->update
                    (
                        $table_name,
                        array
                        ( 
                            'form_value' => serialize( $form_data )
                        ),
                        array
                        (
                            'form_id' => $insert_id
                        )
                    );
                }
            }
        }
    }

    public function add_filtros_biblioteca($post_id, $nameTerm, $tipoSlug)
    {
        if(is_array($nameTerm))
        {
            foreach($nameTerm as $term)
            {
                $termObj = get_term_by('name', $term, 'filtros');

                if($termObj == false)
                {
                    $termParent = get_term_by('slug', $tipoSlug, 'filtros');
                    $termObj = wp_insert_term( $term, 'filtros', array('parent'=> $termParent->term_id) );
                    $termID = $termObj['term_id'];
                }
                else
                    $termID = $termObj->term_id;

                wp_set_object_terms($post_id, $termID, 'filtros', true);
            }
        }
        else
        {
            $termObj = get_term_by('name', $nameTerm, 'filtros');

            if($termObj == false)
            {
                $termParent = get_term_by('slug', $tipoSlug, 'filtros');
                $termObj = wp_insert_term( $nameTerm, 'filtros', array('parent'=> $termParent->term_id) );

                $termID = $termObj['term_id'];
            }
            else
                $termID = $termObj->term_id;

            wp_set_object_terms($post_id, $termID, 'filtros', true);
        }
    }

    public function after_save_data_form_quiero_publicar($insert_id)
    {
        global $wpdb;

        $table_name = $wpdb->prefix.'db7_forms';

        $results    = $wpdb->get_results( "SELECT * FROM $table_name WHERE form_id = $insert_id LIMIT 1", OBJECT );

        if ( !empty($results) )
        {
            $form_data  = unserialize( $results[0]->form_value );

            if(isset($form_data["userID"]))
                $userID = $form_data["userID"];
            else
                $userID = 0;

            if(isset($form_data["quieroPublicar"]))
                $quieroPublicar = $form_data["quieroPublicar"];
            else
                $quieroPublicar = false;

            if($quieroPublicar == "true")
            {
                if($userID != 0)
                {
                    $post_id = wp_insert_post(array
                    (
                       'post_type' => 'propuestas',
                       'post_title' => $form_data['nombre-propuesta'],
                       'post_status' => 'publish',
                       'post_author' => $userID
                    ));

                    update_field('descripcion', $form_data['propuesta'], $post_id);
                    update_field('tipo', 'propuesta', $post_id);
                    update_field('id', $insert_id, $post_id);

                    $filename = $insert_id . '-' . $userID;
                    $cont = 1;

                    foreach($form_data["upload-file-propuestas"] as $fileURL)
                    {
                        $newFilename = $filename . '-' . $cont;

                        $moveFile = $this->move_files_to_uploads($fileURL, $newFilename, $insert_id);

                        $newData[$cont-1] = $moveFile;

                        $cont++;
                    }

                    $form_data["upload-file-propuestas"] = $newData;

                    $wpdb->update
                    (
                        $table_name,
                        array
                        ( 
                            'form_value' => serialize( $form_data )
                        ),
                        array
                        (
                            'form_id' => $insert_id
                        )
                    );
                }
            }
        }
    }

    public function after_save_data_form_subir_biblioteca($insert_id)
    {
        global $wpdb;

        $table_name = $wpdb->prefix.'db7_forms';

        $results    = $wpdb->get_results( "SELECT * FROM $table_name WHERE form_id = $insert_id LIMIT 1", OBJECT );

        if ( !empty($results) )
        {
            $form_data  = unserialize( $results[0]->form_value );

            if(isset($form_data["userID"]))
                $userID = $form_data["userID"];
            else
                $userID = 0;

            if(isset($form_data["archivoBiblioteca"]))
                $archivoBiblioteca  = $form_data["archivoBiblioteca"];
            else
                $archivoBiblioteca  = false;

            if($archivoBiblioteca  == "true")
            {
                if($userID != 0)
                {
                    $filename = $insert_id . '-' . $userID;
                    $cont = 1;

                    foreach($form_data["upload-file-biblioteca-tips"] as $fileURL)
                    {
                        $newFilename = $filename . '-' . $cont;

                        $moveFile = $this->move_files_to_uploads($fileURL, $newFilename, $insert_id, true);

                        $newData = $moveFile;
                    }

                    $form_data["upload-file-biblioteca-tips"] = $newData;

                    $post_id = wp_insert_post(array
                    (
                       'post_type' => 'biblioteca-tips',
                       'post_title' => $form_data['nombre-documento'],
                       'post_status' => 'pending',
                       'post_author' => $userID
                    ));

                    update_field('descripcion', $form_data['descripcion-documento'], $post_id);

                    if ( ! $newData['error'] )
                    {
                        $wp_filetype = wp_check_filetype( $newData['file'], null );

                        $attachment = array(
                            'post_mime_type' => $wp_filetype['type'],
                            'post_parent' => $post_id,
                            'post_title' => preg_replace('/\.[^.]+$/', '', $newData['file']),
                            'post_content' => '',
                            'post_status' => 'publish'
                        );

                        $attachment_id = wp_insert_attachment( $attachment, $newData['file'], $post_id );
                    }

                    $archivo = $form_data["upload-file-biblioteca-tips"]['url'];

                    $ext = pathinfo($archivo, PATHINFO_EXTENSION);

                    if($ext == 'pdf')
                    {
                        update_field('tipo_de_archivo', 'pdf', $post_id);
                        update_field('pdf', $attachment_id, $post_id);
                    }
                    else
                    {
                        update_field('tipo_de_archivo', 'imagen', $post_id);
                        update_field('imagen', $attachment_id, $post_id);
                    }

                    $this->add_filtros_biblioteca($post_id, $form_data['localidades'], 'localidad');

                    $this->add_filtros_biblioteca($post_id, $form_data['poblacion-diferencial'], 'grupo-poblacional');

                    $this->add_filtros_biblioteca($post_id, $form_data['organizaciones-ciudadanas'], 'organizaciones-ciudadanas');

                    $wpdb->update
                    (
                        $table_name,
                        array
                        ( 
                            'form_value' => serialize( $form_data )
                        ),
                        array
                        (
                            'form_id' => $insert_id
                        )
                    );
                }
            }
        }
    }

    public function get_db7_forms($formID)
    {
        global $wpdb;

        $table_name = $wpdb->prefix.'db7_forms';

        $results    = $wpdb->get_results( "SELECT * FROM $table_name WHERE form_id = $formID LIMIT 1", OBJECT );

        if ( !empty($results) )
        {
            $form_data['value']  = unserialize( $results[0]->form_value );
            $form_data['form_date']  = $results[0]->form_date;

            return $form_data;
        }
        else
            return false;
    }

    public function get_propuestas_user($userID, $page, $cant, $keyword=false)
    {
        if($keyword != false)
        {
            $args = array(
                'post_type'     => 'propuestas',
                's'             => $keyword,
                'relevanssi'    => true,
                'order'         => 'DESC',
                'posts_per_page'=> $cant, 
                'paged'         => $page, 
                'fields'        => 'ids',
                'post_status'   => array('publish'),
                'author__in'    => $userID,
            );
        }
        else
        {
            $args = array(
                'posts_per_page'  => $cant,
                'post_type'       => 'propuestas',
                'author__in'      => $userID,
                'post_status'     => array('publish'),   
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

                $cont++;
            }
        }
        else
            return false;

        wp_reset_postdata();

        return $objectPosts;
    }

    public function get_array_propuestas_user($userID, $page, $cant, $keyword)
    {
        $propuestas = $this->get_propuestas_user($userID, $page, $cant, $keyword);

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        if($propuestas != false)
        {
            $cont = 0;

            $objectPosts = new stdClass();

            $objectPosts->found_posts       = $propuestas->found_posts;
            $objectPosts->posts_per_page    = $propuestas->posts_per_page;

            $objectPosts->posts = array();

            for($i = 0; $i < $cant; $i++)
            {
                if(!isset($propuestas->posts[$i]['ID']))
                    break;
                
                $propuestaID = get_field('id', $propuestas->posts[$i]['ID']);

                $data = $this->get_db7_forms($propuestaID);

                if($data != false)
                {
                    $fechaTemp = $data['form_date'];
                    $result = [];

                    $result['ID'] = $propuestaID;

                    if(get_field('tipo', $propuestas->posts[$i]['ID']) == 'propuesta')
                    {
                        $result['titulo'] = $data['value']['nombre-propuesta'];
                        $result['organizaciones'] = implode(', ', $data['value']['organizaciones-ciudadanas']);
                        $result['descripcion'] = $data['value']['propuesta'];
                        $result['localidad'] = $data['value']['localidades'][0];
                        $result['archivos'] = $data['value']['upload-file-propuestas'];
                    }
                    else
                    {
                        $result['titulo'] = $data['value']['nombre_iniciativa'];
                        $result['descripcion'] = $data['value']['describe_iniciativa'];

                        $result['descripcionesExtra1'] = $data['value']['a_quienes_afecta_iniciativa'];
                        $result['descripcionesExtra2'] = $data['value']['potenciales_aliados_iniciativa'];

                        $result['localidad'] = $data['value']['localidades'][0];

                        $result['archivos'] = $data['value']['upload-file-iniciativas'];
                    }

                    $strTime= strtotime($fechaTemp);
                    $day    = date('j', $strTime);
                    $month  = $meses[date('n', $strTime) - 1];
                    $year   = date('Y', $strTime);
                    $hour   = date('g:i a', $strTime);

                    $result['date']         = $fechaTemp;

                    $result['fechaDay']     = $day;
                    $result['fechaMonth']   = substr($month, 0, 3);

                    $objectPosts->posts[$cont] = $result;
                    $cont++;
                }
            }
        }
        else
            return false;

        return $objectPosts;
    }

    public function get_propuestas_user_by_propuestaID($userID, $propuestaID)
    {
        $args = array(
            'post_type'       => 'propuestas',
            'author'          => $userID,
            'post_status'     => array('publish'),   
            'order'           => 'DESC',
            'orderby'         => 'date',
            'numberposts'     => -1,
            'fields'          => 'ids',
            'meta_key'        => 'id',
            'meta_value'      => $propuestaID,
        );

        $propuestas = get_posts( $args );

        return $propuestas;
    }
/*
    public function get_array_iniciativas_user($userID, $start, $cant)
    {
        $iniciativas = $this->get_propuestas_user($userID);

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $result = [];
        if($iniciativas != false)
        {
            $cont = 0;

            for($i = 0; $i < $cant; $i++)
            {
                if(!isset($iniciativas[$i]))
                    break;

                $iniciativaID = $iniciativas[$i];

                $data = $this->get_db7_forms($iniciativaID);

                if($data != false)
                {
                    $fechaTemp = $data['form_date'];

                    $result[$cont]['ID'] = $iniciativaID;

                    $result[$cont]['titulo'] = $data['value']['nombre_iniciativa'];
                    $result[$cont]['descripcion'] = $data['value']['describe_iniciativa'];
                    $result[$cont]['localidad'] = $data['value']['localidades'][0];

                    $result[$cont]['archivos'] = $data['value']['upload-file-iniciativas'];

                    $strTime= strtotime($fechaTemp);
                    $day    = date('j', $strTime);
                    $month  = $meses[date('n', $strTime) - 1];
                    $year   = date('Y', $strTime);
                    $hour   = date('g:i a', $strTime);

                    $result[$cont]['date']         = $fechaTemp;

                    $result[$cont]['fechaDay']     = $day;
                    $result[$cont]['fechaMonth']   = substr($month, 0, 3);
                    
                    $cont++;
                }
            }
        }

        return $result;
    }
*/
    public function init_actions()
    {
        add_action( 'init', [$this, 'acf_formulario_secciones_field'] );

        add_action( 'cfdb7_after_save_data', [$this, 'after_save_data_form_proponer_iniciativa'] );

        add_action( 'cfdb7_after_save_data', [$this, 'after_save_data_form_quiero_publicar'] );

        add_action( 'cfdb7_after_save_data', [$this, 'after_save_data_form_subir_biblioteca'] );

        add_action('wp_ajax_ajax_borrar_propuesta', array($this, 'ajax_borrar_propuesta'));
        add_action('wp_ajax_nopriv_ajax_borrar_propuesta', array($this, 'ajax_borrar_propuesta'));
    }

    public function before_save_data($form_data)
    {
        if( isset($form_data['userEmail']) )
        {
            $user = get_user_by( 'email', $form_data['userEmail'] );
            $userID = $user->ID;

            $form_data['userID'] = $userID;
        }
        return $form_data;
    }

    public function init_filters()
    {
        add_filter('cfdb7_before_save_data',[$this, 'before_save_data'] );
    }

    public function load_styles()
    {
    }

    public function load_scripts()
    {
    }

    public function acf_formulario_secciones_field()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63d068d6e0298',
            'title' => 'Formulario Secciones',
            'fields' => array(
                array(
                    'key' => 'field_63d068f23fca3',
                    'label' => 'Agregar formulario',
                    'name' => 'agregar_formulario',
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
                    'key' => 'field_63d069183fca4',
                    'label' => 'Ancho contenedor',
                    'name' => 'ancho_contenedor_formulario',
                    'type' => 'select',
                    'instructions' => 'Selecciona el ancho del contenedor, si quieres agregar 2 bloques uno al lado del otro tienes que cambiar el ancho en cada bloque.<br><br>Recuerda que el tamaño de los 2 bloques debe sumar "100"',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d068f23fca3',
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
                    'choices' => array(
                        100 => '100%',
                        90 => '90%',
                        80 => '80%',
                        70 => '70%',
                        60 => '60%',
                        50 => '50%',
                        40 => '40%',
                        30 => '30%',
                        20 => '20%',
                        10 => '10%',
                    ),
                    'default_value' => 100,
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_63d069184adb5',
                    'label' => 'Solo usuarios logeados pueden usar el formulario?',
                    'name' => 'only_user_logged',
                    'type' => 'button_group',
                    'instructions' => 'Seleccione "Si" para que solo los usuarios logeados pueden usar el formulario',
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
                    'key' => 'field_63d069623fca5',
                    'label' => 'Formulario',
                    'name' => 'formulario_contenedor_formulario',
                    'type' => 'acf_cf7',
                    'instructions' => 'Selecciona el formulario a mostrar',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d068f23fca3',
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
                        'value' => 'template-contactanos.php',
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

    public function ajax_borrar_propuesta()
    {
        $propuestaID  = intval(esc_attr($_POST["propuestaID"]));
        $userID       = intval(esc_attr($_POST["userID"]));

        if($userID != 0)
        {
            $postID = $this->get_propuestas_user_by_propuestaID($userID, $propuestaID);

            $data = wp_delete_post($postID[0], true); 

            if($data != false)
            {
                $type = 'info';
                $title = 'La propuesta fue eliminada';
            }
            else
            {
                $type = 'info';
                $title = 'La propuesta no se pudo eliminar';
            }
        }
        else
        {
            $type = 'error';
            $title = 'Tienes que estar logeado para borrar las propuestas';
        }

        $result['type'] = $type;
        $result['title'] = $title;
        $result['propuestaID'] = $propuestaID;
        $result['userID'] = $userID;

        $result = json_encode($result);
        echo $result;
        wp_die();
    }

    public function move_files_to_uploads($fileURL, $filename, $directoryName, $returnAll = false)
    {
        //global $wp_filesystem;
        //WP_Filesystem();

        $from = explode('/uploads/', $fileURL);
        $url = parse_url($fileURL);
        $ext = pathinfo($url['path'])['extension'];

        $newFilename = $filename . '.' . $ext;

        $newFile = wp_upload_bits($newFilename, null, file_get_contents($fileURL));

        if($newFile["url"])
        {
            if($returnAll == false)
                return $newFile["url"];
            else
                return $newFile;
        }
        else
            return false;
    }

    public function remove_path($file, $path)
    {
        if(strpos($file, $path) !== FALSE)
        {
            return substr($file, strlen($path));
        }
    }

    public function get_url_pagination($actualURL, $page, $keyword, $type)
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

    public function getUrlMimeType($url)
    {
        $buffer = file_get_contents($url);
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        return $finfo->buffer($buffer);
    }

}