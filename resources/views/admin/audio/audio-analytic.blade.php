@extends('layouts.admin.main')

@section('content')
    <div class="blog-details-area mg-t-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box mg-t-30">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="#" data-toggle="modal" data-target="#thumbnail"><img src="{{get_audio_cover($audio)}}" alt=""  ></a>
                                <p class="mg-t-10">
                                    <small>{{$audio->name}}</small>
                                    <a href="{{route('web.listen', [$audio->slug])}}"><small>{{'listen/'.$audio->slug}}</small></a>
                                </p>
                                @include('admin.audio.audio-menu')
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        <h2>Analisa audio</h2>
                                    </div>
                                    <div class="blog-details blog-sig-details mg-t-30">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li class="active"><a href="#home"><small>Overview</small></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="myTabContent" class="tab-content custom-product-edit">
                                            <div class="product-tab-list tab-pane fade active in" id="description">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="box white-box">
                                                                <h4 class="text-left">Jumlah didengar</h4>
                                                                <div class="mg-t-15 text-center">
                                                                    <h1>{{$audio->play_number}}</h1>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="box white-box">
                                                                <h4 class="text-left">Jumlah disuka</h4>
                                                                <div class="mg-t-15 text-center">
                                                                    <h1>{{$audio->like_number}}</h1>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="box white-box">
                                                                <h4 class="text-left">Jumlah Comment</h4>
                                                                <div class="mg-t-15 text-center">
                                                                    <h1>{{$audio->comment_number}}</h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
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
@endsection

@section('style')
<link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
<link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">

@endsection

@section('script')
    <script>
        $('body').attr('class', 'mini-navbar');
        $('#sidebar').attr('class', 'active');
        
    </script>
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
            url: window.location.href,
            type: 'get'
        }).done(function(data){
			console.log(data.data);
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
                        data: data.data.reach,
                    }, {
                        label: "Enagement",
                        fill: false,
                        backgroundColor: '#933EC5',
                        borderColor: '#933EC5',
                        data: data.data.enagement,
                        
                    },{
                        label: "Audiance",
                        fill: false,
                        backgroundColor: '#fa2d00',
                        borderColor: '#fa2d00',
                        data: data.data.audiance,
                        
                    }
                ]
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
    </script>
    
@endsection