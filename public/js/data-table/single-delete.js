(function ($) {
    $delete.click(function (){
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
                var ids = [];
                ids.push(data_id);

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
                        "filter": 'delete',
                        "page": "detail"
                    },
                    success: function (response)
                    {
                        swal({text: response.result,title: "Message"}).then(() => {
                            window.location.replace(redirect_url);
                        });
                    },
                    error: function(xhr,response) {
                        swal({text: response.result,title: "Error"});
                    }
                });

            } else {
                result.dismiss;
            }

        }, function (dismiss) {
            return false;
        });
    });
})(jQuery);