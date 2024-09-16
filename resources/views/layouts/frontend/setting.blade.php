<nav class="hidden-sm hidden-xs">
    <div class="left-custom-menu-adp-wrap comment-scrollbar">
        <nav class="sidebar-nav left-sidebar-menu-pro">
            <ul class="metismenu" id="menu1">
                <li><a href="#">
                        <span class="mini-click-non"></span>
                    </a></li>
                <li >
                    <a href="#">
                        <span class="mini-click-non"><b>PENGATURAN</b></span>
                    </a>
                </li>
                <li class="{{(Request::path() == 'setting') ? 'active':''}}">
                    <a href="{{route('web.setting.index')}}">
                        <span class="mini-click-non">Akun</span>
                    </a>
                </li>
                <li class="{{(Request::path() == 'setting/notification') ? 'active':''}}">
                    <a href="{{route('web.setting.show', ['notification'])}}">
                        <span class="mini-click-non">Notifikasi</span>
                    </a>
                </li>
                <li class="{{(Request::path() == 'setting/sharing') ? 'active':''}}">
                    <a href="{{route('web.setting.show', ['sharing'])}}">
                        <span class="mini-click-non">Koneksivitas</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{route('web.setting.show', ['billing'])}}">
                        <span class="mini-click-non">Billing & Payment</span>
                    </a>
                </li> -->
                
                
            </ul>
        </nav>
    </div>
</nav>

@if(Request::path() == 'setting/notification' || Request::path() == 'setting/sharing')
<ul id="myTabedu1" class="tab-review-design">
    <li class="{{(Request::path() == 'setting') ? 'active':''}} hidden-lg hidden-md"><a href="{{route('web.setting.index')}}">Informasi Akun</a></li>
    <li class="{{(Request::path() == 'setting/notification') ? 'active':''}} hidden-lg hidden-md">
        <a href="{{route('web.setting.show', ['notification'])}}">
            Notifikasi
        </a>
    </li>
    <li class="{{(Request::path() == 'setting/sharing') ? 'active':''}} hidden-lg hidden-md">
        <a href="{{route('web.setting.show', ['sharing'])}}">
            Koneksivitas
        </a>
    </li>
</ul>
@endif