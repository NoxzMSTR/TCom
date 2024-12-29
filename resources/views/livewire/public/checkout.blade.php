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
    <div class="container" x-data='{ slot: @json($slot)}'>
        <script></script>
        <div x-data="{
            latitude: '',
            longitude: '',
            address: '',
            country: '',
            userIP: $wire.entangle('userIP'),
            currentSlot: {},
            sameDayProducts: $wire.entangle('sameDayProducts'),
            init() {
                if (!navigator.geolocation) {
                    alert('Geolocation is not supported by your browser.');
                    return;
                }
                navigator.geolocation.getCurrentPosition(async (position) => {
                        this.latitude = position.coords.latitude;
                        this.longitude = position.coords.longitude;
        
                        // Reverse geocoding with Nominatim (OpenStreetMap)
                        const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${this.latitude}&lon=${this.longitude}&addressdetails=1`;
                        const response = await fetch(url);
                        const data = await response.json();
        
                        if (data.address) {
                            this.address = data.display_name || 'Address not found';
                            this.country = data.address.country || 'Country not found';
                        } else {
                            this.address = 'Unable to fetch address.';
                            this.country = 'Unable to fetch country.';
                        }
        
                        this.setTimeSlot();
                    },
                    (error) => {
                        alert('Unable to retrieve location. Error: ' + error.message);
                    });
            },
            setTimeSlot() {
                var now = new Date();
                var currentHours = now.getHours();
                currentHours = (currentHours + 2) % 24;
                var currentMinutes = now.getMinutes();
                var i = 0;
                var currentSlot = {};
                $.each(this.slot, function(index, elem) {
                    var [slotHours, slotMinutes] = elem.to.split(':');
                    if (slotHours >= currentHours) {
                        currentSlot[i] = elem;
                        i++;
                    }
                });
        
                this.currentSlot = currentSlot;
            },
            async getIpAddress() {
                try {
                    // Fetch the user's IP address from ipify
                    const response = await fetch('https://api.ipify.org?format=json');
                    const data = await response.json();
        
                    // Store the IP address in a reactive property
                    this.userIP = data.ip;
                } catch (error) {
                    console.error('Unable to fetch IP address:', error);
                    this.userIP = 'error';
                }
            }
        }">
            <div class="mb-5">
                <h1 class="text-center">Checkout</h1>
            </div>
            <!-- Accordion -->
            @include('livewire.public.partials.checkout.returning-customer')
            <!-- End Accordion -->

            <!-- Accordion -->

            <!-- End Accordion -->
            <form class="js-validate" novalidate="novalidate" wire:submit="placeOrder">

                <input type="text" hidden x-model="userIP">
                <div class="row">
                    <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                        @include('livewire.public.partials.checkout.product-summary')
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
                            @include('livewire.public.partials.checkout.create-account')
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
</div>
