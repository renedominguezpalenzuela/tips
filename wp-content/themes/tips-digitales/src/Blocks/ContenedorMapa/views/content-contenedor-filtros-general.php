<?php
    $etiquetasFilters = get_field('etiquetas_mapa');

    if(get_field('agregar_todas_localidades') == 'si')
    {
		$args = array (
			'taxonomy' => 'localidades',
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => false
		);

	    $localidadesFilters = get_terms($args);
    }
    else
    {
	    $localidadesFilters = get_field('localidades_mapa');
    }

    if(is_home() || is_front_page())
    {
    	$marginX = '';
    	$isHome = true;
    }
    else
    {
    	$marginX = 'mx-1 px-md-4';
    	$isHome = false;
    }
?>
	<div class="col-12 col-md-12">
		<div class="my-2 mb-3 pb-3 <?php echo $marginX; ?>">
			<?php
				if($isHome):
			?>
					<div class="col-12">
						<span class="title-home">¿Qué quieres ver</span>
						<br>
						<span class="title-home title-home-big">en tu territorio?</span>

						<div class="descripcion-home py-3">
							<?php echo get_field('desripcion_mapa'); ?>
						</div>
					</div>
			<?php
				endif;
			?>
			<div class="selector-filtros col-md-12 col-12 pt-0 d-block mx-auto">
				<div class="accordion" id="accordion_filtros_mapa_general_1">
					<div class="accordion-item p-0">
						<div class="accordion-header datos-curso-accordion" id="">
							<button id="principalFiltrosMapa_1" class="accordion-button-title accordion-button collapsed disabled" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosMapa_1" aria-expanded="false" aria-controls="collapseFiltrosMapa_1" data-temp='¿Qué deseas buscar?'>
								¿Qué deseas buscar?
							</button>
						</div>
						<div class="accordion-type-select">
							<div id="collapseFiltrosMapa_1" class="accordion-collapse accordion-collapse-filtros collapse collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
								<div class="accordion-body accordion-descripcion-scroll mt-3 mb-2 px-2">
									<?php
									foreach($etiquetasFilters as $taxElement):

										$term = get_term($taxElement);

										$taxElement = json_encode($taxElement);
										?>
										<button type="button" class="ElementFiltrosMapa_1 list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
											<?php echo $term->name; ?>
										</button>
										<?php
									endforeach;
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="selector-filtros col-md-12 col-12 pt-3 d-block mx-auto">
				<div class="accordion" id="accordion_filtros_mapa_general_2">
					<div class="accordion-item p-0">
						<div class="accordion-header datos-curso-accordion" id="">
							<button id="principalFiltrosMapa_2" class="accordion-button-title accordion-button collapsed" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosMapa_2" aria-expanded="false" aria-controls="collapseFiltrosMapa_2" data-temp='Todas las localidades'>
								Todas las localidades
							</button>
						</div>
						<div class="accordion-type-select">
							<div id="collapseFiltrosMapa_2" class="accordion-collapse accordion-collapse-filtros collapse collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
								<div class="accordion-body accordion-descripcion-scroll mt-3 mb-2 px-2">
									<?php
									foreach($localidadesFilters as $term):
										$taxElement = json_encode($term->term_id);
										?>
										<button type="button" class="ElementFiltrosMapa_2 list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
											<?php echo $term->name; ?>
										</button>
										<?php
									endforeach;
									?>
									<button type="button" class="ElementFiltrosMapa_2 list-group-item list-group-item-action" data-name="Todas las localidades" data-term="0">
										Todas las localidades
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="TipoSelected" data-name="¿Qué deseas buscar?" data-tipoid="">
            </div>

			<div id="LocalidadSelected" data-name="Localidad" data-tipoid="">
            </div>

			<div class="col-md-12 col-12 py-4 d-block mx-auto">
                <button class="wpcf7-form-control wpcf7-login btn btn-primary col-12 col-lg-8 float-end" id='removeAllMapaTags' type='button' disabled>Limpiar filtros</button>
            </div>
		</div>
	</div>
<?php

?>
