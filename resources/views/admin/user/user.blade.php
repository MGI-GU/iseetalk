@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list mg-t-30">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data user</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control dt-tb" name="filter">
                                    @if(is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')
                                    <option value="all">All</option>
                                    <option value="admin">Administrator</option>
                                    @endif
                                    <option value="streamer">Streamer</option>
                                    <option value="creator">Creator</option>
                                    <option value="member">Project Member</option>
                                    <option value="inactive">Disabled</option>
                                    @if(is_admin(auth()->user())!='false')
                                    <option value="deleted">Deleted</option>
                                    @endif
                                </select>
                                <hr>
                                <button id="remove" class="btn btn-danger" disabled>Delete</button>
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true">ID</th>
                                        <th data-field="phone" data-width="80">Avatar</th>
                                        <th data-field="id" data-width="120" data-editable="false">ID</th>
                                        <th data-field="name" data-editable="false">Name</th>
                                        <th data-field="email" data-width="300" data-editable="false">Account</th>
                                        <th data-field="created_at" data-width="150" data-editable="false">Registered Date</th>
                                        <th data-field="platform" data-width="80" data-editable="false">Platform</th>
                                        <th data-field="type" data-width="50" data-editable="false">Type</th>
                                        <th data-field="status" data-width="120" data-editable="false">Status</th>
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
		var edit_url = '{{ route("admin.user.show", ":id") }}';
		var delete_url = '{{ route("admin.user.delete") }}';
		var image_url = '{{ get_image(":id", "thumb") }}';
		var restore_url = '{{ route("admin.user.restore") }}';
        var $table = $('#table')
        var $remove = $('#remove')
        var $restore = $('#restore')

        function statusFormatter(data, row) {
            var label = 'success';
            if(data=='invalid'){
                label = 'warning';
                text = 'Not Valid';
            }else if(data=='disable'){
                label = 'danger';
                text = 'Disabled';
            }else if(data=='inactive'){
                label = 'default';
                text = 'Not Active';
            }else{
                text = 'Active';
            }
            if(row.email_verified_at){
                $label = ' <span class="label label-info">Verified</span>';
            }else{
                $label = ' <span class="label label-default">Not Verified</span>';
            }
			return [
				'<span class="label label-'+label+'">'+text+'</span> ',
				$label
			].join('')
		}
        function typeFormatter(data, row) {
            var label = 'default';
            if(data=='member'){
                label = 'info';
            }else if(data=='admin'){
                label = 'danger';
            }else{
                label = 'primary';
            }
			return [
				'<span class="label label-'+label+'">'+data+'</span>',
			].join('')
		}
        function accountFormatter(data, row) {
			return [
				'Phone: <a href="tel:'+row.phone+'" title="phone">'+row.phone+'</a><br>',
				'Email: <a href="mailto:'+row.email+'" title="email">'+row.email+'</a>',
				'</a> '
			].join('')
		}
        function imageLoad(data, row) {
			return [
				'<img style="max-height:50px;" src="'+data+'" title="'+row.name+'">',
			].join('')
        }
        function operateFormatter(data) {
			return [
				'<a class="btn-link" href="'+edit_url.replace(":id", data)+'" title="'+data+'">',
                'user-'+data,
				'</a> ',
			].join('')
        }
		var oTable = $table.bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("admin.user.index") !!}',
			columns: [
				{ field: 'state' },
				{ field: 'picture', formatter:imageLoad },
				{ field: 'format_id', formatter:operateFormatter },
				{ field: 'name' },
				{ field: 'phone', formatter: accountFormatter },
				{ field: 'date_label'},
				{ field: 'platform' },
				{ field: 'type', formatter: typeFormatter },
				{ field: 'status', formatter: statusFormatter },
			]
        });

    </script>
    <script src="{{ url('js/data-table/delete-table.js')}}"></script>

@endsection
