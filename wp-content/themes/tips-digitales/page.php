<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TIPS_Digitales
 */

get_header();
?>

	<main id="primary" class="my-3 my-lg-2 pb-3 site-main border-container-secciones">

<?php 
?>
	    <div class="container-fluid">
	        <div class="row mx-md-3 my-5">
	            <div class="col-12 mb-3">
	                <div class="title-secciones-icon">
	                    <span class="iconWaterBlue"></span>
	                    <span class="iconWater"></span>
	                </div>

	                <h1 class="title-secciones px-md-4 px-2"><?php echo get_the_title(); ?></h1>
	                <div class="descripcion-secciones pt-3 px-md-4 px-2">
	                    <?php echo get_the_content(); ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
