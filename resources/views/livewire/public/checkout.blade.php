<div>
    @php
        $cities = [];
        $standard_delivery = 48;
        $slot = [];
        $deliveryTime = [];
        if (defined('order_settings')) {
            foreach (order_settings as $key => $value) {
                if ($value['type'] == 'delivery_on') {
                    $cities = json_decode($value['data'], true);
                }
                if ($value['type'] == 'standard_delivery') {
                    $standard_delivery = json_decode($value['data'], true)[0];
                }
                if ($value['type'] == 'same_day_delivery') {
                    $slot = json_decode($value['data'], true);
                }
                if ($value['type'] == 'delivery_time') {
                    $deliveryTime = json_decode($value['data'], true);
                }
            }
        }
    @endphp
    <div class="container" x-data='{ slot: @json($slot),deliveryTime: @json($deliveryTime)}'>

        <div x-data="{
            latitude: '',
            longitude: '',
            address: '',
            country: '',
            userIP: $wire.entangle('userIP'),
            currentSlot: {},
            sameDayProducts: $wire.entangle('sameDayProducts'),
            formatDate(date) {
                var year = date.getFullYear();
                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero
                var day = ('0' + date.getDate()).slice(-2); // Add leading zero
                return year + '-' + month + '-' + day;
            },
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
        
                            data.display_name || 'Address not found';
                            data.address.country || 'Country not found';
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
                var self = this;
                var now = new Date();
                var currentHours = now.getHours();
                var currentMinutes = now.getMinutes();
                var expireHours = currentHours;
                currentHours = (currentHours + 2) % 24;
        
                var currentMinutes = now.getMinutes();
                var i = 0;
                var currentSlot = {};
        
                $.each(this.slot, function(city, cityData) {
                    if (self.deliveryTime[city]) {
                        var [fromHours, fromMinutes] = self.deliveryTime[city].from.split(':');
                        var [toHours, toMinutes] = self.deliveryTime[city].to.split(':');
        
                        let givenFromDate = new Date();
                        let givenToDate = new Date();
        
                        givenFromDate.setHours(fromHours, fromMinutes, 0, 0);
                        givenToDate.setHours(toHours, toMinutes, 0, 0);
        
                        let diffFrom = givenFromDate - now;
        
                        let diffTo = givenToDate - now;
        
        
                        if (!currentSlot[city]) {
                            currentSlot[city] = {};
                        }
        
                        if (diffFrom < 0 && diffTo > 0) {
                            var hasPassed = false;
                            $.each(cityData, function(index, elem) {
        
                                var [slotHours, slotMinutes] = elem.to.split(':');
        
                                if (slotHours > currentHours) {
                                    var slotHr = (slotHours - 2) % 24;
                                    self.startCountdown(slotHours + '_' + self.formatDate(now) + '_' + city, now.getDate(), slotHr);
                                    currentSlot[city][slotHours + '_' + self.formatDate(now) + '_' + city] = { from: elem.from, to: elem.to, date: self.formatDate(now), futureDates: false };
        
                                } else {
                                    hasPassed = true;
                                }
                            });
        
                            if (hasPassed) {
                                for (var i = 1; i <= 2; i++) { // Loop for next 2 days
                                    var futureDate = new Date();
                                    futureDate.setDate(now.getDate() + i); // Add i days
                                    $.each(cityData, function(index, elem) {
        
                                        var [slotHours, slotMinutes] = elem.to.split(':');
        
                                        var slotHr = (slotHours - 2) % 24;
                                        self.startCountdown(slotHours + '_' + self.formatDate(futureDate) + '_' + city, futureDate.getDate(), slotHr);
                                        currentSlot[city][slotHours + '_' + self.formatDate(futureDate) + '_' + city] = { from: elem.from, to: elem.to, date: self.formatDate(futureDate), futureDates: true };
        
                                    });
                                }
                            }
                        } else {
        
                            for (var i = 1; i <= 2; i++) { // Loop for next 2 days
                                var futureDate = new Date();
                                futureDate.setDate(now.getDate() + i); // Add i days
                                $.each(cityData, function(index, elem) {
        
                                    var [slotHours, slotMinutes] = elem.to.split(':');
        
                                    var slotHr = (slotHours - 2) % 24;
                                    self.startCountdown(slotHours + '_' + self.formatDate(futureDate) + '_' + city, futureDate.getDate(), slotHr);
                                    currentSlot[city][slotHours + '_' + self.formatDate(futureDate) + '_' + city] = { from: elem.from, to: elem.to, date: self.formatDate(futureDate), futureDates: true };
        
                                });
                            }
                        }
                    }
                });
        
                this.currentSlot = currentSlot;
                $wire.set('hasSlots', currentSlot, false);
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
            },
            now: new Date(),
            currentTime: '',
            expireTime: '',
            interval: '',
            timeLeft: {},
            hasExpired: false,
            startCountdown(index, expDate, expireHours) {
                // Set the expiration time
                const now = new Date();
                var expireDate = new Date(now);
                expireDate.setDate(expDate);
                expireDate.setHours(expireHours);
                expireDate.setMinutes(0);
                expireDate.setSeconds(0);
        
                // Display formatted times
                this.updateTimeDisplay(expireHours);
        
                // Update the countdown every second
                this.interval = setInterval(() => {
                    this.now = new Date();
                    this.updateTimeDisplay(expireHours);
                    this.calculateTimeLeft(index, expireDate);
                }, 1000);
            },
        
            updateTimeDisplay(expireHours) {
                this.currentTime = this.formatTime(this.now);
                const current = new Date();
                current.setHours(expireHours);
                this.expireTime = this.formatTime(current);
            },
        
            calculateTimeLeft(index, expireDate) {
                const difference = expireDate - this.now;
        
                if (difference <= 0) {
                    this.hasExpired = true;
                    this.timeLeft[index] = '00:00:00';
                    clearInterval(this.interval);
                    this.setTimeSlot();
                } else {
                    const hours = String(
                        Math.floor(difference / (1000 * 60 * 60))
                    ).padStart(2, '0');
                    const minutes = String(
                        Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60))
                    ).padStart(2, '0');
                    const seconds = String(
                        Math.floor((difference % (1000 * 60)) / 1000)
                    ).padStart(2, '0');
                    this.timeLeft[index] = `${hours}:${minutes}:${seconds}`;
                }
        
            },
        
            formatTime(date) {
                return date.toTimeString().split(' ')[0];
            },
        
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
