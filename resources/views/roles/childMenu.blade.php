<ul>
    @foreach($childs as $child)
        @php
            $check_css = 'fa-square-o';
            $check_new = '';
            $swt_css   = 'off';
        @endphp
        @if(in_array($child->id, $menu_array))
            @php
                $check_css = 'fa-check-square-o';
                $check_new = 'checked';
                $swt_css   = 'on';
            @endphp
        @endif
        <li>
            <input type="checkbox" name="authorization[]" class="authNavList"
                   id="auth-{{ $child->id }}" value="{{ $child->id }}" style="display:none" {!! $check_new !!}>
            <i class="checkbox fa {{ $check_css }} fa-lg" switch="{{ $swt_css }}" data-val="{{ $child->id }}"></i>
            <label class="nav_title">{{ $child->name }}</label>
            @if(count($child->childs))
                @include('roles.childMenu',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
