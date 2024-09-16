@extends('layouts.web.main')

@section('content')
    <div class="widgets-programs-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="">
                        <div class="panel-body">
                            
                            <div class="widget-cl-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="stats-title pull-left col-lg-12 col-xs-12">
                                            <h5><a href="/trending">Trending</a></h5>
                                        </div>
                                        @foreach(get_trend_audio() as $tren_audio)
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 video-list-vertical1">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cover-content">
                                                        <div class="courses-title text-center">
                                                            <a href="{{route('web.listen', [$tren_audio->slug])}}">
                                                                <div class="cover-image image-audio-cover">
                                                                    <img src="{{get_audio_cover($tren_audio)}}" />
                                                                </div>
                                                                <span class="badge badge-time">{{format_time($tren_audio->duration)}}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="title-content">
                                                        <div class="mg-t-5">
                                                            <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
                                                                <h3 class="height-30 lh-06">
                                                                    <a href="{{route('web.listen', [$tren_audio->slug])}}" title="{{$tren_audio->name}}">
                                                                        {{short_text($tren_audio->name, 50)}}
                                                                    </a>
                                                                </h3>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2 text-left">
                                                                <a href="{{route('web.channel.show', [$tren_audio->channel->slug])}}">
                                                                    <img class="channel-img message-avatar round-img border" style="width: 36px;" src="{{@$tren_audio->channel->src_cover}}" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-10 col-xs-10 title-audio">
                                                                <div class="courses-alaltic">
                                                                    <a href="{{route('web.channel.show', [$tren_audio->channel->slug])}}" title="{{@$tren_audio->source_label->channel}}">
                                                                        <small class="course-icon lh-normal">{{@$tren_audio->channel->name}} <i class="fa fa-check-circle"></i></small>
                                                                    </a>
                                                                    <br class="br-time-view">
                                                                    <small>{{count_format($tren_audio->play_number)}}</small>
                                                                    <small class="course-icon">•</small>
                                                                    <small>{{$tren_audio->created_at->diffForHumans()}}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    
    <div class="widgets-programs-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="app">
                        <hr class="mg-b-15">
                        <div class="panel-body">
                            <div class="m-t-s widget-cl-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <audio-list></audio-list>
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

@section('script')
    <script>
        $('#sidebar').attr('class', 'active');
        $('.logo-nav-bar img').attr('class', 'active');
    </script>
@endsection