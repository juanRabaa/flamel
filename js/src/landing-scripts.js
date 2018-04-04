/**
*Text slider
*Sections scripts
*Smoothscroll on anchor
*Collapsible
*/
$(document).ready( function(){
	// =============================================================================
	// TEXT SLIDER CLASS
	// =============================================================================
	function TextSlider(_id, _texts, _time){
		this.currentSlide = 1;
		this.id = _id;
		this.$slider = $(_id);
		this.texts = _texts;
		this.timeInterval = null;
		this.counterTimeInterval = null
		this.timeStamp = 0;
		this.countdownActivated = false;
		this.time = _time;

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
			var timeStamp = time;
			var $contdownSpan = this.$slider.find(".count-down span");
			clearInterval(this.counterTimeInterval);

			_this.timeStamp = time;
			this.timeInterval = setInterval(function(){
				_this.timeStamp = time;
				if ( _this.amountOfTexts() == _this.currentSlide )
					_this.changeSlideText(1);
				else
					_this.changeSlideText(parseInt(_this.currentSlide) + 1);
			}, time);

			console.log(time);

			if ( this.countdownActivated ){
				this.counterTimeInterval =
					setInterval(function(){
						_this.timeStamp -= 10;
						$contdownSpan.text(_this.timeStamp);
					}, 10);
				_this.time = time;
			}
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
					_this.resetTimeInterval(_this.time);


			});
		}

		this.resetTimeInterval = function( time ){
			this.clearInterval();
			this.activateChangeOverTimer( time );
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

		this.createButtons = function(){
			var $sliderButtonsContainer = this.$slider.find(".slider-buttons");
			//console.log($sliderButtonsContainer);
			$sliderButtonsContainer.html("");
			var counter = 1;

			this.texts.forEach(function(){
				//console.log(counter);
				var elemClass = '';
				if ( counter == 1)
					elemClass = 'class="active-button"';

				$sliderButtonsContainer.append('<span slide-id="'+ counter +'" '+ elemClass +'></span>');
				counter++;

			})
		}

		this.createButtons();
		this.$slider.find(".slide-content > p.active-slide").text(this.texts[0]);
	}


	// =============================================================================
	// Smoot scroll
	// =============================================================================

	$(document).on('click', 'a[href^="#"]', function (event) {
		event.preventDefault();

		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top
		}, 500);
	});


	// =============================================================================
	// SECTIONS
	// =============================================================================

	function convertRemToPixels(rem) {
		return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
	}

	var scroll = $(window).scrollTop();
	var sectionTextSlideOffset;
	var $navbar = $("#navbar");

	$(window).scroll(function (event) {
		scroll = $(window).scrollTop();
	});

	function Section(id, onReach, onOut, onClose, navbarClass){
		this.id = id;
		this.onReach = onReach;
		this.onOut = onOut;
		this.onClose = onClose;
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

		this.runIfClose = function(){
			var sectionOffsetTop = this.offsetTop() - $(window).width() / 2;

			if ( scroll >= sectionOffsetTop && scroll <= ( sectionOffsetTop + $(this.id).outerHeight() ) )
				this.onClose();
		}

		this.reachCheck = function(){
			var _this = this;
			$(window).scroll(function (event) {
				_this.runIfOnPosition();
				_this.runIfClose();
			})
		};

		this.onCreationSequence = function(){
			this.reachCheck();
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

	var sectionIntro = new Section( "#section-intro", function(){}, function(){}, function(){}, "in-section-intro");
	console.log(text_slider_data);
	var sectionTextSlide = new Section( "#section-text-slide", function(){}, function(){}, function(){
		if ( !$("#section-text-slide").hasClass("activated-once") ){

			var texts = JSON.parse(text_slider_data.texts);
			console.log(texts);
			var landingTextSlider = new TextSlider("#text-slider-landing", $.map(texts, function(el) { return el }), text_slider_data.slideDuration);

			landingTextSlider.activateChangeOnClick();
			//landingTextSlider.changeSlideText(2);
			landingTextSlider.activateChangeOverTimer(text_slider_data.slideDuration);


			console.log(landingTextSlider);

			$("#section-text-slide").addClass("activated-once");
		}
	},"in-section-text-slide");

	var sectionAuthors = new Section( "#section-authors", function(){}, function(){}, function(){},"in-section-authors");

	var sectionProjects = new Section( "#section-projects", function(){}, function(){}, function(){},"in-section-projects");

	var sectionProcess = new Section( "#section-process", function(){}, function(){}, function(){},"in-section-process");

	console.log(sectionTextSlide);


	// =============================================================================
	// PROCESS LINES
	// =============================================================================

	function InvisibleMarker($marker){
		this.invisibleMarker = $marker;
		this.distance = 400;
		this.offsetTop = function(){
			return this.invisibleMarker.offset().top - this.distance;
		};
		this.offsetBottom = function(){
			return this.invisibleMarker.offset().top + this.invisibleMarker.height() - this.distance;
		};
		this.size = function(){
			return this.offsetBottom() - this.offsetTop();
		};
		this.percentage = function(){
			var scroll = $(window).scrollTop() - this.offsetTop();
			return scroll * 100/ this.size();
		};
		this.setNewHeight = function(){
			var percentage = this.percentage();
			if ( percentage > -500 && percentage < 500 ){
				var height = this.invisibleMarker.height();
				var reduceHeightBy = height * this.percentage() / 100;
				this.invisibleMarker.find('div').height( height - reduceHeightBy );
				//console.log(this.percentage());
			}
		};
		this.start = function(){
			var _this = this;
			//console.log(this);
			$(window).on("scroll", function(){
				_this.setNewHeight();
			});
			_this.setNewHeight();
		}
	}

	$("#section-process .fixed-hidder").each(function(){
		var invmarker = new InvisibleMarker($(this));
		invmarker.start();
	})

	/*Projects slider shadows*/
	$("#section-projects > .section-content.container").on("scroll", function(){
		var scrollLeft = $(this).scrollLeft();
		var sliderFullWidth = $(this).find(".projects-slides-container").width();
		var slidetCutedWith = $(this).width();
		var percentage = slidetCutedWith * 100 / sliderFullWidth;
		var scrollbarWidth = sliderFullWidth * percentage / 100;
		var scrollRight = scrollLeft + scrollbarWidth;

		if ( !$(this).hasClass("shadow-left-activated") ){
			if( scrollLeft > 20 ){
				$(this).addClass("shadow-left-activated");
				$("#section-projects .shadow-left-holder").stop().fadeIn();
			}
		}
		else if( scrollLeft <= 20 ){
			$(this).removeClass("shadow-left-activated");
			$("#section-projects .shadow-left-holder").stop().fadeOut();
		}

		if ( !$(this).hasClass("shadow-right-activated") ){
			if( scrollRight <= (sliderFullWidth - 20) ){
				$(this).addClass("shadow-right-activated");
				$("#section-projects .shadow-right-holder").stop().fadeIn();
			}
		}
		else if( scrollRight > (sliderFullWidth - 20) ){
			$(this).removeClass("shadow-right-activated");
			$("#section-projects .shadow-right-holder").stop().fadeOut();
		}
	})

	// =============================================================================
	// TWOW INIT
	// =============================================================================

	new WOW().init();

	// =============================================================================
	// COLLAPSIBLES
	// =============================================================================

	$(document).ready( function(){
		$(document).on("click", ".process-title", function(){
			var $parentProcess = $(this).parent(".process");
			if ( !$parentProcess.hasClass("open") )
				$parentProcess.addClass("open");
			else
				$parentProcess.removeClass("open");
		});
	});

	// =============================================================================
	// NAVBAR HIDE/SHOW SCROLL
	// =============================================================================
	var showTimeout = null;
	var slidingUp = false;
	$(window).scroll(function() {
		if( !slidingUp ){
			slidingUp = true;
			$('#navbar').stop(true).slideUp(200, function(){
				slidingUp = false;
			});
		}
		clearTimeout(showTimeout);
		showTimeout = setTimeout(function(){
			$('#navbar').stop(true, true).slideDown(200);
		}, 600);
	});
});
