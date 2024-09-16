<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') {{get_apps()->name}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('img/favicon.ico')}}">
    
    @if(View::hasSection('seo'))
      @yield('seo')
    @else
      @include('layouts.web.head')
    @endif
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' }
    </script>
    <link rel="stylesheet" href="{{ url('css/all.css')}}?v=040421">
    <link rel="stylesheet" href="{{ url('css/app.css')}}">
    @yield('style')

    @if(Request::path() == 'listen')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-1THL3VLK2E"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-1THL3VLK2E');
    </script> -->
    @endif
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-43544607-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-43544607-2');
    </script>

</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
    @if( Auth::user() )
      @if(check_account('admin') || check_account('team_member'))
        <!-- @include('layouts.web.redirect') -->
      @endif
    @endif
    @include('sweet::alert')
    @include('layouts.web.menu')
    
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        @include('layouts.web.header')
        
        @yield('content')
        

    </div>

    <!--<script src="{{ url('js/all.js') }}"></script>-->
    <!--<script src="{{ url('js/app.js') }}?v=040321"></script>-->
    <script src="{{ url('js/all.min.js') }}?v=1503210"></script>
    <script src="https://pankord.s3.ap-southeast-1.amazonaws.com/assets/js/app.min.js"></script>
    @yield('script')
    @include('noty::message')
    
</body>

</html>
