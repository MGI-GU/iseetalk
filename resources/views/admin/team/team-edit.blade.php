@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st mg-t-30">
                <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <a class="btn back-btn" href="{{route('admin.team.index')}}"><i class="fa fa-angle-left"></i></a>
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Data team</a></li>
                                <li><a href="#perform">Data Performance</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                            @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')
                                <a class="btn btn-default" data-toggle="modal" data-target="#add">ADD MEMBER</a>
                                <a href="#" class="btn btn-success save">SAVE</a>
                            @endif
                        </div>
                    </div>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="" class="pro-ad">
                                            {!!Form::open()->put()->route('admin.team.update', [$team->id])->id('team_form')!!}

                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        @if($team->categoryTeam)
                                                            <label for="">Category</label>
                                                            <div>
                                                                {{@$team->categoryTeam->category->name}}
                                                                <a class="btn btn-xs btn-danger" href="{{route('admin.team.remove.category', [$team->id])}}" title="Ganti Kategori"><i class="fa fa-edit"></i></a>
                                                            </div>
                                                            <br>
                                                        @else
                                                            <label for="">Category</label>
                                                            <!-- {!!Form::select('category', 'Kategori', get_team_categories()->toArray())!!} -->
                                                            <select name="category" class="selectpicker form-control" >
                                                                <option selected value="">-- Select Categories --</option>
                                                                @foreach(get_active_categories() as $cat)
                                                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                                    @if($cat->subcategory->count()>0))
                                                                    <optgroup label="-">
                                                                        @foreach($cat->subcategory as $sub)
                                                                        <option value="{{$sub->id}}">{{$sub->name}}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <br>
                                                        @endif
                                                        <div class="form-group">
                                                            <label for="">Team ID</label>
                                                            <p>{{$team->format_id}}</p>
                                                        </div>
                                                        {!!Form::text('name', 'Name', $team->name)->autocomplete('off')!!}
                                                        {!!Form::textarea('description', 'Description', $team->description)->autocomplete('off')!!}
                                                        <!-- <div class="payment-adress">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">SAVE</button>
                                                        </div> -->
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="sparkline13-graph">
                                                            <div class="datatable-dashv1-list custom-datatable-overright">
                                                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                                                    data-cookie-id-table="saveId" data-show-export="true" data-toolbar="#toolbar">
                                                                    <thead>
                                                                        <tr>
                                                                            <th data-field="id" data-editable="false">ID</th>
                                                                            <th data-field="name" data-editable="false">Name</th>
                                                                            <th data-field="role" data-editable="false">Role</th>
                                                                            <th data-field="action" data-editable="false">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade" id="perform">
                            <div class="mg-t-15">
                                <div class="row">

                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                        <div class="box white-box">
                                            <h4 class="text-left">Number of Audio </h4>
                                            <div class="row">
                                                <!-- <div class="col-lg-4">
                                                    <div class="mg-t-15 text-left">
                                                        <p>Perminggu</p>
                                                        <h1>1</h1>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mg-t-15 text-left">
                                                        <p>Perbulan</p>
                                                        <h1>4</h1>
                                                    </div>
                                                </div> -->
                                                <div class="col-lg-4">
                                                    <div class="mg-t-15 text-left">
                                                        <p>Total</p>
                                                        <h1>{{$team->categoryTeam?$team->categoryTeam->category->audios->count():'Not Set'}}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                        <div class="box white-box">
                                            <h4 class="text-left">Jumlah Played </h4>
                                            <div class="row">
                                                <!-- <div class="col-lg-4">
                                                    <div class="mg-t-15 text-left">
                                                        <p>Perminggu</p>
                                                        <h1>1</h1>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mg-t-15 text-left">
                                                        <p>Perbulan</p>
                                                        <h1>4</h1>
                                                    </div>
                                                </div> -->
                                                <div class="col-lg-4">
                                                    <div class="mg-t-15 text-left">
                                                        <p>Total</p>
                                                        <h1>0</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
    <div id="add" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-color-modal bg-color-1">
                    <h4 class="modal-title">Add member team</h4>
                    <div class="modal-close-area modal-close-df">
                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div class="modal-body">

                    {!!Form::open()->post()->route('admin.team.add.user', [$team->id])!!}

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                                <input-select data-label="Select User" data-name="user" data-placeholder="Select user" :option='{{ json_encode(get_user_teams("vue")) }}' :values='[]'></input-select>
                                {!!Form::select('role', 'Role', get_role_team('team_member')->toArray())!!}

                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">ADD</button>
                                </div>
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <div id="update" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-color-modal bg-color-1">
                    <h4 id="title_member_update" class="modal-title">Update member team</h4>
                    <div class="modal-close-area modal-close-df">
                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div class="modal-body">

                    {!!Form::open()->put()->route('admin.team.update.user', [$team->id])->id('form-update-member')!!}

                        <div class="row">
                            @include('layouts.loading.load4')
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left form-update">
                                {!!Form::select('user_id', 'User', get_user_teams())!!}
                                <div id="select_role">
                                    {!!Form::select('role_id', 'Role', get_role_team('team_member')->toArray())!!}
                                </div>

                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">UPDATE</button>
                                </div>
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/modals.css') }}">
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-table.css')}}">
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-editable.css')}}">
    <link rel="stylesheet" href="{{ url('css/preloader/preloader-style.css')}}">
@endsection

@section('script')
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
    <!-- data table JS
    ============================================ -->
    <script src="{{ url('js/data-table/bootstrap-table.js')}}"></script>
    <script type="text/javascript">
		var edit_url = '{{ route("admin.team.edit", ":id") }}';
		var delete_url = '{{ route("admin.team.remove.user", ":id") }}';
		var user_url = '{{ route("admin.user.edit", ":id") }}';

		function operateFormatter(data,row) {
            var $delete = '';
            if(row.role_id!=3){
                $delete = '<a class="btn btn-danger" href="'+delete_url.replace(":id", row.team_id)+'?id='+row.id+'" title="delete"><i class="fa fa-trash"></i></a>'
            }
            return [
                '<a class="btn btn-default edit-member" data-toggle="modal" data-target="#update" href="#" data-id="'+row.id+'" title="edit">',
                '<i class="fa fa-edit"></i>',
                '</a> ',
                $delete
            ].join('');
		}
        function userFormatter(data) {
			return [
				'<a class="btn-link" href="'+user_url.replace(":id", data)+'" title="'+data+'">',
                'user-'+data,
				'</a> ',
			].join('')
        }
		var oTable = $('#table').bootstrapTable({
			pagination: true,
			search: true,
			url: '{!! route("admin.team.edit", $team->id) !!}',
			columns: [
				{ field: 'user.format_id', formatter: userFormatter },
				{ field: 'user_name' },
				{ field: 'role_name' },
				{ field: 'id', formatter: operateFormatter }
			]
        });

        var edit_member_url = '{{ route("admin.team.get.user", ":id") }}';
        var form_edit_member_url = '{{ route("admin.team.update.user", ":id") }}';
        $("#table").on("click", ".edit-member", function(){
            $(".loading").show();
            $(".form-update").hide();
            $("#form-update-member").attr('action', form_edit_member_url);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: edit_member_url.replace(":id", $(this).attr('data-id')),
                type: 'get', // replaced from put
                dataType: "JSON",
                success: function (response)
                {
                    $("#form-update-member").attr('action', form_edit_member_url.replace(":id", response.id));
                    $("#inp-user_id").val(response.user_id);
                    $("#inp-role_id").val(response.role_id);
                    if(response.role_id==3){
                        $("#select_role").hide();
                        $('#title_member_update').text("Update user Leader");
                    }else{
                        $("#select_role").show();
                        $('#title_member_update').text("Update Team Member");
                    }
                    $(".form-update").show();
                    $(".loading").hide();

                },
                error: function(xhr,response) {
                    console.log(response);
                }
            });
        });
        $(".save").click( function() {
            $('#team_form').submit();
        });
	</script>
@endsection
