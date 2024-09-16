@extends('layouts.web.main')
@section('title', $page=='default'?'':$page->title.' - ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="single-pro-review-area mt-t-30 mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="blog-details-inner white-box">
                            @if($page=='default')
                                <ul id="myTabedu1" class="tab-review-design">
                                    @foreach(get_footer_pages() as $key => $page)
                                        <li class="{{$key == 0 ? 'active':''}} #{{$page->slug}}"><a href="#{{$page->slug}}">{{$page->title}}</a></li>
                                    @endforeach
                                    <!-- <li><a href="#copy"> Copyright</a></li> -->
                                    <!-- <li><a href="#contact"> Contact us</a></li> -->
                                    <!-- <li><a href="#term"> Term & Privacy</a></li>
                                    <li><a href="#policy"> Policy & Security</a></li> -->
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    @foreach(get_footer_pages() as $key => $page)
                                        <div class="product-tab-list tab-pane fade {{$key == 0 ? 'active':''}} in" id="{{$page->slug}}">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="review-content-section well">
                                                        <div class="row">
                                                            <div class="col-lg-offset-1 col-lg-11">
                                                                <div class="mg-t-30">
                                                                    <h4>{{$page->sub_content}}</h4>
                                                                </div>
                                                                <hr>
                                                                <div>
                                                                {!!$page->content!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                            <ul id="myTabedu1" class="tab-review-design">
                                    <li class="active"><a>{{$page->title}}</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="about">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section well">
                                                    <div class="row">
                                                        <div class="col-lg-offset-1 col-lg-11">
                                                            <div class="mg-t-30">
                                                                <h4>{{$page->sub_content}}</h4>
                                                            </div>
                                                            <hr>
                                                            <div>
                                                                <p>{!! $page->content !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

@section('style')
<style>
    ol, ul{
        margin-left: 15px;
    }
</style>
@endsection

@section('script')
<script>
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
    $('.logo-nav-bar img').attr('class', 'active');
    $(document).ready(function () {
        hash = window.location.hash;
        elements = $('a[href="' + hash + '"]');
        if (elements.length === 0) {
            $("ul.tabs li:first").addClass("active").show(); //Activate first tab
            $(".tab_content:first").show(); //Show first tab content
        } else {
            elements.click();
        }

        $('.footer a').on('click', function (e) {
            hash = $(this).attr("data-slug");
            elements = $('a[href="' + hash + '"]');
            elements.click();
		});
    });
</script>
@endsection
