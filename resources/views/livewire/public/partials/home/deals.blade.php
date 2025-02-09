@php

    foreach ($products as $key => $product) {
        if ($product->isOffer) {
            $hasOfferedProduct = $product;
        }
    }
@endphp
<div class="mb-5">
    <div class="row">
        <!-- Deal -->
        <div class="col-md-auto mb-6 mb-md-0">
            @if (isset($hasOfferedProduct))
                <div class="p-3 border border-width-2 border-primary borders-radius-20 bg-white min-width-370">
                    <div class="d-flex justify-content-between align-items-center m-1 ml-2">
                        <h3 class="font-size-22 mb-0 font-weight-normal text-lh-28 max-width-120">Special Offer
                        </h3>
                        <div
                            class="d-flex align-items-center flex-column justify-content-center bg-primary rounded-pill height-75 width-75 text-lh-1">
                            <span class="font-size-12">Save</span>
                            <div class="font-size-20 font-weight-bold">$120</div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <a wire:navigate href="{{ route('public.product', [$hasOfferedProduct->name]) }}"
                            class="d-block text-center"><img style="height: 200px;" class="img-fluid"
                                src="{{ $hasOfferedProduct->thumbnail }}" alt="Image Description"></a>
                    </div>
                    <h5 class="mb-2 font-size-14 text-center mx-auto max-width-180 text-lh-18"><a wire:navigate
                            href="{{ route('public.product', [$hasOfferedProduct->name]) }}"
                            class="text-blue font-weight-bold">{{ $hasOfferedProduct->name }}</a></h5>
                    @php
                        if (isset($default_currency)) {
                            $price = currency_format($hasOfferedProduct->amount, $default_currency);
                            $discount = 0;
                            $amount = $hasOfferedProduct->amount;
                            if ($hasOfferedProduct->discountType == 1) {
                                $discount = ($amount / 100) * $hasOfferedProduct->discountData;
                                $discount = $amount - $discount;
                                $discount = currency_format($discount, $default_currency);
                            } elseif ($hasOfferedProduct->discountType == 2) {
                                $discount = $hasOfferedProduct->discountData;
                                $discount = currency_format($discount, $default_currency);
                            }
                        } else {
                            $discount = 0;
                            $price = $product->amount;
                        }

                    @endphp
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        @if ($discount)
                            <del class="font-size-18 mr-2 text-gray-2">{{ $price }}</del>
                            <ins class="font-size-30 text-red text-decoration-none">{{ $discount }}</ins>
                        @else
                            <ins class="font-size-30 text-red text-decoration-none">{{ $price }}</ins>
                        @endif

                    </div>
                    <div class="mb-3 mx-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="">Availavle: <strong>{{ $hasOfferedProduct->qty }}</strong></span>
                            <span class="">Already Sold: <strong>28</strong></span>
                        </div>
                        <div class="rounded-pill bg-gray-3 height-20 position-relative">
                            <span class="position-absolute left-0 top-0 bottom-0 rounded-pill w-30 bg-primary"></span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h6 class="font-size-15 text-gray-2 text-center mb-3">Hurry Up! Offer ends in:</h6>
                        <div class="js-countdown d-flex justify-content-center" data-end-date="2020/11/30"
                            data-hours-format="%H" data-minutes-format="%M" data-seconds-format="%S">
                            <div class="text-lh-1">
                                <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                    <span class="js-cd-hours"></span>
                                </div>
                                <div class="text-gray-2 font-size-12 text-center">HOURS</div>
                            </div>
                            <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                            <div class="text-lh-1">
                                <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                    <span class="js-cd-minutes"></span>
                                </div>
                                <div class="text-gray-2 font-size-12 text-center">MINS</div>
                            </div>
                            <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                            <div class="text-lh-1">
                                <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                    <span class="js-cd-seconds"></span>
                                </div>
                                <div class="text-gray-2 font-size-12 text-center">SECS</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="d-none p-3 border border-width-2 border-primary borders-radius-20 bg-white min-width-370">
                <div class="d-flex justify-content-between align-items-center m-1 ml-2">
                    <div class="bg-gray-1 bg-animation rounded height-20 w-50"></div>
                    <div class="bg-gray-1 bg-animation u-lg-avatar rounded-circle"></div>
                </div>
                <div class="mb-4">
                    <div class="bg-gray-1 height-300"></div>
                </div>
                <div class="mb-4">
                    <div class="bg-gray-1 bg-animation rounded height-20 w-60 mx-auto mb-1"></div>
                    <div class="bg-gray-1 bg-animation rounded height-20 w-50 mx-auto"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center mb-4">
                    <div class="bg-gray-1 bg-animation rounded height-12 w-20 ml-auto mr-2"></div>
                    <div class="bg-gray-1 bg-animation rounded height-20 w-30 mr-auto"></div>
                </div>
                <div class="mb-3 mx-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="bg-gray-1 bg-animation rounded height-12 w-30"></div>
                        <div class="bg-gray-1 bg-animation rounded height-12 w-30"></div>
                    </div>
                    <div class="rounded-pill bg-gray-1 height-20 position-relative">

                    </div>
                </div>
                <div class="mb-2">
                    <div class="bg-gray-1 bg-animation rounded height-12 w-60 mx-auto mb-3"></div>
                    <div class="d-flex justify-content-center">
                        <div class="">
                            <div class="u-avatar bg-gray-1 bg-animation rounded mb-1"></div>
                            <div class="bg-gray-1 bg-animation rounded height-12 w-90 mx-auto"></div>
                        </div>
                        <div class="mx-1 pt-1 text-gray-1 font-size-24">:</div>
                        <div class="">
                            <div class="u-avatar bg-gray-1 bg-animation rounded mb-1"></div>
                            <div class="bg-gray-1 bg-animation rounded height-12 w-90 mx-auto"></div>
                        </div>
                        <div class="mx-1 pt-1 text-gray-1 font-size-24">:</div>
                        <div class="">
                            <div class="u-avatar bg-gray-1 bg-animation rounded mb-1"></div>
                            <div class="bg-gray-1 bg-animation rounded height-12 w-90 mx-auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Deal -->
        <!-- Tab Prodcut -->
        <div class="col">
            <!-- Features Section -->
            <div class="">
                <!-- Nav Classic -->
                <div class="position-relative bg-white text-center z-index-2">
                    <ul class="nav nav-classic nav-tab justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active " id="pills-one-example1-tab" data-toggle="pill"
                                href="#pills-one-example1" role="tab" aria-controls="pills-one-example1"
                                aria-selected="true">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Featured
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-two-example1-tab" data-toggle="pill"
                                href="#pills-two-example1" role="tab" aria-controls="pills-two-example1"
                                aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    On Sale
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-three-example1-tab" data-toggle="pill"
                                href="#pills-three-example1" role="tab" aria-controls="pills-three-example1"
                                aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Top Rated
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav Classic -->

                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel"
                        aria-labelledby="pills-one-example1-tab">
                        <ul class="row list-unstyled products-group no-gutters">
                            @php
                                $isfeat = 0;
                            @endphp
                            @foreach ($products as $key => $product)
                                @if ($product->isFeatured)
                                    @php
                                        $class = '';
                                        $isfeat++;
                                        if ($isfeat == 3) {
                                            $class = 'remove-divider-xl';
                                        } elseif ($isfeat == 4) {
                                            $class = 'remove-divider-wd';
                                            $isfeat = 0;
                                        }
                                    @endphp
                                    <li class="col-6 col-wd-3 col-md-4 product-item {{ $class }}">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a
                                                            href="../shop/product-categories-7-column-full-width.html"
                                                            class="font-size-12 text-gray-5">{{ $product->categories->name }}</a>
                                                    </div>
                                                    <h5 class="mb-1 product-item__title"><a wire:navigate
                                                            href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                            class="text-blue font-weight-bold">{{ $product->name }}</a>
                                                    </h5>
                                                    @if ($product->thumbnail)
                                                        <div class="mb-2">
                                                            <a wire:navigate
                                                                href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                class="d-block text-center"><img class="img-fluid"
                                                                    src="{{ $product->thumbnail }}"
                                                                    alt="Image Description"></a>
                                                        </div>
                                                    @endif
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
                                                            <a wire:click="$dispatchTo('public.cart.global-cart', 'add-to-cart', { product: {{ $product->id }} })"
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
                                                            to Wishlist</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade pt-2" id="pills-two-example1" role="tabpanel"
                        aria-labelledby="pills-two-example1-tab">
                        <ul class="row list-unstyled products-group no-gutters">
                            @php
                                $issale = 0;
                            @endphp
                            @foreach ($products as $key => $product)
                                @if ($product->discountType)
                                    @php
                                        $class = '';
                                        $issale++;
                                        if ($issale == 3) {
                                            $class = 'remove-divider-xl';
                                        } elseif ($issale == 4) {
                                            $class = 'remove-divider-wd';
                                            $issale = 0;
                                        }
                                    @endphp
                                    <li class="col-6 col-wd-3 col-md-4 product-item {{ $class }}">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a
                                                            href="../shop/product-categories-7-column-full-width.html"
                                                            class="font-size-12 text-gray-5">{{ $product->categories->name }}</a>
                                                    </div>
                                                    <h5 class="mb-1 product-item__title"><a wire:navigate
                                                            href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                            class="text-blue font-weight-bold">{{ $product->name }}</a>
                                                    </h5>
                                                    @if ($product->thumbnail)
                                                        <div class="mb-2">
                                                            <a wire:navigate
                                                                href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                class="d-block text-center"><img class="img-fluid"
                                                                    src="{{ $product->thumbnail }}"
                                                                    alt="Image Description"></a>
                                                        </div>
                                                    @endif

                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
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
                                                            <a wire:click="$dispatchTo('public.cart.global-cart', 'add-to-cart', { product: {{ $product->id }} })"
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
                                                            to Wishlist</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade pt-2" id="pills-three-example1" role="tabpanel"
                        aria-labelledby="pills-three-example1-tab">
                        <ul class="row list-unstyled products-group no-gutters">
                            @php
                                $hasFeed = 0;
                            @endphp
                            @foreach ($products as $key => $product)
                                @if ($product->feedback()->count())
                                    @php
                                        $class = '';
                                        $hasFeed++;
                                        if ($hasFeed == 3) {
                                            $class = 'remove-divider-xl';
                                        } elseif ($hasFeed == 4) {
                                            $class = 'remove-divider-wd';
                                            $hasFeed = 0;
                                        }
                                    @endphp
                                    <li class="col-6 col-wd-3 col-md-4 product-item {{ $class }}">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a
                                                            href="../shop/product-categories-7-column-full-width.html"
                                                            class="font-size-12 text-gray-5">{{ $product->categories->name }}</a>
                                                    </div>
                                                    <h5 class="mb-1 product-item__title"><a wire:navigate
                                                            href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                            class="text-blue font-weight-bold">{{ $product->name }}</a>
                                                    </h5>
                                                    @if ($product->thumbnail)
                                                        <div class="mb-2">
                                                            <a wire:navigate
                                                                href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                                class="d-block text-center"><img class="img-fluid"
                                                                    src="{{ $product->thumbnail }}"
                                                                    alt="Image Description"></a>
                                                        </div>
                                                    @endif
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
                                                            <a wire:click="$dispatchTo('public.cart.global-cart', 'add-to-cart', { product: {{ $product->id }} })"
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
                                                            to Wishlist</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- End Tab Content -->
            </div>
            <!-- End Features Section -->
        </div>
        <!-- End Tab Prodcut -->
    </div>
</div>
