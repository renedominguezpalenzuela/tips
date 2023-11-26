<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TIPS_Digitales
 */
?>

	<footer id="colophon" class="site-footer">
		<?php get_template_part('template-parts/footer/content', 'footer'); ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php
    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');

    $container = new MyBlocksContainer();

    $container->views_blocks_container('ContenedorMultimedia');

    if(is_singular('cursos'))
        $container->views_blocks_container('ContenedorFormulario');

    if(is_page('iniciar-sesion'))
    {
        $container->views_blocks_container('Register');
        $container->views_blocks_container('RecoverPass');
    }
?>
    <script>
      var ajaxURL = '<?php echo admin_url('admin-ajax.php'); ?>';
      var loginURL = '<?php echo get_permalink(get_page_by_path('iniciar-sesion')); ?>';

    </script>

    <div id="googleMapsURI" data-src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_field('google_maps_apikey', 'option'); ?>&libraries=geometry&callback=initMap">
    </div>
</body>
</html>
