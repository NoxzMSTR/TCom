<div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
    <div class="mb-8 border border-width-2 border-color-3 borders-radius-6">
        <!-- List -->
        <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar">
            <li>
                <a class="dropdown-current active" href="#">Account</a>

                <ul class="list-unstyled dropdown-list">
                    <!-- Menu List -->
                    <li><a class="dropdown-item {{ url()->current() == route('public.account') ? 'active text-primary' : '' }}"
                            href="{{ route('public.account') }}">My Account</a>
                    </li>
                    <li><a class="dropdown-item {{ url()->current() == route('public.orders') ? 'active text-primary' : '' }}"
                            href="{{ route('public.orders') }}">My Orders</a></li>
                    <!-- End Menu List -->
                </ul>
            </li>
        </ul>
        <!-- End List -->
    </div>

</div>
