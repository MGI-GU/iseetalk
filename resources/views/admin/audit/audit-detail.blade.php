@extends('layouts.admin.main')

@section('content')
    <div class="blog-details-area mg-t-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @if(app('request')->input('f')=='channel')
                    <div class="blog-image cover-image image-channel-cover" style="background:url({{get_cover($audit->channel)}});box-shadow: inset 0px 0px 2px 0px black;">
                        <div class="blog-image"></div>
                    </div>
                    @endif
                    <div class="blog-details-inner white-box mg-t-15">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                @if(app('request')->input('f')!='project')
                                <a href="#" data-toggle="modal" data-target="#thumbnail">
                                    <img src="{{app('request')->input('f')=='channel'?get_attachment_source($audit->channel)->slug:(get_audio_cover($audit->audio->cover_source ? $audit->audio: ($audit->audio->parent? $audit->audio->parent:$audit->audio)))}}" class="border" alt=""  >
                                </a>
                                @endif
                                <hr>
                                @if(app('request')->input('f')=='channel')
                                    @include('admin.channel.channel-menu',  array('page'=>'detail', 'channel' => $audit->channel))
                                @elseif(app('request')->input('f')=='audio')
                                    @include('admin.audio.audio-menu',  array('page'=>'detail', 'audio' => $audit->audio))
                                @endif
                                
                            </div>
                            <div class="col-lg-offset-1 col-lg-9 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    @if(app('request')->input('f')=='project')
                                        @include('admin.audit.project',  array('page'=>'detail', 'project' => $audit->channel))
                                    @elseif(app('request')->input('f')=='channel')
                                        @include('admin.audit.channel',  array('page'=>'detail', 'channel' => $audit->channel))
                                    @elseif(app('request')->input('f')=='audio')
                                        @include('admin.audit.audio', array('page'=>'detail', 'audio' => $audit->audio))
                                    @endif

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

                    <img src="{{url('img/courses/1.jpg')}}" alt=""  >

                </div>
            </div>
        </div>
    </div>
    <div id="suspend" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-color-modal bg-color-4">
                    <h4 class="modal-title">Rejected Note</h4>
                    <div class="modal-close-area modal-close-df">
                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div class="modal-body">

                    {!!Form::open()->put()->route('admin.audit.update', [$audit->id])->id('data')!!}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                                {!!Form::select('suspend', 'Category', ['image' => 'Image', 'audio'=>'Audio', 'title'=>'Title', 'text'=>'Description', 'age'=>'Age'])!!}
                                {!!Form::textarea('notes', 'Notes')!!}
                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">SEND</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
<link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
<link rel="stylesheet" href="{{ url('css/modals.css') }}">
@if(app('request')->input('f')=='audio')
<link rel="stylesheet" href="{{ url('css/jplayer/style.css') }}">
@endif

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
    <script>
        $('body').attr('class', 'mini-navbar');
        $('#sidebar').attr('class', 'active');
        @if(app('request')->input('f')=='audio')
            $(window).load(function() {
                $('#loading').hide();
                $('.audio-slides').show();
            });
        @endif
        $(".copy_url").click( function() {
            var copyText = $(this);
            copyText.select();
            copyText[0].setSelectionRange(0, 99999);
            document.execCommand("copy");
            $(this).attr('data-original-title', "Copied").tooltip('show');
        });
    </script>
@endsection
