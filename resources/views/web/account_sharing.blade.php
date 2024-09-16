@extends('layouts.web.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                @include('layouts.web.setting')
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <div class="single-pro-review-area mt-t-30 mg-b-15">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="sparkline12-list">
                                    <div class="sparkline12-hd">
                                        <div class="main-sparkline12-hd">
                                            <h4>Aplikasi yang terhubung</h4>
                                            <p> Hubungkan {{get_apps()->name}} dengan aplikasi lain agar Anda dapat menikmati {{get_apps()->name}} dengan lebih mudah</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="review-content-section">
                                        <div class="chat-discussion" style="height: auto">
                                            @if(auth()->user()->provider=='facebook')
                                            <div class="list-channel">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-1 col-sm-4 col-xs-4">
                                                        <div class="profile-hdtc text-center box" style="margin-top:0px;">
                                                            <i class="fa fa-3x fa-facebook" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 col-md-8 col-sm-8 col-xs-8">
                                                        <a> 
                                                            <strong class="message-author mg-t-15"> Facebook </strong>
                                                            <span class="message-content">Hubungkan akun Facebook agar lebih mudah mengakses {{get_apps()->name}}.
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-8 col-xs-12 text-center">
                                                        <button disabled class="btn btn-lg btn-block btn-success">TERHUBUNG</span>
                                                        <!-- <span class="btn btn-default" data-toggle="modal" data-target="#connect">CONNECT</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                            @elseif(auth()->user()->provider=='google')
                                            <div class="list-channel">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-1 col-sm-4 col-xs-4">
                                                    <div class="profile-hdtc text-center box" style="margin-top:0px;">
                                                            <i class="fa fa-3x fa-google" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 col-md-8 col-sm-8 col-xs-8">
                                                        <a> 
                                                            <strong class="message-author mg-t-15""> Google </strong>
                                                            <span class="message-content">Hubungkan akun Google agar lebih mudah mengakses {{get_apps()->name}}.
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-8 col-xs-12 text-center">
                                                        <button disabled class="btn btn-lg btn-block btn-success">TERHUBUNG</span>
                                                        <!-- <span class="btn btn-default" data-toggle="modal" data-target="#connect">CONNECT</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="text-center well">Anda tidak memiliki akun tertaut.</div>
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
    <div id="connect" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-color-modal bg-color-1">
                    <h4 class="modal-title">Connect accounts and watch approved Apps</h4>
                    <div class="modal-close-area modal-close-df">
                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div class="modal-body">
                    
                    <h2><i class="fa fa-plug"></i></h2>
                    <p>The Modal plugin is a dialog box/popup window that is displayed on top of the current page</p>
                </div>
                <div class="modal-footer text-center">
                    <a href="#">CONNECT</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("style")
<link rel="stylesheet" href="css/modals.css">
@endsection

@section("script")
<script>
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
</script>
@endsection