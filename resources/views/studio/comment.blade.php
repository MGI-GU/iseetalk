@extends('layouts.studio.main')

@section('content')
<div id="app" class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Comment</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select name="filter" class="form-control dt-tb">
                                    <option value="">All</option>
                                    <option value="public">Public Published</option>
                                    <option value="waiting">Waiting to Published</option>
                                    <option value="publish">Published after Review</option>
                                    <option value="spam">Spam</option>
                                </select>
                                <br>
                                <button id="publish" class="btn btn-success show-waiting" disabled>Publish</button>
                                <button id="spam" class="btn btn-danger" disabled>Spam</button>

                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-locale="id-ID" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true">ID</th>
                                        <th data-editable="false" data-width="600">Comment</th>
                                        <th data-editable="false">Status</th>
                                        <th data-editable="false">Audio</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <!-- x-editor CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('css/editor/select2.css')}}">
    <link rel="stylesheet" href="{{ url('css/editor/datetimepicker.css')}}">
    <link rel="stylesheet" href="{{ url('css/editor/bootstrap-editable.css')}}">
    <link rel="stylesheet" href="{{ url('css/editor/x-editor-style.css')}}">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-table.css')}}">
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-editable.css')}}">
@endsection

@section('script')
    <!-- data table JS
    ============================================ -->
    <script src="{{ url('js/data-table/bootstrap-table.js')}}"></script>
    <script src="{{ url('js/data-table/tableExport.js')}}"></script>
    <script src="{{ url('js/data-table/data-table-active.js')}}"></script>
    <script src="{{ url('js/data-table/bootstrap-table-editable.js')}}"></script>
    <script src="{{ url('js/data-table/bootstrap-editable.js')}}"></script>
    <script src="{{ url('js/data-table/bootstrap-table-resizable.js')}}"></script>
    <script src="{{ url('js/data-table/colResizable-1.5.source.js')}}"></script>
    <script src="{{ url('js/data-table/bootstrap-table-export.js')}}"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table-locale-all.min.js"></script>
     <!--  editable JS
    ============================================ -->
    <script src="{{ url('js/editable/jquery.mockjax.js')}}"></script>
    <script src="{{ url('js/editable/mock-active.js')}}"></script>
    <script src="{{ url('js/editable/select2.js')}}"></script>
    <script src="{{ url('js/editable/moment.min.js')}}"></script>
    <script src="{{ url('js/editable/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{ url('js/editable/bootstrap-editable.js')}}"></script>
    <script src="{{ url('js/editable/xediable-active.js')}}"></script>

    <script>
        function detailFormatter(index, row) {
            var html = []
            $.each(row, function (key, value) {
                if(key==0){
                    for (i = 0; i < 5; i++) {
                        html.push('<p>' + value + '</p>')
                    }
                }
            })
            return html.join('')
        }

        var edit_url = '{{ route("studio.comment.edit", ":id") }}';
        var delete_url = '{{ route("studio.comment.delete", ":id") }}';
        var spam_url = '{{ route("studio.comment.remove") }}';
        var publish_url = '{{ route("studio.comment.publish") }}';
        var $spam = $('#spam');
        var $publish = $('#publish');
        var $table = $('#table');

        function operateFormatter(data) {
            return [
                '<a class="btn btn-default" href="'+edit_url.replace(":id", data)+'" title="edit">',
                '<i class="fa fa-edit"></i>',
                '</a> '
            ].join('')
        }
        function commentFormatter(data, row){
            var label = '';
            if(row.user.id==row.audio.user_id){
                label = '<small class="label label-primary">owner</small>';
            }
            var format = [
                '<div class="row mg-b-10"><div class="col-lg-1 col-md-3 col-sm-4 col-xs-4 text-right"><img src="'+row.user.picture+'"></div>',
                '<div class="col-lg-7 col-md-7 col-sm-8 col-xs-8"><p>',
                '<a href="'+edit_url.replace(":id", row.id)+'">'+row.user.name+' '+label+' • '+row.date_label+' </a><br>',
                '<small>'+data+'</small></p>',
            ];
            if(row.user_id != row.audio.user_id){
                format.push('<strong><a class="btn btn-sm btn-default" href="'+edit_url.replace(":id", row.id)+'">Reply</a></strong>');
            }
            // format.push('<strong><a class="btn btn-sm btn-default" href="'+edit_url.replace(":id", row.id)+'"><i class="fa fa-thumb-tack"> Pin</a></strong></div></div>');

            //<a class="btn btn-sm btn-danger" href="'+delete_url.replace(":id", row.id)+'">SPAM</a>

            return format.join('');
        }
        function audioFormatter(data, row){
            return [
                '<div class="col-lg-4"><div class="cover-image image-audio-cover" style="background:url('+row.audio.src_cover+');"></div></div>',
                '<div class="col-lg-6"><small>'+data+'</small></div>',
                '<div class="col-lg-2"><a title="Link to listen" href="/listen/'+row.audio.slug+'"><i class="fa fa-link" style="font-size:20px;"></i></a>',
                '<a title="Comment setting" href="/studio/audio/'+row.audio.slug+'/advance"><i class="fa fa-cog" style="font-size:20px;"></i></a></div>'
            ].join('')
        }

        var oTable = $table.bootstrapTable({
            pagination: true,
            search: true,
            url: '{!! route("studio.comment") !!}',
            columns: [
				{ field: 'state' },
                { field: 'comment', formatter: commentFormatter  },
                { field: 'status_label' },
                { field: 'audio.name', formatter: audioFormatter }
            ]
        });

        $spam.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });

            $table.bootstrapTable('remove', {
                field: 'id',
                values: ids,
            });

            //AJAX RESTORE HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: spam_url,
                type: 'DELETE',
                dataType: "JSON",
                data: {
                    "id": ids
                },
                success: function (response)
                {
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Message"});

                }
            });
            $spam.prop('disabled', true);
            $publish.prop('disabled', true);
        });

        $publish.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });

            $table.bootstrapTable('remove', {
                field: 'id',
                values: ids,
            });

            //AJAX RESTORE HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: publish_url,
                type: 'POST',
                dataType: "JSON",
                data: {
                    "id": ids
                },
                success: function (response)
                {
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Message"});

                }
            });
            $spam.prop('disabled', true);
            $publish.prop('disabled', true);
        });

        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            var filter = $('[name="filter"]').val();
            $spam.prop('disabled', !$table.bootstrapTable('getSelections').length);
            if(filter=='waiting' || filter=='spam'){
                $publish.prop('disabled', !$table.bootstrapTable('getSelections').length);
            }
        });
    </script>

@endsection
