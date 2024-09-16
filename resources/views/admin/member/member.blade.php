@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-b-15 mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list mg-t-30">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data admin</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                @if(is_admin(auth()->user())=='super_admin')
                                <select class="form-control dt-tb" name="filter">
                                    <option value="all">All</option>
                                    <option value="admin">General Admin</option>
                                    <option value="master_admin">Master Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                </select>
                                <hr>
                                @endif
                                <a class="btn btn-default" href="{{url('admin/member/add')}}">ADD</a>
                                <button id="remove" class="btn btn-danger" disabled>Delete</button>
                                <!-- <button id="suspend" class="btn btn-warning" disabled>Suspend</button> -->
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true">ID</th>
                                        <th data-field="id" data-editable="false">Admin ID</th>
                                        <th data-field="user_id" data-editable="false">User ID</th>
                                        <th data-field="avatar" data-editable="false">Avatar</th>
                                        <th data-field="name" data-editable="false">Name</th>
                                        <th data-field="phone">Phone</th>
                                        <th data-field="email" data-editable="false">Email</th>
                                        <th data-field="role" data-editable="false">Main Role</th>
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
		var edit_url = '{{ route("admin.member.edit", ":id") }}';
		var delete_url = '{{ route("admin.member.delete", ":id") }}';
		var image_url = '{{ get_image(":id", "thumb") }}';
		var user_url = '{{ route("admin.user.edit", ":id") }}';
        var $table = $('#table');
        var $remove = $('#remove');
        var $suspend = $('#suspend');

		function operateFormatter(data) {
			return [
				'<a class="btn btn-default" href="'+edit_url.replace(":id", data)+'" title="edit">',
				'<i class="fa fa-edit"></i>',
				'</a> '
			].join('')
		}
		function imageLoad(data, row) {
			return [
				'<img style="max-height:50px;" src="'+data+'" title="'+row.name+'">',
			].join('')
        }
        function typeText(data) {
            if(data=='admin'){
                return 'Adminstrator';
            }else{
                return 'Team Member';
            }
		}
        function userFormatter(data) {
			return [
				'<a class="btn-link" href="'+user_url.replace(":id", data)+'" title="'+data+'">',
                'user-'+data,
				'</a> ',
			].join('')
        }
        function adminFormatter(data) {
			return [
				'<a class="btn-link" href="'+edit_url.replace(":id", data)+'" title="'+data+'">',
                'admin-'+data,
				'</a> ',
			].join('')
        }
		var oTable = $table.bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("admin.member.index") !!}',
			columns: [
				{ field: 'state' },
				{ field: 'format_id', formatter: adminFormatter },
				{ field: 'role.user.format_id', formatter: userFormatter },
				{ field: 'role.user.picture', formatter: imageLoad },
				{ field: 'role.user.name' },
				{ field: 'role.user.phone' },
				{ field: 'role.user.email' },
				{ field: 'role.role.name' },
				{ field: 'format_id', formatter: operateFormatter }
			]
		});
	</script>
    <script src="{{ url('js/data-table/delete-table.js')}}"></script>
@endsection
