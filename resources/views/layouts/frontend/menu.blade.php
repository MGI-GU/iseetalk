<!-- Start Left menu area -->
<div class="left-sidebar-pro">
    <nav id="sidebar" class="{{(Request::path() == 'trending') ? 'active':''}}">
        <div class="sidebar-header" style="padding:0;">
            <div class="row">
                <div style="min-height:66px;">
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
                <ul class="metismenu" id="menu1" style="margin:0;">
                    <li class="{{(Request::path() == '/') ? 'active':''}}">
                        <a href="/">
                            <span class="fa fa-home icon-wrap"></span>
                            <span class="mini-click-non">Home</span>
                        </a>
                    </li>
                    <!-- <li class="{{(Request::path() == 'trending') ? 'active':''}}">
                        <a href="/trending">
                            <span class="fa fa-fire icon-wrap"></span>
                            <span class="mini-click-non">Trending</span>
                        </a>
                    </li> -->
                    <li class="{{(Request::path() == 'subscriptions') ? 'active':''}}">
                        <a href="/subscriptions">
                            <span class="fa fa-play-circle icon-wrap"></span>
                            <span class="mini-click-non">Langanan</span>
                        </a>
                    </li>
                    <hr>
                    <li class="{{(Request::path() == 'library') ? 'active':''}}">
                        <a href="/library">
                            <span class="fa fa-folder icon-wrap"></span>
                            <span class="mini-click-non">Koleksi</span>
                        </a>
                    </li>
                    <li class="{{(Request::path() == 'feed/channel') ? 'active':''}}">
                        <a href="/feed/channel">
                            <span class="fa fa-list icon-wrap"></span>
                            <span class="mini-click-non">Channel</span>
                        </a>
                    </li>
                    <li class="{{(Request::path() == 'category') ? 'active':''}}">
                        <a class="has-arrow1" href="/category" id="menu_category1" href="/trending" aria-expanded="false">
                            <span class="fa fa-folder-o icon-wrap"></span>
                            <span class="mini-click-non">Kategori</span>
                        </a>
                    </li>
                    <hr>
                    @guest
                    <li id="li_category1">
                        <ul id="category-list" class="submenu-angle collapse" aria-expanded="false">
                            @foreach(get_active_categories() as $category)
                            <li>
                                <a title="{{$category->name}}" href="/trending?cat={{$category->slug}}">
                                    <span class="mini-sub-pro">{{$category->name}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    
                    <li class="{{(Request::path() == 'browse') ? 'active':''}}">
                        <a href="/browse">
                            <span class="fa fa-plus icon-wrap"></span>
                            <span class="mini-click-non">Explore</span>
                        </a>
                    </li>
                    <hr>
                    @else
                </ul>
                <ul class="metismenu show_more_menu" style="margin:0;">
                    @foreach(get_user()->subscribtions as $item)
                    <li class="channel">
                        <a title="{{$item->channel->name}}" href="{{route('web.channel.show', [$item->channel->slug])}}" style="padding: 0 13.5px;">
                            <img style="height: 20px;width: 20px;;margin-right: 14px;border-radius: 20px;" class="message-avatar" src="{{$item->channel->src_cover}}">
                            <small class="mini-sub-pro">{{$item->channel->name}}</small>
                        </a>
                    </li>
                    @endforeach
                    @if(get_user()->subscribtions->count()>2)
                    <a id="link_show" class="show-more channel" href="#"><span class="fa fa-chevron-down icon-wrap"></span> <small>Tampilkan {{get_user()->subscribtions->count()-2}} lagi</small></a>
                    <a id="link_hide" class="show-more channel" href="#"><span class="fa fa-chevron-up icon-wrap"></span> <small>Lebih sedikit</small></a>
                    @endif
                </ul>
                <ul class="metismenu" style="margin:0;">
                    <li class="{{(Request::path() == 'browse') ? 'active':''}}">
                        <a href="/browse">
                            <span class="fa fa-plus-circle icon-wrap"></span>
                            <span class="mini-click-non">Explore</span>
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
                    @endguest
                </ul>
                <div class="sidebar-header footer" style="max-width: 228px;padding:10px;text-align: left;">
                    @foreach(get_footer_pages() as $key => $page)
                    <a href="{{route('web.page.footer')}}#{{$page->slug}}" data-slug="#{{$page->slug}}" ><span class="mini-click-non footer-area">{{$page->title}}</span></a>
                    @endforeach
                </div>
                <div class="sidebar-header footer" style="padding:10px;">
                    <small class="mini-click-non footer-area" style="color: #a0a0a0;">© {{date('Y')}} iSeeTalk</small>
                </div>
            </nav>
        </div>
    </nav>
</div>
<div id="mySidenav" class="sidenav show-xs">
<a href="/" style="position: absolute;top: 0;margin-left: 20px;"><img src="https://iseetalk.com/img/logo/logosn.png" alt="iSeeTalk"></a>
    <a href="javascript:void(0)" class="closebtn" id="mobileMenuClose">&times;</a>
    <ul>
        <li class="{{(Request::path() == '/') ? 'active':''}}">
            <a href="/">
                <span class="fa fa-home icon-wrap"></span>
                <span class="mini-click-non">Home</span>
            </a>
        </li>
        <li class="{{(Request::path() == 'trending') ? 'active':''}}">
            <a href="/trending">
                <span class="fa fa-fire icon-wrap"></span>
                <span class="mini-click-non">Trending</span>
            </a>
        </li>
        <li class="{{(Request::path() == 'subscriptions') ? 'active':''}}">
            <a href="/subscriptions">
                <span class="fa fa-play icon-wrap"></span>
                <span class="mini-click-non">Playlist</span>
            </a>
        </li>
        <hr>
        <li class="{{(Request::path() == 'library') ? 'active':''}}">
            <a href="/library">
                <span class="fa fa-folder icon-wrap"></span>
                <span class="mini-click-non">Koleksi</span>
            </a>
        </li>
        <li class="{{(Request::path() == 'feed/channel') ? 'active':''}}">
            <a href="/feed/channel">
                <span class="fa fa-list icon-wrap"></span>
                <span class="mini-click-non">Channel</span>
            </a>
        </li>
        <hr>
        @guest
        <li>
            <a class="has-arrow" href="/trending" aria-expanded="false">
                <span class="fa fa-folder-o icon-wrap"></span>
                <span class="mini-click-non">Kategori</span>
            </a>
            <ul class="submenu-angle collapse" aria-expanded="false">
                @foreach(get_active_categories() as $category)
                <li><a title="{{$category->name}}" href="/trending?cat={{$category->slug}}"><span class="mini-sub-pro">{{$category->name}}</span></a></li>
                @endforeach
            </ul>
        </li>
        <li class="{{(Request::path() == 'browse') ? 'active':''}}">
            <a href="/browse">
                <span class="mini-click-non">Explore</span>
            </a>
        </li>
        <hr>
        @else
        
        @foreach(get_user()->subscribtions as $item)
        <li class="channel">
            <a title="{{$item->channel->name}}" href="{{route('web.channel.show', [$item->channel->slug])}}">
                <img style="height: 20px;width: 20px;;margin-right: 10px;border-radius: 20px;" class="message-avatar" src="{{$item->channel->src_cover}}"><span class="mini-sub-pro">{{$item->channel->name}}</span>
            </a>
        </li>
        @endforeach
        <li class="{{(Request::path() == 'browse') ? 'active':''}}">
            <a href="/browse">
                <span class="mini-click-non">Explore</span>
            </a>
        </li>
        <hr>
        <li class="{{(Request::path() == 'setting') ? 'active':''}}">
            <a href="{{route('web.setting.index')}}">
                <span class="fa fa-cog icon-wrap"></span>
                <span class="mini-click-non">Pengaturan</span>
            </a>
        </li>
        <li>
            <a href="{{route('web.channel.index')}}"><span class="fa fa-caret-square-o-down icon-wrap"></span> <span class="mini-click-non">Channel saya</span></a>
        </li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="fa fa-power-off icon-wrap"></span> <span class="mini-click-non">{{ __('Logout') }}</span>
            </a>
        </li>
        <hr>
        @endguest
        
        
    </ul>
    <div class="sidebar-header footer" style="text-align: left;margin-left:30px">
        @foreach(get_footer_pages() as $key => $page)
            <a href="{{route('web.page.footer')}}#{{$page->slug}}" data-slug="#{{$page->slug}}" ><span class="mini-click-non footer-area">{{$page->title}}</span></a>
        @endforeach
    </div>
    <div class="sidebar-header footer" style="padding:10px;">
        <small class="mini-click-non footer-area" style="color: #fff;">© {{date('Y')}} iSeeTalk</small>
    </div>
</div>
<!-- End Left menu area -->