@extends('layouts.web.main')

@section('content')
    <div class="blog-details-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        <!-- <a href="#"><img src="{{url('img/pankord/channel-bg-crop.jpg')}}" alt="" style="width: 100%;height:20px;" /></a> -->
                                        <br>
                                        <div class="blog-date mg-t-15">
                                            <img style="border-radius: 50%;width:100%;height: 72px;" src="{{get_avatar($user)}}" alt="" />
                                        </div>
                                    </div>
                                    <div class="blog-details blog-sig-details">
                                        <div class="details-blog-dt blog-sig-details-dt courses-info mobile-sm-d-n">
                                            <span><a href="#"> <h3>{{$user->name}}</h3></a></span>
                                        </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <ul id="myTabedu1" class="tab-review-design">
                            <li class="active"><a href="#home"><small>List Channel</small></a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="home">
                                <div class="row">

                                    @if($user->channels->count()>0)
                                        @foreach($user->channels as $channel)
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                            <div class="courses-inner res-mg-b-30">
                                                <div class="courses-title">
                                                    <a href="{{route('web.channel.show', [$channel->slug])}}">
                                                        <img class="full-width" src="{{get_attachment_source($channel)->slug}}" alt="">
                                                        <div class="hidden-xs playlist-thumbnail">
                                                            <center class="playlist">
                                                                <i class="fa fa-list"></i>
                                                                <br><span>{{$channel->no_audio}}</span>
                                                            </center>
                                                        </div>
                                                    </a>
                                                </div>
                                                <p class="mg-t-10 bold"><a href="{{route('web.channel.show', [$channel->slug])}}">{{$channel->name}}</a></p>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                    <!-- <div class="pro-ad col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                        <a href="{{route('studio.channel.create')}}">
                                            <div class="courses-inner res-mg-b-30">
                                                <div class="dz-message needsclick download-custom box">
                                                    <h1><i class="fa fa-plus edudropnone" aria-hidden="true"></i></h1>
                                                    <h2 class="edudropnone">Buat channel baru.</h2>
                                                </div>
                                            </div>
                                        </a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection