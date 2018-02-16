( function( $ ) {

	(function(old) {
	  $.fn.attr = function() {//Gets all the attributes of an element ex: var $div = $("<div data-a='1' id='b'>"); $div.attr() ---> { "data-a": "1", "id": "b" }
		if(arguments.length === 0) {
			if(this.length === 0) {
				return null;
			}

			var obj = {};
			$.each(this[0].attributes, function() {
				if(this.specified) {
					obj[this.name] = this.value;
				}
			});
			return obj;
		}

		return old.apply(this, arguments);
	  };
	})($.fn.attr);
	
	function change_control_label( control, value ){
		jQuery(wp.customize.control( control ).container[0]).find(".customize-control-title").html( value );
	}	
	
	function find_input_control_attributes ( $control ) {
		return $(wp.customize.control( $control ).container["0"]).find("input").attr();		
	}
	
    wp.customizerCtrlEditor = {

        init: function() {

            $(window).load(function(){

                $('textarea.wp-editor-area').each(function(){
                    var tArea = $(this),
                        id = tArea.attr('id'),
                        editor = tinyMCE.get(id),
                        setChange,
                        content;

                    if(editor){
                        editor.onChange.add(function (ed, e) {
                            ed.save();
                            content = editor.getContent();
                            clearTimeout(setChange);
                            setChange = setTimeout(function(){
                                tArea.val(content).trigger('change');
                            },500);
                        });
                    }

                    tArea.css({
                        visibility: 'visible'
                    }).on('keyup', function(){
                        content = tArea.val();
                        clearTimeout(setChange);
                        setChange = setTimeout(function(){
                            content.trigger('change');
                        },500);
                    });
                });
            });
        }

    };

    wp.customizerCtrlEditor.init();
	
    wp.customizerInputs= {

        init: function() {

            $(window).load(function(){
				$(document).on("click",".title-holder", function(){
					var $settings = $(this).siblings(".input-container-control");
					if (!$settings.length)
						$settings = $(this).siblings(".collapsible-body");
					var $arrow = $(this).children(".customize-control-arrow i:not(.delete-item)");
					if ( !$settings.hasClass("animating") ){
						$settings.addClass("animating");
						
						if ( $settings.css("display") == "none" ){
							$settings.slideDown();
							$arrow.css('transform','rotate(180deg)');
						}
						else{
							$settings.slideUp();
							$arrow.removeClass('rotate');
							$arrow.css('transform','rotate(0deg)');
						}
						
						$settings.removeClass("animating");
					}
				});
            });
        }

    };
	wp.customizerInputs.init();

	wp.customizerContactSocial= {

        init: function() {

            $(window).load(function(){
				
				function toggleIconsControls( value ) {
					var input_attributes = find_input_control_attributes('section-contact-social-amount');
					var input_max = parseInt(input_attributes.max);
					var input_min = input_attributes.min ? parseInt(input_attributes.min) : 0;
					
					for ( var i = input_min+1; i <= value; i++) {
						wp.customize.control( 'section-contact-social-control-' + i ).container.stop().slideDown( function () {
							$(this).height("auto");
						});
					}
					value = parseInt ( value );

					for ( var e = value + 1; e <= input_max; e++) {

						wp.customize.control( 'section-contact-social-control-' + e ).container.stop().slideUp( function () {
							$(this).height("auto");
						});
					}
				}
			
				//when option change
				wp.customize('section-contact-social-amount', function( value ) {
					value.bind( function ( value ) {
						toggleIconsControls( value );						
					});
				});
		
				//on load
				var amount_of_icons = wp.customize.control('section-contact-social-amount').setting._value;	
				toggleIconsControls( amount_of_icons );	
				
				//Bind change of value to name of control container
				wp.customize.control.each( function ( control ){ 
					if ( control.id.startsWith('section-contact-social-control-') ){
						console.log(control.settings);
						var iconNumber = control.id.replace('section-contact-social-control-','');	
						control.settings.Name.bind( function ( value ) {
							if ( value.trim() != '' )
								$(control.container["0"]).find(".customize-control-title").text(value);
							else
								$(control.container["0"]).find(".customize-control-title").text("Icon " + iconNumber);
						});
					}				
				})
				
            });
		}

    };
	wp.customizerContactSocial.init();

	wp.customizerEvents= {

        init: function() {

            $(window).load(function(){
				
				function toggleControls( value ) {
					if ( value == 0 ){//type post by category...
						wp.customize.control( "event-post-category" ).container.stop().slideDown( function () {
							$(this).height("auto");
						});			
						wp.customize.control( 'event-facebook-page' ).container.stop().slideUp();								
					}
					else{//type facebook events
						wp.customize.control( 'event-facebook-page' ).container.stop().slideDown( function () {
							$(this).height("auto");
						});		
						wp.customize.control( "event-post-category" ).container.stop().slideUp();							
					}
				}

				//when option change
				wp.customize( "event-type-select", function( value ) {
					value.bind( function ( value ) {
						toggleControls( value );						
					});
				});
								
				//on load
				var eventType = wp.customize.control( "event-type-select" ).setting._value;	
				toggleControls( eventType );	
				
            });
		}

    };
	wp.customizerEvents.init();

} )( jQuery );