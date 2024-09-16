@extends('layouts.admin.main')

@section('content')
    <div class="widgets-programs-area mg-t-60">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hpanel widget-int-shape responsive-mg-b-30">
                        <div class="panel-body">
                            <div class="stats-title pull-left">
                                <h2>Overview</h2>
                            </div>
                            <div class="clearfix"></div>
                            <div class="m-t-s widget-cl-1">
                                <div class="container-fluid">
                                    <div class="row">
                                       
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box">
                                                <h4 class="text-left">User</h4>
                                                <div class="mg-t-15 text-left">
                                                    <p>Total User</p>
                                                    <h1>{{count_user()}}</h1>
                                                </div>
                                                <hr>
                                                <div class="mg-t-15 text-left">
                                                    <h3><a href="{{route('admin.user.index')}}">VIEW DETAILS</a></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box">
                                                <h4 class="text-left">Creator</h4>
                                                <div class="mg-t-15 text-left">
                                                    <p>Total creator</p>
                                                    <h1>{{count_broadcaster()}}</h1>
                                                </div>
                                                <hr>
                                                <div class="mg-t-15 text-left">
                                                    <h3><a href="{{route('admin.user.index')}}">VIEW DETAILS</a></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box">
                                                <h4 class="text-left">Active User</h4>
                                                <div class="mg-t-15 text-left">
                                                    <p>Total Active User</p>
                                                    <h1>{{count_active_user()}}</h1>
                                                </div>
                                                <hr>
                                                <div class="mg-t-15 text-left">
                                                    <a href="#"><small>Daily</small></a>
                                                    <a href="#"><small>Monthly</small></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 video-list-vertical">
                                            <div class="box white-box">
                                                <h4 class="text-left">Statistic</h4>
                                                <div id="axis-chart">
                                                    <canvas id="linechartmultiaxis"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box">
                                                <h4 class="text-left">Channel</h4>
                                                <div class="mg-t-15 text-left">
                                                    <h1>{{count_channel()}}</h1>
                                                </div>
                                                <hr>
                                                <div class="mg-t-15 text-left">
                                                    <h3><a href="{{route('admin.channel.index')}}">View Details</a></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box">
                                                <h4 class="text-left">Audios</h4>
                                                <div class="mg-t-15 text-left">
                                                    <h1>{{count_audio()}}</h1>
                                                </div>
                                                <hr>
                                                <div class="mg-t-15 text-left">
                                                    <h3><a href="{{route('admin.audio.index')}}">View Details</a></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box">
                                                <h4 class="text-left">Uploaded</h4>
                                                <div class="mg-t-15 text-left">
                                                    <h1>{{count_upload()}}</h1>
                                                </div>
                                                <hr>
                                                <div class="mg-t-15 text-left">
                                                    <h3><a href="{{route('admin.attachment.index')}}">View Details</a></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box">
                                                <h4 class="text-left">Share</h4>
                                                <div class="mg-t-15 text-left">
                                                    <h1>{{count_share()}}</h1>
                                                </div>
                                                <hr>
                                                <div class="mg-t-15 text-left">
                                                    <h3><a href="{{route('admin.share.index')}}">View Details</a></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box">
                                                <h4 class="text-left">Comment</h4>
                                                <div class="mg-t-15 text-left">
                                                    <h1>{{count_comment()}}</h1>
                                                </div>
                                                <hr>
                                                <div class="mg-t-15 text-left">
                                                    <h3><a href="{{route('admin.comment.index')}}">View Details</a></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box">
                                                <h4 class="text-left">Avarage Time</h4>
                                                <div class="mg-t-15 text-left">
                                                    <h1>14</h1>
                                                </div>
                                                <hr>
                                                <div class="mg-t-15 text-left">
                                                    <h3><a href="#">LIHAT RINCIAN</a></h3>
                                                </div>
                                            </div>
                                        </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hpanel widget-int-shape responsive-mg-b-30">
                        <div class="panel-body">
                            <div class="stats-title pull-left">
                                <h2>Content</h2>
                            </div>
                            <div class="clearfix"></div>
                            <div class="m-t-s widget-cl-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box res-mg-t-30 table-mg-t-pro-n">
                                                <h4 class="box-title text-left">Channel</h4>
                                                <hr>
                                                
                                                <ul class="country-state text-left">
                                                    @foreach(top_channel() as $data)
                                                        <li>
                                                            <h5><span class="counter"> {{@$data->audio->channel->name}} </span></h5> <a href="#"><small>{{@$data->audio->user->name}}</small></a>
                                                            <div class="pull-right"> <i class="fa fa-level-up text-success ctn-ic-3"></i></div>
                                                        </li>
                                                    @endforeach
                                                    <!-- <li>
                                                        <h5><span class="counter">Mengatur keuangan</span></h5> <a href="#"><small>Mentri Keuangan</small></a>
                                                        <div class="pull-right"> <i class="fa fa-level-down text-danger ctn-ic-4"></i></div>
                                                    </li> -->
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box res-mg-t-30 table-mg-t-pro-n">
                                                <h4 class="box-title text-left">Audio</h4>
                                                <ul id="myTabedu1" class="tab-review-design small-tab">
                                                    <li class="active"><a style="padding: 0 10px;" href="#played">Played</a></li>
                                                    <li><a href="#liked" style="padding: 0 10px;"> Liked</a></li>
                                                    <li><a href="#commented" style="padding: 0 10px;"> Comment</a></li>
                                                    <li><a href="#shared" style="padding: 0 10px;"> Sharing</a></li>
                                                </ul>
                                                <hr>
                                                <div id="myTabContent" class="tab-content custom-product-edit">

                                                    <div class="product-tab-list tab-pane fade active in" id="played">
                                                        <ul class="country-state text-left">
                                                            @foreach(top_audio('play') as $audio)
                                                                @if(@$audio->audio)
                                                                <li>
                                                                    <h5><span class="counter">{{@$audio->audio->name ?? ''}} </span></h5> <a href="#"><small>{{@$audio->user->name ?? ''}}</small></a>
                                                                    <div class="pull-right"> <i class="fa fa-level-up text-success ctn-ic-3"></i></div>
                                                                </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="product-tab-list tab-pane fade " id="liked">
                                                        <ul class="country-state text-left">
                                                            @foreach(top_audio('like') as $audio)
                                                                @if(@$audio->audio)
                                                                <li>
                                                                    <h5><span class="counter">{{@$audio->audio->name}} </span></h5> <a href="#"><small>{{@$audio->audio->user->name}}</small></a>
                                                                    <div class="pull-right"> <i class="fa fa-level-up text-success ctn-ic-3"></i></div>
                                                                </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="product-tab-list tab-pane fade " id="commented">
                                                        <ul class="country-state text-left">
                                                            @foreach(top_audio('comment') as $comment)
                                                                @if(@$comment->audio)
                                                                <li>
                                                                    <h5><span class="counter">{{@$comment->audio->name}} </span></h5> <a href="#"><small>{{@$comment->audio->user->name}}</small></a>
                                                                    <div class="pull-right"> <i class="fa fa-level-up text-success ctn-ic-3"></i></div>
                                                                </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="product-tab-list tab-pane fade " id="shared">
                                                        <ul class="country-state text-left">
                                                            @foreach(top_audio('share') as $share)
                                                                @if(@$share && @$share->audio)
                                                                <li>
                                                                    <h5><span class="counter">{{@$share->audio->name}} </span></h5> <a href="#"><small>{{@$share->audio->user->name}}</small></a>
                                                                    <div class="pull-right"> <i class="fa fa-level-up text-success ctn-ic-3"></i></div>
                                                                </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 video-list-vertical">
                                            <div class="box white-box res-mg-t-30 table-mg-t-pro-n">
                                                <h4 class="box-title text-left">Categori</h4>
                                                <hr>
                                                <ul class="country-state text-left">
                                                    @foreach(top_channel() as $data)
                                                        @if(@$data->audio->category)
                                                        <li>
                                                            <h5><span class="counter"> {{@$data->audio->category->name}} </span></h5> <a href="#"><small>{{@$data->audio->user->name}}</small></a>
                                                            <div class="pull-right"> <i class="fa fa-level-up text-success ctn-ic-3"></i></div>
                                                        </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
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

    <!-- Charts JS
		============================================ -->
    <script src="{{ url('js/charts/Chart.js')}}"></script>
    <script>
        $.ajax({
            url: "{{route('admin.analytic', 'dashboard')}}",
            type: 'get'
        }).done(function(data){
            console.log(data.data);
            var ctx = document.getElementById("linechartmultiaxis");
            var linechartmultiaxis = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.data.periode,
                    datasets: [{
                        label: "Pages View",
                        fill: false,
                        backgroundColor: '#006DF0',
                        borderColor: '#006DF0',
                        data: data.data.pageview,
                    },{
                        label: "Sessions",
                        fill: false,
                        backgroundColor: '#933EC5',
                        borderColor: '#933EC5',
                        data: data.data.sessions,
                    },{
                        label: "Users",
                        fill: false,
                        backgroundColor: '#fa2d00',
                        borderColor: '#fa2d00',
                        data: data.data.user,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }
                        }]
                    }
                }
            });
        }).error(function(){
            console.log('view count failed')            
        });
    </script>
    
@endsection