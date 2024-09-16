@extends('layouts.studio.main')

@section('content')
    <div class="blog-details-area mg-t-15">
        <div class="container-fluid">
            <div id="app" class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-image cover-image image-channel-cover" style="background:url({{get_cover($data)}})">
                        @if($data->status=='draft')
                        <div class="upload-background">
                            <upload :id={{ $data->id }} placeholder-text="Update Banner Image" type-data="background" model-data="channel" slug-url="{{$data->background_source ? route('upload.update', [$data->background_source->id]):route('upload.store')}}"></upload>
                        </div>
                        @endif
                    </div>
                    <div class="blog-details-inner white-box">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <div class="text-center">
                                    <a href="{{route('web.channel.show', [$data->slug])}}"><img style="height: 150px;" src="{{get_attachment_source($data)->slug}}" alt="{{$data->name}}" title="{{$data->name}}"></a>
                                </div>
                                @if($data->status=='draft')
                                <div class="upload-top">
                                    <upload :id={{ $data->id }} placeholder-text="Update Logo Channel" type-data="cover" model-data="channel" slug-url="{{$data->attachment_source ? route('upload.update', [$data->attachment_source->id]):route('upload.store')}}"></upload>
                                </div>
                                @endif
                                <p class="mg-t-10">
                                    <small>STATUS : {!!$data->status_label!!} </small> 
                                </p>
                                <p class="mg-t-10"><small>Updated : {!!$data->last_update!!}</small></p>
                                <br>
                                <nav class="sidebar-nav left-sidebar-menu-pro">
                                    <ul class="metismenu" id="menu1">
                                        @if($data->parent)
                                        <li>
                                            <a class="btn btn-default" href="{{route('studio.channel.edit', $data->parent->slug)}}">
                                                <span class="mini-click-non">Published Details</span>
                                            </a>
                                        </li>
                                        @endif
                                        @if($data->edition)
                                        <li>
                                            <a class="btn btn-default" href="{{route('studio.channel.edit', $data->edition->slug)}}">
                                                <span class="mini-click-non">Edition Details</span>
                                            </a>
                                        </li>
                                        @endif
                                        <li class="">
                                            <a class="btn btn-default {{strpos(Request::path(), 'studio/channel/') !== false ? 'active':''}}" href="/studio/channel/{{$data->slug}}">
                                                <span class="mini-click-non">Details</span>
                                            </a>
                                        </li>
                                        <!-- <li class="">
                                            <a class="btn btn-default {{strpos(Request::path(), 'analytic') !== false ? 'active':''}}" href="/studio/channel/{{$data->id}}/analytic">
                                                <span class="mini-click-non">Analitic</span>
                                            </a>
                                        </li> -->
                                        <li class="">
                                            <a class="btn btn-default {{strpos(Request::path(), 'analytic') !== false ? 'active':''}}" href="{{route('web.channel.show', [$data->slug])}}">
                                                <span class="mini-click-non"><i class="fa fa-link"></i> View & Listen</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                @if($data->status=='revision')
                                    <div class="alert alert-warning">
                                        @foreach($data->audit->notes as $key => $info)
                                        {{$key}} : {{$info}}<br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="latest-blog-single blog-single-full-view">
                                    <!-- <div class="blog-image">
                                        <h4>{{$data->name}}</h4>
                                    </div> -->
                                    
                                    <div class="blog-details blog-sig-details mg-t-30">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li><a href="{{route('studio.channel.audio', [$data->slug])}}"><small>List Audioslide</small></a></li>
                                                            <li class="active"><a href="#home"><small>About Channel</small></a></li>
                                                            <li><a href="{{route('studio.channel.edit', [$data->slug])}}?subscription=1"><small>Subscriber ({{$subscriber}})</small></a></li>
                                                            @if($data->visibility == 'private' && $data->status == 'publish')
                                                            <li><a href="{{route('studio.channel.edit', [$data->slug])}}?request=1"><small>Request ({{$subscriber}})</small></a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        <a href="{{ URL::previous() }}" class="btn btn-inverse">BATAL</a>
                                                        @if($data->status!='publish' && $data->status!='review')
                                                        <a href="#" class="btn btn-default save">
                                                            SAVE
                                                        </a>
                                                        @endif
                                                        @if($data->status=='publish')
                                                            <a href="{{route('studio.channel.update.status', [$data->id, 'revoke'])}}" class="btn btn-default">
                                                                REVOKE
                                                            </a>
                                                            @if($data->backup)
                                                            <a href="{{route('studio.channel.update.status', [$data->id, 'reset'])}}" class="btn btn-default">
                                                                RESET
                                                            </a>
                                                            @endif
                                                        @endif
                                                        @if($data->status!='publish' && $data->status!='review')
                                                            @if($data->parent || ($data->attachment_source && $data->background_source))
                                                            {!!Form::open()->put()->route('studio.channel.update', [$data->id])->attrs(['style'=>'display: inline-flex;'])!!}
                                                                {!!Form::hidden('type', 'publish')!!}
                                                                <button href="#" type="submit" class="btn btn-success">
                                                                    PUBLISH
                                                                </button>
                                                            {!! Form::close() !!}
                                                            @endif
                                                        @endif
                                                        
                                                        <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="#" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> DELETE</a></li>
                                                        </ul>
                                                        <div id="delete" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header header-color-modal bg-color-4"></div>
                                                                    <div class="modal-body">
                                                                            
                                                                        <h4 class="pull-left">Are you sure to delete this channel ?</h4>
                                                                        <br>
                                                                        <p class="pull-left">Delete action also will delete all audio in this channel</p>
                                                                        {!!Form::open()->post()->route('studio.channel.delete', [$data->slug])->id('data')!!}
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                                                                                    <div class="pull-right">
                                                                                        <a class="btn btn-default" data-dismiss="modal" href="#">Cancel</a>
                                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">DELETE</button>
                                                                                    </div>
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
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="home">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    
                                                    <div class="pro-ad">
                                                        {!!Form::open()->put()->route('studio.channel.update', [$data->id])->attrs(['class' => 'form_edit'])!!}
                                                            <div class="row mg-t-10">
                                                                <div class="col-lg-offset-1 col-lg-10 col-md-8 col-sm-8 col-xs-8">
                                                                @if($data->status=='publish' || $data->status=='review')
                                                                    <div class="form-group">
                                                                        <label for="">Nama Channel</label>
                                                                        <p class="panel-footer ft-pn" placeholder="">
                                                                            {{$data->name}}</p>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Description</label>
                                                                        <div class="panel-footer ft-pn" placeholder="">
                                                                            {!!$data->description!!}</div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Visibility</label>
                                                                        <div class="panel-footer ft-pn" placeholder="">
                                                                            {!!$data->visibility!!}</div>
                                                                    </div>
                                                                @else
                                                                    {!!Form::text('name', 'Title', $data->name)->autocomplete('off')!!}
                                                                    {!!Form::textarea('description', 'Description')->value($data->description)->autocomplete('off')!!}
                                                                    {!!Form::select('visibility', 'Visibility', ['public' => 'Public', 'private'=>'Private'])->value($data->visibility)!!}
                                                                @endif
                                                                </div>
                                                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="row mg-t-10">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <br>
                                                                            <h5>REUPLOAD LOGO</h5>
                                                                            
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <br>
                                                                            <h5>REUPLOAD BANNER</h5>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                                <!-- <button href="#" type="submit" class="btn btn-success">
                                                                    Save
                                                                </button> -->
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
    .upload-background{
        right: 0;
        position: absolute;
        top: 0;
    }
    .upload-background .dropzone {
        padding: 0;
        min-height: 10px !important;
    }
    .upload-background .dz-message{
        padding: 0 10px !important;
    }
</style>
@endsection

@section('script')
<script>
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
    
</script>
    <!-- chosen JS
		============================================ -->
    <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS
		============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <script>
        $(".save").click( function() {
            $('.form_edit').submit();    
        });
    </script>
@endsection