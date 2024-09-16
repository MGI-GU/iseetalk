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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet"> 
    
    <link rel="stylesheet" href="https://pankord.s3.ap-southeast-1.amazonaws.com/assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pankord.s3.ap-southeast-1.amazonaws.com/assets/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pankord.s3.ap-southeast-1.amazonaws.com/assets/frontend/css/style.css">
    @yield('style')

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
    
    <!-- Start Welcome area -->
    <div class="wrapper">
        @include('layouts.frontend.header')
        
        @yield('content')
        
        @include('layouts.frontend.footer')
    </div>

    <script src="https://pankord.s3.ap-southeast-1.amazonaws.com/assets/frontend/js/jquery.min.js"></script>
    <script src="https://pankord.s3.ap-southeast-1.amazonaws.com/assets/frontend/js/bootstrap.min.js"></script>
    <script src="https://pankord.s3.ap-southeast-1.amazonaws.com/assets/frontend/js/revslider.js"></script>
    @yield('script')
    @include('noty::message')
    
</body>

</html>
