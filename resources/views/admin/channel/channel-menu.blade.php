<nav class="sidebar-nav left-sidebar-menu-pro">
    <ul class="metismenu" id="menu1">
        @if($channel->parent)
        <li>
            <a class="btn btn-default" href="{{route('admin.channel.show', $channel->parent->format_id)}}">
                <span class="mini-click-non">Published Details</span>
            </a>
        </li>
        @endif
        @if($channel->edition)
        <li>
            <a class="btn btn-default" href="{{route('admin.channel.show', $channel->edition->format_id)}}">
                <span class="mini-click-non">Edition Details</span>
            </a>
        </li>
        @endif
        <li class="">
            <a class="btn btn-default {{strpos(Request::path(), 'project/channel') !== false ? 'active':''}}" href="/admin/project/channel/{{$channel->format_id}}">
                <span class="mini-click-non">Details</span>
            </a>
        </li>
        <li class="">
            <a class="btn btn-default {{strpos(Request::path(), 'analytic') !== false ? 'active':''}}" href="/admin/channel/{{$channel->id}}/analytic">
                <span class="mini-click-non">Analitic</span>
            </a>
        </li>
        @if(is_admin(auth()->user())!='false' || check_account('admin'))
        <li class="">
            <a class="btn {{$channel->status=='approve'?'btn-warning':'btn-default'}} {{strpos(Request::path(), 'audit') !== false ? 'active':''}}" href="{{route('admin.audit.edit', $channel->audit->id ?? 0)}}?f=channel">
                <span class="mini-click-non">Audit</span>
            </a>
        </li>
        @endif
    </ul>
</nav>