@extends('layouts.web.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="widgets-programs-area mg-t-30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="hpanel widget-int-shape responsive-mg-b-30">
                                    <div class="panel-body">
                                        <div class="stats-title pull-left">
                                            <h4 style="text-transform: uppercase;">{{$name}}</h4>
                                        </div>
                                        <div class="stats-title pull-right">
                                            <!-- <a href="/feed/history"><h5>LIHAT</h5></a> -->
                                        </div>
                                        <div class="m-t-xl widget-cl-1">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    @foreach($data as $log)
                                                        @if(@$log->audio)
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 video-list-vertical1">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cover-content">
                                                                    <div class="courses-title text-center">
                                                                        <a href="{{route('web.listen', [@$log->audio->slug])}}">
                                                                            <div class="cover-image image-audio-cover">
                                                                                <img src="{{get_audio_cover(@$log->audio)}}" />
                                                                            </div>
                                                                            <span class="badge badge-time">{{format_time(@$log->audio->duration)}}</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="title-content">
                                                                    <div class="mg-t-5">
                                                                        <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
                                                                            <h3 class="height-30 lh-06">
                                                                                <a href="{{route('web.listen', [@$log->audio->slug])}}" title="{{@$log->audio->name}}">
                                                                                    {{short_text(@$log->audio->name, 50)}}
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-audio">
                                                                            <div class="courses-alaltic">
                                                                                <a href="{{route('web.channel.show', [@$log->audio->channel->slug])}}" title="{{@$log->audio->channel->name}} ">
                                                                                    <small class="course-icon lh-normal">
                                                                                        {{@$log->audio->channel->name}} 
                                                                                        @if(@$log->audio->channel->isVerified())<i class="fa fa-check-circle"></i>@endif
                                                                                    </small>
                                                                                </a>
                                                                                <hr class="br-time-view">
                                                                                <small>{{count_format(@$log->audio->play_number)}}</small>
                                                                                <small class="course-icon">•</small>
                                                                                <small>{{@$log->audio->date_label}}</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endforeach
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
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <div class="widgets-programs-area mg-t-60">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="text-center">
                                <div class="">
                                    <img style="border-radius: 50%;" src="{{get_avatar($user)}}" alt="" />
                                </div>
                                <br>
                                <h4>{{$user->name}}</h4>
                                <p>Terdaftar pada {{$user->created_at}}</p>
                            </div>
                            <div class="static-table-list">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Subscriptions</td>
                                            <td>{{$user->subscribtions->count()}}</td>
                                        </tr>
                                        <tr>
                                            <td>Uploads</td>
                                            <td>{{$user->audios()->count()}}</td>
                                        </tr>
                                        <tr>
                                            <td>Likes</td>
                                            <td>{{$user->likes->count()}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection