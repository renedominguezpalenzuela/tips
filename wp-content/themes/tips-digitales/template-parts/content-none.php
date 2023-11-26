<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TIPS_Digitales
 */

?>

<div class="container">
  <div class="container">
    <div class="d-flex px-2 px-md-2 pt-5 pb-3">
      <span class="iconInfo"></span>
      <h3 class="title-container-yoparticipoensalud px-2">
      	<?php
				/* translators: %s: search query. */
			   printf( esc_html__( 'Lo sentimos no pudimos encontrar resultados sobre: "%s"', 'tips-digitales' ), '<span>' . get_search_query() . '</span>' );
				?>
		  </h3>
		</div>
	</div>

        <div class="col-12">
          <div class="d-flex justify-content-center my-3">
            <h3 class="title-container-yoparticipoensalud px-2">
  		        Tal vez puedas encontrar resultados adicionales en nuestro mapa
            </h3>
  		    </div>
          <div class="container">
            <div class="d-flex justify-content-center my-3 py-4">
              <a href="
              <?php echo get_bloginfo('url') . '/secciones/donde-esta-tips-en-bogota/'; ?>" class="btn btn-tabs-buttons yellow col-md-3 col-12 px-3">
                Ver Mapa
              </a>
            </div>
          </div>
        </div>

</div>