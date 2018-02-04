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
				<?php get_template_part( "svg", "logo" ); ?>
				<!--<img src="<?php /*echo get_template_directory_uri(); */?>/assets/img/flamel-logo.png">-->
			</div>
			<div id="navbar-menu" class="nine columns">
				<ul id="header-navigation-menu" class="page-navigation-list" title="Mayúsculas-Clic para editar este elemento.">
					<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-367 current-menu-item page_item current_page_item"><a>HOLA</a></li>
					<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-382"><a>TRABAJOS</a></li>
					<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-446"><a>HABLEMOS</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="main-sections">
		<section id="section-intro">
			<div class="section-content container">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/eagle-2.png" id="intro-image">
				<div id="intro-text">
					<h5>CONSULTORA ESTRATÉGICA DE DISEÑO INTEGRAL DE MARCA</h5>
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
							<div style="background-image: url('http://localhost/wordpress2/htdocs/wp-content/themes/flamel-genosha/assets/img/water.png');"></div>
						</div>
						<h6 class="project-category">Estrategia + Visual</h6>
						<span class="project-name">NOMBRE DE PROYECTO</span>
					</div>
					<div class="project-slide">
						<div class="project-image">
							<div style="background-image: url('http://localhost/wordpress2/htdocs/wp-content/themes/flamel-genosha/assets/img/water.png');"></div>
						</div>						
						<h6 class="project-category">Estrategia + Visual</h6>
						<span class="project-name">NOMBRE DE PROYECTO</span>
					</div>
					<div class="project-slide">
						<div class="project-image">
							<div style="background-image: url('http://localhost/wordpress2/htdocs/wp-content/themes/flamel-genosha/assets/img/water.png');"></div>
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
					<h5>SOLEDAD RIVAS</h5>
					<h5>MANAGIN DIRECTOR</h5>
					<h6>soledad@flamel.biz</h6>
				</div>
				<div class="author-box-landing">
					<h5>GUSTAVO CHIOCCIONI</h5>
					<h5>DESIGN DIRECTOR</h5>
					<h6>gustavo@flamel.biz</h6>	
				</div>
			</div>
		</section>
	</div>
<script>
$(document).ready( function(){
	
	function TextSlider(_id, _texts){
		this.currentSlide = 1;
		this.id = _id;
		this.$slider = $(_id);
		this.texts = _texts;
		this.timeInterval = null;
		this.time = 400;
		
		this.markupIsWrong = function(){
			if( this.$slider.length == 0 ){
				console.log("ERROR, the slider doesnt exist");
				return true;
			}
			return false;
		};
		
		this.amountOfTexts = function(){
			return this.texts.length;
		}
		
		this.changeSlideText = function( index ){
			var $slider = this.$slider;
			var button = $slider.find(".slider-buttons > span:nth-child("+index+")");
			
			if ( this.markupIsWrong() )
				return;
			
			var _this = this;
			if ( index != this.currentSlide ){
				var $slideContent = $slider.find(".slide-content > p");
				
				$slider.find(".slider-buttons > span").removeClass("active-button");
				button.addClass("active-button");
				
				$slideContent.stop().animate({'opacity': 0}, 400, function(){
					$(this).html(_this.texts[index - 1]).animate({'opacity': 1}, 400);    
				})
				
				this.currentSlide = index;
			}
			console.log(_this.currentSlide);
		}
		
		this.activateChangeOverTimer = function( time ){
			clearInterval(this.timeInterval);
			var _this = this;
			this.timeInterval = setInterval(function(){
				if ( _this.amountOfTexts() == _this.currentSlide )
					_this.changeSlideText(1);
				else
					_this.changeSlideText(parseInt(_this.currentSlide) + 1);
			}, time);
			_this.time = time;
			console.log(_this.timeInterval);
		}
		
		this.activateChangeOnClick = function(){
			var _this = this;
			$(document).on("click", this.id + " .slider-buttons span", function(){
				var slideButtonID = $(this).attr("slide-id");
				var $slider = _this.$slider;
				
				if ( _this.markupIsWrong() )
					return;
				
				_this.changeSlideText(slideButtonID);
				
				if(_this.timeInterval != null)
					_this.activateChangeOverTimer(_this.time);
				
				
			});			
		}
		
		this.resetTimeInterval = function(){
			clearInterval(this.timeInterval);
			this.activateChangeOverTimer;
		}
	}
	
	
	var landingTextSlider = new TextSlider("#text-slider-landing", ["Nuestro diferencial esta puesto en el pensamiento estrategico anclado en el pensamiento visual",
	"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec enim tellus.", "Vulputate sit amet lobortis a, ultricies eu ante. Vestibulum tempor tincidunt molestie"]);

	landingTextSlider.activateChangeOnClick();
	landingTextSlider.activateChangeOverTimer(6000);
	
});

</script>
<script>

$(document).ready( function(){
	/*Smooth scroll*/
	$(document).on('click', 'a[href^="#"]', function (event) {
		event.preventDefault();

		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top
		}, 500);
	});	
	
	/*TEST FUNCTIONS*/
	
	function scrollTo(sectionNumber){
		$('html, body').animate({
			scrollTop: $("#main-sections > section:nth-child("+sectionNumber+")").offset().top
		}, 500);		
	}
});
</script>
<script>

$(document).ready( function(){

	var scroll = $(window).scrollTop();
	var sectionTextSlideOffset;
	var $navbar = $("#navbar");

	$(window).scroll(function (event) {
		scroll = $(window).scrollTop();
	});		
			
	function Section(id, onReach, onOut){
		this.id = id;
		this.onReach = onReach;
		this.onOut = onOut;
		this.offsetTop = function(){
			return $(id).offset().top;
		};
		
		this.runIfOnPosition = function(){
			var sectionOffsetTop = this.offsetTop();
			
			console.log(scroll, sectionOffsetTop, sectionOffsetTop + $(this.id).outerHeight());
			if ( scroll >= sectionOffsetTop && scroll <= ( sectionOffsetTop + $(this.id).outerHeight() ) ){
				this.onReach();
				console.log("reached");
			}
			else{
				this.onOut();
				console.log("nope");
			}	
		}
		
		this.reachCheck = function(){
			var _this = this;
			$(window).scroll(function (event) {
				_this.runIfOnPosition();
			})
		};
		
		this.onCreationSequence = function(){
			this.reachCheck();
			this.runIfOnPosition();		
		}
		
		this.onCreationSequence();
	}
	
	var sectionTextSlide = new Section( "#section-text-slide", function(){
		if( !$navbar.hasClass("in-section-text-slide") )
			$navbar.addClass("in-section-text-slide");
	}, function(){
		if( $navbar.hasClass("in-section-text-slide") )
			$navbar.removeClass("in-section-text-slide");
	});
	
	var sectionTextSlide = new Section( "#section-authors", function(){
		if( !$navbar.hasClass("in-section-authors") )
			$navbar.addClass("in-section-authors");
	}, function(){
		if( $navbar.hasClass("in-section-authors") )
			$navbar.removeClass("in-section-authors");
	});

	var sectionTextSlide = new Section( "#section-process", function(){
		if( !$navbar.hasClass("in-section-process") )
			$navbar.addClass("in-section-process");
	}, function(){
		if( $navbar.hasClass("in-section-process") )
			$navbar.removeClass("in-section-process");
	});
	
	console.log(sectionTextSlide);

	
	var sectionsMaster = {
		sections: [sectionTextSlide],
	}
	
	
});
</script>
<?php get_footer(); ?>

