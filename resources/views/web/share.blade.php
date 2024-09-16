@extends('layouts.web.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="single-pro-review-area mt-t-30 mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mg-t-10">
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="{{url('img/courses/1.jpg')}}" alt="" class="cropper-hidden mg-10">
                                </div>
                                <div class="col-lg-9">
                                    <p class="title mg-0">Free Background Music - Lince - Nostalgia <br>
                                        <a href="{{url('trending')}}?cat=Motivation"><small style="font-size: small;">Motivation</small></a>
                                    </p>
                                    <div class="courses-alaltic mg-t-10">
                                        <span>2 hari yang lalu</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mg-t-10">
                                            <a class="btn btn-default btn-sm" href="#"><i class="fa fa-heart-o"></i> SUKA</a>
                                            <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-share-square-o"></i> BAGIKAN</a>
                                        </div>
                                        <div class="col-lg-6 mg-t-10">
                                            <p class="pull-right">
                                                <small class="mg-10"> <i class="fa fa-play"></i> 123</small>
                                                <small class="mg-10"> <i class="fa fa-heart"></i> 298</small>
                                                <small class="mg-10"> <i class="fa fa-retweet"></i> 270</small>
                                                <small class="mg-10"> <i class="fa fa-comments"></i> 54</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="image-crop">
                                
                                <div class="clearfix"></div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                        <div class="profile-hdtc mg-t-10 text-center">
                                            <a href="{{url('channel')}}"> 
                                                <img class="message-avatar round-img" src="{{url('img/contact/1.jpg')}}" alt="">
                                            </a>
                                        </div>
                                        <br>
                                        <div class="profile-hdtc text-center">
                                            <a class="btn btn-danger btn-xs" href="#"> BERLANGANAN</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 mg-t-15">
                                        <strong class="message-author mg-t-15""> Justin T </strong>
                                        <div class="message-content description">
                                            <p>
                                                Free Background Music No Copyright Music – Liam & Vince - Nostalgia
                                                <br>
                                                Free Download – .com
                                                <br>
                                                ----------------------------------------------------------------------------------------------------------------------<br>
                                                CREDIT:<br>
                                                If you want to use this track for your video, you MUST copy and paste to your description:<br>
                                                    <br>
                                                FreeBackgroundMusic<br>
                                                Liam & Vince – Nostalgia<br>
                                            </p>
                                            <p>
                                                ----------------------------------------------------------------------------------------------------------------------<br>
                                                Any YouTube user including their monetised content can use Free Background Music.<br>
                                                <br>
                                                FreeBackgroundMusic
                                                <br>
                                                Website - www.<br>
                                                YouTube - www.<br>
                                                SoundCloud - @music<br>
                                                Facebook - www<br>
                                                Twitter - www<br>
                                                <br>
                                                Liam & Vince<br>
                                                <br>
                                                Facebook - www<br>
                                                YouTube - www<br>
                                                <br>
                                                FreeBackgroundMusic is a record label which is based on providing FREE BACKGROUND MUSIC and no copyright music for video creators on YouTube.
                                                Any YouTube user including their monetised content can use Free Background Music.<br>
                                                <br>
                                            </p>
                                            <p>
                                                ----Photo created by carloyuen Provided by .com ----
                                            </p>
                                            <a id="shower" class="show-more" href="#">LIHAT SEMUA</a>
                                            <a id="hider" class="show-more" href="#">LIHAT SEDIKIT</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="hpanel">
                                <div class="mg-0">
                                    @if(app('request')->input('playlist'))
                                    <div>
                                        <div class="well">
                                            <p>
                                                <a class="btn btn-inverse pull-right" type="button" data-toggle="collapse" data-target="#collapsePlaylist" aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <strong>Daftar audio</strong><br>
                                            </p>
                                            <hr>
                                            <div class="collapse in" id="" style="height: 400px;overflow: scroll;">
                                                <div class="">
                                                @for($i=0;$i<10;$i++)
                                                    <div class="col-lg-12 mg-t-10">
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mg-0">
                                                            @if($i==0)
                                                            <i class="fa fa-play"></i>
                                                            @else
                                                            {{$i}}
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="courses-title">
                                                                <a href="#"><img src="{{url('img/courses/1.jpg')}}" alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mg-0-0">
                                                            <h5 style="margin:0px;"><a href="#">Apps Development</a></h5>
                                                            <div class="courses-alaltic">
                                                                <a href="/channel"><small class="course-icon">Channel Name</small></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    @else
                                    <div class="solo">
                                        <strong>Kategori yang sama</strong><br>
                                        <div class="m-t-xl widget-cl-1">
                                            @for($i=0;$i<2;$i++)
                                                <div class="row mg-t-10">
                                                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                                        <div class="courses-title">
                                                            <a href="#"><img src="{{url('img/courses/1.jpg')}}" alt=""></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 mg-0-0">
                                                        <h5 class="mg-t-10"><a href="#">Apps Development</a></h5>
                                                        <div class="courses-alaltic">
                                                        <a href="/channel"><small class="course-icon">Channel Name <i class="fa fa-check-circle"></i></small></a>
                                                        </div>
                                                        <div class="courses-alaltic">
                                                            <small>123 diputar</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hpanel widget-int-shape responsive-mg-b-30">
                                <div class="panel-body">
                                    <div class="stats-title pull-left">
                                        <h5>Rekommendasi</h5>
                                    </div>
                                    <div class="m-t-xl widget-cl-1">
                                        <div class="container-fluid">
                                            <div class="row">
                                                @for($i=0;$i<4;$i++)
                                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 video-list-vertical">
                                                    <div >
                                                        <div class="courses-title">
                                                            <a href="/listen"><img src="{{url('img/courses/1.jpg')}}" alt=""></a>
                                                        </div>
                                                        <h5 class="mg-t-10">
                                                            <a href="/listen">
                                                                <div class="row">
                                                                    <div class="col-lg-4 pd-l-15">
                                                                        <img class="message-avatar round-img" style="width: 36px;" src="{{url('img/contact/1.jpg')}}" alt="">
                                                                    </div>
                                                                    <div class="col-lg-8 title-audio">
                                                                        10 Logo Design Trends to Expect in 2020
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </h5>
                                                        <div class="courses-alaltic">
                                                        <a href="/channel">
                                                            <small class="course-icon">Channel Name <i class="fa fa-check-circle"></i></small></a>
                                                        </div>
                                                        <div class="courses-alaltic">
                                                            <small>123 diputars</small>
                                                            <small class="course-icon">-</small>
                                                            <small>2 hari yang lalu</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endfor
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
<div id="add" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div >
                <div class="modal-close-area modal-close-df">
                    <a class="close" style="background: black;" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="mg-10">
                
                <div class="blog-details blog-sig-details">
                    <ul id="myTabedu1" class="tab-review-design" style="border-bottom:solid 1px #ddd;">
                        <li class="active"><a href="#home"><small>BAGIKAN</small></a></li>
                        <li><a href="#audio"><small> EMBED</small></a></li>
                        <li><a href="#email"><small> KIRIM</small></a></li>
                    </ul>
                </div>
                <div id="myTabContent" class="tab-content custom-product-edit">
                    <div class="product-tab-list tab-pane fade active in" id="home">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pro-ad">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <img src="{{url('img/cropper/1.jpg')}}" alt=""  >
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                            
                                            <h5 class="mg-t-10"><a href="#">Apps Development</a></h5>
                                            <div class="courses-alaltic">
                                            <a href="/channel"><small class="course-icon">Channel Name <i class="fa fa-check-circle"></i></small></a>
                                            </div>
                                            <div class="courses-alaltic">
                                                <small>123 diputar</small>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
                                            <label for="">Share</label>
                                            <a class="btn btn-default"><i class="fa fa-google"></i> </a>
                                            <a class="btn btn-default"><i class="fa fa-facebook"></i> </a>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
                                            <input style="width:100%;" onClick="this.setSelectionRange(0, this.value.length)" readonly type="text" value="{{url('share/audio')}}">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="product-tab-list tab-pane fade" id="audio">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pro-ad">
                                    <form action="#" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
                                                <label for="">Embed Code</label>
                                                <input style="width:100%;" onClick="this.setSelectionRange(0, this.value.length)" readonly="readonly" type="text" value='<iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" src="https://pankord.com/player/?url=https%3A//api.pankord.com/tracks/718330027&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>'>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="product-tab-list tab-pane fade" id="email">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pro-ad">
                                    <form action="#" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                                
                                                <div class="form-group">
                                                    <label for="">Comment</label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Ke</label>
                                                    <input class="form-control" type="text" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tulis pesan</label>
                                                    <textarea class="form-control" name="" id="" cols="30" rows="10">{{url('share/audio')}}</textarea>
                                                </div>
                                                <div class="form-group pull-right">
                                                    <input class="btn btn-default" type="button" value="KIRIM">
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
@endsection

@section('style')
<link rel="stylesheet" href="{{ url('css/modals.css') }}">
@endsection

@section('script')
<script>
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
    $('.logo-nav-bar img').attr('class', 'active');

    paragraphCount = $(".description > p").size();

    $("#hider").hide();
    $("#shower").hide();

    if (paragraphCount > 1) {
        $("#shower").show();
    }
        
    $( "#hider" ).click(function() {
        $(".description p").not(":first").hide();
        $("#hider").hide();
        $("#shower").show();
    });
        
    $( "#shower" ).click(function() {
        $(".description p").show();
        $("#shower").hide();
        $("#hider").show();
    });

    $(".description p").not(":first").hide();
</script>
@endsection