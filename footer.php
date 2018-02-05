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
				
				if ( _this.markupIsWrong() )
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
	landingTextSlider.activateChangeOverTimer(6000);
	
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
			
	function Section(id, onReach, onOut){
		this.id = id;
		this.onReach = onReach;
		this.onOut = onOut;
		this.offsetTop = function(){
			return $(id).offset().top;
		};
		
		this.runIfOnPosition = function(){
			var sectionOffsetTop = this.offsetTop() - convertRemToPixels(4.5);
			
			//console.log(scroll, sectionOffsetTop, sectionOffsetTop + $(this.id).outerHeight());
			if ( scroll >= sectionOffsetTop && scroll <= ( sectionOffsetTop + $(this.id).outerHeight() ) ){
				this.onReach();
				//console.log("reached");
			}
			else{
				this.onOut();
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
</html>