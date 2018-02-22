( function( $ ) {
	$(document).ready(function(){
		setTimeout(function(){
			$(".tax-mult-dropdown-sortable-ul").sortable({
				update: function(event, ui) {
					var $item = ui.item;
					updateValue( $item.closest(".customize-control-tax-mult-dropdown") );
				},
				stop: function( event, ui ){
					var $item = ui.item;
					var $controlLabel = $item.closest(".customize-control-tax-mult-dropdown");
					var $trashCan = $controlLabel.find('.delete-item-on-drop');
					setTimeout(function(){
						if ($trashCan.is(':hover')) {
							deleteItem( $item );
						}
						$trashCan.removeClass("trashcan-activated");	
					}, 1);
				},
				start: function( event, ui ){
					var $item = ui.item;
					var $controlLabel = $item.closest(".customize-control-tax-mult-dropdown");
					var $trashCan = $controlLabel.find('.delete-item-on-drop');
					$trashCan.addClass("trashcan-activated");		
				},
			});
		}, 1)
		
		$(document).on('change', ".tax-mult-dropdown-sortable-ul select", function() {
			updateValue( $(this).closest(".customize-control-tax-mult-dropdown") );		 
		})		
		
		$(document).on("click",".add-new-li i", function(){
			addItem( $(this) );
		});		
	})

	function addItem( $addButton ){
		$controlLabel = $addButton.closest(".customize-control-tax-mult-dropdown");
		$ul = $controlLabel.find(".tax-mult-dropdown-sortable-ul");
		$ul.append(
			'<li>'
			+'	<span class="draggable-ball"></span>'
			+'	<div class="collapsible-title">'
			+'		<div class="draggable-ball-space"></div>'
			+		$ul.attr("data-original-select")
			+'	</div>'							
			+'</li>'
		);	
		updateValue( $controlLabel );
	}
	
	function deleteItem( $item ){
		var $controlLabel = $item.closest(".customize-control-tax-mult-dropdown");
		$item.remove();
		updateValue( $controlLabel );
	}
	
	function getRenewedValue( $controlLabel ){
		var newValue = {};
		var counter = 0;
		$controlLabel.find("select").each(function(){
			console.log($(this));
			newValue[counter] = $(this).val();
			counter++;
		});
		console.log(JSON.stringify(newValue));
		return JSON.stringify(newValue);
	}

	function updateValue( $controlLabel ){
		console.log(getRenewedValue($controlLabel));
		$controlLabel.find('input[type=hidden]').val(getRenewedValue($controlLabel)).trigger("change");
	}
	
} )( jQuery );