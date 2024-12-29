<aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvoker">
    <div class="u-sidebar__scroller">
        <div class="u-sidebar__container">
            <div class="u-header-sidebar__footer-offset">
                <!-- Toggle Button -->
                <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-4 bg-white">
                    <button type="button" class="close ml-auto" aria-controls="sidebarHeader" aria-haspopup="true"
                        aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false"
                        data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation"
                        data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft"
                        data-unfold-duration="500">
                        <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                    </button>
                </div>
                <!-- End Toggle Button -->

                <!-- Content -->
                <div class="js-scrollbar u-sidebar__body">
                    <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                        <!-- Logo -->
                        <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center mb-3"
                            href="{{ route('public.home') }}" aria-label="Electro">
                            @php
                                $logoLight = isset(system_config['logoLight']['value'])
                                    ? system_config['logoLight']['value']
                                    : asset('mAssets/media/logos/logo.jpg');
                                $logoDark = isset(system_config['logoDark']['value'])
                                    ? system_config['logoDark']['value']
                                    : asset('mAssets/media/logos/logo.jpg');
                            @endphp
                            <img alt="Logo" src="{{ $logoLight }}" class="h-35px theme-light-show"
                                style="width:175.748px" />
                        </a>
                        <!-- End Logo -->

                        <!-- List -->
                        <ul id="headerSidebarList" class="u-header-collapse__nav">
                            @foreach ($categories as $key => $category)
                                @if ($category['parent'] == 0)
                                    @if (count($category['descendants']))
                                        <ul id="headerSidebarList" class="u-header-collapse__nav">
                                            @include('components.mobile-sidebar-sub', [
                                                'categories' => $category,
                                            ])
                                        </ul>
                                    @else
                                        <li class=""><a class="u-header-collapse__submenu-nav-link"
                                                href="{{ route('public.shop', ['category' => $category['name']]) }}">{{ $category['name'] }}</a>
                                        </li>
                                    @endif
                                @endif
                            @endforeach

                        </ul>
                        <!-- End List -->
                    </div>
                </div>
                <!-- End Content -->
            </div>
            <!-- Footer -->
            <footer id="SVGwaveWithDots" class="svg-preloader u-header-sidebar__footer">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item pr-3">
                        <a class="u-header-sidebar__footer-link text-gray-90" href="#">Privacy</a>
                    </li>
                    <li class="list-inline-item pr-3">
                        <a class="u-header-sidebar__footer-link text-gray-90" href="#">Terms</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="u-header-sidebar__footer-link text-gray-90" href="#">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </li>
                </ul>

                <!-- SVG Background Shape -->
                <div class="position-absolute right-0 bottom-0 left-0 z-index-n1">
                    <img class="js-svg-injector" src="{{ asset('pAssets/svg/components/wave-bottom-with-dots.svg') }}"
                        alt="Image Description" data-parent="#SVGwaveWithDots">
                </div>
                <!-- End SVG Background Shape -->
            </footer>
            <!-- End Footer -->
        </div>
    </div>
</aside>
