@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-b-15 mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list mg-t-30">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data role</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control dt-tb" name="filter">
                                    <option value="admin">General Admin</option>
                                    <option value="team_member">Team Member</option>
                                    <option value="default">Default Roles</option>
                                    <option value="all">All</option>
                                </select>
                                <hr>
                                <a class="btn btn-default" href="{{url('admin/role/add')}}">ADD</a>
                                <button id="remove" class="btn btn-danger" disabled>Delete</button>
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true">ID</th>
                                        <th data-field="id">No</th>
                                        <th data-field="name" data-editable="false">Name</th>
                                        <th data-field="type" data-editable="false">Type</th>
                                        <th data-field="description" data-editable="false">Description</th>
                                        <th data-field="status" data-editable="false">Status</th>
                                        <th data-field="action" data-editable="false">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
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
		var edit_url = '{{ route("admin.role.edit", ":id") }}';
		var delete_url = '{{ route("admin.role.delete") }}';
        var $table = $('#table');
        var $remove = $('#remove');
        var $restore = $('#restore');

		function operateFormatter(data) {
			return [
				'<a class="btn btn-default" href="'+edit_url.replace(":id", data)+'" title="edit">',
				'<i class="fa fa-edit"></i>',
				'</a> '
			].join('')
		}

        function typeFormatter(data, row) {
			if(data=='default'){
                return '<span class="label label-default">Default Roles</span> <span class="label label-info">'+row.role_for+'</span>';
            }else if(data=='admin'){
                return '<span class="label label-info">General Admin</span>';
            }else{
                return '<span class="label label-success">Team Member</span>';
            }
		}

		var oTable = $table.bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("admin.role.index") !!}',
			columns: [
				{ field: 'state' },
				{ field: 'id' },
				{ field: 'name' },
				{ field: 'type', formatter: typeFormatter },
				{ field: 'description' },
				{ field: 'status_label' },
				{ field: 'id', formatter: operateFormatter }
			]
		});
	</script>
    <script src="{{ url('js/data-table/delete-table.js')}}"></script>
@endsection
