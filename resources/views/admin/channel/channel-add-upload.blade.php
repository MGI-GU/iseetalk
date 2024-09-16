@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st  mg-t-30">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            @if($channel->parent && $channel->project)
                            <a class="btn back-btn" href="{{route('admin.project.show', [$channel->parent ? $channel->parent->project->project->format_id : $channel->project->project->format_id ])}}">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            @endif
                            <ul id="myTabedu1" class="tab-review-design">

                                <li class=""><a href="#1">1. {{ is_leader(auth()->user())!=='false' || is_copy_writer(auth()->user())!=='false' ? 'Edit':'Data'}} Channel</a></li>
                                <li class="active"><a href="#2">2. Gambar Cover</a></li>
                                    
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                            @if(is_graphic_design(auth()->user())!=='false')
                            <a href="#" class="btn btn-success save-next">{{$channel->status=='draft'?'SUBMIT':'SAVE'}}</a>
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
                        <div class="product-tab-list tab-pane fade" id="1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="pro-ad">
                                                <div class="row">
                                                    <div class="col-lg-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        @if(is_leader(auth()->user())!=='false' || is_copy_writer(auth()->user())!=='false')
                                                            {!!Form::open()->put()->route('admin.channel.update', [$channel->id])->attrs(['class' => 'form active-form'])!!}
                                                                {!!Form::text('name', 'Nama channel', $channel->name)->autocomplete('off')!!}
                                                                {!!Form::textarea('description', 'Description', $channel->description)->autocomplete('off')!!}
                                                                {!!Form::submit("SAVE")->success()->size('lg')!!}
                                                            {!! Form::close() !!}
                                                        @else
                                                            <div class="form-group">
                                                                <label for="">Nama Channel</label>
                                                                <p class="panel-footer ft-pn" placeholder="">{{$channel->name}}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Description</label>
                                                                <p class="panel-footer ft-pn" placeholder="">{{$channel->description}}</p>
                                                            </div>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade active in" id="2">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                    
                                    <div class="blog-image cover-image image-channel-cover" style="background:url({{get_cover($channel)}});box-shadow: inset 0px 0px 2px 0px black;">
                                        <div class="blog-image"></div>
                                    </div>
                                    <div class="review-content-section">
                                        <div class="pro-ad">
                                            <div class="row">
                                                <div class="col-lg-offset-1 col-lg-4 col-md-5 col-sm-8 col-xs-12">
                                                    @if(get_attachment_source($channel))
                                                    <div class="form-group">
                                                        <img class="border" style="max-width:200px;" src="{{get_attachment_source($channel)->slug}}" alt="{{$channel->name}}">
                                                    </div>
                                                    @endif
                                                    
                                                </div>
                                                <div class="col-lg-7 col-md-6 col-sm-10 col-xs-12">
                                                    @if(is_graphic_design(auth()->user())!=='false')
                                                        
                                                        <div id="dropzone1" class="pro-ad">
                                                            <div id="app">
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                        <h5>Upload Logo Channel</h5>
                                                                        <upload :id={{ $channel->id }} placeholder-text="Upload channel logo" type-data="cover" model-data="channel" slug-url="{{$channel->attachment_source ? route('admin.upload.update', [$channel->attachment_source->id]):route('admin.upload.store')}}"></upload>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                        <h5>Upload Banner Channel</h5>
                                                                        <upload :id={{ $channel->id }} placeholder-text="Upload channel banner" type-data="background" model-data="channel" slug-url="{{$channel->background_source ? route('admin.upload.update', [$channel->background_source->id]):route('admin.upload.store')}}"></upload>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {!!Form::open()->put()->route('admin.channel.update', [$channel->id])->id('save_form')!!}
                                                                <div class="payment-adress mg-t-10">
                                                                    <!-- <button type="submit" class="btn btn-primary waves-effect waves-light">NEXT</button> -->
                                                                </div>
                                                            {!! Form::close() !!}

                                                        </div>
                                                    @else
                                                        <div class="well">Only Graphic Design can update this step. <a class="btn btn-link" href="{{route('admin.team.show', [$channel->project->project->team->format_id ?? $channel->parent->project->project->team->format_id])}}">Notice Team Member</a></div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-offset-1 col-lg-11">
                                                    <div class="form-group">
                                                        <label for="">Nama Channel</label>
                                                        <p class="panel-footer ft-pn" placeholder="">{{$channel->name}}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Description</label>
                                                        <div class="panel-footer ft-pn" placeholder="">{!!$channel->description!!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
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
        /*--------------------------
        TEXT EDITOR
        ---------------------------- */	
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

        $(".save-next").click( function() {
            $('#save_form').submit();
        });
        var delete_url = '{{ route("admin.channel.delete") }}';
        var redirect_url = '{{ route("admin.channel.index") }}';
        var $delete = $('#delete');
        var data_id = '{{$channel->id}}';
    </script>
    @if(is_leader(auth()->user())!=='false')
    <script src="{{ url('js/data-table/single-delete.js')}}"></script>
    @endif
@endsection