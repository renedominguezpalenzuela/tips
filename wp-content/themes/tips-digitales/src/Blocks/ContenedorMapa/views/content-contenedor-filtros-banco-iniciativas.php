<?php
    $tematicasFilters = get_field('tematica_mapa_iniciativas');
    $grupoPoblacionalFilters = get_field('grupo_poblacional_mapa_iniciativas');

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
?>
	<div class="col-12 col-md-12">
		<div class="my-2 mb-3 mx-1 px-md-4 pb-3">

			<div class="selector-filtros col-md-12 col-12 pt-0 d-block mx-auto">
				<div class="accordion" id="accordion_filtros_mapa_iniciativas_2">
					<div class="accordion-item p-0">
						<div class="accordion-header datos-curso-accordion" id="">
							<button id="principalFiltrosMapaIniciativas_2" class="accordion-button-title accordion-button collapsed disabled" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosMapaIniciativas_2" aria-expanded="false" aria-controls="collapseFiltrosMapaIniciativas_2" data-temp='Por ubicación'>
								Por ubicación
							</button>
						</div>
						<div class="accordion-type-select">
							<div id="collapseFiltrosMapaIniciativas_2" class="accordion-collapse accordion-collapse-filtros collapse collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
								<div class="accordion-body accordion-descripcion-scroll mt-3 mb-2 px-2">
									<?php
									foreach($localidadesFilters as $term):
										$taxElement = json_encode($term->term_id);
										?>
										<button type="button" class="ElementFiltrosMapaIniciativas_2 list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
											<?php echo $term->name; ?>
										</button>
										<?php
									endforeach;
									?>
									<button type="button" class="ElementFiltrosMapaIniciativas_2 list-group-item list-group-item-action" data-name="Todas las localidades" data-term="0">
										Todas las localidades
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="selector-filtros col-md-12 col-12 pt-3 d-block mx-auto">
				<div class="accordion" id="accordion_filtros_mapa_iniciativas_1">
					<div class="accordion-item p-0">
						<div class="accordion-header datos-curso-accordion" id="">
							<button id="principalFiltrosMapaIniciativas_1" class="accordion-button-title accordion-button collapsed disabled" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosMapaIniciativas_1" aria-expanded="false" aria-controls="collapseFiltrosMapaIniciativas_1" data-temp='Por temática'>
								Por temática
							</button>
						</div>
						<div class="accordion-type-select">
							<div id="collapseFiltrosMapaIniciativas_1" class="accordion-collapse accordion-collapse-filtros collapse collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
								<div class="accordion-body accordion-descripcion-scroll mt-3 mb-2 px-2">
									<?php
									foreach($tematicasFilters as $taxElement):

										$term = get_term($taxElement);

										$taxElement = json_encode($taxElement);
										?>
										<button type="button" class="ElementFiltrosMapaIniciativas_1 list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
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
				<div class="accordion" id="accordion_filtros_mapa_iniciativas_3">
					<div class="accordion-item p-0">
						<div class="accordion-header datos-curso-accordion" id="">
							<button id="principalFiltrosMapaIniciativas_3" class="accordion-button-title accordion-button collapsed disabled" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosMapaIniciativas_3" aria-expanded="false" aria-controls="collapseFiltrosMapaIniciativas_3" data-temp='Por grupo poblacional'>
								Por grupo poblacional
							</button>
						</div>
						<div class="accordion-type-select">
							<div id="collapseFiltrosMapaIniciativas_3" class="accordion-collapse accordion-collapse-filtros collapse collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
								<div class="accordion-body accordion-descripcion-scroll mt-3 mb-2 px-2">
									<?php
									foreach($grupoPoblacionalFilters as $taxElement):

										$term = get_term($taxElement);

										$taxElement = json_encode($taxElement);
										?>
										<button type="button" class="ElementFiltrosMapaIniciativas_3 list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
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

			<div id="LocalidadSelected" data-name="Por ubicación" data-tipoid="">
            </div>

			<div id="TematicaSelected" data-name="Por tematica" data-tipoid="">
            </div>

			<div id="GrupoPoblacionalSelected" data-name="Por grupo poblacional" data-tipoid="">
            </div>

			<div class="col-md-12 col-12 py-4 d-block mx-auto">
                <button class="wpcf7-form-control wpcf7-login btn btn-primary col-12 col-lg-8 float-end" id='removeAllMapaTags' type='button' disabled>Limpiar filtros</button>
            </div>
		</div>
	</div>
<?php

?>
