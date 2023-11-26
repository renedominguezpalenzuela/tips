<?php
	$nameFilter = get_field('nombre_filtro');

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

    require_once(SRC_PATH . 'Blocks/ContenedorMapa/MyContenedorMapa.php');
    $mapa = new MyContenedorMapa();

    $dataMap = $mapa->get_data_map(get_the_ID());
	
	$objectMapElements = new stdClass();
	$cont = 0;

	foreach($localidadesFilters as $localidad)
	{
	   	foreach($dataMap as $term)
	   	{
	   		if($term['Localidad'] == $localidad->name)
	   		{
		   		$objectMapElements->puntos[$cont]["Nombre"] = $term['Nombre'];
		   		$objectMapElements->puntos[$cont]["Localidad"] = $term['Localidad'];
		   		$objectMapElements->puntos[$cont]["LocalidadID"] = $localidad->term_id;

				$cont++;
	   		}
	   	}
	}

?>
	<div class="col-12 col-md-12">
		<div class="mb-3 mx-1 px-md-4 pb-3">
			<div class="selector-filtros col-md-12 col-12 d-block mx-auto">
				<div class="accordion" id="accordion_filtros_mapa_otros_1">
					<div class="accordion-item p-0">
						<div class="accordion-header datos-curso-accordion" id="">
							<button id="principalFiltrosMapaOtros_1" class="accordion-button-title accordion-button collapsed disabled" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosMapaOtros_1" aria-expanded="false" aria-controls="collapseFiltrosMapaOtros_1" data-temp='Por ubicación'>
								Por ubicación
							</button>
						</div>
						<div class="accordion-type-select">
							<div id="collapseFiltrosMapaOtros_1" class="accordion-collapse accordion-collapse-filtros collapse collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
								<div class="accordion-body accordion-descripcion-scroll mt-3 mb-2 px-2">
									<?php
									foreach($localidadesFilters as $term):
										$taxElement = json_encode($term->term_id);
										?>
										<button type="button" class="ElementFiltrosMapaOtros_1 list-group-item list-group-item-action" data-name="<?php echo $term->name; ?>" data-term="<?php echo $taxElement; ?>">
											<?php echo $term->name; ?>
										</button>
										<?php
									endforeach;
									?>
									<button type="button" class="ElementFiltrosMapaOtros_1 list-group-item list-group-item-action" data-name="Todas las localidades" data-term="0">
										Todas las localidades
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="selector-filtros col-md-12 col-12 pt-4 d-block mx-auto">
				<div class="accordion" id="accordion_filtros_mapa_otros_2">
					<div class="accordion-item p-0">
						<div class="accordion-header datos-curso-accordion" id="">
							<button id="principalFiltrosMapaOtros_2" class="accordion-button-title accordion-button collapsed disabled" type="button" data-name="Eventos" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosMapaOtros_2" aria-expanded="false" aria-controls="collapseFiltrosMapaOtros_2" data-temp='<?php echo $nameFilter; ?>'>
								<?php echo $nameFilter; ?>
							</button>
						</div>
						<div class="accordion-type-select">
							<div id="collapseFiltrosMapaOtros_2" class="accordion-collapse accordion-collapse-filtros collapse collapseSelect" aria-labelledby="headingOne" data-bs-parent=".accordion" style="">
								<div class="accordion-body accordion-descripcion-scroll mt-3 mb-2 px-2">
									<?php
									foreach($objectMapElements->puntos as $term):

										$taxElement = json_encode($term["LocalidadID"]);
										?>
										<button type="button" class="ElementFiltrosMapaOtros_2 list-group-item list-group-item-action" data-name="<?php echo $term["Nombre"]; ?>" data-term="<?php echo $taxElement; ?>">
											<?php echo $term["Nombre"]; ?>
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


			<div id="filterOtroSelected" data-name="<?php echo $nameFilter; ?>" data-tipoid="">
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
