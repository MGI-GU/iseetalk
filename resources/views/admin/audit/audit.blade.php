@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-b-15 mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list mg-t-30">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data audit</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control dt-tb" name="filter">
                                    @if(is_admin(auth()->user())=='super_admin' || is_admin(auth()->user())=='master_admin')
                                    <option value="new">Waiting for Audit</option>
                                    <option value="publish">Approved</option> 
                                    <option value="suspend">Rejected</option>
                                    <!--<option value="all">All Data</option>-->
                                    @endif
                                    <option value="audio">Audio</option>
                                    <option value="channel">Channels</option>
                                </select>
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="id">No</th>
                                        <th data-field="name" data-editable="false">Audio/Channel</th>
                                        <th data-field="email" data-editable="false">Source</th>
                                        <th data-field="complete">Statistic</th>
                                        <th data-field="phone" data-editable="false">Last Updated</th>
                                        <th data-field="status">Status</th>
                                        <th data-field="status">Action</th>
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
		var show_url = '{{ route("admin.audit.edit", ":id") }}';

        function sourceFormatter(data, row) {
			return [
				data+' <br>'+row.status_label,
			].join('')
		}
        function nameFormatter(data, row) {
            var label = 'info';
            if(row.data_label=='audio'){
                var label = 'success';
            }
            if(row.data_label=='project'){
                var label = 'danger';
            }
			return [
				'<a href="'+show_url.replace(":id", row.id)+'?f='+row.data_label+'">'+data+'</a><br><small class="label label-'+label+'">'+row.data_label+'</small>',
			].join('')
		}
        function statusFormatter(data) {
            var label = 'label label-warning';
            if(data =='new'){
                label = 'label label-info';
                data = 'Waiting for Audit';
            }else if(data =='approve'){
                label = 'label label-success';
                data = 'Approved';
            }else if(data =='suspend'){
                label = 'label label-danger';
                data = 'Rejected';
            }else if(data =='review'){
                label = 'label label-info';
                data = 'Waiting for Audit';
            }
            return '<span class="'+label+'">'+data+'</span>';
		}
        function btnFormatter(data, row) {
			return [
				'<a class="btn btn-default" href="'+show_url.replace(":id", row.id)+'?f='+row.data_label+'" title="edit">',
				'<i class="fa fa-edit"></i>',
				'</a> '
			].join('')
		}
		var oTable = $('#table').bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("admin.audit.index") !!}',
			columns: [
				{ field: 'id' },
				{ field: 'data_table.name', formatter: nameFormatter },
				{ field: 'data_table.source_label' },
				{ field: 'data_table.play_number' },
				{ field: 'data_table.last_update'},
				{ field: 'status', formatter: statusFormatter },
				{ field: 'id', formatter: btnFormatter },
			]
		});
	</script>
@endsection
