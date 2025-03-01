@foreach ($products as $key => $product)
@endforeach
@php
    $bestPrice = 'RS0.00';
    $pArray = [];
    foreach ($products as $key => $product) {
        if (isset($default_currency)) {
            $price = $product->amount;
            $discount = 0;
            $amount = $product->amount;
            if ($product->discountType == 1) {
                $discount = ($amount / 100) * $product->discountData;
                $discount = $amount - $discount;
            } elseif ($product->discountType == 2) {
                $discount = $product->discountData;
            }
        } else {
            $discount = 0;
            $price = $product->amount;
        }
        if ($discount) {
            $pArray[] = number_format($discount, 2, '.', ',');
        } else {
            $pArray[] = number_format($price, 2, '.', ',');
        }
    }

@endphp
<div class="mb-6">
    <a href="{{ route('public.shop') }}" class="d-block text-gray-90">
        <div>
            <div class="space-top-2-md p-4 pt-6 pt-md-8 pt-lg-6 pt-xl-8 pb-lg-4 px-xl-8 px-lg-6">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h1 class="text-lh-38 font-size-32 font-weight-light mb-0">SHOP AND
                        <strong>SAVE BIG</strong> ON HOTTEST DEALS
                    </h1>
                    <div class="flex-content-center">
                        <div class="bg-primary rounded-lg px-6 py-2">
                            <em class="font-size-14 font-weight-light">STARTING AT</em>
                            <div class="font-size-30 font-weight-bold text-lh-1">
                                @if (defined('default_currency_symbol'))
                                    <sup class="">{{ default_currency_symbol }}</sup>
                                @endif
                                @php
                                    $price = count($pArray) ? min($pArray) : [];
                                    $price = explode('.', $price);
                                @endphp
                                {{ isset($price[0]) ? $price[0] : 00 }}<sup
                                    class="">{{ isset($price[1]) ? $price[1] : 00 }}</sup>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
