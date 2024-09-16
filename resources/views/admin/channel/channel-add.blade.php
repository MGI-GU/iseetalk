@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st  mg-t-30">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <a class="btn back-btn" href="{{route('admin.project.index')}}"><i class="fa fa-angle-left"></i></a>
                            <ul id="myTabedu1" class="tab-review-design">

                                <li class="active"><a href="#1">1. Data Channel</a></li>
                                    
                            </ul>
                        </div>
                    </div>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="pro-ad">
                                            {!!Form::open()->post()->route('admin.channel.store')!!}
                                                <div class="row">
                                                    <div class="col-lg-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        
                                                        {!!Form::text('name', 'Nama channel')->autocomplete('off')!!}
                                                        {!!Form::textarea('description', 'Description')->autocomplete('off')!!}
                                                        {!!Form::hidden('project', $request->project)!!}
                                                        
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="payment-adress mg-t-10">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">NEXT</button>
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
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
    <link rel="stylesheet" href="{{url('css/summernote/summernote.css')}}">

@endsection

@section('script')
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
    <!-- chosen JS
		============================================ -->
        <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS
		============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <script src="{{url('js/summernote/summernote.min.js')}}"></script>
    <script>
        /*--------------------------
        TEXT EDITOR
        ---------------------------- */	
        $('#inp-description').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            height: 200,
        });
    </script>
@endsection