@extends('layouts.studio.main')

@section('content')
    <div class="blog-details-area mg-t-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box">
                        <div id="app" class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <div style="height: 100px;">
                                    <a href="{{route('web.listen', [$audio->slug ?? '0'])}}"><img style="height: 100px;" src="{{get_audio_cover($audio->cover_source ? $audio: ($audio->parent? $audio->parent:$audio))}}" alt="{{@$audio->name}}"  ></a>
                                </div>
                                @if($audio->status=='draft' || $audio->status=='revision' || $audio->status=='revoke')
                                <div class="upload-top">
                                    <upload :id={{ $audio->id }} placeholder-text="Upload Audio Cover (900x383px)" type-data="cover" model-data="audio" slug-url="{{$audio->cover_source ? route('upload.update', [$audio->cover_source->id ?? 'none']):route('upload.store')}}"></upload>
                                </div>
                                @endif
                                <p class="mg-t-10"><br><small>{{@$audio->name}}</small></p>
                                <p class="mg-t-10">
                                    <big>{!!$audio->status_label!!} </big> 
                                    @if($audio->status=='revision')
                                        <div class="well">
                                            @foreach($audio->audit->notes as $key => $info)
                                            {{$key}} : {{$info}}<br>
                                            @endforeach
                                        </div>
                                    @endif
                                </p>
                                @include('layouts.studio.audio_menu')
                                
                            </div>
                            <div class="col-lg-offset-1 col-lg-9 col-md-10 col-sm-10 col-xs-10">
                                <div id="image_alert" style="display:none;" class="alert alert-warning">Cant use Cover Image with this resolution, please use standard resolution with width: 900px and height: 383px</div>
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
                                                            <li class="active"><a href="#home"><small>Basic</small></a></li>
                                                            <li><a href="{{route('studio.audio.edit', [$audio->slug, 'advance'])}}"><small> Advance</small></a></li>
                                                            @if($audio->contain==1)
                                                            <li><a href="{{route('studio.audio.edit', [$audio->slug, 'slide'])}}"><small> Slide </small></a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div id="save_btn" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        @include('layouts.studio.audio_action')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="myTabContent" class="tab-content custom-product-edit">
                                            <div class="product-tab-list tab-pane fade active in" id="home">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad mg-t-15">
                                                            <div class="row">
                                                                <div class="col-lg-{{$audio->edition || $audio->status=='draft'?'8':'12'}} col-md-8 col-sm-8 col-xs-8">
                                                                    {!!Form::open()->put()->route('studio.audio.update', [$audio->id])->id('data')!!}
                                                                    
                                                                        {!!Form::text('name', 'Nama', $audio->name)->autocomplete('off')!!}
                                                                        {!!Form::textarea('description', 'Description')->value($audio->description)->autocomplete('off')!!}
                                                                        {!!Form::select('visibility', 'Visibility', ['public' => 'Public', 'private'=>'Private'], $audio->visibility)!!}
                                                                        {!!Form::hidden('duration')->value($audio->duration)!!}

                                                                    {!! Form::close() !!}
                                                                    
                                                                </div>
                                                                @if($audio->parent || $audio->status=='draft')
                                                                <div class="col-lg-offset-1 col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="row mg-t-10">
                                                                        <div class="col-lg-12">
                                                                            <h5>REUPLOAD AUDIO</h5>
                                                                            <upload-audio :id={{ $audio->id }} source-upload="inhouse" type-model="audio_file" type-data="audio" slug-url="{{ $audio->source ? route('upload.update', [$audio->source]) : ( $audio->audio_source ? route('upload.update', [$audio->audio_source->id]):route('upload.store')) }}"></upload-audio>
                                                                        </div>
                                                                        <!-- <div class="clearfix"></div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <br>
                                                                            <h5>REUPLOAD COVER</h5>
                                                                            
                                                                        </div> -->
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-tab-list tab-pane fade" id="audio">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad">
                                                            <form action="#" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                            
                                                                        <div class="form-group">
                                                                            <label for="">Comment</label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            {!!Form::select('allow_comment', 'Allow Comment', ['1'=>'Izinkan semua komentar','2'=>'Tinjau semua komentar','0'=>'Tidak'], $audio->allow_comment)!!}
                                                                            {!!Form::select('sort_comment', 'Sort by', ['0'=>'Populer','1'=>'Newest'], $audio->sort_comment)!!}

                                                                        </div>
                                                                        <hr>
                                                                        {!!Form::checkbox('allow_rating', ' Visitor can view audio ratings', $audio->allow_rating)!!}
                                                                        {!!Form::checkbox('allow_notice', ' Notif to Subscriber', $audio->allow_notice)!!}
                                                                        {!!Form::checkbox('allow_age', 'Age restriction', $audio->allow_age)!!}
                                                                        {!!Form::select('channel', 'Channel', get_user_channels('pluck')->toArray(), $audio->channel_id)!!}
                                                                        <multi-select data-label="Hashtag" data-name="tags" data-placeholder="tag" :values='{{$audio->tags? json_encode($audio->tags):[]}}'></multi-select>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                        {!!Form::select('language', 'Bahasa', get_languages()->toArray(),$audio->language)!!}
                                                                        
                                                                        <!-- <div class="form-group">
                                                                            <label>Lisensi dan hak kepemilikan</label><br>
                                                                            <select class="form-control" name="" id="">
                                                                                <option value="">Lisensi Standar {{get_apps()->name}}</option>
                                                                                <option value="">Creative Commons - Attribution</option>
                                                                            </select>
                                                                        </div> -->

                                                                        <div class="form-group">
                                                                            <label for="">Category</label>
                                                                            <select class="chosen-select"><option label="Film &amp; Animation" value="string:1">Film &amp; Animation</option><option label="Autos &amp; Vehicles" value="string:2">Autos &amp; Vehicles</option><option label="Music" value="string:10">Music</option><option label="Pets &amp; Animals" value="string:15">Pets &amp; Animals</option><option label="Sports" value="string:17">Sports</option><option label="Travel &amp; Events" value="string:19">Travel &amp; Events</option><option label="Gaming" value="string:20">Gaming</option><option label="People &amp; Blogs" value="string:22" selected="selected">People &amp; Blogs</option><option label="Comedy" value="string:23">Comedy</option><option label="Entertainment" value="string:24">Entertainment</option><option label="News &amp; Politics" value="string:25">News &amp; Politics</option><option label="Howto &amp; Style" value="string:26">Howto &amp; Style</option><option label="Education" value="string:27">Education</option><option label="Science &amp; Technology" value="string:28">Science &amp; Technology</option><option label="Nonprofits &amp; Activism" value="string:29">Nonprofits &amp; Activism</option></select>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
<link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
<link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
<link rel="stylesheet" href="{{url('css/summernote/summernote.css')}}">
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
    #dropzone{
        min-height: 84px !important;
        padding: 0 !important;
        width: 200px;
    }
</style>
@endsection

@section('script')
    <!-- chosen JS
        ============================================ -->
    <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS
        ============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <!-- summernote JS
    ============================================ -->
    <script src="{{url('js/summernote/summernote.min.js')}}"></script>
    <script>
        @if(get_audio_cover($audio))
            const img = new Image();
            img.onload = function() {
                // alert(this.width + 'x' + this.height);
                if(this.width!=900 && this.height!=383){
                    $('#image_alert').show();
                    $('#save_btn').hide();
                }
            }
            img.src = '{{get_audio_cover($audio->cover_source ? $audio: ($audio->parent? $audio->parent:$audio))}}';
        @endif
        
        document.getElementById("audio").onloadedmetadata = function() {
            $('#inp-duration').val(document.getElementById("audio").duration);
        };
        $('body').attr('class', 'mini-navbar');
        $('#sidebar').attr('class', 'active');
        
        $(".save").click( function() {
            $('form#data').submit();
        });
        $('#inp-description').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            height: 200,
        });
        $(window).load(function() {
            $('#loading').hide();
            $('.audio-slides').show();
        });
    
        var $delete = $('#delete');
        var data_id = '{{$audio->id}}';
    </script>
@endsection