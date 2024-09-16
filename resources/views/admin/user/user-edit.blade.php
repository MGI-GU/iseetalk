@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-30 mg-b-15">
    <div  class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st mg-t-30">
                <a class="btn back-btn" href="{{url()->previous()}}"><i class="fa fa-angle-left"></i></a>
                    <ul id="myTabedu1" class="tab-review-design">
                        <li class="active"><a href="#description">Edit Account Information</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad">
                                                <div class="row">
                                                    {!!Form::open()->put()->route('admin.user.update', [$user->id])->id('form_user')!!}
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                                            <div class="clearfix"></div>
                                                            <div class="text-center">
                                                                <img class="round-img" src="{{$user->picture}}" />
                                                            </div>
                                                            <div class="clearfix"></div><br>
                                                            <div id="app" class="form-group alert-up-pd">
                                                                <upload placeholder-text="update image" :id={{ $user->id }} type-data="image" model-data="user" slug-url="{{$user->attachment_source ? route('admin.upload.update', [$user->attachment_source->id]):route('admin.upload.store')}}"></upload>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Verified at</label>
                                                                <p>{{$user->email_verified_at ? $user->email_verified_at->format('d M Y'):'-'}}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Register at</label>
                                                                <p>{{$user->created_at ? $user->created_at->isoFormat('d MMMM Y'):'-'}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-offset-1 col-lg-5 col-md-4 col-sm-4 col-xs-12 well">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                                                    {!!Form::text('name', 'Nama', $user->name)->autocomplete('off')!!}
                                                                    {!!Form::text('email', 'Email', $user->email)->autocomplete('off')!!}
                                                                    {!!Form::text('phone', 'No. Handphone', $user->phone)->autocomplete('off')!!}
                                                                    <!-- <div class="form-group">
                                                                        <div class="input-daterange input-group" id="datepicker">
                                                                            {!! Form::text('birthday', 'Tanggal Lahir', $user->birthday)->autocomplete('off')->attrs(['class' => 'form-control']) !!}
                                                                        </div>
                                                                    </div> -->
                                                                </div>
                                                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                                                    {!!Form::select('status', 'Status', ['active'=>'Active', 'inactive'=>'Non Active', 'disable'=>'Disable'], $user->status)!!}
                                                                    @if($user->type=='streamer' || $user->type=='creator')
                                                                        {!!Form::select('type', 'Type', ['streamer'=>'Streamer','creator'=>'Creator'], $user->type)!!}
                                                                    @else
                                                                        @if($user->admin)
                                                                        <div class="form-group">
                                                                            <label>Type</label>
                                                                            <br>
                                                                            <a class="btn btn-danger" href="{{route('admin.member.edit', [$user->admin->format_id])}}">{!!@$user->admin->role->role->name!!}</a>
                                                                        </div>
                                                                        @endif
                                                                    @endif
                                                                    {!!Form::select('sex', 'Gender', ['none'=>'None','male'=>'Laki-laki','women'=>'Perempuan','privacy'=>'Privat'], $user->sex)!!}
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="payment-adress pull-right">
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">SAVE</button>
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}

                                                    {!!Form::open()->put()->route('admin.user.update', [$user->id])!!}
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                                            <div class="well">
                                                                {!!Form::text('password', 'Update password')->placeholder('New Password')->type('password')!!}
                                                                {!!Form::text('password_confirmation', '')->placeholder('Confirmation New Password')->type('password')!!}
                                                                <div class="payment-adress">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">UPDATE</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
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
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ url('css/datapicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ url('css/select2/select2.min.css') }}">
	<link rel="stylesheet" href="{{ url('css/chosen/bootstrap-chosen.css') }}">
@endsection

@section('script')
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
    <script src="{{ url('js/datapicker/bootstrap-datepicker.js') }}"></script>
	<script src="{{ url('js/datepicker/datepicker-active.js') }}"></script>
	<script src="{{ url('js/chosen/chosen.jquery.js') }}"></script>
	<script src="{{ url('js/chosen/chosen-active.js') }}"></script>
    <script src="{{ url('js/select2/select2.full.min.js') }}"></script>
	<script src="{{ url('js/select2/select2-active.js') }}"></script>
    <script>
        $('#form_user input').change(function(e){
            e.preventDefault();
            save();
        });
        $('#form_user select').change(function(e){
            e.preventDefault();
            save();
        });

        function save() {
            $.ajax({
				url: $('#form_user').attr('action'),
				type: 'put',
				data: $('#form_user').serialize()+$(this).serialize()
			}).done(function(data){
				console.log(data);
			}).error(function(e){
				console.log(e);
			});
        }
    </script>
@endsection
