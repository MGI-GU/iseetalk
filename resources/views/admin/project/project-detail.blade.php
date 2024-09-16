@extends('layouts.admin.main')

@section('content')
<div class="blog-details-area mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="blog-details-inner white-box mg-t-30">
                    <div class="row">
                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
                            <div class="mg-t-10">
                                <div class="blog-image border pd-10">
                                    <h3>Project ID : {{$project->format_id}}</h3>
                                    <p>
                                        <span>Created at {{$project->created_at->format('d M Y')}}</span> 
                                        @if($project->team)
                                            <br>Manage by <ahref="{{route('admin.team.show', [$project->team->format_id])}}">{{$project->team->name}}</a> Team
                                        @endif
                                    </p>    
                                </div>  
                            </div>
                        </div>
                        <div class="col-lg-offset-1 col-lg-8 col-md-10 col-sm-10 col-xs-10">
                            <div class="latest-blog-single blog-single-full-view">
                                <div class="blog-details blog-sig-details">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
                                            style="border-bottom:solid 1px #ddd;">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <ul id="myTabedu1" class="tab-review-design">
                                                        <li class="active"><a href="#home"><small>Detail</small></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
                                                    <a href="{{ URL::previous() }}" class="btn btn-inverse"> BACK</a>
                                                    @if($project->status=='approve' && is_leader(auth()->getUser()) !== 'false')
                                                    <a href="{{route('admin.channel.add', ['project'=>$project->id])}}"
                                                        class="btn btn-success">ADD CHANNEL</a>
                                                    @endif
                                                    @if(is_admin(auth()->getUser()) !== 'false' && $project->status=='review')
                                                    <a href="{{route('admin.project.update.status', [$project->id, 'approve'])}}" class="btn btn-success">APPROVE</a>
                                                    <a href="{{route('admin.project.update.status', [$project->id, 'reject'])}}" class="btn btn-danger">REJECT</a>
                                                    @endif
                                                    @if(is_leader(auth()->getUser()) !== 'false' && ($project->status=='draft' || $project->status=='reject'))
                                                    <a href="{{route('admin.project.update.status', [$project->id, 'submit'])}}" class="btn btn-success">SUBMIT</a>
                                                    @endif
                                                    <a href="{{route('admin.project.edit', [$project->id])}}"
                                                        class="btn btn-primary">EDIT</a>
                                                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i
                                                            class="fa fa-ellipsis-v"></i></a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="#" id="delete"><i class="fa fa-trash"></i> DELETE</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="home">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="pro-ad">
                                                        <form action="#" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                                    <div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                            
                                                                            <div class="form-group">
                                                                                <label for="">Project Name</label>
                                                                                <p class="panel-footer ft-pn"
                                                                                    placeholder="">{{$project->name}}
                                                                                </p>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">Category</label>
                                                                                <p class="panel-footer ft-pn">
                                                                                    {{@$project->team->categoryTeam->category->name ?? 'None'}}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="">Status</label>
                                                                                <p class="panel-footer ft-pn">
                                                                                    <big>{!!$project->status_label!!}</big>
                                                                                </p>
                                                                            </div>
                                                                            @if($project->team)
                                                                            <div class="form-group">
                                                                                <label for="">Leader</label>
                                                                                <p class="panel-footer ft-pn"
                                                                                    placeholder="">
                                                                                    {{$project->team->leader_name}}
                                                                                    (<a href="{{route('admin.team.show', [$project->team->format_id])}}">{{$project->team->name}}</a>)</p>
                                                                            </div>
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Description</label>
                                                                        <p class="panel-footer ft-pn" placeholder="">
                                                                            {{$project->description}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">List channel</label>
                                                                        <p class="ft-pn" placeholder="">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ID</th>
                                                                                    <th>Name channel</th>
                                                                                    <th>No. Audio</th>
                                                                                    <th>Status</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($project->channelProject as $channel)
                                                                                @if($channel->channel)
                                                                                <tr>
                                                                                    <td><a class="btn-link"
                                                                                            href="{{route('admin.channel.show', [$channel->channel->format_id ?? ''])}}">{{@$channel->channel->format_id}}</a>
                                                                                    </td>
                                                                                    <td>{{@$channel->channel->name}}
                                                                                    </td>
                                                                                    <td>{{$channel->channel ? $channel->channel->audios->count() : '0'}}
                                                                                    </td>
                                                                                    <td>{!!@$channel->channel->status_label!!}
                                                                                    </td>
                                                                                </tr>
                                                                                @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        </p>
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

                    <img src="{{url('img/courses/1.jpg')}}" alt="">

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
        var delete_url = '{{ route("admin.project.delete") }}';
        var redirect_url = '{{ route("admin.project.index") }}';
        var $delete = $('#delete');
        var data_id = '{{$project->id}}';
    </script>
    <script src="{{ url('js/data-table/single-delete.js')}}"></script>
    @endsection