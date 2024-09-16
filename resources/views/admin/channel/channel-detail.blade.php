@extends('layouts.admin.main')

@section('content')
<div class="blog-details-area mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="blog-image cover-image image-channel-cover" style="background:url({{get_cover($channel)}});box-shadow: inset 0px 0px 2px 0px black;">
                    <div class="blog-image"></div>
                </div>
                <div class="blog-details-inner white-box">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <p>
                                <a href="#" data-toggle="modal" data-target="#thumbnail">
                                    <img class="border" src="{{get_attachment_source($channel)->slug}}" alt="{{$channel->name}}">
                                </a>
                            </p>
                            @include('admin.channel.channel-menu', array('channel' => $channel))
                        </div>
                        <div class="col-lg-offset-1 col-lg-9 col-md-10 col-sm-10 col-xs-10">
                            <div class="latest-blog-single blog-single-full-view">
                                <div class="blog-details blog-sig-details mg-t-5">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
                                            style="border-bottom:solid 1px #ddd;">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <ul id="myTabedu1" class="tab-review-design">
                                                        <li class="active"><a href="#home"><small>Standar</small></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
                                                    @if(@$channel->project)
                                                    <a href="{{ route('admin.project.show', [$channel->project->project->format_id]) }}" class="btn btn-inverse"> BACK</a>
                                                    @endif
                                                    @if(is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')
                                                        @if($channel->status=='publish')
                                                            <a href="{{route('admin.channel.update.status', [$channel->id, 'unpublish'])}}" class="btn btn-warning">UNPUBLISH</a>
                                                        @elseif($channel->status=='unpublish')
                                                            <a href="{{route('admin.channel.update.status', [$channel->id, 'publish'])}}" class="btn btn-success">PUBLISH</a>
                                                        @endif
                                                    @endif 
                                                    @if(is_admin(auth()->getUser()) !== 'false' && $channel->status=='review')
                                                    <a href="{{route('admin.channel.update.status', [$channel->id, 'approve'])}}" class="btn btn-success">APPROVE</a>
                                                    <a href="{{route('admin.channel.update.status', [$channel->id, 'reject'])}}" class="btn btn-danger">REJECT</a>
                                                    @endif
                                                    @if(is_leader(auth()->user())!=='false' || is_copy_writer(auth()->user())!=='false')
                                                        @if($channel->status=='publish')
                                                            <a href="{{url('admin/project/add/audio')}}?channel={{$channel->id}}&name={{$channel->name}}" class="btn btn-success">ADD AUDIO</a>
                                                        @endif
                                                    @endif
                                                    @if(is_leader(auth()->user())!=='false')
                                                        @if($channel->status=='draft' || $channel->status=='reject')
                                                        <a href="{{route('admin.channel.update.status', [$channel->id, 'submit'])}}" class="btn btn-success">SUBMIT</a>
                                                        @if($channel->parent)
                                                            <a href="{{route('admin.channel.update.status', [$channel->id, 'reset'])}}" class="btn btn-default">RESET</a>
                                                        @endif
                                                        <a href="#" id="delete" class="btn btn-danger"> DELETE</a>
                                                        @endif
                                                        @if($channel->status=='draft' || $channel->status=='publish')
                                                            @if($channel->edition)
                                                            <a href="{{route('admin.channel.show', [$channel->edition->format_id])}}" class="btn btn-primary">EDIT</a>
                                                            @else
                                                            <a href="{{route('admin.channel.edit', [$channel->id])}}" class="btn btn-primary">EDIT</a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                    @if((is_copy_writer(auth()->user())!=='false' || is_graphic_design(auth()->user())!=='false') && $channel->edition)
                                                        <a href="{{route('admin.channel.show', [$channel->edition->format_id])}}" class="btn btn-primary">EDIT</a>
                                                    @endif
                                                    @if(is_admin(auth()->getUser()) !== 'false')
                                                        @if($channel->status=='publish' && $channel->no_audio==0)
                                                        <a href="#" id="delete" class="btn btn-danger"> DELETE</a>
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
                                                        @if($channel->status=='revision')
                                                            <div class="alert alert-warning">
                                                                @foreach($channel->audit->notes as $key => $info)
                                                                {{$key}} : {{$info}}<br>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        <form action="#"
                                                            class="dropzone dropzone-custom needsclick add-professors"
                                                            id="demo1-upload">
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                                    <div class="form-group">
                                                                        <label for="">ID</label>
                                                                        <p class="panel-footer ft-pn">
                                                                            {{$channel->format_id}}
                                                                        </p>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Name Channel</label>
                                                                        <p class="panel-footer ft-pn" placeholder="">
                                                                            {{$channel->name}}</p>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Description</label>
                                                                        <div class="panel-footer ft-pn" placeholder="">
                                                                            {!!$channel->description!!}</div>
                                                                    </div>
                                                                    
                                                                    <!-- <div class="form-group">
                                                                        <label for="">Tags</label>
                                                                        <p class="panel-footer ft-pn" placeholder="">{!!
                                                                            get_tag_link($channel->tags) !!}</p>
                                                                    </div> -->
                                                                    <div class="form-group">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th colspan="4">List Audio ({{$channel->no_audio}})</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($channel->audios as $audio)
                                                                                <tr>
                                                                                    <td width="50"><a class="btn-link" href="{{route('admin.audio.show', [$audio->format_id])}}">{{$audio->format_id}}</a></td>
                                                                                    <td>{{$audio->name ?? '-'}}</td>
                                                                                    <td>{{$audio->duration ? format_time($audio->duration) : '-'}}</td>
                                                                                    <td>
                                                                                        @if($audio->pdf_source)
                                                                                        <i title="contain pdf"
                                                                                            class="fa fa-file-pdf-o"></i>
                                                                                        @endif
                                                                                        @if($audio->cover_source)
                                                                                        <i title="contain cover logo"
                                                                                            class="fa fa-file-image-o"></i>
                                                                                        @endif
                                                                                        @if($audio->audio_source)
                                                                                        <i title="contain audio"
                                                                                            class="fa fa-file-audio-o"></i>
                                                                                        @endif
                                                                                        @if($audio->active_slide->count()>0)
                                                                                        <i title="contain slide"
                                                                                            class="fa fa-file-powerpoint-o"></i>
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{!!$audio->status_label ?? '-'!!}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="form-group mg-b-30">
                                                                        <div class="form-group">
                                                                            <label for="">Status</label>
                                                                            <p class="panel-footer ft-pn"placeholder="">
                                                                                <big>{!!$channel->status_label!!}</big>
                                                                                {!!$channel->type_label!!}
                                                                                <span class="label label-default {{$channel->edition ? '':'hide'}}">New Edition</span>
                                                                                
                                                                            </p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Link</label>
                                                                            <p>
                                                                                <input title="" class="form-control copy_url" value="{{route('web.channel.show', [$channel->slug])}}" readonly />
                                                                            </p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        @if($channel->parent)
                                                                            <label for="">{{$channel->parent->project?"Project":"User"}}</label>
                                                                            <p class="panel-footer" placeholder="">
                                                                                <a class="btn-link" href="{{$channel->parent->project? route('admin.project.show', $channel->parent->project->project->format_id) : route('admin.user.edit', $channel->parent->user->format_id)}}">{{$channel->parent->project? $channel->parent->project->project->name : $channel->parent->user->name}}</a>
                                                                            </p>
                                                                        @else
                                                                            <label for="">{{@$channel->project?"Project":"User"}}</label>
                                                                            <p class="panel-footer" placeholder="">
                                                                                <a class="btn-link" href="{{$channel->project? route('admin.project.show', $channel->project->project->format_id) : route('admin.user.edit', $channel->user->format_id)}}">{{$channel->project? $channel->project->project->name : $channel->user->name}}</a>
                                                                            </p>
                                                                        @endif
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Category</label>
                                                                            <p class="panel-footer ft-pn"
                                                                                placeholder="">
                                                                            @if($channel->parent)
                                                                                {{@$channel->parent->project ? @$channel->parent->project->project->team->categoryTeam->category->name:'None'}}</p>
                                                                            @elseif($channel->project)
                                                                                {{@$channel->project ? @$channel->project->project->team->categoryTeam->category->name:'None'}}</p>
                                                                            @else
                                                                                {{@$channel->category->name}}</p>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Date</label>
                                                                            <p class="panel-footer ft-pn"
                                                                                placeholder="">
                                                                                Created at <b>{{$channel->created_at->format('d M Y')}}</b><br>
                                                                                Last updated at <b>{{$channel->updated_at->format('d M Y')}}</b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
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

                    <img src="{{get_attachment_source($channel)->slug}}" alt="">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
    <link rel="stylesheet" href="{{ url('css/modals.css') }}">
@endsection

@section('script')
    <!-- chosen JS ============================================ -->
    <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS ============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <script>
        $('body').attr('class', 'mini-navbar');
        $('#sidebar').attr('class', 'active');

        $(".copy_url").click( function() {
            var copyText = $(this);
            copyText.select();
            copyText[0].setSelectionRange(0, 99999);
            document.execCommand("copy");
            $(this).attr('data-original-title', "Copied").tooltip('show');
        });

        var delete_url = '{{ route("admin.channel.delete") }}';
        var redirect_url = '{{ route("admin.channel.index") }}';
        var $delete = $('#delete');
        var data_id = '{{$channel->id}}';
    </script>
    <script src="{{ url('js/data-table/single-delete.js')}}"></script>
@endsection