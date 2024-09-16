(function ($) {
 "use strict";
 
	// Datepickers
		$('#start').datepicker({
			dateFormat: 'dd.mm.yy',
			prevText: '<i class="fa fa-chevron-left"></i>',
			nextText: '<i class="fa fa-chevron-right"></i>',
			onSelect: function( selectedDate )
			{
				$('#finish').datepicker('option', 'minDate', selectedDate);
			}
		});
		$('#finish').datepicker({
			dateFormat: 'yyyy.mm.dd',
			prevText: '<i class="fa fa-chevron-left"></i>',
			nextText: '<i class="fa fa-chevron-right"></i>',
			onSelect: function( selectedDate )
			{
				$('#start').datepicker('option', 'maxDate', selectedDate);
			}
		});
		$('#inp-birthday').datepicker({
			dateFormat: 'yyyy-mm-dd',
			format: 'yyyy-mm-dd',
			prevText: '<i class="fa fa-chevron-left"></i>',
			nextText: '<i class="fa fa-chevron-right"></i>',
			onSelect: function( selectedDate )
			{
				$('#start').datepicker('option', 'maxDate', selectedDate);
			}
		});
 
})(jQuery); 