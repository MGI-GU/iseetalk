@extends('layouts.admin.main')

@section('content')
    <!-- Single pro tab review Start-->
    <div  class="single-pro-review-area mg-t-30 mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #ffffff;border-left: 1px solid #ddd;border-right: 1px solid #ddd;">
                    <div class="product-payment-inner-st mg-t-30">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <ul id="myTabedu1" class="tab-review-design">
                                    <li class=""><a href="#intro">Instruction</a></li>
                                    <li class="{{app('request')->input('step')=='1'?'active':''}}"><a href="#1">Data audio</a></li>
                                    <li class="active"><a href="#4">Slide Manager</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                <div class="row">
                                    <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6 text-right">
                                        @if(is_slide_manager(auth()->user())!=='false' && $audio->source_label == 'inHouse')
                                            <select name="progress_status" id="inp-progress_status" class="form-control">
                                                <option value="step3" selected="">Slide Manager</option>
                                                <option value="step2">Send back to Audio Engineer</option>
                                                <option value="step1">Send back to Copy Writer</option>
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6 text-right">
                                        @if(is_slide_manager(auth()->user())!=='false')
                                            <a href="#" class="btn btn-default save">SAVE</a>
                                            <a href="#" class="btn btn-success save-next">SUBMIT</a>
                                        @endif
                                        @if(is_leader(auth()->user())!=='false')
                                            <a href="{{ url()->previous() }}" class="btn btn-inverse">Back</a>
                                            <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" id="delete"><i class="fa fa-trash"></i> DELETE</a></li>
                                            </ul>
                                        @endif
                                        {!!Form::open()->put()->route('admin.audio.update', [$audio->id])->id('save_form')!!}
                                            {!!Form::hidden('duration')->value($audio->duration)!!}
                                            {!!Form::hidden('save', 'save')!!}
                                        {!! Form::close() !!}
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
                                                        <a href="#" data-toggle="modal" data-target="#thumbnail"><img src="{{get_audio_cover($audio->cover_source ? $audio: ($audio->parent? $audio->parent:$audio))}}" alt="{{$audio->name}}"></a>
                                                    </div>
                                                    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="">Title</label>
                                                            <p class="panel-footer ft-pn" placeholder="">{{$audio->name}}</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Description</label>
                                                            <div class="panel-footer ft-pn" placeholder="">{!!$audio->description!!}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="">Comments</label>
                                                                    <p class="panel-footer ft-pn" placeholder="">{{audio_setting_comment($audio) }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> Visitor can view audio ratings</label><br>
                                                                    <p class="panel-footer ft-pn" placeholder="">{{audio_setting_rate($audio) }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> Send Notification to Subscriber</label><br>
                                                                    <p class="panel-footer ft-pn" placeholder="">{{audio_setting_notification($audio) }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> Age restriction</label><br>
                                                                    <p class="panel-footer ft-pn" placeholder="">{{audio_setting_age($audio) }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="">Audio Source</label>
                                                                    <p class="panel-footer ft-pn" placeholder="">{{$audio->project->source ? $audio->project->source : $audio->parent->project->source}}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Tag</label>
                                                                    <p class="panel-footer ft-pn" placeholder="">{!! get_tag_link($audio->tags) !!}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Bahasa</label>
                                                                    <p class="panel-footer ft-pn" placeholder="">{{$audio->language ? $audio->language :'None'}}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Category</label>
                                                                    <p class="panel-footer ft-pn" placeholder="">{{get_category($audio)}}</p>
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
                            <div class="product-tab-list tab-pane fade active in" id="4">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div class="pro-ad">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-10 col-sm-10 col-xs-12">
                                                        @if($audio->duration==0 || $audio->duration<=0)
                                                            <div class="alert alert-warning">
                                                                Durasi audio tidak valid, silahkan kirim kembali content ke Audio Enginner untuk di periksa kembali.
                                                            </div>
                                                        @endif
                                                        @if($audio->audio_source || $audio->parent)
                                                            <div id="featured-media">
                                                                <audio id="audio" class="in" controls style="width: 100%;background: #f1f3f4;" controlsList="nodownload">
                                                                    <h4>{{$audio->name}}</h4>
                                                                    <source src="{{get_audio_source(!$audio->parent ? $audio:($audio->audio_source?$audio:$audio->parent))}}" type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            </div>
                                                            <input type="hidden" id="start_time" name="start_time" value="0">
                                                        @endif

                                                        @if(is_slide_manager(auth()->user())!=='false' || (is_leader(auth()->user())!=='false' && $audio->project->status=='step5'))
                                                        <div id="dropzone1" class="pro-ad">
                                                            <div id="app" class="row mg-t-10">
                                                                <div  class="col-lg-3 col-sm-6 col-xs-6 col-md-6">
                                                                    <btn-upload :id={{ $audio->id }} placeholder-text="{{$audio->attachment_source?'Upload more slide':'Upload new slide'}}" type-data="attachment" model-data="audio" slug-url="{{route('admin.upload.store')}}"></btn-upload>
                                                                </div>
                                                                @if($audio->attachment_source)
                                                                <!-- <div class="col-lg-2 col-sm-6 col-xs-6 col-md-6">
                                                                    <btn-upload :id={{ $audio->id }} placeholder-text="Replace slide" type-data="attachment" is-replace="true" model-data="audio" slug-url="{{$audio->attachment_source ? route('upload.update', [$audio->attachment_source->id]):route('upload.store')}}"></btn-upload>
                                                                </div> -->
                                                                @endif
                                                                <!-- <label for="">Upload File PPT/PPTX/PDF for Audio Slide</label>
                                                                <upload :id={{ $audio->id }} placeholder-text="Upload slide presentation" type-data="attachment" model-data="audio" slug-url="{{$audio->attachment_source ? route('upload.update', [$audio->attachment_source->id]):route('upload.store')}}"></upload> -->
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    @if($audio->attachment_source)
                                                                        <br>
                                                                        @foreach($audio->attachment_sources as $attach)
                                                                            <div class="alert alert-{{$attach->image->count()==0?'info':'success'}}">
                                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                                {{$attach->image->count()==0?'Proccess':'Finish'}} create slide from : <a target="_blank" href="{{$attach->slug}}">{{$attach->slug}}</a>
                                                                                {!!Form::open()->delete()->route('studio.slide.attach.delete', [$attach->id])->attrs(['class' => 'pull-right'])!!}
                                                                                    <button type="submit" class="btn btn-sm">Delete</button>
                                                                                {!! Form::close() !!}
                                                                                @if($attach->image->count()==0)
                                                                                    <a class="pull-right btn btn-sm btn-default" href="{{route('studio.slide.create', [$attach->id])}}">Process</a>
                                                                                @else
                                                                                    <a title="refresh" class="pull-right btn btn-sm btn-default" href="{{route('studio.slide.attach.refresh', [$attach->id])}}"><i class="fa fa-refresh"></i></a>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                    <div class="row">

                                                                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6">
                                                                            <!-- <label>Draft slide</label> -->
                                                                            <div class="sparkline13-graph">
                                                                                <div class="datatable-dashv1-list custom-datatable-overright">
                                                                                    <div id="toolbar">
                                                                                        <select id="filter_draft" class="form-control dt-tb" name="filter">
                                                                                            <option value="draft">Draft Slide</option>
                                                                                            <option value="deleted">Trash Slide</option>
                                                                                        </select>
                                                                                        <br>
                                                                                        <div class="group-btn">
                                                                                            <button id="restore" style="display:none;" class="btn btn-sm btn-success show-deleted" disabled>Restore</button>
                                                                                            <button id="remove" class="btn btn-sm btn-danger show-draft" disabled>Delete</button>
                                                                                            <button id="setpage" class="btn btn-sm btn-default show-draft" disabled>1st page</button>
                                                                                            <button id="setime" class="btn btn-sm btn-default show-draft" disabled>Set to : <span class="time_show"></span></button>
                                                                                            <button id="duplicate" class="btn btn-sm btn-default show-draft" disabled>Duplicate</button>
                                                                                            <button id="manual" data-toggle="modal" data-target="#PrimaryModalalert" class="btn btn-sm btn-info show-draft" disabled>Edit</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <table id="table" class="slide-table" data-height="500" data-toggle="table" data-pagination="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-url="{!! route('admin.audio.edit', [$audio->id]) !!}"
                                                                                        data-cookie-id-table="saveId" data-card-view="true" data-click-to-select="true" data-toolbar="#toolbar">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th data-field="state" data-checkbox="true">ID</th>
                                                                                                <th data-field="name" data-editable="false">Image</th>
                                                                                                <!-- <th data-field="email" data-width="100" data-editable="false">Title</th> -->
                                                                                            </tr>
                                                                                        </thead>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-offset-0 col-lg-7 col-md-6 col-sm-6 col-xs-6">
                                                                            <!-- <label>Active slide</label> -->
                                                                            <div class="sparkline13-graph">
                                                                                <div class="datatable-dashv1-list custom-datatable-overright">
                                                                                    <div id="toolbar2">
                                                                                        <select class="form-control dt-tb" name="filter2">
                                                                                            <option value="active">Active Slide</option>
                                                                                        </select>
                                                                                        <br>  
                                                                                        <div class="group-btn">
                                                                                            <button id="remove2" class="btn btn-sm btn-danger" disabled>Draft</button>
                                                                                            <button id="replace" class="btn btn-sm btn-warning" disabled>Switch</button>
                                                                                            <button id="setpage2" class="btn btn-sm btn-default" disabled>1st page</button>
                                                                                            <button id="setime2" class="btn btn-sm btn-default" disabled>Update to : <span class="time_show"></span></button>
                                                                                            <button id="duplicate2" class="btn btn-sm btn-default" disabled>Duplicate</button>
                                                                                            <button id="manual2" data-toggle="modal" data-target="#PrimaryModalalert" class="btn btn-sm btn-info" disabled>Edit</button>
                                                                                            <button id="preview" data-toggle="modal" data-target="#previewAudioModal" class="btn btn-sm btn-success" disabled>Preview</button>
                                                                                        </div>  
                                                                                    </div>
                                                                                    <table id="table2" class="slide-table" data-height="500" data-toggle="table" data-pagination="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-url="{!! route('admin.audio.edit', [$audio->id]) !!}?filter=active"
                                                                                        data-cookie-id-table="saveId" data-card-view="true" data-click-to-select="true" data-toolbar="#toolbar2">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th data-field="state" data-checkbox="true">ID</th>
                                                                                                <th data-field="name" data-width="200" data-editable="false">Image</th>
                                                                                                <!-- <th data-field="email" data-editable="false">Title</th> -->
                                                                                                <!-- <th data-field="email" data-editable="false">Start</th> -->
                                                                                                <!-- <th data-field="email" data-editable="false">End</th> -->
                                                                                            </tr>
                                                                                        </thead>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br><br><br><br><br><br>
                                                        @else
                                                        <br>
                                                        <div class="well">
                                                            @if(@$audio->channel->project && @$audio->channel->project->project->team)
                                                               Only Slide Manager can update this step. <a class="btn btn-link" href="{{route('admin.team.show', [$audio->channel->project->project->team->format_id])}}">Notice Team Member</a>
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
    <div id="PrimaryModalalert" class="modal default-popup-PrimaryModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
                
                {!!Form::open()->put()->route('studio.slide.update', [':id'])->id('form-slide')!!}
                    @include('layouts.loading.load4')
                    <div class="modal-body">
                        <img id="view-slide" src="{{ get_image_slide(@$image) }}" alt="" style="max-width: 500px;"/>
                        <hr>
                        {!!Form::text('title', 'Title', '')->autocomplete('off')!!}
                        {!!Form::text('time_show', 'Start time', '')->autocomplete('off')!!}
                        <div id="slider-range"></div>
                        <br>
                        <p>
                            <label for="amount">Time range:</label>
                            <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        </p>
                        <div class="text-right">
                            <hr>
                            <a data-dismiss="modal" class="btn btn-link" href="#">Cancel</a>
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
    <div id="previewAudioModal" class="modal default-popup-PrimaryModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-close-area modal-close-df">
                    <a class="close close-preview" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
                <div class="modal-body">
                    @include('layouts.loading.load4')
                    <img id="view-slide2" src="{{ get_image_slide(@$image) }}" />
                    <audio id="audio2" controls style="width: 100%;background: #f1f3f4;">
                        <source src="{{get_audio_source($audio)}}" type="audio/mpeg" autoplay controlsList="nodownload">
                        Your browser does not support the audio element.
                    </audio>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
    <link rel="stylesheet" href="{{ url('css/modals.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ url('css/preloader/preloader-style.css')}}">
    <!-- x-editor CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('css/editor/select2.css')}}">
    <link rel="stylesheet" href="{{ url('css/editor/datetimepicker.css')}}">
    <link rel="stylesheet" href="{{ url('css/editor/bootstrap-editable.css')}}">
    <link rel="stylesheet" href="{{ url('css/editor/x-editor-style.css')}}">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-table.css')}}">
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-editable.css')}}">
    <style>
        #audio.in { animation: ac 1s; }

        .out {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 300px;
            z-index: 999;
            animation: an 0.5s;
            border-top: solid #94d6e9;
        }

        .dz-preview{
            left: 0;
            width: 90%;
        }

        .slide-table tbody{
            display: flex;
            flex-wrap: wrap;
        }
        span.title{
            display: none !important;
        }
        .value img{
            width: 200px;
        }
    </style>
@endsection

@section('script')
    <!-- <script src="//code.jquery.com/jquery-3.2.0.slim.min.js"></script> -->
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <!-- chosen JS
		============================================ -->
    <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS
		============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <!-- data table JS
		============================================ -->
    <script src="{{ url('js/data-table/bootstrap-table.js')}}"></script>
    <script src="{{ url('js/data-table/tableExport.js')}}"></script>
    <script src="{{ url('js/data-table/bootstrap-table-editable.js')}}"></script>
    <script src="{{ url('js/data-table/bootstrap-editable.js')}}"></script>
    <script src="{{ url('js/data-table/bootstrap-table-resizable.js')}}"></script>
    <script src="{{ url('js/data-table/colResizable-1.5.source.js')}}"></script>
    <script src="{{ url('js/data-table/bootstrap-table-export.js')}}"></script>
     <!--  editable JS
    ============================================ -->
    <script src="{{ url('js/editable/jquery.mockjax.js')}}"></script>
    <script src="{{ url('js/editable/mock-active.js')}}"></script>
    <script src="{{ url('js/editable/select2.js')}}"></script>
    <script src="{{ url('js/editable/moment.min.js')}}"></script>
    <script src="{{ url('js/editable/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{ url('js/editable/bootstrap-editable.js')}}"></script>
    <script src="{{ url('js/editable/xediable-active.js')}}"></script>
    <script src="{{url('js/ui/1.12.1/jquery-ui.js')}}"></script>
    <script type="text/javascript">
        var delete_slide_url = '{{ route("admin.slide.delete") }}';
        var restore_url = '{{ route("admin.slide.restore") }}';
        var set_time_url = '{{ route("admin.slide.setup") }}';
        var set_draft = '{{ route("admin.slide.draft") }}';
        var copy_url = '{{ route("admin.slide.copy") }}';
        var $table = $('#table');
        var $filter_draft = $('#filter_draft');
        var $remove = $('#remove');
        var $restore = $('#restore');
        var $settime = $('#setime');
        var $setpage = $('#setpage');
        var $settime2 = $('#setime2');
        var $setpage2 = $('#setpage2');
        var $manual = $('#manual');
        var $manual2 = $('#manual2');
        var $preview = $('#preview');
        var $replace = $('#replace');
        var time = $('#start_time');
        var $duplicate = $('#duplicate');
        var $duplicate2 = $('#duplicate2');
        var myAudio=document.getElementById('audio2');
        var time_play = 1000;
        var time_show = 0;
        var time_pause = 1;
        var aud = document.getElementById("audio");
        aud.onpause = function() {
            $('.setime').each(function(i, obj) {
                url = $(this).attr('href');
                url = url.split("&");;
                $(this).attr('href', url[0]+'&time='+aud.currentTime);
            });
            if(aud.currentTime<1){
                time_pause = 1;
            }else{
                time_pause = aud.currentTime;
            }
            $('.time_show').html(formatSecondsAsTime(time_pause));
        };

        aud.ontimeupdate  = function() {
            $('.setime').each(function(i, obj) {
                url = $(this).attr('href');
                url = url.split("&");;
                $(this).attr('href', url[0]+'&time='+aud.currentTime);
            });
            if(aud.currentTime<1){
                time_pause = 1;
            }else{
                time_pause = aud.currentTime;
            }
            $('.time_show').html(formatSecondsAsTime(time_pause));
        };

        function formatSecondsAsTime(secs, format) {
            var hr  = Math.floor(secs / 3600);
            var min = Math.floor((secs - (hr * 3600))/60);
            var sec = Math.floor(secs - (hr * 3600) -  (min * 60));

            if (min < 10){ 
                min = "0" + min; 
            }
            if (sec < 10){ 
                sec  = "0" + sec;
            }

            return min + ':' + sec;
        }

        function actionFormatter(data, row) {
            var new_time = $('#start_time').val();
            if(row.deleted_at==null){
                return [
                    '<a class="btn btn-xs btn-default setime" href="'+set_time_url+'?slide='+row.id+'&time=0">Set 1st page</a>',
                    '<a class="btn btn-xs btn-default setime" href="'+set_time_url+'?slide='+row.id+'&time=0">Set pause time</a>'
                ].join('');
            }
		}

        function slideImage(data, row){
            return [
                '<img src="https://pankord.s3.ap-southeast-1.amazonaws.com/'+data+'" alt="'+row.id+'" title="'+row.title+'" />',
            ].join('');
        }

		var oTable = $table.bootstrapTable({
			pagination: false,
			search: true,
			url: '{!! route("admin.audio.slide", [$audio->id]) !!}',
			columns: [
				{ field: 'state' },
				{ field: 'source', formatter: slideImage },
				// { field: 'title' }
			]
        });

        $filter_draft.change(function () {
			var filterAlgorithm = $('[name="filter"]').val()
			$table.bootstrapTable('refreshOptions', {
				url: window.location.href+'?filter='+filterAlgorithm,
				filterOptions: {
				  filterAlgorithm: filterAlgorithm
				}
			});
			console.log(filterAlgorithm);
		});

        $restore.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });

            $table.bootstrapTable('remove', {
                field: 'id',
                values: ids,
            });

            //AJAX RESTORE HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $table.bootstrapTable('showLoading');
            $table2.bootstrapTable('showLoading');
            $.ajax({
                url: restore_url,
                type: 'POST', 
                dataType: "JSON",
                data: {
                    "id": ids
                },
                success: function (response)
                {
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Error"});
                }
            });
            reset_btn();
            // $remove.prop('disabled', true);
            // $restore.prop('disabled', true);
        });

        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            var filter = $('[name="filter"]').val();
            $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
            $duplicate.prop('disabled', !$table.bootstrapTable('getSelections').length);
            $manual.prop('disabled', !$table.bootstrapTable('getSelections').length || $table.bootstrapTable('getSelections').length > 1);
            $settime.prop('disabled', !$table.bootstrapTable('getSelections').length || $table.bootstrapTable('getSelections').length > 1);
            $setpage.prop('disabled', !$table.bootstrapTable('getSelections').length || $table.bootstrapTable('getSelections').length > 1);
            $replace.prop('disabled', $table2.bootstrapTable('getSelections').length>1 || $table.bootstrapTable('getSelections').length>1 || !$table2.bootstrapTable('getSelections').length || !$table.bootstrapTable('getSelections').length );
            if(filter=='deleted'){
                $restore.prop('disabled', !$table.bootstrapTable('getSelections').length);
            }
        });

        $remove.click(function () {
            var filter = $('[name="filter"]').val();
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });

            $table.bootstrapTable('remove', {
                field: 'id',
                values: ids,
            });

            //AJAX DELETE HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $table.bootstrapTable('showLoading');
            $table2.bootstrapTable('showLoading');
            $.ajax({
                url: delete_slide_url,
                type: 'DELETE', 
                dataType: "JSON",
                data: {
                    "id": ids,
                    "filter": filter
                },
                success: function (response)
                {
                    $table.bootstrapTable('refresh');
                    $table2.bootstrapTable('refresh');
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Error"});
                }
            });
            reset_btn();

            // $remove.prop('disabled', true);
            // $restore.prop('disabled', true);
        });

        $setpage.click(function (){
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
            //AJAX HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $table.bootstrapTable('showLoading');
            $table2.bootstrapTable('showLoading');
            $.ajax({
                url: set_time_url,
                type: 'get', 
                dataType: "JSON",
                data: {
                    "type": 'first',
                    "slide": ids[0],
                    "time": 0
                },
                success: function (response)
                {
                    $table.bootstrapTable('refresh');
                    $table2.bootstrapTable('refresh');
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Error"});
                }
            });
            reset_btn();
            // $settime.prop('disabled', true);
            // $setpage.prop('disabled', true);
            // $settime2.prop('disabled', true);
            // $setpage2.prop('disabled', true);
        });

        $settime.click(function (){
            $table.bootstrapTable('showLoading');
            $table2.bootstrapTable('showLoading');
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
            //AJAX HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: set_time_url,
                type: 'get', 
                dataType: "JSON",
                data: {
                    "type": 'time_set',
                    "slide": ids[0],
                    "time": time_pause
                },
                success: function (response)
                {
                    $table.bootstrapTable('refresh');
                    $table2.bootstrapTable('refresh');
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Error"});
                    
                }
            });
            reset_btn();
        });

        var $table2 = $('#table2');
        var $remove2 = $('#remove2');
        function actionFormatter2(data, row) {
            var new_time = $('#start_time').val();
            if(row.deleted_at==null){
                return [
                    '<a class="btn btn-xs btn-default" href="'+set_time_url+'?slide='+row.id+'&time=0">Set 1st page</a>',
                ].join('');
            }
		}
        var oTable2 = $table2.bootstrapTable({
			pagination: false,
			search: true,
			url: '{!! route("admin.audio.slide", [$audio->id]) !!}?filter=active',
			columns: [
				{ field: 'state' },
				{ field: 'source', formatter: slideImage },
				// { field: 'title' },
				{ field: 'format_time_show' }
				// { field: 'format_time_end' }
			]
        });
        $table2.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $remove2.prop('disabled', !$table2.bootstrapTable('getSelections').length);
            $preview.prop('disabled', !$table2.bootstrapTable('getSelections').length || $table2.bootstrapTable('getSelections').length > 1);
            $replace.prop('disabled', $table2.bootstrapTable('getSelections').length>1 || $table.bootstrapTable('getSelections').length>1 || !$table2.bootstrapTable('getSelections').length || !$table.bootstrapTable('getSelections').length );
            $settime2.prop('disabled', !$table2.bootstrapTable('getSelections').length || $table2.bootstrapTable('getSelections').length > 1);
            $setpage2.prop('disabled', !$table2.bootstrapTable('getSelections').length || $table2.bootstrapTable('getSelections').length > 1);
            $manual2.prop('disabled', !$table2.bootstrapTable('getSelections').length || $table2.bootstrapTable('getSelections').length > 1);
            $duplicate2.prop('disabled', !$table2.bootstrapTable('getSelections').length);
        });

        $remove2.click(function () {
            var filter = $('[name="filter"]').val();
            var ids = $.map($table2.bootstrapTable('getSelections'), function (row) {
                return row.id
            });

            $table.bootstrapTable('remove', {
                field: 'id',
                values: ids,
            });

            //AJAX DELETE HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: set_draft,
                type: 'GET', 
                dataType: "JSON",
                data: {
                    "id": ids,
                    "filter": filter
                },
                success: function (response)
                {
                    reset_btn();
                    $table.bootstrapTable('refresh');
                    $table2.bootstrapTable('refresh');
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Message"});
                    
                }
            });
            reset_btn();

            // $remove.prop('disabled', true);
            // $restore.prop('disabled', true);
        });

        $manual.click(function (){
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
            manualEdit(ids);
        });

        $manual2.click(function (){
            var ids = $.map($table2.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
            manualEdit(ids);
        });

        $preview.click(function (){
            $('#loading').show();
            $('.modal-body').hide();
            
            var ids = $.map($table2.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
            var id = ids;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.slide.get')}}",
                type: 'post', 
                dataType: "JSON",
                data: {
                    "id": id
                },
                success: function (response)
                {
                    // console.log(response[0].id);
                    $('.loading').hide();
                    $('.modal-body').show();
                    $('#view-slide2').attr("src", "{!! urlStorage() !!}"+response[0].source);
                    time_play = (response[0].time_end-response[0].time_show)*1000;
                    time_show = response[0].time_show;
                    myAudio.currentTime = response[0].time_show;
                    myAudio.play();
                    setTimeout(function(){
                        setTimeout(function(){
                            myAudio.pause();
                            myAudio.currentTime = time_show;
                        }, time_play);
                    }, 1000);
                },
                error: function(xhr,response) {
                    $('.loading').hide();
                }
            });
            // reset_btn();
        });

        $replace.click(function (){
            //make draft to active selected slide
            var draft = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
            var active = $.map($table2.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
            $table.bootstrapTable('showLoading');
            $table2.bootstrapTable('showLoading');
            // console.log(draft+' to '+active);
            // validasi if no draft
            if(draft.length==0){
                alert("please select slide on draft")
            }else{

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('admin.slide.replace')}}",
                    type: 'post', 
                    dataType: "JSON",
                    data: {
                        "draft": draft[0],
                        "active": active[0]
                    },
                    success: function (response)
                    {
                        $table.bootstrapTable('refresh');
                        $table2.bootstrapTable('refresh');
                        swal({text: response.result,title: "Message"});
                    },
                    error: function(xhr,response) {
                        swal({text: response.result,title: "Error"});
                    }
                });
                reset_btn();

                // $remove.prop('disabled', true);
                // $restore.prop('disabled', true);
                // $remove.prop('disabled', true);
                // $remove2.prop('disabled', true);
                // $preview.prop('disabled', true);
                // $replace.prop('disabled', true);
                // $manual.prop('disabled', true);
            }
            
        });

        $filter_draft.change(function(){
            var filter = $filter_draft.val();
            if(filter==='draft'){
                $('.show-draft').show();
                $('.show-deleted').hide();
            }else{
                $('.show-draft').hide();
                $('.show-deleted').show();
            }
        });

        $setpage2.click(function (){
            var ids = $.map($table2.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
            $table2.bootstrapTable('showLoading');
            //AJAX HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: set_time_url,
                type: 'get', 
                dataType: "JSON",
                data: {
                    "type": 'first',
                    "slide": ids[0],
                    "time": 0
                },
                success: function (response)
                {
                    $table2.bootstrapTable('refresh');
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Error"});
                }
            });
            reset_btn();
            
        });

        $settime2.click(function (){
            $table.bootstrapTable('showLoading');
            $table2.bootstrapTable('showLoading');
            var ids = $.map($table2.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
            //AJAX HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: set_time_url,
                type: 'get', 
                dataType: "JSON",
                data: {
                    "type": 'time_set',
                    "slide": ids[0],
                    "time": time_pause
                },
                success: function (response)
                {
                    $table.bootstrapTable('refresh');
                    $table2.bootstrapTable('refresh');
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Error"});
                }
            });
            reset_btn();
        });

        $duplicate.click(function () {
            var filter = $('[name="filter"]').val();
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });

            $table.bootstrapTable('remove', {
                field: 'id',
                values: ids,
            });

            //AJAX DELETE HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: copy_url,
                type: 'POST', 
                dataType: "JSON",
                data: {
                    "id": ids
                },
                success: function (response)
                {
                    $table.bootstrapTable('refresh');
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Error"});
                }
            });
            reset_btn();
        });

        $duplicate2.click(function () {
            var filter = $('[name="filter"]').val();
            var ids = $.map($table2.bootstrapTable('getSelections'), function (row) {
                return row.id
            });

            $table.bootstrapTable('remove', {
                field: 'id',
                values: ids,
            });

            //AJAX DELETE HERE
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: copy_url,
                type: 'POST', 
                dataType: "JSON",
                data: {
                    "id": ids
                },
                success: function (response)
                {
                    $table.bootstrapTable('refresh');
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Error"});
                }
            });
            reset_btn();
        });

        function reset_btn(){
            $remove.prop('disabled', true);
            $restore.prop('disabled', true);
            $remove.prop('disabled', true);
            $remove2.prop('disabled', true);
            $preview.prop('disabled', true);
            $replace.prop('disabled', true);
            $manual.prop('disabled', true);
            $manual2.prop('disabled', true);
            $settime.prop('disabled', true);
            $settime2.prop('disabled', true);
            $setpage.prop('disabled', true);
            $setpage2.prop('disabled', true);
            $duplicate.prop('disabled', true);
            $duplicate2.prop('disabled', true);
        }

        function manualEdit(ids){
            
            $('.modal-body').hide();
            $('#loading').show();
            var id = ids;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.slide.get')}}",
                type: 'post', 
                dataType: "JSON",
                data: {
                    "id": id
                },
                success: function (response)
                {
                    console.log(response[0].id);
                    var show_url = $('#form-slide').attr("action");
                    $('#form-slide').attr("action", show_url.replace(":id", response[0].id));
                    $('#view-slide').attr("src", "{!! urlStorage() !!}"+response[0].source);
                    $('#inp-title').val(response[0].title);
                    $('#inp-time_show').val(response[0].time_show);
                    $('#inp-time_end').val(response[0].time_end);
                    slider(response[0].time_show, response[0].time_end);
                    $('#loading').hide();
                    $('.modal-body').show();
                },
                error: function(xhr,response) {
                    //
                }
            });
        }

        $('body').attr('class', 'mini-navbar');
        $('#sidebar').attr('class', 'active');

        function slider(start, end){
            $( function() {
                
                $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max: document.getElementById("audio").duration,
                    values: [ start, end ],
                    slide: function( event, ui ) {
                        $( "#amount" ).val( ui.values[ 0 ] + " seconds - " + ui.values[ 1 ] +" seconds" );
                        $("#inp-time_show").val(ui.values[ 0 ]);
                        $("#inp-time_end").val(ui.values[ 1 ]);
                    }
                });
                $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
                " seconds - " + $( "#slider-range" ).slider( "values", 1 ) +  " seconds" );
                
            } );
        }

        $(".edit-slide").click(function(){
            $('.modal-body').hide();
            $('#loading').show();
            var id = $(this).attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.slide.get')}}",
                type: 'post', 
                dataType: "JSON",
                data: {
                    "id": id
                },
                success: function (response)
                {
                    var show_url = $('#form-slide').attr("action");
                    $('#form-slide').attr("action", show_url.replace(":id", response.id));
                    $('#view-slide').attr("src", "{!! urlStorage() !!}"+response.source);
                    $('#inp-title').val(response.title);
                    $('#inp-time_show').val(response.time_show);
                    slider(response.time_show, response.time_end);
                    $('#loading').hide();
                    $('.modal-body').show();
                },
                error: function(xhr,response) {
                    //
                }
            });
        });
        
        var ha = ( $('#audio').offset().top + $('#audio').height() );

        function isOnScreen(element)
        {
            var curPos = element.offset();
            var curTop = curPos.top;
            var screenHeight = $(window).height();
            return curTop / screenHeight *100;
        }
        
        $(window).scroll(function(){
            //console.log(ha, $(window).scrollTop());
            if ( $(window).scrollTop() > 101 || isOnScreen($('#audio'))>100 ) {
                $('#audio').css('bottom','0');
                $('#audio').removeClass('in').addClass('out');
                // $('#audio').css('bottom','-500px');
            } else if ( $(window).scrollTop() < 100 || isOnScreen($('#audio'))<100) {
                $('#audio').removeClass('out').addClass('in');
            }
            // console.log(isOnScreen($('#audio')));
            if(isOnScreen($('#audio'))<100) { 
                $('#audio').removeClass('out').addClass('in');
            }else{
                $('#audio').css('bottom','0');
                $('#audio').removeClass('in').addClass('out');
            };
        });

        document.getElementById("audio").onloadedmetadata = function() {
            $('#inp-duration').val(document.getElementById("audio").duration);
        };

        function slider(start, end){
            $( function() {
                $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max: document.getElementById("audio").duration,
                    values: [ start, end ],
                    slide: function( event, ui ) {
                        $( "#amount" ).val( ui.values[ 0 ] + " s - " + ui.values[ 1 ] +" s" );
                        $("#inp-time_show").val(ui.values[ 0 ]);
                        $("#inp-time_end").val(ui.values[ 1 ]);
                    }
                });
                $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
                " s - " + $( "#slider-range" ).slider( "values", 1 ) +  " s" );
                
            } );
        }

        $('input[name=time_show]').change(function() { 
            slider($(this).val(), $("#inp-time_end").val());
        });

        $('input[name=time_end]').change(function() { 
            slider($("#inp-time_show").val(), $(this).val());
        });

        $(".edit-slide").click(function(){
            $('.modal-body').hide();
            $('#loading').show();
            var id = $(this).attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.slide.get')}}",
                type: 'post', 
                dataType: "JSON",
                data: {
                    "id": id
                },
                success: function (response)
                {
                    var show_url = $('#form-slide').attr("action");
                    $('#form-slide').attr("action", show_url.replace(":id", response.id));
                    $('#view-slide').attr("src", "https://acheeshop01.s3.ap-southeast-1.amazonaws.com/"+response.source);
                    $('#inp-title').val(response.title);
                    $('#inp-time_show').val(response.time_show);
                    slider(response.time_show, response.time_end);
                    $('#loading').hide();
                    $('.modal-body').show();
                },
                error: function(xhr,response) {
                    //
                }
            });
        });

        $(".save").click( function() {
            $('#inp-save').val('save');
            $('#save_form').submit();
        });
        $(".save-next").click( function() {
            $('#inp-save').val('next');
            $('#save_form').submit();
        });

        $('.close-preview').click(function(){
            myAudio.pause();
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