@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-b-15 mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list mg-t-30">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Comment</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select id="filter" name="filter" class="form-control dt-tb">
                                    <option value="all">All comment</option>
                                    @if(is_admin(auth()->user())!='false')
                                    <option value="inhouse">inHouse</option>
                                    <option value="upload">UGC (User upload)</option>
                                    @endif
                                    <option value="spam">Spam</option>
                                    <option value="deleted">Trash</option>
                                </select>
                                @if(is_admin(auth()->user())!='false' || is_copy_writer(auth()->user())!=='false' || is_leader(auth()->user())!='false')
                                <hr>
                                @if(is_copy_writer(auth()->user())!=='false' || is_leader(auth()->user())!='false')
                                <button id="publish" class="btn btn-success show-waiting" disabled>Publish</button>
                                @endif
                                <button id="remove" class="btn btn-danger" disabled>Delete</button>
                                <button id="restore" class="btn btn-info" disabled>Restore</button>
                                @endif
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="false" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-locale="en-EN" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true">ID</th>
                                        <th data-editable="false" data-width="600">Comment</th>
                                        <th data-editable="false" data-width="400">Audio</th>
                                        <th data-editable="false" data-width="60">Status</th>
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

        var edit_url = '{{ route("admin.comment.edit", ":id") }}';
		var delete_url = '{{ route("admin.comment.delete") }}';
		var spam_url = '{{ route("admin.comment.spam", ":id") }}';
        var restore_url = '{{ route("admin.comment.restore") }}';
        var publish_url = '{{ route("admin.comment.publish") }}';
        var $table = $('#table');
        var $remove = $('#remove');
        var $restore = $('#restore');
        var $publish = $('#publish');

		function operateFormatter(data) {
			return [
				'<a class="btn btn-default" href="'+edit_url.replace(":id", data)+'" title="edit">',
				'<i class="fa fa-edit"></i>',
				'</a> '
			].join('')
        }
        function commentFormatter(data, row){
            var label = '';
            if(row.audio){
                if(row.user.id==row.audio.user_id && !row.audio.project){
                    label = '<small class="label label-primary">owner</small>';
                }
            }
            var link = '<a href="'+edit_url.replace(":id", row.id)+'">'+row.user.name+' '+label+' • '+row.date_label+' </a><br>';
            if(row.status=='delete'){
                link = row.user.name+' '+label+' • '+row.date_label+'<br>';
            }
            var format = [
                '<div class="row mg-b-10"><div class="col-lg-1 col-md-3 col-sm-4 col-xs-4 text-right"><img src="'+row.user.picture+'"></div>',
                '<div class="col-lg-7 col-md-7 col-sm-8 col-xs-8"><p>',
                link,
                '<small>'+data+'</small></p>',
            ];
            @if(is_copy_writer(auth()->user())!=='false' || is_leader(auth()->user())!='false')
                if(row.user_id != row.audio.user_id && row.status!='delete'){
                    format.push('<strong><a class="btn btn-sm btn-default" href="'+edit_url.replace(":id", row.id)+'">Reply</a></strong>');
                }
            @endif
            return format.join('');
        }
        function audioFormatter(data, row){
            var edit_btn = '';
            @if(is_copy_writer(auth()->user())!=='false' || is_leader(auth()->user())!='false')
                edit_btn = '<a class="btn btn-default" title="Comment setting" href="/admin/audio/'+row.audio.id+'/edit#advance"><i class="fa fa-cog" style="font-size:20px;"></i></a></div>';
            @endif
            return [
                '<div class="col-lg-4"><div class="cover-image image-audio-cover" style="background:url('+row.audio.src_cover+');"></div></div>',
                '<div class="col-lg-6"><small>'+data+'</small></div>',
                '<div class="col-lg-2"><a class="btn btn-default" title="Link to listen" href="/listen/'+row.audio.slug+'"><i class="fa fa-link" style="font-size:20px;"></i></a>',
                edit_btn
            ].join('')
        }

		var oTable = $table.bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("admin.comment.index") !!}',
			columns: [
				{ field: 'state' },
                { field: 'comment', formatter: commentFormatter  },
				{ field: 'audio.name', formatter: audioFormatter },
                { field: 'status_label' }
			]
        });

        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $publish.prop('disabled', !$table.bootstrapTable('getSelections').length);
        });

        $publish.click(function (){
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
            $table.bootstrapTable('showLoading');
            //AJAX HERE
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
                    $table.bootstrapTable('refresh');
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    $table.bootstrapTable('refresh');
                    swal({text: response.result,title: "Error Message"});
                }
            });
            
        });

    </script>
    <script src="{{ url('js/data-table/delete-table.js')}}"></script>
    <script src="{{ url('js/data-table/restore-table.js')}}"></script>
@endsection
