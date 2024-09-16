<div class="header-advance-area">
    <div class="header-top-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header-top-wraper">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <div class="menu-switcher-pro logo-nav-bar">
                                    <strong>
                                        <a href="/">
                                            <img class="hidden" style="padding: 5px 0;" src="{{url('img/logo/logosn.png')}}" alt="" />
                                        </a>
                                    </strong>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="header-top-menu tabl-d-n">
                                    <div class="breadcome-heading">
                                        {!!Form::open()->post()->route('web.search')->attrs(['class' => 'sr-input-func sr-bar', 'role'=> 'search'])!!}
                                            <div class="input-group custom-go-button">
                                                <input style="height: 42px;" type="text" placeholder="Cari" value="{{$id ?? ''}}" name="keyword" class="search-int form-control">
                                                <span class="input-group-btn"><button style="width: 65px;" class="btn" href="#"><i class="fa fa-search"></i></button></span>
                                            </div>
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mobile-teaser">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu hidden-xs hidden-sm">
                                    @guest
                                        <li class="nav-item">
                                            <a href="/login" role="button" aria-expanded="false" class="nav-link" style="padding: 5px 20px;border: solid 1px #ddd;border-radius: 2px;"><small><i class="fa fa-user"></i> Masuk</small></a>
                                        </li>
                                    @else
                                        @if(check_account('admin'))
                                        <li class="nav-item box" style="margin: -5px;padding: 0px;">
                                            @if(is_admin(auth()->user())=='admin')
                                            <a href="{{route('admin.'.auth()->user()->main_role->role->permission_by_model[0]->model.'.index')}}" role="button" aria-expanded="false" class="nav-link" style="padding: 5px;">
                                                <i class="fa fa-user-secret " aria-hidden="true"></i>
                                                <span class="indicator-ms"></span>
                                                <small>Admin Platform</small>
                                            </a>
                                            @else
                                            <a href="{{url('admin')}}" role="button" aria-expanded="false" class="nav-link" style="padding: 5px;">
                                                <i class="fa fa-user-secret " aria-hidden="true"></i>
                                                <span class="indicator-ms"></span>
                                                <small>Admin Platform</small>
                                            </a>
                                            @endif
                                        </li>
                                        @elseif(check_account('member'))
                                        <li class="nav-item box" style="margin: -5px;padding: 0px;">
                                            <a href="{{route('admin.project.index')}}" role="button" aria-expanded="false" class="nav-link" style="padding: 5px;">
                                                <i class="fa fa-user-secret " aria-hidden="true"></i>
                                                <span class="indicator-ms"></span>
                                                <small>Team Platform</small>
                                            </a>
                                        </li>
                                        @else
                                        <li class="nav-item box" style="margin: -5px;padding: 0px;">
                                            <a href="{{route('upload')}}" role="button" aria-expanded="false" class="nav-link" style="padding: 5px;">
                                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                <span class="indicator-ms"></span>
                                                <small>Upload</small>
                                            </a>
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
                                                <li><a href="{{route('web.channel.index')}}"><span class="edu-icon fa fa-caret-square-o-down"></span> Channel saya</a>
                                                </li>
                                                @if(auth()->getUser()->creator())
                                                    <li><a href="/studio"><span class="edu-icon fa fa-play-circle-o"></span> {{get_apps()->name}} Studio</a></li>
                                                @endif
                                                <li><a href="{{route('web.setting.index')}}"><span class="edu-icon fa fa-user"></span> Profil</a>
                                                </li>
                                                <li><a href="{{route('web.setting.show', ['notification'])}}"><span class="edu-icon fa fa-cog"></span> Pengaturan</a>
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
                                    @endguest

                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="">
    <div class="">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- <div class="visible-xs text-center hide">
                <a href="#" class="btn btn-lg btn-danger pd-10 mg-t-30 mg-b-10"><small>Download {{get_apps()->name}} di Playstore</small></a>
            </div> -->
            <div class="logo-pro" style="text-align:left;background: #fff;">
                <div class="">
                    <div class="col-lg-4 col-xs-5 col-sm-4">
                        <button type="button" id="mobileMenuOpen" class="btn bar-button-pro header-drl-controller-btn btn-defaultnavbar-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a href="/"><img class="main-logo" src="{{url('img/logo/logo.png')}}" alt="" /></a>
                    </div>
                    <div class="col-lg-8 col-xs-7 col-sm-8">
                        {!!Form::open()->post()->route('web.search')->attrs(['class' => 'sr-input-func', 'role'=> 'search', 'style'=>'margin-top: 6px;'])!!}
                            <div class="input-group custom-go-button">
                                <input style="height: 42px;" type="text" placeholder="Cari" required value="{{$id ?? ''}}" name="keyword" class="search-int form-control">
                                <span class="input-group-btn text-right"><button style="width: 65px;" class="btn" href="#"><i class="fa fa-search"></i></button></span>
                            </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
