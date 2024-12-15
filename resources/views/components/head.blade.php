<head>
    <!-- Title -->
    <title>{{ isset($title) ? $title : '-' }}</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../favicon.png">

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
    <link rel="stylesheet" href="{{ asset('pAssets/css/theme.css') }}">

    @stack('css')
</head>
