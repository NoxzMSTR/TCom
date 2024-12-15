<!DOCTYPE html>
<html lang="en">

@include('components.head')

<body>

    <!-- ========== HEADER ========== -->
    @if (url()->current() == route('public.home'))
        @include('components.header')
    @else
        @include('components.content-header')
    @endif

    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        @isset($breadCrumb)
            @php
                $crumbs = explode('.', $breadCrumb);
            @endphp
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                @foreach ($crumbs as $key => $value)
                                    @if ($key == 0)
                                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                                href="{{ route('public.home') }}">Home</a></li>
                                    @else
                                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active"
                                            aria-current="page">{{ $value }}
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->
        @endisset

        @yield('content')

    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== FOOTER ========== -->
    @include('components.footer')
    <!-- ========== END FOOTER ========== -->

    <!-- ========== SECONDARY CONTENTS ========== -->
    <!-- Account Sidebar Navigation -->
    @include('components.authenticate')
    <!-- End Account Sidebar Navigation -->

    @yield('bottom-content')
    <!-- ========== END SECONDARY CONTENTS ========== -->

    @include('components.scripts')
</body>

</html>
