@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-30 mg-b-15">
    <div id="app" class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st mg-t-30">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class=""><a href="#intro">Instruction</a></li>
                                <li class="{{app('request')->input('step')=='1'?'active':''}}"><a href="#1">Data audio</a></li>
                                <li class="active"><a href="#3">Audio cover</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 text-right" style="display: -webkit-inline-box;">
                            <big style="font-size:x-large;margin-right: 5px;">
                                <span class="label label-{{strpos($audio->contain, 'reject') !== false ? 'danger':'info'}}">{{strpos($audio->contain, 'slide') !== false ? $audio->contain : 'Waiting for slide Approval' }}</span>
                            </big>
                            
                            @if(is_graphic_design(auth()->user())!=='false')
                                {!!Form::open()->put()->route('admin.audio.update', [$audio->id])->id('save_form')!!}
                                    
                                {!! Form::close() !!}
                                <a id="save_btn" href="#" {{strpos($audio->contain, 'slide') !== false ? '':'disabled'}} class="btn btn-success {{strpos($audio->contain, 'slide') !== false ? 'save':''}}">SUBMIT</a>
                            @endif
                            @if(is_leader(auth()->user())!=='false')
                                <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#" id="delete"><i class="fa fa-trash"></i> DELETE</a></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade" id="intro">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="pro-ad">
                                            <div class="row">
                                                @if($audio->project->source=='attachment' )
                                                    <div class="col-lg-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="">Attachment</label>
                                                            <p class="panel-footer ft-pn" placeholder=""><a href="{{$audio->project->source_content->slug}}">{{$audio->project->source_content->slug}}</a></p>
                                                        </div>
                                                    </div>
                                                @elseif($audio->project->source=='weblink' )
                                                    <div class="col-lg-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="">Link</label>
                                                            <p class="panel-footer ft-pn" placeholder=""><a href="{{$audio->project->weblink}}" target="_blank">{{$audio->project->weblink}}</a></p>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-lg-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Instruction</label>
                                                        <p class="panel-footer ft-pn" placeholder="">{{$audio->project->note}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade" id="1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="pro-ad">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Audio Source</label>
                                                        <p class="panel-footer ft-pn">{{$audio->project->source}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Comments</label>
                                                        <p class="panel-footer ft-pn">{{audio_setting_comment($audio) }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> Visitor can view audio ratings</label><br>
                                                        <p class="panel-footer ft-pn">{{audio_setting_rate($audio) }}</p>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label> Notif to Subscriber</label><br>
                                                        <p class="panel-footer ft-pn">{{audio_setting_notification($audio) }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> Age restriction</label><br>
                                                        <p class="panel-footer ft-pn">{{audio_setting_age($audio) }}</p>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Title</label>
                                                        <p class="panel-footer ft-pn">{{$audio->name}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Deskripsi</label>
                                                        <div class="panel-footer ft-pn">{!!$audio->description!!}</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Tag</label>
                                                        <p class="panel-footer ft-pn">{!! get_tag_link($audio->tags) !!}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Language</label>
                                                        <p class="panel-footer ft-pn">{{$audio->language}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Category</label>
                                                        <p class="panel-footer ft-pn">{{get_category($audio)}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade active in" id="3">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="pro-ad">
                                            <div class="row">
                                                <div id="app" class="col-lg-offset-1 col-lg-3 col-md-10 col-sm-10 col-xs-12">
                                                    @if(is_graphic_design(auth()->user())!=='false' && $audio->source_label == 'inHouse')
                                                        {!!Form::select('progress_status', 'Progress Step', ['step4'=>'Step Graphic Designer','step3'=>'Send back to Slide Manager','step2'=>'Send back to Audio Engineer','step1'=>'Send back to Copy Writer'], $audio->project->status)!!}
                                                    @endif
                                                    @if(get_audio_cover($audio))
                                                        <div class="form-group">
                                                            <label for="">Cover</label>
                                                            <p class="panel-footer ft-pn"><img class="border pd-10" src="{{get_audio_cover($audio->cover_source ? $audio: ($audio->parent? $audio->parent:$audio))}}" alt="{{$audio->name}}"></p>
                                                        </div>
                                                    @endif
                                                    <div id="dropzone1" class="pro-ad">
                                                        @if(is_graphic_design(auth()->user())!=='false')
                                                            <upload :id={{ $audio->id }} placeholder-text="Image must use resolution size 900x383px" type-data="cover" model-data="audio" slug-url="{{$audio->cover_source ? route('admin.upload.update', [$audio->cover_source->id]):route('admin.upload.store')}}"></upload>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-10 col-sm-10 col-xs-12">
                                                    @if($audio->duration==0 || $audio->duration<=0)
                                                        <div class="alert alert-warning">
                                                            Durasi audio tidak valid, silahkan kirim kembali content ke Audio Enginner untuk di periksa kembali.
                                                        </div>
                                                    @endif
                                                    <div id="image_alert" style="display:none;" class="alert alert-warning">Cant use Cover Image with this resolution, please use standard resolution with width: 900px and height: 383px</div>
                                                    @if(is_graphic_design(auth()->user())=='false')
                                                        <div class="well">
                                                            @if(@$audio->channel->project && @$audio->channel->project->project->team)
                                                                Only Graphic Design can update this step. <a class="btn btn-link" href="{{route('admin.team.show', [$audio->channel->project->project->team->format_id])}}">Notice Team Member</a>
                                                            @else
                                                                This content doest not have a Project Team to manage this step, please select the avaiable team first. <a href="{{route('admin.project.edit', [$audio->channel->project->project->id])}}" class='btn btn-default'>Go to Project Detail</a>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="">{{$audio->name}}</label>
                                                        @if(is_graphic_design(auth()->user())!=='false')
                                                        <div class="float text-right" style="float: right;">
                                                            <a href="{{route('admin.audio.set.slide.status', [$audio->id, 'reject-slide'])}}" class="btn btn-sm btn-link">Reject Slide</a>
                                                            <a href="{{route('admin.audio.set.slide.status', [$audio->id, 'approve-slide'])}}" class="btn btn-sm btn-default">Approve Slide</a>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        @endif
                                                        <div id="audio-slideshow" class="audio-slideshow panel-footer ft-pn" data-audio="{{get_audio_source($audio)}}" data-audio-duration="{{$audio->duration}}">
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
<br><br>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <style>
        .fb-share-button > span{
            height: 25px !important;
        }
        .fb-share-button > span > iframe{
            width: 90px !important;
            height: 30px !important;
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
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
    <script src="{{ url('js/pdf/jquery.media.js') }}"></script>
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

        $(function(){
		    var step_url = '{{ route("admin.audio.update.status", [":id",":status"]) }}';
            // bind change event to select
            $('#inp-progress_status').on('change', function () {
                var status = $(this).val(); // get selected value
                var audio = "{{$audio->id}}";
                var url = step_url.replace(":id", audio).replace(":status", status);
                if (url) { // require a URL
                    // alert(url);
                    window.location = url; // redirect
                }
                return false;
            });
        });
        
        $(".save").click( function() {
            $('#save_form').submit();
        });

        document.getElementById("audio").duration

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