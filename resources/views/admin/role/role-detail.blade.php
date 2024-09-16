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
                            <a class="btn back-btn" href="{{route('admin.role.index')}}"><i class="fa fa-angle-left"></i></a>
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Data</a></li>
                                <li><a href="#user" >User ({{$role->rolebyuser->count()}})</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                            @if($role->type!='default')
                            <div class="display-flex pull-right">
                                <a type="submit" class="btn btn-success save">SAVE</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="" class="pro-ad">

                                            {!!Form::open()->put()->route('admin.role.update', [$role->id])->id('save_form')!!}
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <h3 class="text-capitalize">{!!$role->type_label!!}</h3>
                                                        <br>
                                                        {!!Form::text('name', 'Name', $role->name)->autocomplete('off')->disabled($role->type!='default'?false:true)!!}
                                                        {!!Form::textarea('description', 'Description', $role->description)->autocomplete('off')->disabled($role->type!='default'?false:true)!!}
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <!-- <div class="i-checks pull-left">
                                                                    <label><input type="checkbox" name="role_for" value="1" > <i></i> Role for Team Member ? </label>
                                                                </div> -->
                                                                <!-- {!!Form::radio('role_for', 'Role for General Admin', 'admin', $role->role_for=='admin'?1:0)!!}
                                                                {!!Form::radio('role_for', 'Role for Team Member', 'team_member', $role->type=='team'?1:0)!!}
                                                                <hr>
                                                                {!!Form::radio('role_for', 'Default Role - Team Leader', 'leader', $role->role_for=='leader'?1:0)!!}
                                                                {!!Form::radio('role_for', 'Default Role - Master Admin', 'master_admin', $role->role_for=='master_admin'?1:0)!!}
                                                                {!!Form::radio('role_for', 'Default Role - Super Admin', 'super_admin', $role->role_for=='super_admin'?1:0)!!} -->
                                                                <hr>
                                                                @if($role->type!='default')
                                                                {!!Form::select('status', 'Status', ['active'=>'Active','disable'=>'Disable'], $role->status)!!}
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 well">
                                                        <div class="chosen-select-single">
                                                            {!!Form::select('permission[]', 'PERMISSION', get_permission(),$role->permission->pluck('pivot.permission_id')->toArray())->multiple()->attrs(['class' => 'chosen-select role'])!!}
                                                        </div>
                                                    </div> -->
                                                    <label class="text-capitalize">Set Permission {{$role->type}}</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="row">
                                                            @php ($model = '')
                                                            @foreach( get_permission($role->type, $role->role_for) as $data)
                                                                @if($model!=$data->model)
                                                                    <div class="col-lg-12"><hr><h5 class="text-capitalize">{{$data->model}}</h5></div>
                                                                @endif
                                                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 mg-t-5" style=" background: #ddd; border: 2px #fff solid; ">
                                                                    <div class="mg-b-15">
                                                                        <div class="checkbox-title-pro" style=" margin-top: 15px;">
                                                                            <div>
                                                                                <small>{{$data->name}}</small>
                                                                                <div class="onoffswitch pull-right">
                                                                                @if($role->type!='default')
                                                                                    <input type="checkbox" {{in_array($data->id, $role->permission->pluck('pivot.permission_id')->toArray()) ? 'checked=""' : ''}} name="permission[]" class="onoffswitch-checkbox" value="{{$data->id}}" id="{{$data->name}}">
                                                                                @else
                                                                                    <input type="checkbox" {{$role->type=='default'?'disabled':''}} {{in_array($data->id, $role->permission->pluck('pivot.permission_id')->toArray()) ? 'checked=""' : ''}} class="onoffswitch-checkbox">
                                                                                @endif
                                                                                    <label class="onoffswitch-label" for="{{$data->name}}">
                                                                                        <span class="onoffswitch-inner"></span>
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @php ($model = $data->model)
                                                            @endforeach
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade " id="user">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="" class="pro-ad">
                                            <div class="datatable-dashv1-list custom-datatable-overright">
                                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-toolbar="#toolbar">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="id" data-editable="false">ID</th>
                                                            <th data-field="name" data-editable="false">Name</th>
                                                            <th data-field="status" data-editable="false">Status</th>
                                                            <th data-field="updated_at" data-editable="false">Date</th>
                                                            <!-- <th data-field="action" data-editable="false">Action</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($role->rolebyuser as $user)
                                                        <tr>
                                                            <td>{{$user->user->id}}</td>
                                                            <td>{{$user->user->name}}</td>
                                                            <td>{!!$user->status_label!!}</td>
                                                            <td>{{$user->updated_at ? $user->updated_at->format('d M Y') : '-'}}</td>
                                                            <!-- <td>
                                                                <a  data-toggle="modal" data-target="#add" class="btn btn-xs btn-warning">Edit</a>
                                                            </td> -->
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
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
<br><br>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-table.css')}}">
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-editable.css')}}">
    <!-- chosen CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('css/chosen/bootstrap-chosen.css') }}">
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <style>
        .disable input{

        }
    </style>
@endsection

@section('script')
    <!-- chosen JS
		============================================ -->
    <script src="{{ url('js/chosen/chosen.jquery.js') }}"></script>
    <script src="{{ url('js/chosen/chosen-active.js') }}"></script>
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
    <script src="{{ url('js/data-table/bootstrap-table.js')}}"></script>
    <script>
        $(".save").click( function() {
            $('#save_form').submit();
        });
    </script>
@endsection
