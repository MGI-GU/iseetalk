@extends('layouts.studio.main')

@section('content')
<div id="app" class="container-fluid">
    <div class="row">
        <div class="latest-blog-single blog-single-full-view">
            <div class="blog-details blog-sig-details">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <ul id="myTabedu1" class="tab-review-design" >
                                    <li ><a href="{{route('studio.analytic')}}"><small>Channel</small></a></li>
                                    <li class="active"><a href="{{route('studio.analytic.audio.list')}}"><small> Audioslide</small></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="myTabContent" class="tab-content custom-product-edit">
                    <div class="product-tab-list tab-pane fade active in" id="channel">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pro-ad mg-t-15">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="single-pro-review-area mt-t-15 mg-b-15 white-box">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="sparkline-area">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        {!!Form::select('audio', 'Audioslide', get_user_audios('pluck')->toArray(), $audio->id)!!}
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                                        <div class="container-fluid">
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                    <div class="box res-mg-t-30 table-mg-t-pro-n white-box">
                                                                                        <b class="box-title text-left">Total View</b>
                                                                                        <hr>
                                                                                        {{$audio->play_number}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                    <div class="box res-mg-t-30 table-mg-t-pro-n white-box">
                                                                                        <b class="box-title text-left">Total Comment</b>
                                                                                        <hr>
                                                                                        <div id="myTabContent" class="tab-content custom-product-edit">

                                                                                        {{$audio->comment_number}}

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                    <div class="box res-mg-t-30 table-mg-t-pro-n white-box">
                                                                                        <b class="box-title text-left">Total Like</b>
                                                                                        <hr>
                                                                                        <div id="myTabContent" class="tab-content custom-product-edit">

                                                                                        {{$audio->like_number}}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                    <div class="box res-mg-t-30 table-mg-t-pro-n white-box">
                                                                                        <b class="box-title text-left">Total Share</b>
                                                                                        <hr>
                                                                                        <div id="myTabContent" class="tab-content custom-product-edit">

                                                                                        {{$audio->share_number}}

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                                        <div class="box">
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                    <div id="axis-chart">
                                                                                        <canvas id="linechartmultiaxis"></canvas>
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

@section('style')
    <link rel="stylesheet" href="{{ url('css/editor/select2.css')}}">
@endsection

@section('script')
    <script src="{{ url('js/charts/Chart.js')}}"></script>
    <script>
        $.ajax({
            url: window.location.href,
            type: 'get'
        }).done(function(data){
			var ctx = document.getElementById("linechartmultiaxis");
            var linechartmultiaxis = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.data.label,
                    datasets: [{
                        label: "Reach",
                        fill: false,
                        backgroundColor: '#006DF0',
                        borderColor: '#006DF0',
                        data: data.data.reach
                    }, {
                        label: "Enagement",
                        fill: false,
                        backgroundColor: '#933EC5',
                        borderColor: '#933EC5',
                        data: data.data.enagement
                        
                    },{
                        label: "Audiance",
                        fill: false,
                        backgroundColor: '#fa2d00',
                        borderColor: '#fa2d00',
                        data: data.data.audiance
                        
                    }]
                },
                options: {
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    title:{
                        display: true,
                        text:''
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                        }],
                        yAxes: [{
                            display: true,
                        }]
                    }
                }
            });
        }).error(function(){
            console.log('view count failed')            
        });
        

        $(function(){
            // bind change event to select
            $('#inp-audio').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location = "{{route('studio.analytic.audio.list')}}?audio="+url; // redirect
                }
                return false;
            });
        });
    </script>
    
@endsection