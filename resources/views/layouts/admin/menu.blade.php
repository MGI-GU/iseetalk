<!-- Start Left menu area -->
<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header" style="padding-bottom: 0px;border-bottom: solid 1px #ececec;">
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
                <ul class="metismenu" id="menu1" style="margin-top: 0px;">
                    @foreach(auth()->user()->main_role->role->permission_by_model as $role)
                        @if($role->model == 'image')
                        @elseif($role->model == '') 
                        @else
                        <li class="{{(Request::path() == 'admin') ? 'active':''}}">
                            <a href="{{route('admin.'.$role->model.'.index')}}">
                                <span class="fa fa-{{$role->model}} icon-wrap icon-border icon-border"></span>
                                <span class="mini-click-non text-capitalize">{{$role->model}}</span>
                            </a>
                        </li>
                        @endif
                    @endforeach
                    
                </ul>
            </nav>
        </div>
    </nav>
</div>
<!-- End Left menu area -->