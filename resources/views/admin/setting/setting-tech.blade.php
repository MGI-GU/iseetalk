@extends('layouts.admin.main')

@section('content')
<div class="container-fluid mg-t-30">
    <div class="row mg-t-30">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            @include('layouts.admin.setting')
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="single-pro-review-area mt-t-30 mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="product-payment-inner-st">
                                <ul id="myTabedu1" class="tab-review-design">
                                    <li class="active"><a href="#description">API</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div id="dropzone1" class="pro-ad">
                                                        {!!Form::open()->post()->route('admin.master.store')!!}
                                                            
                                                            <div class="row">
                                                                @foreach(get_apps()->api as $key => $item)
                                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                        {!! Form::text($key, $key, $item)->placeholder($key)->required()->attrs(['class' => 'form-control']) !!}
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="payment-adress">
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">UPDATE</button>
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
    </div>
</div>
@endsection

@section('script')
<script>
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
    
</script>
@endsection