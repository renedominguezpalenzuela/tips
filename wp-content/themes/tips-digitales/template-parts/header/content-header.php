<?php 
	$grupo_header	= get_field('grupo_header', 'option');

	$currentUser = get_current_user_id();

	if($currentUser != 0)
	{
		$linkUserPage = '#';

		$nickname = get_user_meta( $currentUser, 'user_nickname', true );

		if($nickname == '')
		{
			$user_name = get_user_meta( $currentUser, 'first_name', true );
	        $nicknameTemp = explode(" ", $user_name);
	        $nickname = $nicknameTemp[0];
	        
	        update_user_meta( $currentUser, 'user_nickname', $nickname );
		}

		$userName = '<span class="nombreButtonUser">Hola <br>' . $nickname . '</span>';
		$userFoto = get_user_meta( $currentUser, 'user_foto', true );

		if($userFoto == '')
      		$userFoto = get_template_directory_uri() . '/public/images/avatar-default.png';

		$dataToggle = 'dropdown';
		$hasPopup = 'true';
	}
	else
	{
		$linkUserPage = $grupo_header['pagina_quiero_participar'];
		$userName = '<span class="nombreButtonUser">Quiero <br>Participar</span>';
		$userFoto = get_template_directory_uri() . '/public/images/quiero-participar-icon.png';

		$dataToggle = '';
		$hasPopup = 'false';
	}
?>
	<div class="container-fluid">
		<div class="btn-helpers">
			<div class="row ms-0 me-0 mb-2 btn-item a-plusFunction">
			    <span class="a-plus" data-disabled="false"></span>
			</div>
			<div class="row ms-0 me-0 mb-2 btn-item a-minusFunction">
			    <span class="a-minus" data-disabled="true"></span>
			</div>
			<div class="row ms-0 me-0 mb-2 btn-item contrastFunction">
					<i data-disabled="false" class="fa-solid fa-circle-half-stroke icon-item contrastButton"></i>
			</div>
			<div class="row ms-0 me-0 btn-item iconShowVideoRuta">
			    <span class="icon-ruta"></span>
			</div>
		</div>
	</div>

	<div class="row g-0">
		<!-- .site-branding -->
		<div class="col-12 site-branding container-fluid pb-1">
			<div class="header-logos px-lg-2 py-2">
				<div class="row">
			    	<div class="col-lg-3">
			  			<div class="logo">
				  				<a class="fontsize-dont-change" href="<?php echo $grupo_header['link_gobierno']; ?>" target="_blank">
										<img src="<?php echo $grupo_header['logo_gobierno']; ?>" class="negativeIMG" alt="Logo Gobierno">
					      	</a>
				      	</div>
			    	</div>
			    </div>
			</div>
		</div><!-- .site-branding -->
	</div>

	<div class="row site-branding-tips g-0">
		<!-- Navigation -->
		<nav class="col-lg-12 col-md-1 col-2 d-block my-auto">
			<div class="d-block mx-auto navbar navbar-expand-lg site-navbar">
				<div class="header-navbar px-lg-2">
				    <div class="row">
						<button class="navbar-toggler navbar-toggler-fixed collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas1" aria-controls="offcanvas1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
							<span class="fa-stack">
								<i class="fa-solid fa-circle fa-stack-2x" style="color: var(--secondary);"></i>
					        	<i class="fas fa-bars fa-stack-1x fa-inverse"></i>
					      	</span>
					    </button>

						<div class="offcanvas offcanvas-start g-0" tabindex="-1" id="offcanvas1" aria-labelledby="offcanvasExampleLabel">
							<div class="offcanvas-header row mx-0 py-3 borderBottomMenu">
								<div class="col-10">
							      	<img src="<?php echo $grupo_header['logo_tips']; ?>" class="col-10 img-fluid negativeIMG" alt="Logo Tips Digital">
								</div>
								<div class="col-2 float-end" data-bs-dismiss="offcanvas" aria-label="Close">
									<i class="fa-solid fa-xmark myCloseButton" aria-hidden="true"></i>
								</div>
							</div>
							<div class="offcanvas-body">
							    <div class="col-md-12">
							    	<?php
										wp_nav_menu( array(
												'theme_location'  => 'cursos',
												'menu_id'		  => 'menu-cursos-mobile',
												'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
												'menu_class'      => 'navbar-nav menu-header px-md-3 py-md-2 d-lg-none',
												'fallback_cb'     => 'MyNavwalker::fallback',
												'walker'          => new MyNavwalker(),
										) );

										wp_nav_menu( array(
												'theme_location'  => 'primary',
												'depth'	          => 1, // 1 = no dropdowns, 2 = with dropdowns.
												'menu_class'      => 'navbar-nav menu-header px-md-3',
												'before'		  => '<i class="fa fa-circle fontsize-dont-change" aria-hidden="true"></i>',
												'fallback_cb'     => 'MyNavwalker::fallback',
												'walker'          => new MyNavwalker(),
										) );

										wp_nav_menu( array(
												'theme_location'  => 'secondary',
												'depth'	          => 1, // 1 = no dropdowns, 2 = with dropdowns.
												'menu_class'      => 'navbar-nav menu-header px-md-3 py-md-2 d-lg-none',
												'fallback_cb'     => 'MyNavwalker::fallback',
												'walker'          => new MyNavwalker(),
										) );
									?>
									<div class="menu-menu-header-participa-container">
										<ul id="menu-menu-header-participar" class="navbar-nav menu-header px-md-3 py-md-2 d-lg-none">
											<li id="menu-item-participar" class="menu-item menu-item-type-post_type menu-item-object-secciones menu-item-has-children dropdown nav-item menu-item-cursos">
												<a href="<?php echo $linkUserPage; ?>" aria-expanded="false" class="<?php echo $dataToggle; ?>-toggle nav-link" data-bs-toggle="<?php echo $dataToggle; ?>">
													<span itemprop="name">Quiero Participar</span>
												</a>
											  <?php
													if($currentUser != 0):
											  ?>
														<ul class="dropdown-menu new-submenu-class" aria-labelledby="menu-item-dropdown-198" data-bs-popper="static">
															<li id="" class="menu-item menu-item-type-post_type menu-item-object-secciones nav-item menu-item-cursos">
																<a itemprop="url" href="<?php echo get_the_permalink(get_page_by_path( 'mi-perfil' ) ); ?>" class="dropdown-item">
																	<span itemprop="name">Ir a mi perfil</span>
																</a>
															</li>

															<li id="" class="menu-item menu-item-type-post_type menu-item-object-secciones nav-item menu-item-cursos">
																<a itemprop="url" href="<?php echo get_the_permalink(get_page_by_path( 'mi-perfil' ) ); ?>?editar-perfil" class="dropdown-item">
																	<span itemprop="name">Editar perfil</span>
																</a>
															</li>

															<li id="" class="menu-item menu-item-type-post_type menu-item-object-secciones nav-item menu-item-cursos">
																<a itemprop="url" href="<?php echo wp_logout_url( home_url()); ?>" class="dropdown-item">
																	<span itemprop="name">Cerrar Sesión</span>
																</a>
															</li>
														</ul>
											  <?php
											  	endif;
											  ?>
											</li>
										</ul>
									</div>
								</div>
				        	</div>
							<div class="offcanvas-footer g-0">
								<div class="menu-menu-header-search-form px-3 py-4">
							    	<form method="get" class="search-form py-2 px-md-3 py-md-2 d-lg-none" id="searchFormMobile" action="<?php echo esc_url( home_url( '/' ) ); ?>">
										<div class="input-group">
											<input class="form-control inputTextElement" id="searchMobile" type="search" name="s" placeholder="Buscar..." value="<?php echo esc_attr(get_search_query()); ?>">
							                <div class="input-group-append">
							                   	<button type="submit" class="btn searchElement2">
							                	   	<i class="fa fa-search"></i>
							                  	</button>
							                </div>
				                            <div class="alert alert-danger alert-search form-outline col-md-12 fade show" data-visible="false" role="alert">
				                              Ingrese mínimo tres caracteres para realizar la búsqueda
				                            </div>

										</div>
					        		</form>
					        	</div>
							</div>
			      		</div>
				  	</div>
				</div>
			</div>
		</nav>
		<!-- Navigation -->

		<!-- .site-branding -->
		<div class="col-lg-12 col-md-11 col-10 d-block my-auto py-lg-3 py-2">
			<div class="container-fluid">
				<div class="header-logos px-lg-4">
					<div class="row">
				    	<div class="col-7">
				  			<div class="logo">
				  				<a href="<?php echo get_site_url(); ?>">
					      		<img src="<?php echo $grupo_header['logo_tips']; ?>" class="img-fluid negativeIMG" alt="Logo Tips Digital">
					      	</a>
					      </div>
				    	</div>

				    	<div class="col-5 my-auto">
			    			<div class="row">
					  			<div class="col-12">
					  				<a href="<?php echo $grupo_header['link_escudos']; ?>" target="_blank">
							      		<img src="<?php echo $grupo_header['logo_escudos']; ?>" class="img-fluid float-end negativeIMG" alt="Logo Secretaria de Salud de Bogotá">
							      	</a>
						      	</div>

							    <div class="menu-derecha-header col-md-12 d-none d-lg-block">
							    	<?php
										wp_nav_menu( array(
											'theme_location'  => 'secondary',
											'depth'	          => 1, // 1 = no dropdowns, 2 = with dropdowns.
											'menu_class'      => 'navbar-nav menu-header float-end',
											'after'			  => '<i class="fa fa-circle fontsize-dont-change" aria-hidden="true"></i>',
											'fallback_cb'     => 'MyNavwalker::fallback',
											'walker'          => new MyNavwalker(),
										) );
									?>
								</div>
				    		</div>
				    	</div>
				    </div>
				</div>
			</div>
		</div>
		<!-- .site-branding -->
	</div>

	<!-- Navigation cursos-->
	<nav class="site-navbar-cursos container-fluid justify-content-between d-none d-lg-block">
	  	<div class="header-navbar-cursos px-lg-2">
	    	<div id="navbar-collapse-2" class="row">
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-9">
					    	<?php
								wp_nav_menu( array(
										'theme_location'  => 'cursos',
										'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
										'menu_id'		  => 'menu-cursos-web',
										'menu_class'      => 'menu-header-cursos py-2 list-unstyled',
										'fallback_cb'     => 'MyNavwalker::fallback',
										'walker'          => new MyNavwalker(),
								));
							?>
						</div>
				    	<div class="col-md-3">
					     	<form method="get" class="search-form py-2" id="searchFormWeb" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<div class="input-group">
									<input class="form-control inputTextElement" id="searchWeb" type="search" name="s" placeholder="Buscar..." value="<?php echo esc_attr(get_search_query()); ?>">
			                		<div class="input-group-append">
				                     	<button type="submit" class="btn searchElement2">
				                        	<i class="fa fa-search"></i>
				                      	</button>
	                  				</div>
		                            <div class="alert alert-danger alert-search form-outline col-md-12 fade show" data-visible="false" role="alert">
		                              Ingrese mínimo tres caracteres para realizar la búsqueda
		                            </div>
								</div>
		        			</form>
		      			</div>
				  	</div>
			  	</div>

			    <div class="col-md-2">
			    	<ul id="modbtn" class="py-2 list-unstyled">
			    		<li class="menu-item menu-item-type-custom menu-item-object-custom nav-item col-md-12 menu-item-cursos">
								<div class="dropdown">
								  <a href="<?php echo $linkUserPage; ?>" class="dropdown-button-perfil" id="dropdownMenuPerfil" data-bs-toggle="<?php echo $dataToggle; ?>" aria-haspopup="<?php echo $hasPopup; ?>" aria-expanded="false">
										<div class="modbtn">
											<?php echo $userName; ?>
										</div>
										<div class="fotoUser" style="background-image: url(<?php echo $userFoto?>);">
										</div>
								  </a>
								  <div class="dropdown-menu dropdown-menu-perfil" aria-labelledby="dropdownMenuPerfil">
											  <?php
													if($currentUser != 0):
											  ?>
												    <div class="container-fluid">
												        <div class="block-menu-perfil px-2 py-2">
												            <ul id="perfilMenuBlock">
												                <li>
												                	<a href="<?php echo get_the_permalink(get_page_by_path( 'mi-perfil' ) ); ?>">Ir a mi perfil</a>
												                </li>

												                <li>
												                	<a href="<?php echo get_the_permalink(get_page_by_path( 'mi-perfil' ) ); ?>?editar-perfil">Editar perfil</a>

												                </li>
												                <li>
												                	<a href="<?php echo wp_logout_url( home_url()); ?>">Cerrar Sesión</a>
												                </li>
												            </ul>
												        </div>
												    </div>
											  <?php
											  	endif;
											  ?>
								  </div>
								</div>
					    </li>
					  </ul>
			    </div>
	    	</div>
	  	</div>
	</nav>
<?php

?>