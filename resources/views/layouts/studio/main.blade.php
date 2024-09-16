<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{get_apps()->name}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('img/favicon.ico')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' }
    </script>
    <link rel="stylesheet" href="{{ url('css/all.css')}}">
    <link rel="stylesheet" href="{{ url('css/app.css')}}">
    @yield('style')
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    @include('layouts.studio.menu')
    
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        @include('layouts.studio.header')
        
        @yield('content')
        

    </div>

    <script src="{{ url('js/all.js') }}"></script>
    <script src="{{ url('js/app.js') }}"></script>
    @yield('script')
    @include('noty::message')
    
</body>

</html>
