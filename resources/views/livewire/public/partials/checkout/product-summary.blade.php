<div class="pl-lg-3 ">
    <div class="bg-gray-1 rounded-lg" x-data="{
        setSameDay() {
            var sameDay = {};
            $('.sameDayProducts:checked').each(function(index, element) {
                sameDay[index] = $(element).val();
            });
            $wire.set('slots', sameDay, false);
        }
    }">

        <!-- Order Summary -->
        @if (count($products))
            <div class="p-4 mb-4 checkout-table">
                <!-- Title -->
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                </div>
                <!-- End Title -->
                @php
                    $productsByCType = [];
                    $productsByType = [];
                    foreach ($products as $key => $vars) {
                        $product = $vars['product'];
                        if ($product->vendor) {
                            $productsByCType[$product->vendor->city][$product['shippingType']] = $vars;
                        } else {
                            $productsByType[0] = $vars;
                        }
                    }

                @endphp

                @foreach ($productsByCType as $city => $cityData)
                    @foreach ($cityData as $sType => $nProducts)
                        <div class="card mb-3" x-data="{
                            city: @js($city),
                            init() {
                                if (!sameDayProducts[this.city]) {
                                    sameDayProducts[this.city] = null;
                                }
                            }
                        }">
                            <div class="card-body">
                                @php
                                    if ($sType == 1) {
                                        $title = 'Same Day Delivery';
                                        $desciption =
                                            'Please select a time slot which you want to delivery the product on.';
                                    } else {
                                        $title = 'Standard Delivery';
                                        $desciption =
                                            'We will delivery the product within or after ' .
                                            $standard_delivery .
                                            'hrs.';
                                    }

                                @endphp
                                <h5 class="card-title font-weight-bold mb-1">{{ $title }}</h5>
                                <p class="card-text mb-1">{{ $desciption }}</p>
                                <!-- Product Content -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $qty = $nProducts['qty'];
                                            $variations = $nProducts['variations'];
                                            $amount = $nProducts['final'];
                                            if (isset($default_currency)) {
                                                $amount = currency_format($amount, $default_currency);
                                            }
                                            $product = $nProducts['product'];

                                        @endphp
                                        <tr class="cart_item">
                                            <td>{{ $product->name }}<strong class="product-quantity"> ×
                                                    {{ $qty }}</strong>
                                            </td>
                                            <td>{{ $amount }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <!-- End Product Content -->
                                <div>
                                    @if ($sType == 1)
                                        <template x-for="(slot, index) in currentSlot[city]">
                                            <div
                                                class="border border-primary border-width-3 custom-control custom-radio d-flex py-2 px-3 mb-3 rounded-left-pill rounded-right-pill justify-content-between">
                                                <label :for="'slot-' + index"
                                                    class="custom-control custom-radio m-0 pl-3">
                                                    <input @click="setSameDay" type="radio"
                                                        x-model="sameDayProducts[city]"
                                                        class="custom-control-input sameDayProducts"
                                                        :id="'slot-' + index" :name="'sameDaySlot-' + city"
                                                        :value="city + '_' + slot.date + '_' + slot.from + ' - ' + slot.to">
                                                    <label :for="'slot-' + index"
                                                        class="custom-control-label form-label left-3"
                                                        x-text="slot.futureDates ?slot.date+' '+slot.from + ' - ' + slot.to:slot.from + ' - ' + slot.to">
                                                        -
                                                    </label>
                                                </label>
                                                <div>
                                                    <label class="form-label m-0">
                                                        Expired in: <span class="text-primary"
                                                            x-text="timeLeft[index]"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </template>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
                @foreach ($productsByType as $sType => $nProducts)
                    <div class="card mb-3">
                        <div class="card-body">
                            @php
                                if ($sType == 1) {
                                    $title = 'Same Day Delivery';
                                    $desciption =
                                        'Please select a time slot which you want to delivery the product on.';
                                } else {
                                    $title = 'Standard Delivery';
                                    $desciption =
                                        'We will delivery the product within or after ' . $standard_delivery . 'hrs.';
                                }

                            @endphp
                            <h5 class="card-title font-weight-bold mb-1">{{ $title }}</h5>
                            <p class="card-text mb-1">{{ $desciption }}</p>
                            <!-- Product Content -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $qty = $nProducts['qty'];
                                        $variations = $nProducts['variations'];
                                        $amount = $nProducts['final'];
                                        if (isset($default_currency)) {
                                            $amount = currency_format($amount, $default_currency);
                                        }
                                        $product = $nProducts['product'];

                                    @endphp
                                    <tr class="cart_item">
                                        <td>{{ $product->name }}<strong class="product-quantity"> ×
                                                {{ $qty }}</strong>
                                        </td>
                                        <td>{{ $amount }}</td>
                                    </tr>

                                </tbody>
                            </table>
                            <!-- End Product Content -->

                        </div>
                    </div>
                @endforeach

                <!-- Product Content -->
                <table class="table">
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
                                    <input type="radio" class="custom-control-input" id="thirdstylishRadio1"
                                        name="stylishRadio" checked>
                                    <label class="custom-control-label form-label" for="thirdstylishRadio1"
                                        data-toggle="collapse" data-target="#basicsCollapseThree" aria-expanded="false"
                                        aria-controls="basicsCollapseThree">
                                        Cash on delivery
                                    </label>
                                </div>
                            </div>
                            <div id="basicsCollapseThree"
                                class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter"
                                aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion1">
                                <div class="p-4">
                                    Pay with cash upon delivery.
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <!-- End Basics Accordion -->
                </div>
                <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                    <div class="form-check">
                        <input wire:model='termCondtions' class="form-check-input" type="checkbox" value=""
                            id="defaultCheck10" required data-msg="Please agree terms and conditions."
                            data-error-class="u-has-error" data-success-class="u-has-success">
                        <label class="form-check-label form-label" for="defaultCheck10">
                            I have read and agree to the website <a href="{{ route('public.terms-n-conditions') }}" class="text-blue">terms and
                                conditions </a>
                            <span class="text-danger">*</span>
                        </label>
                    </div>
                </div>
                @error('termCondtions')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                @error('hasSlots')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place
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
