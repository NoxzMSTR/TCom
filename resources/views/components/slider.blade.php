<style>
    .u-slick.slick-initialized .js-slide,
    .u-slick.slick-initialized .js-thumb {
        overflow: hidden !important;
    }
</style>
<div class="mb-5">
    <div class="bg-img-hero" style="background-image: url({{ asset('pAssets/img/img1.jpg') }});">
        <div class="container min-height-420 overflow-hidden">
            <div class="js-slick-carousel u-slick"
                data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start mb-3 mb-md-4 offset-xl-3 pl-2 pb-1">
                @php
                    $sliders = [];
                    if (defined('system_config')) {
                        foreach (system_config as $key => $value) {
                            $field = explode('.', $key);
                            if ($field[0] == 'sliders') {
                                $sliders[] = json_validate($value->value) ? json_decode($value->value, true) : [];
                            }
                        }
                    }
                @endphp
                @foreach ($sliders as $key => $slider)
                    <div class="js-slide bg-img-hero-center">
                        <div class="row min-height-564 py-7 py-md-0"
                            style="{{ isset($slider['showImage']) && isset($slider['setBackground']) && $slider['setBackground'] == true ? "background-image: url('" . $slider['showImage'] . "');background-size: cover;background-repeat: no-repeat;background-position: center;background-color: rgb(255 255 255 / 56%);background-blend-mode: lighten;" : '' }}">
                            <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                                <h1 class="font-size-64 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                    {{ $slider['title'] }}
                                </h1>
                                <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp"
                                    data-scs-animation-delay="200">{{ $slider['description'] }}
                                </h6>
                                @if (isset($slider['productID']) && $slider['productID'])
                                    @php
                                        $product = product($slider['productID']);
                                    @endphp
                                    @if ($product)
                                        @php

                                            if (isset($default_currency)) {
                                                $price = currency_format($product->amount, $default_currency);
                                                $discount = 0;
                                                $amount = $product->amount;
                                                if ($product->discountType == 1) {
                                                    $discount = ($amount / 100) * $product->discountData;
                                                    $discount = $amount - $discount;
                                                    $discount = currency_format($discount, $default_currency, false);
                                                } elseif ($product->discountType == 2) {
                                                    $discount = $product->discountData;
                                                    $discount = currency_format($discount, $default_currency, false);
                                                } else {
                                                    $discount = currency_format($amount, $default_currency, false);
                                                }
                                            } else {
                                                $discount = $product->amount;
                                            }
                                            $discount = explode('.', $discount);
                                        @endphp
                                        <div class="mb-4" data-scs-animation-in="fadeInUp"
                                            data-scs-animation-delay="300">
                                            <span class="font-size-13">FROM</span>
                                            <div class="font-size-50 font-weight-bold text-lh-45">
                                                <sup
                                                    class="">{{ defined('default_currency_symbol') ? default_currency_symbol : '-' }}</sup>{{ $discount[0] }}<sup
                                                    class="">{{ isset($discount[1]) ? $discount[1] : '00' }}</sup>
                                            </div>
                                        </div>
                                        <a href="{{ route('public.product', [$product->id, preg_replace('/[^A-Za-z0-9]+/', '-',$product->name)]) }}"
                                            target="_blank"
                                            class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                            data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                            Start Buying
                                        </a>
                                    @endif
                                @endif

                            </div>
                            @php
                                $showImg =
                                    isset($slider['showImage']) &&
                                    isset($slider['setBackground']) &&
                                    $slider['setBackground'] == true ?:
                                    false;
                            @endphp
                            @if (isset($slider['showImage']) && $showImg == false)
                                <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="zoomIn"
                                    data-scs-animation-delay="500">
                                    <img class="img-fluid" src="{{ $slider['showImage'] }}" alt="Image Description">
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
