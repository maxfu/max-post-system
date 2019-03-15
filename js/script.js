(function( $ ) {

	//Initializing jQuery UI Datepicker
	$( '#advanced_options_event_date' ).datetimepicker({
		dateFormat: 'M d, Y H:i',
		onClose: function( selectedDate ){
			$( '#advanced_options_event_date' ).datetimepicker( 'option', 'minDate', selectedDate );
		}
	});
	$( '#mes-event-end-date' ).datetimepicker({
		dateFormat: 'M d, Y H:i',
		onClose: function( selectedDate ){
			$( '#mes-event-start-date' ).datetimepicker( 'option', 'maxDate', selectedDate );
		}
	});

})( jQuery );
