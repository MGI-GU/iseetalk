@extends('layouts.admin.main')

@section('content')
    <div id="app" class="blog-details-area mg-t-30">
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
                                        <h2>Comment audio</h2>
                                    </div>
                                    <div class="blog-details blog-sig-details mg-t-30">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li class="active"><a href="#home"><small>{{$audio->comment_number}} Comment</small></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        <a href="{{ URL::previous() }}" class="btn btn-inverse"> BACK</a>
                                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="home">
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="blog-details-inner white-box">
                                                        @if(is_copy_writer(auth()->user())!=='false' || is_leader(auth()->user())!='false')
                                                        <div class="row">
                                                            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                                                <img src="{{get_avatar(auth()->getUser())}}" alt="" />
                                                            </div>
                                                            <div class="coment-area">
                                                                {!!Form::open()->post()->route('admin.comment.store', [$audio->id])->id('data')!!}
                                                                    <div class="row">
                                                                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <textarea name="comment" cols="30" rows="10" placeholder="write comment here"></textarea>
                                                                            </div>
                                                                            <div class="payment-adress comment-stn pull-right">
                                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Comment</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                {!! Form::close() !!}
                                                            
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="comment-head">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="row mg-t-30">
                                                            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                                                <img src="{{url('img/contact/1.jpg')}}" alt="" />
                                                            </div>
                                                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                                <div class="">
                                                                    <div class="comment-details">
                                                                        <h4>Jonathan Doe 2015 15 July </h4>
                                                                        <p>Shabby chic selfies pickled Tumblr letterpress iPhone. Wolf vegan retro selvage literally <span class="mobile-sm-d-n">Wes Anderson ethical four loko. Meggings blog chambray tofu pour-over. Pour-over Tumblr keffiyeh, cornhole whatever cardigan Tonx lomo.Shabby.</span></p>
                                                                        <big class="mg-10"><a href="#"><i class="fa fa-thumbs-up"></i></a></big>
                                                                        <big class="mg-10"><a href="#"><i class="fa fa-thumbs-down"></i></a></big>
                                                                        <a href="#"><b>REPLY</b></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="admin-comment">
                                                                    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                                                        <img src="{{url('img/contact/2.jpg')}}" alt="" />
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                                        <div class="comment-details">
                                                                            <h4>Jonathan Doe 2015 15 July </h4>
                                                                            <p>Shabby chic selfies pickled Tumblr letterpress iPhone. Wolf vegan retro selvage literally <span class="mobile-sm-d-n">Wes Anderson ethical four loko. Meggings blog chambray tofu pour-over. Pour-over Tumblr keffiyeh, cornhole whatever cardigan
                                                                                Tonx lomo.Shabby.</span></p>
                                                                            <big class="mg-10"><a href="#"><i class="fa fa-thumbs-up"></i></a></big>
                                                                            <big class="mg-10"><a href="#"><i class="fa fa-thumbs-down"></i></a></big>
                                                                            <a href="#"><b>REPLY</b></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <comments slug-url="{{route('admin.audio.comment', $audio->id)}}"></comments>
                                                        
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
@endsection