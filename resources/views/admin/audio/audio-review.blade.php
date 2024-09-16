@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div id="app" class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st1 mg-t-30">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#4">Audioslide Review</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                            @if(is_leader(auth()->user())!='false')
                                <!-- {!!Form::open()->put()->route('admin.audio.update', [$audio->id])!!} -->
                                <!-- {!!Form::select('progress_status', '', ['review'=>'Approve', 'step1'=>'Back to Step Copy Writer','step2'=>'Back to Step Audio Engineer','step3'=>'Back to Step Slide Manager', 'step4'=>'Back to Step Graphic Designer'], $audio->project->status)!!} -->
                                <!-- <button type="submit" href="#" class="btn btn-success save">SAVE</button> -->
                                <!-- {!! Form::close() !!} -->
                                <a href="{{route('admin.audio.update.status', [$audio->id, 'approve'])}}" class="btn btn-success">APPROVE</a>
                                <a href="{{route('admin.audio.update.status', [$audio->id, 'reject'])}}" class="btn btn-danger">REJECT</a>
                                <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{route('admin.audio.edit', [$audio->id])}}"><i class="fa fa-edit"></i> EDIT</a></li>
                                    <li><a href="#"><i class="fa fa-arrow-circle-down"></i> DOWNLOAD</a></li>
                                    <li><a href="#" id="delete"><i class="fa fa-trash"></i> DELETE</a></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="5">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="pro-ad">
                                            <div class="">
                                                
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                    <div class="row">
                                                        <div class="{{$audio->contain==1?'col-lg-1':'col-lg-2'}} hidden-sm hidden-xs">
                                                            <img src="{{get_audio_cover($audio->cover_source ? $audio: ($audio->parent? $audio->parent:$audio))}}" alt="" class="mg-0-10 border pd-10">
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <span>
                                                                {{@$audio->name}} <br>
                                                                @if(@$audio->tags)
                                                                    @foreach(@$audio->tags as $tag)
                                                                    <a href="{{url('result', @$tag->name)}}"><small style="font-size: small;">#{{@$tag->name}}</small></a>
                                                                    @endforeach
                                                                @endif
                                                                 <a href="{{url('trending')}}?cat={{@$audio->category->slug}}"><small style="font-size: small;">{{get_category($audio)}}</small></a> 
                                                            </span>
                                                            <div class="courses-alaltic">
                                                                @if(audio_setting_rate($audio)!=='False')
                                                                    <small>{{$audio->play_number}}</small>
                                                                    <small class="course-icon">-</small>
                                                                @endif
                                                                <small>{{@$audio->date_label}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div id="audio-slideshow" class="audio-slideshow pd-10" data-audio="{{get_audio_source($audio)}}" data-audio-duration="{{$audio->duration}}">
                                                                <div id="loading">
                                                                    <div data-v-46b21138="" class="infinite-loading-container"><div data-v-46b21138="" class="infinite-status-prompt" style="color: rgb(102, 102, 102); font-size: 14px; padding: 10px 0px;"><i data-v-46b20d22="" data-v-46b21138="" class="loading-default"></i></div> <div data-v-46b21138="" class="infinite-status-prompt" style="display: none;"><div data-v-46b21138="">-</div></div> <div data-v-46b21138="" class="infinite-status-prompt" style="display: none;"><div data-v-46b21138=""></div></div> <div data-v-46b21138="" class="infinite-status-prompt" style="color: rgb(102, 102, 102); font-size: 14px; padding: 10px 0px; display: none;"></div></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-offset-1 col-lg-11">
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
                                                                <div class="audio-control-interface control-bg pd-10">
                                                                    <div class="row">
                                                                    
                                                                        <div class="col-lg-offset-0 col-lg-12">
                                                                            <div class="timeline">
                                                                                <div class="timeline-controls"></div>
                                                                                <div class="seekbar">
                                                                                    <div class="playhead"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="jplayer"></div>
                                                                            
                                                                        </div>
                                                                        <div class="col-lg-offset-1 col-lg-3 col-sm-1 col-xs-1">
                                                                            <div class="row">
                                                                                <div class="col-lg-3">
                                                                                    <a href="javascript:;" class="btn audio-play" tabindex="1"><i class="fa fa-play"></i></a>
                                                                                    <a href="javascript:;" class="btn audio-pause" tabindex="1"><i class="fa fa-pause"></i></a>
                                                                                </div>
                                                                                <div class="col-lg-2">
                                                                                    <a href="javascript:;" class="btn jp-mute" tabindex="1" title="mute"><i class="fa fa-volume-off"></i></a>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="jp-volume-slider" style="margin-top:14px;"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-8">
                                                                            <div class="time-container btn">
                                                                                <span class="play-time"></span> / <span class="total-time"></span>
                                                                            </div>
                                                                            <div class="btn" style="float:right;">
                                                                                <a href="javascript:;" class="full-screen" tabindex="1"><i class="fa fa-square-o"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <audio id="audio" controls style="width: 100%;background: #f1f3f4;display:none;">
                                                                    <source src="{{get_audio_source($audio)}}" type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="">Channel</label>
                                                                <p class="text-center" placeholder="">
                                                                    <img class="message-avatar round-img border" style="width: 36px;height:36px;" src="{{get_attachment_source($audio->channel)->slug}}" alt="{{get_channel_audio($audio)}}">
                                                                    <span>{{" "}}</span><br>
                                                                    {{get_channel_audio($audio)}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <div class="form-group">
                                                                <label for="">Deskripsi</label>
                                                                <div class="panel-footer ft-pn" placeholder="">
                                                                    {!!$audio->description!!}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Comment</label>
                                                                <p class="panel-footer ft-pn" placeholder="">
                                                                    {{audio_setting_comment($audio) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Visibility</label>
                                                        <p class="panel-footer ft-pn" placeholder="">
                                                            {{get_visibility($audio)}}</p>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="">Category</label>
                                                        <p class="panel-footer ft-pn" placeholder="">
                                                            {{$audio->channel->project->project->team->categoryTeam->category->name}}
                                                        </p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Bahasa</label>
                                                        <p class="panel-footer ft-pn" placeholder="">
                                                            {{$audio->language}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> Visitor can view audio ratings</label><br>
                                                        <p class="panel-footer ft-pn" placeholder="">
                                                            {{audio_setting_rate($audio) }}</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label> Notif to Subscriber</label><br>
                                                        <p class="panel-footer ft-pn" placeholder="">
                                                            {{audio_setting_notification($audio) }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Age restriction</label><br>
                                                        <p class="panel-footer ft-pn" placeholder="">
                                                            {{audio_setting_age($audio) }}</p>
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
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
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
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
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
        var delete_url = '{{ route("admin.audio.delete") }}';
        var redirect_url = '{{ route("admin.audio.index") }}';
        var $delete = $('#delete');
        var data_id = '{{$audio->id}}';
    </script>
    @if(is_leader(auth()->user())!=='false')
    <script src="{{ url('js/data-table/single-delete.js')}}"></script>
    @endif
@endsection