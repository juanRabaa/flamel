<?php
/*
*
*	Footer template
*
*/
?>
</body>
<?php wp_footer(); ?>
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
			if ( index != this.currentSlide ){//if not the current slide				
				$slider.find(".slider-buttons > span").removeClass("active-button");
				button.addClass("active-button");
				
				this.fadeTransition(index);
				
				this.currentSlide = index;
			}
			console.log(_this.currentSlide);
		}
		
		this.fadeTransition = function( index ){
			var _this = this;
			var $slider = this.$slider;
			var $slideContent = $slider.find(".slide-content > p.active-slide");
			
			$slider.addClass("animation-running");
			
			var $hiddenSlide = $slider.find(".slide-content > p.hidden-slide");
			if( index > this.currentSlide ){//if the slide comes next to the current
				$slideContent.stop().animate({'opacity': 0, 'left' : '-100vw'}, 600, function(){
					$hiddenSlide.css("left", "100vw");
					$hiddenSlide.html(_this.texts[index - 1]).stop().animate({'opacity': 1, 'left': 0}, 600, function(){
						$slideContent.css({'opacity': 1, 'left' : 0}).html(_this.texts[index - 1]);
						$hiddenSlide.html("").css({'opacity': 0, 'left' : "100vw"});
						$slider.removeClass("animation-running");
					});
				})
			}
			else{//if it is a previous slide
				$slideContent.stop().animate({'opacity': 0, 'left' : '100vw'}, 600, function(){
					$hiddenSlide.css("left", "-100vw");
					$hiddenSlide.html(_this.texts[index - 1]).stop().animate({'opacity': 1, 'left': 0}, 600, function(){
						$slideContent.css({'opacity': 1, 'left' : 0}).html(_this.texts[index - 1]);
						$hiddenSlide.html("").css({'opacity': 0, 'left' : "-100vw"});
						$slider.removeClass("animation-running");
					});
				})
			}
		}		

		this.slideTransition = function( index ){
			var _this = this;
			var $slider = this.$slider;
			var $slideContent = $slider.find(".slide-content > p.active-slide");
			
			$slideContent.stop().animate({'opacity': 0}, 400, function(){
				$(this).html(_this.texts[index - 1]).animate({'opacity': 1}, 400);    
			})
		}	
		
		this.activateChangeOverTimer = function( time ){
			this.clearInterval();
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
				
				if ( _this.markupIsWrong() || $slider.hasClass("animation-running") )
					return;
				
				_this.changeSlideText(slideButtonID);
				
				if(_this.timeInterval != null)
					_this.activateChangeOverTimer(_this.time);
				
				
			});			
		}
		
		this.resetTimeInterval = function(){
			this.clearInterval();
			this.activateChangeOverTimer;
		}
		
		this.clearInterval = function(){
			clearInterval(this.timeInterval);
		}
		
		this.convertLettersToSpans = function(){
			$( this.id + ' .slide-content > p' ).each(function(){
				$(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
			});
		}
		
		this.flyLettersAway = function(){
			var time = 0;
			var slider = this;
			this.convertLettersToSpans();
			$( this.id + ' .slide-content > p > span' ).each(function(){
				var _this = this;
				setTimeout( function(){
					slider.letterJumpOff($(_this));
				}, time);
				time += 50;
			});
		}
		
		this.letterJumpOff = function( $letter ){
			var transitionDuration = parseInt($letter.css('transition-duration'));
			var _this = this;
			dynamics.animate($letter[0], {
			  translateY: -100,
			  translateX: 500 * Math.random(),
			}, {
			  type: dynamics.forceWithGravity,
			  duration: 1000,
			  bounciness: 1,
			  elasticity: 1,
			  returnsToSelf: true,
			  complete: function(){
				dynamics.animate($letter[0], {
				  translateY: 500
				}, {
				  type: dynamics.linear,
				  duration: 1000
				})  
			  }
			});
		}
		
		
		this.changeLetterColors = function( _color ){
			this.convertLettersToSpans();
			var time = 0;
			$( this.id + ' .slide-content > p > span' ).each(function(){
				var _this = this;
				setTimeout( function(){
					var color;

					if ( !_color )
						color = getRandomColorRGB();
					else
						color = _color;
					
					$(_this).css("color", color);
				}, time);
				time += 100;
			});
		}
		
	}
	
	
	var landingTextSlider = new TextSlider("#text-slider-landing", ["Nuestro diferencial esta puesto en el pensamiento estrategico anclado en el pensamiento visual",
	"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec enim tellus.", "Vulputate sit amet lobortis a, ultricies eu ante. Vestibulum tempor tincidunt molestie"]);

	landingTextSlider.activateChangeOnClick();
	landingTextSlider.activateChangeOverTimer(4000);
	
	console.log(landingTextSlider);
	
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

	function convertRemToPixels(rem) {    
		return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
	}

	var scroll = $(window).scrollTop();
	var sectionTextSlideOffset;
	var $navbar = $("#navbar");

	$(window).scroll(function (event) {
		scroll = $(window).scrollTop();
	});		
			
	function Section(id, onReach, onOut, navbarClass){
		this.id = id;
		this.onReach = onReach;
		this.onOut = onOut;
		this.offsetTop = function(){
			return $(id).offset().top;
		};
		this.navbarClass = navbarClass;
		
		this.runIfOnPosition = function(){
			var sectionOffsetTop = this.offsetTop() - convertRemToPixels(4.5);
			
			//console.log(scroll, sectionOffsetTop, sectionOffsetTop + $(this.id).outerHeight());
			if ( scroll >= sectionOffsetTop && scroll <= ( sectionOffsetTop + $(this.id).outerHeight() ) ){
				this.onReach();
				this.putActiveClassOnNavbar();
				//console.log("reached");
			}
			else{
				this.onOut();
				this.removeActiveClassFromNavbar();
				//console.log("nope");
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
		
		this.putActiveClassOnNavbar = function(){
			if( !$navbar.hasClass(this.navbarClass) ){
				$navbar.addClass(this.navbarClass);
				$list = $navbar.find('li');
				$sectionMenuItem = $list.has('a[href="'+this.id+'"]');
				
				if( $sectionMenuItem.length == 1 ){
					$list.removeClass("current_page_item");
					$list.removeClass("active");
					$sectionMenuItem.addClass("active");
				}
			}
		}
		
		this.removeActiveClassFromNavbar = function(){
			if( $navbar.hasClass(this.navbarClass) ){
				$navbar.removeClass(this.navbarClass);
				$list = $navbar.find('li');
				$sectionMenuItem = $list.has('a[href="'+this.id+'"]');	
				$sectionMenuItem.removeClass("active");				
			}
		}
		
		this.onCreationSequence();
		
	}
	
	var sectionTextSlide = new Section( "#section-intro", function(){}, function(){}, "in-section-intro");
	
	var sectionTextSlide = new Section( "#section-text-slide", function(){}, function(){}, "in-section-text-slide");
	
	var sectionAuthors = new Section( "#section-authors", function(){}, function(){}, "in-section-authors");

	var sectionProjects = new Section( "#section-projects", function(){}, function(){}, "in-section-projects");
	
	var sectionProcess = new Section( "#section-process", function(){}, function(){}, "in-section-process");
	
	console.log(sectionTextSlide);
	
});
</script>
<script>
new WOW().init();
</script>
</html>