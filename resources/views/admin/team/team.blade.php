@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-b-15 mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list mg-t-30">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data team</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                            @if(is_leader(auth()->getUser()) !== 'false' || is_admin(auth()->getUser()) !== 'false')
                                <a class="btn btn-default" href="{{url('admin/team/add')}}">CREATE NEW TEAM</a>
                                <button id="remove" class="btn btn-primary" disabled>Dismis</button>
                            @endif
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true">ID</th>
                                        <th data-field="id" data-editable="false">ID</th>
                                        <th data-field="team" data-editable="false">Team</th>
                                        <th data-field="name" data-editable="false">Leader</th>
                                        <th data-field="category" data-editable="false">Category</th>
                                        <th data-field="stat" data-editable="false">Stat</th>
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
    <script>
        function detailFormatter(index, row) {
            var html = []
            // html.push('<table class="table">  <tbody> <tr> <td><div class="col-lg-1 col-md-3 col-sm-4 col-xs-4 text-right"><img src="../img/contact/1.jpg"></div><b>Justin</b></td> </tr> <tr> <td><div class="col-lg-1 col-md-3 col-sm-4 col-xs-4 text-right"><img src="../img/contact/1.jpg"></div><b>Justin</b></td> </tr> </tbody> </table>');
            return html.join('');
        }

        var edit_url = '{{ route("admin.team.show", ":id") }}';
		var delete_url = '{{ route("admin.team.delete") }}';
        var $table = $('#table');
        var $remove = $('#remove');
        var $restore = $('#restore');

		function operateFormatter(data) {
            return [
				'<a class="btn-link" href="'+edit_url.replace(":id", data)+'" title="'+data+'">',
                'team-'+data,
				'</a> ',
			].join('');
        }

        function statFormatter(data, row) {

			return [
				'No Member: '+row.count_member+'<hr>',
				'No Project: '+row.count_project+'<br>',
				'No Channel: '+row.count_channel+'<br>',
				'No Audioslide: '+row.count_audio+'<br>'
			].join('')
		}

		var oTable = $table.bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("admin.team.index") !!}',
			columns: [
				{ field: 'state' },
				{ field: 'format_id', formatter: operateFormatter },
				{ field: 'name' },
				{ field: 'leader_name' },
				{ field: 'category' },
				{ field: 'count_project', formatter: statFormatter },
			]
		});
    </script>
    <script src="{{ url('js/data-table/delete-table.js')}}"></script>
@endsection
