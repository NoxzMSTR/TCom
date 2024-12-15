<div class="d-none d-xl-block bg-primary">
    <div class="container">
        <div class="row align-items-stretch min-height-50">
            <!-- Vertical Menu -->
            <div class="col-md-auto d-none d-xl-flex align-items-end">
                <div class="max-width-270 min-width-270">
                    <!-- Basics Accordion -->
                    <div id="basicsAccordion">
                        <!-- Card -->
                        <div class="card border-0 rounded-0">
                            <div class="card-header bg-primary rounded-0 card-collapse border-0" id="basicsHeadingOne">
                                <button type="button"
                                    class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90"
                                    data-toggle="collapse" data-target="#basicsCollapseOne" aria-expanded="true"
                                    aria-controls="basicsCollapseOne">
                                    <span class="pl-1 text-gray-90">Shop By Category</span>
                                    <span class="text-gray-90 ml-3">
                                        <span class="ec ec-arrow-down-search"></span>
                                    </span>
                                </button>
                            </div>
                            <div id="basicsCollapseOne" class="collapse vertical-menu v1"
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
                                                                    style="min-height: 300px; overflow-y: scroll;"
                                                                    aria-labelledby="basicMegaMenu">
                                                                    @if ($category['thumbnail'])
                                                                        <div class="vmm-bg">
                                                                            <img class="img-fluid" style="width: 210px;"
                                                                                src="{{ $category['thumbnail'] }}"
                                                                                alt="Image Description">
                                                                        </div>
                                                                    @endif

                                                                    <div class="row u-header__mega-menu-wrapper">
                                                                        <div class="col mb-3 mb-sm-0">
                                                                            <span
                                                                                class="u-header__sub-menu-title">{{ $category['name'] }}</span>
                                                                            <ul
                                                                                class="u-header__sub-menu-nav-group mb-3">
                                                                                @foreach ($category['descendants'] as $key => $subCategories)
                                                                                    <li><a class="nav-link u-header__sub-menu-nav-link"
                                                                                            href="#">{{ $subCategories['name'] }}</a>
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
                                                                                    @else
                                                                                    @endif
                                                                                @endforeach
                                                                                <li>
                                                                                    <a class="nav-link u-header__sub-menu-nav-link u-nav-divider border-top pt-2 flex-column align-items-start"
                                                                                        href="#">
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
                                                                <a href="#"
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
            <!-- Search bar -->
            <div class="col align-self-center">
                <!-- Search-Form -->
                <form class="js-focus-state">
                    <label class="sr-only" for="searchProduct">Search</label>
                    <div class="input-group">
                        <input type="email"
                            class="form-control py-2 pl-5 font-size-15 border-0 height-40 rounded-left-pill"
                            name="email" id="searchProduct" placeholder="Search for Products"
                            aria-label="Search for Products" aria-describedby="searchProduct1" required>
                        <div class="input-group-append">
                            <button class="btn btn-dark height-40 py-2 px-3 rounded-right-pill" type="button"
                                id="searchProduct1">
                                <span class="ec ec-search font-size-24"></span>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- End Search-Form -->
            </div>
            <!-- End Search bar -->
            <!-- Header Icons -->
            <div class="col-md-auto align-self-center">
                <div class="d-flex">
                    <ul class="d-flex list-unstyled mb-0">
                        {{-- <li class="col"><a href="../shop/compare.html" class="text-gray-90" data-toggle="tooltip"
                                data-placement="top" title="Compare"><i class="font-size-22 ec ec-compare"></i></a>
                        </li>
                        <li class="col"><a href="../shop/wishlist.html" class="text-gray-90" data-toggle="tooltip"
                                data-placement="top" title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a>
                        </li> --}}
                        @livewire('public.cart.global-cart', ['placement' => 'content-sidebar'])
                    </ul>
                </div>
            </div>
            <!-- End Header Icons -->
        </div>
    </div>
</div>
