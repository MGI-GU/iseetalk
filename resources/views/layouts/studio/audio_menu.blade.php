<nav class="sidebar-nav left-sidebar-menu-pro">
    <ul class="metismenu" id="menu1">
        @if($audio->parent)
            <li>
                <a class="btn btn-default" href="{{route('studio.audio.show', $audio->parent->slug)}}">
                    <span class="mini-click-non">Published Details</span>
                </a>
            </li>
        @endif
        @if($audio->edition)
            <li>
                <a class="btn btn-default" href="{{route('studio.audio.show', $audio->edition->slug)}}">
                    <span class="mini-click-non">Edition Details</span>
                </a>
            </li>
        @endif
        <li class="">
            <a class="btn btn-default {{strpos(Request::path(), 'studio/audio/') !== false ? 'active':''}}" href="/studio/audio/{{$audio->slug}}">
                <span class="mini-click-non">Details</span>
            </a>
        </li>
        <li class="">
            <a class="btn btn-default {{strpos(Request::path(), 'studio/analytic') !== false ? 'active':''}}" href="{{route('studio.analytic.audio', [$audio->slug ?? 'none'])}}">
                <span class="mini-click-non">Analisa</span>
            </a>
        </li>
        <li class="">
            <a class="btn btn-default {{strpos(Request::path(), 'comment/comments') !== false ? 'active':''}}" href="{{route('studio.audio.comment', [$audio->slug ?? 'none'])}}">
                <span class="mini-click-non">Comment ({{$audio->comment_number}})</span>
            </a>
        </li>
        <!-- <li>
            <a href="/studio/audio/1/editor">
                <span class="mini-click-non">Editor</span>
            </a>
        </li> -->
        
        
    </ul>
</nav>