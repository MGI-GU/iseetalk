@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div  class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st mg-t-30">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class=""><a href="#intro">Instruction</a></li>
                                <li class="{{app('request')->input('step')=='1'?'active':''}}"><a href="#1">Data audio</a></li>
                                <li class="active"><a href="#4">Audio upload proses</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                            <div class="row">
                                <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6 text-right">
                                    @if(is_audio_enginer(auth()->user())!=='false' && $audio->source_label == 'inHouse')
                                        <select name="progress_status" id="inp-progress_status" class="form-control">
                                            <option value="step2">Audio Engineer</option>
                                            <option value="step1">Send back to Copy Writer</option>
                                        </select>
                                    @endif
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6 text-right">
                                    @if(is_audio_enginer(auth()->user())!=='false' || is_leader(auth()->user())!=='false')
                                    <a href="#" class="btn btn-default save">SAVE</a>
                                    @endif
                                    @if(is_audio_enginer(auth()->user())!=='false' && $audio->duration>0)
                                    <a href="#" class="btn btn-success save-next">SUBMIT</a>
                                    @endif
                                    @if(is_leader(auth()->user())!=='false')
                                        <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" id="delete"><i class="fa fa-trash"></i> DELETE</a></li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
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
                                                <div class="col-lg-2">
                                                    <label for="">Cover</label>
                                                    <a href="#" data-toggle="modal" data-target="#thumbnail"><img class="border" src="{{get_audio_cover($audio)}}" alt=""  ></a>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Audio Source</label>
                                                        <p class="panel-footer ft-pn" placeholder="">{{$audio->project->source}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Comments</label>
                                                        <p class="panel-footer ft-pn" placeholder="">{{audio_setting_comment($audio) }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> Visitor can view audio ratings</label><br>
                                                        <p class="panel-footer ft-pn" placeholder="">{{audio_setting_rate($audio) }}</p>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label> Notif to Subscriber</label><br>
                                                        <p class="panel-footer ft-pn" placeholder="">{{audio_setting_notification($audio) }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> Age restriction</label><br>
                                                        <p class="panel-footer ft-pn" placeholder="">{{audio_setting_age($audio) }}</p>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Category</label>
                                                        <p class="panel-footer ft-pn" placeholder="">{{get_category($audio)}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Channel</label>
                                                        <p class="panel-footer ft-pn" placeholder="">{{get_channel_audio($audio)}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Title</label>
                                                        <p class="panel-footer ft-pn" placeholder="">{{$audio->name}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Deskripsi</label>
                                                        <div class="panel-footer ft-pn" placeholder="">{!!$audio->description!!}</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Bahasa</label>
                                                        <p class="panel-footer ft-pn" placeholder="">{{$audio->language}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Tag</label>
                                                        <p class="panel-footer ft-pn" placeholder="">{!! get_tag_link($audio->tags) !!}</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade active in" id="4">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="app" class="pro-ad">
                                            <div class="row">
                                                <div class="col-lg-offset-1 col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                                    <div>
                                                        <center>
                                                            <div class="form-group">
                                                            @if($audio->parent)
                                                                @if($audio->audio_source)
                                                                <audio id="audio" controls style="width: 100%;background: #f1f3f4;">
                                                                    <source src="{{get_audio_source($audio)}}" type="audio/mpeg" autoplay>
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                                @else
                                                                <audio id="audio" controls style="width: 100%;background: #f1f3f4;">
                                                                    <source src="{{get_audio_source($audio->parent)}}" type="audio/mpeg" autoplay>
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                                @endif
                                                            @else
                                                                @if($audio->audio_source)
                                                                <audio id="audio" controls style="width: 100%;background: #f1f3f4;">
                                                                    <source src="{{get_audio_source($audio)}}" type="audio/mpeg" autoplay>
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                                @endif
                                                            @endif
                                                            </div>
                                                            <!-- <h1><a class="btn fa fa-volume-up"></a></h1> -->
                                                        </center>
                                                    </div>
                                                    {!!Form::open()->put()->route('admin.audio.update', [$audio->id])->id('save_form')!!}
                                                        {!!Form::hidden('duration')->value($audio->duration)!!}
                                                        {!!Form::hidden('save', 'save')!!}
                                                    {!! Form::close() !!}
                                                    @if(is_audio_enginer(auth()->user())!=='false')
                                                        @if($audio->duration==0 || $audio->duration<=0)
                                                            <div class="alert alert-info">
                                                                Durasi audio tidak valid, jika sudah upload audio file, klik tombol SAVE terlebih dahulu untuk lanjut ke tahap berikutnya.
                                                            </div>
                                                        @endif
                                                        <div id="dropzone1" class="pro-ad">
                                                            <div>
                                                                @if($audio->parent)
                                                                    <upload-audio :id={{ $audio->id }} source-upload="inhouse" type-model="audio" type-data="audio_file" slug-url="{{$audio->parent->source?route('admin.upload.update', [$audio->parent->source]):route('admin.upload.store')}}"></upload-audio>
                                                                @else
                                                                    <upload-audio :id={{ $audio->id }} source-upload="inhouse" type-model="audio" type-data="audio_file" slug-url="{{$audio->source?route('admin.upload.update', [$audio->source]):route('admin.upload.store')}}"></upload-audio>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="well">
                                                            @if(@$audio->channel->project && @$audio->channel->project->project->team)
                                                                Only Audio Engineer can update this step. <a class="btn btn-link" href="{{route('admin.team.show', [$audio->channel->project->project->team->format_id])}}">Notice Team Member</a>
                                                            @else
                                                                This content doest not have a Project Team to manage this step, please select the avaiable team first. <a href="{{route('admin.project.edit', [$audio->channel->project->project->id])}}" class='btn btn-default'>Go to Project Detail</a>
                                                            @endif
                                                        </div>
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
<div id="thumbnail" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div>
                <img src="{{get_audio_cover($audio)}}" alt=""  >
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
    <link rel="stylesheet" href="{{ url('css/modals.css') }}">
    <style>
        .pro-ad .dropzone .dz-preview {
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 160px;
        }
    </style>
@endsection

@section('script')
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
    <!-- chosen JS
		============================================ -->
        <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS
		============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
	 
        $(document).ready(function () {
            total_photos_counter = 0;
            var dr = $("#upload").dropzone({
                maxFilesize: 1,
                dictRemoveFile: 'Remove',
                // acceptedFiles: "audio/*",
                timeout: 10000,
                addRemoveLinks: true,
                // previewTemplate: document.querySelector('#preview').innerHTML,
                renameFile: function (file) {
                    name = new Date().getTime() + Math.floor((Math.random() * 100) + 1) + '_' + file.name;
                    return name;
                },
                init: function () {
                    this.on("removedfile", function (file) {
                        $.post({
                            url: "{{route('admin.upload.store')}}",
                            data: {id: file.customName, _token: $('[name="_token"]').val()},
                            dataType: 'json',
                            success: function (data) {
                                total_photos_counter--;
                                $("#counter").text("# " + total_photos_counter);
                            }
                        });
                    });
                },
                success: function (file, response) {
                    // Lobibox.notify('success', {
                    // 	size: 'mini',
                    // 	msg: response.message
                    // });
                    alert(response.message);
                },
                error: function (file, response) {
                    // Lobibox.notify('error', {
                    // 	size: 'mini',
                    // 	msg: response.message
                    // });
                    this.removeFile(file);
                }
            });

            $(".deleteImage").click(function(){
                var id = $(this).attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('upload.cancel')}}",
                    type: 'delete', // replaced from put
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "model":"product"
                    },
                    success: function (response)
                    {
                        Lobibox.notify('success', {
                            size: 'mini',
                            msg: response.message
                        });
                        location.reload(true);;
                    },
                    error: function(xhr,response) {
                        Lobibox.notify('error', {
                            size: 'mini',
                            msg: response.message
                        });
                    }
                });
            });
        });
        @if($audio->audio_source)
            document.getElementById("audio").onloadedmetadata = function() {
                $('#inp-duration').val(document.getElementById("audio").duration);
            };
        @endif

        $(".save").click( function() {
            $('#inp-save').val('save');
            $('form').submit();
        });
        $(".save-next").click( function() {
            $('#inp-save').val('next');
            $('form').submit();
        });
        var delete_url = '{{ route("admin.audio.delete") }}';
        var redirect_url = '{{ route("admin.audio.index") }}';
        var $delete = $('#delete');
        var data_id = '{{$audio->id}}';

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
    </script>
    @if(is_leader(auth()->user())!=='false')
    <script src="{{ url('js/data-table/single-delete.js')}}"></script>
    @endif
@endsection