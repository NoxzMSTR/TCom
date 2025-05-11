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

    <script>
        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

        // Store it in a cookie or send via AJAX
        document.cookie = "user_timezone=" + timezone;
    </script>

    @livewireStyles
    @stack('css')

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Corporation",
          "name": "TechBottle",
          "alternateName": "Tech Bottle",
          "url": "https://techbottle.pk/",
          "logo": "https://techbottle.pk/system/WhatsApp%20Image%202024-11-19%20at%2001.07.11_49c2be52%20(1).png",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "‪+923418425578‬",
            "contactType": "Customer Service",
            "areaServed": "PK",
            "availableLanguage": ["en", "ur"]
          },
          "sameAs": ["https://techbottle.pk/"]
        }
        </script>

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "name": "TechBottle",
          "url": "https://techbottle.pk/",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://techbottle.pk/shop?category=Keyboards%20%26%20Mice&search={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
        </script>

    <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "FAQPage",
              "mainEntity": [
                {
                  "@type": "Question",
                  "name": "What is TechBottle?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "TechBottle is a leading e-commerce marketplace in Sialkot, connecting buyers with trusted sellers across Punjab. We offer a wide range of computers, laptops, peripherals, accessories, networking equipment, and storage devices."
                  }
                },
                {
                  "@type": "Question",
                  "name": "Do you offer delivery services?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, we provide fast and reliable delivery within 24 hours across Sialkot."
                  }
                },
                {
                  "@type": "Question",
                  "name": "Can I find gaming accessories at TechBottle?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Absolutely. We offer gaming keyboards, mice, headsets, cooling fans, graphic cards, PC cases, and other essential gaming accessories."
                  }
                },
                {
                  "@type": "Question",
                  "name": "Who are the sellers on TechBottle?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "TechBottle collaborates with verified sellers from across Punjab to offer a diverse selection of tech products with fast delivery."
                  }
                },
                {
                  "@type": "Question",
                  "name": "Does TechBottle support freelancers and IT professionals?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, we support freelancers and IT professionals with affordable and high-quality tech accessories and hardware."
                  }
                },
                {
                  "@type": "Question",
                  "name": "How can I place an order?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Visit our website, browse the products, add items to your cart, and proceed to checkout. It's quick and convenient."
                  }
                },
                {
                  "@type": "Question",
                  "name": "Can I sell my products on TechBottle?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Currently, we do not offer a selling platform for individuals or businesses, but we're planning to expand in the future."
                  }
                },
                {
                  "@type": "Question",
                  "name": "What payment methods do you accept?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We accept Cash on Delivery (COD), online payments, and bank transfers."
                  }
                },
                {
                  "@type": "Question",
                  "name": "What if I receive a faulty or incorrect product?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "If you receive a faulty or incorrect item, contact our support team. We’ll help you with a return or exchange."
                  }
                },
                {
                  "@type": "Question",
                  "name": "How can I contact TechBottle for inquiries?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "You can email us at info@techbottle.pk or call/WhatsApp at 0341-8425578. We're located in Sialkot, Pakistan."
                  }
                }
              ]
            }
            </script>
</head>
