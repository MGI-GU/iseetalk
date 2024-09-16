@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area  mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st  mg-t-30">
                    <a class="btn back-btn" href="{{route('admin.page.index')}}"><i class="fa fa-angle-left"></i></a>
                    <ul id="myTabedu1" class="tab-review-design">
                        <li class="active"><a href="#description">Add Page</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad">

                                            {!!Form::open()->post()->route('admin.page.store')!!}
                                                <div class="row">
                                                    <div class="col-lg-offset-1 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        {!!Form::text('title', 'Title')->autocomplete('off')!!}
                                                        {!!Form::textarea('content')->id('summernote4')!!}
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                        {!!Form::select('type', 'Type', ['page'=>'Pages', 'news'=>'News', 'footer'=>'Footer Website'])!!}
                                                        <hr>
                                                        {!!Form::select('notification', 'Notification', ['none'=>'None','app'=>'In App','email'=>'Email'])!!}
                                                        <div id="box_notice" class="i-checks pull-left" style="display:none;">
                                                            @if(is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')
                                                            <label><input class="checkbox" type="checkbox" name="user" value="1"> <i></i> Notice to All Users  </label>
                                                            @endif
                                                            <label><input class="checkbox" type="checkbox" name="creator" value="1"> <i></i> Notice to Creator </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="payment-adress">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
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
@endsection

@section('style')
    <!-- summernote CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('css/summernote/summernote.css') }}">
@endsection

@section('script')
    <!-- summernote JS
    ============================================ -->
    <script src="{{ url('js/summernote/summernote.min.js') }}"></script>
    <script src="{{ url('js/summernote/summernote-active.js') }}"></script>
    <!-- icheck JS
    ============================================ -->
    <script src="{{ url('js/icheck/icheck.min.js') }}"></script>
    <script src="{{ url('js/icheck/icheck-active.js') }}"></script>
    <script>
    $('#inp-notification').on('change', function() {
        if(this.value=='none'){
            $('#box_notice').hide();
            $('.checkbox').prop('disabled', 'disabled');
        }else{
            $('#box_notice').show();
            $('.checkbox').prop('disabled', false);
        }
    });
</script>
@endsection
