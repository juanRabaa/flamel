( function( $ ) {
	
	function getNewSortableListOrder( $sortableList ){
		var counter = 0;
		var newOrderString = "";
		var amountOfItems = $sortableList.children('li').length;
		
		$sortableList.children('li').each(function () {
			console.log(this);
			newOrderString += ($(this).attr('name'));
			if ( amountOfItems != (counter + 1) )
				newOrderString += ',';
			counter++;
		});
		
		return newOrderString;
	}
	
	$(document).ready(function(){
		setTimeout(function(){
			$(".sortables-ul").sortable({
				onDrop: function($item, container, _super) {
					//$item.find('ol.dropdown-menu').sortable('enable');
					_super($item, container);
					$item.parents( ".sortables-ul" ).find( 'input[type="hidden"]' ).val( getNewSortableListOrder($item.parents( ".sortables-ul" )) ).trigger( 'change' );
				}
			});
			console.log($(".sortables-ul"));
			/*
			$( "ul.my-multicheck-sortable-list li input" ).on( 'change', function(){
				
				this_checkboxes_values = $( this ).parents( 'ul.my-multicheck-sortable-list' ).find( 'li input' ).map( function(){
					var active = '0';
					if( $(this).prop("checked") ){
						var active = '1';
					}
					return this.name + ':' + active;
				}).get().join( ',' );
			   
			   $( this ).parents( 'ul.my-multicheck-sortable-list' ).find( 'input[type="hidden"]' ).val( this_checkboxes_values ).trigger( 'change' );
			});	*/	
		}, 1)
	})


} )( jQuery );