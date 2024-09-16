@extends('layouts.admin.main')

@section('content')
    <div  class="blog-details-area mg-t-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-image cover-image image-channel-cover" style="background:url({{get_cover($channel)}});box-shadow: inset 0px 0px 2px 0px black;">
                        <div class="blog-image"></div>
                    </div>
                    <div class="blog-details-inner white-box mg-t-10">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <p>
                                    <a href="#" data-toggle="modal" data-target="#thumbnail">
                                        <img class="border" src="{{get_attachment_source($channel)->slug}}" alt="{{$channel->name}}">
                                    </a>
                                </p>
                                
                                <hr>
                                @include('admin.channel.channel-menu')
                            </div>
                            <div class="col-lg-offset-1 col-lg-9 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-details blog-sig-details mg-t-10">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li class="active"><a href="#data"><small>Standar</small></a></li>
                                                            @if(is_leader(auth()->user())!=='false')
                                                            <li><a href="#advance"><small> Advance</small></a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        <a href="{{route('admin.channel.show', [$channel->format_id])}}" class="btn btn-inverse"> BACK</a>
                                                        @if($channel->parent)
                                                            <a href="{{route('admin.channel.update.status', [$channel->id, 'reset'])}}" class="btn btn-default">RESET</a>
                                                        @endif
                                                        <a href="#" class="btn btn-success save">SAVE</a>
                                                        <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <!-- <li><a href="#"><i class="fa fa-share"></i> SHARE</a></li> -->
                                                            @if(is_leader(auth()->user())!=='false' )
                                                                @if($channel->status=='publish' && $channel->backup)
                                                                    <li><a href="{{route('admin.channel.update.status', [$channel->id, 'reset'])}}"><i class="fa fa-refresh"></i> RESET</a></li>
                                                                @endif
                                                                @if($channel->status=='draft' || $channel->status=='reject')
                                                                    <li><a href="#"><i class="fa fa-trash"></i> DELETE</a></li>
                                                                @endif
                                                            @endif
                                                        </ul>             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="myTabContent" class="tab-content custom-product-edit">
                                            <div class="product-tab-list tab-pane fade active in" id="data">
                                                <div id="app" class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad">
                                                            <div class="row">
                                                                {!!Form::open()->put()->route('admin.channel.update', [$channel->id])->attrs(['class' => 'form active-form'])!!}
                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mg-t-15">
                                                                        <div class="form-group">
                                                                            <label for="">ID</label>
                                                                            <p class="panel-footer ft-pn">
                                                                                {{$channel->parent ? $channel->parent->format_id : $channel->format_id}}
                                                                            </p>
                                                                        </div>
                                                                        @if((is_leader(auth()->user())!=='false' || is_copy_writer(auth()->user())!=='false') && $channel->status=='publish' || $channel->parent)
                                                                            {!!Form::text('name', 'Nama channel', $channel->name)->autocomplete('off')!!}
                                                                            {!!Form::textarea('description', 'Description', $channel->description)->autocomplete('off')!!}
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
                                                                        <div class="form-group">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th colspan="4">Daftar Audio ({{$channel->no_audio}})</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($channel->audios as $key => $audio)
                                                                                        <tr>
                                                                                            <td>{{$key+1}}</td>
                                                                                            <td><a href="{{route('admin.audio.show', [$audio->id])}}">{{$audio->name}}</a></td>
                                                                                            <td>{{$audio->duration > 0 ? format_time($audio->duration):'-'}} </td>
                                                                                            <td class="pull-right">
                                                                                                <a class="btn btn-inverse" href="{{url('admin/project/audio/1')}}"><i class="fa fa-edit"></i></a>
                                                                                                <a class="btn btn-inverse" href="{{url('admin/audio/1')}}"><i class="fa fa-download"></i></a>
                                                                                                <a class="btn btn-inverse" href="{{url('admin/audio/1')}}"><i class="fa fa-trash"></i></a>
                                                                                                <a class="btn btn-inverse" href="{{url('admin/audio/1')}}"><i class="fa fa-share"></i></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                        @if(check_account('admin'))
                                                                        <div class="form-group mg-t-10">
                                                                            {!!Form::select('status', 'Status', ['draft'=>'Waiting for Approval','publish'=>'Publish','reject'=>'Reject'], $channel->status)!!}
                                                                            {!!Form::select('type', 'Trending List', ['none'=>'None','best'=>'Best of '.get_apps()->name,'hot'=>'Hot'], $channel->type)!!}
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                {!! Form::close() !!}

                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="row">
                                                                    @if($channel->status!='publish')
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <br>
                                                                            <h5>REUPLOAD LOGO</h5>
                                                                            <upload :id={{ $channel->id }} placeholder-text="Click to update Logo Image" type-data="cover" model-data="channel" slug-url="{{$channel->attachment_source ? route('admin.upload.update', [$channel->attachment_source->id]):route('admin.upload.store')}}"></upload>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <br>
                                                                            <h5>REUPLOAD COVER</h5>
                                                                            <upload :id={{ $channel->id }} placeholder-text="Click to update Banner Image" type-data="background" model-data="channel" slug-url="{{$channel->background_source ? route('admin.upload.update', [$channel->background_source->id]):route('admin.upload.store')}}"></upload>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            @if(is_leader(auth()->user())!=='false')
                                            <div class="product-tab-list tab-pane fade" id="advance">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad">
                                                            {!!Form::open()->put()->route('admin.channel.update', [$channel->id])->attrs(['class' => 'form2'])!!}   
                                                                <div class="row">
                                                                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mg-t-15">
                                                                        <h5>Setting</h5>
                                                                        <div class="form-group ">
                                                                            <label><input type="checkbox" checked="true"> Visitor can view audio ratings</label><br>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label><input type="checkbox" > Publish to Subscriptions feed and notify subscribers</label><br>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label><input type="checkbox" >Age restriction</label><br>
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mg-t-10">
                                                                    {!!Form::select('language', 'Language', get_languages()->toArray(),$channel->language)!!}
                                                                    </div>
                                                                </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                        
                                                    </div>
                                                </div>
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
    <div id="thumbnail" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div>
                    <div class="modal-close-area modal-close-df">
                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div>
                    
                    <img src="{{get_attachment_source($channel)->slug}}" alt=""  >

                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
<link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
<link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
<link rel="stylesheet" href="{{ url('css/modals.css') }}">
<link rel="stylesheet" href="{{url('css/summernote/summernote.css')}}">

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
    <!-- <script src="{{ url('js/dropzone/dropzone.js') }}"></script> -->
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
        $(".save").click( function() {
            $('.active-form').submit();
        });
        $('#myTabedu1 li a').click(function () { 
            $('.form').toggleClass("active-form");
            $('.form2').toggleClass("active-form");
        });
    </script>
@endsection