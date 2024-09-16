@extends('layouts.web.main')

@section('content')
    <div id="app">
        <div class="widgets-programs-area mg-t-30 hide">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="hpanel widget-int-shape responsive-mg-b-30">
                            <div class="panel-body">
                                <div class="stats-title pull-left">
                                    <h4>PILIHAN {{get_apps()->name}}</h4>
                                </div>
                                <div class="m-t-xl widget-cl-1">
                                    <div class="container-fluid">
                                        <div class="row">
                                            
                                            <list-channel channel-category="best" slug-url="{{route('web.subscribe.store', [':id'])}}"></list-channel>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widgets-programs-area mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="hpanel widget-int-shape responsive-mg-b-30">
                            <div class="panel-body">
                                <div class="stats-title pull-left">
                                    <h4>POPULER</h4>
                                </div>
                                <div class="m-t-xl widget-cl-1">
                                    <div class="container-fluid">
                                        <div class="row">

                                            <list-channel channel-category="populer" slug-url="{{route('web.subscribe.store', [':id'])}}"></list-channel>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="widgets-programs-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="hpanel widget-int-shape responsive-mg-b-30">
                            <div class="panel-body">
                                <div class="stats-title pull-left">
                                    <h4>CREATOR</h4>
                                </div>
                                <div class="m-t-xl widget-cl-1">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach(get_channel_creator() as $creator)
                                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 video-list-vertical">
                                                <div class="text-center">
                                                    <div class="user-title mg-b-5 text-center">
                                                        <a href="#"><img class="round-img wh-100" src="{{get_avatar($creator)}}" alt=""></a>
                                                    </div>
                                                    <h4><a href="#">{{$creator->name}}</a></h4>
                                                    <a href="#">{{$creator->channels->count()}} channel</a>
                                                    
                                                    <div class="courses-alaltic mg-t-10">
                                                        <a href="{{route('web.channel.user', [$creator->slug])}}" class="btn btn-sm btn-danger">LIHAT CHANNEL</a>
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
        </div> -->
    </div>
    <br><br>
@endsection