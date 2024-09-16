(function ($) {
    "use strict";
    
    $(document).ajaxStart(function() { Pace.restart(); });    
    
})(jQuery); 