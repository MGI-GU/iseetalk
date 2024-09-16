@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-15 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st mg-t-30">
                    <a class="btn back-btn" href="{{route('admin.role.index')}}"><i class="fa fa-angle-left"></i></a>
                    <ul id="myTabedu1" class="tab-review-design">
                        <li class="active"><a href="#description">Add Role</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="" class="pro-ad">
                                            {!!Form::open()->post()->route('admin.role.store')!!}
                                                <div class="row">
                                                    <div id="app" class="col-md-offset-3 col-lg-6 col-md-6 col-sm-12 col-xs-12 well">
                                                        {!!Form::text('name', 'Name')->autocomplete('off')!!}
                                                        {!!Form::select('type', 'Type of Role', ['admin'=>'General Admin','team'=>'Team Member'])!!}
                                                        <!-- <div id="select_role">
                                                            {!!Form::select('role_for', 'Select Role', ['super_admin'=>'Super Admin','master_admin'=>'Master Member','leader'=>'Team Leader'])!!}
                                                        </div> -->
                                                        {!!Form::textarea('description', 'Description')->autocomplete('off')!!}
                                                        <!-- <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="i-checks pull-left">
                                                                    <label><input type="checkbox" name="role_for" value="1"> <i></i> Role for Team Member ? </label>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <div class="payment-adress">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">SAVE</button>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 well">
                                                        <div class="chosen-select-single">
                                                            {!!Form::select('permission[]', 'PERMISSION', get_permission())->multiple()->attrs(['class' => 'chosen-select role'])!!}
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 well">
                                                        <div class="row">
                                                            @foreach( get_permission() as $role)
                                                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 mg-t-5">
                                                                    <div class="mg-b-15">
                                                                        <div>
                                                                            <small>{{$role->name}}</small>
                                                                            <div class="onoffswitch pull-right">
                                                                                <input type="checkbox" name="permission[]" class="onoffswitch-checkbox" value="{{$role->id}}" id="{{$role->name}}">
                                                                                <label class="onoffswitch-label" for="{{$role->name}}">
                                                                                    <span class="onoffswitch-inner"></span>
                                                                                    <span class="onoffswitch-switch"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div> -->

                                            {!! Form::close() !!}
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
@endsection

@section('style')
    <!-- chosen CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('css/chosen/bootstrap-chosen.css') }}">
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
@endsection

@section('script')
    <!-- chosen JS
		============================================ -->
    <script src="{{ url('js/chosen/chosen.jquery.js') }}"></script>
    <script src="{{ url('js/chosen/chosen-active.js') }}"></script>
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
    <script>
        $('#inp-type').on('change', function() {
            if(this.value=='admin' || this.value=='team'){
                $('#select_role').hide();
                $('#inp-role_for').prop('disabled', 'disabled');
            }else{
                $('#select_role').show();
                $('#inp-role_for').prop('disabled', false);
            }
        });
    </script>
@endsection
