@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list mg-t-30">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data channel</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control dt-tb" name="filter">
                                    @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')
                                        <option value="review">Waiting to Approved</option>
                                    @endif
                                    <option value="publish">Published</option>
                                    @if((is_copy_writer(auth()->user())!=='false' || is_graphic_design(auth()->user())!=='false'))
                                        <option value="draft">Draft</option>
                                    @endif
                                    @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')
                                        <option value="all">All Channel</option>
                                        <option value="deleted">Deleted</option>
                                    @endif
                                </select>
                                @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())!=='false')
                                <hr>
                                <button id="remove" class="btn btn-danger" disabled>Delete</button>
                                @endif
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="channelTable" data-show-export="true" data-toolbar="#toolbar"
                                data-side-pagination="server"
                                data-url="{!! route('admin.channel.index') !!}"
                                data-auto-refresh="false"
                                data-search-on-enter-key="true"
                                >
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true">ID</th>
                                        <th data-field="state" data-width="200">ID</th>
                                        <th data-field="name" data-width="400" data-editable="false">Channel</th>
                                        <th data-field="task" data-editable="false">No Audio</th>
                                        <th data-field="email" data-width="200" data-editable="false">Source</th>
                                        <th data-field="phone" data-editable="false">Created Date</th>
                                        <th data-field="email" data-editable="false">Status</th>
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
<div id="loading" class="modal modal-edu-general default-popup-PrimaryModal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 id="title_member_update" class="modal-title">Loading...</h4>
            </div>
            <div class="modal-body">
                <div class="loading text-center">
                    <i class="fa fa-circle-o-notch fa-spin fa-fw fa-4x"></i>
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
    <script src="{{ url('js/data-table/bootstrap-table.min.js')}}"></script>
    <script src="{{ url('js/data-table/bootstrap-table-cookie.min.js')}}"></script>
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
		var show_url = '{{ route("admin.channel.show", ":id") }}';
        var delete_url = '{{ route("admin.channel.delete") }}';
        var $table = $('#table');
        var $remove = $('#remove');
        var $restore = $('#restore');

        function nameFormatter(data, row) {
			return [
				'<b>'+data+'</b><br><small>'+row.description+'</small>',
			].join('')
		}

        function operateFormatter(data) {
			return [
				'<a class="btn-link" href="'+show_url.replace(":id", data)+'" title="'+data+'">',
                'channel-'+data,
				'</a> ',
			].join('')
        }

        function sourceFormatter(data, row) {
            var detail = '';
            if(row.source_label.project){
                detail = 'Category: '+row.source_label.category+'<br>Project: '+row.source_label.project+'<br>Team: '+row.source_label.team;
            }
			return [
				'<b>'+data+'</b><br><small>'+detail+'</small>',
			].join('')
		}

		var oTable = $table.bootstrapTable({
			pagination: true,
			search: true,
			columns: [
				{ field: 'state'},
				{ field: 'format_id', formatter: operateFormatter  },
				{ field: 'name', formatter: nameFormatter },
				{ field: 'no_audio' },
				{ field: 'source_label.name', formatter: sourceFormatter },
				{ field: 'date_label'},
				{ field: 'status_label' },
			],
            formatNoMatches: function () {
                return '<b>No result...</b>'
            },
            onLoadSuccess: function() {
                $('#loading').modal('hide');
                throw new Error("");
            }
		});

        $table.on('all.bs.table', function (name, args) {
            if(args=='refresh-options.bs.table' || args=='search.bs.table' || args=='page-change.bs.table' || args=='refresh.bs.table'){
                $('#loading').modal({backdrop: 'static', keyboard: false});
            }
        });

        var $cookieFilter = getCookie($table.attr('data-cookie-id-table')+'_filter');
        if ($cookieFilter !== "") {
            $table.bootstrapTable('refreshOptions', {
                url: window.location.pathname + '?filter=' + $cookieFilter,
                filterOptions: {
                    filterAlgorithm: $cookieFilter
                }
            });
            $('select').val($cookieFilter);
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
	</script>
    <script src="{{ url('js/data-table/delete-table.js')}}"></script>
@endsection