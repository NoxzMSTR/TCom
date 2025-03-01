<div class="space-top-2">
    <div
        class=" d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
        <h3 class="section-title mb-0 pb-2 font-size-22">Bestsellers</h3>
        <ul
            class="nav nav-pills mb-2 pt-3 pt-md-0 mb-0 border-top border-color-1 border-md-top-0 align-items-center font-size-15 font-size-15-md flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
            <li class="nav-item flex-shrink-0 flex-md-shrink-1">
                <a class="text-gray-90 btn btn-outline-primary border-width-2 rounded-pill py-1 px-4 font-size-15 text-lh-19 font-size-15-md"
                    href="#">Top 20</a>
            </li>

        </ul>
    </div>
    @php
        $orderArray = [];
        foreach ($orders as $okey => $order) {
            foreach ($order->items as $key => $item) {
                if ($okey <= 7) {
                    $orderArray[0][$item->productID] = $item->product;
                } elseif ($okey <= 14) {
                    $orderArray[1][$item->productID] = $item->product;
                } elseif ($okey <= 21) {
                    $orderArray[2][$item->productID] = $item->product;
                }
            }
        }
    @endphp
    <div class="js-slick-carousel u-slick u-slick--gutters-2 overflow-hidden u-slick-overflow-visble pt-3 pb-6"
        data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">
        @foreach ($orderArray as $key => $productData)
            <div class="js-slide">
                <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                    @php
                        $isfeat = 1;
                    @endphp
                    @foreach ($productData as $key => $product)
                        @php
                            $class = '';
                            $isfeat++;
                            if ($isfeat == 4) {
                                $class = ' remove-divider-wd';
                                $isfeat = 1;
                            }
                        @endphp
                        <li
                            class="col-wd-3 col-md-4 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0 {{ $class }}">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner p-md-3 row no-gutters">
                                    @if ($product->thumbnail)
                                        <div class="col col-lg-auto product-media-left">
                                            <a href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                class="max-width-150 d-block"><img class="img-fluid"
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
                                    <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1">
                                        <div class="mb-4">
                                            <div class="mb-2"><a
                                                    href="{{ route('public.shop', ['category' => $product->categories->name]) }}"
                                                    class="font-size-12 text-gray-5">{{ $product->categories->name }}</a>
                                            </div>
                                            <h5 class="product-item__title"><a
                                                    href="{{ route('public.product', [$product->id, $product->name]) }}"
                                                    class="text-blue font-weight-bold">{{ $product->name }}</a>
                                            </h5>
                                        </div>
                                        <div class="flex-center-between mb-3">
                                            <div class="prodcut-price">
                                                <div class="text-gray-100">
                                                    @if ($discount)
                                                        <del class="mr-2 text-gray-2">{{ $price }}</del>
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
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach

    </div>
</div>
