@extends('layouts.studio.main')

@section('content')
    <div id="app" class="blog-details-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="{{route('web.listen', [$audio->slug ?? '0'])}}"><img src="{{get_audio_cover($audio)}}" alt=""  ></a>
                                <p class="mg-t-10"><br><small>{{@$audio->name}}</small></p>
                                @include('layouts.studio.audio_menu')
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        <h2>Komentar audio</h2>
                                    </div>
                                    <div class="blog-details blog-sig-details">
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
                                                        <div class="row">
                                                            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                                                <img src="{{get_avatar(auth()->getUser())}}" alt="" />
                                                            </div>
                                                            <div class="coment-area">
                                                                {!!Form::open()->post()->route('studio.comment.store', [$audio->id])->id('data')!!}
                                                                    <div class="row">
                                                                        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <textarea name="comment" cols="30" rows="10" placeholder="Tulis komentar"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2 col-md-10 col-sm-12 col-xs-12">
                                                                            <div class="payment-adress comment-stn pull-left">
                                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Comment</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                {!! Form::close() !!}
                                                            
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="comment-head">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <comments slug-url="comments"></comments>
                                                        
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