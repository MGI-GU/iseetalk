<div class="blog-image">
    <div class="form-group">
        <h3>Project ID : {{$audit->project->id}}</h3>
        <h4>{{$audit->project->name}}</h4>
    </div>
</div>
<div class="blog-details blog-sig-details mg-t-30">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
            <div class="row">
                <div class="col-lg-8 col-md-9 col-sm-9 col-xs-12">
                    <ul id="myTabedu1" class="tab-review-design" >
                        <li class="active"><a href="#home"><small>Detail</small></a></li>
                        <li><a href="#channel"><small>Channel</small></a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12 text-right hide">
                    <a href="#" data-toggle="modal" data-target="#suspend" class="btn btn-danger">SUSPEND</a>
                    @if($audit->status!='approve')
                    {!!Form::open()->put()->route('admin.audit.update', [$audit->id])->id('data')->attrs(['style' => 'float:left;'])!!}
                        <button type="submit" class="btn btn-success">APPROVE</button>
                    {!! Form::close() !!}
                    @endif
                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#"><i class="fa fa-trash"></i> DELETE</a></li>
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
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <div class="form-group">
                                        <label for="">Team</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{$audit->project->team->name}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Leader</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{$audit->project->team->leader_name}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Member</label>
                                        <ol style="margin-left: 15px;">
                                            @foreach($audit->project->team->rolemember as $member)
                                                <li>{{$member->user->name}} <span class="label label-default">{{$member->role_name}}</span></li>
                                            @endforeach
                                        </ol>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{$audit->project->description}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group mg-b-30">
                                        <label>Project Link</label>
                                        <p><a href="{{route('admin.project.show', $audit->project->id)}}">{{route('admin.project.show', $audit->project->id)}}</a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{get_status($audit)}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Category</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{get_category($audit->project)}}</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="product-tab-list tab-pane fade" id="channel">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4">List Channel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($audit->project->channelProject as $key => $channel)
                                <tr>
                                    <td>{{$channel->project_id}}</td>
                                    <td><a href="{{route('admin.channel.show', [$channel->channel->id])}}">{{$channel->channel->name}}</a></td>
                                    <td>{{$channel->channel->audios->count()}}</td>
                                    <td>{!!$channel->channel->status_label!!}</td>
                                    <td>
                                        <a href="{{route('admin.channel.edit', [$channel->channel->id])}}"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
