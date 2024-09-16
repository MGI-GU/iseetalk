@extends('layouts.admin.main')

@section('content')
    <div class="blog-details-area mg-t-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <big class="mg-t-10">
                                    Project<br>
                                    <a href="#"><b>Team Alfa</b></a>
                                </big>
                                <nav class="mg-t-10">
                                    <div class="left-custom-menu-adp-wrap comment-scrollbar">
                                        @include('admin.project.project-menu')

                                    </div>
                                </nav>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        <h3>#100076</h3>
                                        <p><small>Dec 20, 2019 (created)</small></p>
                                    </div>
                                    <div class="blog-details blog-sig-details mg-t-30">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li class="active"><a href="#home"><small>Detail</small></a></li>
                                                            <li><a href="#audio"><small> Advance</small></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        <a href="{{ URL::previous() }}" class="btn btn-inverse"> BACK</a>
                                                        <a href="{{url('admin/project/audio/1')}}" class="btn btn-primary">EDIT</a>
                                                        <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="#"><i class="fa fa-trash"></i> DELETE</a></li>
                                                        </ul>
                                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="home">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="pro-ad">
                                                        <form action="#" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="">Nama Project</label>
                                                                        <input disabled name="firstname" type="text" class="form-control" placeholder="Pemahaman SCRUM bagian 1">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Deskripsi</label>
                                                                        <textarea disabled name="firstname" type="text" class="form-control" placeholder="Deskripsi">Pemahaman SCRUM untuk meningkatkan kinerja pada team work beserta penjelasan dan contoh</textarea>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">Status</label>
                                                                        <select disabled class="form-control" name="" id="">
                                                                            <option value="">Publik</option>
                                                                            <option value="">Private</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-tab-list tab-pane fade" id="audio">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="pro-ad">
                                                        <form action="#" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="">Comment</label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label><input disabled type="checkbox" checked="true"> Allow Comment</label><br>
                                                                        <select disabled class="form-control" name="" id="">
                                                                            <option value="">Izinkan semua Comment<</option>
                                                                            <option value="">Tinjau semua Comment</option>
                                                                        </select><br>
                                                                        <span>sort by</span>
                                                                        <select disabled name="" id="">
                                                                            <option value="">Populer</option>
                                                                            <option value="">Newest</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label><input disabled type="checkbox" checked="true"> Visitor can view audio ratings</label><br>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label><input disabled type="checkbox" > Publish to Subscriptions feed and notify subscribers</label><br>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label><input disabled type="checkbox" >Age restriction</label><br>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">Category</label>
                                                                        <select disabled class="chosen-select"><option label="Film &amp; Animation" value="string:1">Film &amp; Animation</option><option label="Autos &amp; Vehicles" value="string:2">Autos &amp; Vehicles</option><option label="Music" value="string:10">Music</option><option label="Pets &amp; Animals" value="string:15">Pets &amp; Animals</option><option label="Sports" value="string:17">Sports</option><option label="Travel &amp; Events" value="string:19">Travel &amp; Events</option><option label="Gaming" value="string:20">Gaming</option><option label="People &amp; Blogs" value="string:22" selected="selected">People &amp; Blogs</option><option label="Comedy" value="string:23">Comedy</option><option label="Entertainment" value="string:24">Entertainment</option><option label="News &amp; Politics" value="string:25">News &amp; Politics</option><option label="Howto &amp; Style" value="string:26">Howto &amp; Style</option><option label="Education" value="string:27">Education</option><option label="Science &amp; Technology" value="string:28">Science &amp; Technology</option><option label="Nonprofits &amp; Activism" value="string:29">Nonprofits &amp; Activism</option></select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Bahasa</label>
                                                                        <select disabled class="form-control" name="" id="">
                                                                            <option value="">Tidak ada</option>
                                                                            <option value="">Indonesia</option>
                                                                            <option value="">Inggris</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Lisensi dan hak kepemilikan</label><br>
                                                                        <select disabled class="form-control" name="" id="">
                                                                            <option value="">Lisensi Standar {{get_apps()->name}}</option>
                                                                            <option value="">Creative Commons - Attribution</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
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
    <div id="thumbnail" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div>
                    <div class="modal-close-area modal-close-df">
                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div>
                    
                    <img src="{{url('img/courses/1.jpg')}}" alt=""  >

                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
<link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
<link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
<link rel="stylesheet" href="{{ url('css/modals.css') }}">

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