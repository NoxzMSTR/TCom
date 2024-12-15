<div>
    @php
        $default_currency = default_currency;
    @endphp
    @if ($placement == 'content-header')
        <li class="col pr-xl-0 px-2 px-sm-3 d-xl-none">
            <a href="{{ route('public.cart') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip"
                data-placement="top" title="Cart">
                <i class="font-size-22 ec ec-shopping-bag"></i>
                @if ($total)
                    <span
                        class="width-22 height-22 bg-dark position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">{{ $total }}</span>
                    <span
                        class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">{{ $totalAmount }}</span>
                @endif


            </a>
        </li>
    @endif
    @if ($placement == 'content-sidebar')
        <li class="col pr-0 d-xl-none">
            <a href="{{ route('public.cart') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip"
                data-placement="top" title="Cart">
                <i class="font-size-22 ec ec-shopping-bag"></i>
                @if ($total)
                    <span
                        class="width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12">{{ $total }}</span>
                    <span class="font-weight-bold font-size-16 text-gray-90 ml-3">{{ $totalAmount }}</span>
                @endif

            </a>
        </li>
        <li class="col pr-xl-0 px-2 px-sm-3 d-none d-xl-block">
            <div id="basicDropdownHoverInvoker" class="text-gray-90 position-relative d-flex cursor-pointer-on"
                data-toggle="tooltip" data-placement="top" title="Cart" aria-controls="basicDropdownHover"
                aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                data-unfold-target="#basicDropdownHover" data-unfold-type="css-animation" data-unfold-duration="300"
                data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                data-unfold-animation-out="fadeOut" wire:ignore.self>
                <i class="font-size-22 ec ec-shopping-bag"></i>
                @if ($total)
                    <span
                        class="width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12">{{ $total }}</span>
                    <span
                        class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">{{ $totalAmount }}</span>
                @endif

            </div>
            <div id="basicDropdownHover"
                class="cart-dropdown dropdown-menu dropdown-unfold border-top border-top-primary mt-3 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0"
                aria-labelledby="basicDropdownHoverInvoker" wire:ignore.self>
                <ul class="list-unstyled px-3 pt-3">
                    @php
                        $exProducts = [];
                        foreach ($products as $key => $product) {
                            $exProducts[$product->id][] = $product;
                        }
                    @endphp
                    @foreach ($exProducts as $key => $product)
                        @php
                            $qty = count($product);
                            $product = $product[0];
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
                        <li class="border-bottom pb-3 mb-3">
                            <div class="">
                                <ul class="list-unstyled row mx-n2">
                                    <li class="px-2 col-auto">
                                        <img class="img-fluid" src="{{ $product->thumbnail }}" alt="Image Description"
                                            style="width: 75px;">
                                    </li>
                                    <li class="px-2 col">
                                        <h5 class="text-blue font-size-14 font-weight-bold">
                                            {{ $product->name }}</h5>
                                        <span class="font-size-14">{{ $qty }} ×
                                            {{ $discount ? $discount : $price }}</span>
                                    </li>
                                    <li class="px-2 col-auto">
                                        <a href="javascript:;"
                                            wire:click="$dispatchTo('public.cart.global-cart', 'remove-from-to-cart', { productID: {{ $product->id }} })"
                                            class="text-gray-90"><i class="ec ec-close-remove"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="flex-center-between px-4 pt-2">
                    <a href="{{ route('public.cart') }}"
                        class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">View
                        cart</a>
                    <a href="{{ route('public.checkout') }}"
                        class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5">Checkout</a>
                </div>
            </div>
        </li>
    @endif

    @if ($placement == 'main-header')
        <li class="col pr-xl-0 px-2 px-sm-3 d-xl-none">
            <a href="{{ route('public.cart') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip"
                data-placement="top" title="Cart">
                <i class="font-size-22 ec ec-shopping-bag"></i>
                @if ($total)
                    <span
                        class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12">{{ $total }}</span>
                    <span
                        class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">{{ $totalAmount }}</span>
                @endif

            </a>
        </li>
        <li class="col pr-xl-0 px-2 px-sm-3 d-none d-xl-block">
            <div id="basicDropdownHoverInvoker" class="text-gray-90 position-relative d-flex cursor-pointer-on"
                data-toggle="tooltip" data-placement="top" title="Cart" aria-controls="basicDropdownHover"
                aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                data-unfold-target="#basicDropdownHover" data-unfold-type="css-animation" data-unfold-duration="300"
                data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                data-unfold-animation-out="fadeOut" wire:ignore.self>
                <i class="font-size-22 ec ec-shopping-bag"></i>
                @if ($total)
                    <span
                        class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12">{{ $total }}</span>
                    <span
                        class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">{{ $totalAmount }}</span>
                @endif

            </div>
            <div id="basicDropdownHover"
                class="cart-dropdown dropdown-menu dropdown-unfold border-top border-top-primary mt-3 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0 "
                aria-labelledby="basicDropdownHoverInvoker" wire:ignore.self>
                <ul class="list-unstyled px-3 pt-3">
                    @php
                        $exProducts = [];
                        foreach ($products as $key => $product) {
                            $exProducts[$product->id][] = $product;
                        }
                    @endphp
                    @foreach ($exProducts as $key => $product)
                        @php
                            $qty = count($product);
                            $product = $product[0];
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
                        <li class="border-bottom pb-3 mb-3">
                            <div class="">
                                <ul class="list-unstyled row mx-n2">
                                    <li class="px-2 col-auto">
                                        <img class="img-fluid" src="{{ $product->thumbnail }}" style="width: 75px;"
                                            alt="Image Description">
                                    </li>
                                    <li class="px-2 col">
                                        <h5 class="text-blue font-size-14 font-weight-bold">
                                            {{ $product->name }}</h5>
                                        <span class="font-size-14">{{ $qty }} ×
                                            {{ $discount ? $discount : $price }}</span>
                                    </li>
                                    <li class="px-2 col-auto">
                                        <a href="javascript:;"
                                            wire:click="$dispatchTo('public.cart.global-cart', 'remove-from-to-cart', { productID: {{ $product->id }} })"
                                            class="text-gray-90"><i class="ec ec-close-remove"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="flex-center-between px-4 pt-2">
                    <a href="{{ route('public.cart') }}"
                        class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">View
                        cart</a>
                    <a href="{{ route('public.checkout') }}"
                        class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5">Checkout</a>
                </div>
            </div>
        </li>
    @endif
</div>
