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
		
		this.exitIfMarkupIsWrong = function(){
			if( this.$slider.length == 0 ){
				console.log("ERROR, the slider doesnt exist");
				return;
			}			
		};
		
		this.amountOfTexts = function(){
			return this.texts.length;
		}
		
		this.changeSlideText = function( index ){
			var $slider = this.$slider;
			var button = $slider.find(".slider-buttons > span:nth-child("+index+")");
			this.exitIfMarkupIsWrong();
			
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
			var _this = this;
			this.timeInterval = setInterval(function(){
				if ( _this.amountOfTexts() == _this.currentSlide )
					_this.changeSlideText(1);
				else
					_this.changeSlideText(_this.currentSlide + 1);
			}, time);
		}
		
		this.activateChangeOnClick = function(){
			var _this = this;
			$(document).on("click", this.id + " .slider-buttons span", function(){
				var slideButtonID = $(this).attr("slide-id");
				var $slider = _this.$slider;
				
				_this.exitIfMarkupIsWrong();
				
				_this.changeSlideText(slideButtonID);
				
				_this.resetTimeInterval();
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
	var scroll;
	var sectionTextSlideOffset;
	var $navbar = $("#navbar");
	
	function variablesReset(){
		scroll = $(window).scrollTop();
		sectionTextSlideOffset = $("#section-text-slide").offset().top;		
	}
	
	function runConditions(){
		variablesReset();

		if ( scroll >=sectionTextSlideOffset && !$navbar.hasClass("in-section-text-slide") )
			$navbar.addClass("in-section-text-slide");
		else
			$navbar.removeClass("in-section-text-slide");
	}
	
	runConditions();
	
	$(window).scroll(function (event) {
		scroll = $(window).scrollTop();
		runConditions();
	});
	
	//resets the variables on resize
	$(window).on('resize', function () {
		variablesReset();
	});
	
	
	
	
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
<?php get_footer(); ?>

