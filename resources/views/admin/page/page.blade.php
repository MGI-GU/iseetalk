@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-b-15 mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list  mg-t-30">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data Pages & Notification</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control dt-tb mg-t-10" name="filter">
                                    <option value="draft">Draft</option>
                                    <option value="page">Page</option>
                                    <option value="notification">Notification</option>
                                    <option value="publish">Published</option>
                                </select>
                                <hr>
                                <a class="btn btn-default" href="{{url('admin/page/add')}}">ADD</a>
                                <button id="remove" class="btn btn-danger" disabled>Delete</button>
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true">ID</th>
                                        <th data-field="id" data-width="200" data-editable="false">ID</th>
                                        <th data-field="name" data-editable="false">Judul</th>
                                        <th data-field="complete">Author</th>
                                        <th data-field="task" data-editable="false">Tanggal</th>
                                        <th data-field="type" data-editable="false">Type/Status</th>
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
		var edit_url = '{{ route("admin.page.edit", ":id") }}';
		var delete_url = '{{ route("admin.page.delete") }}';
        var $table = $('#table');
        var $remove = $('#remove');
        var $restore = $('#restore');

		function operateFormatter(data, row) {
            return [
				'<a class="btn-link" href="'+edit_url.replace(":id", data)+'" title="'+data+'">',
                'notice-'+data,
				'</a> ',
			].join('');
		}
        function statusFormatter(data, row) {
            var notif = 'None';
            if(row.notification && row.notification!==null){
                notif = row.notification.type_label;
                var status = '<span class="label label-default">Pending</span>';
                if(row.status=='publish'){
                    status = '<span class="label label-success">Sent</span>';
                }
                data = notif+'<span> </span>'+status;
            }else{
                data = data
            }
			return [
				data
			].join('')
		}

		var oTable = $table.bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("admin.page.index") !!}',
			columns: [
				{ field: 'state' },
				{ field: 'format_id', formatter: operateFormatter  },
				{ field: 'title' },
				{ field: 'author.name' },
				{ field: 'date_label'},
				{ field: 'status_label', formatter: statusFormatter },
			]
		});
	</script>
    <script src="{{ url('js/data-table/delete-table.js')}}"></script>
@endsection
