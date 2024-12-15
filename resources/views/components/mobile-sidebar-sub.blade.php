@if (isset($list))
    <ul id="headerSidebarList" class="u-header-collapse__nav">
        <li class=""><a class="u-header-collapse__submenu-nav-link" href="#">All
                {{ $categories['name'] }}</a>
        </li>
        @foreach ($categories['descendants'] as $key => $value)
            @if (count($value['descendants']))
                <ul id="headerSidebarList" class="u-header-collapse__nav">
                    @include('components.mobile-sidebar-sub', [
                        'categories' => $value,
                        'list' => true,
                    ])
                </ul>
            @else
                <li class=""><a class="u-header-collapse__submenu-nav-link" href="#">{{ $value['name'] }}</a>
                </li>
            @endif
        @endforeach
    </ul>
@else
    <li class="u-has-submenu u-header-collapse__submenu" id="subheaderSidebarContent">
        <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;"
            data-target="#menu_{{ md5($categories['name']) }}" role="button" data-toggle="collapse"
            aria-expanded="true" aria-controls="menu_{{ md5($categories['name']) }}">
            {{ $categories['name'] }}
        </a>

        <div id="menu_{{ md5($categories['name']) }}" class="accordion-collapse collapse"
            data-parent="#subheaderSidebarContent">
            <ul class="u-header-collapse__nav-list">
                <li class=""><a class="u-header-collapse__submenu-nav-link" href="#">All
                        {{ $categories['name'] }}</a>
                </li>
                @foreach ($categories['descendants'] as $key => $value)
                    @if (count($value['descendants']))
                        <ul id="headerSidebarList" class="u-header-collapse__nav">
                            @include('components.mobile-sidebar-sub', [
                                'categories' => $value,
                                'list' => true,
                            ])
                        </ul>
                    @else
                        <li class=""><a class="u-header-collapse__submenu-nav-link"
                                href="#">{{ $value['name'] }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </li>

@endif
