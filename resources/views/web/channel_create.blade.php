@extends('layouts.web.main')

@section('content')
    <div class="blog-details-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        <a href="#"><img src="{{url('img/pankord/channel-bg-crop.jpg')}}" alt="" style="width: 100%;" /></a>
                                        <div class="blog-date">
                                            <img style="border-radius: 50%;width:100%;" src="{{get_avatar(auth()->user())}}" alt="" />
                                        </div>
                                    </div>
                                    <div class="blog-details blog-sig-details">
                                        <div class="details-blog-dt blog-sig-details-dt courses-info mobile-sm-d-n">
                                            <span><a href="#"> <h3>{{auth()->user()->name}}</h3></a></span>
                                            @if(Request::path() == 'mychannel')
                                            <span class="pull-right">
                                                <a href="/studio" class="btn btn-default">{{get_apps()->name}} STUDIO</a>
                                            </span>
                                            @endif
                                        </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <ul id="myTabedu1" class="tab-review-design">
                            <li class="active"><a href="#home">Create Channel</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="home">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="pro-ad mg-t-10">
                                            <div class="row">
                                                <div class="col-lg-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    {!!Form::open()->post()->route('studio.channel.store')!!}           
                                                        {!!Form::text('name', 'Nama')->autocomplete('off')!!}
                                                        {!!Form::textarea('description', 'Description')->autocomplete('off')!!}
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="payment-adress mg-t-10">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">SAVE</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}
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