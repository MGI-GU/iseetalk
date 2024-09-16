<nav class="sidebar-nav left-sidebar-menu-pro">
    <ul class="metismenu" id="menu1">
        @if($audio->parent)
        <li>
            <a class="btn btn-default" href="{{route('admin.audio.show', $audio->parent->format_id)}}">
                <span class="mini-click-non">Published Details</span>
            </a>
        </li>
        @endif
        @if($audio->edition)
        <li>
            <a class="btn btn-default" href="{{route('admin.audio.show', $audio->edition->format_id)}}">
                <span class="mini-click-non">Edition Details</span>
            </a>
        </li>
        @endif

        <li>
            <a class="btn btn-default {{strpos(Request::path(), $audio->format_id) !== false ? 'active':''}}" href="{{route('admin.audio.show', $audio->format_id)}}">
                <span class="mini-click-non">Details</span>
            </a>
        </li>
        <li>
            <a class="btn btn-default {{strpos(Request::path(), 'analytic') !== false ? 'active':''}}" href="{{route('admin.audio.analytic', $audio->parent?$audio->parent->id:$audio->id)}}">
                <span class="mini-click-non">Analitic</span>
            </a>
        </li>
        <li>
            <a class="btn btn-default {{strpos(Request::path(), 'comment') !== false ? 'active':''}}" href="{{route('admin.audio.comment', $audio->parent?$audio->parent->id:$audio->id)}}">
                <span class="mini-click-non">Comment</span>
            </a>
        </li>
        @if(is_admin(auth()->user())!=='false')
        <li>
            <a class="btn {{$audio->status=='review'?'btn-warning':'btn-default'}} {{strpos(Request::path(), 'audit') !== false ? 'active':''}}" href="{{route('admin.audit.edit', $audio->audit->id ?? 0)}}?f=audio">
                <span class="mini-click-non">Audit</span>
            </a>
        </li>
        @endif
    </ul>
</nav>