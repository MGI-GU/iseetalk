@extends('layouts.admin.main')

@section('content')
    <div class="blog-details-area mg-t-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="#" data-toggle="modal" data-target="#thumbnail"><img src="{{url('img/courses/1.jpg')}}" alt="" class="cropper-hidden"></a>
                                
                                <p class="mg-t-10">Audio<br><small>Pemahaman SCRUM bagian 1</small></p>
                                @if(app('request')->input('f')=='channel')
                                    @include('admin.channel.channel-menu')
                                @elseif(app('request')->input('f')=='audio')
                                    @include('admin.audio.audio-menu')
                                @endif
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        <div class="form-group">
                                            <h4>Pemahaman SCRUM bagian 1</h4>
                                        </div>
                                        @if(app('request')->input('f')=='audio')
                                        <audio controls style="width: 100%;background: #f1f3f4;">
                                            <source src="{{url('audio/demo.mp3')}}" type="audio/mpeg" autoplay>
                                            Your browser does not support the audio element.
                                        </audio>
                                        @endif
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
                                                        <a href="#" data-toggle="modal" data-target="#suspend" class="btn btn-danger">SUSPEND</a>
                                                        <a href="#" class="btn btn-success">APPROVE</a>
                                                        <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="#"><i class="fa fa-download"></i> Unduh</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Hapus</a></li>
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
                                                                        <label for="">Deskripsi</label>
                                                                        <p>A greatest hits album, sometimes called a "best of" album or a catalog album, is a compilation of songs by a particular artist or band. Most often the track list contains previously released recordings with a high degree of notability.</p>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Tag</label>
                                                                        <p><a href="#">#tag</a> <a href="#">#debat</a></p>
                                                                    </div>
                                                                    @if(app('request')->input('f')=='channel')
                                                                    <div class="form-group">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th colspan="4">Daftar Audio</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>1</td>
                                                                                    <td>Don't Panic</td>
                                                                                    <td>2:17</td>
                                                                                    <td>
                                                                                        <a href="/admin/audit/1?f=channel"><i class="fa fa-play"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>2</td>
                                                                                    <td>Shiver</td>
                                                                                    <td>5:00</td>
                                                                                    <td>
                                                                                        <a href="/admin/audit/1?f=channel"><i class="fa fa-play"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>3</td>
                                                                                    <td>Spies</td>
                                                                                    <td>5:19</td>
                                                                                    <td>
                                                                                        <a href="/admin/audit/1?f=channel"><i class="fa fa-play"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="form-group mg-b-30">
                                                                        <label>Audio link</label>
                                                                        <p><a href="#">https://pankord.com/listen</a></p>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Status</label>
                                                                        <select disabled class="form-control" name="" id="">
                                                                            <option value="">Public</option>
                                                                            <option value="">Private</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Channel</label>
                                                                        <select disabled data-placeholder="Debat" class="chosen-select" multiple="" tabindex="-1" name="" id="">
                                                                            <option value="">Baru</option>
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
                                                                        <label for="">Komentar</label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label><input disabled type="checkbox" checked="true"> Izinkan komentar</label><br>
                                                                        <select disabled class="form-control" name="" id="">
                                                                            <option value="">Izinkan semua komentar</option>
                                                                            <option value="">Tinjau semua komentar</option>
                                                                        </select><br>
                                                                        <span>Urut berdasarkan</span>
                                                                        <select disabled name="" id="">
                                                                            <option value="">Terpopuler</option>
                                                                            <option value="">Terbaru</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label><input disabled type="checkbox" checked="true"> Pengunjung dapat melihat rating audio</label><br>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label><input disabled type="checkbox" > Publish to Subscriptions feed and notify subscribers</label><br>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label><input disabled type="checkbox" > Aktifkan batasan umur</label><br>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">Kategori</label>
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
                                                                            <option value="">Lisensi Standar PanKord</option>
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
                    
                    <img src="{{url('img/courses/1.jpg')}}" alt="" class="cropper-hidden">

                </div>
            </div>
        </div>
    </div>
    <div id="suspend" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-color-modal bg-color-4">
                    <h4 class="modal-title">Suspend form</h4>
                    <div class="modal-close-area modal-close-df">
                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div class="modal-body">
                    
                    <form action="{{url('admin/role')}}" class=" custom needsclick add-professors" id="demo1-upload">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select class="form-control dt-tb mg-t-10">
                                        <option value="all">Thumbnail</option>
                                        <option value="all">Audio</option>
                                        <option value="all">Title</option>
                                        <option value="all">Description</option>
                                        <option value="all">Age</option>
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="">Message</label>
                                    <textarea name="" id="" cols="30" rows="10"></textarea>
                                </div>
                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">SEND</button>
                                </div>
                            </div>
                        </div>
                    </form>

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