<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
    <i class="fa fa-bell" aria-hidden="true"></i>
    @if(get_list_notification()->count()>0)
    <span class="indicator-nt"></span>
    @endif
</a>
<div role="menu" class="notification-author dropdown-menu animated zoomIn">
    <div class="notification-single-top">
        <p>
            <span class="mg-10">Notifications</span>
            <span class="pull-right" style="margin: 0px 12px;"><a href="https://iseetalk.com/setting/notification"><i class="fa fa-cog icon-wrap"></i></a></span>
        </p>
    </div>
    <ul class="notification-menu">
        @foreach(get_list_notification() as $notice)
            @if(@$notice->notification->page->slug)
            <li style="width:100%">
                <a target="_blank" href="{{route('web.page', [@$notice->notification->page->slug ?? 0])}}">
                    <div class="notification-content">
                        <span class="notification-date">{{@$notice->notification->updated_at->format('d M Y') ?? ''}}</span>
                        <h2>{{@$notice->notification->page->author->name ?? ''}}</h2>
                        <p>{{@$notice->notification->data ?? ''}}</p>
                    </div>
                </a>
            </li>
            @endif
        @endforeach
    </ul>
    <!-- <div class="notification-view">
        <a href="#">Lihat semua notifikasi</a>
    </div> -->
</div>
