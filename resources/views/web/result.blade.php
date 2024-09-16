@extends('layouts.web.main')
@section('title', $id.' - ')
@section('content')
    <div id="app" class="widgets-programs-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-content-section">
                        <div class="chat-discussion" style="height: auto">
                            @if($channel)
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-5">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-5 col-xs-5">
                                            <div class="profile-hdtc text-center">
                                                <a href="{{route('web.channel.show', [$channel->slug])}}"> 
                                                    <img class="message-avatar round-img list-channel-img" width="100" src="{{$channel->src_cover}}" alt="item.name">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6 col-sm-7 col-xs-7">
                                            <a href="{{route('web.channel.show', [$channel->slug])}}">
                                                <big class="message-author mg-t-15"> {{$channel->name}} <i class="fa fa-check-circle"></i></big>
                                                <span class="message-content"> {{$channel->no_subscriber}} subscribers - {{$channel->no_audio}} audio </span>
                                                <small class="message-content hidden-xs">{{$channel->description}}</small>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-8 col-xs-12 hidden-xs">
                                            @if(auth()->user() && is_my_subscribe($channel))
                                                <a href="{{route('web.channel.show', [$channel->slug])}}" class="btn btn-success">BERLANGANAN</a>
                                                @if(is_my_subscribe($channel)->alert_type==0)
                                                <a href="{{route('web.channel.show', [$channel->slug])}}" class="btn btn-default"><i class="fa fa-bell-o"></i></a>
                                                @else
                                                <a href="{{route('web.channel.show', [$channel->slug])}}" class="btn btn-default"><i class="fa fa-bell-slash-o"></i></a>
                                                @endif
                                            @else
                                                <a href="{{route('web.channel.show', [$channel->slug])}}" class="btn btn-danger">LANGANAN</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <search-audio></search-audio>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection