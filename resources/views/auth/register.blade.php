<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register - {{get_apps()->name}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('img/favicon.ico')}}">
    
    <link rel="stylesheet" href="{{ url('css/all.css')}}">
    <link rel="stylesheet" href="{{ url('css/app.css')}}">
    <link rel="stylesheet" href="{{ url('css/buttons.css')}}">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <div class="text-center m-b-md custom-login">
        <a href="/"><img style="padding: 5px 0;" src="{{url('img/logo/logosn.png')}}" alt="{{get_apps()->name}}"></a>
    </div>
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6">
                    <div class="box">
                        <div class="content-error">
                            <div class="hpanel">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a class="btn btn-lg btn-default btn-block col-lg-6" href="https://iseetalk.com/auth/google">
                                                <div class="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAMAAABg3Am1AAAAjVBMVEVHcEwwnU/VPjYvnk/VPjUvnVDWSDRQcKehaUFQcKhOc6Iunk7VPTXVPjVQcKdQcKjZWDMvnU7VPTXvtikwnVDWPTXvtSnurSpQcKfVPjYunk7ttChQcajstSgwn0zttCjvtShQcKlQcKgvnk/VPjbvtSnjfi7bsy07n009inXYTTSDqD6bqzqnrTdTokc44COHAAAAInRSTlMAPc/b5r4jPxC/oJBVkIjlQGOjtyC/0/cggIB7X2BQoJ/Psru6sQAAAUhJREFUSMftlduWgiAUhjGBoRTT0uw4B8Gp5vT+jzeGOggCC5vb/iuX6/vYe6MoAI/cFRLTGeScw4LGHnha8EHgCk/BRZwK5YZAa2Ok4OZYDDKz8DNiFqbyu0HXNMY4jVfQxWOJp3IRaOUB/NvGIYGpjT+9d/zO831Y1+WHWN+Tx3WTpgjEnsKpbg0KvDsSKWWB7ZMeRdi0wkbeWVRa3hShbIW1Q1gqQsvXB4dQ/U/oWnr1FjyGVmd4aYWzfHOSeZ9lK8wV4SD4r8ve8Iw6IVFP2235T8ZYPuKPXUtH/VGffxqeIVuBaqt9X74vTERvKqlMIzRBrEtETLzeEQBBL7AwkzeReVNFIiaV6DnIgywKm+urcQK1KTXX8Z72WxuaDWbhG8NSgy2sB29v5DPHUc3HRVDgPt0BmoSLKlmEbvOHYZSRxx/8rvwCaQpYY51gRIUAAAAASUVORK5CYII=&quot;);border-radius: 50%;width: 24px;min-height: 24px;background-repeat: no-repeat;background-size: cover;background-position: center;position: absolute;"></div>
                                                <small class="hidden-xs"> Lanjut dengan Google</small>
                                                <small class="visible-xs"> Google</small>
                                            </a>
                                        </div>
                                        <div class="col-lg-12">
                                            <a class="btn btn-lg btn-default btn-block col-lg-6" href="https://iseetalk.com/auth/facebook">
                                                <div class="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsBAMAAADsqkcyAAAALVBMVEVHcEwYdfEYdvIXd/IYd+8Xd+8Xd/IXd/IQcO8Yd/IXd/EXd/IYdvMXdvIYd/JU6UsnAAAADnRSTlMAgKDGQCFa7xDfkK9/bxPrucEAAAFTSURBVCjPbdM/S8NAFADwh9Ua/Idx6lSKOEuhg+IQMjtIKWRxKNncOokIQhCcXKSfIIsgTqGrS/ETCH4Da/+EtHKfwbvkvcu75t5ydz+Ou5d3eQBFOJcfUdp5ewQjNs9EHqvQUE9gZMy3tMr9Xc03gsUd6Z4w4hP5y+Q/62baPtDrh+NOLIdFnkZMeqJSlWOqktkgvQVk0eZnhJpnckJn/ILmKY4q5iULvzx6qPD7KJ+3YJt4JPkU5/dwRdwCqNN8Bk2aHrLvXYLHWN+zsnMGkY1TEDYWyPMgkI/uBMG1wT/0UrvIsck1vHJs8oEoapWY3MfPGZhc1GIBL/k4cV1f1sR1x1jkmi3vNuzbOAQnqnImL2lWWf0oz1UeQvnGjH2VarLOE1YGxqOimzyTp9hXTyafUyESzkvdO/W45JS1Wq/kd96YvbjgtLHWxq+Sdy58XP4DJ30Z99MJep4AAAAASUVORK5CYII=&quot;);border-radius: 50%;width: 24px;min-height: 24px;background-repeat: no-repeat;background-size: cover;background-position: center;position: absolute;"></div>
                                                <small class="hidden-xs"> Lanjut dengan Facebook</small>
                                                <small class="visible-xs"> Facebook</small>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clearfix text-center pd-10">or</div>
                                    <form class="register-form" action="{{route('register')}}" method="post" id="loginForm">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @csrf
                                        {!!Form::text('name')->placeholder('Nama')!!}
                                        {!!Form::text('email')->placeholder('Email')!!}
                                        {!!Form::tel('phone')->placeholder('Phone')!!}
                                        {!!Form::text('password')->placeholder('Password')->type('password')!!}
                                        <br>
                                        <div class="row">
                                            <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <a href="/login" class="btn btn-default btn-block ">Kembali ke Login</a>
                                            </div> -->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <button type="submit" class="btn btn-lg btn-success btn-block loginbtn">Daftar</button>
                                            </div>
                                        </div>
                                        <div class="login-checkbox">
                                            <label><small class="text-muted"> Mendaftar berarti setuju dengan <a href="{{route('web.page.footer')}}#term-privacy" target="_blank" style="background: none;font-size: 10px;">Layanan dan Kebijakan</a> </small></label>
                                        </div>
                                    </form>
                                    <div class="text-center"><p class="text-muted pd-t-10">Sudah memiliki akun?<a href="https://iseetalk.com/login" style="background: none;color: #f52a00;font-size: 14px;padding: 0;">Masuk</a> </p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hidden-lg" style="padding: 0px;margin: 0;">
                    <div class="box">
                        <div class="text-center m-b-md custom-login">
                            <h2>Login</h2>
                        </div>
                        <p>Login menggunakan email</p>
                        <div class="content-error">
                            <div class="hpanel">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <a href="/login" class="btn btn-warning btn-block ">Login</a>
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
    <script src="{{ url('js/all.js') }}"></script>

    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
</body>

</html>