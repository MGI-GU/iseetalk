<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="logo-pro visible-sm visible-xs">
                <a href="/"><img class="main-logo" src="{{url('img/logo/logo.png')}}" alt="" /></a>
            </div>
        </div>
    </div>
</div>
<div class="header-advance-area">
    <div class="header-top-area studio-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header-top-wraper">
                        <div class="row">
                            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                <div class="menu-switcher-pro logo-nav-bar">
                                    <strong>
                                        <a href="/">
                                            <img class="hidden" style="padding: 5px 0;" src="{{url('img/logo/logosn.png')}}" alt="" />
                                            <small class="text-info">{{auth()->user()->role_name}}</small>
                                        </a>
                                    </strong>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <div class="header-top-menu tabl-d-n">
                                    <div class="breadcome-heading">
                                        <form role="search" class="sr-input-func sr-bar">
                                            <input type="text" placeholder="Cari" class="search-int form-control">
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                        @if(is_copy_writer(auth()->user())!=='false' || is_leader(auth()->user())!=='false')
                                        <li class="nav-item">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                                                <div class="notification-single-top">
                                                    <h1>CREATE</h1>
                                                </div>
                                                <ul class="notification-menu">
                                                    <li style="width: 100%;">
                                                        <a href="{{route('admin.channel.index')}}">
                                                            <div class="notification-icon">
                                                                <i class="fa fa-microphone" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="notification-content">
                                                                <h2>Add Audio</h2>
                                                                <p><small>Please choose channel first.</small></p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @if(is_leader(auth()->user())!='false')
                                                    <li style="width: 100%;">
                                                        <a href="{{route('admin.project.index')}}">
                                                            <div class="notification-icon">
                                                                <i class="fa fa-table icon-wrap" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="notification-content">
                                                                <h2>Add Channel</h2>
                                                                <p><small>Please choose Project first.</small></p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li style="width: 100%;">
                                                        <a href="{{route('admin.project.add')}}">
                                                            <div class="notification-icon">
                                                                <i class="fa fa-flag" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="notification-content">
                                                                <h2>Add Project</h2>
                                                                <p><small>You need team to add new Project.</small></p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </li>
                                        @endif
                                        <li class="nav-item">
                                            @include('layouts.notification')
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                <img style="width: 26px;height: auto;" class="icon-border" src="{{get_avatar(auth()->getUser())}}" alt="{{auth()->getUser()->name}}" />
                                                <small class="nick-name">{{auth()->getUser()->name}}</small>
                                            </a>
                                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">

                                                <li><a href="{{route('web.setting.index')}}"><span class="edu-icon fa fa-user"></span> Profile</a>
                                                </li>
                                                <li><a href="{{route('admin.master.index')}}"><span class="edu-icon fa fa-cog"></span> Setting</a>
                                                </li>
                                                <li><a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                        <span class="edu-icon fa fa-power-off"></span> {{ __('Logout') }}</a>
                                                </li>
                                            </ul>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu start -->
    <!-- <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>

                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

</div>
