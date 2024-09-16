@extends('layouts.admin.main')

@section('content')
<div class="data-table-area mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mg-t-30 white-box">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data audio</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control dt-tb" id="filter" name="filter">
                                    @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')
                                    <option value="all">All Audioslide</option>
                                    @endif
                                    <option value="publish">Publish</option>
                                    @if(is_member(auth()->user())=='member' && is_admin(auth()->user())!='master_admin' && is_admin(auth()->user())!='super_admin')
                                        <option value="draft">Draft</option>
                                        <option value="review">Waiting Approval</option>
                                    @endif
                                    @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')
                                        @if(is_admin(auth()->user())!='false')
                                        <option value="inhouse">inHouse</option>
                                        <option value="upload">User upload</option>
                                        @endif
                                        <option value="deleted">Trash</option>
                                    @elseif(is_admin(auth()->user())=='admin')
                                        <option value="upload">User upload</option>
                                        <option value="deleted">Trash</option>
                                    @endif
                                </select>
                                @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())!=='false')
                                <hr>
                                <button id="remove" class="btn btn-danger" disabled>Delete</button>
                                <button id="restore" class="btn btn-success" disabled>Restore</button>
                                @endif
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="audioTable" data-show-export="true" data-toolbar="#toolbar"
                                data-side-pagination="server"
                                data-url="{!! route('admin.audio.index') !!}"
                                data-auto-refresh="false"
                                data-search-on-enter-key="true"
                                >
                                <thead>
                                    <tr>
                                        <th field="state" data-checkbox="true">ID</th>
                                        <th field="id" data-width="160">ID</th>
                                        <th field="name" data-editable="false" data-width="400">Audio</th>
                                        <th field="email" data-width="200" data-editable="false">Source</th>
                                        <th field="complete">View</th>
                                        <th field="task" data-editable="false">Comment</th>
                                        <th field="date" data-editable="false">Liked</th>
                                        <th field="phone" data-width="150" data-editable="false">Created Date</th>
                                        <th field="progress_label" data-editable="false">Progress</th>
                                        <th field="status_label" data-editable="false">Status</th>
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
        $('#loading').modal({backdrop: 'static', keyboard: false});
		var show_url = '{{ route("admin.audio.show", ":id") }}';
        var delete_url = '{{ route("admin.audio.delete") }}';
        var restore_url = '{{ route("admin.audio.restore") }}';
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
                'audioslide-'+data,
				'</a> ',
			].join('')
        }

        function sourceFormatter(data, row) {
            var detail = '';
            if(row.source_label.channel){
                detail = detail+'Channel: '+row.source_label.channel;
            }
            if(row.source_label.category){
                detail = detail+'<br>Category: '+row.source_label.category;
            }
            if(row.source_label.project){
                detail = detail+'<br>Project: '+row.source_label.project;
            }
            if(row.source_label.team){
                detail = detail+'<br>Team: '+row.source_label.team;
            }
			return [
				'<b>'+data+'</b><br><small>'+detail+'</small>',
			].join('');
		}

        function progressFormatter(data, row) {
            label= 'info'; 
            if(data == 'Studio'){
                text= 'Studio'; 
                label= 'warning'; 
            }else if(data == 'review' && row.status != 'publish'){
                text= 'Waiting for Approved'; 
                label= 'primary'; 
            }else if(data == 'step1'){
                text= 'Writing Process'; 
            }else if(data == 'step2'){
                text= 'Audio production Process'; 
            }else if(data == 'step3'){
                text= 'Slide managing Process'; 
            }else if(data == 'step4'){
                text= 'Image Designing Process'; 
            }else if(data == 'step5'){
                text= 'Waiting for Approval'; 
                label= 'info'; 
            }else{
                text= 'Completed'; 
                label= 'success'; 
            }
            return '<span class="label label-'+label+'">'+text+'</span>';
		}

		var oTable = $table.bootstrapTable({
			pagination: true,
			search: true,
			columns: [
				{ field: 'state' },
				{ field: 'format_id', formatter: operateFormatter },
				{ field: 'name', formatter: nameFormatter },
				{ field: 'source_label.name', formatter: sourceFormatter },
				{ field: 'play_number' },
				{ field: 'comment_number' },
				{ field: 'like_number' },
				{ field: 'date_label'},
				{ field: 'progress_label', formatter: progressFormatter },
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

        $restore.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });

            $table.bootstrapTable('remove', {
                field: 'id',
                values: ids,
            });

            //AJAX RESTORE HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: restore_url,
                type: 'POST',
                dataType: "JSON",
                data: {
                    "id": ids
                },
                success: function (response)
                {
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Message"});

                }
            });
            $remove.prop('disabled', true);
            $restore.prop('disabled', true);
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
