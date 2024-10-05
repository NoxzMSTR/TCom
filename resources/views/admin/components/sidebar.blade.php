<div id="kt_aside" class="aside aside-extended" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Primary-->
    <div class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto">
        <!--begin::Logo-->
        <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto py-10"
            id="kt_aside_logo">
            <p>
                <img alt="Logo" src="{{ asset('mAssets/media/logos/logo.jpg') }}" class="h-35px" />
            </p>
        </div>
        <!--end::Logo-->
        <!--begin::Nav-->
        <div class="aside-nav d-flex flex-column align-items-center flex-column-fluid w-100 pt-5 pt-lg-0"
            id="kt_aside_nav">
            <!--begin::Wrapper-->
            <div class="hover-scroll-overlay-y mb-5 scroll-ms px-5" data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                data-kt-scroll-wrappers="#kt_aside_nav" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                data-kt-scroll-offset="0px">
                <!--begin::Nav-->
                <ul class="nav flex-column w-100" id="kt_aside_nav_tabs">
                    <!--begin::Nav item-->
                    <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right"
                        data-bs-dismiss="click" title="Menus">
                        <!--begin::Nav link-->
                        <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-500 btn-active-light active"
                            data-bs-toggle="tab" href="#kt_aside_nav_tab_menu">
                            <i class="ki-duotone ki-element-11 fs-2x">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </a>
                        <!--end::Nav link-->
                    </li>
                    <!--end::Nav item-->
                </ul>
                <!--end::Tabs-->
            </div>
            <!--end::Nav-->
        </div>
        <!--end::Nav-->
        <!--begin::Footer-->
        @include('admin.components.sidebar-footer')
        <!--end::Footer-->
    </div>
    <!--end::Primary-->
    <!--begin::Secondary-->
    @include('admin.components.sidebar-sub')
    <!--end::Secondary-->
    <!--begin::Aside Toggle-->
    <button id="kt_aside_toggle"
        class="aside-toggle btn btn-sm btn-icon bg-body btn-color-gray-700 btn-active-primary position-absolute translate-middle start-100 end-0 bottom-0 shadow-sm d-none d-lg-flex mb-5"
        data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
        data-kt-toggle-name="aside-minimize">
        <i class="ki-duotone ki-arrow-left fs-2 rotate-180">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </button>
    <!--end::Aside Toggle-->
</div>
