<div class="card mb-5 mb-xl-10" x-data="{

    addMoreSameDay(city) {
            var self = this;
            var sameDayDelivery = {};
            var i = 0;
            $.each(self.sameDayDelivery[city], function(index, val) {
                sameDayDelivery[index] = val;
                setTimeout(() => {
                    self.initDates('#sdFrom-' + city + '-' + index);
                    self.initDates('#sdTo-' + city + '-' + index);
                }, 650)
                i++;
            });

            var cIndex = i;
            sameDayDelivery[cIndex] = new Proxy({ 'from': '00:00', 'to': '00:00' }, {});
            setTimeout(() => {
                self.initDates('#sdFrom-' + city + '-' + cIndex);
                self.initDates('#sdTo-' + city + '-' + cIndex);
            }, 500);

            self.sameDayDelivery[city] = sameDayDelivery;

        },
        deleteMoreSameDay(city, index) {
            if (this.sameDayDelivery[city]) {
                delete this.sameDayDelivery[city][index];
            }
            var sameDayDelivery = {};
            if (this.sameDayDelivery[city]) {
                $.each(this.sameDayDelivery[city], function(index, val) {
                    sameDayDelivery[index] = val;
                });

                this.sameDayDelivery[city] = sameDayDelivery;
            }

        },
        initDates(id) {
            $(id).flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: 'H:i',
                time_24hr: true
            });
        },
        init() {
            var self = this;
            $.each(self.sameDayDelivery, function(city, sameData) {
                $.each(sameData, function(index, sameData) {
                    setTimeout(() => {
                        self.initDates('#sdFrom-' + city + '-' + index);
                        self.initDates('#sdTo-' + city + '-' + index);
                    }, 650);

                });
            });

            $.each(self.deliveryCities, function(index, city) {
                if (!self.sameDayDelivery[city]) {
                    self.sameDayDelivery[city] = {};
                    self.sameDayDelivery[city][0] = new Proxy({ 'from': '00:00', 'to': '00:00' }, {});
                }
                if (!self.deliveryTime[city]) {
                    self.deliveryTime[city] = new Proxy({ 'from': '00:00', 'to': '00:00' }, {});
                }
                $wire.set(`deliveryTime.${city}`, self.deliveryTime[city], false);
            });

            $nextTick(() => {
                $.each(self.deliveryCities, function(index, city) {
                    if (!self.sameDayDelivery[city]) {
                        self.sameDayDelivery[city] = {};
                        self.sameDayDelivery[city][0] = new Proxy({ 'from': '00:00', 'to': '00:00' }, {});
                    }
                    if (!self.deliveryTime[city]) {
                        self.deliveryTime[city] = new Proxy({ 'from': '00:00', 'to': '00:00' }, {});
                    }
                    $wire.set(`deliveryTime.${city}`, self.deliveryTime[city], false);
                });
            });

            window.slf = this;
        }
}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Shipping</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <template x-for="(sameData, city) in sameDayDelivery">
                <!--begin::Input group-->
                <div class="row mb-6 gap-2">
                    <!--begin::Label-->
                    <div class="col-lg-4">
                        <label class="w-100 col-form-label required fw-semibold fs-6"
                            x-text="'Same Day Delivery On '+city">
                        </label>
                        <template x-if="deliveryTime[city]">
                            <div class="form-group row mb-3" x-init="setTimeout(() => {
                                initDates('#sdFrom-' + city);
                                initDates('#sdTo-' + city);
                            }, 650);">
                                <div class="col">
                                    <label class="form-label">Time From:</label>
                                    <input :id="'sdFrom-' + city" type="text" x-model='deliveryTime[city].from'
                                        class="form-control mb-2 mb-md-0" placeholder="Select delivery time from" />
                                </div>
                                <div class="col">
                                    <label class="form-label">Time To:</label>
                                    <input :id="'sdTo-' + city" type="text" x-model='deliveryTime[city].to'
                                        class="form-control mb-2 mb-md-0" placeholder="Select delivery time to" />
                                </div>

                            </div>
                        </template>
                        <a href="javascript:;" @click='addMoreSameDay(city)' class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Add Slot
                        </a>
                    </div>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="border border-2 col-lg p-11">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                <div class="form-group">
                                    <template x-for="(sameDay, index) in sameData" :key="index">
                                        <div>
                                            <template x-if="sameDayDelivery[city][index]">
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Slot From:</label>
                                                        <input :id="'sdFrom-' + city + '-' + index" type="text"
                                                            x-model='sameDayDelivery[city][index].from'
                                                            class="form-control mb-2 mb-md-0"
                                                            placeholder="Select time from" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Slot To:</label>
                                                        <input :id="'sdTo-' + city + '-' + index" type="text"
                                                            x-model='sameDayDelivery[city][index].to'
                                                            class="form-control mb-2 mb-md-0"
                                                            placeholder="Select time to" />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <a @click="deleteMoreSameDay(city,index)"
                                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="ki-duotone ki-trash fs-5"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span
                                                                    class="path5"></span></i>
                                                            Delete
                                                        </a>
                                                    </div>

                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                    <div class="separator border-primary my-10"></div>
                </div>
                <!--end::Input group-->
            </template>


            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Standard Delivery</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                    <select wire:model.fill='standardDelivery' class="form-select form-select-solid"
                        aria-label="Select example">
                        <option>Select Option</option>
                        @foreach ($this->standardDeliveries as $key => $value)
                            <option value="{{ $key }}" {{ $standardDelivery == $key ? 'selected' : '' }}>
                                {{ $value }}</option>
                        @endforeach

                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

        </div>
        <!--end::Card body-->

        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button wire:click='saveShipping' class="btn btn-primary" id="kt_account_profile_details_submit">Save
                Changes</button>
        </div>
        <!--end::Actions-->
        <input type="hidden">

    </div>
    <!--end::Content-->
</div>
