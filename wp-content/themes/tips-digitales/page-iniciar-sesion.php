<?php
/**
 * The template for displaying page Login
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TIPS_Digitales
 */

get_header();
?>

	<main id="primary" class="my-3 my-lg-2 pb-3 site-main border-container-secciones">

		<?php
		while ( have_posts() ) :
			the_post();
		    require_once(SRC_PATH . 'BlocksContainer/MyBlocksContainer.php');

		    $bc = new MyBlocksContainer();
		    $bc->views_blocks_container('Login');

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
