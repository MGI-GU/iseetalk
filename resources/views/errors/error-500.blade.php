<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') {{get_apps()->name}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('img/favicon.ico')}}">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/all.css')}}">
    <link rel="stylesheet" href="{{ url('css/app.css')}}">
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <div class="error-pagewrap">
		<div class="error-page-int">
			<div class="content-error">
				<h1>ERROR <span class="counter"> 500</span></h1>
				<p>Sorry, some our service not working in good. We try to fix it ASAP.</p>
				<a class="btn btn-default" href="mailto:support@iseetalk.com">Report Problem</a>
			</div>
			<div class="text-center login-footer">
				<p>Copyright © {{date('Y')}}. All rights reserved.</p>
			</div>
		</div>   
    </div>
    <script src="{{ url('js/all.js') }}"></script>
    <script src="{{ url('js/app.js') }}"></script>
</body>

</html>