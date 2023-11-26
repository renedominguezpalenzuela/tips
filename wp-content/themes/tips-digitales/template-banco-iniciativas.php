 <?php
 /*
     Template Name: Banco de Iniciativas
     Template Post Type: secciones
 */
get_header();
?>

    <main id="primary" class="my-3 my-lg-2 pb-3 site-main border-container-secciones">

        <?php
            get_template_part( 'src/PostTypes/Secciones/views/content', 'seccion-banco-iniciativas' );
        ?>

    </main><!-- #main -->

<?php
get_sidebar();
get_footer();