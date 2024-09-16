@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-b-15 mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list mg-t-30">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data category</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select name="filter" class="form-control dt-tb">
                                    <option value="all">All</option>
                                    <option value="pending">Waiting for Approved</option>
                                    <option value="active">Published</option>
                                    <option value="review">Review</option>
                                    <option value="deleted">Delete</option>
                                </select>
                                <hr>
                                <button id="remove" class="btn btn-danger" disabled>Delete</button>
                                <a class="btn btn-default" href="{{url('admin/category/add')}}">ADD</a>
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true">ID</th>
                                        <th data-field="id" data-editable="false">No</th>
                                        <th data-field="name" data-editable="false">Name</th>
                                        <th data-field="update_at" data-editable="false">Last Update</th>
                                        <th data-field="team_id" data-editable="false">Status</th>
                                        <th data-field="action" data-editable="false">Action</th>
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
    <script src="{{ url('js/data-table/delete-table.js')}}"></script>
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
        var edit_url = '{{ route("admin.category.edit", ":id") }}';
        var team_url = '{{ route("admin.team.show", ":id") }}';
		var delete_url = '{{ route("admin.category.delete") }}';
        var $table = $('#table');
        var $remove = $('#remove');
        var $restore = $('#restore');

		function operateFormatter(data, row) {
            var teamBtn = '';
            if(row.team_id==true){
                teamBtn = '<a class="btn btn-default" href="'+edit_url.replace(":id", row.id)+'#teams" title="team details"><i class="fa fa-team"></i></a>';
            }
			return [
				'<a class="btn btn-default" href="'+edit_url.replace(":id", row.id)+'" title="edit">',
				'<i class="fa fa-edit"></i>',
				'</a> ',
                teamBtn
			].join('')
		}

        function teamFormatter(data, row) {
            var teamBtn = '';
            if(row.team_id){
                teamBtn = '<a class="btn btn-link" href="'+team_url.replace(":id", row.team_format_id)+'" title="team details">'+data+'</a>';
            }
			return teamBtn;
		}

		var oTable = $table.bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("admin.category.index") !!}',
			columns: [
				{ field: 'state' },
				{ field: 'id' },
				{ field: 'name' },
				{ field: 'date_label' },
				{ field: 'status_label' },
				{ field: 'action', formatter: operateFormatter },
			]
        });
        
    </script>
    <script src="{{ url('js/data-table/delete-table.js')}}"></script>

@endsection