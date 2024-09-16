<section id="header" class="light-header">
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-default yamm">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="logo-normal">
                        <a class="navbar-brand" href="/"><img src="https://iseetalk.com/img/logo/logosn.png" alt=""></a>
                    </div>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        
                        <li><a href="/">Home</a></li>
                        @guest
                            <li><a href="https://iseetalk.com/login">For Creator</a></li>
                            <li><a href="https://iseetalk.com/login">For Companies</a></li>
                            <li><a class="mark" href="https://iseetalk.com/page/web#contact-us">Contact</a></li>
                        @else
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
                </div><!--/.nav-collapse -->
            </nav>
        </div>
    </header><!-- /header -->
</section>
