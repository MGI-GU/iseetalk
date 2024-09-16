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
                                            <h4>Billing and payments</h4>
                                            <h2>Choose how you make purchases</h2>
                                            <p>Purchase verification is enabled You will be asked to verify your account for all {{get_apps()->name}} purchases Learn more about purchase verification</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="review-content-section">
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
<link rel="stylesheet" href="css/modals.css">
<script>
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
</script>
@endsection