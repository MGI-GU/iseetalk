@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st mg-t-30">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class=""><a href="#intro">Instruction</a></li>
                                <li><a href="#1">1. Data audio</a></li>
                                <li class="active"><a href="#2">2. Description</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                            @if(is_copy_writer(auth()->user())!=='false' || is_leader(auth()->user())!=='false')
                            <a href="#" class="btn btn-default save">SAVE</a>
                            @endif
                            @if(is_copy_writer(auth()->user())!=='false')
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
                                                            <p class="panel-footer ft-pn" placeholder=""><a target="_blank" href="{{$audio->project->weblink}}">{{$audio->project->weblink}}</a></p>
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
                                            @if(is_leader(auth()->user())=='false')
                                                <div class="col-lg-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
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
                                            @else
                                                {!!Form::open()->put()->route('admin.audio.update', [$audio->id])!!}
                                                    <div class="col-lg-offset-1 col-lg-7 col-md-8 col-sm-8 col-xs-12">
                                                        {!!Form::hidden('save', 'setting')!!}
                                                        {!!Form::checkbox('allow_rating', ' Visitor can view audio ratings', 1, $audio->allow_rating==1?true:false)!!}
                                                        {!!Form::checkbox('allow_notice', ' Notif to Subscriber',1, $audio->allow_notice==1?true:false)!!}
                                                        {!!Form::checkbox('allow_age', 'Age restriction', 1, $audio->allow_age==1?true:false)!!}
                                                        <hr>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="">Comment</label>
                                                                {!!Form::select('allow_comment', 'Allow Comment', ['1'=>'Izinkan semua komentar','2'=>'Tinjau semua komentar','0'=>'Tidak'], $audio->allow_comment)!!}
                                                                {!!Form::select('sort_comment', 'Sort by', ['0'=>'Populer','1'=>'Newest'], $audio->sort_comment)!!}
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                                                        {!!Form::select('source', 'Source of Content', ['text'=>'Text','weblink'=>'Weblink'], $audio->project->source)!!}
                                                        <div id="weblink" style="display:{{$audio->project->source=='weblink'?'block':'none'}};">
                                                            {!!Form::text('url', 'Weblink', $audio->project->weblink)->placeholder('http://example.com')->autocomplete('off')!!}  
                                                        </div>
                                                        <div id="attachment" style="display:none;">
                                                            <label>Upload</label>
                                                            <btn-upload :id="0" placeholder-text="Upload attachment" type-data="source" model-data="contentProject" slug-url="{{route('admin.upload.store')}}"></btn-upload>
                                                            <br>
                                                        </div>
                                                        {!!Form::textarea('note', 'Instruction', $audio->project->note)->placeholder('Add note and instruction here')->autocomplete('off')!!}
                                                    </div>
                                                {!! Form::close() !!}
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade active in" id="2">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="app" class="pro-ad">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                                                        <div class="form-group">
                                                            <label for="">Channel</label>
                                                            <p class="panel-footer ft-pn" placeholder="">{{get_channel_audio($audio)}}</p>
                                                        </div>
                                                        @if($audio->project)
                                                            <div class="form-group">
                                                                <label for="">Project</label>
                                                                <p class="panel-footer ft-pn" placeholder="">
                                                                @if($audio->parent)
                                                                    {{$audio->parent->project->project->name}} <br><small>lead by <b>{{$audio->parent->project->project->team->leader_name}}</b></small>
                                                                @else
                                                                    {{$audio->project->project->name}} <br><small>lead by <b>{{$audio->project->project->team->leader_name}}</b></small>
                                                                @endif
                                                               </p>
                                                            </div>
                                                        @endif
                                                        <div class="form-group">
                                                            <label for="">Category</label>
                                                            <p class="panel-footer ft-pn" placeholder="">
                                                                {{get_category($audio)}} <br>
                                                                @if($audio->parent)
                                                                    <small>manage by <b>{{$audio->parent->project->project->team->name}}</b></small>
                                                                @else
                                                                    <small>manage by <b>{{$audio->project->project->team->name}}</b></small>
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Date</label>
                                                            <p class="panel-footer ft-pn"
                                                                placeholder="">
                                                                Created at <b>{{$audio->created_at->format('d M Y')}}</b><br>
                                                                Last updated at <b>{{$audio->updated_at->format('d M Y')}}</b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        @if(is_copy_writer(auth()->user())!=='false' || is_leader(auth()->user())!=='false')
                                                            {!!Form::open()->put()->route('admin.audio.update', [$audio->id])!!}
                                                                {!!Form::hidden('save', 'save')!!}
                                                                {!!Form::select('language', 'Language', get_languages()->toArray(), $audio->language)!!}
                                                                {!!Form::text('name', 'Judul / Title', $audio->name)->autocomplete('off')!!}
                                                                {!!Form::textarea('description', 'Description', $audio->description)->autocomplete('off')!!}
                                                                @if($audio->parent)
                                                                <multi-select data-label="Hashtag" data-name="tags" data-placeholder="tag" :values='{{$audio->parent->tags? json_encode($audio->parent->tags):[]}}'></multi-select>
                                                                @else
                                                                <multi-select data-label="Hashtag" data-name="tags" data-placeholder="tag" :values='{{$audio->tags? json_encode($audio->tags):[]}}'></multi-select>
                                                                @endif
                                                            {!! Form::close() !!}
                                                        @else
                                                        <div class="well">
                                                            @if(@$audio->channel->project && @$audio->channel->project->project->team)
                                                               Only Copy Writer can update this step. <a class="btn btn-link" href="{{route('admin.team.show', [$audio->channel->project->project->team->format_id])}}">Notice Team Member</a>
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
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
    <link rel="stylesheet" href="{{url('css/summernote/summernote.css')}}">
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
    <script src="{{url('js/summernote/summernote.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#inp-source').change(function() {
                if($(this).val() == 'attachment'){
                    $('#attachment').show();
                    $('#weblink').hide();
                    $('#inp-url').val('');
                }else if($(this).val() == 'weblink'){
                    $('#weblink').show();
                    $('#attachment').hide();
                }else{
                    $('#inp-url').val('');
                    $('#weblink').hide();
                    $('#attachment').hide();
                }
            });
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
        $(".save").click( function() {
            //$('#inp-save').val('save');
            $('.active form').submit();
        });
        $(".save-next").click( function() {
            $('#inp-save').val('next'); 
            $("<input />").attr("type", "hidden")
                .attr("name", "next")
                .attr("value", "next")
                .appendTo(".active form");
            $('.active form').submit();
        });
        var delete_url = '{{ route("admin.audio.delete") }}';
        var redirect_url = '{{ route("admin.audio.index") }}';
        var $delete = $('#delete');
        var data_id = '{{$audio->id}}';
    </script>
    @if(is_leader(auth()->user())!=='false')
    <script src="{{ url('js/data-table/single-delete.js')}}"></script>
    @endif
@endsection