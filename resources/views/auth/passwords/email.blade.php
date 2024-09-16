<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Reset - {{get_apps()->name}}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon
            ============================================ -->
            <link rel="shortcut icon" type="image/x-icon" href="{{url('img/favicon.png')}}">
        <link rel="stylesheet" href="{{ url('css/all.css')}}">
        <link rel="stylesheet" href="{{ url('css/app.css')}}">
        <!-- forms CSS
            ============================================ -->
        <link rel="stylesheet" href="css/form/all-type-forms.css">
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="text-center m-b-md custom-login pd-10">
            <a href="/"><img style="padding: 5px 0;" src="{{url('img/logo/logosn.png')}}" alt="{{get_apps()->name}}"></a>
        </div>
        <div class="error-pagewrap">
            <div class="error-page-int">
                <div class="text-center m-b-md custom-login">
                    <h2>{{ __('Reset Password') }}</h2>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="content-error">
                    <div class="hpanel">
                        <div class="panel-body">
                            <form id="loginForm" method="POST" action="{{ route('password.email') }}">
                                @csrf

                                {!!Form::text('email')->placeholder('Email')!!}
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-lg btn-success btn-block loginbtn">{{ __('Send Password Reset Link') }}</button>
                                    </div>
                                </div>
                                <hr>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="text-center login-footer">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a href="/daftar" class="btn btn-sm btn-default btn-link text-center"> Kembali</a>
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
