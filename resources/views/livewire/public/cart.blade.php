<div>
    <div class="container">
        <div class="mb-4">
            <h1 class="text-center">Cart</h1>
        </div>
        <div class="mb-10 cart-table">
            <form class="mb-4" action="#" method="post">
                <table class="table" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity w-lg-15">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            @php
                                $qty = count($product);
                                $amount = 0;
                                $product = $product[0];
                            @endphp
                            <tr class="">
                                <td class="text-center">
                                    <a href="#" class="text-gray-32 font-size-26">×</a>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <a href="#"><img class="img-fluid max-width-100 p-1 border border-color-1"
                                            style="width: 300px;" src="{{ $product->thumbnail }}"
                                            alt="Image Description"></a>
                                </td>

                                <td data-title="Product">
                                    <a href="#" class="text-gray-90">{{ $product->name }}</a>
                                </td>
                                @php

                                    if (isset($default_currency)) {
                                        $price = currency_format($product->amount, $default_currency);
                                        $discount = 0;
                                        $amount = $product->amount;
                                        if ($product->discountType == 1) {
                                            $discount = ($amount / 100) * $product->discountData;
                                            $discount = $amount - $discount;
                                            $amount = $discount;
                                            $discount = currency_format($discount, $default_currency);
                                        } elseif ($product->discountType == 2) {
                                            $discount = $product->discountData;
                                            $amount = $discount;
                                            $discount = currency_format($discount, $default_currency);
                                        }
                                    } else {
                                        $discount = 0;
                                        $price = $product->amount;
                                        $amount = $price;
                                    }
                                @endphp
                                <td data-title="Price">
                                    <span class="">{{ $discount ? $discount : $price }}</span>
                                </td>

                                <td data-title="Quantity">
                                    <span class="sr-only">Quantity</span>
                                    <!-- Quantity -->
                                    <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                        <div class="js-quantity row align-items-center">
                                            <div class="col">
                                                <input
                                                    class="js-result form-control h-auto border-0 rounded p-0 shadow-none"
                                                    type="text" value="{{ $qty }}">
                                            </div>
                                            <div class="col-auto pr-1">
                                                <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                    href="javascript:;">
                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                </a>
                                                <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                    href="javascript:;">
                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Quantity -->
                                </td>

                                <td data-title="Total">
                                    @php
                                        $amount = $amount * $qty;
                                    @endphp
                                    <span class="">{{ currency_format($amount, $default_currency) }}</span>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="6" class="border-top space-top-2 justify-content-center">
                                <div class="pt-md-3">
                                    <div class="d-block d-md-flex flex-center-between">
                                        <div class="mb-3 mb-md-0 w-xl-40">
                                            <!-- Apply coupon Form -->
                                            {{-- <form class="js-focus-state">
                                                <label class="sr-only" for="subscribeSrEmailExample1">Coupon
                                                    code</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="text"
                                                        id="subscribeSrEmailExample1" placeholder="Coupon code"
                                                        aria-label="Coupon code"
                                                        aria-describedby="subscribeButtonExample2" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-block btn-dark px-4" type="button"
                                                            id="subscribeButtonExample2"><i
                                                                class="fas fa-tags d-md-none"></i><span
                                                                class="d-none d-md-inline">Apply coupon</span></button>
                                                    </div>
                                                </div>
                                            </form> --}}
                                            <!-- End Apply coupon Form -->
                                        </div>
                                        <div class="d-md-flex">
                                            <button type="button"
                                                class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">Update
                                                cart</button>
                                            <a href="{{ route('public.checkout') }}"
                                                class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block">Proceed
                                                to checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="mb-8 cart-total">
            <div class="row">
                <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                    <div class="border-bottom border-color-1 mb-3">
                        <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Cart totals</h3>
                    </div>
                    <table class="table mb-3 mb-md-0">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td data-title="Subtotal"><span class="amount">{{ $totalAmount }}</span></td>
                            </tr>
                            <tr class="shipping">
                                <th>Shipping</th>
                                <td data-title="Shipping">
                                    Free Delivery
                                    {{-- Flat Rate: <span class="amount">$300.00</span>
                                    <div class="mt-1">
                                        <a class="font-size-12 text-gray-90 text-decoration-on underline-on-hover font-weight-bold mb-3 d-inline-block"
                                            data-toggle="collapse" href="#collapseExample" role="button"
                                            aria-expanded="false" aria-controls="collapseExample">
                                            Calculate Shipping
                                        </a>

                                    </div> --}}
                                </td>
                            </tr>
                            <tr class="order-total">
                                <th>Total</th>
                                <td data-title="Total"><strong><span class="amount">{{ $totalAmount }}</span></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('public.checkout') }}"
                        class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-md-none">Proceed
                        to checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
