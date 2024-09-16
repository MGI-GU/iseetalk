<div class="blog-image">
    @include('layouts.audioslide')

    <!-- <audio controls style="width: 100%;background: #f1f3f4;">
        <source src="{{get_audio_source($audio)}}" type="audio/mpeg" autoplay>
        Your browser does not support the audio element.
    </audio> -->
    <div class="clearfix"></div>
    <hr>
</div>
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
                    @if($audit->status!='approve')
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
                                        <label for="">Title</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{$audit->audio->name}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <div class="panel-footer ft-pn" placeholder="">{!!$audit->audio->description!!}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tags</label>
                                        <p class="panel-footer ft-pn" placeholder="">{!! get_tag_link(@$audit->audio->tags) !!}</p>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="">Comments</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{audio_setting_comment($audit->audio) }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label> Visitor can view audio ratings</label><br>
                                        <p class="panel-footer ft-pn" placeholder="">{{audio_setting_rate($audit->audio)}}</p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label> Notif to Subscriber</label><br>
                                        <p class="panel-footer ft-pn" placeholder="">{{audio_setting_notification($audit->audio)}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label> Age restriction</label><br>
                                        <p class="panel-footer ft-pn" placeholder="">{{audio_setting_age($audit->audio)}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Audit Status</label>
                                        <p class="panel-footer ft-pn" placeholder="">
                                            {!!$audit->status_label!!}
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
                                        <label for="">Audioslide Status</label>
                                        <p class="panel-footer ft-pn" placeholder="">
                                            <span class="label label-primary">{{get_status($audit->audio)}}</span>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Audioslide URL</label>
                                        <input class="form-control copy_url" value="{{route('web.listen', [$audio->slug])}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Channel URL</label>
                                        <input class="form-control copy_url" value="{{route('web.channel.show', [$audio->channel->slug ?? 0])}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Visibility</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{get_visibility($audit->audio)}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Channel</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{get_channel_audio($audit->audio)}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Category</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{$audit->audio->category_id ? @$audit->audio->category->name : get_category($audit->audio)}}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Language</label>
                                        <p class="panel-footer ft-pn" placeholder="">{{$audit->audio->language}}</p>
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