@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list mg-t-30">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data project</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())!='false')
                                    <select class="form-control dt-tb" name="filter">
                                        <option value="review">Waiting for Approval</option>
                                        <option value="approve">Approved</option>
                                        <option value="reject">Reject</option>
                                        <option value="draft">Draft</option>
                                        <option value="all">All</option>
                                    <option value="deleted">Deleted</option>
                                    </select>
                                    <hr>
                                    @if(is_leader(auth()->user())!='false')
                                    <a class="btn btn-default" href="{{url('admin/project/add')}}">CREATE NEW PROJECT</a>
                                    <button id="delete" class="btn btn-danger" disabled>Delete</button>
                                    @elseif(is_admin(auth()->user())!='false')
                                    <button id="approve" class="btn btn-success" disabled>Approve</button>
                                    <button id="reject" class="btn btn-danger" disabled>Reject</button>
                                    @endif
                                @endif
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true">ID</th>
                                        <th data-field="id" data-width="200" data-editable="false">ID</th>
                                        <th data-field="name" data-editable="false">Project Name</th>
                                        <th data-field="email" data-editable="false">Team Detail</th>
                                        <th data-field="phone" data-width="150" data-editable="false">Created Date</th>
                                        <th data-field="email" data-editable="false">Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
     <!--  editable JS
    ============================================ -->
    <script src="{{ url('js/editable/jquery.mockjax.js')}}"></script>
    <script src="{{ url('js/editable/mock-active.js')}}"></script>
    <script src="{{ url('js/editable/select2.js')}}"></script>
    <script src="{{ url('js/editable/moment.min.js')}}"></script>
    <script src="{{ url('js/editable/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{ url('js/editable/bootstrap-editable.js')}}"></script>
    <script src="{{ url('js/editable/xediable-active.js')}}"></script>

    <script type="text/javascript">
		var show_url = '{{ route("admin.project.show", ":id") }}';
		var edit_url = '{{ route("admin.project.edit", ":id") }}';
        var delete_url = '{{ route("admin.project.delete") }}';
        var change_url = '{{ route("admin.project.change") }}';
        var $table = $('#table');
        var $approve = $('#approve');
        var $reject = $('#reject');
        var $remove = $('#delete');

		function operateFormatter(data) {
			return [
				'<a class="btn-link" href="'+show_url.replace(":id", data)+'" title="'+data+'">',
                'project-'+data,
				'</a> ',
			].join('')
        }

        function teamFormatter(data, row) {
			return [
				'<span class="label label-default" title="team name"><i class="fa fa-flag"></i> '+row.team_name+'</span>',
				'<br>',
				'<span class="label label-primary" title="project leader"><i class="fa fa-user"></i> '+row.team_leader+'</span>'
			].join('')
		}

		var oTable = $table.bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("admin.project.index") !!}',
			columns: [
				{ field: 'state' },
				{ field: 'format_id', formatter: operateFormatter },
				{ field: 'name' },
				{ field: 'team_leader', formatter: teamFormatter },
				{ field: 'date_label' },
				{ field: 'status_label' },
			]
		});

        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            var filter = $('[name="filter"]').val();
            if(filter=='approve'){
                $reject.prop('disabled', !$table.bootstrapTable('getSelections').length);
            }else if(filter=='reject' || filter=='draft'){
                $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
            }else{
                $approve.prop('disabled', !$table.bootstrapTable('getSelections').length);
                $reject.prop('disabled', !$table.bootstrapTable('getSelections').length);
            }
        });

        @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())!='false')
            $approve.click(function (){
                var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                    return row.id
                });
                //AJAX HERE
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: change_url,
                    type: 'post', 
                    dataType: "JSON",
                    data: {
                        "status": 'approve',
                        "id": ids,
                    },
                    success: function (response)
                    {
                        $table.bootstrapTable('refresh');
                        swal({text: response.result,title: "Message"});
                    },
                    error: function(xhr,response) {
                        swal({text: response.result,title: "Error"});
                        
                    }
                });
                $approve.prop('disabled', true);
                $reject.prop('disabled', true);
            });

            $reject.click(function (){
                var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                    return row.id
                });
                //AJAX HERE
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: change_url,
                    type: 'post', 
                    dataType: "JSON",
                    data: {
                        "status": 'reject',
                        "id": ids,
                    },
                    success: function (response)
                    {
                        $table.bootstrapTable('refresh');
                        swal({text: response.result,title: "Message"});
                    },
                    error: function(xhr,response) {
                        swal({text: response.result,title: "Error"});
                        
                    }
                });
                $approve.prop('disabled', true);
                $reject.prop('disabled', true);
            });

            $remove.click(function (){
                swal({
                    title: "Delete?",
                    text: "Please ensure and then confirm!",
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
                                swal({text: response.result,title: "Error"});
                                $table.bootstrapTable('refresh');
                            }
                        });

                        $remove.prop('disabled', true);
                        $restore.prop('disabled', true);

                    } else {
                        e.dismiss;
                    }

                }, function (dismiss) {
                    return false;
                });
            });
        @endif

	</script>
    @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())!='false')
    <!-- <script src="{{ url('js/data-table/delete-table.js')}}"></script> -->
    @endif

@endsection
