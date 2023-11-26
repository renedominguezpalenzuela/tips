<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package TIPS_Digitales
 */

get_header();
?>
<div class="site-main border-container-secciones">
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			<?php
				get_template_part( 'template-parts/content', 'search' );

			
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
	</div>
<?php
get_sidebar();
get_footer();
?>