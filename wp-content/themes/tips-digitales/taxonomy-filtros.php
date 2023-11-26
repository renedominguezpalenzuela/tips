<?php
	$term = get_queried_object();
	$paged = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
	$posts_per_page = 8;

	if(isset($_GET['ID']))
	{
		$args = array
		(
			'post_type' 	=> 'biblioteca-tips',
			'order'     	=> 'DESC',
			'orderby'		=> 'date',
	        'posts_per_page'=> 1, 
			'fields'        => 'ids',
			'post_status'   => 'publish',
			'p'				=> $_GET['ID']
		);

	}
	else
	{
		if(isset($_GET['keyword']))
		{
			$args = array
			(
				'post_type' 	=> 'biblioteca-tips',
				's' 			=> $_GET['keyword'],
				'relevanssi' 	=> true,
				'order'     	=> 'DESC',
		        'posts_per_page'=> $posts_per_page, 
	    	    'paged' 		=> $paged, 
				'fields'        => 'ids',
				'post_status'   => 'publish',
			);
		}
		else
		{
			$args = array
			(
				'post_type' 	=> 'biblioteca-tips',
				'tax_query' 	=> array
				(
					array
					(
					    'taxonomy'	=> 'filtros',
					    'field'		=> 'slug',
					    'terms' 	=> $term->slug,
					    'operator' => 'NOT IN',
					)
				),

				'order'     	=> 'DESC',
				'orderby'		=> 'date',
		        'posts_per_page'=> $posts_per_page, 
	    	    'paged' 		=> $paged, 
				'fields'        => 'ids',
				'post_status'   => 'publish',
			);
		}
	}

    $myPosts = new WP_Query($args);
    
	if(function_exists('relevanssi_do_query'))
		relevanssi_do_query( $myPosts );


	$objectPosts = new stdClass();

	if ( $myPosts->have_posts() )
	{
		$objectPosts->found_posts 	= $myPosts->found_posts;
		$objectPosts->posts_per_page= $posts_per_page;

		$cont = 0;
		$objectPosts->posts = array();

		while ( $myPosts->have_posts() )
		{
			$myPosts->the_post();

			$myPost = get_the_ID();

			$filters = get_the_terms($myPost, 'filtros');
			$filtros = '';
			$localidad = '';
			$localidadTerm = get_term_by('slug', 'localidad', 'filtros');

			foreach($filters as $filter)
			{
				$filtros .= 'filter-' . $filter->slug . ',';

				if($filter->parent == $localidadTerm->term_id && $localidad == '')
					$localidad = $filter->name;
			}

			$filtros = substr_replace($filtros, "", -1);

			$termchildren = get_term_children( $localidadTerm->term_id, 'filtros' );

			if($localidad == '')
            	$localidad = 'Localidad';

            $objectPosts->posts[$cont]['ID'] = $myPost;
            $objectPosts->posts[$cont]['title'] = get_the_title($myPost);
            $objectPosts->posts[$cont]['descripcion'] = get_field('descripcion', $myPost);
            $objectPosts->posts[$cont]['icono'] = get_field('icono', $myPost);

            $tipoArchivo = get_field('tipo_de_archivo', $myPost);

            $objectPosts->posts[$cont]['tipoArchivo'] = $tipoArchivo;
            switch($tipoArchivo)
            {
            	case 'pdf':
            				$objectPosts->posts[$cont]['archivo'] = get_field('pdf', $myPost);
            				break;

            	case 'video':
            				$poster = get_field('video_poster', $myPost);

	                        if($poster == '')
	                          $poster = get_template_directory_uri() . '/public/images/video-poster.png';

							$objectPosts->posts[$cont]['caratula'] = $poster;
            				$objectPosts->posts[$cont]['archivo'] = get_field('video', $myPost);
            				break;

            	case 'audio':
            				$poster = get_field('caratula', $myPost);

	                        if($poster == '')
	                          $poster = get_template_directory_uri() . '/public/images/video-poster.png';

							$objectPosts->posts[$cont]['caratula'] = $poster;
            				$objectPosts->posts[$cont]['archivo'] = get_field('audio', $myPost);
            				break;

            	case 'imagen':
            				$objectPosts->posts[$cont]['archivo'] = get_field('imagen', $myPost);
            				break;
            }
			$objectPosts->posts[$cont]['localidad'] = $localidad;
			$objectPosts->posts[$cont]['filters'] = $filtros;

			$cont++;
		}
	}
    else
    {
    	$objectPosts->found_posts 	= 0;
		$objectPosts->posts_per_page= 0;

    	$objectPosts->posts 		= false;
    }

	wp_reset_postdata();

    echo json_encode($objectPosts);
?>