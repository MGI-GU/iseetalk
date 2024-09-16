<div class="blog-details blog-sig-details mg-t-30">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
            <div class="row">
                <div class="col-lg-8 col-md-9 col-sm-9 col-xs-12">
                    <ul id="myTabedu1" class="tab-review-design" >
                        <li class="active"><a href="#home"><small>Detail</small></a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12 text-right display-flex" style="justify-content: flex-end;">
                    <a href="#" data-toggle="modal" data-target="#suspend" class="btn btn-danger mg-r-5">REJECT</a>
                    @if($audit->status!='approve' && $audit->channel->status=='approve')
                    {!!Form::open()->put()->route('admin.audit.update', [$audit->id])->id('data')->attrs(['style' => 'float:left;'])!!}
                        <button type="submit" class="btn btn-success">APPROVE</button>
                    {!! Form::close() !!}
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
                        <form action="#" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{$audit->channel->name}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <div class="panel-footer ft-pn" placeholder="">{!!$audit->channel->description!!}</div>
                                    </div>
                                    <div class="form-group">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="4">List Audio ({{$audit->channel->parent ? $audit->channel->parent->no_audio:$audit->channel->no_audio}})</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if($audit->channel->parent)
                                                @foreach($audit->channel->parent->audios as $key => $audio)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td><a href="{{route('admin.audio.show', [$audio->format_id])}}">{{$audio->name}}</a></td>
                                                    <td>{!!$audio->status_label!!}</td>
                                                    <td>{{format_time($audio->duration)}}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                @foreach($audit->channel->audios as $key => $audio)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td><a href="{{route('admin.audio.show', [$audio->format_id])}}">{{$audio->name}}</a></td>
                                                    <td>{!!$audio->status_label!!}</td>
                                                    <td>{{format_time($audio->duration)}}</td>
                                                </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Audit Status</label>
                                        <p class="panel-footer ft-pn" placeholder="">
                                            <big>{!!$audit->status_label!!}</big>
                                            @if($audit->status!='draft' && $audit->admin_id != 0)
                                                <small>last updated by</small> <span class="label label-default"> {{$audit->admin->name}} </span>
                                            @endif
                                        </p>
                                        @if($audit->status=='suspend')
                                            <div class="alert alert-danger">
                                                @foreach($audit->notes as $key => $info)
                                                {{$key}} : {{$info}}<br>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Channel Status</label>
                                        <p class="panel-footer ft-pn" placeholder="">
                                            <big><span class="label label-primary">{{get_status($audit->channel)}}</span></big>
                                        </p>
                                    </div>
                                    @if($audit->channel->parent)
                                        <div class="form-group">
                                            <label for="">New Edition for</label>
                                            <input class="form-control copy_url" value="{{route('web.channel.show', [$audit->channel->parent->slug])}}" readonly />
                                        </div>
                                         <div class="form-group">
                                            <label for="">Visibility</label>
                                            <p class="panel-footer ft-pn" placeholder="">{{get_visibility($audit->channel->parent)}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <p class="panel-footer ft-pn" placeholder="">{{@$audit->channel->parent->project ? @$audit->channel->parent->project->project->team->categoryTeam->category->name:'None'}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Team</label>
                                            <p class="panel-footer ft-pn" placeholder="">{{$audit->channel->parent->project ? $audit->channel->parent->project->project->team->name.' - '.$audit->channel->parent->project->project->team->leader_name:'None'}}</p>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="">Channel URL</label>
                                            <input class="form-control copy_url" value="{{route('web.channel.show', [$audit->channel->slug])}}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Visibility</label>
                                            <p class="panel-footer ft-pn" placeholder="">{{get_visibility($channel)}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <p class="panel-footer ft-pn" placeholder="">{{@$audit->channel->project ? @$audit->channel->project->project->team->categoryTeam->category->name:'None'}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Team</label>
                                            <p class="panel-footer ft-pn" placeholder="">{{$audit->channel->project ? $audit->channel->project->project->team->name.' - '.$audit->channel->project->project->team->leader_name:'None'}}</p>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="">Last Updated At</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{$audit->updated_at->format('d M Y')}}</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @if($audit->logs->count()>0)
                                <div class="form-group">
                                    <label>Audit Logs</label>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Approver</th>
                                                <th>Audit Status</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($audit->logs as $log)
                                            <tr>
                                                <td>{{$log->created_at ?? '-'}}</td>
                                                <td>{{$log->admin->name}}</td>
                                                <td><span class="{{$log->status=='approve'?'label-success':'label-danger'}}">{{$log->status}}</span></td>
                                                <td>{{$log->noted}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <label>No log data</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>