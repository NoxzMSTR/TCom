<header id="header" class="u-header u-header-left-aligned-nav">
    <div class="u-header__section">
        <!-- Topbar -->
        <div class="u-header-topbar py-2 d-none d-xl-block">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="topbar-left">
                        <span class="text-gray-110 font-size-13 u-header-topbar__nav-link">Welcome to
                            {{ isset(system_config['name']['value']) ? system_config['name']['value'] : '-' }}</span>
                    </div>
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">

                            <li
                                class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="../shop/track-your-order.html" class="u-header-topbar__nav-link"><i
                                        class="ec ec-transport mr-1"></i> Track Your Order</a>
                            </li>

                            <li
                                class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <!-- Account Sidebar Toggle Button -->
                                @if (Auth::check())
                                    <a class="font-weight-bold text-primary u-header-topbar__nav-link"
                                        href="{{ route('public.account') }}">
                                        <i class="ec ec-user mr-1"></i>{{ Auth::user()->name }}
                                    </a>
                                    <span class="text-gray-50"> - </span>
                                    <a href="{{ route('public.logout') }}" class="u-header-topbar__nav-link">Sign out
                                    </a>
                                @else
                                    <!-- Account Sidebar Toggle Button -->
                                    <a id="sidebarNavToggler" href="javascript:;" role="button" wire:ignore.self
                                        class="u-header-topbar__nav-link" aria-controls="sidebarContent"
                                        aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                        data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent"
                                        data-unfold-type="css-animation" data-unfold-animation-in="fadeInRight"
                                        data-unfold-animation-out="fadeOutRight" data-unfold-duration="500">
                                        <i class="ec ec-user mr-1"></i> Register <span class="text-gray-50">or</span>
                                        Sign
                                        in
                                    </a>
                                    <!-- End Account Sidebar Toggle Button -->
                                @endif
                                <!-- End Account Sidebar Toggle Button -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Logo and Menu -->
        <div class="py-2 py-xl-4">
            <div class="container my-0dot5 my-xl-0">
                <div class="row align-items-center">
                    <!-- Logo-offcanvas-menu -->
                    <div class="col-auto">
                        <!-- Nav -->
                        <nav
                            class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                            <!-- Logo -->
                            @php
                                $logoLight = isset(system_config['logoLight']['value'])
                                    ? system_config['logoLight']['value']
                                    : asset('mAssets/media/logos/logo.jpg');
                                $logoDark = isset(system_config['logoDark']['value'])
                                    ? system_config['logoDark']['value']
                                    : asset('mAssets/media/logos/logo.jpg');
                            @endphp
                            <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center"
                                href="{{ route('public.home') }}" aria-label="Electro">
                                <img alt="Logo" src="{{ $logoLight }}" class="h-35px theme-light-show"
                                    style="width:110px" />
                            </a>
                            <!-- End Logo -->

                            <!-- Fullscreen Toggle Button -->
                            <button id="sidebarHeaderInvokerMenu" type="button"
                                class="navbar-toggler d-block d-xl-none btn u-hamburger mr-3 mr-xl-0"
                                aria-controls="sidebarHeader" aria-haspopup="true" aria-expanded="false"
                                data-unfold-event="click" data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft"
                                data-unfold-duration="500">
                                <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                    <span class="u-hamburger__inner"></span>
                                </span>
                            </button>
                            <!-- End Fullscreen Toggle Button -->
                        </nav>
                        <!-- End Nav -->

                        <!-- ========== HEADER SIDEBAR ========== -->
                        @include('components.mobile-sidebar')
                        <!-- ========== END HEADER SIDEBAR ========== -->
                    </div>
                    <!-- End Logo-offcanvas-menu -->
                    <!-- Primary Menu -->
                    <div class="col d-none d-xl-block">
                        <!-- Nav -->
                        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                            <!-- Navigation -->
                            <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                <ul class="navbar-nav u-header__navbar-nav">
                                    <!-- Home -->

                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link"
                                            href="{{ route('public.home') }}">Home</a>
                                    </li>
                                    <!-- End Home -->

                                    <!-- Pages -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link"
                                            href="{{ route('public.shop') }}">Shop</a>
                                    </li>
                                    <!-- End Pages -->

                                    <!-- About us -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="../home/about.html">About us</a>
                                    </li>
                                    <!-- End About us -->


                                    <!-- Contact Us -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="../home/contact-v1.html">Contact
                                            Us</a>
                                    </li>
                                    <!-- End Contact Us -->
                                </ul>
                            </div>
                            <!-- End Navigation -->
                        </nav>
                        <!-- End Nav -->
                    </div>
                    <!-- End Primary Menu -->
                    <!-- Customer Care -->
                    <div class="d-none d-xl-block col-md-auto">
                        <div class="d-flex">
                            <i class="ec ec-support font-size-50 text-primary"></i>
                            <div class="ml-2">
                                <div class="phone">
                                    <strong>Support</strong> <a
                                        href="tel:{{ isset(system_config['phone']['value']) ? system_config['phone']['value'] : '-' }}"
                                        class="text-gray-90">{{ isset(system_config['phone']['value']) ? system_config['phone']['value'] : '-' }}</a>
                                </div>
                                <div class="email">
                                    E-mail: <a
                                        href="mailto:{{ isset(system_config['email']['value']) ? system_config['email']['value'] : '-' }}subject=Help Need"
                                        class="text-gray-90">{{ isset(system_config['email']['value']) ? system_config['email']['value'] : '-' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customer Care -->
                    <!-- Header Icons -->
                    <div class="d-xl-none col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                        <div class="d-inline-flex">
                            <ul class="d-flex list-unstyled mb-0 align-items-center">
                                <!-- Search -->
                                <li class="col d-xl-none px-2 px-sm-3 position-static">
                                    <a id="searchClassicInvoker"
                                        class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary"
                                        href="javascript:;" role="button" data-toggle="tooltip" data-placement="top"
                                        title="Search" aria-controls="searchClassic" aria-haspopup="true"
                                        aria-expanded="false" data-unfold-target="#searchClassic"
                                        data-unfold-type="css-animation" data-unfold-duration="300"
                                        data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                                        data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                        <span class="ec ec-search"></span>
                                    </a>

                                    <!-- Input -->
                                    <div id="searchClassic"
                                        class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2"
                                        aria-labelledby="searchClassicInvoker">
                                        @livewire('public.filter.search', ['placement' => 'content_for_mobile'])
                                    </div>
                                    <!-- End Input -->
                                </li>
                                <!-- End Search -->
                                {{-- <li class="col d-none d-xl-block"><a href="../shop/compare.html" class="text-gray-90"
                                        data-toggle="tooltip" data-placement="top" title="Compare"><i
                                            class="font-size-22 ec ec-compare"></i></a></li>
                                <li class="col d-none d-xl-block"><a href="../shop/wishlist.html"
                                        class="text-gray-90" data-toggle="tooltip" data-placement="top"
                                        title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a></li> --}}
                                <li class="col d-xl-none px-2 px-sm-3">
                                    @if (Auth::check())
                                        <a class="text-gray-90" href="{{ route('public.account') }}">
                                            <i class="font-size-22 ec ec-user"></i>
                                        </a>
                                    @else
                                        <!-- Account Sidebar Toggle Button -->
                                        <a class="text-gray-90" data-toggle="tooltip" data-placement="top"
                                            title="My Account" id="sidebarNavToggler" href="javascript:;"
                                            role="button" wire:ignore.self aria-controls="sidebarContent"
                                            aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                            data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent"
                                            data-unfold-type="css-animation" data-unfold-animation-in="fadeInRight"
                                            data-unfold-animation-out="fadeOutRight" data-unfold-duration="500"><i
                                                class="font-size-22 ec ec-user"></i>

                                        </a>
                                        <!-- End Account Sidebar Toggle Button -->
                                    @endif
                                </li>
                                @auth
                                    <li class="col d-xl-none px-2 px-sm-3">
                                        <a href="{{ route('public.logout') }}" class="text-gray-90"> <i
                                                class="font-size-22 fa-sign-out-alt fas"></i>
                                        </a>
                                    </li>
                                @endauth
                                @livewire('public.cart.global-cart', ['placement' => 'content-header'])


                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Logo and Menu -->

        <!-- Vertical-and-Search-Bar -->
        @include('components.content-sidebar')
        <!-- End Vertical-and-secondary-menu -->
    </div>
</header>
