<div class="border-top border-width-3 border-color-1 pt-3 mb-3">
    <!-- Basics Accordion -->

    @php
        $needAdvance = false;
        $totalAmount = 0;
        foreach ($products as $key => $value) {
            if (isset($value['product'])) {
                $needAdvance = $value['product']->needAdvance;
                $totalAmount += $value['final'];
            }
        }
    @endphp

    <div id="basicsAccordion1" x-init="paymentMethod = '{{ $needAdvance ? 'advance' : 'cod' }}'">
        @if ($sUrl && $sClient && $sSecret)
            <!-- Card -->
            <div class="border-bottom border-color-1 border-dotted-bottom">
                <div class="p-3" id="onlinePayment">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="online" x-model="paymentMethod"
                            value="online">
                        <label class="custom-control-label form-label" for="online" data-toggle="collapse"
                            data-target="#onlinePaymentID" aria-expanded="false" aria-controls="basicsCollapseThree">
                            Pay Now – Online Payment
                        </label>
                    </div>
                </div>
                <div id="onlinePaymentID" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                    aria-labelledby="onlinePayment" data-parent="#basicsAccordion1">
                    <div class="p-4">
                        Pay using debit / credit card
                    </div>
                </div>
            </div>
            <!-- End Card -->
        @endif

        @if ($advanceAmount && $advanceAmountLimit && $totalAmount <= $advanceAmountLimit)
            <!-- Card -->
            <div class="border-bottom border-color-1 border-dotted-bottom">
                <div class="p-3" id="advancePayment">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="advance" x-model="paymentMethod"
                            value="advance" {{ $needAdvance ? 'checked' : '' }}>
                        <label class="custom-control-label form-label" for="advance" data-toggle="collapse"
                            data-target="#advancePaymentID" aria-expanded="false" aria-controls="basicsCollapseThree">
                            Advance Payment – {{ $advanceAmount }}
                        </label>
                    </div>
                </div>
                <div id="advancePaymentID"
                    class="collapse {{ $needAdvance ? 'show' : '' }} border-top border-color-1 border-dotted-top bg-dark-lighter"
                    aria-labelledby="advancePayment" data-parent="#basicsAccordion1">
                    <div class="p-4">
                        Make an advance payment of {{ $advanceAmount }} to confirm your
                        booking/service. This amount
                        will be adjusted in your final bill.
                    </div>
                </div>
            </div>
            <!-- End Card -->
        @endif
        @if (!$needAdvance)
            <!-- Card -->
            <div class="border-bottom border-color-1 border-dotted-bottom">
                <div class="p-3" id="basicsHeadingThree">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="cod" value="cod"
                            x-model="paymentMethod" checked>
                        <label class="custom-control-label form-label" for="cod" data-toggle="collapse"
                            data-target="#basicsCollapseThree" aria-expanded="false"
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
        @endif

    </div>
    <!-- End Basics Accordion -->
</div>
<div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
    <div class="form-check">
        <input wire:model='termCondtions' class="form-check-input" type="checkbox" value="" id="defaultCheck10"
            required data-msg="Please agree terms and conditions." data-error-class="u-has-error"
            data-success-class="u-has-success">
        <label class="form-check-label form-label" for="defaultCheck10">
            I have read and agree to the website <a href="{{ route('public.terms-n-conditions') }}" target="_blank"
                class="text-blue">terms and
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
<button @click="placeOrder" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place
    order</button>
