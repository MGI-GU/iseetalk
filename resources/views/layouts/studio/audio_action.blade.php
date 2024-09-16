<a href="{{ URL::previous() }}" class="btn btn-inverse">BACK</a>
@if(!$audio->edition)
    <a href="#" class="btn btn-default save">SAVE</a>
    @if($audio->status=='publish')
        <a href="{{route('studio.audio.update.status', [$audio->id, 'revoke'])}}" class="btn btn-default">
            REVOKE
        </a>
        @if($audio->backup)
        <a href="{{route('studio.audio.update.status', [$audio->id, 'reset'])}}" class="btn btn-default">
            RESET
        </a>
        @endif
    @endif
    @if($audio->status!='publish')
        @if($audio->first_slide->count()>0)
        {!!Form::open()->put()->route('studio.audio.update', [$audio->id])->attrs(['id' => 'form', 'style'=>'display: inline-flex;'])!!}
            {!!Form::hidden('type', 'publish')!!}
            <button href="#" type="submit" class="btn btn-success save">
                PUBLISH
            </button>
        {!! Form::close() !!}
        @endif
    @endif
@else
    <a class="btn btn-default" href="{{route('studio.audio.show', $audio->edition->slug)}}">
        <span class="mini-click-non">EDITION</span>
    </a>
@endif
<!-- <a href="#" data-toggle="dropdown" class="btn btn-default dropdown-toggle">ACTION</a> -->
<a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
<ul class="dropdown-menu pull-right">
    <li><a href="#" data-toggle="modal" data-target="#url" class="text-center"> GENERATE URL</a></li>
    <li><a target="_blank" href="{{--route('studio.download', $audio->parent ? $audio->parent->audio_user_source->slug_id:$audio->audio_user_source->slug_id)--}}" class="text-center"> DOWNLOAD AUDIO</a></li>
    <li><a href="#" data-toggle="modal" data-target="#visual" class="text-center"> DOWNLOAD VISUAL</a></li>
    <li><a href="#" data-toggle="modal" data-target="#delete" class=" alert-danger text-center"> DELETE</a></li>
</ul>
<div id="delete" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal label-danger"></div>
            <div class="modal-body">
                <h4 class="pull-left">Are you sure to delete this audio ?</h4>
                <div class="clearfix"></div>
                <p class="text-left">Delete action will remove all files that uploaded in this audio.</p>
                {!!Form::open()->post()->route('studio.audio.delete', [$audio->slug])!!}
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                            <div class="pull-right mg-t-15">
                                <a class="btn btn-default" data-dismiss="modal" href="#">Cancel</a>
                                <button type="submit" class="btn btn-danger waves-effect">DELETE</button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div id="url" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal label-info"></div>
            <div class="modal-body">
                    
                <h4 class="pull-left">URL</h4>
                <div class="clearfix"></div>
                    <table class="table text-left"> 
                        <tr>
                            <td width="100"><img src="{{get_audio_cover($audio)}}" alt=""  ></td>
                            <td>
                                <h5><a href="#">{{$audio->name}}</a></h5>
                                <div class="courses-alaltic">
                                    <a href="#"><small class="course-icon">{{$audio->channel?$audio->channel->name:''}} <i class="fa fa-check-circle"></i></small></a>
                                </div>
                                <div class="courses-alaltic">
                                    <small>{{$audio->play_number}} diputar</small>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input style="width:100%;" onClick="this.setSelectionRange(0, this.value.length)" readonly type="text" value="{{route('web.listen', [$audio->slug ?? '0'])}}">
                            </td>
                        </tr>

                    </table>

            </div>
        </div>
    </div>
</div>
<div id="visual" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal label-warning"></div>
            <div class="modal-body">
                    
                <h4 class="pull-left">Comming Soon</h4>
                <div class="clearfix"></div>

            </div>
        </div>
    </div>
</div>