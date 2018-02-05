<?php
/*
 * 
 * 
*/
get_header();
?>
<body>
    <div id="navbar">
		<div class="row">
			<div class="three columns" id="navbar-logo">
				<div id="logo-svg">
					<?php get_template_part( "svg", "logo" ); ?>
				</div>
				<!--<img src="<?php /*echo get_template_directory_uri(); */?>/assets/img/flamel-logo.png">-->
			</div>
			<div id="navbar-menu" class="nine columns">
				<ul id="header-navigation-menu" class="page-navigation-list" title="Mayúsculas-Clic para editar este elemento.">
					<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-367 current-menu-item page_item current_page_item"><a href="#section-intro">HOLA</a></li>
					<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-382"><a href="#section-projects">TRABAJOS</a></li>
					<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-446"><a href="#section-authors">HABLEMOS</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="main-sections">
		<section id="section-intro">
			<div class="section-content container">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/eagle-2.png" id="intro-image">
				<div id="intro-text">
					<h6>CONSULTORA ESTRATÉGICA DE DISEÑO INTEGRAL DE MARCA</h6>
				</div>
			</div>
		</section>
		<section id="section-text-slide">
			<div class="section-content container">
				<div class="text-slider" id="text-slider-landing">
					<div class="slider-header row">
						<div class="two columns">
							<h5 class="slider-title">CONSULTORA ESTRATÉGICA DE DISEÑO INTEGRAL DE MARCA</h5>
						</div>
						<div class="ten columns slider-buttons">
							<span slide-id="1" class="active-button"></span>
							<span slide-id="2"></span>
							<span slide-id="3"></span>
						</div>
					</div>
					<div class="slide-content active-slide"><p>"Nuestro diferencial esta puesto en el pensamiento estrategico anclado en el pensamiento visual"</p>
					</div>
				</div>
			</div>
			<div class="section-separator" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/water.png');">
				<div class="separator-link">
					<p>Arte utilizado para el proyecto de Boca Juniors</p>
					<i class="fa fa-angle-right"></i>
				</div>
			</div>
		</section>
		<section id="section-process">
			<div class="section-content container">
				<h6 class="process-section-title">PROCESO DE TRABAJO</h6>    
				<div class="process-tree">
					<div class="process">
						<div class="process-title">
							<span class="process-number">1</span>
							<span class="process-name">ESCUCHAMOS</span>
						</div>
						<div class="process-items-container">
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item">NEGOCIO/CULTURA</span>
							</div>
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item">CATEGORÍA/MERCADO</span>
							</div>
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item">CONTEXTO</span>
							</div>
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item">CONSUMIDOR</span>
							</div>
						</div>
					</div>
					<div class="process">
						<div class="process-title">
							<span class="process-number">2</span>
							<span class="process-name">DIAGNOSTICAMOS</span>
						</div>
						<div class="process-items-container">
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item">ANALIZAMOS PARA DIAGNOSTICAR LAS OPORTUNIDADES DE LA MARCA</span>
							</div>
						</div>
					</div>
					<div class="process">
						<div class="process-title">
							<span class="process-number">3</span>
							<span class="process-name">DISEÑAMOS</span>
						</div>
						<div class="process-items-container">
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item">DIFERENCIAL ESTRATÉGICO</span>
							</div>
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item">PROPOSITO</span>
							</div>
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item">ARQUITECTURA</span>
							</div>
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item">PROPUESTA VISUAL</span>
							</div>							
						</div>
					</div>
					<div class="process">
						<div class="process-title">
							<span class="process-number">4</span>
							<span class="process-name">PRODUCIMOS</span>
						</div>
						<div class="process-items-container">
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item">LOS ACTIVOS DE LA MARCA</span>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="section-tools">
			<div class="section-content container">
				<h5 id="section-tools-title">HERRAMIENTAS</h5>
				<div id="section-tools-images">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/tool1.png"/>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/tool2.png"/>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/tool3.png"/>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/tool4.png"/>
				</div>
			</div>
			<div class="section-separator" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/water.png');">
				<div class="separator-link">
					<p>Arte utilizado para el proyecto de Boca Juniors</p>
					<i class="fa fa-angle-right"></i>
				</div>
			</div>
		</section>
		<section id="section-lists">
			<div class="section-content container">
				<div class="list-container" id="landing-list-1">
					<h6 class="list-title">STRATEGY</h6>
					<ul>
						<li>BRANDING</li>
						<li>NAMING ID</li>
						<li>INSIGHTS AND DATA</li>
						<li>RESEARCH</li>
						<li>BRAND</li>
						<li>BUSINESS STRATEGY</li>
						<li>DIGITAL INSIGHT</li>
						<li>CONCEPT DEVELOPMENT</li>
						<li>CONTENT</li>
					</ul>
				</div>
				<div class="list-container" id="landing-list-2">
					<h6 class="list-title">DESIGN</h6>
					<ul>
						<li>PACKAGING</li>
						<li>VISUALS</li>
						<li>ILLUSTRATION</li>
						<li>UX</li>
						<li>DIGITAL CRAFT</li>				
					</ul>
				</div>			
			</div>
		</section>
		<section id="section-projects">
			<div class="section-content container">
				<div class="projects-slides-container" id="projects-slider">
					<div class="project-slide">
						<div class="project-image">
							<div style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/water.png');"></div>
						</div>
						<h6 class="project-category">Estrategia + Visual</h6>
						<span class="project-name">NOMBRE DE PROYECTO</span>
					</div>
					<div class="project-slide">
						<div class="project-image">
							<div style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/water.png');"></div>
						</div>						
						<h6 class="project-category">Estrategia + Visual</h6>
						<span class="project-name">NOMBRE DE PROYECTO</span>
					</div>
					<div class="project-slide">
						<div class="project-image">
							<div style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/water.png');"></div>
						</div>
						<h6 class="project-category">Estrategia + Visual</h6>
						<span class="project-name">NOMBRE DE PROYECTO</span>
					</div>					
				</div>		
			</div>
		</section>
		<section id="section-authors">
			<div class="section-content container">
				<div class="author-box-landing">
					<div class="author-description">
						<h5>SOLEDAD RIVAS</h5>
						<h5>MANAGIN DIRECTOR</h5>
						<h6>soledad@flamel.biz</h6>
					</div>
					<div class="author-photo" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/author-1.png');">
					</div>
				</div>
				<div class="author-box-landing">
					<div class="author-photo" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/author-2.png');">
					</div>							
					<div class="author-description">
						<h5>GUSTAVO CHIOCCIONI</h5>
						<h5>DESIGN DIRECTOR</h5>
						<h6>gustavo@flamel.biz</h6>	
					</div>			
				</div>
			</div>
		</section>
	</div>

<?php get_footer(); ?>

