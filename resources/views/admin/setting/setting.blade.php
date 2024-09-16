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
                                    <li class="active"><a href="#description">App Setting</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div id="dropzone1" class="pro-ad">
                                                        {!!Form::open()->post()->route('admin.master.store')!!}
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    {!!Form::text('name', 'APP NAME', get_apps()->name)->autocomplete('off')!!}
                                                                    {!!Form::text('slogan', 'APP SLOGAN', get_apps()->slogan)->autocomplete('off')!!}
                                                                    {!!Form::text('description', 'APP DESCRIPTION', get_apps()->description)->autocomplete('off')!!}
                                                                    
                                                                    <!-- <div class="form-group">
                                                                        <label>LANGUAGE</label>
                                                                        <select class="form-control chosen-select">
                                                                            <option selected value="bahasa">Bahasa</option>
                                                                            <option value="bahasa">English</option>
                                                                            <option value="bahasa">Mandarin</option>
                                                                        </select>
                                                                        
                                                                    </div> -->
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    {!!Form::text('email', 'EMAIL', get_apps()->email)->autocomplete('off')!!}
                                                                    {!!Form::text('phone', 'PHONE', get_apps()->phone)->autocomplete('off')!!}
                                                                    <!-- <div class="form-group">
                                                                        <label>WHATSAPP</label>
                                                                        <input name="mobileno" type="number" class="form-control" placeholder="pankord_admin">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>PHONE</label>
                                                                        <input name="address" type="text" class="form-control" placeholder="+620163943">
                                                                    </div> -->
                                                                </div>
                                                            </div>
                                                            <br>
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