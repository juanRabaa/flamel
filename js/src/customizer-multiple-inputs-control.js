( function( $ ) {
	$(document).ready(function(){		
		$(document).on('input', ".customize-control-multiple-inputs input", function(){
			updateValue( $(this).closest('.customize-control-multiple-inputs') );
		});
	})
	
	function updateValue( $inputsPanel ){
		var $valueInput = $inputsPanel.find(".control-value");
		var $inputs = $inputsPanel.find(".inputs-holder input");
		var newValue = {};
		$inputs.each(function(){
			newValue[$(this).attr('name')] = $(this).val();
		});
		console.log(newValue);
		$valueInput.val(JSON.stringify(newValue)).trigger('change');
	}	
	
} )( jQuery );