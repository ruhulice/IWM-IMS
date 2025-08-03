<style>
    .div-content{
        padding: 0 !important;
    }
    .div-content li{
        padding: 6px;
        padding-left: 20px;
        padding-right: 10px;
    }
    .nav-main hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid #70707054;
    }
    .content-side-user {
        height: auto;
        background-color: #f6f7f9;
        overflow: hidden;
    }
    .menu-icon {
        position: absolute;
        top: 30%;
        right: auto;
        left: 18px;
        width: 14px;
        height: 13px;
    }
    .nav-main a.no-bar.nav-submenu::before,
    .nav-main a.no-bar.nav-submenu::after {
        content: unset !important;
    }
    .nav-main a.nav-submenu {
        cursor: pointer;
    }
</style>

<ul class="nav-main " id="nav-bar-land">
    <hr>

    @foreach($data['menus'] as $menu)
        @if($menu->checkMenuPermission($menu->menu_url))
            <li class="">
                <a class="nav-submenu @if(!count($menu->childs)) no-bar @endif"
                   @if(count($menu->childs)) data-toggle="nav-submenu" @endif
                   @if(!count($menu->childs)) href="{{ url($menu->menu_url) }}" @endif>

                    @if($menu->icon)
                        <i class="{{ $menu->icon }}"></i>
                    @endif
                    <span class="sidebar-mini-hide">
                        {{ $menu->name }}
                    </span>
                </a>
                <ul>
                    @if($menu->childs && $menu->childs->count()>0)
                        @foreach($menu->childs as $c_menu)
                            @if($c_menu->checkMenuPermission($c_menu->menu_url))
                                <li>
                                    <a class="{{ request()->is($c_menu->menu_url) ? ' active' : '' }}" href="{{ url($c_menu->menu_url) }}">
                                        {{ $c_menu->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </li>
        @endif
    @endforeach

    <hr>
    <li class="{{ request()->is('admin/*') ? ' open' : '' }}">
        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
            <i class="fa fa-desktop"></i><span class="sidebar-mini-hide"> IT Equipments</span>
        </a>
        <ul>
            <li>
                 <a class="{{ request()->is('admin/memos') ? ' active' : '' }}" href="{{ route('admin.memos.index') }}">Meno Management</a>
            </li>
            <li>
               <a class="{{ request()->is('admin/requisitions') ? ' active' : '' }}" href="{{ route('admin.requisitions.index') }}">Requisition Management</a>
            </li>
           <li>
                <a class="{{ request()->is('admin/comment') ? ' active' : '' }}" href="{{ route('admin.comment.index') }}">Approval Management</a>
            </li>
        </ul>
    </li>
    <hr>
    <li class="{{ request()->is('feedback-list') ? ' open' : '' }}">
        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
            <i class="fa fa-recycle"></i><span class="sidebar-mini-hide"> Feedback Management</span>
        </a>
        <ul>
            <li>
                <a class="{{ request()->is('feedback-list') ? ' active' : '' }}" href="{{ url('feedback-list') }}">
                    User Feedbacks
                </a>
            </li>
            {{--<li>
                <a class="{{ request()->is('comments') ? ' active' : '' }}" href="{{ route('comments.index') }}">
                    System Comments
                </a>
            </li>--}}
        </ul>
    </li>
    <hr>
    <li class="{{ request()->is('admin/*') ? ' open' : '' }}">
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-cogs"></i><span class="sidebar-mini-hide">Settings</span></a>
        <ul>
            <li>
                <a class="{{ request()->is('admin/users') ? ' active' : '' }}" href="{{ route('admin.users.index') }}">User Management</a>
            </li>
            <li>
                <a class="{{ request()->is('admin/user-roles') ? ' active' : '' }}" href="{{ route('admin.user-roles.index') }}">Role Management</a>
            </li>
            <li>
                <a class="{{ request()->is('admin/menus/index') ? ' active' : '' }}" href="{{ route('admin.menus.index') }}">Menu Management</a>
            </li>
            <li>
                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><span class="sidebar-mini-hide">Permission Management</span></a>
                <ul>
                    <li>
                        <a class="{{ request()->is('admin/menu-role-permission') ? ' active' : '' }}" href="{{ url('admin/menu-role-permission') }}">Menu Permission</a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/permissions') ? ' active' : '' }}" href="{{ url('admin/permissions') }}">Permission List</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="{{ request()->is('admin/sms-configuration') ? ' active' : '' }}" href="{{ url('admin/sms-configuration') }}">SMS Configuration</a>
            </li>
        </ul>
    </li>

</ul>
