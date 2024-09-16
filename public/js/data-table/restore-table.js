(function ($) {
    $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
        var filter = $('[name="filter"]').val();
        $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
        if(filter=='deleted'){
            $restore.prop('disabled', !$table.bootstrapTable('getSelections').length);
        }
    });

    $restore.click(function () {
        var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id
        });

        // $table.bootstrapTable('remove', {
        //     field: 'id',
        //     values: ids,
        // });
        $table.bootstrapTable('showLoading');


        //AJAX RESTORE HERE
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: restore_url,
            type: 'POST',
            dataType: "JSON",
            data: {
                "id": ids
            },
            success: function (response)
            {
                swal({text: response.result,title: "Message"});
                $table.bootstrapTable('refresh');
            },
            error: function(xhr,response) {
                swal({text: response.result,title: "Error"});
                $table.bootstrapTable('refresh');
            }
        });
        $remove.prop('disabled', true);
        $restore.prop('disabled', true);
    });
})(jQuery);
