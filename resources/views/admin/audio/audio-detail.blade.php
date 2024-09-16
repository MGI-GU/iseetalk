@extends('layouts.admin.main')

@section('content')
    <div class="blog-details-area mg-t-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box mg-t-30">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="#" data-toggle="modal" data-target="#thumbnail"><img class="border pd-10" src="{{get_audio_cover($audio->cover_source ? $audio: ($audio->parent? $audio->parent:$audio))}}" alt="{{$audio->name}}"  ></a>
                                <hr>
                                @include('admin.audio.audio-menu', array('page'=>'detail', 'audio' => $audio))
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        @include('layouts.audioslide')
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="blog-details blog-sig-details mg-t-30">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li class="active"><a href="#home"><small>Standar</small></a></li>
                                                            <!-- <li><a href="#audio"><small> Advance</small></a></li> -->
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        <a href="{{route('admin.audio.show', [$audio->format_id])}}" class="btn btn-inverse"> BACK</a>
                                                        @if(is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')
                                                            @if($audio->status=='publish')
                                                                <a href="{{route('admin.audio.update.status', [$audio->id, 'unpublish'])}}" class="btn btn-danger">UNPUBLISH</a>
                                                            @elseif($audio->status=='unpublish')
                                                                <a href="{{route('admin.audio.update.status', [$audio->id, 'publish'])}}" class="btn btn-success">PUBLISH</a>
                                                            @endif
                                                        @endif
                                                        @if($audio->edition)
                                                            <a href="{{route('admin.audio.show', [$audio->edition->format_id])}}" class="btn btn-primary">EDIT</a>
                                                        @endif
                                                        @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')                                            
                                                            @if($audio->status=='publish' && !$audio->edition)
                                                            <a href="{{route('admin.audio.edit', [$audio->id])}}" class="btn btn-primary">EDIT</a>
                                                            @endif
                                                            @if($audio->status=='publish' || $audio->status=='draft')
                                                            <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li><a href="#"><i class="fa fa-arrow-circle-down"></i> DOWNLOAD</a></li>
                                                                <!-- <li><a href="#" id="delete"><i class="fa fa-trash"></i> DELETE</a></li> -->
                                                            </ul>
                                                            @endif
                                                        @endif
                                                        
                                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="myTabContent" class="tab-content custom-product-edit">
                                            <div class="product-tab-list tab-pane fade active in" id="home">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad">
                                                            @if($audio->status=='revision')
                                                                <div class="alert alert-warning">
                                                                    @foreach($audio->audit->notes as $key => $info)
                                                                    {{$key}} : {{$info}}<br>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            <form action="#" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                                <div class="row">
                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                                        <div class="form-group">
                                                                            <label for="">Title</label>
                                                                            <p class="panel-footer ft-pn" placeholder="">{{$audio->name}}</p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Description</label>
                                                                            <div class="panel-footer ft-pn" placeholder="">{!!$audio->description!!}</div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Tags</label>
                                                                            <p class="panel-footer ft-pn" placeholder="">{!! get_tag_link($audio->tags) !!}</p>
                                                                        </div>
                                                                        @if($audio->playlists->count()>0)
                                                                        <div class="form-group">
                                                                            <label for="">Playlist</label>
                                                                            <p class="panel-footer ft-pn" placeholder="">{!! get_tag_link($audio->playlists) !!}</p>
                                                                        </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <label for="">Audioslide URL</label>
                                                                            <input class="form-control copy_url" value="{{route('web.listen', [$audio->slug])}}" readonly />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Channel URL</label>
                                                                            <input class="form-control copy_url" value="{{route('web.channel.show', [$audio->channel->slug])}}" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label for="">Status</label>
                                                                            <p class="panel-footer ft-pn" placeholder="">
                                                                                <big>
                                                                                    {!!$audio->status_label!!}
                                                                                    @if($audio->edition)
                                                                                    <span class="label label-default {{$audio->edition ? '':'hide'}}">New Edition in {{$audio->edition->project->status_label}}</span>
                                                                                    @endif
                                                                                </big>
                                                                            </p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Visibility</label>
                                                                            <p class="panel-footer ft-pn" placeholder="">{{get_visibility($audio)}}</p>
                                                                        </div>
                                                                        @if($audio->channel)
                                                                        <div class="form-group">
                                                                            <label for="">Channel</label>
                                                                            <p class="panel-footer ft-pn" placeholder="">
                                                                                <a class="btn-link" href="{{route('admin.channel.show', [$audio->channel->format_id])}}">{{get_channel_audio($audio)}}</a>
                                                                            </p>
                                                                        </div>
                                                                        @endif
                                                                        
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
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-tab-list tab-pane fade" id="audio">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad">
                                                            
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
    <div id="thumbnail" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="app">
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
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
    <link rel="stylesheet" href="{{ url('css/modals.css') }}">
    <!-- <link rel="stylesheet" href="{{ url('css/jplayer/style.css') }}"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
@endsection

@section('script')
    <!-- chosen JS ============================================ -->
    <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS ============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <script>
        $(window).load(function() {
            $('#loading').hide();
            $('.audio-slides').show();
        });
        $('body').attr('class', 'mini-navbar');
        $('#sidebar').attr('class', 'active');
        $('.logo-nav-bar img').attr('class', 'active');

        $('ul.pagination').hide();
        $(".copy_url").click( function() {
            var copyText = $(this);
            copyText.select();
            copyText[0].setSelectionRange(0, 99999);
            document.execCommand("copy");
            $(this).attr('data-original-title', "Copied").tooltip('show');
        });
        var delete_url = '{{ route("admin.audio.delete") }}';
        var redirect_url = '{{ route("admin.audio.index") }}';
        var $delete = $('#delete');
        var data_id = '{{$audio->id}}';
    </script>
    <script src="{{ url('js/data-table/single-delete.js')}}"></script>
@endsection