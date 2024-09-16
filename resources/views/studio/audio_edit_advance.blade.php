@extends('layouts.studio.main')

@section('content')
    <div class="blog-details-area mg-t-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <div style="height: 160px;">
                                    <a href="{{route('web.listen', [$audio->slug ?? '0'])}}"><img src="{{get_audio_cover($audio->cover_source ? $audio: ($audio->parent? $audio->parent:$audio))}}" alt="{{@$audio->name}}"  ></a>
                                </div>
                                @if($audio->status=='draft')
                                <div class="upload-top">
                                    <upload :id={{ $audio->id }} placeholder-text="Click to upload Audio Cover" type-data="cover" model-data="audio" slug-url="{{$audio->cover_source ? route('upload.update', [$audio->cover_source->id ?? 'none']):route('upload.store')}}"></upload>
                                </div>
                                @endif
                                <p class="mg-t-10"><br><small>{{@$audio->name}}</small></p>
                                @include('layouts.studio.audio_menu')
                                
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        @include('layouts.audioslide')
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="blog-details blog-sig-details mg-t-30">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li><a href="{{route('studio.audio.show', [$audio->slug])}}"><small>Basic</small></a></li>
                                                            <li class="{{ (request()->segment(4) == 'advance') ? 'active' : '' }}"><a  href="{{route('studio.audio.edit', [$audio->slug, 'advance'])}}"><small> Advance</small></a></li>
                                                            @if($audio->contain==1)
                                                            <li class="{{ (request()->segment(4) == 'slide') ? 'active' : '' }}"><a  href="{{route('studio.audio.edit', [$audio->slug, 'slide'])}}"><small> Slide </small></a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        @include('layouts.studio.audio_action')         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="audio">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="pro-ad mg-t-15">
                                                        {!!Form::open()->put()->route('studio.audio.update', [$audio->id])->id('data')!!}
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                        
                                                                    <div class="form-group">
                                                                        <label for="">Comment</label>
                                                                    </div>
                                                                    <div class="well form-group">
                                                                        {!!Form::select('allow_comment', 'Allow Comment', ['1'=>'Allow all comments','2'=>'Review all comments','0'=>'Not allow'], $audio->allow_comment)!!}
                                                                        {!!Form::select('sort_comment', 'Sort by', ['0'=>'Populer','1'=>'Newest'], $audio->sort_comment)!!}
                                                                    </div>
                                                                    <hr>
                                                                    {!!Form::checkbox('allow_rating', ' Visitor can view audio ratings', 1, $audio->allow_rating==1?true:false)!!}
                                                                    {!!Form::checkbox('allow_notice', ' Notif to Subscriber',1, $audio->allow_notice==1?true:false)!!}
                                                                    {!!Form::checkbox('allow_age', 'Age restriction', 1, $audio->allow_age==1?true:false)!!}
                                                                    <!-- {!!Form::checkbox('contain', 'Contain Slide Presentation', 1, $audio->contain==1?true:false)!!} -->
                                                                    
                                                                </div>
                                                                <div id="app" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    {!!Form::select('language', 'Language', get_languages()->toArray(),$audio->language)!!}
                                                                    {!!Form::select('category_id', 'Category', get_categories()->toArray(), $audio->category_id)!!}
                                                                    {!!Form::select('channel', 'Channel', get_user_channels('pluck')->toArray(), $audio->channel_id)!!}
                                                                    <multi-select data-label="Hashtag" data-name="tags" data-placeholder="tag" :values='{{$audio->tags? json_encode($audio->tags):[]}}'></multi-select>
                                                                    <!-- <div class="form-group">
                                                                        <label>Licency and Right</label><br>
                                                                        <select class="form-control" name="" id="">
                                                                            <option value="">Sandard Licency</option>
                                                                            <option value="">Creative Commons - Attribution</option>
                                                                        </select>
                                                                    </div> -->


                                                                </div>
                                                            </div>
                                                        {!! Form::close() !!}
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
<link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
<link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<style>
    .upload-top{
        position: absolute;
        top: 0;
    }
    .upload-top .dropzone {
        background-color: #ddd0 !important;
    }
    .upload-top .dropzone:hover {
        background-color: #f6f6f6 !important;
    }
    .upload-top .dz-message{
        color: #fff0 !important;
    }
    .upload-top .dz-message:hover{
        color: #777 !important;
    }
</style>
@endsection

@section('script')
    <script>
        $('body').attr('class', 'mini-navbar');
        $('#sidebar').attr('class', 'active');
        $(".save").click( function() {
            $('form#data').submit();
        });
        $(window).load(function() {
            $('#loading').hide();
            $('.audio-slides').show();
        });
    </script>
    <!-- chosen JS
		============================================ -->
    <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS
		============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
@endsection