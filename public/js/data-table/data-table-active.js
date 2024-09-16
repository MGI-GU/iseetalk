(function($) {
    "use strict";
    var $table = $('#table');
    $('#toolbar').find('select').change(function() {
        var filterAlgorithm = $('[name="filter"]').val()
        $table.bootstrapTable('refreshOptions', {
            url: window.location.pathname + '?filter=' + filterAlgorithm,
            filterOptions: {
                filterAlgorithm: filterAlgorithm
            }
        });
        setCookie($table.attr('data-cookie-id-table') +
            '_filter', filterAlgorithm, 30);
        // location.replace(window.location.pathname +'?filter='+filterAlgorithm)
        // console.log(filterAlgorithm);
    });

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

})(jQuery)