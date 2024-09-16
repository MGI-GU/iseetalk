@extends('layouts.web.main')

@section('title', $audio->name.' - ')

@section('seo')
<meta name="description" content="Lihat {{$audio->name}} di iSeeTalk. {{@$audio->channel->name}} · 1 Audioslide." />
<meta property="google" content="notranslate" />

<meta property="og:title" content="{{$audio->name}}" />
<meta property="og:description" content="{{get_apps()->name}} · {{get_apps()->slogan}} · {{@$audio->channel->name}} · 1 Audioslide." />
<meta property="og:url" content="{{url()->full()}}" />
<meta property="og:image" content="{{get_audio_cover($audio)}}" />
<meta property="og:type" content="music.album" />
<meta property="og:site_name" content="{{get_apps()->name}} - {{get_apps()->slogan}}" />

<meta property="music:musician" content="{{route('web.channel.show', $audio->channel?$audio->channel->slug:0)}}" />
<meta property="music:release_date" content="{{$audio->created_at}}" />
<meta property="music:song" content="{{url()->full()}}" />
<meta property="music:song:disc" content="1" />
<meta property="music:song:track" content="1" />

<meta property="twitter:site" content="@iSeeTalk" />
<meta property="twitter:title" content="{{$audio->name}}" />
<meta property="twitter:description" content="{{get_apps()->name}} · {{get_apps()->slogan}} · {{@$audio->channel->name}} · 1 Audioslide." />
<meta property="twitter:image" content="{{get_audio_cover($audio)}}" />
<meta property="twitter:card" content="audio" />
<meta property="twitter:audio:partner" content="{{get_apps()->name}} - {{get_apps()->slogan}}" />
<meta property="twitter:audio:artist_name" content="{{@$audio->channel->name}}" />
<meta property="twitter:player"
    content="{{url()->full()}}?utm_campaign=twitter-player&amp;utm_source=open&amp;utm_medium=twitter" />
<meta property="twitter:player:width" content="504" />
<meta property="twitter:player:height" content="584" />

<link rel="canonical" href="{{url()->full()}}" />
<script type="application/ld+json"></script>
@endsection

@section('content')
<div class="container-fluid">
    <div id="app" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="single-pro-review-area mt-t-30 mg-b-15">
                <div class="container-fluid">
                    <div id="audioslide" class="row">
                        <div id="teater_view" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                        <div id="normal_view" class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
                            <div id="slide_area" class="audio-slide-detail">
                                <div id="audio-slideshow" class="audio-slideshow" data-audio="{{get_audio_source($audio)}}" data-audio-duration="{{$audio->duration}}">  
                                    @if($audio->contain==1 || $audio->contain=='approve-slide')
                                        <div id="loading">
                                            <div data-v-46b21138="" class="infinite-loading-container"><div data-v-46b21138="" class="infinite-status-prompt" style="color: rgb(102, 102, 102); font-size: 14px; padding: 10px 0px;"><i data-v-46b20d22="" data-v-46b21138="" class="loading-default"></i></div> <div data-v-46b21138="" class="infinite-status-prompt" style="display: none;"><div data-v-46b21138="">-</div></div> <div data-v-46b21138="" class="infinite-status-prompt" style="display: none;"><div data-v-46b21138=""></div></div> <div data-v-46b21138="" class="infinite-status-prompt" style="color: rgb(102, 102, 102); font-size: 14px; padding: 10px 0px; display: none;"></div></div>
                                            <img src="{{get_audio_cover($audio)}}" alt="{{$audio->name}}">
                                        </div>
                                        <div class="row mg-0">
                                            <div class="col-lg-offset-0 col-lg-12 pd-0">
                                                <div class="audio-slides" style="display: none;">
                                                    @foreach( get_attachment_source($audio, 'slide') as $key => $image)
                                                        @for($i=$image->time_show;$i<=$image->time_end;$i++)
                                                            @if($i==0)
                                                            <img src="{{ get_image_slide($image) }}" alt="1" data-thumbnail="{{ get_image_slide($image) }}" data-slide-time="1">
                                                            @else
                                                            <img src="{{ get_image_slide($image) }}" alt="{{$i}}" data-thumbnail="{{ get_image_slide($image) }}" data-slide-time="{{$i}}">
                                                            @endif
                                                        @endfor
                                                            <!-- <img src="{{ get_image_slide($image) }}" alt="{{$key}}" data-thumbnail="{{ get_image_slide($image) }}" data-slide-time="{{$key}}"> -->
                                                    @endforeach
                                                </div> 
                                            </div>
                                        </div>
                                    @endif
                                    <div class="audio-control-interface control-bg">
                                        <div>
                                            <div class="col-lg-offset-0 col-lg-12 pd-0">
                                                <div class="timeline">
                                                    <div class="timeline-controls"></div>
                                                    <div class="seekbar">
                                                        <div class="playhead"></div>
                                                    </div>
                                                </div>
                                                <div class="jplayer"></div>
                                            </div>
                                            <div class="col-lg-offset-0 col-lg-3 col-sm-3 col-xs-2">
                                                <div class="row">
                                                    <div class="col-lg-3 col-sm-3 col-xs-3">
                                                        <a href="javascript:;" class="btn audio-play" tabindex="1"><i class="fa fa-play"></i></a>
                                                        <a href="javascript:;" class="btn audio-pause" tabindex="1"><i class="fa fa-pause"></i></a>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-2 col-xs-2 hidden-xs">
                                                        <a href="javascript:;" class="btn jp-mute" tabindex="1" title="mute"><i class="fa fa-volume-off"></i></a>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6 hidden-xs">
                                                        <div class="jp-volume-slider" style="margin-top:14px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-sm-9 col-xs-10">
                                                <div class="time-container btn">
                                                    <span class="play-time"></span> / <span class="total-time"></span>
                                                </div>
                                                <div title="Fullscreen Mode" id="fullscreen" class="btn" style="float:right;" onclick="fullScreen()">
                                                    <a href="#" class="full-screen"><i class="fa fa-television"></i></a>
                                                </div>
                                                <div title="Teater Mode" id="teater_btn" class="btn hidden-xs" style="float:right;">
                                                    <a href="#" class="teater"><i class="fa fa-square-o"></i></a>
                                                </div>
                                                <div title="Normal Mode" id="normal_btn" class="btn" style="float:right;display:none;">
                                                    <a href="#" class="teater"><i class="fa fa-square"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="image-crop audio-description">
                                <div class="title-logo">
                                    <!--<div class="col-lg-1 hidden-md hidden-sm hidden-xs">
                                         <img src="{{get_audio_cover($audio)}}" alt="" class="mg-0-10 border">
                                     </div> --> 
                                    <div class="col-lg-12 mg-0" style="margin-top: 0;">
                                        <span>
                                            <div class="tag-area mg-t-10">
                                                @foreach($audio->tags as $tag)
                                                    @if(@$tag->name)
                                                    <a class="btn-link" href="{{url('hashtag', @$tag->name)}}"><small style="font-size: small;">#{{@$tag->name}}</small></a>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <big class="mg-t-5">{{$audio->name}}</big>
                                        </span>
                                        <div class="courses-alaltic">
                                            @if(audio_setting_rate($audio)!=='False')
                                                <small>{{count_format($audio->play_number)}}</small>
                                                <small class="course-icon">-</small>
                                            @endif
                                            <small>{{$audio->date_label}}</small>
                                        </div>
                                    </div>
                                </div>
                                <audio-action :stat={{$audio->allow_rating}} :like={{$audio->like_number}} :share={{$audio->share_number}} :post={{ $audio->id }} :downloaded={{ get_attachment_source($audio)->type_data=='pdf' ? 'true' : 'false' }} :favorited={{ @$user_activity->liked ? 'true' : 'false' }} :saved={{ @$user_activity->listen_later ? 'true' : 'false' }}></audio-action>
                                <div class="clearfix"></div>
                                <hr class="nomargin" style="margin-top: 0;">
                                <div>
                                    <div class="col-lg-12 col-md-10 col-sm-10 col-xs-12 mg-t-15">
                                        <div>
                                            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-11">
                                                <a href="{{route('web.channel.show', $audio->channel?$audio->channel->slug:0)}}" style="display: inline-block;">
                                                    <img class="message-avatar round-img" style="width: 36px;height: 36px;margin-right: 10px;float:left;" src="{{get_attachment_source($audio->channel)->slug}}" alt="{{$audio->channel->name}}">
                                                    <p class="message-author bold" style="margin: 0px;height: 42px;vertical-align: middle;display: table-cell;">
                                                        {{$audio->channel?$audio->channel->name:''}} 
                                                    </p>
                                                </a>                                            
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-1">
                                                <subscribe-action :login={{ @$user_activity ? 'true' : 'false' }} :post={{ $audio->id }} slug-url="{{route('web.subscribe.store', [$audio->channel?$audio->channel->slug:0])}}" :subscribe={{ $subscribe ? 'true' : 'false' }} :alert={{ @$subscribe->alert_type ? 'true' : 'false' }}></subscribe-action>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="message-content description">
                                            <div class="description well">
                                                {!!$audio->description!!}
                                                <a id="shower" class="show-more" href="#">LIHAT SEMUA</a>
                                                <a id="hider" class="show-more" href="#">LIHAT SEDIKIT</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        @if($audio->allow_comment==1 || $audio->allow_comment==2)
                                            <div class="blog-details-inner white-box">
                                                <div>
                                                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                                        <img src="{{get_avatar(auth()->getUser())}}" alt="" />
                                                    </div>
                                                    <div class="col-lg-11 col-md-11 col-sm-10 col-xs-10">
                                                        <div class="coment-area">
                                                            {!!Form::open()->post()->route('web.audio.comment.post', [$audio->slug])->id('data')!!}
                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <textarea name="comment" style="height:40px;" placeholder="Tulis komentar"></textarea>
                                                                    </div>
                                                                    <div class="payment-adress comment-stn pull-right">
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Comment</button>
                                                                    </div>
                                                                </div>
                                                            {!! Form::close() !!}
                                                            <br>
                                                            @if($audio->allow_comment==2 && auth()->user())
                                                                @if(check_pending_comment(auth()->user(), $audio)>0)
                                                                    <div class="alert alert-warning">{{check_pending_comment(auth()->user(), $audio)}} of your comment is waiting for approval by the owner</div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="comment-head">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <center class="mg-t-15"><i class="fa fa-comment"></i> {{$audio->show_comments->count()}} Komentar</center>
                                            <br>
                                            <comments slug-url=""></comments>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-4 col-sm-12 col-xs-12 mg-t-15">
                            <div class="hpanel">
                                <div>
                                    @if(app('request')->input('playlist') || app('request')->input('channel') || $audio->channel)
                                        <div style="background: #ddd;">
                                            <div style="border: solid 1px #797979;">
                                                <div class="white-box">
                                                    <div class="checkbox-title-pro">
                                                        <span class="pull-right" style="margin-right: 60px;"><i title="Auto play" class="fa fa-1x fa-play-circle-o" data-toggle="tooltip"></i></span>
                                                        <div class="ts-custom-check">
                                                            <div class="onoffswitch">
                                                                <input type="checkbox" checked name="auto_play" class="onoffswitch-checkbox" id="auto">
                                                                <label class="onoffswitch-label" for="auto" title="Auto play">
                                                                    <span class="onoffswitch-inner"></span>
                                                                    <span class="onoffswitch-switch"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{route('web.channel.show', $audio->channel?$audio->channel->slug:0)}}" style="display: inline-block;">
                                                        <strong>{{@$playlist->name ?? @$channel->name}}</strong>
                                                    </a>
                                                    <br>
                                                    @if($channel!==null)
                                                    <small>1 / {{ $channel->active_audios->count() }}</small>
                                                    @else
                                                    <small>1 / {{-- $count($playlist->audios) --}}</small>
                                                    @endif
                                                    <a class="btn btn-inverse pull-right" type="button" data-toggle="collapse" data-target="#collapsePlaylist" aria-expanded="false" aria-controls="collapseExample">
                                                        <i class="fa fa-2x fa-angle-down"></i>
                                                    </a>
                                                </div>
                                                <div class="collapse in" id="collapsePlaylist" style="overflow:overlay;">
                                                    <div>
                                                        @if($playlist!==null)
                                                            @foreach($playlist->audios as $i => $play)
                                                                <a id="{{$play->slug == $audio->slug ? 'next-list':''}}" href="{{route('web.listen', [$play->slug])}}?playlist={{$playlist->id}}" >
                                                                    <div class="col-lg-12 pd-5-0 list {{$play->slug == $audio->slug ? 'active':''}}" style="height: 100px;">
                                                                        <div class="col-lg-5 col-md-3 col-sm-4 col-xs-5" style="margin-left: 15px;margin-top:4px;">
                                                                            <div class="cover-image image-audio-cover" style="background-image: url({{get_audio_cover($play)}});">
                                                                                <small style="margin: -16px;">
                                                                                    @if($play->slug == $audio->slug)
                                                                                    <i class="fa fa-play"></i>
                                                                                    @else
                                                                                    {{$i+1}}
                                                                                    @endif
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mg-0-0">
                                                                            <b class="list-title">{{$play->name}}</b>
                                                                            <p><small>{{format_time($play->duration)}}</small></p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                        @else
                                                            @foreach($audio->channel->active_audios as $i => $play)
                                                                <a id="{{$play->slug == $audio->slug ? 'next-list':''}}" href="{{route('web.listen', [$play->slug])}}?channel={{$audio->channel->id}}">
                                                                    <div class="col-lg-12 pd-5-0 list {{$play->slug == $audio->slug ? 'active':''}}" style="height: 100px;">
                                                                        <div class="col-lg-5 col-md-3 col-sm-4 col-xs-5" style="margin-left: 15px;margin-top:4px;">
                                                                            <div class="cover-image image-audio-cover" style="background-image: url({{get_audio_cover($play)}});">
                                                                                <small style="margin: -16px;">
                                                                                    @if($play->slug == $audio->slug)
                                                                                    <i class="fa fa-play"></i>
                                                                                    @else
                                                                                    {{$i+1}}
                                                                                    @endif
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mg-0-0">
                                                                            <b class="list-title">{{$play->name}}</b>
                                                                            <p><small>{{format_time($play->duration)}}</small></p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    @else
                                        <div class="solo">
                                            <div class="stats-title pull-left">
                                                <span>Berikutnya</span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    @endif

                                    <audios></audios>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="add" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div >
                <div class="modal-close-area modal-close-df">
                    <a class="close" style="background: black;" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="mg-10">
                
                <div class="blog-details blog-sig-details">
                    <ul id="myTabedu1" class="tab-review-design" style="border-bottom:solid 1px #ddd;">
                        <li class="active"><a href="#home"><small>BAGIKAN</small></a></li>
                        <!-- <li><a href="#audio"><small> EMBED</small></a></li> -->
                        <!-- <li><a href="#email"><small> KIRIM</small></a></li> -->
                    </ul>
                </div>
                <div id="myTabContent" class="tab-content custom-product-edit">
                    <div class="product-tab-list tab-pane fade active in" id="home">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pro-ad">
                                    <div class="">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <img src="{{get_audio_cover($audio)}}" alt=""  >
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                            
                                            <h5 class="mg-t-10"><a href="#">{{$audio->name}}</a></h5>
                                            <div class="courses-alaltic">
                                            <a href="#"><small class="course-icon">{{$audio->channel?$audio->channel->name:''}} <i class="fa fa-check-circle"></i></small></a>
                                            </div>
                                            <div class="courses-alaltic">
                                                <small>{{count_format($audio->play_number)}}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-30">
                                            <div class="input-group custom-go-button">
                                                <input type="text" class="form-control copy_url" value="{{ url()->full() }}" readonly>
                                                <span class="input-group-btn"><button type="button" class="btn btn-default salin-input">Salin</button></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-30">
                                            <!-- <label for="">Share</label> -->
                                            <div class="clearfix"></div>
                                            <a class="btn btn-lg btn-primary" target="_blank" href="{{route('web.share', [$audio->slug])}}?url={{url()->full()}}&media=facebook"><i class="fa fa-facebook edu-facebook" aria-hidden="true"></i> Facebook</a>
                                            <a class="btn btn-lg btn-default" target="_blank" href="{{route('web.share', [$audio->slug])}}?url={{url()->full()}}&media=email&link=mailto:?subject=I wanted you to see this site&amp;body=Check out this site {{url()->full()}}." data-href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site {{url()->full()}}." title="Share by Email"><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</a>
                                            <!-- <div id="fb-root"></div> -->
                                            
                                            <!-- Your share button code -->
                                            <!-- <div class="fb-share-button" style="width:100px" data-height="25" data-width="90" data-href="{{ url()->full() }}" data-layout="button" data-size="large"><a target="_blank" href="{{route('web.share', [$audio->slug])}}?url=https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div> -->
                                            <!-- <a class="btn btn-default"><i class="fa fa-google"></i> </a>
                                            <a class="btn btn-default"><i class="fa fa-facebook"></i> </a> -->
                                            <br><br>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="product-tab-list tab-pane fade" id="audio">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pro-ad">
                                    <form action="#" class="dropzone dropzone-custom needsclick add-professors" id="embed">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
                                                <label for="">Embed Code</label>
                                                <input style="width:100%;" onClick="this.setSelectionRange(0, this.value.length)" readonly="readonly" type="text" value='<iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" src="https://pankord.com/player/?url=https%3A//api.pankord.com/tracks/718330027&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>'>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="product-tab-list tab-pane fade" id="email">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pro-ad">
                                    <form action="#" class="dropzone dropzone-custom needsclick add-professors" id="comment">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                                
                                                <div class="form-group">
                                                    <label for="">Comment</label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Ke</label>
                                                    <input class="form-control" type="text" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tulis pesan</label>
                                                    <textarea class="form-control" name="" id="" cols="30" rows="10">{{url('share/audio')}}</textarea>
                                                </div>
                                                <div class="form-group pull-right">
                                                    <input class="btn btn-default" type="button" value="KIRIM">
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </form>
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
<link rel="stylesheet" href="{{ url('css/modals.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<style>
    .fb-share-button > span{
        height: 25px !important;
    }
    .fb-share-button > span > iframe{
        width: 90px !important;
        height: 30px !important;
    }

    #audioslide:fullscreen { 
        justify-content: center; 
        align-items: center; 
        background: #fff; 
        overflow: scroll !important;    
    }
    #audioslide:-moz-full-screen figure, #audioslide:-ms-full-screen figure, #audioslide:-webkit-fullscreen figure, #audioslide:fullscreen figure { 
        width: 100%;
        margin: 0 auto;
        background: #fff; 
    }
    #audioslide:fullscreen .audio-slideshow .audio-slides img{
        max-height: 100% !important;
        width:100%;
    }
    :-webkit-full-screen { 
        width: 100%; height: 100%; 
    }
    *:-moz-full-screen { 
        background: #fff; 
    }
    *:-webkit-full-screen { 
        background: #fff; 
    }
    #teater_view {
        margin: 0px;
        padding: 0px;
    }
    #teater_view .audio-slideshow .audio-slides img{
        max-height: 500px !important;
    }
    
    #teater_view .mg-0{
        margin: 0px;
        padding: 0px;
    }

    #audioslide:fullscreen .title-logo{ 
        height:90px;
    }
</style>
@endsection

@section('script')
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v8.0&appId=755151215320436&autoLogAppEvents=1" nonce="byEgAaYn"></script>
<script src="{{ url('js/pdf/jquery.media.js') }}"></script>
<script>
    $(window).load(function() {
        $('#loading').hide();
        $('.audio-slides').show();
    });
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
    $('.logo-nav-bar img').attr('class', 'active');

    paragraphCount = $(".description > p").size();

    $("#hider").hide();
    $("#shower").hide();

    if (paragraphCount > 2) {
        $("#shower").show();
    }
        
    $( "#hider" ).click(function() {
        $(".description p").not(":first").hide();
        $("#hider").hide();
        $("#shower").show();
    });
        
    $( "#shower" ).click(function() {
        $(".description p").show();
        $("#shower").hide();
        $("#hider").show();
    });

    $(".description p").not(":first").hide();

    $('ul.pagination').hide();

    function cancelFullScreen() {
        $("#slide_area").prependTo($("#normal_view"));
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        } else if (document.msCancelFullScreen) {
            document.msCancelFullScreen();
        }
        $("#teater_btn").show();

        link = document.getElementById("fullscreen");
        link.removeAttribute("onclick");
        link.setAttribute("onclick", "fullScreen()");
    }

    function fullScreen() {
        var element = document.getElementById("audioslide");
        $("#slide_area").prependTo($("#teater_view"));
        if (element.requestFullScreen) {
            element.requestFullScreen();
        } else if (element.webkitRequestFullScreen) {
            element.webkitRequestFullScreen();
        } else if (element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        }
        $("#teater_btn").hide();
        $("#normal_btn").hide();

        link = document.getElementById("fullscreen");
        link.removeAttribute("onclick");
        link.setAttribute("onclick", "cancelFullScreen()");
    }

    $("#teater_btn").click(function() {
        $("#slide_area").prependTo($("#teater_view"));
        $(this).hide();
        $("#normal_btn").show();
    });

    $("#normal_btn").click(function() {
        $("#slide_area").prependTo($("#normal_view"));
        $(this).hide();
        $("#teater_btn").show();
    });
    
    $(".copy_url").click( function() {
        var copyText = $(this);
        copyText.select();
        copyText[0].setSelectionRange(0, 99999);
        document.execCommand("copy");
        $(this).attr('data-original-title', "Copied").tooltip('show');
    });
    $(".salin-input").click( function() {
        var copyText = $(".copy_url");
        copyText.select();
        copyText[0].setSelectionRange(0, 99999);
        document.execCommand("copy");
        $(this).attr('data-original-title', "Copied").tooltip('show');
    });
</script>
@endsection