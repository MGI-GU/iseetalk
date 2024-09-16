@extends('layouts.studio.main')

@section('content')
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list1 white-box">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Data Audioslide</h1>
                        </div>
                    </div>
                    <div id="app" class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                            </div>
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <!-- <th data-field="state" data-checkbox="false"></th> -->
                                        <th data-field="name" data-width="40%" data-editable="false">Audio</th>
                                        <th data-field="email" data-editable="false">Visibility</th>
                                        <th data-field="email" data-editable="false">Status</th>
                                        <th data-field="phone" data-editable="false">Created At</th>
                                        <th data-field="complete" data-width="60" >View</th>
                                        <th data-field="task" data-width="60" data-editable="false">Comment</th>
                                        <th data-field="date" data-width="60" data-editable="false">Like/Dislike</th>
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
		var show_url = '{{ route("studio.audio.show", ":id") }}';

        function nameFormatter(data, row) {
			return [
                '<div class="row"><div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><a href="'+show_url.replace(":id", row.slug)+'"><div class="cover-image image-audio-cover" style="background:url('+row.src_cover+');"></div></a></div>',
                '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><p>',
				'<a href="'+show_url.replace(":id", row.slug)+'">'+data+'</a><br><small>'+row.description+'</small>',
                '</p></div></div>',
			].join('')
        }
        
        function likeDislike(data, row) {
			return [
                '<small>'+data+'</small>',
                '<small> / </small>',
                '<small>'+row.dislike_number+'</small>',
                '</p></div></div>',
			].join('')
		}

		var oTable = $('#table').bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("studio.audio.index") !!}',
			columns: [
				{ field: 'name', formatter: nameFormatter },
				{ field: 'visibility_label'},
				{ field: 'status_label'},
				{ field: 'date_label'},
				{ field: 'play_number' },
				{ field: 'comment_number' },
				{ field: 'like_number', formatter: likeDislike },
			]
		});
	</script>
@endsection