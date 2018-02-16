( function( $ ) {
	$(document).ready(function(){
		setTimeout(function(){
			$(".textarea-generator-sortable-ul").sortable({
				update: function(event, ui) {
					var $item = ui.item;
					updateValue( $item.closest(".customize-control-textarea-generator") );
				},
				handle: ".draggable-ball"
			});				
		}, 1)
		
		$(document).on("click", ".customize-control-textarea-generator .add-new-text", function(){
			addNewText( $(this).closest(".customize-control-textarea-generator") );
		});

		$(document).on("click", ".customize-control-textarea-generator .collapsible-body-controls .delete-item", function(){
			deleteItem( $(this).closest("li") );
		});
		
		$(document).on('input', ".customize-control-textarea-generator textarea", function(){
			var $title = $(this).closest("li").find(".collapsible-title .customize-control-title");
			$title.text($(this).val());
			updateValue( $(this).closest(".customize-control-textarea-generator") );
		});

		$(document).on("click",".collapsible-title", function(){
			var $settings = $(this).siblings(".collapsible-body");
			console.log($settings);
			var $arrow = $(this).find(".collapsible-arrow");
			console.log( $arrow );
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
	})

	function deleteItem( $item ){
		var $textareaGeneratorPanel = $item.closest(".customize-control-textarea-generator");
		$item.remove();
		updateValue( $textareaGeneratorPanel );
	}
	
	function addNewText( $textareaGeneratorPanel ){
		$textareaGeneratorPanel.find(".textarea-generator-sortable-ul").append(
		'<li class="sortable-li">'
		+'	<span class="draggable-ball"></span>'
		+'	<div class="collapsible-title">'
		+'		<div class="draggable-ball-space"></div>'
		+'		<span class="customize-control-arrow">'
		+'			<i class="fas fa-angle-down collapsible-arrow" aria-hidden="true"></i>'
		+'		</span>'
		+'		<span class="customize-control-title"></span><div class="customize-control-notifications-container" style="display: none;"><ul></ul></div> '
		+'	</div>'
		+'	<div class="collapsible-body">'
		+'		<textarea class="textarea-generator-input"></textarea>'
		+'			<div class="collapsible-body-controls">'
		+'				<i class="fas fa-trash-alt delete-item"></i>'
		+'			</div>'
		+'	</div>			'		
		+'</li>'	);		
	}
	
	function updateValue( $textareaGeneratorPanel ){
		var $textAreas = $textareaGeneratorPanel.find("textarea");
		var $valueInput = $textareaGeneratorPanel.find('input[type="hidden"]' );
		var finalValue = {};
		var index = 0;
		$textAreas.each(function( index ){
			finalValue[index] = $(this).val();
			index++;
		});	
		console.log(finalValue);
		$valueInput.val( JSON.stringify(finalValue) ).trigger( 'change' );
	}	
	
} )( jQuery );