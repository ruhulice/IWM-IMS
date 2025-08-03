@php
    $req_uri    = Request::getRequestUri();
    $roles      = App\Models\Role::findOrFail(session()->get('role_id'));
    $auths      = $roles->authorization;
    $m_array    = unserialize($auths);
    $menus      = App\Models\Menu::where('parent_id', 0)->where('status_id', 1)->whereIn('id', $m_array)->where('id', '!=', 1)->get();
@endphp
<ul class="nav-main">
    <li>
        <a class="{{ request()->is('home') ? ' active' : '' }}" href="{{ url('/home') }}">
            <i class="si si-cup"></i><span class="sidebar-mini-hide">DDMS</span>
        </a>
    </li>
    @foreach($menus as $key=>$menu)
        @php
            $url_result  = unserialize($menu->url_link);
            if(in_array($req_uri, $url_result)){
                $send_url    = ltrim($req_uri, '/');
            }else{
                $send_url    = $menu->menu_url;
            }
        @endphp
        {{--<li class="nav-main-heading">
                <span class="sidebar-mini-visible">VR</span><span class="sidebar-mini-hidden">{{ $menu->name }}</span>
		</li>--}}
		<li class="{{ request()->is($send_url) ? ' open' : '' }}">
			<a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="{{ $menu->icon }}"></i><span class="sidebar-mini-hide">{{ $menu->name }}</span></a>
			@if(count($menu->childs))
				<ul>
					@foreach($menu->childs as $child)
						@if(in_array($child->id, $m_array))
							@php $url_link = unserialize($child->url_link); @endphp
							<li>
								<a class="{{ request()->is($url_link[0]) ? ' active' : '' }}" href="{{ route($child->menu_url) }}">{{ $child->name }}</a>
							</li>
						@endif
					@endforeach
				</ul>
			@endif
		</li>
    @endforeach
</ul>
