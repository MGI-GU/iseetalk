@extends('layouts.web.main')

@section('content')
    <div class="widgets-programs-area mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hpanel widget-int-shape responsive-mg-b-30">
                        <div class="panel-body">
                            <div class="stats-title pull-left">
                                <h4>Langanan</h4>
                            </div>
                            <div class="m-t-xl widget-cl-1">
                                <div class="container-fluid">
                                    @if(get_subscribe_audio_list('all')->count() > 0)
                                        <div id="app" class="row">
                                            <subscription-audios></subscription-audios>
                                        </div>
                                    @else
                                        <center>Belum ada konten yang tersedia</center>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection