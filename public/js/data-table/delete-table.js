(function ($) {
    $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
        var filter = $('[name="filter"]').val();
        console.log(filter);
        $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
        if(filter=='deleted'){
            $restore.prop('disabled', !$table.bootstrapTable('getSelections').length);
        }
    });

    $remove.click(function () {
        swal({
            title: "Delete?",
            text: "Please ensure and then confirm!",
            dangerMode: true,
            buttons: {
                cancel: true,
                confirm: "Yes, delete it!",
            },
        }).then((result) => {
            if (result === true) {
                var filter = $('[name="filter"]').val();
                var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                    return row.id
                });

                $table.bootstrapTable('showLoading');

                //AJAX DELETE HERE
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: delete_url,
                    type: 'DELETE',
                    dataType: "JSON",
                    data: {
                        "id": ids,
                        "filter": filter
                    },
                    success: function (response)
                    {
                        swal({text: response.result,title: "Message"});
                        $table.bootstrapTable('refresh');
                    },
                    error: function(xhr,response) {
                        swal({text: response.result,title: "Message"});
                        $table.bootstrapTable('refresh');
                    }
                });

                $remove.prop('disabled', true);
                $restore.prop('disabled', true);

            } else {
                e.dismiss;
            }

        }, () => {
            return false;
        });
        
    });
})(jQuery);
