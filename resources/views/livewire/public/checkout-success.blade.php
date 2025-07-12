<div>
    <div class="container">
        @if ($order)
            <div class="mx-xl-10">
                @if ($type == 'success')
                    <div class="mb-6 text-center">
                        <h1 class="mb-6">Your Order has been confirmed.</h1>
                        <p class="text-gray-90 px-xl-10">
                            We’ve accepted your order, and we’re getting it ready. Come back to this page for updates on
                            your
                            shipment status.
                        </p>
                    </div>
                @elseif ($type == 'track')
                    <div class="mb-6 text-center">
                        <h1 class="mb-6">Your Order Status is <span class="text-blue font-weight-bold">
                                {{ isset(ORDER_STATUS[$order->status]) ? ORDER_STATUS[$order->status] : '-' }}</span>.
                        </h1>
                        <p class="text-gray-90 px-xl-10">
                            Please find the order details below, along with your tracking number: <span
                                class="text-blue font-weight-bold">
                                #{{ $order->trackingNo }}</span>
                        </p>
                    </div>
                @elseif ($type == 'paid')
                    <div class="mb-6 text-center">
                        <h1 class="mb-6">Payment Complete – Order in Process
                        </h1>
                        <p class="text-gray-90 px-xl-10">
                            Thank you for completing your payment. Your order is confirmed and is now being prepared for
                            delivery.
                        </p>
                    </div>
                @elseif ($type == 'advance')
                    <div class="mb-6 text-center">
                        <h1 class="mb-6">Advance Payment Received – Order Confirmed!
                        </h1>
                        <p class="text-gray-90 px-xl-10">
                            We’ve successfully received your advance payment. Your order is now confirmed and being
                            processed. Thank you for shopping with us!
                        </p>
                    </div>
                @endif

                <div class="row mb-10">
                    <div class="col-md-8 col-xl-9">
                        <div class="mr-xl-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">Order Summary</h3>
                            </div>
                            <p class="max-width-830-xl text-gray-90">Here are your order details, including billing
                                information, shipping details, and order status. </p>
                            <div class="table-responsive table-bordered table-compare-list mb-10 border-0">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="min-width-200">Order #</th>
                                            <td>
                                                <h3 class="product-item__title text-blue font-weight-bold mb-3">
                                                    {{ $order->invoiceNo }}
                                                </h3>
                                            </td>

                                        </tr>

                                        <tr>
                                            <th>Date</th>
                                            <td>{{ carbonDate($order->created_at) }}</td>
                                        </tr>

                                        <tr>
                                            <th>Billing</th>
                                            <td>
                                                {{ $order->deliveryAddress }}, {{ $order->deliveryCity }},
                                                {{ $order->deliveryRegion }}, {{ $order->deliveryCountry }},
                                                {{ $order->deliveryPostalCode }}
                                            </td>

                                        </tr>

                                        <tr>
                                            <th>Shipping</th>
                                            <td>
                                                {{ $order->shippingAddress }}, {{ $order->shippingCity }},
                                                {{ $order->shippingRegion }}, {{ $order->shippingCountry }},
                                                {{ $order->shippingPostalCode }}
                                            </td>

                                        </tr>

                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                {{ isset(ORDER_STATUS[$order->status]) ? ORDER_STATUS[$order->status] : '-' }}
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Order Item</h3>
                        </div>
                        <div>
                            <ul class="list-unstyled px-3 pt-3">
                                @php
                                    $total = 0;
                                @endphp
                                <li class="border-bottom pb-3 mb-3">
                                    <div class="">
                                        <ul class="list-unstyled ">
                                            @foreach ($order->items as $key => $item)
                                                <li class="row mx-n2 mb-2">
                                                    <div class="px-2 col-auto">
                                                        <img class="img-fluid" src="{{ $item->product->thumbnail }}"
                                                            alt="Image Description" style="width: 55px;">
                                                    </div>
                                                    <div class="px-2 col">
                                                        <h5 class="text-blue font-size-14 font-weight-bold">
                                                            {{ $item->name ?: $item->product->name }}</h5>
                                                        @php
                                                            $total += $item->amount * $item->qty;
                                                        @endphp
                                                        <span class="font-size-14">{{ $item->qty }} ×
                                                            {{ currency_format($item->amount, default_currency) }}</span>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </li>

                            </ul>
                            @php
                                $total = $total + $order->shippingCharges;
                            @endphp
                            <ul class="list-unstyled mb-6">
                                <li class="flex-center-between align-items-baseline mb-1">
                                    <h5 class="font-size-14 font-weight-bold">Subtotal</h5>
                                    {{ currency_format($total, default_currency) }}
                                </li>
                                <li class="flex-center-between align-items-baseline mb-1">
                                    <h5 class="font-size-14 font-weight-bold">Shipping</h5>
                                    {{ currency_format($order->shippingCharges, default_currency) }}
                                </li>
                                @if ($order->isAdvancePaid)
                                    @php
                                        $total = $total - $order->advance;
                                    @endphp
                                    <li class="flex-center-between align-items-baseline mb-1">
                                        <h5 class="font-size-14 font-weight-bold">Advance Payment</h5>
                                        <span
                                            class="text-danger">-{{ currency_format($order->advance, default_currency) }}</span>
                                    </li>
                                @endif
                                @if ($order->isAdvancePaid)
                                    <li class="flex-center-between align-items-baseline mb-1">
                                        <h5 class="font-size-14 font-weight-bold">Due Payment</h5>
                                        {{ currency_format($total, default_currency) }}
                                    </li>
                                @elseif($order->isPaid)
                                    <li class="flex-center-between align-items-baseline mb-1">
                                        <h5 class="font-size-14 font-weight-bold">Total Paid Amount</h5>
                                        {{ currency_format($total, default_currency) }}
                                    </li>
                                @else
                                    <li class="flex-center-between align-items-baseline mb-1">
                                        <h5 class="font-size-14 font-weight-bold">Total Amount</h5>
                                        {{ currency_format($total, default_currency) }}
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($title == 'Ops something went wrong!')
            <div class="mx-xl-10">
                <div class="mb-6 text-center">
                    <h1 class="mb-6">Ops. something went wrong!</h1>
                    <p class="text-gray-90 px-xl-10">
                        Sorry, we failed to process payment. Please contact us for assistance, and we’ll help you
                        resolve
                        it as soon as possible.
                    </p>
                </div>

            </div>
        @else
            <div class="mx-xl-10">
                <div class="mb-6 text-center">
                    <h1 class="mb-6">Ops. Order Not found!</h1>
                    <p class="text-gray-90 px-xl-10">
                        Sorry, we couldn’t find your order. Please contact us for assistance, and we’ll help you resolve
                        it as soon as possible.
                    </p>
                </div>

            </div>
        @endif

    </div>
</div>
