<?php

?>

	    <div class="col-12 col-md-12">
	        <div class="col">
	        	<div class="container-map">
	                <div class="page-load-status-container-mapa container-fluid">
	                    <div class="loader-ellips infinite-scroll-request">
	                        <span class="loader-ellips__dot"></span>
	                        <span class="loader-ellips__dot"></span>
	                        <span class="loader-ellips__dot"></span>
	                        <span class="loader-ellips__dot"></span>
	                    </div>
	                </div>

	                <div class="container-loading-mapa">
	                </div>

				    <div class="" id="map" data-pageid="<?php echo get_the_ID(); ?>" data-type="<?php echo get_field('tipo_de_mapa', get_the_ID()); ?>">
			    	</div>
	        	</div>
	        </div>
	    </div>

        <!-- Modal -->
        <div class="modal modal-xl fade" id="mapaModalOtros" tabindex="-1" aria-labelledby="mapaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content-mapa">
                    <div class="modal-header">
                        <button type="button" class="btn-close btn-close-modalMapas" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="bodyModalMapa"></div>
                    </div>
                </div>
            </div>
        </div>

<?php
?>