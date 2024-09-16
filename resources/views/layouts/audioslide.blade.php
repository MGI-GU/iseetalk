<div id="audio-slideshow" class="audio-slideshow pd-10" data-audio="{{get_audio_source($audio->audio_source ? $audio: ($audio->parent? $audio->parent:$audio))}}" data-audio-duration="{{$audio->duration}}">
    <div id="loading">
        <div data-v-46b21138="" class="infinite-loading-container"><div data-v-46b21138="" class="infinite-status-prompt" style="color: rgb(102, 102, 102); font-size: 14px; padding: 10px 0px;"><i data-v-46b20d22="" data-v-46b21138="" class="loading-default"></i></div> <div data-v-46b21138="" class="infinite-status-prompt" style="display: none;"><div data-v-46b21138="">-</div></div> <div data-v-46b21138="" class="infinite-status-prompt" style="display: none;"><div data-v-46b21138=""></div></div> <div data-v-46b21138="" class="infinite-status-prompt" style="color: rgb(102, 102, 102); font-size: 14px; padding: 10px 0px; display: none;"></div></div>
    </div>
    <div class="row">
        <div class="col-lg-offset-1 col-lg-11">
            <div class="audio-slides" style="display: none;">
                @foreach( get_attachment_source($audio, 'slide') as $key => $image)
                    @for($i=$image->time_show;$i<=$image->time_end;$i++)
                        @if($i==0)
                        <img src="{{ get_image_slide($image) }}" alt="1" data-thumbnail="{{ get_image_slide($image) }}" data-slide-time="1">
                        @else
                        <img src="{{ get_image_slide($image) }}" alt="{{$i}}" data-thumbnail="{{ get_image_slide($image) }}" data-slide-time="{{$i}}">
                        @endif
                    @endfor
                @endforeach
            </div> 
        </div>
    </div>
    <div class="audio-control-interface control-bg pd-10">
        <div class="row">
            <div class="col-lg-offset-0 col-lg-12">
                <div class="timeline">
                    <div class="timeline-controls"></div>
                    <div class="seekbar">
                        <div class="playhead"></div>
                    </div>
                </div>
                <div class="jplayer"></div>
            </div>
            <div class="col-lg-offset-1 col-lg-3 col-sm-1 col-xs-1">
                <div class="row">
                    <div class="col-lg-3">
                        <a href="javascript:;" class="btn audio-play" tabindex="1"><i class="fa fa-play"></i></a>
                        <a href="javascript:;" class="btn audio-pause" tabindex="1"><i class="fa fa-pause"></i></a>
                    </div>
                    <div class="col-lg-2">
                        <a href="javascript:;" class="btn jp-mute" tabindex="1" title="mute"><i class="fa fa-volume-off"></i></a>
                    </div>
                    <div class="col-lg-6">
                        <div class="jp-volume-slider" style="margin-top:14px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="time-container btn">
                    <span class="play-time"></span> / <span class="total-time"></span>
                </div>
                <div class="btn" style="float:right;">
                    <a href="javascript:;" class="full-screen" tabindex="1"><i class="fa fa-square-o"></i></a>
                </div>
            </div>
        </div>
    </div>
    <audio id="audio" controls style="width: 100%;background: #f1f3f4;display:none;">
        <source src="{{get_audio_source($audio->audio_source ? $audio: ($audio->parent? $audio->parent:$audio))}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
</div>