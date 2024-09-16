@extends('layouts.web.main')
@section('title', app('request')->input('cat')!=null?$cat->name.' - ':'Trending - ')

@section('content')
    @if( app('request')->input('cat') == null )
        <div class="widgets-programs-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel-body">
                            <div class="clearfix"></div>
                            <div class="widget-cl-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="container pull-left">
                                            <h4>Kategori</h4>
                                        </div>
                                        <hr>
                                        <div class="col-lg-offset-2 col-lg-8 mg-t-15">
                                            <div class="chat-message">
                                                <div class="row">
                                                    @foreach(get_active_categories() as $category)
                                                        
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                                            <a href="?cat={{$category->slug}}"> 
                                                                <div class="box">
                                                                    <div class="cover-image image-audio-cover" style="background-image: url({{get_attachment_source($category)['slug']}});">
                                                                        <!-- <img class="round-img" src="{{get_attachment_source($category)['slug']}}" /> -->
                                                                    </div>
                                                                    <br>
                                                                    <h5 class="message-author"> {{$category->name}}</h5>
                                                                    <p style="height: 40px;"><small class="hidden-sm hidden-xs mg-t-10">{{short_text($category->description, 380)}}</small></p>
                                                                </div>
                                                            </a>
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
            </div>
        </div>
    @else
        <div id="app" class="widgets-programs-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <hr>
                        <div class="review-content-section">
                            <div class="container pull-left">
                                <h4>{{$cat->name}}</h4>
                            </div>
                            <div class="clearfix"></div>
                            <div class="chat-discussion" style="height: auto">

                               <category-audios></category-audios>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if( app('request')->input('cat') == null )
    <!-- <div class="widgets-programs-area mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <hr>
                    <div class="container pull-left">
                        <h4>Hot</h4>
                    </div>
                    <div class="clearfix"></div>
                    <div class="review-content-section">
                        <div class="chat-discussion" style="height: auto">
                            @foreach(get_audio('month') as $audio)
                                <div class="chat-message">
                                    <a href="{{route('web.listen', [$audio->slug])}}"> 
                                        <div class="row">
                                            <div class="col-lg-offset-1 col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                                <div class="cover-image image-audio-cover" style="background-image: url({{get_audio_cover($audio)}});"><img src="{{get_audio_cover($audio)}}" /></div>
                                                <span class="badge badge-time">{{format_time($audio->duration)}}</span>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                <h4 class="message-author f-w-400"> {{$audio->name}} </h4>
                                                <small class="trend-desc"> 
                                                    <a href="{{route('web.channel.show', [$audio->channel?$audio->channel->slug:0])}}" title="{{$audio->channel?$audio->channel->name:''}}">
                                                        <b>{{$audio->channel?$audio->channel->name:''}}</b>
                                                    </a>
                                                    | {{count_format($audio->play_number)}} - {{$audio->created_at->diffForHumans()}} 
                                                </small>
                                                <small class="content trend-desc mg-t-10">{{short_text($audio->description, 350)}}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    @endif
<br><br><br>
@endsection

@section('script')
<script>
    $('.category-list').owlCarousel({
        items: 8,
        loop:false,
        dots: false,
        pagination:false,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,8],
        itemsDesktopSmall : [980,6],
        itemsTablet: [768,6],
        itemsMobile : [479,4],
    })
</script>

@endsection