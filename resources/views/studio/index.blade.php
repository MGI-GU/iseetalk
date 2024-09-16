@extends('layouts.studio.main')

@section('content')
    <div class="widgets-programs-area mg-t-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hpanel widget-int-shape responsive-mg-b-30">
                        <div class="panel-body">
                            <div class="stats-title pull-left">
                                <h2>Dashboard</h2>
                            </div>
                            <div class="clearfix"></div>
                            <div class="m-t-s widget-cl-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 video-list-vertical">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 video-list-vertical">
                                                    <div class="box white-box">
                                                        <h4 class="text-left">Konten Terbaru</h4>
                                                        <hr>
                                                        @if(get_user()->firstAudio)
                                                        <div class="courses-title">
                                                            <a href="{{route('web.listen', [get_user()->firstAudio->slug])}}"><img src="{{get_audio_cover(get_user()->firstAudio)}}" alt=""></a>
                                                        </div>
                                                        <div class="mg-t-15 text-left">
                                                            <p>{{get_user()->firstAudio->name}}</p>
                                                            <br>
                                                            <p>Didengar <span class="pull-right">{{get_user()->firstAudio->play_number}}</span></p>
                                                            <p>Durasi <span class="pull-right">{{get_user()->firstAudio->duration}} detik</span></p>
                                                            <!-- <p>Waktu play (hours) <span class="pull-right">1.7</span></p> -->
                                                        </div>
                                                        <div class="mg-t-15 text-left hide">
                                                            <h2><a class="btn btn-primary" href="#">LIHAT AUDIO ANALISA</a></h2>
                                                            <h2><a class="btn btn-primary" href="#">LIHAT KOMENTAR ({{get_user()->firstAudio->comments->count()}})</a></h2>
                                                        </div>
                                                        @else
                                                        <center>Belum ada konten yang di upload</center>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 video-list-vertical">
                                                    <div class="box white-box">
                                                        <h4 class="text-left">Performance</h4>
                                                        <hr>
                                                        @if(get_count_my_total_views()>0)
                                                        <div class="mg-t-15 text-left">
                                                            <p>Current subscribers</p>
                                                            <h1>{{get_my_subscriber()->count()}}</h1>
                                                        </div>
                                                        <br>
                                                        <div class="mg-t-15 text-left">
                                                            <h5>Summary</h5>
                                                            <!-- <small>28 hari terakhir</small> -->
                                                            <br>
                                                            <p>Total view <span class="pull-right">{{get_count_my_total_views()}}x</span></p>
                                                            <!-- <p>Play time (jam) <span class="pull-right">0.0	0%</span></p> -->
                                                        </div>
                                                        <!-- <div class="mg-t-15 text-left hide">
                                                            <h2><a class="btn btn-primary" href="#">LIHAT CHANNEL ANALISA</a></h2>
                                                        </div> -->
                                                        @else
                                                        <center>Belum ada konten yang di upload</center>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 video-list-vertical">
                                                    
                                                            <div class="box white-box">
                                                                <div class="text-left">
                                                                    <h4 class="text-left">Top Audioslide</h4>
                                                                    <!-- <p>48 jam terakhir · Viewed</p> -->
                                                                    <div class="static-table-list">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                @if(get_my_top_upload_audio()->count()>0)
                                                                                    @foreach(get_my_top_upload_audio() as $audio)
                                                                                    <tr>
                                                                                        <td><a href="{{route('studio.audio.show', [@$audio->slug])}}">{{@$audio->name}}</a></td>
                                                                                        <td>{{$audio->play}}</td>
                                                                                    </tr>
                                                                                    @endforeach
                                                                                @else
                                                                                    <center>Konten belum tersedia</center>
                                                                                @endif
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 video-list-vertical">

                                                            <div class="box white-box">
                                                                <div class="text-left">
                                                                    <h4 class="text-left">Top Channel</h4>
                                                                    <!-- <p>48 jam terakhir · Viewed</p> -->
                                                                    <div class="static-table-list">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                @if(get_my_top_upload_channel()->count()>0)
                                                                                    @foreach(get_my_top_upload_channel() as $channel)
                                                                                    <tr>
                                                                                        <td><a href="{{route('studio.channel.index')}}">{{@$channel->name}}</a></td>
                                                                                        <td align="right">{{$channel->play}}</td>
                                                                                    </tr>
                                                                                    @endforeach
                                                                                @else
                                                                                    <center>Konten belum tersedia</center>
                                                                                @endif
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
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                                    <div class="box white-box">
                                                        <h4 class="text-left">News</h4>
                                                        <hr>
                                                        @foreach(get_news_feed() as $notice)
                                                            <a target="_blank" href="{{route('web.page', [$notice->slug])}}">
                                                                <div class="mg-t-15 text-left">
                                                                    <span class="notification-date">{{$notice->updated_at->format('d M Y')}}</span>
                                                                    <h5>{{$notice->title}}</h2>
                                                                    <p>{{$notice->sub_content}}</p>
                                                                </div>
                                                            </a>
                                                            <hr>
                                                        @endforeach
                                                        @if(get_new_anouncement())
                                                            <!-- <div class="courses-title">
                                                                <img src="img/courses/2.jpg" alt=""></a>
                                                            </div> -->
                                                            <!-- <div class="mg-t-15 text-left">
                                                                <a href="{{route('web.page', [get_new_anouncement()->slug])}}">
                                                                    <h5>{{get_new_anouncement()->title}}</h5>
                                                                    <p>{{get_new_anouncement()->sub_content}}</p>
                                                                </a>
                                                            </div> -->
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