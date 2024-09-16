@extends('layouts.web.main')
@section('title', $channel->name.' - ')
@section('content')
    <div class="blog-details-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="app" class="blog-details-inner">
                        <div class="row white-box pd-t-0">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-0-0">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image cover-image image-channel-cover" style="background:url({{get_cover($channel)}})">
                                        <div class="blog-date cover-image image-channel-logo" style="background:url({!! get_logo(get_attachment_source($channel), 'url') !!});background-color: white;"></div>
                                    </div>
                                    <div class="blog-details blog-sig-details">
                                        <div class="details-blog-dt blog-sig-details-dt courses-info mobile-sm-d-n">
                                            <span>
                                                <a> <big>{{$channel->name}}</big></a><br>
                                                <small> {{$channel->subscriber->count()}} subscribers</small>
                                            </span>
                                            @if($own_this)
                                            <div class="mg-t-10 pull-right hidden-sm hidden-xs">
                                                <a href="{{route('studio.channel.edit', [$channel->slug])}}" class="btn btn-default">Edit</a>
                                                <a href="/studio" class="btn btn-default">{{get_apps()->name}} STUDIO</a>
                                            </div>
                                            @else
                                            <div class="mg-t-10 pull-right">
                                                <subscribe-action :login={{ @$user_activity ? 'true' : 'false' }} :post={{ $channel->id }} slug-url="{{route('web.subscribe.store', [$channel->slug])}}" :subscribe={{ @$subscribe==='false' ? 'false':'true' }} :alert={{ @$subscribe->alert_type==='1' ? 'true' : 'false' }}></subscribe-action>
                                            </div>
                                            @endif
                                        </div>
                                   </div>
                                </div>
                            </div>
                            {{-- subscribe_this($channel) --}}
                            @if($channel->visibility == 'public' || subscribe_this($channel)!='false')
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="{{ @$page == '' ? 'active':''}}"><a href="{{route('web.channel.show', ['channel'=> $channel->slug])}}">Home</a></li>
                                <li class="{{ @$page == 'audio' ? 'active':''}}"><a href="{{route('web.channel.page', ['channel'=> $channel->slug, 'page'=> 'audio'])}}"> List Audioslide</a></li>
                                <!-- <li class="{{ @$page == 'playlist' ? 'active':''}}"><a href="{{route('web.channel.page', ['channel'=> $channel->slug, 'page'=> 'playlist'])}}"> Playlist</a></li> -->
                                <!-- <li class="{{ @$page == 'comment' ? 'active':''}}"><a href="{{route('web.channel.page', ['channel'=> $channel->slug, 'page'=> 'comment'])}}"> Discussion</a></li> -->
                                <li class="{{ @$page == 'about' ? 'active':''}}"><a href="{{route('web.channel.page', ['channel'=> $channel->slug, 'page'=> 'about'])}}"> About Channel</a></li>
                            </ul>
                            @endif
                        </div>
                        @if($channel->visibility=='public' || subscribe_this($channel)!='false')
                            @if($channel->visibility=='public' || @subscribe_this($channel)->approved==1)
                                <div id="myTabContent" class="tab-content">
                                    <div>
                                        @if( @$page == '' )
                                        <div class="product-tab-list tab-pane fade active in" id="home">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="review-content-section">
                                                        <div class="chat-discussion" style="height: auto;">
                                                            <div class="col-lg-offset-1 col-lg-11 ">
                                                                <big class="bold">Upload</big> 
                                                                @if($channel->audios->count()>0)
                                                                <a href="{{route('web.listen', $channel->audios[0]->slug)}}?channel={{$channel->id}}" class="btn btn-sm"><i class="fa fa-play"></i> PUTAR SEMUA</a>
                                                                @endif
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <hr>
                                                            
                                                            <home-channel-audio></home-channel-audio>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif( $page == 'audio' )
                                        <div class="product-tab-list tab-pane fade active in" id="audio">
                                            <div class="row">
                                            
                                                <channel-audio></channel-audio>

                                            </div>
                                        </div>
                                        @elseif( $page == 'playlist' )

                                            <div class="product-tab-list tab-pane fade active in" id="channel">
                                                <div class="row">
                                                    @foreach($channel->playlists as $list)
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="courses-inner res-mg-b-30">
                                                            <a href="{{route('web.listen', [$list->slug])}}?playlist={{$list->id}}">
                                                                <div class="cover-image image-audio-cover" style="background: url({{$list->src_cover}})">
                                                                    <div class="image-audio-cover playlist-cover">
                                                                        <div class="playlist-thumbnail" >
                                                                            <center class="playlist">
                                                                                <i class="fa fa-list"></i>  
                                                                                <br><span>{{count($list->audios)}}</span>
                                                                            </center>   
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h5 class="title mg-t-10">{{$list->name}}</h5>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        @elseif( $page == 'comment' )
                                        <div class="product-tab-list tab-pane fade active in" id="disccusion">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="blog-details-inner white-box">
                                                        <div class="row">
                                                            <div class="coment-area">
                                                                <form id="comment" action="#" class="comment">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <textarea name="message" cols="30" rows="10" placeholder="Message"></textarea>
                                                                        </div>
                                                                        <div class="payment-adress comment-stn">
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Send</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="comment-head">
                                                                    <h3>Comments</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="user-comment">
                                                                    <img src="" alt="" />
                                                                    <div class="comment-details">
                                                                        <h4>Jonathan Doe 2015 15 July <span class="comment-replay">Replay</span></h4>
                                                                        <p>Shabby chic selfies pickled Tumblr letterpress iPhone. Wolf vegan retro selvage literally <span class="mobile-sm-d-n">Wes Anderson ethical four loko. Meggings blog chambray tofu pour-over. Pour-over Tumblr keffiyeh, cornhole whatever cardigan Tonx lomo.Shabby.</span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="user-comment admin-comment">
                                                                    <img src="" alt="" />
                                                                    <div class="comment-details">
                                                                        <h4>Jonathan Doe 2015 15 July <span class="comment-replay">Replay</span></h4>
                                                                        <p>Shabby chic selfies pickled Tumblr letterpress iPhone. Wolf vegan retro selvage literally <span class="mobile-sm-d-n">Wes Anderson ethical four loko. Meggings blog chambray tofu pour-over. Pour-over Tumblr keffiyeh, cornhole whatever cardigan
                                                                            Tonx lomo.Shabby.</span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="user-comment user-coment2">
                                                                    <img src="" alt="" />
                                                                    <div class="comment-details">
                                                                        <h4>Jonathan Doe 2015 15 July <span class="comment-replay">Replay</span></h4>
                                                                        <p>Shabby chic selfies pickled Tumblr letterpress iPhone. Wolf vegan retro selvage literally Wes Anderson <span class="mobile-sm-d-n">ethical four loko. Meggings blog chambray tofu pour-over. Pour-over Tumblr keffiyeh, cornhole whatever cardigan Tonx lomo.Shabby.</span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif( $page == 'about' )
                                        <div class="product-tab-list tab-pane fade active in" id="about">
                                            <div class="row">
                                                <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="review-content-section">
                                                        <div class="col-lg-8">
                                                            <div>
                                                                <big>Deskripsi</big>
                                                                <hr>
                                                                <p>{!!$channel->description!!}</p>
                                                            </div>
                                                            <hr>
                                                            <div class="hide">
                                                                <h4>Informasi</h4>
                                                                <p>Kontak : {{$channel->email}}</p>
                                                                <p>Lokasi : {{$channel->location}}</p>
                                                            </div>
                                                            <hr>
                                                            <div class="hide">
                                                                <h4>Media</h4>
                                                                {{$channel->media}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-offset-1 col-lg-3">
                                                            <h4>Stats</h4>
                                                            <div class="static-table-list">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Tanggal pembuatan<br> <b>{{$channel->created_at->format('d M Y')}}</b></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total audioslide diputar sebanyak<br> <b>{{$channel->play_number}}</b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <hr>
                                <div class="text-center">
                                    <p><strong>Pengajuan Berlangganan</strong></p>
                                    <p>Menunggu konfirmasi persetujuan pemilik channel.</p>
                                </div>
                            @endif
                        @else
                        <hr>
                        <div class="text-center">
                            <p><strong>Channel ini private</strong></p>
                            <p>Silahkan berlangganan untuk dapat melihat konten.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection