@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st mg-t-30">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#1">Add audio for {{$request->name ?? ''}}</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                            <a href="{{ URL::previous() }}" class="btn btn-inverse"> BACK</a>
                            @if(is_copy_writer(auth()->user())!=='false' || is_leader(auth()->user())!=='false')
                            <a href="#" class="btn btn-success save">SAVE</a>
                            <!-- <a href="#" class="btn btn-success save-next">SUBMIT</a> -->
                            @endif
                        </div>
                    </div>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="pro-ad">
                                        @if(is_copy_writer(auth()->user())!=='false' || is_leader(auth()->user())!=='false')
                                            {!!Form::open()->post()->route('admin.audio.store')!!}
                                                <div id="app" class="row">
                                                    <div class="col-lg-offset-1 col-lg-7 col-md-8 col-sm-8 col-xs-12">
                                                        {!!Form::hidden('channel', $request->channel)!!}
                                                        <!-- <hr>
                                                        <div class="form-group">
                                                            {!!Form::select('allow_comment', 'Allow Comment', ['1'=>'Allow all comments','2'=>'Review all comments','0'=>'Not Allow'])!!}
                                                            
                                                            <span>Sort by</span>
                                                            <select name="sort_comment" id="sort_comment">
                                                                <option value="0">Populer</option>
                                                                <option value="1">Newest</option>
                                                            </select>
                                                        </div> -->
                                                        <!-- <hr> -->
                                                        {!!Form::hidden('contain', 'Contain File Presentation', true)!!}
                                                        <!-- {!!Form::checkbox('allow_rating', ' Visitor can view audioslide ratings', true)!!}
                                                        {!!Form::checkbox('allow_notice', ' Notif to Subscriber', true)!!}
                                                        {!!Form::checkbox('allow_age', 'Age restriction', true)!!} -->
                                                        {!!Form::text('name', 'Audio Title')->autocomplete('off')!!}
                                                        {!!Form::textarea('description', 'Description')->autocomplete('off')!!}
                                                        <multi-select data-label="Hashtag" data-name="tags" data-placeholder="tag" :values='[]'></multi-select>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <!-- {!!Form::select('source', 'Audio Source', ['audio_file'=>'Attach File Audio','text_file'=>'Attach Text File','web_link'=>'Web Link'])!!} -->
                                                        <div class="form-group">
                                                            <label>Source of Content</label>
                                                            <select class="form-control" name="source" id="source">
                                                                <option value="text">Text </option>
                                                                <option value="weblink">Weblink</option>
                                                                <!-- <option value="attachment">Attachment</option> -->
                                                            </select>
                                                        </div>
                                                        <div id="weblink" style="display:none;">
                                                            {!!Form::text('url', 'Weblink')->placeholder('http://example.com')->autocomplete('off')!!}  
                                                        </div>
                                                        <div id="attachment" style="display:none;">
                                                            <label>Upload</label>
                                                            <btn-upload :id="0" placeholder-text="Upload attachment" type-data="source" model-data="contentProject" slug-url="{{route('admin.upload.store')}}"></btn-upload>
                                                            <br>
                                                        </div>
                                                        {!!Form::textarea('note', 'Instruction')->placeholder('Add note and instruction here')->autocomplete('off')!!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="payment-adress mg-t-10">
                                                            <!-- <button type="submit" class="btn btn-primary waves-effect waves-light">NEXT</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            {!! Form::close() !!}
                                        @else
                                            <div class="well">Only Copy Writer can add audio Title & Description. <a class="btn btn-link" href="#">Notice Team Member</a></div>
                                        @endif
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
        $(".save").click( function() {
            $('#inp-save').val('save');
            $('form').submit();
        });
        $(".save-next").click( function() {
            $('#inp-save').val('next');
            $('form').submit();
        });

        $(document).ready(function() {
            $('#source').change(function() {
                if($(this).val() == 'attachment'){
                    $('#attachment').show();
                    $('#weblink').hide();
                    $('#inp-url').val('');
                }else if($(this).val() == 'weblink'){
                    $('#weblink').show();
                    $('#attachment').hide();
                }else{
                    $('#inp-url').val('');
                    $('#weblink').hide();
                    $('#attachment').hide();
                }
            });
        });
    </script>
@endsection