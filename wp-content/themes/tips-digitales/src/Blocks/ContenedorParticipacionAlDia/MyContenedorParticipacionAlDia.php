<?php

if (!defined('ABSPATH')) { exit; }

class MyContenedorParticipacionAlDia
{
    private $name       = 'ParticipacionAlDia';
    private $slug       = 'ParticipacionAlDia';
    private $post_type  = 'ParticipacionAlDia';

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
        add_action( 'init', [$this, 'acf_participacion_field'] );
        add_action( 'init', [$this, 'acf_participacion_single_field'] );

        add_action('wp_ajax_ajax_noticias_by_localidad', array($this, 'ajax_noticias_by_localidad'));
        add_action('wp_ajax_nopriv_ajax_noticias_by_localidad', array($this, 'ajax_noticias_by_localidad'));

        add_action('wp_ajax_ajax_noticias_by_localidad_name', array($this, 'ajax_noticias_by_localidad_name'));
        add_action('wp_ajax_nopriv_ajax_noticias_by_localidad_name', array($this, 'ajax_noticias_by_localidad_name'));
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

    public function acf_participacion_field()
    {
        $id_home   = get_option('page_on_front');

        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63d00120670c0',
            'title' => 'Participación al día',
            'fields' => array(
                array(
                    'key' => 'field_63d00142e9e54',
                    'label' => 'Agregar bloque Participación al Día?',
                    'name' => 'agregar_participacion',
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
                        'si' => 'SI',
                        'no' => 'No',
                    ),
                    'allow_null' => 0,
                    'default_value' => 'no',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_63d00142f0f65',
                    'label' => 'Tipo de contenedor?',
                    'name' => 'tipo_contenedor',
                    'type' => 'button_group',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d00142e9e54',
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
                        'tipo-1' => 'Contenedor normal',
                        'tipo-2' => 'Contenedor por localidades',
                    ),
                    'allow_null' => 0,
                    'default_value' => 'tipo-1',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_63d00179e9e55',
                    'label' => 'Ancho contenedor',
                    'name' => 'ancho_contenedor_participacion_al_dia',
                    'type' => 'select',
                    'instructions' => 'Selecciona el ancho del contenedor, si quieres agregar 2 bloques uno al lado del otro tienes que cambiar el ancho en cada bloque.<br><br>Recuerda que el tamaño de los 2 bloques debe sumar "100"',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_63d00142e9e54',
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
                        'operator' => '!=',
                        'value' => 'template-donde-esta-tips.php',
                    ),
                    array(
                        'param' => 'post_template',
                        'operator' => '!=',
                        'value' => 'template-participacion-al-dia.php',
                    ),
                ),
                array(
                    array(
                        'param' => 'page',
                        'operator' => '==',
                        'value' => $id_home,
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

    public function acf_participacion_single_field()
    {
        if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63fe7ec9172fc',
            'title' => 'Participación al día',
            'fields' => array(
                array(
                    'key' => 'field_63fe7f0950879',
                    'label' => 'Diálogos ciudadanos',
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
                    'relevanssi_exclude' => 0,
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_63fe7f445087a',
                    'label' => 'Diálogos a mostrar',
                    'name' => 'dialogos_a_mostrar',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'default_value' => 4,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                ),
                array(
                    'key' => 'field_63fe7f735087b',
                    'label' => 'Noticias',
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
                    'relevanssi_exclude' => 0,
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_63fe7f825087c',
                    'label' => 'Noticias a mostrar',
                    'name' => 'noticias_a_mostrar',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'default_value' => 4,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                ),
                array(
                    'key' => 'field_63fe7f736198c',
                    'label' => 'Versión Impresa',
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
                    'relevanssi_exclude' => 0,
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_63fe7f736198d',
                    'label' => 'Periódicos a mostrar',
                    'name' => 'periodicos_a_mostrar',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'relevanssi_exclude' => 0,
                    'default_value' => 4,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                ),
                array(
                    'key' => 'field_63fe7f737209d',
                    'label' => 'Comité editorial',
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
                    'relevanssi_exclude' => 0,
                    'open' => 0,
                    'multi_expand' => 0,
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_642486c4353b1',
                    'label' => 'Funcionarios',
                    'name' => 'funcionarios',
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
                    'collapsed' => 'field_64248678353ad',
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'block',
                    'button_label' => 'Agregar funcionario',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_64248678353ad',
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
                            'key' => 'field_64248696353ae',
                            'label' => 'Subtitulo',
                            'name' => 'subtitulo',
                            'type' => 'text',
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
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_6424869f353af',
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
                            'new_lines' => '',
                        ),
                        array(
                            'key' => 'field_642486a9353b0',
                            'label' => 'Foto',
                            'name' => 'foto',
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
                            'return_format' => 'array',
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
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_template',
                        'operator' => '==',
                        'value' => 'template-participacion-al-dia.php',
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

    public function ajax_noticias_by_localidad()
    {
        $localidadID = esc_attr($_POST["localidad"]);

        $cat = get_category_by_slug('noticias'); 

        if($localidadID != 0)
        {
            $args = array(
                'post_type'      => 'post',
                'numberposts'    => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'fields'         => 'ids',
                'category__in'   => $cat->term_id,
                'post_status'    => 'publish',
                'tax_query' => array
                (
                    array
                    (
                      'taxonomy' => 'localidades',
                      'field' => 'term_id', 
                      'terms' => $localidadID
                    )
                )
            );
        }
        else
        {
            $args = array(
                'post_type'      => 'post',
                'numberposts'    => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'fields'         => 'ids',
                'category__in'   => $cat->term_id,
                'post_status'    => 'publish',
            );
        }

        $myPosts = get_posts($args);

        if( $myPosts )
        {
            ob_start();
            foreach ($myPosts as $myPost)
            {
                ?>
                    <div class="col-12 px-3 mb-2 localidad-<?php echo $myPost; ?>">
                      <div class="col-12 mb-2">
                        <img src="<?php echo get_field('miniatura', $myPost); ?>" class="img-fluid w-100 rounded d-block mx-auto">
                      </div>
                      <div class="col-12">
                        <a href="<?php echo get_the_permalink($myPost); ?>">
                          <h3 class="title-sidebar-related">
                            <?php echo get_the_title($myPost); ?>
                          </h3>
                        </a>
                        <div class="resume-sidebar-related pb-3">
                          <?php echo get_field('resumen', $myPost); ?>
                        </div>
                        <a href="<?php echo get_the_permalink($myPost); ?>" class="title-sidebar-related float-end">Leer más</a>

                        <div class="linea-divisoria pt-4"></div>
                      </div>
                    </div>
                <?php
            }
            $content = ob_get_clean();

            $result['type'] = 'success';
            $result['result'] = $content;
        }

        $result = json_encode($result);
        echo $result;
        wp_die();
    }

    public function ajax_noticias_by_localidad_name()
    {
        $localidadName = esc_attr($_POST["localidadName"]);

        $cat = get_category_by_slug('noticias'); 

        if($localidadName != '')
        {
            $localidadID = get_term_by('name', $localidadName, 'localidades')->term_id;

            $args = array(
                'post_type'      => 'post',
                'numberposts'    => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'fields'         => 'ids',
                'category__in'   => $cat->term_id,
                'post_status'    => 'publish',
                'tax_query' => array
                (
                    array
                    (
                      'taxonomy' => 'localidades',
                      'field' => 'term_id', 
                      'terms' => $localidadID
                    )
                )
            );
        }
        else
        {
            $args = array(
                'post_type'      => 'post',
                'numberposts'    => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'fields'         => 'ids',
                'category__in'   => $cat->term_id,
                'post_status'    => 'publish',
            );
        }

        $myPosts = get_posts($args);

        if( $myPosts )
        {
            ob_start();
            foreach ($myPosts as $myPost)
            {
                ?>
                    <div class="col-12 px-3 mb-2 localidad-<?php echo $myPost; ?>">
                      <div class="col-12 mb-2">
                        <img src="<?php echo get_field('miniatura', $myPost); ?>" class="img-fluid w-100 rounded d-block mx-auto">
                      </div>
                      <div class="col-12">
                        <a href="<?php echo get_the_permalink($myPost); ?>">
                          <h3 class="title-sidebar-related">
                            <?php echo get_the_title($myPost); ?>
                          </h3>
                        </a>
                        <div class="resume-sidebar-related pb-3">
                          <?php echo get_field('resumen', $myPost); ?>
                        </div>
                        <a href="<?php echo get_the_permalink($myPost); ?>" class="title-sidebar-related float-end">Leer más</a>

                        <div class="linea-divisoria pt-4"></div>
                      </div>
                    </div>
                <?php
            }
            $content = ob_get_clean();

            $result['type'] = 'success';
            $result['result'] = $content;
        }

        $result = json_encode($result);
        echo $result;
        wp_die();
    }

}