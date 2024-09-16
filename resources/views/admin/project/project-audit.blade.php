@extends('layouts.admin.main')

@section('content')
    <div class="blog-details-area mg-t-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box mg-t-30">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <big class="mg-t-10">
                                    Project<br>
                                    <a href="#"><b>Team {{$project->team->name}}</b></a>
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
                                        <h3>#{{$project->id}}</h3>
                                        <p><small>{{$project->created_at}} (created)</small></p>
                                    </div>
                                    <div class="blog-details blog-sig-details mg-t-30">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li class="active"><a href="#home"><small>Detail</small></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        <a href="#" data-toggle="modal" data-target="#suspend" class="btn btn-danger">SUSPEND</a>
                                                        <a href="#" class="btn btn-success">APPROVE</a>
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
                                                                        <label for="">Project</label>
                                                                        <p class="panel-footer ft-pn" placeholder="">{{$project->name}}</p>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Description</label>
                                                                        <p class="panel-footer ft-pn" placeholder="">{{$project->description}}</p>
                                                                        
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">Team</label>
                                                                        <p class="panel-footer ft-pn" placeholder="">{{$project->team->name}}</p>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Status</label>
                                                                        <p class="panel-footer ft-pn" placeholder="">{{get_status($project)}}</p>
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