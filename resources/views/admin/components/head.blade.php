<head>
    <title>{{ isset($title) ? $title : '-' }}</title>
    @php
        $favconLogo = isset(system_config['favconLogo']['value'])
            ? system_config['favconLogo']['value']
            : asset('mAssets/media/logos/logo.jpg');
    @endphp
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <link rel="shortcut icon" href="{{ $favconLogo }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('mAssets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('mAssets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('mAssets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    @yield('css')

    <script>
        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

        // Store it in a cookie or send via AJAX
        document.cookie = "user_timezone=" + timezone;
    </script>
</head>
