<div>
    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">Checkout</h1>
        </div>
        <!-- Accordion -->
        <div id="shopCartAccordion" class="accordion rounded mb-5">
            <!-- Card -->
            <div class="card border-0">
                <div id="shopCartHeadingOne" class="alert alert-primary mb-0" role="alert">
                    Returning customer? <a href="#" class="alert-link" data-toggle="collapse"
                        data-target="#shopCartOne" aria-expanded="false" aria-controls="shopCartOne">Click here to
                        login</a>
                </div>
                <div id="shopCartOne" class="collapse border border-top-0" aria-labelledby="shopCartHeadingOne"
                    data-parent="#shopCartAccordion" style="">
                    <!-- Form -->
                    <form class="js-validate p-5">
                        <!-- Title -->
                        <div class="mb-5">
                            <p class="text-gray-90 mb-2">Welcome back! Sign in to your account.</p>
                            <p class="text-gray-90">If you have shopped with us before, please enter your details below.
                                If you are a new customer, please proceed to the Billing & Shipping section.</p>
                        </div>
                        <!-- End Title -->

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="form-label" for="signinSrEmailExample3">Email address</label>
                                    <input type="email" class="form-control" name="email" id="signinSrEmailExample3"
                                        placeholder="Email address" aria-label="Email address" required
                                        data-msg="Please enter a valid email address." data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                                <!-- End Form Group -->
                            </div>
                            <div class="col-lg-6">
                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="form-label" for="signinSrPasswordExample2">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        id="signinSrPasswordExample2" placeholder="********" aria-label="********"
                                        required data-msg="Your password is invalid. Please try again."
                                        data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Form Group -->
                            </div>
                        </div>

                        <!-- Checkbox -->
                        <div class="js-form-message mb-3">
                            <div class="custom-control custom-checkbox d-flex align-items-center">
                                <input type="checkbox" class="custom-control-input" id="rememberCheckbox"
                                    name="rememberCheckbox" required data-error-class="u-has-error"
                                    data-success-class="u-has-success">
                                <label class="custom-control-label form-label" for="rememberCheckbox">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        <!-- End Checkbox -->

                        <!-- Button -->
                        <div class="mb-1">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary-dark-w px-5">Login</button>
                            </div>
                            <div class="mb-2">
                                <a class="text-blue" href="#">Lost your password?</a>
                            </div>
                        </div>
                        <!-- End Button -->
                    </form>
                    <!-- End Form -->
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Accordion -->

        <!-- Accordion -->

        <!-- End Accordion -->
        <form class="js-validate" novalidate="novalidate" wire:submit="placeOrder">
            <div class="row">
                <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                    <div class="pl-lg-3 ">
                        <div class="bg-gray-1 rounded-lg">
                            <!-- Order Summary -->
                            @if (count($products))
                                <div class="p-4 mb-4 checkout-table">
                                    <!-- Title -->
                                    <div class="border-bottom border-color-1 mb-5">
                                        <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                                    </div>
                                    <!-- End Title -->

                                    <!-- Product Content -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $key => $product)
                                                @php
                                                    $qty = count($product);
                                                    $amount = 0;
                                                    $product = $product[0];
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
                                                <tr class="cart_item">
                                                    <td>{{ $product->name }}<strong class="product-quantity"> ×
                                                            {{ $qty }}</strong>
                                                    </td>
                                                    <td>{{ $discount ? $discount : $price }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>{{ $totalAmount }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td>Free Delivery</td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td><strong>{{ $totalAmount }}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!-- End Product Content -->
                                    <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                        <!-- Basics Accordion -->
                                        <div id="basicsAccordion1">

                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingThree">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input"
                                                            id="thirdstylishRadio1" name="stylishRadio" checked>
                                                        <label class="custom-control-label form-label"
                                                            for="thirdstylishRadio1" data-toggle="collapse"
                                                            data-target="#basicsCollapseThree" aria-expanded="false"
                                                            aria-controls="basicsCollapseThree">
                                                            Cash on delivery
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseThree"
                                                    class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                    aria-labelledby="basicsHeadingThree"
                                                    data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                        Pay with cash upon delivery.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->
                                        </div>
                                        <!-- End Basics Accordion -->
                                    </div>
                                    <div
                                        class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck10" required
                                                data-msg="Please agree terms and conditions."
                                                data-error-class="u-has-error" data-success-class="u-has-success">
                                            <label class="form-check-label form-label" for="defaultCheck10">
                                                I have read and agree to the website <a href="#"
                                                    class="text-blue">terms and conditions </a>
                                                <span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place
                                        order</button>
                                </div>
                            @else
                                <div class="p-4 mb-4 checkout-table">
                                    <!-- Title -->
                                    <div class="border-bottom border-color-1 mb-5">
                                        <h3 class="section-title mb-0 pb-2 font-size-25">Your cart is empty. </h3>
                                    </div>
                                    <!-- End Title -->

                                    <!-- Product Content -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Please add
                                                    products to proceed with your
                                                    order.</th>
                                            </tr>
                                        </thead>

                                    </table>
                                    <!-- End Product Content -->

                                    <a href="{{ route('public.shop') }}"
                                        class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Looking
                                        to upgrade your tech? Let’s go shopping!!</a>
                                </div>
                            @endif

                            <!-- End Order Summary -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 order-lg-1">
                    <div class="pb-7 mb-7">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
                        </div>
                        <!-- End Title -->

                        <!-- Billing Form -->
                        @include('livewire.public.partials.checkout.billing')
                        <!-- End Billing Form -->

                        <!-- Accordion -->
                        <div id="shopCartAccordion2" class="accordion rounded mb-6">
                            <!-- Card -->
                            <div class="card border-0">
                                <div id="shopCartHeadingThree"
                                    class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="createAnaccount"
                                        name="createAnaccount">
                                    <label class="custom-control-label form-label" for="createAnaccount"
                                        data-toggle="collapse" data-target="#shopCartThree" aria-expanded="false"
                                        aria-controls="shopCartThree">
                                        Create an account?
                                    </label>
                                </div>
                                <div id="shopCartThree" class="collapse" aria-labelledby="shopCartHeadingThree"
                                    data-parent="#shopCartAccordion2" style="">
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group py-5">
                                        <label class="form-label" for="signinSrPasswordExample1">
                                            Create account password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" class="form-control" name="password"
                                            id="signinSrPasswordExample1" placeholder="********"
                                            aria-label="********" required data-msg="Enter password."
                                            data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Accordion -->
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Shipping Details details</h3>
                        </div>
                        <!-- End Title -->
                        <!-- Accordion -->
                        <div id="shopCartAccordion3" class="accordion rounded mb-5">
                            <!-- Card -->
                            @include('livewire.public.partials.checkout.shipping')
                            <!-- End Card -->
                        </div>
                        <!-- End Accordion -->
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Order notes (optional)
                            </label>

                            <div class="input-group">
                                <textarea class="form-control p-5" rows="4" name="text" wire:model='note'
                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                        <!-- End Input -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
