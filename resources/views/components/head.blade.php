<head>
    <!-- Title -->
    <title>{{ isset($title) ? $title : '-' }}</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @php
        $favconLogo = isset(system_config['favconLogo']['value'])
            ? system_config['favconLogo']['value']
            : asset('mAssets/media/logos/logo.jpg');
    @endphp
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ $favconLogo }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
        rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('pAssets/vendor/font-awesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pAssets/css/font-electro.css') }}">

    <link rel="stylesheet" href="{{ asset('pAssets/vendor/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pAssets/vendor/hs-megamenu/src/hs.megamenu.css') }}">
    <link rel="stylesheet"
        href="{{ asset('pAssets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('pAssets/vendor/ion-rangeslider/css/ion.rangeSlider.css') }}">

    <link rel="stylesheet" href="{{ asset('pAssets/vendor/fancybox/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('pAssets/vendor/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('pAssets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">

    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="{{ url('/theme-dynamic-css') }}">

    <style>
        .h-55px {
            height: 50px !important;
            width: auto !important;
        }

        @media (min-width: 768px) {
            .h-md-110px {
                height: 90px !important;
                width: auto !important;
            }
        }
    </style>

    @livewireStyles
    @stack('css')
</head>
