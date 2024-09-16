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
                        <li class="active"><a href="#description">Account Information</a></li>
                        <li><a href="#reviews"> Content Information</a></li>
                        <li><a href="#information">Social Information</a></li>
                        @if($user->type!='streamer' && $user->type!='creator')
                        <li><a href="#team">Role Information</a></li>
                        @endif
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="clearfix"></div>
                                                    <div class="text-center">
                                                        <img class="round-img" src="{{$user->picture}}" />
                                                    </div>
                                                    <div class="clearfix"></div><br>
                                                    <div class="form-group">
                                                        <label>Verified at</label>
                                                        <p>{{$user->email_verified_at ? $user->email_verified_at->format('d M Y'):'-'}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Register at</label>
                                                        <p>{{$user->created_at ? $user->created_at->isoFormat('d MMMM Y'):'-'}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-4 col-sm-4 col-xs-12 well">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Full Name</label>
                                                                <p>{{$user->name}}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <p>{{$user->email}}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>No. Handphone</label>
                                                                <p>{{$user->phone}}</p>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <div class="input-daterange input-group" id="datepicker">
                                                                    {!! Form::text('birthday', 'Tanggal Lahir', $user->birthday)->autocomplete('off')->attrs(['class' => 'form-control']) !!}
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <p>{{$user->status}}</p>
                                                            </div>
                                                            @if($user->type=='streamer' || $user->type=='creator')
                                                                <div class="form-group">
                                                                    <label>Type</label>
                                                                    <p>{{$user->type}}</p>
                                                                </div>
                                                            @else
                                                                @if($user->admin)
                                                                <div class="form-group">
                                                                    <label>Type</label>
                                                                    <br>
                                                                    <a class="btn btn-danger" href="{{route('admin.member.edit', [$user->admin->format_id])}}">{!!@$user->admin->role->role->name!!}</a>
                                                                </div>
                                                                @endif
                                                            @endif
                                                            <div class="form-group">
                                                                <label>Gender</label>
                                                                <p>{{$user->sex}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(is_admin(auth()->user())!=='false')
                                                    <div class="payment-adress pull-right">
                                                        <a href="{{route('admin.user.edit', [$user->format_id])}}" class="btn btn-primary waves-effect waves-light">EDIT</a>
                                                    </div>
                                                    @endif
                                                </div>
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
                        <div class="product-tab-list tab-pane fade" id="reviews">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="hpanel widget-int-shape responsive-mg-b-30">
                                        <div class="panel-body">
                                            <div class="stats-title pull-left">
                                                <h5>Channels</h5>
                                            </div>
                                            <div class="m-t-xl widget-cl-1">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        @if($user->channels->count()>0)
                                                            @foreach($user->channels as $channel)
                                                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 video-list-vertical">
                                                                <div>
                                                                    <div class="courses-title" style="height: 100px;">
                                                                        <a href="{{route('admin.channel.show', [$channel->id])}}"><img style="height: 100px;" src="{{get_attachment_source($channel)->slug}}" alt=""></a>
                                                                    </div>
                                                                    <h5 class="mg-t-10" style="height: 20px;" >
                                                                        <a href="{{route('admin.channel.show', [$channel->id])}}">
                                                                            <div class="">
                                                                                <div class="">
                                                                                    {{$channel->name}}
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </h5>
                                                                    <div class="courses-alaltic">
                                                                        <small>{{$channel->audios->count()}} Audio</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @else
                                                        <p class="text-center">User ini belum memiliki channel</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="hpanel widget-int-shape responsive-mg-b-30">
                                        <div class="panel-body">
                                            <div class="stats-title pull-left">
                                                <h5>Audio</h5>
                                            </div>
                                            <div class="m-t-xl widget-cl-1">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        @if($user->audios->count()>0)
                                                            @foreach($user->audios as $audio)
                                                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 video-list-vertical">
                                                                <div>
                                                                    <div class="courses-title" style="height: 100px;">
                                                                        <a href="{{route('admin.audio.show', [$audio->id])}}"><img style="height: 100px;" src="{{get_audio_cover($audio)}}" alt=""></a>
                                                                    </div>
                                                                    <h5 class="mg-t-10" style="height: 20px;" >
                                                                        <a href="{{route('admin.audio.show', [$audio->id])}}">
                                                                            <div class="">
                                                                                <div class="">
                                                                                    {{$audio->name}}
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </h5>
                                                                    <div class="courses-alaltic">
                                                                        <small>{{$audio->play_number}} diputars</small>
                                                                        <small class="course-icon">-</small>
                                                                        <small>{{$audio->date_label}}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @else
                                                        <p class="text-center">User ini belum memiliki audio</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade" id="information">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="devit-card-custom">
                                                    @if($user->medias->count()>0)
                                                        @foreach($user->medias as $media)
                                                            {!!Form::text($media->media, $media->media, $media->url)->autocomplete('off')!!}
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade" id="team">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="row">
                                            <div class="col-lg-offset-1 col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                                <div class="devit-card-custom">
                                                    @if($user->type!='streamer' && $user->type!='creator')
                                                    
                                                        @if($user->admin)
                                                            <label>Type</label>
                                                            <br>
                                                            <a class="btn btn-danger" href="{{route('admin.member.edit', [$user->admin->format_id])}}">{!!@$user->admin->role->role->name!!}</a>
                                                        @else
                                                            <label>Team</label>
                                                            <br>
                                                            <div class="datatable-dashv1-list custom-datatable-overright">
                                                                <table id="table" class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th data-field="id" data-editable="false">ID</th>
                                                                            <th data-field="name" data-editable="false">Team</th>
                                                                            <th data-field="role" data-editable="false">Role</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($user->roleusers as $role)
                                                                            @if($role->team)
                                                                                <tr>
                                                                                    <td><a class="btn btn-link" href="{{route('admin.team.show', [$role->team->format_id])}}">{{$role->team->format_id}}</a></td>
                                                                                    <td>{{$role->team->name}}</td>
                                                                                    <td>{{$role->role_name}}</td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                    @endif

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
