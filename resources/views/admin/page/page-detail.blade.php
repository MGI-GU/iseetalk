@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div id="app" class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st mg-t-30">
                    <a class="btn back-btn" href="{{route('admin.page.index')}}"><i class="fa fa-angle-left"></i></a>
                    <ul id="myTabedu1" class="tab-review-design">
                        <li class="active"><a href="#description">Edit Page</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad">
                                            {!!Form::open()->put()->route('admin.page.update', [$page->id])!!}
                                                <div class="row">
                                                    <div class="col-lg-offset-1 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        {!!Form::text('title', 'Title', $page->title)->autocomplete('off')!!}
                                                        {!!Form::text('sub_content', 'Subject / Notice', $page->sub_content)->autocomplete('off')!!}
                                                        {!!Form::textarea('content')->id('summernote4')->value($page->content)!!}
                                                        <br>
                                                        {!!Form::text('slug', 'URL', $page->slug)->autocomplete('off')!!}
                                                    </div>
                                                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                                        <label for="">Link</label>
                                                        <p><a target="_blank" class="btn btn-default" href="{{route('web.page', [$page->slug])}}">{{route('web.page', [$page->slug])}}</a></p>
                                                        <hr>
                                                        {!!Form::select('status', 'Status', ['unpublish'=>'Unpublish','publish'=>'Publish'], $page->status)!!}
                                                        <hr>
                                                        <label for="">Type</label>
                                                        <p>{!!$page->type!!}</p>
                                                        @if($page->type!='footer')
                                                        <hr>
                                                        {!!Form::select(
                                                            'notification',
                                                            'Notification',
                                                            ['none'=>'None','app'=>'In App','email'=>'Email'],
                                                            get_notification_type($page)
                                                        )!!}
                                                        <div id="box_notice" class="i-checks pull-left" style="display:{{get_notification_type($page)!='none'?'block':'none'}};">
                                                            <label><input {{strpos(@$page->notification->type, '_user') !== false ?'checked':''}} class="checkbox" type="checkbox" name="user" value="1"> <i></i> Notice to Users  </label>
                                                            <label><input {{strpos(@$page->notification->type, '_creator') !== false?'checked':''}} class="checkbox" type="checkbox" name="creator" value="1"> <i></i> Notice to Creator </label>
                                                        </div>
                                                        @endif
                                                        <div class="col-lg-12">
                                                            <hr>
                                                            <div class="payment-adress">
                                                                <button id="save_btn" type="submit" class="btn btn-primary btn-block">Save</button>
                                                            </div>
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
    $('#inp-status').on('change', function() {
        if($('#inp-notification').val() != 'none'){
            if(this.value=='unpublish'){
                $('#save_btn').text('Save');
            }else{
                $('#save_btn').text('Send Notification');
            }
        }
    });
</script>
@endsection
