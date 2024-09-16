@extends('layouts.web.main')

@section('content')
    <div class="blog-details-area mg-t-60 mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-offset-1 col-md-offset-1 col-lg-11 col-md-10 col-sm-10 col-xs-10">
                    <div class="blog-details-inner white-box white-box">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            
                                <img src="{{get_audio_cover($data->audio_upload)}}" alt=""  >
                                <p class="mg-t-10">Audio upload status: Upload complete! </p>
                                <br>
                                <p>Audio quality:<br>
                                Your audio will process faster if you encode into a streamable file format. For more information, visit our Help Center.</p>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                <audio id="audio" controls style="width: 100%;background: #f1f3f4;">
                                                    <source src="{{urlStorage().$data->url}}" type="audio/mpeg" autoplay controlsList="nodownload">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <button id="done" class="btn btn-lg btn-success">SAVE</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <p>Click "Done" to confirm.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-details blog-sig-details">
                                        <ul id="myTabedu1" class="tab-review-design" style="border-bottom:solid 1px #ddd;">
                                            <li class="active"><a href="#home"><small>Audio information</small></a></li>
                                        </ul>
                                    </div>
                                    {!!Form::open()->post()->route('studio.audio.store')->id('audio_form')!!}
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="home">
                                            <div id="app">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad mg-t-10">
                                                            <div  class="row">
                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                                    
                                                                    {!!Form::text('name', 'Title')->autocomplete('off')!!}
                                                                    {!!Form::textarea('description', 'Description')->autocomplete('off')!!}
                                                                    <multi-select data-label="Hashtag" data-name="tags" data-placeholder="tag"></multi-select>
                                                                    {!!Form::hidden('source')->value($data->id)!!}
                                                                    {!!Form::hidden('duration')->value($data->duration)!!}
    
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    {!!Form::select('visibility', 'Visibility', ['public' => 'Publik', 'private'=>'Private'])!!}
                                                                    <create-new-input-select data-label="Channel" data-name="channel" data-placeholder="+ Select channel" :option='{{ json_encode(get_user_channels("vue")) }}' :values='{{$channel ?? json_encode(get_default_channel())}}'></create-new-input-select>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <hr>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="">Comment</label>
                                                                        {!!Form::select('allow_comment', 'Allow Comment', ['1'=>'Izinkan semua komentar','2'=>'Tinjau semua komentar','0'=>'Tidak'])!!}
                                                                        
                                                                        <span>sort by</span>
                                                                        <select name="sort_comment" id="sort_comment">
                                                                            <option value="">Populer</option>
                                                                            <option value="">Newest</option>
                                                                        </select>
                                                                    </div>
                                                                    <hr>
                                                                    {!!Form::checkbox('allow_rating', ' Visitor can view audio ratings')!!}
                                                                    {!!Form::checkbox('allow_notice', ' Kirim notifikasi ke pelanggan')!!}
                                                                    {!!Form::checkbox('allow_age', 'Age restriction')!!}
                                                                    
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    {!!Form::select('category_id', 'Kategori', get_categories()->toArray())->attrs(['class' => 'chosen-select'])!!}
                                                                    {!!Form::select('language', 'Bahasa', get_languages()->toArray())!!}
                                                                            
                                                                    <!--<div class="form-group">-->
                                                                    <!--    <label>Lisensi dan hak kepemilikan</label><br>-->
                                                                    <!--    <select class="form-control" name="" id="">-->
                                                                    <!--        <option value="">Lisensi Standar {{get_apps()->name}}</option>-->
                                                                    <!--        <option value="">Creative Commons - Attribution</option>-->
                                                                    <!--    </select>-->
                                                                    <!--</div>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
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
@endsection

@section('style')
<link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
<link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">

@endsection

@section('script')
    <!-- chosen JS
		============================================ -->
    <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS
		============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <script>
        document.getElementById("audio").onloadedmetadata = function() {
            $('#inp-duration').val(document.getElementById("audio").duration);
        };
        $('body').attr('class', 'mini-navbar');
        $('#sidebar').attr('class', 'active');
        $("#done").click(function() {
            $('#audio_form').submit();
        });
    </script>
@endsection