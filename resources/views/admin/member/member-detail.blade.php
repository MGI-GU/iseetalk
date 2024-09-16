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
                            <a class="btn back-btn" href="{{route('admin.member.index')}}"><i class="fa fa-angle-left"></i></a>
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Admin Information</a></li>
                                <!-- <li><a href="#team"> Team Information</a></li> -->
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                            @if(is_admin(auth()->user())!=='false' && $member->id!==1)
                            <div class="display-flex pull-right">
                                <a href="{{route('admin.user.edit', [$member->role->user->format_id])}}" class="btn btn-default">EDIT USER PROFILE</a>
                                <span class="mg-5"></span>
                                <a type="submit" class="btn btn-success save">SAVE</a>
                                <span class="mg-5"></span>
                                {!!Form::open()->delete()->route('admin.member.deleteByid', [$member->id])!!}
                                    {!!Form::hidden('id')->value($member->id)!!}
                                    <button type="submit" class="btn btn-danger">Delete from Admin</button>
                                {!! Form::close() !!}
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-8 col-sm-4 col-xs-12 mg-b-15 well">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mg-b-15">
                                                            <label for="avatar">Profile PIC</label>
                                                            <div class="text-center">
                                                                <img class="round-img" src="{{$member->role->user->picture}}" />
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-4 col-xs-12 mg-b-15">

                                                        <!-- <div id="app" class="form-group alert-up-pd mg-t-10">
                                                            <upload :id={{ $member->role->user->id }} placeholder-text="image" type-data="image" model-data="user" slug-url="{{$member->role->user->attachment_source ? route('admin.upload.update', [$member->role->user->attachment_source->id]):route('admin.upload.store')}}"></upload>
                                                        </div> -->
                                                            {!!Form::text('name', 'Nama', $member->role->user->name)->autocomplete('off')->disabled()!!}
                                                            {!!Form::text('email', 'Email', $member->role->user->email)->autocomplete('off')->disabled()!!}
                                                            {!!Form::text('phone', 'No. Handphone', $member->role->user->phone)->autocomplete('off')->disabled()!!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                                    {!!Form::open()->put()->route('admin.member.update', [$member->id])->id('save_form')!!}
                                                        {!!Form::select('status', 'Status', ['active'=>'Active','suspend'=>'Suspend'], $member->role->status)!!}
                                                        {!!Form::select('role_id', 'Role', get_role_team($member->role->user->type)->toArray(), $member->role->role_id)!!}
                                                        @if($member->role->role_id>2)
                                                        <div id="app" class="selector_category">
                                                            <multi-select data-label="Category" data-name="category" data-placeholder="Select Categories" :option='{{ json_encode(get_active_categories("vue")) }}' :values='{{$member->category ? json_encode($member->category,TRUE):[]}}'></multi-select>
                                                        </div>
                                                        @endif
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade" id="team">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="profile-info-inner">
                                        <div class="profile-img">
                                            <img src="img/profile/1.jpg" alt="" />
                                        </div>
                                        <div class="profile-details-hr">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="address-hr">
                                                        <p><b>Role</b><br /> {{ $member->role->user->type }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                    <div class="profile-info-inner">
                                        <div class="static-table-list">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Team Name</th>
                                                        <th>Assign as</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($member->role->user->roleusers as $key => $team)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td><a href="{{ route('admin.team.edit', [$team->team->id ?? 0]) }}">{{@$team->team->name}}</a></td>
                                                        <td>{{$team->user->name}}</td>
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
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
     <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-table.css')}}">
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-editable.css')}}">
@endsection

@section('script')
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
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
    <script>
        $(".save").click( function() {
            $('#save_form').submit();
        });
        $('#inp-role_id').on('change', function() {
            if(this.value<=2){
                $('.selector_category').hide();
                $('#select_category').prop('disabled', 'disabled');
            }else{
                $('.selector_category').show();
                $('#select_category').prop('disabled', false);
            }
        });
    </script>
@endsection
