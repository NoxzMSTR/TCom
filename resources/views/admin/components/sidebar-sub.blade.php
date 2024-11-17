<div class="aside-workspace w-100 overflow-hidden" id="kt_aside_wordspace">
    <div class="d-flex h-100 flex-column">
        <!--begin::Wrapper-->
        <div class="flex-column-fluid">
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade active show" id="kt_aside_nav_tab_menu" role="tabpanel">
                    <!--begin::Menu-->
                    <div class="menu menu-column menu-fit menu-rounded menu-title-gray-600 menu-icon-gray-500 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-semibold fs-5 px-6 my-5 my-lg-0"
                        id="kt_aside_menu" data-kt-menu="true">
                        <div id="kt_aside_menu_wrapper" class="menu-fit">
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item {{ url()->current() == route('admin.dashboard') ? 'here show' : '' }}  menu-accordion">
                                <!--begin:Menu link-->
                                <a wire:navigate
                                    class="menu-link {{ url()->current() == route('admin.dashboard') ? 'active' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-element-11 fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Dashboards</span>
                                </a>
                                <!--end:Menu link-->

                            </div>
                            <!--end:Menu item-->

                            <!--begin:Menu item-->
                            <div class="menu-item pt-5">
                                <!--begin:Menu content-->
                                <div class="menu-content">
                                    <span class="menu-heading fw-bold text-uppercase fs-7">Apps</span>
                                </div>
                                <!--end:Menu content-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion {{ in_array(url()->current(), [route('admin.order.add'), route('admin.order.list'), route('admin.order.settings')]) ? 'here show' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-abstract-41 fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Orders</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a wire:navigate
                                            class="menu-link {{ url()->current() == route('admin.order.add') ? 'active' : '' }}"
                                            href="{{ route('admin.order.add') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Add Order</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a wire:navigate
                                            class="menu-link {{ url()->current() == route('admin.order.list') ? 'active' : '' }}"
                                            href="{{ route('admin.order.list') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Order List</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a wire:navigate
                                            class="menu-link {{ url()->current() == route('admin.order.settings') ? 'active' : '' }}"
                                            href="{{ route('admin.order.settings') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Order Settings</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion {{ in_array(url()->current(), [route('admin.product.categories'), route('admin.product.list'), route('admin.product.add'), route('admin.product.list')]) ? 'here show' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-basket fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Products</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <!--begin:Menu link-->
                                        <a wire:navigate
                                            class="menu-link {{ url()->current() == route('admin.product.categories') ? 'active' : '' }}"
                                            href="{{ route('admin.product.categories') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Category</span>

                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <!--begin:Menu link-->
                                        <a wire:navigate
                                            class="menu-link {{ url()->current() == route('admin.product.add') ? 'active' : '' }}"
                                            href="{{ route('admin.product.add') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Add Product</span>

                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <!--begin:Menu link-->
                                        <a wire:navigate
                                            class="menu-link {{ url()->current() == route('admin.product.list') ? 'active' : '' }}"
                                            href="{{ route('admin.product.list') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Product List</span>

                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                <!--begin:Menu link-->
                                <a wire:navigate
                                    class="menu-link {{ url()->current() == route('admin.buyer.list') ? 'active' : '' }}"
                                    href="{{ route('admin.buyer.list') }}">
                                    <span class="menu-icon">
                                        <i class="ki-solid ki-profile-user fs-2"></i>
                                    </span>
                                    <span class="menu-title">Buyer</span>
                                </a>
                                <!--end:Menu link-->

                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                <!--begin:Menu link-->
                                <a wire:navigate
                                    class="menu-link {{ url()->current() == route('admin.vendor.list') ? 'active' : '' }}"
                                    href="{{ route('admin.vendor.list') }}">
                                    <span class="menu-icon">
                                        <i class="ki-solid ki-parcel fs-2"></i>
                                    </span>
                                    <span class="menu-title">Vendor</span>
                                </a>
                                <!--end:Menu link-->

                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion {{ in_array(url()->current(), [route('admin.settings.account')]) ? 'here show' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-solid ki-setting-2 fs-2"></i>
                                    </span>
                                    <span class="menu-title">Settings</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ url()->current() == route('admin.settings.account') ? 'active' : '' }}"
                                            wire:navigate href="{{ route('admin.settings.account') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Account</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ url()->current() == route('admin.settings.system') ? 'active' : '' }}"
                                            wire:navigate href="{{ route('admin.settings.system') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">System</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->

                        </div>
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Tab pane-->
            </div>
            <!--end::Tab content-->
        </div>
        <!--end::Wrapper-->
    </div>
</div>
