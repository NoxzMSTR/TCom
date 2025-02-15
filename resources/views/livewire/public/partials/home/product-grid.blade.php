@php
    $proArray = [];
    foreach ($products as $key => $product) {
        if ($key <= 3) {
            $proArray[$product->categories->name][0][] = $product;
        } elseif ($key === 4) {
            $proArray[$product->categories->name][1][] = $product;
        } elseif ($key <= 8) {
            $proArray[$product->categories->name][2][] = $product;
        }
    }
@endphp

<div class="products-group-4-1-4 space-1 bg-gray-7">
    <h2 class="sr-only">Products Grid</h2>
    <div class="container">
        <!-- Nav Classic -->
        <div class="position-relative text-center z-index-2 mb-3">
            <ul class="nav nav-classic nav-tab nav-tab-sm px-md-3 justify-content-start justify-content-lg-center flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble border-md-down-bottom-0 pb-1 pb-lg-0 mb-n1 mb-lg-0"
                id="pills-tab-1" role="tablist">
                @php
                    $i = 0;
                @endphp
                @foreach ($proArray as $category => $value)
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link {{ $i === 0 ? 'active' : '' }} " id="Tpills-one-example1-tab"
                            data-toggle="pill" href="#Tpills-one-example1" role="tab"
                            aria-controls="Tpills-one-example1" aria-selected="true">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                {{ $category }}
                            </div>
                        </a>
                    </li>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </ul>
        </div>
        <!-- End Nav Classic -->

        <!-- Tab Content -->
        <div class="tab-content" id="Tpills-tabContent">
            @php
                $i = 0;
            @endphp
            @foreach ($proArray as $category => $productData)
                <div class="tab-pane fade pt-2 {{ $i === 0 ? 'show active' : '' }} " id="Tpills-one-example1"
                    role="tabpanel" aria-labelledby="Tpills-one-example1-tab">
                    <div class="row no-gutters">
                        @if (isset($productData[0]))
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 flex-wd-row">

                                    @php
                                        $isfeat = 1;
                                    @endphp
                                    @foreach ($productData[0] as $key => $product)
                                        @php
                                            $class = '';
                                            $isfeat++;
                                            if ($isfeat == 3) {
                                                $class = ' d-wd-block product-item remove-divider';
                                                $isfeat = 1;
                                            }
                                        @endphp
                                        <li
                                            class="col-xl-6 product-item max-width-xl-100 remove-divider {{ $class }}">
                                            <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                                <div class="product-item__inner bg-white p-3">
                                                    <div class="product-item__body pb-xl-2">
                                                        <div class="mb-2"><a
                                                                href="../shop/product-categories-7-column-full-width.html"
                                                                class="font-size-12 text-gray-5">{{ $product->categories->name }}</a>
                                                        </div>
                                                        <h5 class="mb-1 product-item__title"><a
                                                                href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                class="text-blue font-weight-bold">{{ $product->name }}</a>
                                                        </h5>
                                                        <div class="mb-2">
                                                            <a href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                class="d-block text-center"><img class="img-fluid"
                                                                    src="{{ $product->thumbnail }}"
                                                                    alt="Image Description"></a>
                                                        </div>
                                                        @php
                                                            if (isset($default_currency)) {
                                                                $price = currency_format(
                                                                    $product->amount,
                                                                    $default_currency,
                                                                );
                                                                $discount = 0;
                                                                $amount = $product->amount;
                                                                if ($product->discountType == 1) {
                                                                    $discount =
                                                                        ($amount / 100) * $product->discountData;
                                                                    $discount = $amount - $discount;
                                                                    $discount = currency_format(
                                                                        $discount,
                                                                        $default_currency,
                                                                    );
                                                                } elseif ($product->discountType == 2) {
                                                                    $discount = $product->discountData;
                                                                    $discount = currency_format(
                                                                        $discount,
                                                                        $default_currency,
                                                                    );
                                                                }
                                                            } else {
                                                                $discount = 0;
                                                                $price = $product->amount;
                                                            }
                                                        @endphp
                                                        <div class="flex-center-between mb-1">
                                                            <div class="prodcut-price">
                                                                <div class="text-gray-100">
                                                                    @if ($discount)
                                                                        <del
                                                                            class="mr-2 text-gray-2">{{ $price }}</del>
                                                                        <ins
                                                                            class="text-red text-decoration-none">{{ $discount }}</ins>
                                                                    @else
                                                                        <ins
                                                                            class="text-red text-decoration-none">{{ $price }}</ins>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                                <a href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                    class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                        class="ec ec-add-to-cart cursor-pointer-on "></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="product-item__footer">
                                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                                            <a href="../shop/compare.html"
                                                                class="text-gray-6 font-size-13"><i
                                                                    class="ec ec-compare mr-1 font-size-15"></i>
                                                                Compare</a>
                                                            <a href="../shop/wishlist.html"
                                                                class="text-gray-6 font-size-13"><i
                                                                    class="ec ec-favorites mr-1 font-size-15"></i> Add
                                                                to
                                                                Wishlist</a>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        @endif
                        @if (isset($productData[1][0]))
                            <div class="col-md-6 col-wd-4 products-group-1">
                                @php
                                    $product = $productData[1][0];
                                @endphp
                                <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                    <li class="col product-item remove-divider">
                                        <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                            <div class="product-item__inner bg-white p-3">
                                                <div class="product-item__body d-flex flex-column">
                                                    <div class="mb-1">
                                                        <div class="mb-2"><a
                                                                href="../shop/product-categories-7-column-full-width.html"
                                                                class="font-size-12 text-gray-5">{{ $product->categories->name }}</a>
                                                        </div>
                                                        <h5 class="mb-0 product-item__title"><a
                                                                href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                class="text-blue font-weight-bold">{{ $product->name }}</a>
                                                        </h5>
                                                    </div>
                                                    <div class="mb-1 min-height-4-1-4">
                                                        <a href="#"
                                                            class="d-block text-center my-4 mt-lg-6 mb-lg-5 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img
                                                                class="img-fluid" src="{{ $product->thumbnail }}"
                                                                alt="Image Description"></a>
                                                        <!-- Gallery -->
                                                        <div class="row mx-gutters-2 mb-3">
                                                            @foreach ($product->assets as $key => $value)
                                                                <div class="col-auto">
                                                                    <!-- Gallery -->
                                                                    <a class="js-fancybox max-width-60 u-media-viewer"
                                                                        href="javascript:;"
                                                                        data-src="{{ asset($value->path) }}"
                                                                        data-fancybox="fancyboxGallery6"
                                                                        data-caption="Electro in frames - image #01"
                                                                        data-speed="700" data-is-infinite="true">
                                                                        <img class="img-fluid border"
                                                                            src="{{ asset($value->path) }}"
                                                                            alt="Image Description">

                                                                        <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span
                                                                                    class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                    <!-- End Gallery -->
                                                                </div>
                                                            @endforeach


                                                            <div class="col"></div>
                                                        </div>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    @php
                                                        if (isset($default_currency)) {
                                                            $price = currency_format(
                                                                $product->amount,
                                                                $default_currency,
                                                            );
                                                            $discount = 0;
                                                            $amount = $product->amount;
                                                            if ($product->discountType == 1) {
                                                                $discount = ($amount / 100) * $product->discountData;
                                                                $discount = $amount - $discount;
                                                                $discount = currency_format(
                                                                    $discount,
                                                                    $default_currency,
                                                                );
                                                            } elseif ($product->discountType == 2) {
                                                                $discount = $product->discountData;
                                                                $discount = currency_format(
                                                                    $discount,
                                                                    $default_currency,
                                                                );
                                                            }
                                                        } else {
                                                            $discount = 0;
                                                            $price = $product->amount;
                                                        }
                                                    @endphp
                                                    <div class="flex-center-between">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">
                                                                @if ($discount)
                                                                    <del
                                                                        class="mr-2 text-gray-2">{{ $price }}</del>
                                                                    <ins
                                                                        class="text-red text-decoration-none">{{ $discount }}</ins>
                                                                @else
                                                                    <ins
                                                                        class="text-red text-decoration-none">{{ $price }}</ins>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i
                                                                    class="ec ec-add-to-cart cursor-pointer-on  mr-2"></i>
                                                                Add to Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html"
                                                            class="text-gray-6 font-size-13"><i
                                                                class="ec ec-compare mr-1 font-size-15"></i>
                                                            Compare</a>
                                                        <a href="../shop/wishlist.html"
                                                            class="text-gray-6 font-size-13"><i
                                                                class="ec ec-favorites mr-1 font-size-15"></i> Add to
                                                            Wishlist</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endif

                        @if (isset($productData[2]))
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 flex-wd-row">
                                    @php
                                        $isfeat = 1;
                                    @endphp
                                    @foreach ($productData[2] as $key => $product)
                                        @php
                                            $class = '';
                                            $isfeat++;
                                            if ($isfeat == 3) {
                                                $class = ' d-wd-block product-item remove-divider';
                                                $isfeat = 1;
                                            }
                                        @endphp
                                        <li
                                            class="col-xl-6 product-item max-width-xl-100 remove-divider {{ $class }}">
                                            <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                                <div class="product-item__inner bg-white p-3">
                                                    <div class="product-item__body pb-xl-2">
                                                        <div class="mb-2"><a
                                                                href="../shop/product-categories-7-column-full-width.html"
                                                                class="font-size-12 text-gray-5">{{ $product->categories->name }}</a>
                                                        </div>
                                                        <h5 class="mb-1 product-item__title"><a
                                                                href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                class="text-blue font-weight-bold">{{ $product->name }}</a>
                                                        </h5>
                                                        <div class="mb-2">
                                                            <a href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                class="d-block text-center"><img class="img-fluid"
                                                                    src="{{ $product->thumbnail }}"
                                                                    alt="Image Description"></a>
                                                        </div>
                                                        @php
                                                            if (isset($default_currency)) {
                                                                $price = currency_format(
                                                                    $product->amount,
                                                                    $default_currency,
                                                                );
                                                                $discount = 0;
                                                                $amount = $product->amount;
                                                                if ($product->discountType == 1) {
                                                                    $discount =
                                                                        ($amount / 100) * $product->discountData;
                                                                    $discount = $amount - $discount;
                                                                    $discount = currency_format(
                                                                        $discount,
                                                                        $default_currency,
                                                                    );
                                                                } elseif ($product->discountType == 2) {
                                                                    $discount = $product->discountData;
                                                                    $discount = currency_format(
                                                                        $discount,
                                                                        $default_currency,
                                                                    );
                                                                }
                                                            } else {
                                                                $discount = 0;
                                                                $price = $product->amount;
                                                            }
                                                        @endphp
                                                        <div class="flex-center-between mb-1">
                                                            <div class="prodcut-price">
                                                                <div class="text-gray-100">
                                                                    @if ($discount)
                                                                        <del
                                                                            class="mr-2 text-gray-2">{{ $price }}</del>
                                                                        <ins
                                                                            class="text-red text-decoration-none">{{ $discount }}</ins>
                                                                    @else
                                                                        <ins
                                                                            class="text-red text-decoration-none">{{ $price }}</ins>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                                <a href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                    class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                        class="ec ec-add-to-cart cursor-pointer-on "></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="product-item__footer">
                                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                                            <a href="../shop/compare.html"
                                                                class="text-gray-6 font-size-13"><i
                                                                    class="ec ec-compare mr-1 font-size-15"></i>
                                                                Compare</a>
                                                            <a href="../shop/wishlist.html"
                                                                class="text-gray-6 font-size-13"><i
                                                                    class="ec ec-favorites mr-1 font-size-15"></i> Add
                                                                to
                                                                Wishlist</a>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
        <!-- End Tab Content -->
    </div>

    <!-- Features Section -->

    <!-- End Features Section -->
</div>
