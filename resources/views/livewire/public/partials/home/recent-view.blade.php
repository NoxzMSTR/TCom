<div class="mb-6">
    <div class="position-relative">
        <div class="border-bottom border-color-1 mb-2">
            <h3 class="section-title mb-0 pb-2 font-size-22">Recently Viewed</h3>
        </div>
        <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
            data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
            data-slides-show="7" data-slides-scroll="1"
            data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
            data-arrow-left-classes="fa fa-angle-left right-1" data-arrow-right-classes="fa fa-angle-right right-0"
            data-responsive='[{
              "breakpoint": 1400,
              "settings": {
                "slidesToShow": 6
              }
            }, {
                "breakpoint": 1200,
                "settings": {
                  "slidesToShow": 4
                }
            }, {
              "breakpoint": 992,
              "settings": {
                "slidesToShow": 3
              }
            }, {
              "breakpoint": 768,
              "settings": {
                "slidesToShow": 2
              }
            }, {
              "breakpoint": 554,
              "settings": {
                "slidesToShow": 2
              }
            }]'>
            @foreach ($recentProducts as $key => $product)
                <div class="js-slide products-group">
                    <div class="product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner px-wd-4 p-2 p-md-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html"
                                            class="font-size-12 text-gray-5">{{ $product->categories->name }}</a></div>
                                    <h5 class="mb-1 product-item__title"><a wire:navigate
                                            href="{{ route('public.product', [$product->id, $product->name]) }}"
                                            class="text-blue font-weight-bold">{{ $product->name }}</a></h5>
                                    @if ($product->thumbnail)
                                        <div class="mb-2">
                                            <a wire:navigate
                                                href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                class="d-block text-center"><img class="img-fluid"
                                                    src="{{ $product->thumbnail }}" alt="Image Description"></a>
                                        </div>
                                    @endif
                                    @php
                                        if (isset($default_currency)) {
                                            $price = currency_format($product->amount, $default_currency);
                                            $discount = 0;
                                            $amount = $product->amount;
                                            if ($product->discountType == 1) {
                                                $discount = ($amount / 100) * $product->discountData;
                                                $discount = $amount - $discount;
                                                $discount = currency_format($discount, $default_currency);
                                            } elseif ($product->discountType == 2) {
                                                $discount = $product->discountData;
                                                $discount = currency_format($discount, $default_currency);
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
                                                    <del class="mr-2 text-gray-2">{{ $price }}</del>
                                                    <ins class="text-red text-decoration-none">{{ $discount }}</ins>
                                                @else
                                                    <ins class="text-red text-decoration-none">{{ $price }}</ins>
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
                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>
