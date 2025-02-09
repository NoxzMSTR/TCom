<div>
    @php
        $cities = [];
        $standard_delivery = 48;
        $slot = null;
        if (defined('order_settings')) {
            foreach (order_settings as $key => $value) {
                if ($value['type'] == 'available_for') {
                    $cities = json_decode($value['data'], true);
                }
                if ($value['type'] == 'standard_delivery') {
                    $standard_delivery = json_decode($value['data'], true)[0];
                }
                if ($value['type'] == 'same_day_delivery') {
                    $slot = json_decode($value['data'], true);
                }
            }
        }
    @endphp
    <div class="container">
        <div class="row mb-8">
            @include('livewire.public.partials.account.menu')

            @include('livewire.public.partials.account.my-account')
        </div>
    </div>
</div>
