<div class="col mb-3 mb-sm-0">
    <ul class="u-header__sub-menu-nav-group mb-3 d-flex justify-content-between">
        @forelse ($subCategories['descendants'] as $key => $subCat)
            <ul class="u-header__sub-menu-nav-group mb-3">
                <li><a class="nav-link u-header__sub-menu-nav-link"
                        href="{{ route('public.shop', ['category' => $subCat['name']]) }}">{{ $subCat['name'] }}</a></li>
                @if (count($subCat['descendants']))
                    <li>@include('components.sidebar-sub', ['subCategories' => $subCat])</li>
                @endif
            </ul>
        @empty
        @endforelse
    </ul>
    @if (count($subCategories['descendants']) == 0)
        <ul class="u-header__sub-menu-nav-group mb-3">
            <li><a class="nav-link u-header__sub-menu-nav-link"
                    href="{{ route('public.shop', ['category' => $subCategories['name']]) }}">{{ $subCategories['name'] }}</a>
            </li>
        </ul>
    @endif

</div>
