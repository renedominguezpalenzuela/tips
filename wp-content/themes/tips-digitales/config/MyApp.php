<?php
if (!defined('ABSPATH')) { exit; }

class MyApp
{
    protected $app_name;
    protected $app_version;
    public $theme_settings;
    public $theme_options;

    /**
     *
     */
    public function __construct()
    {
        $this->define_constants();
        $this->app_version  = defined('APP_VERSION') ? APP_VERSION : '1.0.0';
        $this->app_name     = defined('APP_NAME') ? APP_NAME : 'tips_digitales';
    }

    /**
     *  should avoid broken site because if required plugins listed in REQUIRED_PLUGINS constant wouldn't be activated
     *
     * 
     */
    public function acf_dependency_notice()
    {
        ?>
            <div class='wrap'>
                <div class='error notice'>
                    <p class='notice-error'>El Plugin "Advance Custom Fields PRO" es obligatorio.</p>
                </div>
            </div>
        <?php
    }

    public function wp_rest_cache_dependency_notice()
    {
        ?>
            <div class='wrap'>
                <div class='error notice'>
                    <p class='notice-error'>El Plugin "WP Rest Cache" es obligatorio.</p>
                </div>
            </div>
        <?php
    }

    public function inspect_plugin_dependencies()
    {
        $dependencies = true;
        if (defined('REQUIRED_PLUGINS'))
        {
            if (!function_exists('is_plugin_active'))
            {
                include_once( ABSPATH . 'wp-admin/includes/plugin.php');
            }
            
            foreach (REQUIRED_PLUGINS as $pluginame => $value)
            {
                if (!is_plugin_active($value))
                {
                    if($pluginame == 'ACF')
                        add_action('admin_notices', array($this, 'acf_dependency_notice'));

                    if($pluginame == 'WP_REST_CACHE')
                        add_action('admin_notices', array($this, 'wp_rest_cache_dependency_notice'));

                    $dependencies = false;
                }
            }
        }
        
        return $dependencies;
    }

    /**
     * define_constants function
     *
     * @return void
     */
    private function define_constants()
    {
        $this->define('ENVIRONMENT','dev');
        $this->define('APP_NAME', 'tips_digitales');
        $this->define('APP_VERSION', '1.0.0');
        $this->define('APP_TEXTDOMAIN', 'tips_digitales');
        $this->define('APP_PATH', get_template_directory_uri(). '/');
        $this->define('APP_TEMPLATE_PATH', get_stylesheet_directory());
        $this->define('ASSETS_PUBLIC_PATH', get_template_directory_uri().'/public/');

        $this->define('REQUIRED_PLUGINS',array('ACF'=>'advanced-custom-fields-pro/acf.php'));

        $this->define('SRC_PATH', get_template_directory().'/src/');

        $dependencies = $this->inspect_plugin_dependencies();
        if ($dependencies){
            $this->theme_settings_init();
        }

        add_image_size( 'medium_carrusel', 600, 400, array( 'center', 'center' ) );
    }

    /**
     * define function
     *
     * @param [string] $name
     * @param [string] $value
     *
     * @return void
     */
    private function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    /**
     * run function
     *
     * @return void
     */
    public function init()
    {
        $this->init_vendor_classes();
        $this->init_src_classes();

        $this->init_filters();
    }

    /**
     * get_app_version function
     *
     * @return string app_version
     */
    public function get_app_version()
    {
        return $this->app_version;
    }

    /**
     * get_app_name function
     *
     * @return string app_name
     */
    public function get_app_name()
    {
        return $this->app_name;
    }

    /**
     * init function
     *
     * init all components hooks
     *
     * @return void
     */
    private function init_vendor_classes()
    {
        //$this->tinymce_plugins_init();
    }

    public function add_login_check()
    {
        if ( is_user_logged_in() )
        {
            if( is_page('iniciar-sesion') )
            {
                wp_redirect(home_url());
                exit;
            }
        }
    }

    private function init_src_classes()
    {
        $this->acf_init();
        $this->navwalker_init();
        $this->taxonomies_init();

        //Register Post Types
        $this->cursos_init();
        $this->secciones_init();
        $this->eventos_init();
        $this->yoparticipoensalud_init();
        $this->herramientas_init();
        $this->biblioteca_init();
        $this->asociaciones_init();
        $this->copacos_init();
        $this->veedurias_init();
        $this->noticias_init();
        $this->periodico_init();
        $this->propuestas_init();

        //Register blocks
        $this->contenedor_multimedia_init();
        $this->contenedor_formulario_init();
        $this->contenedor_timeline_init();
        $this->contenedor_dependencias_init();
        $this->contenedor_calendario_init();
        $this->contenedor_mapa_init();
        $this->contenedor_encuesta_init();

        $this->contenedor_participacion_al_dia_init();
        $this->contenedor_formulario_secciones_init();
        $this->contenedor_yoparticipoensalud_init();

        $this->contenedor_caja_herramientas_init();
        $this->contenedor_biblioteca_init();

        $this->contenedor_login_register_init();

        $this->contenedor_buzon_init();
    }

    private function acf_init()
    {
        require_once(SRC_PATH . 'Acf/MyAcf.php');

        $data = new MyAcf();
        $data->init();
    }

    private function taxonomies_init()
    {
        require_once(SRC_PATH . 'Taxonomies/MyTaxonomies.php');

        $data = new MyTaxonomies();
        $data->init();
    }

    private function navwalker_init()
    {
        if ( ! file_exists( SRC_PATH . 'Navwalker/MyNavwalker.php' ) )
        {
            return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the Navwalker/MyNavwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
        }
        else
        {
            require_once(SRC_PATH . 'Navwalker/MyNavwalker.php');
        }
    }

    private function cursos_init()
    {
        require_once(SRC_PATH . 'PostTypes/Cursos/MyCursos.php');

        $postsType = new MyCursos();
        $postsType->init();
    }

    private function secciones_init()
    {
        require_once(SRC_PATH . 'PostTypes/Secciones/MySecciones.php');

        $postsType = new MySecciones();
        $postsType->init();
    }

    private function eventos_init()
    {
        require_once(SRC_PATH . 'PostTypes/Eventos/MyEventos.php');

        $postsType = new MyEventos();
        $postsType->init();
    }

    private function yoparticipoensalud_init()
    {
        require_once(SRC_PATH . 'PostTypes/YoParticipoEnSalud/MyYoParticipoEnSalud.php');

        $postsType = new MyYoParticipoEnSalud();
        $postsType->init();
    }

    private function herramientas_init()
    {
        require_once(SRC_PATH . 'PostTypes/Herramientas/MyHerramientas.php');

        $postsType = new MyHerramientas();
        $postsType->init();
    }

    private function biblioteca_init()
    {
        require_once(SRC_PATH . 'PostTypes/Biblioteca/MyBiblioteca.php');

        $postsType = new MyBiblioteca();
        $postsType->init();
    }

    private function asociaciones_init()
    {
        require_once(SRC_PATH . 'PostTypes/Asociaciones/MyAsociaciones.php');

        $postsType = new MyAsociaciones();
        $postsType->init();
    }

    private function copacos_init()
    {
        require_once(SRC_PATH . 'PostTypes/COPACOS/MyCopacos.php');

        $postsType = new MyCopacos();
        $postsType->init();
    }

    private function veedurias_init()
    {
        require_once(SRC_PATH . 'PostTypes/Veedurias/MyVeedurias.php');

        $postsType = new MyVeedurias();
        $postsType->init();
    }

    private function noticias_init()
    {
        require_once(SRC_PATH . 'PostTypes/Noticias/MyNoticias.php');

        $postsType = new MyNoticias();
        $postsType->init();
    }

    private function propuestas_init()
    {
        require_once(SRC_PATH . 'PostTypes/Propuestas/MyPropuestas.php');

        $postsType = new MyPropuestas();
        $postsType->init();
    }

    private function periodico_init()
    {
        require_once(SRC_PATH . 'PostTypes/Periodico/MyPeriodico.php');

        $postsType = new MyPeriodico();
        $postsType->init();
    }

    private function contenedor_multimedia_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorMultimedia/MyContenedorMultimedia.php');

        $block = new MyContenedorMultimedia();
        $block->init();
    }

    private function contenedor_formulario_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorFormulario/MyContenedorFormulario.php');

        $block = new MyContenedorFormulario();
        $block->init();
    }

    private function contenedor_dependencias_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorDependencias/MyContenedorDependencias.php');

        $block = new MyContenedorDependencias();
        $block->init();
    }

    private function contenedor_timeline_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorTimeline/MyContenedorTimeline.php');

        $block = new MyContenedorTimeline();
        $block->init();
    }

    private function contenedor_calendario_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorCalendario/MyContenedorCalendario.php');

        $block = new MyContenedorCalendario();
        $block->init();
    }

    private function contenedor_mapa_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorMapa/MyContenedorMapa.php');

        $block = new MyContenedorMapa();
        $block->init();
    }

    private function contenedor_participacion_al_dia_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorParticipacionAlDia/MyContenedorParticipacionAlDia.php');

        $block = new MyContenedorParticipacionAlDia();
        $block->init();
    }

    private function contenedor_encuesta_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorEncuesta/MyContenedorEncuesta.php');

        $block = new MyContenedorEncuesta();
        $block->init();
    }


    private function contenedor_formulario_secciones_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorFormularioSecciones/MyContenedorFormularioSecciones.php');

        $block = new MyContenedorFormularioSecciones();
        $block->init();
    }

    private function contenedor_yoparticipoensalud_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorYoParticipoEnSalud/MyContenedorYoParticipoEnSalud.php');

        $block = new MyContenedorYoParticipoEnSalud();
        $block->init();
    }

    private function contenedor_caja_herramientas_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorCajaHerramientas/MyContenedorCajaHerramientas.php');

        $block = new MyContenedorCajaHerramientas();
        $block->init();
    }

    private function contenedor_biblioteca_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorBiblioteca/MyContenedorBiblioteca.php');

        $block = new MyContenedorBiblioteca();
        $block->init();
    }

    private function contenedor_login_register_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorLoginRegister/MyContenedorLoginRegister.php');

        $block = new MyContenedorLoginRegister();
        $block->init();
    }

    private function contenedor_buzon_init()
    {
        require_once(SRC_PATH . 'Blocks/ContenedorBuzon/MyContenedorBuzon.php');

        $block = new MyContenedorBuzon();
        $block->init();
    }        

    /**
     * theme settings init function
     * 
     */
    private function theme_settings_init()
    {
        $this->theme_support_init();
        $this->register_menus_init();

        $this->register_actions_init();
        $this->register_filters_init();
        $this->register_requires_init();
    }

    public function theme_support_init()
    {
        load_theme_textdomain( 'tips-digitales', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        add_theme_support( 'customize-selective-refresh-widgets' );
    }

    private function register_menus_init()
    {
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'tips' ),
        ) );

        register_nav_menus( array(
            'secondary' => __( 'Secondary Menu', 'tips-2' ),
        ) );

        register_nav_menus( array(
            'cursos' => __( 'Menu Cursos', 'cursos' ),
        ) );
    }

    private function register_actions_init()
    {
        //Remove redirect
        add_action( 'wp', array($this, 'add_login_check'));

        add_action( 'admin_init', array($this, 'block_wp_admin_to_subscribers'));
        add_action( 'login_head', array($this, 'change_login_wp_image'));

        add_action('login_init', array($this, 'no_weak_password_check'));
        add_action('admin_head', array($this, 'no_weak_password_check'));

        add_action('after_password_reset', array($this, 'wpse_lost_password_redirect'));

        add_action( 'wp_default_scripts', array($this, 'remove_jquery_migrate'));
        add_action( 'after_setup_theme', array($this, 'remove_admin_bar'));
        add_action( 'after_setup_theme', array($this, 'tips_digitales_content_width'), 0 );
        add_action( 'after_setup_theme', array($this, 'theme_support_init') );
        add_action( 'widgets_init', array($this, 'tips_digitales_widgets_init') );
        add_action( 'wp_print_styles', array($this, 'load_styles') );
        add_action( 'wp_enqueue_scripts', array($this, 'load_scripts') );
        add_action( 'wp_head', array($this, 'add_fonts_preload') );

        add_action( 'wp', array($this, 'only_logged_users') );

        add_action( 'wp_enqueue_scripts', function()
        {
            // Remove CSS on the front end.
            wp_dequeue_style( 'wp-block-library' );

            // Remove Gutenberg theme.
            wp_dequeue_style( 'wp-block-library-theme' );

            // Remove inline global CSS on the front end.
            wp_dequeue_style( 'global-styles' );
        }, 20 );

        add_action('login_head', array($this, 'login_fields_border'));

        add_role(
            'usuario_encargado', //  System name of the role.
            __( 'Encargado Iniciativas'  ), // Display name of the role.
            array(
                'read'  => true,
                'delete_posts'  => true,
                'delete_published_posts' => true,
                'edit_posts'   => true,
                'publish_posts' => true,
                'upload_files'  => true,
                'edit_pages'  => true,
                'edit_published_pages'  =>  true,
                'publish_pages'  => true,
                'delete_published_pages' => false, // This user will NOT be able to  delete published pages.
            )
        );
    }

    public function login_fields_border()
    {
        echo '<style>button.button.wp-generate-pw.hide-if-no-js{display: none !important;}</style>';
    }

    public function wpse_lost_password_redirect()
    {
        $url = get_permalink( get_page_by_path( 'iniciar-sesion' ) );

        wp_redirect( $url ); 
        exit;
    }

    public function only_logged_users()
    {
        if(!is_user_logged_in())
        {
            if ( is_page('mi-perfil') )
            {
                $url = get_permalink( get_page_by_path( 'iniciar-sesion' ) );

                wp_redirect( $url ); 
                exit;
            }
        }
    }

    private function register_filters_init()
    {
        add_filter('script_loader_tag', array($this, 'add_async_or_defer_scripts'), 10, 2);
        add_filter( 'style_loader_tag', array($this, 'add_preload_css'), 10, 4);
        add_filter( 'nav_menu_css_class', array($this, 'special_nav_class'), 10, 3 );
        add_filter( 'nav_menu_link_attributes', array($this, 'prefix_bs5_dropdown_data_attribute'), 20, 3 );

        // Disable Gutenberg on the back end.
        add_filter( 'use_block_editor_for_post', '__return_false' );

        // Disable Gutenberg for widgets.
        add_filter( 'use_widgets_block_editor', '__return_false' );

        add_filter( 'nav_menu_submenu_css_class', array($this, 'nav_menu_submenu_css_class') );

        add_filter( 'nav_menu_link_attributes', array($this, 'my_wp_nav_menu_objects'), 20, 3 );

        add_filter( 'login_message', array($this, 'change_update_pass_message') );

        add_filter( 'wpcf7_form_tag', array($this, 'cf7_add_organizaciones_ciudadanas'), 10, 2);

        add_filter( 'wpcf7_form_tag', array($this, 'cf7_add_localidades'), 10, 2);

        add_filter( 'wpcf7_form_tag', array($this, 'cf7_add_poblacion_diferencial'), 10, 2);

        add_filter( 'wp_pagenavi', array($this, 'wiaw_pagenavi_to_bootstrap'), 10, 2 );

        add_filter( 'random_password', array($this, 'disable_random_password'), 10, 2 );

//Filtros para Relevanssi, ayuda a buscar los posts de tipo "biblioteca-tips" cuando estan con estatus pendiente
        add_filter( 'relevanssi_valid_status', array($this, 'include_pending_posts') );
        add_filter( 'relevanssi_post_ok', array($this, 'pending_posts_only_biblioteca_tips'), 11, 2 );

        add_filter('pre_get_posts', array($this, 'searchfilter'));

//Filtros Plugin mensajeria
        add_filter('better_messages_rest_user_item', array($this, 'custom_user_data_chat'), 20, 3);
    }

    public function disable_random_password( $password )
    {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : '';
        if ( 'wp-login.php' === $GLOBALS['pagenow'] && ( 'rp' == $action  || 'resetpass' == $action ) ) {
            return '';
        }
        return $password;
    }
    
    public function custom_user_data_chat($item, $user_id, $include_personal)
    {
        $item['name'] = get_user_meta($user_id, 'first_name', true);
        $item['url'] = false;

        $avatar_url = get_user_meta($user_id, 'user_foto', true);

        if($avatar_url == '')
            $avatar_url = get_template_directory_uri() . '/public/images/avatar-default.png';

        if ($avatar_url)
        {
            $item['avatar'] = $avatar_url;
        }

        return $item;
    }

    public function searchfilter($query)
    {
        if ($query->is_search && !is_admin() )
        {
            $query->set('post_status',array('publish'));
        }

        return $query;
    }

    public function include_pending_posts( $status_array )
    {
        return array( 'publish', 'pending' );
    }

    public function pending_posts_only_biblioteca_tips( $post_ok, $post_id )
    {
        $status = relevanssi_get_post_status( $post_id );
        
        if ( 'pending' === $status )
        {
            if(get_post_type($post_id) == 'biblioteca-tips')
                $post_ok = true;
            else
                $post_ok = false;
        }

        return $post_ok;
    }

    public function change_update_pass_message( $message )
    {
        $message = '';

        return $message;
    }
    
    public function my_wp_nav_menu_objects( $atts, $item, $args )
    {
        if( in_array( 'menuItemParentIMG', $item->classes ) )
        {
            $attr = get_field('atributo', $item->ID);
            if( $attr )
            {
                $atts['data-hover'] = $attr;
            }
        }

        return $atts;
    }

    public function wpsites_modify_comment_form_text_area($arg)
    {
        $arg['must_log_in'] = sprintf( 
            __( '<p class="must-log-in">
                     You must <a href="%s">Register</a> or 
                     <a href="%s">Login</a> to post a comment.</p>' 
            ),
            wp_registration_url(),
            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )   
        );

        return $arg;
    }

    private function register_requires_init()
    {        
        /**
         * Implement the Custom Header feature.
         */
        require get_template_directory() . '/inc/custom-header.php';

        /**
         * Custom template tags for this theme.
         */
        require get_template_directory() . '/inc/template-tags.php';

        /**
         * Functions which enhance the theme by hooking into WordPress.
         */
        require get_template_directory() . '/inc/template-functions.php';

        /**
         * Customizer additions.
         */
        require get_template_directory() . '/inc/customizer.php';

        /**
         * Load Jetpack compatibility file.
         */
        if ( defined( 'JETPACK__VERSION' ) ) {
            require get_template_directory() . '/inc/jetpack.php';
        }

    }

    public function remove_admin_bar()
    {
        if (!is_admin())
        {
          show_admin_bar(false);
        }
    }

    public function change_login_wp_image()
    {
        echo '<style type="text/css">
        .login h1 a {
        background-image:url('. get_template_directory_uri() . '/public/images/logo.png' . ') !important;
        background-size: 100px auto !important;
        }
        </style>';
    }

    public function no_weak_password_check()
    {
        echo '<style type="text/css">
        .pw-weak {
            display:none!important;
        }
        #nav {
            display:none!important;
        }</style>';

        wp_register_script('reset-password', ASSETS_PUBLIC_PATH . 'js/reset-password.js', array(), APP_VERSION, true );

        wp_enqueue_script('reset-password');
    }

    public function tips_digitales_content_width()
    {
        $GLOBALS['content_width'] = apply_filters( 'tips_digitales_content_width', 640 );
    }

    public function tips_digitales_widgets_init()
    {
        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'tips-digitales' ),
                'id'            => 'sidebar-1',
                'description'   => esc_html__( 'Add widgets here.', 'tips-digitales' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }

    public function load_styles()
    {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'classic-theme-styles' );

        if(!is_admin())
        {
            wp_enqueue_style( 'bootstrap', ASSETS_PUBLIC_PATH . 'css/bootstrap.min.css');
            wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v6.2.1/css/all.css');

            wp_enqueue_style( 'style', ASSETS_PUBLIC_PATH . 'css/styles.css', array(), APP_VERSION );

            wp_deregister_style( 'dashicons' );
        }
    }

    public function load_scripts()
    {
        if(!is_admin())
        {
            wp_enqueue_script('jquery');

            wp_register_script('bootstrap', ASSETS_PUBLIC_PATH . 'js/bootstrap.bundle.min.js', array(), APP_VERSION, true );
            wp_enqueue_script('bootstrap');

            wp_register_script('scripts', ASSETS_PUBLIC_PATH . 'js/scripts.js', array(), APP_VERSION, true );
            wp_enqueue_script('scripts');

            wp_dequeue_script( 'google-recaptcha' );
            wp_dequeue_script( 'wpcf7-recaptcha' );

            if(is_single('conoce-al-equipo-de-participacion') || is_page('mi-perfil'))
            {
                wp_register_script('html2pdf', ASSETS_PUBLIC_PATH . 'js/html2pdf.bundle.min.js', array(), APP_VERSION, true );
                wp_enqueue_script('html2pdf');
            }
        }
        else
        {

        }

        /*
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }
        */
    }

    public function add_fonts_preload()
    {
        //Klavika
        echo '<link rel="preload" href="'.ASSETS_PUBLIC_PATH.'fonts/Klavika/KlavikaLight-Plain.otf" as="font" type="font/otf" crossorigin>';

        echo '<link rel="preload" href="'.ASSETS_PUBLIC_PATH.'fonts/Klavika/KlavikaRegular-TF.otf" as="font" type="font/otf" crossorigin>';

        echo '<link rel="preload" href="'.ASSETS_PUBLIC_PATH.'fonts/Klavika/KlavikaMedium-TF.otf" as="font" type="font/otf" crossorigin>';

        echo '<link rel="preload" href="'.ASSETS_PUBLIC_PATH.'fonts/Klavika/KlavikaBoldBold.otf" as="font" type="font/otf" crossorigin>';

        //MuseoSans
        echo '<link rel="preload" href="'.ASSETS_PUBLIC_PATH.'fonts/MuseoSans/MuseoSans_300.otf" as="font" type="font/otf" crossorigin>';

        echo '<link rel="preload" href="'.ASSETS_PUBLIC_PATH.'fonts/MuseoSans/MuseoSans_700.otf" as="font" type="font/otf" crossorigin>';

        //FontAwesome
        echo '<link rel="preload" href="https://use.fontawesome.com/releases/v6.2.1/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin>';

        echo '<link rel="preload" href="https://use.fontawesome.com/releases/v6.2.1/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>';

    }

    public function add_preload_css($html, $handle, $href, $media)
    {
        if(!is_admin())
                $html = '<link rel="preload" href="'.$href.'" as="style">'.$html;

        return $html;
    }

    public function add_async_or_defer_scripts($tag, $handle)
    {
        $noDefer = array('');

        if (is_admin() || in_array($handle, $noDefer))
            return $tag;

        return str_replace(' src', ' defer="defer" src', $tag);
    }

    public function special_nav_class( $classes, $item, $args )
    {
        if ( 'menu-header' === $args->menu->slug )
        {
            $classes[] = 'menu-item-circle';
        }

        if ( 'menu-header-derecha' === $args->menu->slug )
        {
            $classes[] = 'menu-derecha-item-circle text-lg-end';
        }

        if ( 'menu-cursos' === $args->menu->slug)
        {
            if($item->menu_item_parent == 0)
            {
                if($item->menu_image_icon_type == "")
                {
                    if(is_single())
                    {
                        if(get_post_type() == "secciones")
                        {
                            $parentID = wp_get_post_parent_id(get_the_ID());

                            if ($parentID == $item->object_id)
                            {
                                $classes[] = 'col-5-elements menu-item-cursos menu-item-cursos-active';
                            }
                            else
                                $classes[] = 'col-5-elements menu-item-cursos';
                        }
                        else if(get_post_type() == "cursos")
                        {
                            $terms = wp_get_post_terms(get_the_ID(), 'seccion', array( 'parent' => 0, 'fields' => 'names'));

                            if ( $terms != null )
                            {
                                foreach( $terms as $term )
                                {
                                    if (strcmp($item->title, $term) !== 0)
                                        $classes[] = 'col-5-elements menu-item-cursos';
                                    else
                                        $classes[] = 'col-5-elements menu-item-cursos menu-item-cursos-active';
                                }
                            }
                            else
                                $classes[] = 'col-5-elements menu-item-cursos';
                        }
                        else
                            $classes[] = 'col-5-elements menu-item-cursos';
                    }
                    else
                        $classes[] = 'col-5-elements menu-item-cursos';
                }
            }
            else
                $classes[] = 'menu-item-cursos';

        }

        return $classes;
    }

    /**
     * Use namespaced data attribute for Bootstrap's dropdown toggles.
     *
     * @param array    $atts HTML attributes applied to the item's `<a>` element.
     * @param WP_Post  $item The current menu item.
     * @param stdClass $args An object of wp_nav_menu() arguments.
     * @return array
     */
    public function prefix_bs5_dropdown_data_attribute( $atts, $item, $args )
    {
        if ( is_a( $args->walker, 'MyNavwalker' ) ) {
            if ( array_key_exists( 'data-toggle', $atts ) ) {
                unset( $atts['data-toggle'] );
                $atts['data-bs-toggle'] = 'dropdown';
            }
        }
        return $atts;
    }

    public function nav_menu_submenu_css_class( $classes )
    {
        $classes[] = 'new-submenu-class';
        return $classes;
    }

    public function init_filters()
    {
        add_filter('acf/fields/post_object/query',[$this, 'post_status_options_filter'], 10, 3);
        add_filter('acf/fields/relationship/query',[$this, 'post_status_options_filter'], 10, 3);
        add_filter('acf/fields/page_link/query',[$this, 'post_status_options_filter'], 10, 3);

        add_filter( 'wp_rest_cache/allowed_endpoints', [$this, 'wprc_add_acf_posts_endpoint'], 10, 1);

    }

    public function post_status_options_filter($options, $field, $the_post)
    {
        $options['post_status'] = array('publish');
        return $options;
    }

    public function block_wp_admin_to_subscribers()
    {
        if ( wp_doing_ajax() || ! is_user_logged_in() ) {
            return;
        }

        $roles = (array) wp_get_current_user()->roles;

        if ( in_array( 'administrator', $roles ) )
            $enterAdmin = true;
        else if ( in_array( 'usuario_encargado', $roles ) )
            $enterAdmin = true;
        else
            $enterAdmin = false;

        if($enterAdmin == false)
        {
            wp_redirect(home_url());
            exit;
        }
    }

    public function remove_jquery_migrate( $scripts )
    {
        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) )
        {
            $script = $scripts->registered['jquery'];
            
            if ( ! empty( $script->deps ) )
            {
                $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
            }
        }
    }

    public function wprc_add_acf_posts_endpoint( $allowed_endpoints )
    {
        if ( ! isset( $allowed_endpoints[ 'contact-form-7/v1' ] ) || ! in_array( 'contact-forms', $allowed_endpoints[ 'contact-form-7/v1' ] ) ) {
            $allowed_endpoints[ 'contact-form-7/v1' ][] = 'contact-forms';
        }

        return $allowed_endpoints;
    }

    //Inserta en los Selects de los formularios las taxonomias Organizaciones Ciudadanas
    public function cf7_add_organizaciones_ciudadanas( $scanned_tag, $replace )
    {  
        if ( $scanned_tag['name'] != 'organizaciones-ciudadanas' )  
            return $scanned_tag;

        $arguments = array
        (
            'taxonomy' => 'organizaciones-ciudadanas',
            'orderby' => 'ID',
            'order' => 'ASC',
            'hide_empty' => false
        );

        $taxTerms = get_terms($arguments);

        if ( ! $taxTerms )  
            return $scanned_tag;

        foreach($taxTerms as $term)
        {
            $scanned_tag['raw_values'][] = $term->name;
        }

        $pipes = new WPCF7_Pipes($scanned_tag['raw_values']);

        $scanned_tag['values'] = $pipes->collect_befores();
        $scanned_tag['labels'] = $pipes->collect_afters();
        $scanned_tag['pipes'] = $pipes;
      
        return $scanned_tag;  
    }

    //Inserta en los Selects de los formularios las taxonomias Localidades
    public function cf7_add_localidades( $scanned_tag, $replace )
    {  
        if ( $scanned_tag['name'] != 'localidades' )  
            return $scanned_tag;

        $arguments = array
        (
            'taxonomy' => 'localidades',
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false
        );

        $taxTerms = get_terms($arguments);

        if ( ! $taxTerms )  
            return $scanned_tag;

        foreach($taxTerms as $term)
        {
            $scanned_tag['raw_values'][] = $term->name;
        }

        $pipes = new WPCF7_Pipes($scanned_tag['raw_values']);

        $scanned_tag['values'] = $pipes->collect_befores();
        $scanned_tag['labels'] = $pipes->collect_afters();
        $scanned_tag['pipes'] = $pipes;
      
        return $scanned_tag;  
    }

    //Inserta en los Selects de los formularios las taxonomias Poblacion Diferencial
    public function cf7_add_poblacion_diferencial( $scanned_tag, $replace )
    {  
        if ( $scanned_tag['name'] != 'poblacion-diferencial' )  
            return $scanned_tag;

        $arguments = array
        (
            'taxonomy' => 'poblacion-diferencial',
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false
        );

        $taxTerms = get_terms($arguments);

        if ( ! $taxTerms )  
            return $scanned_tag;

        foreach($taxTerms as $term)
        {
            $scanned_tag['raw_values'][] = $term->name;
        }

        $pipes = new WPCF7_Pipes($scanned_tag['raw_values']);

        $scanned_tag['values'] = $pipes->collect_befores();
        $scanned_tag['labels'] = $pipes->collect_afters();
        $scanned_tag['pipes'] = $pipes;
      
        return $scanned_tag;  
    }

    function wiaw_pagenavi_to_bootstrap($html)
    {
        $out = '';
        $out = str_replace('<div','',$html);
        $out = str_replace('class=\'wp-pagenavi\' role=\'navigation\'>','',$out);
        $out = str_replace('<a','<li class="page-item"><a class="page-link"',$out);
        $out = str_replace('</a>','</a></li>',$out);
        $out = str_replace('<span aria-current=\'page\' class=\'current\'','<li aria-current="page" class="page-item active"><span class="page-link current"',$out);
        $out = str_replace('<span class=\'pages\'','<li class="page-item"><span class="page-link pages"',$out);
        $out = str_replace('<span class=\'extend\'','<li class="page-item"><span class="page-link extend"',$out);  
        $out = str_replace('</span>','</span></li>',$out);
        $out = str_replace('</div>','',$out);
        return '<ul class="pagination justify-content-center" role="navigation">'.$out.'</ul>';
    }
}

?>