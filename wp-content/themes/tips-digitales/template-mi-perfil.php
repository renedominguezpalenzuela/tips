 <?php
/*
     Template Name: Mi Perfil

*/
get_header();
?>
    <main id="primary" class="my-3 my-lg-2 pb-3 site-main border-container-secciones">
        <?php
            get_template_part( 'src/Blocks/ContenedorLoginRegister/views/content', 'mi-perfil' );
        ?>
    </main><!-- #main -->
<?php
get_sidebar();
get_footer();