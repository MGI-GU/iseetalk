<!-- Start Left menu area -->
<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <div class="row">
                <div class="">
                    <div class="menu-switcher-pro">
                        <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a href="/"><img class="main-logo" src="{{url('img/logo/logosn.png')}}" alt="{{url('/')}}" style="height: 42px;"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                    <li class="{{(Request::path() == 'studio') ? 'active':''}}">
                        <a href="/studio">
                            <span class="fa fa-home icon-wrap"></span>
                            <span class="mini-click-non">Dashboard</span>
                        </a>
                    </li>
                    <li class="{{(Request::path() == 'studio/audio') ? 'active':''}}">
                        <a href="/studio/audio">
                            <span class="fa fa-play icon-wrap"></span>
                            <span class="mini-click-non">Audioslide</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('studio.channel.index')}}">
                            <span class="fa fa-th-large icon-wrap"></span>
                            <span class="mini-click-non">Channel</span>
                        </a>
                    </li>
                    <li class="{{(Request::path() == 'studio/analytic') ? 'active':''}}"> 
                        <a href="/studio/analytic">
                            <span class="fa fa-line-chart icon-wrap"></span>
                            <span class="mini-click-non">Analisa</span>
                        </a>
                    </li>
                    <li class="{{(Request::path() == 'studio/comments') ? 'active':''}}">
                        <a href="/studio/comments">
                            <span class="fa fa-comment icon-wrap"></span>
                            <span class="mini-click-non">Komentar</span>
                        </a>
                    </li>
                    <hr>
                    <li class="{{(Request::path() == 'setting') ? 'active':''}}">
                        <a href="{{route('web.setting.index')}}">
                            <span class="fa fa-cog icon-wrap"></span>
                            <span class="mini-click-non">Pengaturan</span>
                        </a>
                    </li>
                    <hr>
                    
                    
                </ul>
            </nav>
        </div>
    </nav>
</div>
<!-- End Left menu area -->