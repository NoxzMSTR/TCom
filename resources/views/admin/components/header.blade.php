<style>
    @media (min-width: 992px) {
        .aside-fixed.aside-secondary-enabled[data-kt-sticky-header=on] .header {
            left: 300px;
        }
    }
</style>
<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header"
    data-kt-sticky-offset="{default: '200px', lg: '300px'}">
    <!--begin::Container-->
    <div class="container-xxl d-flex align-items-center justify-content-between" id="kt_header_container">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap mt-n5 mt-lg-0 me-lg-2 pb-2 pb-lg-0"
            data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
            <!--begin::Heading-->
            <h1 class="text-gray-900 fw-bold my-0 fs-2">Dashboard</h1>
            <!--end::Heading-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb fw-semibold fs-base my-1">
                @if (isset($breadCrumb))
                    @php
                        $crumbs = explode('.', $breadCrumb);
                    @endphp
                    @foreach ($crumbs as $key => $value)
                        @if ($key == 0)
                            <li class="breadcrumb-item text-muted">
                                <span class="text-muted text-hover-primary">{{ $value }}</span>
                            </li>
                        @else
                            <li class="breadcrumb-item text-muted">{{ $value }}</li>
                        @endif
                    @endforeach
                @else
                    <li class="breadcrumb-item text-muted">
                        <span class="text-muted text-hover-primary">Home</span>
                    </li>
                @endif

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title=-->
        <!--begin::Wrapper-->
        <div class="d-flex d-lg-none align-items-center ms-n4 me-2">
            <!--begin::Aside mobile toggle-->
            <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <!--end::Aside mobile toggle-->
            <!--begin::Logo-->
            <a href="index.html" class="d-flex align-items-center">
                @php
                    $logoLight = isset(system_config['logoLight']['value'])
                        ? system_config['logoLight']['value']
                        : asset('mAssets/media/logos/logo.jpg');
                    $logoDark = isset(system_config['logoDark']['value'])
                        ? system_config['logoDark']['value']
                        : asset('mAssets/media/logos/logo.jpg');
                @endphp
                <img alt="Logo" src="{{ $logoLight }}" class="h-30px theme-light-show" />
                <img alt="Logo" src="{{ $logoDark }}" class="h-30px theme-dark-show" />
            </a>
            <!--end::Logo-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Toolbar wrapper-->
        <div class="d-flex flex-shrink-0">
            <!--begin::Theme mode-->
            <div class="d-flex align-items-center ms-3">
                <!--begin::Menu toggle-->
                <a href="#"
                    class="btn btn-icon flex-center bg-body btn-color-gray-600 btn-active-color-primary h-40px"
                    data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                    data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-night-day theme-light-show fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                        <span class="path6"></span>
                        <span class="path7"></span>
                        <span class="path8"></span>
                        <span class="path9"></span>
                        <span class="path10"></span>
                    </i>
                    <i class="ki-duotone ki-moon theme-dark-show fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </a>
                <!--begin::Menu toggle-->
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                    data-kt-menu="true" data-kt-element="theme-mode-menu">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-0">
                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                            <span class="menu-icon" data-kt-element="icon">
                                <i class="ki-duotone ki-night-day fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                    <span class="path9"></span>
                                    <span class="path10"></span>
                                </i>
                            </span>
                            <span class="menu-title">Light</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-0">
                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                            <span class="menu-icon" data-kt-element="icon">
                                <i class="ki-duotone ki-moon fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Dark</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-0">
                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                            <span class="menu-icon" data-kt-element="icon">
                                <i class="ki-duotone ki-screen fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">System</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Theme mode-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Container-->
</div>
