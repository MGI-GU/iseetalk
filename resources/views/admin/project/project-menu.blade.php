<nav class="sidebar-nav left-sidebar-menu-pro">
    <ul class="metismenu" id="menu1">
        <li class="{{strpos(Request::path(), 'detail') !== false ? 'active':''}}">
            <a class="btn btn-default" href="/admin/project/{{$project->format_id}}/detail">
                <span class="mini-click-non">Details</span>
            </a>
        </li>
        <!-- <li class="{{strpos(Request::path(), 'analytic') !== false ? 'active':''}}">
            <a href="/admin/project/{{$project->id}}/analytic">
                <span class="mini-click-non">Analitic</span>
            </a>
        </li> -->
    </ul>
</nav>