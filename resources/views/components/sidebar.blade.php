<div class="d-none d-xl-block container">
    <div class="row">
        <!-- Vertical Menu -->
        <div class="col-md-auto d-none d-xl-block">
            <div class="max-width-270 min-width-270">
                <!-- Basics Accordion -->
                <div id="basicsAccordion">
                    <!-- Card -->
                    <div class="card border-0">
                        <div class="card-header card-collapse border-0" id="basicsHeadingOne">
                            <button type="button"
                                class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90"
                                data-toggle="collapse" data-target="#basicsCollapseOne" aria-expanded="true"
                                aria-controls="basicsCollapseOne">
                                <span class="ml-0 text-gray-90 mr-2">
                                    <span class="fa fa-list-ul"></span>
                                </span>
                                <span class="pl-1 text-gray-90">Menus</span>
                            </button>
                        </div>
                        <div id="basicsCollapseOne" class="collapse show vertical-menu"
                            aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion">
                            <div class="card-body p-0">
                                <nav
                                    class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                    <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                        <ul class="navbar-nav u-header__navbar-nav">
                                            @foreach ($categories as $key => $category)
                                                @if ($category['parent'] == 0)
                                                    @if (count($category['descendants']))
                                                        <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                            data-event="hover" data-animation-in="slideInUp"
                                                            data-animation-out="fadeOut" data-position="left">
                                                            <a id="basicMegaMenu"
                                                                class="nav-link u-header__nav-link u-header__nav-link-toggle"
                                                                href="javascript:;" aria-haspopup="true"
                                                                aria-expanded="false">{{ $category['name'] }}</a>

                                                            <!-- Nav Item - Mega Menu -->
                                                            <div class="hs-mega-menu vmm-tfw u-header__sub-menu"
                                                                aria-labelledby="basicMegaMenu">
                                                                @if ($category['thumbnail'])
                                                                    <div class="vmm-bg">
                                                                        <img class="img-fluid" style="width: 210px;"
                                                                            src="{{ $category['thumbnail'] }}"
                                                                            alt="Image Description">
                                                                    </div>
                                                                @endif

                                                                <div class="row u-header__mega-menu-wrapper"
                                                                    style="padding-right: 12rem;">
                                                                    <div class="col mb-3 mb-sm-0">
                                                                        <span
                                                                            class="u-header__sub-menu-title">{{ $category['name'] }}</span>
                                                                        <ul
                                                                            class="u-header__sub-menu-nav-group d-flex justify-content-between mb-3">
                                                                            @foreach ($category['descendants'] as $key => $subCategories)
                                                                                <ul
                                                                                    class="u-header__sub-menu-nav-group mb-3">
                                                                                    <li><a class="nav-link u-header__sub-menu-nav-link"
                                                                                            href="{{ route('public.shop', ['category' => $subCategories['name']]) }}">{{ $subCategories['name'] }}</a>
                                                                                    </li>
                                                                                    @if (count($subCategories['descendants']))
                                                                                        <li>
                                                                                            @include(
                                                                                                'components.sidebar-sub',
                                                                                                [
                                                                                                    'subCategories' => $subCategories,
                                                                                                ]
                                                                                            )
                                                                                        </li>
                                                                                    @endif
                                                                                </ul>
                                                                            @endforeach

                                                                        </ul>
                                                                        <ul class="u-header__sub-menu-nav-group mb-3">
                                                                            <li>
                                                                                <a class="nav-link u-header__sub-menu-nav-link u-nav-divider border-top pt-2 flex-column align-items-start"
                                                                                    href="{{ route('public.shop', ['category' => $category['name']]) }}">
                                                                                    <div class="">All
                                                                                        {{ $category['name'] }}
                                                                                    </div>

                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- End Nav Item - Mega Menu -->
                                                        </li>
                                                    @else
                                                        <li class="nav-item u-header__nav-item" data-event="hover"
                                                            data-position="left">
                                                            <a href="{{ route('public.shop', ['category' => $category['name']]) }}"
                                                                class="nav-link u-header__nav-link">{{ $category['name'] }}</a>
                                                        </li>
                                                    @endif
                                                @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <!-- End Basics Accordion -->
            </div>
        </div>
        <!-- End Vertical Menu -->
        @if (url()->current() == route('public.home'))
            <!-- Secondary Menu -->
            <div class="col">
                <!-- Nav -->
                <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                    <!-- Navigation -->
                    <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                        <ul class="navbar-nav u-header__navbar-nav">

                            <!-- Featured Brands --> <!-- Featured Brands -->
                            <li class="nav-item u-header__nav-item">
                                <a class="nav-link u-header__nav-link text-sale" href="#featuredProducts"
                                    aria-haspopup="true" aria-expanded="false" aria-labelledby="pagesSubMenu">Featured
                                    Products</a>
                            </li>
                            <!-- End Featured Brands -->
                            <li class="nav-item u-header__nav-item">
                                <a class="nav-link u-header__nav-link" href="#featuredCategories" aria-haspopup="true"
                                    aria-expanded="false" aria-labelledby="pagesSubMenu">Featured Categories</a>
                            </li>
                            <!-- End Featured Brands -->

                            <!-- Trending Styles -->
                            <li class="nav-item u-header__nav-item">
                                <a class="nav-link u-header__nav-link" href="#featuredBrands" aria-haspopup="true"
                                    aria-expanded="false" aria-labelledby="blogSubMenu">Featured Brands</a>
                            </li>
                            <!-- End Trending Styles -->

                            <!-- Gift Cards -->
                            <li class="nav-item u-header__nav-item">
                                <a class="nav-link u-header__nav-link" href="#recentViewed" aria-haspopup="true"
                                    aria-expanded="false">Recently Viewed </a>
                            </li>
                            <!-- End Gift Cards -->

                            <!-- Button -->
                            <li class="nav-item u-header__nav-last-item">
                                <a class="nav-link u-header__nav-link text-sale" href="{{ route('public.shop') }}"
                                    target="_blank">
                                    Shop
                                </a>
                            </li>
                            <!-- End Button -->
                        </ul>
                    </div>
                    <!-- End Navigation -->
                </nav>
                <!-- End Nav -->
            </div>
            <!-- End Secondary Menu -->
        @endif

    </div>
</div>
