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
        <div class="error-pagewrap">
            <div class="error-page-int">
                <div class="text-center m-b-md custom-login">
                    <p>{{ __('Reset Password') }}</p>
                </div>
                <div class="content-error">
                    <div class="hpanel">
                        <div class="panel-body">
                            <form action="{{url('password/reset')}}" method="post" id="loginForm">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                {!!Form::text('email', __('E-Mail Address'), $email ?? old('email'))!!}

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6">
                                        <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="text-center login-footer">
                    
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
