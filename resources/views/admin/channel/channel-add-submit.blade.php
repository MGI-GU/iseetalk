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
                            <a class="btn back-btn" href="{{route('admin.project.index')}}"><i class="fa fa-angle-left"></i></a>
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#3">Pratinjau</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                            @if(is_leader(auth()->user())!='false' && $channel->status!='')
                            <a href="{{route('admin.channel.edit', [$channel->id])}}" class="btn btn-primary">EDIT</a>
                            <!-- <a href="#" data-toggle="modal" data-target="#suspend" class="btn btn-danger">DELETE</a> -->
                                @if($channel->parent)
                                    <a href="{{route('admin.channel.update.status', [$channel->id, 'reset'])}}" class="btn btn-default">RESET</a>
                                @endif
                            @endif
                            @if(check_account('admin'))
                            <a href="{{route('admin.channel.update.status', [$channel->id, 'approve'])}}" class="btn btn-success">APPROVE</a>
                            <a href="{{route('admin.channel.update.status', [$channel->id, 'reject'])}}" class="btn btn-danger">REJECT</a>
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
                        <div class="product-tab-list tab-pane fade active in" id="3">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="blog-image cover-image image-channel-cover" style="background:url({{get_cover($channel)}});box-shadow: inset 0px 0px 2px 0px black;">
                                        <div class="blog-image"></div>
                                    </div>
                                    <div class="review-content-section">
                                        <div class="pro-ad">
                                            {!!Form::open()->put()->route('admin.channel.update', [$channel->id])->id('approve_form')!!}
                                                {!!Form::hidden('status')->value('review')!!}
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                                        <a href="#" data-toggle="modal" data-target="#thumbnail">
                                                            <img class="border" src="{{get_attachment_source($channel)->slug}}" alt="{{$channel->format_id}}"  >
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="row">
                                                            @if($channel->parent)
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <small for="">Published ID</small>
                                                                    <p class="panel-footer ft-pn">
                                                                        <a class="btn-link" href="{{route('admin.channel.show', [$channel->parent->format_id])}}">{{$channel->parent->format_id}}</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                                <div class="form-group">
                                                                    <small for="">ID</small>
                                                                    <p class="panel-footer ft-pn">
                                                                        {{$channel->format_id}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-6">
                                                                <div class="form-group">
                                                                    <small for="">Project - Team - Leader</small>
                                                                    <p class="panel-footer ft-pn" placeholder="">
                                                                        <a class="btn btn-link" href="{{$channel->project? route('admin.project.show', $channel->project->project->format_id) : route('admin.user.edit', $channel->user->id)}}">{{$channel->project? $channel->project->project->name : $channel->user->name}}</a>
                                                                        @if($channel->project)
                                                                        <a class="btn btn-link" href="{{route('admin.team.show', [$channel->project->project->team->id])}}">{{$channel->project->project->team->name}}</a>
                                                                        <a>{{$channel->project->project->team->leader_name}}</a>
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                <div class="form-group">
                                                                    <small for="">Nama Channel</small>
                                                                    <p class="panel-footer ft-pn" placeholder="">{{$channel->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                <div class="form-group">
                                                                    <small for="">Category</small>
                                                                    <p class="panel-footer ft-pn"placeholder="">
                                                                        {{$channel->project ? $channel->project->project->team->categoryTeam->category->name:'None'}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <small for="">Deskripsi</small>
                                                            <div class="panel-footer ft-pn" placeholder="">{!!$channel->description!!}</div>
                                                            
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
        </div>
    </div>
</div>
<div id="suspend" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-4"></div>
            <div class="modal-body">
                    
                <h4 class="pull-left">Are you sure to delete this channel ?</h4>
                <br>
                {!!Form::open()->delete()->route('admin.channel.delete', [$channel->slug])->id('data')!!}
                    {!!Form::hidden('id')->value($channel->id)!!}
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                            <div class="pull-right">
                                <a class="btn btn-link" data-dismiss="modal" href="#">Cancel</a>
                                <button type="submit" class="btn btn-danger">DELETE</button>
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
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
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
    <script>
        $(".save").click( function() {
            $('#approve_form').submit();
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