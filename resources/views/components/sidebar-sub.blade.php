<div class="col mb-3 mb-sm-0">

    <ul class="u-header__sub-menu-nav-group mb-3">
        @forelse ($subCategories['descendants'] as $key => $subCat)
            <li><a class="nav-link u-header__sub-menu-nav-link"
                    href="{{ route('public.shop', ['category' => $subCat['name']]) }}">{{ $subCat['name'] }}</a></li>
            @if (count($subCat['descendants']))
                <li>@include('components.sidebar-sub', ['subCategories' => $subCat])</li>
            @endif
        @empty
            <li><a class="nav-link u-header__sub-menu-nav-link"
                    href="{{ route('public.shop', ['category' => $subCategories['name']]) }}">{{ $subCategories['name'] }}</a>
            </li>
        @endforelse
    </ul>
</div>
