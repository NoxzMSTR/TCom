<div id="kt_aside" class="aside aside-extended mw-300px" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Primary-->
    <div class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto w-100">
        <!--begin::Logo-->
        <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto py-10"
            id="kt_aside_logo">
            <p>
                @php
                    $logoLight = isset(system_config['logoLight']['value'])
                        ? system_config['logoLight']['value']
                        : asset('mAssets/media/logos/logo.jpg');
                    $logoDark = isset(system_config['logoDark']['value'])
                        ? system_config['logoDark']['value']
                        : asset('mAssets/media/logos/logo.jpg');
                @endphp
                <img alt="Logo" src="{{ $logoLight }}" class="h-35px theme-light-show" />
                <img alt="Logo" src="{{ $logoDark }}" class="h-35px theme-dark-show" />
            </p>
        </div>
        <!--end::Logo-->
        <!--begin::Nav-->
        <div class="aside-nav d-flex flex-column align-items-center flex-column-fluid w-100 pt-5 pt-lg-0 w-100"
            id="kt_aside_nav">
            <style>
                [data-kt-aside-minimize=on] .aside .menu-title {
                    display: none;
                }
            </style>
            @include('admin.components.sidebar-sub')

        </div>
        <!--end::Nav-->
        <!--begin::Footer-->
        @include('admin.components.sidebar-footer')
        <!--end::Footer-->
    </div>
    <!--end::Primary-->
    <!--begin::Secondary-->

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
